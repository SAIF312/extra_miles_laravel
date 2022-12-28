<?php

use App\Http\Controllers\Admin\{DashboardController, MotoristController, MalaysianController, OpenbiddingController, TraficImageController, CarParkingController, ProfileController, SubscriberController};
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


Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/motorist/price',[MotoristController::class, 'index'])->name('motorist.price');

    Route::get('/motorist/index',[MotoristController::class, 'index_data_table'])->name('motorist.index');
    Route::get('/motorist/edit/{id}',[MotoristController::class, 'edit'])->name('motorist.edit');
    Route::post('/motorist/update',[MotoristController::class, 'update'])->name('motorist.update');

    Route::get('/malaysian/price',[MalaysianController::class, 'index'])->name('malaysian.price');
    Route::get('/malaysian/edit/{id}',[MalaysianController::class, 'edit'])->name('malaysian.edit');
    Route::post('/malaysian/update',[MalaysianController::class, 'update'])->name('malaysian.update');

    Route::get('/malaysian/index',[MalaysianController::class, 'index_data_table'])->name('malaysian.index');

    Route::get('/openbidding/price',[OpenbiddingController::class, 'index'])->name('openbidding.price');

    Route::get('/openbidding/index',[OpenbiddingController::class, 'index_data_table'])->name('openbidding.index');

    Route::get('/trafic/images/price',[TraficImageController::class, 'index_data_table'])->name('Trafic_images.price');

    Route::get('/trafic/images/index',[TraficImageController::class, 'index_data_table'])->name('Trafic_images.index');

    Route::get('/parking/price',[CarParkingController::class, 'index'])->name('carparking.price');
    Route::get('/parking/index',[CarParkingController::class, 'index_data_table'])->name('carparking.index');

    Route::get('/parking/create',[CarParkingController::class, 'create'])->name('carparking.create');

    Route::get('carparking/modal/{id}',[CarParkingController::class, 'Modal'])->name('carparking.modal');
    Route::get('/parking/edit/{id}',[CarParkingController::class, 'edit'])->name('carparking.edit');
    Route::post('/parking/update',[CarParkingController::class, 'update'])->name('carparking.update');

    Route::prefix('profile')->as('profile.')->controller(ProfileController::class)->group(function() {
        Route:: get('index', 'index')->name('index');
        Route:: post('store', 'store')->name('store');
        Route:: post('status', 'status')->name('status');
        Route:: get('delete/{id}', 'destroy')->name('delete');
        Route:: post('modal', 'modal')->name('modal');
        Route:: post('update', 'update')->name('update');
        Route:: post('updatePassword', 'updatePassword')->name('updatePassword');
    });

    Route::get('/subscriber/index',[SubscriberController::class, 'index'])->name('subscriber.index');
    Route::get('/subscriber/show',[SubscriberController::class, 'index_data_table'])->name('subscriber.show');
    Route::get('/subscriber/delete',[SubscriberController::class, 'delete_subscriber'])->name('subscriber.delete');
});




require __DIR__.'/auth.php';
