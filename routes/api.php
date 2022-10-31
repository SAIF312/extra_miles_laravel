<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('motorist_data',[ApiController::class,'motorist_data']);
Route::get('coe_open_biding',[ApiController::class,'open_biding']);
Route::get('malaysian_fuel_prices',[ApiController::class,'malaysian_fuel_prices']);
Route::get('traffic_cameras_images',[ApiController::class,'traffic_cameras_images']);
Route::get('car_parking_singapur',[ApiController::class,'car_parking_singapur']);

        // database api for moeen
Route::get('compare_prices_api',[ApiController::class,'motorist_data_prices']);
Route::get('open_bidding-api',[ApiController::class,'open_biddings']);
Route::get('malaysian_fuel_api',[ApiController::class,'malaysian_fuel_api']);
Route::get('traffic_images_api',[ApiController::class,'traffic_images_api']);
Route::get('car_parking_singapur_api',[ApiController::class,'car_parking_singapur_api']);


        // graph api

Route::get('fuel_types',[ApiController::class,'fuel_types_api']);
Route::get('grades',[ApiController::class,'motorist_grades']);
Route::post('motorist_price_graph',[ApiController::class,'motorist_price_graph']);
Route::post('malaysian_price_graph',[ApiController::class,'malaysian_price_graph']);



