<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{MotoristFuelPrice, OpenBidding, MalysianFuelPrice, TraficImage, CarParkingDaysPrice, CarParking, CheckPoint, Grade, OpenBiddingParent};
class ApiController extends Controller
{
    public function motorist_data(Request $request){

        $client = new \GuzzleHttp\Client();
        $response = $client->request('get', 'http://192.168.18.101:5000/motorist');
        $response = json_decode($response->getBody()->getContents());
        return $response;

    }
    public function open_biding(Request $request){

        $client = new \GuzzleHttp\Client();
        $response = $client->request('get', 'http://192.168.18.101:5000/coe_open_bidding');

        $response = json_decode($response->getBody()->getContents());
        return $response;
    }

    public function Open_bidding_parent(Request $request){

        $open_bidding_parent = OpenBiddingParent::all();
        if(count($open_bidding_parent) > 0){
            return response()->json([
                "status" => 200,
                "data"=> $open_bidding_parent
            ]);
            }
        else{
            return response()->json([
                "status" => 404,
                "message"=> "not found any data"
            ]);
        }

    }

    public function malaysian_fuel_prices(Request $request){

        $client = new \GuzzleHttp\Client();
        $response = $client->request('get', 'http://192.168.18.101:5000/malaysian_fuel_prices');

        $response = json_decode($response->getBody()->getContents());
        return $response;
    }
    public function traffic_cameras_images(Request $request){

        $client = new \GuzzleHttp\Client();
        $response = $client->request('get', 'http://192.168.18.101:5000/traffic_cameras_images');

        $response = json_decode($response->getBody()->getContents());
        return $response->trafic_images;
    }
    public function motorist_data_prices(Request $request){

        $motor = Grade::orderBy('created_at' , 'desc')->first();
        $data = Grade::where('unique_group_id' , $motor->unique_group_id)->with('motorist_fuel_prices')->get()->makeHidden(['unique_group_id']);
        // $motor = MotoristFuelPrice::orderBy('created_at' , 'desc')->first();
        // $motorist = MotoristFuelPrice::where('unique_group_id' , $motor->unique_group_id)->with('grade')->get();
        if($data){
            return response()->json([
                'status'=> '200',
                'data' => $data
            ]);
        }
        else{
            return response()->json([
                'status'=> '404',
                'message' => 'no data found'
            ]);
        }

    }
    public function open_biddings(Request $request){
        $parent = OpenBiddingParent::where('year', $request->year)->where('month', $request->month)->where('bidding_number' , $request->bidding_number)->first();
        // $open_bidding = OpenBidding::orderBy('created_at' , 'desc')->first();

        if($parent){
            $data = OpenBidding::where('parent_id', $parent->id)->get()->makeHidden(['unique_group_id','parent_id']);
            return response()->json([
                'status'=> '200',
                'data' => $data
            ]);
        }
        else{
            return response()->json([
                'status'=> '404',
                'message' => 'no data found'
            ]);
        }
    }
    public function malaysian_fuel_api(){

        $open_bidding = MalysianFuelPrice::orderBy('id' , 'desc')->first();
        $data = MalysianFuelPrice::where('unique_group_id', $open_bidding->unique_group_id)->get()->makeHidden(['unique_group_id']);
        if($open_bidding){
            return response()->json([
                'status'=> '200',
                'data' => $data
            ]);
        }
        else{
            return response()->json([
                'status'=> '404',
                'message' => 'no data found'
            ]);
        }
    }
    public function traffic_images_api(){
        $open_bidding = TraficImage::orderBy('created_at' , 'desc')->first();
        $data = CheckPoint::with('trafic_images')->whereIn('title',['wtc1','wtc'])->get();
        // $data = TraficImage::where('unique_group_id', $open_bidding->unique_group_id)->get()->makeHidden(['unique_group_id']);
        if($open_bidding){
            return response()->json([
                'status'=> '200',
                'data' => $data
            ]);
        }
        else{
            return response()->json([
                'status'=> '404',
                'message' => 'no data found'
            ]);
        }
    }
    public function car_parking_singapur(){


        $client = new \GuzzleHttp\Client();
        $response = $client->request('get', 'http://192.168.18.101:5000/car_parking_singapur');
        $response = json_decode($response->getBody()->getContents());
        return $response;
    }
    public function car_parking_singapur_api(){

        $open_bidding = CarParking::orderBy('created_at' , 'desc')->first();
        $data = CarParking::where('unique_group_id', $open_bidding->unique_group_id)->with('car_parking_days_prices')->get()->makeHidden(['unique_group_id']);
        if($open_bidding){
            return response()->json([
                'status'=> '200',
                'data' => $data
            ]);
        }
        else{
            return response()->json([
                'status'=> '404',
                'message' => 'no data found'
            ]);
        }

    }
    public function motorist_grades(){
        $grades = Grade::select('id','grade')->where('unique_group_id',Grade::orderBy('created_at' , 'desc')->value('unique_group_id'))->get();
        if(count($grades) > 0){
            return response()->json([
                "status" => 200,
                "grades"=> $grades
            ]);
            }
            else{
                return response()->json([
                    "status" => 404,
                    "message"=> "not found any data"
                ]);
            }

    }
    public function motorist_price_graph(Request $request){

        $pumps = array_reverse(MotoristFuelPrice::orderBy('id','desc')->limit(5)->pluck('pump')->toArray());
        // return $pumps;
        $grade = Grade::where('grade',$request->grade)->first();
        $index = 0;
        $fule_prices = [];
        foreach($pumps as $pump){
            $zero_count = count(array_keys(MotoristFuelPrice::where('grade', $grade->grade)->where('pump',$pump)->whereDate('created_at' , '>=' , Carbon::now()->subDays($request->days))->pluck('price')->toArray(),0));
            $element_count = count(MotoristFuelPrice::where('grade', $grade->grade)->where('pump',$pump)->whereDate('created_at' , '>=' , Carbon::now()->subDays($request->days))->pluck('price')->toArray());
            if($zero_count != $element_count){
                $motorist_dates = MotoristFuelPrice::where('grade', $grade->grade)->where('pump',$pump)->whereDate('created_at' , '>=' , Carbon::now()->subDays($request->days))->pluck('created_at')->toArray();
                $m_dates = [];
                foreach ($motorist_dates as $key=>$m_date){
                    $m_dates[$key]= date('d F Y',strtotime($m_date));
                }
                $fule_prices[$index]=[
                    'pump' => $pump,
                    'prices'=> MotoristFuelPrice::where('grade', $grade->grade)->where('pump',$pump)->whereDate('created_at' , '>=' , Carbon::now()->subDays($request->days))->pluck('price')->toArray(),
                    'dates'=> $m_dates
                ];
                $index +=1;
            }

            // $fuel_price = MotoristFuelPrice::where('grade_id', $request->grade_id)->where('pump',$pump)->whereDate('created_at' , '>=' , Carbon::now()->subDays($request->days))->pluck('price','created_at');
        }
        if(count($fule_prices) > 0){
        return response()->json([
            "status" => 200,
            "data"=> $fule_prices
        ]);
        }
        else{
            return response()->json([
                "status" => 404,
                "message"=> "not found any data"
            ]);
        }


    }
    public function fuel_types_api(){
        $fuel_types = Grade::latest()->limit(5)->get();
        if(count($fuel_types) > 0){
        return response()->json([
            "status" => 200,
            "data"=> $fuel_types
        ]);
        }
        else{
            return response()->json([
                "status" => 404,
                "message"=> "not found any data"
            ]);
        }
    }
    public function malaysian_price_graph(){
        $days = 360;
        $unique =  MalysianFuelPrice::latest()->value('unique_group_id');
        $fule_prices = MalysianFuelPrice::where('unique_group_id', $unique)->whereIn('title' , ['RON 95','RON 97','EURO 5 B10'])->get()->makeHidden(['unique_group_id','type','price_change_flag']);
        foreach($fule_prices as $index=>$fule_price){
            $m_dates = [];
            $malysian_dates = MalysianFuelPrice::where('title', $fule_price->title)->whereDate('created_at' , '>=' , Carbon::now()->subDays($days))->pluck('created_at')->toArray();
            foreach ($malysian_dates as $key=>$m_date){
                $m_dates[$key]= date('M y',strtotime($m_date));
            }
            $fule_prices[$index]=[
                'title' => $fule_price->title,
                'prices'=> MalysianFuelPrice::where('title', $fule_price->title)->whereDate('created_at' , '>=' , Carbon::now()->subDays($days))->pluck('price')->toArray(),
                'dates'=>  $m_dates
            ];
        }
        if(count($fule_prices) > 0){
            return response()->json([
                "status" => 200,
                "data"=> $fule_prices
            ]);
            }
            else{
                return response()->json([
                    "status" => 404,
                    "message"=> "not found any data"
                ]);
            }

    }

