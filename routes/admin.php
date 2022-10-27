<?php

use App\Http\Controllers\Admin\{DashboardController, MotoristController, MalaysianController, OpenbiddingController, TraficImageController, CarParkingController};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.motorist.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/motorist/price',[MotoristController::class, 'index'])->name('motorist.price');

Route::get('/motorist/index',[MotoristController::class, 'index_data_table'])->name('motorist.index');

Route::get('/malaysian/price',[MalaysianController::class, 'index'])->name('malaysian.price');

Route::get('/malaysian/index',[MalaysianController::class, 'index_data_table'])->name('malaysian.index');

Route::get('/openbidding/price',[OpenbiddingController::class, 'index'])->name('openbidding.price');

Route::get('/openbidding/index',[OpenbiddingController::class, 'index_data_table'])->name('openbidding.index');

Route::get('/trafic/images/price',[TraficImageController::class, 'index_data_table'])->name('Trafic_images.price');

Route::get('/trafic/images/index',[TraficImageController::class, 'index_data_table'])->name('Trafic_images.index');

Route::get('/parking/price',[CarParkingController::class, 'index'])->name('carparking.price');

Route::get('/parking/index',[CarParkingController::class, 'index_data_table'])->name('carparking.index');

Route::get('carparking/modal/{id}',[CarParkingController::class, 'Modal'])->name('carparking.modal');




require __DIR__.'/auth.php';
