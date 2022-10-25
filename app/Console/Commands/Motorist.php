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
        $response = $client->request('get', 'http://128.199.227.15:5000/motorist');

        $response = json_decode($response->getBody()->getContents());
        $code = uniqid();
        $motor = MotoristFuelPrice::orderBy('id' , 'desc')->first();
        // $grade = MotoristFuelPrice::where('unique_group_id' , $motor->unique_group_id)->with('motorist_fuel_prices')->get();
        // dd($grade);
        // $count = 0;
        if($motor){
            foreach($response->fuel_prices as $key=>$fuelprice){
                $grade_old = Grade::where('grade',$fuelprice->grade)->latest()->first();
                $grade_new =   Grade::create([
                    'grade' => $fuelprice->grade,
                    'unique_group_id'=>$code,
                ]);

                foreach($fuelprice->pump_price as $pump_price){

                    $motor = MotoristFuelPrice::where('grade_id' , $grade_old->id)->where('pump','like',$pump_price->pump)->orderBy('created_at','desc')->first();
                    // dump($pump_price->pump);
                    // dump($grade_old->grade);
                    // dd($motor);
                    MotoristFuelPrice::create([
                        'grade_id'=>$grade_new->id,
                        'grade'=>$fuelprice->grade,
                        'pump'=>$pump_price->pump,
                        'price'=>(float)$pump_price->price,
                        'change_in_price' => (float)$pump_price->price - $motor->price,
                        'currency'=>$pump_price->currency
                    ]);

                }

            }
        }else{
            foreach($response->fuel_prices as $key=>$fuelprice){
                $grade = Grade::where('grade',$fuelprice->grade)->latest()->first();
                $grade =   Grade::create([
                    'grade' => $fuelprice->grade,
                    'unique_group_id'=>$code,
                ]);

                foreach($fuelprice->pump_price as $pump_price){

                    $motor = MotoristFuelPrice::where('grade_id' , $grade->id)->where('pump',$pump_price->pump)->orderBy('created_at','desc')->first();
                    MotoristFuelPrice::create([
                        'grade_id'=>$grade->id,
                        'grade'=>$fuelprice->grade,
                        'pump'=>$pump_price->pump,
                        'price'=>(float)$pump_price->price,
                        'change_in_price' => (float)0.0,
                        'currency'=>$pump_price->currency
                    ]);

                }

            }
        }


        return Command::SUCCESS;
    }
}
