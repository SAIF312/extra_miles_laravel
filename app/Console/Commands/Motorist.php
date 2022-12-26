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
        $response = $client->request('get', 'http://137.184.227.191:5000/motorist');

        $response = json_decode($response->getBody()->getContents());
        $code = uniqid();
        $motor = MotoristFuelPrice::orderBy('id', 'desc')->first();
        // $grade = MotoristFuelPrice::where('unique_group_id' , $motor->unique_group_id)->with('motorist_fuel_prices')->get();
        // dd($grade);
        // $count = 0;
        $flag = "false";

        $motor = MotoristFuelPrice::orderBy('id', 'desc')->first();
        // $grade = MotoristFuelPrice::where('unique_group_id' , $motor->unique_group_id)->with('motorist_fuel_prices')->get();
        // dd($grade);
        // $count = 0;
        $flag = "false";
        if ($motor) {
            // $count = 1;
            foreach ($response->fuel_prices as $key => $fuelprice) {
                $grade_old = Grade::where('grade', $fuelprice->grade)->where('price_change_flag', 'true')->latest()->first();
                foreach ($fuelprice->pump_price as $pump_price) {
                    $motor = MotoristFuelPrice::where('grade_id', $grade_old->id)->where('price_change_flag', 'true')->where('pump', 'like', $pump_price->pump)->orderBy('created_at', 'desc')->first();
                    $change =  number_format((float)$pump_price->price, 2) - number_format((float)$motor->price, 2);
                    // if($count = 1){
                    //     // dd($change);
                    // }
                    // dd((float)$pump_price->price);
                    if ($change != 0.0) {
                        // dump((float)$pump_price->price);
                        // dump((float)$motor->price);
                        // dd((float)$change);
                        $flag = "true";
                    }
                    // $count = $count + 1;
                }
            }
            if ($flag == "true") {
                foreach ($response->fuel_prices as $key => $fuelprice) {
                    $grade_old = Grade::where('grade', $fuelprice->grade)->latest()->first();
                    $grade_new =   Grade::create([
                        'grade' => $fuelprice->grade,
                        'unique_group_id' => $code,
                        'price_change_flag' => $flag
                    ]);
                    foreach ($fuelprice->pump_price as $pump_price) {
                        $motor = MotoristFuelPrice::where('grade_id', $grade_old->id)->where('pump', 'like', $pump_price->pump)->orderBy('created_at', 'desc')->first();
                        MotoristFuelPrice::create([
                            'grade_id' => $grade_new->id,
                            'grade' => $fuelprice->grade,
                            'pump' => $pump_price->pump,
                            'price' => (float)$pump_price->price,
                            'price_change_flag' => $flag,
                            'change_in_price' => (float)$pump_price->price - $motor->price,
                            'currency' => $pump_price->currency
                        ]);
                    }
                }
            }
        } else {
            foreach ($response->fuel_prices as $key => $fuelprice) {
                $grade = Grade::where('grade', $fuelprice->grade)->latest()->first();
                $grade =   Grade::create([
                    'grade' => $fuelprice->grade,
                    'unique_group_id' => $code,
                    'price_change_flag' => 'true'
                ]);
                foreach ($fuelprice->pump_price as $pump_price) {
                    $motor = MotoristFuelPrice::where('grade_id', $grade->id)->where('pump', $pump_price->pump)->orderBy('created_at', 'desc')->first();
                    MotoristFuelPrice::create([
                        'grade_id' => $grade->id,
                        'grade' => $fuelprice->grade,
                        'pump' => $pump_price->pump,
                        'price' => (float)$pump_price->price,
                        'change_in_price' => (float)0.0,
                        'price_change_flag' => 'true',
                        'currency' => $pump_price->currency
                    ]);
                }
            }
        }
        return Command::SUCCESS;
    }
}
