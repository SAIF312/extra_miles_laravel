<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TraficImage;

class TraficImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TraficImages:cron';

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
        $response = $client->request('get', 'http://192.168.18.101:5000/traffic_cameras_images');
        $response = json_decode($response->getBody()->getContents());
        if($response){
            $traffic_images=TraficImage::all();
            foreach($traffic_images as $ti){
                $ti->delete();
            }

            $code = uniqid();
            foreach($response->trafic_images as $fuelprice){

                TraficImage::create([
                    'unique_group_id'=>$code,
                    'checkpoint_id'=>$fuelprice->checkpoint_id,
                    'checkpoint'=>$fuelprice->checkpoint,
                    'title'=>$fuelprice->title,
                    'date'=>$fuelprice->date,
                    'image'=>$fuelprice->image,
                ]);


            }
        }

        return Command::SUCCESS;
    }
}
