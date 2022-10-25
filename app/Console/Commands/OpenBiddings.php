<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OpenBidding;

class OpenBiddings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'OpenBiddings:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $client = new \GuzzleHttp\Client();
        $response = $client->request('get', 'http://128.199.227.15:5000/coe_open_bidding');
        $response = json_decode($response->getBody()->getContents());
        $code = uniqid();
        $open_bidding = OpenBidding::orderBy('id' , 'desc')->first();
        if($open_bidding){
            foreach($response->oneminitoring as $fuelprice){
                OpenBidding::create([
                    'unique_group_id'=>$code,
                    'grade'=>$fuelprice->category->grade,
                    'title'=>$fuelprice->category->title,
                    'qouta'=>$fuelprice->qouta,
                    'qouta_price' => $fuelprice->qouta_price,
                    'qouta_price_currency' => $fuelprice->qouta_price_currency,
                    'recieved' => $fuelprice->recieved,
                    'change_in_price' =>(float)$fuelprice->qouta_price - OpenBidding::where('unique_group_id' , $open_bidding->unique_group_id)->where('grade' ,$fuelprice->category->grade)->value('qouta_price'),
                ]);
            }
        }else{
            foreach($response->oneminitoring as $fuelprice){
                OpenBidding::create([
                    'unique_group_id'=>$code,
                    'grade'=>$fuelprice->category->grade,
                    'title'=>$fuelprice->category->title,
                    'qouta'=>$fuelprice->qouta,
                    'qouta_price' => $fuelprice->qouta_price,
                    'qouta_price_currency' => $fuelprice->qouta_price_currency,
                    'recieved' => $fuelprice->recieved,
                    'change_in_price' =>0.0,
                ]);
            }
        }

        return Command::SUCCESS;
    }
}