<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{OpenBidding, OpenBiddingParent};

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
        if ($response->message != '') {
            //
            dd('messge');
        } else {
            $code = uniqid();
            // dd($response);
            $open_bidding = OpenBidding::orderBy('id', 'desc')->first();
            $exist = OpenBiddingParent::with('children')->latest()->first();

            // dump($exist);
            // dd($response);

            if ($exist) {
                // dd('exist');
                if($exist->year == $response->year){
                    // dump('yrar-true');
                    if($exist->month == $response->month){
                        // dump('month-true');
                        if($exist->bidding_number == $response->bidding_number){
                            // dump('num-true');
                            // if($exist->end_date == $response->end_date){
                                // dump('end-true');
                            foreach ($response->oneminitoring as $fuelprice)
                            {
                                $open_bidding = OpenBidding::latest()->limit(6)->get();
                                $open_bidding = $open_bidding[5];
                                $exist->update(['end_date'=>$response->end_date]);
                                $ob = OpenBidding::where('parent_id', $exist->id)->where('grade', $fuelprice->category->grade)->first();
                                $ob->update([
                                    'unique_group_id' => $code,
                                    'parent_id' => $exist->id,
                                    'grade' => $fuelprice->category->grade,
                                    'title' => $fuelprice->category->title,
                                    'qouta' => $fuelprice->qouta,
                                    'QP' => $fuelprice->qouta_price,
                                    'PQP' => $fuelprice->pqp,
                                    'qouta_price_currency' => $fuelprice->qouta_price_currency,
                                    'recieved' => $fuelprice->recieved,
                                    'change_in_price' => (float)$fuelprice->qouta_price - OpenBidding::where('unique_group_id', $open_bidding->unique_group_id)->where('grade', $fuelprice->category->grade)->value('QP'),
                                ]);

                            }
                            // }else{
                            //     // dd('end-false');
                            //     $data = OpenBiddingParent::create([
                            //         'month' => $response->month,
                            //         'bidding_number' => $response->bidding_number,
                            //         'end_date' => $response->end_date,
                            //         'year' => $response->year,
                            //     ]);
                            //     foreach ($response->oneminitoring as $fuelprice) {
                            //         OpenBidding::create([
                            //             'unique_group_id' => $code,
                            //             'parent_id' => $data->id,
                            //             'grade' => $fuelprice->category->grade,
                            //             'title' => $fuelprice->category->title,
                            //             'qouta' => $fuelprice->qouta,
                            //             'QP' => $fuelprice->qouta_price,
                            //             'PQP' => $fuelprice->pqp,
                            //             'qouta_price_currency' => $fuelprice->qouta_price_currency,
                            //             'recieved' => $fuelprice->recieved,
                            //             'change_in_price' => (float)$fuelprice->qouta_price - OpenBidding::where('unique_group_id', $open_bidding->unique_group_id)->where('grade', $fuelprice->category->grade)->value('QP'),
                            //         ]);
                            //     }
                            // }
                        }else{
                            // dump('num-false');
                            $data = OpenBiddingParent::create([
                                'month' => $response->month,
                                'bidding_number' => $response->bidding_number,
                                'end_date' => $response->end_date,
                                'year' => $response->year,
                            ]);
                            foreach ($response->oneminitoring as $fuelprice) {
                                OpenBidding::create([
                                    'unique_group_id' => $code,
                                    'parent_id' => $data->id,
                                    'grade' => $fuelprice->category->grade,
                                    'title' => $fuelprice->category->title,
                                    'qouta' => $fuelprice->qouta,
                                    'QP' => $fuelprice->qouta_price,
                                    'PQP' => $fuelprice->pqp,
                                    'qouta_price_currency' => $fuelprice->qouta_price_currency,
                                    'recieved' => $fuelprice->recieved,
                                    'change_in_price' => (float)$fuelprice->qouta_price - OpenBidding::where('unique_group_id', $open_bidding->unique_group_id)->where('grade', $fuelprice->category->grade)->value('QP'),
                                ]);
                            }
                        }
                    }else{
                        // dump('month-false');
                        $data = OpenBiddingParent::create([
                            'month' => $response->month,
                            'bidding_number' => $response->bidding_number,
                            'end_date' => $response->end_date,
                            'year' => $response->year,
                        ]);
                        foreach ($response->oneminitoring as $fuelprice) {
                            OpenBidding::create([
                                'unique_group_id' => $code,
                                'parent_id' => $data->id,
                                'grade' => $fuelprice->category->grade,
                                'title' => $fuelprice->category->title,
                                'qouta' => $fuelprice->qouta,
                                'QP' => $fuelprice->qouta_price,
                                'PQP' => $fuelprice->pqp,
                                'qouta_price_currency' => $fuelprice->qouta_price_currency,
                                'recieved' => $fuelprice->recieved,
                                'change_in_price' => (float)$fuelprice->qouta_price - OpenBidding::where('unique_group_id', $open_bidding->unique_group_id)->where('grade', $fuelprice->category->grade)->value('QP'),
                            ]);
                        }
                    }
                }else{
                    // dd('yrar-false');
                    $data = OpenBiddingParent::create([
                        'month' => $response->month,
                        'bidding_number' => $response->bidding_number,
                        'end_date' => $response->end_date,
                        'year' => $response->year,
                    ]);
                    foreach ($response->oneminitoring as $fuelprice) {
                        OpenBidding::create([
                            'unique_group_id' => $code,
                            'parent_id' => $data->id,
                            'grade' => $fuelprice->category->grade,
                            'title' => $fuelprice->category->title,
                            'qouta' => $fuelprice->qouta,
                            'QP' => $fuelprice->qouta_price,
                            'PQP' => $fuelprice->pqp,
                            'qouta_price_currency' => $fuelprice->qouta_price_currency,
                            'recieved' => $fuelprice->recieved,
                            'change_in_price' => (float)$fuelprice->qouta_price - OpenBidding::where('unique_group_id', $open_bidding->unique_group_id)->where('grade', $fuelprice->category->grade)->value('QP'),
                        ]);
                    }
                }

                // if ($exist->end_date != $response->end_date && $exist->bidding_number != $response->bidding_number && $exist->year != $response->year && $exist->month != $response->month)
                // {
                //     dd('create');
                //     $data = OpenBiddingParent::create([
                //         'month' => $response->month,
                //         'bidding_number' => $response->bidding_number,
                //         'end_date' => $response->end_date,
                //         'year' => $response->year,
                //     ]);
                //     foreach ($response->oneminitoring as $fuelprice) {
                //         OpenBidding::create([
                //             'unique_group_id' => $code,
                //             'parent_id' => $data->id,
                //             'grade' => $fuelprice->category->grade,
                //             'title' => $fuelprice->category->title,
                //             'qouta' => $fuelprice->qouta,
                //             'QP' => $fuelprice->qouta_price,
                //             'PQP' => $fuelprice->pqp,
                //             'qouta_price_currency' => $fuelprice->qouta_price_currency,
                //             'recieved' => $fuelprice->recieved,
                //             'change_in_price' => (float)$fuelprice->qouta_price - OpenBidding::where('unique_group_id', $open_bidding->unique_group_id)->where('grade', $fuelprice->category->grade)->value('QP'),
                //         ]);
                //     }

                // } else if ($exist->end_date == $response->end_date && $exist->bidding_number == $response->bidding_number && $exist->year == $response->year && $exist->month == $response->month)
                // {
                //     dd('update');
                //     foreach ($response->oneminitoring as $fuelprice)
                //     {
                //         $ob = OpenBidding::where('parent_id', $exist->id)->where('grade', $fuelprice->category->grade)->first();
                //         $ob->update([
                //             'unique_group_id' => $code,
                //             'parent_id' => $exist->id,
                //             'grade' => $fuelprice->category->grade,
                //             'title' => $fuelprice->category->title,
                //             'qouta' => $fuelprice->qouta,
                //             'QP' => $fuelprice->qouta_price,
                //             'PQP' => $fuelprice->pqp,
                //             'qouta_price_currency' => $fuelprice->qouta_price_currency,
                //             'recieved' => $fuelprice->recieved,
                //             'change_in_price' => (float)$fuelprice->qouta_price - OpenBidding::where('unique_group_id', $open_bidding->unique_group_id)->where('grade', $fuelprice->category->grade)->value('QP'),
                //         ]);

                //     }
                // }

            } else {
                $data = OpenBiddingParent::create([
                    'month' => $response->month,
                    'bidding_number' => $response->bidding_number,
                    'end_date' => $response->end_date,
                    'year' => $response->year,
                ]);
                foreach ($response->oneminitoring as $fuelprice) {
                    OpenBidding::create([
                        'unique_group_id' => $code,
                        'parent_id' => $data->id,
                        'grade' => $fuelprice->category->grade,
                        'title' => $fuelprice->category->title,
                        'qouta' => $fuelprice->qouta,
                        'QP' => $fuelprice->qouta_price,
                        'PQP' => $fuelprice->pqp,
                        'qouta_price_currency' => $fuelprice->qouta_price_currency,
                        'recieved' => $fuelprice->recieved,
                        'change_in_price' => 0.0,
                    ]);
                }
            }
        }


        return Command::SUCCESS;
    }

}
