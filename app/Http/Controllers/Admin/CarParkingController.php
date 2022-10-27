<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarParkingController extends Controller
{
    public function index(){
        return view(admin.car_parking.index);
    }
}
