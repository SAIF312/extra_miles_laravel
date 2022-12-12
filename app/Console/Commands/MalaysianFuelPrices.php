<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MalysianFuelPrice;

class MalaysianFuelPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MalaysianFuelPrices:cron';

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
        $response = $client->request('get', 'http://137.184.227.191:5000/malaysian_fuel_prices');
        $response = json_decode($response->getBody()->getContents());
        $code = uniqid();
        $mfp = MalysianFuelPrice::where('price_change_flag', 'true')->orderBy('id', 'desc')->first();
        $flag = 'false';
        if ($mfp) {
            foreach ($response->fule_price as $fuelprice) {
                $change = $fuelprice->price - MalysianFuelPrice::where('unique_group_id', $mfp->unique_group_id)->where('title', $fuelprice->title)->value('price');
                if ($change != 0) {
                    $flag = 'true';
                }
            }
            if ($flag == 'true') {
                foreach ($response->fule_price as $fuelprice) {
                    MalysianFuelPrice::create([
                        'unique_group_id' => $code,
                        'type' => $fuelprice->type,
                        'title' => $fuelprice->title,
                        'price' => (float)$fuelprice->price,
                        'change_in_price' => $fuelprice->price - MalysianFuelPrice::where('unique_group_id', $mfp->unique_group_id)->where('title', $fuelprice->title)->value('price'),
                        'price_change_flag' => $flag,
                        'currency' => $fuelprice->currency
                    ]);
                }
            }
        } else {
            foreach ($response->fule_price as $fuelprice) {
                MalysianFuelPrice::create([
                    'unique_group_id' => $code,
                    'type' => $fuelprice->type,
                    'title' => $fuelprice->title,
                    'price' => (float)$fuelprice->price,
                    'change_in_price' => 0.0,
                    'price_change_flag' => 'true',
                    'currency' => $fuelprice->currency
                ]);
            }
        }
        return Command::SUCCESS;
    }
}
