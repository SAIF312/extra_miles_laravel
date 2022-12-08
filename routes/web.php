<?php

use App\Http\Controllers\Admin\CarParkingController;
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
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::post('add_parking_slot', [CarParkingController::class, 'add_parking_slot'])->name('add_parking_slot');
Route::post('add_parking_days', [CarParkingController::class, 'add_parking_days'])->name('add_parking_days');
