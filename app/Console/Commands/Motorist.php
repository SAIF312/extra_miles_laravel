<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MotoristFuelPrice;
use App\Models\Grade;

class Motorist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Motorist:cron';

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
        $response = $client->request('get', 'http://192.168.18.101:5000/motorist');

        $response = json_decode($response->getBody()->getContents());
        $code = uniqid();
        $motor = MotoristFuelPrice::orderBy('created_at' , 'desc')->first();
        $price = MotoristFuelPrice::where('unique_group_id' , $motor->unique_group_id)->pluck('price');
        $count = 0;
        foreach($response->fuel_prices as $key=>$fuelprice){
            $grade =   Grade::create([
                'grade' => $fuelprice->grade,
                'unique_group_id'=>$code,
            ]);

            foreach($fuelprice->pump_price as $pump_price){
        
                MotoristFuelPrice::create([
                    'grade_id'=>$grade->id,
                    'pump'=>$pump_price->pump,
                    'price'=>(float)$pump_price->price,
                    'change_in_price' => (float)$pump_price->price - $price[$count],
                    'currency'=>$pump_price->currency
                ]);            

            }
         
           
            $count = $count + 1;
        } 


        return Command::SUCCESS;
    }
}
