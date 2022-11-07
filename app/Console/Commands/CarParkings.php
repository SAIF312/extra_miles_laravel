<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CarParkingDaysPrice;
use App\Models\CarParking;

class CarParkings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CarParking:cron';

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
        $response = $client->request('get', 'http://128.199.227.15:5000/car_parking_singapur');

        $response = json_decode($response->getBody()->getContents());
        if($response){
            $car_parking_prices=CarParkingDaysPrice::all();
            foreach($car_parking_prices as $cpp){
                $cpp->delete();
            }

            $car_parkings=CarParking::all();
            foreach($car_parkings as $cp){
                $cp->delete();
            }




            $code = uniqid();
            foreach($response->parking as $key=>$parking){
            $carparking =  CarParking::create([
                    'name'=>$parking->name,
                    'unique_group_id' => $code,
                    'description'=>$parking->title,
                    'location'=>$parking->location,
                    'latitude'=>$parking->lat,
                    'longitude'=>$parking->lng,
                ]);

                foreach($parking->day_wise_timings as $days){

                    foreach($days->timings_prices as $price){
                        CarParkingDaysPrice::create([
                            'car_parking_id'=> $carparking->id,
                            'days' => $days->days,
                            'timing' => $price->timing,
                            'price' => $price->price,
                        ]);
                    }



                }
            }

        }
        return Command::SUCCESS;
    }
}
