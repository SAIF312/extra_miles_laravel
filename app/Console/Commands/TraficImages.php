<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TraficImage;
use Illuminate\Support\Facades\Http;

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
        $response = Http::withHeaders([
            'AccountKey' => 'yv3q/xw1QQ2cIhwWKZmUIQ==',
        ])->get('http://datamall2.mytransport.sg/ltaodataservice/Traffic-Imagesv2');
        // $response = $client->request('get', 'http://datamall2.mytransport.sg/ltaodataservice/Traffic-Imagesv2');
        $response = json_decode($response);

        if ($response) {
            $traffic_images = TraficImage::truncate();
            // foreach ($traffic_images as $ti) {
            //     $ti->delete();
            // }

            // $code = uniqid();
            foreach ($response->value as $fuelprice) {

                TraficImage::create([
                    // 'unique_group_id' => $code,
                    'camera_id' => $fuelprice->CameraID,
                    'lat' => $fuelprice->Latitude,
                    'lng' => $fuelprice->Longitude,
                    'image' => $fuelprice->ImageLink,
                ]);
            }
        }

        return Command::SUCCESS;
    }
}
