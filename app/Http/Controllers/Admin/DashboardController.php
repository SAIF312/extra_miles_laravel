<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarParking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // $carparking = CarParking::oredrBy('id','desc')->first();
        // $carparking = CarParking::oredrBy('id','desc')->first();
        // $carparking = CarParking::oredrBy('id','desc')->first();
        // $carparking = CarParking::oredrBy('id','desc')->first();
        // $carparking = CarParking::oredrBy('id','desc')->first();
        return view('admin.dashboard.home');
    }
}
