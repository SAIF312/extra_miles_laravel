<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{MotoristFuelPrice, OpenBidding, MalysianFuelPrice, TraficImage, CarParkingDaysPrice, CarParking, CheckPoint, Grade};
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

    public function open_biddings(){

        $open_bidding = OpenBidding::orderBy('created_at' , 'desc')->first();
        $data = OpenBidding::where('unique_group_id', $open_bidding->unique_group_id)->get()->makeHidden(['unique_group_id']);
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
        $grade = Grade::where('id',$request->grade_id)->first();
        foreach($pumps as $index=>$pump){

            $fule_prices[$index]=[
                'pump' => $pump,
                'prices'=> MotoristFuelPrice::where('grade', $grade->grade)->where('pump',$pump)->whereDate('created_at' , '>=' , Carbon::now()->subDays($request->days))->pluck('price')->toArray(),
                'dates'=> MotoristFuelPrice::where('grade', $grade->grade)->where('pump',$pump)->whereDate('created_at' , '>=' , Carbon::now()->subDays($request->days))->pluck('created_at')->toArray(),
            ];
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


}