    public function open_bidding_price_graph(Request $request){
        $unique =  OpenBidding::latest()->value('unique_group_id');
        $bidding_prices = OpenBidding::where('unique_group_id', $unique)->get()->makeHidden(['unique_group_id']);
        foreach($bidding_prices as $index=>$bidding_price){
            $b_dates = [];
            $bodding_dates = OpenBidding::where('grade', $bidding_price->grade)->whereDate('created_at' , '>=' , Carbon::now()->subDays($request->days))->pluck('created_at')->toArray();
            foreach ($bodding_dates as $key=>$b_date){
                $b_dates[$key]= date('M y',strtotime($b_date));
            }
            $bidding_prices[$index]=[
                'title' => $bidding_price->grade,
                'prices'=> OpenBidding::where('grade', $bidding_price->grade)->whereDate('created_at' , '>=' , Carbon::now()->subDays($request->days))->pluck('QP')->toArray(),
                'dates'=>$b_dates,
                'bidding_number'=>OpenBiddingParent::whereDate('created_at' , '>=' , Carbon::now()->subDays($request->days))->pluck('bidding_number')->toArray()
            ];
        }
        if(count($bidding_prices) > 0){
            return response()->json([
                "status" => 200,
                "data"=> $bidding_prices
            ]);
            }
            else{
                return response()->json([
                    "status" => 404,
                    "message"=> "not found any data"
                ]);
            }

    }


}


