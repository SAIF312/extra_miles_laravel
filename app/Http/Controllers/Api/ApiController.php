<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{MotoristFuelPrice, OpenBidding, MalysianFuelPrice, TraficImage, CarParkingDaysPrice, CarParking, Grade};
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
        if($motor){
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

        $open_bidding = MalysianFuelPrice::orderBy('created_at' , 'desc')->first();
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
        $data = TraficImage::where('unique_group_id', $open_bidding->unique_group_id)->get()->makeHidden(['unique_group_id']);
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

    public function price_graph(Request $request){
        
        $fuel_price = MotoristFuelPrice::where('grade_id', $request->grade_id)->whereDate('created_at' , '<=' , Carbon::now()->addDays($request->days))->get();
        if(count($fuel_price) > 0){
        return response()->json([
            "status" => 200,
            "data"=> $fuel_price
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


