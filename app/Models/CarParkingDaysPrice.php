<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarParkingDaysPrice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function car_parking(){
        return $this->belongsTo(CarParking::class, 'car_parking_id' , 'id');
    }
}
