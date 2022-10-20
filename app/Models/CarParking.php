<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarParking extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function car_parking_days_prices(){
        return $this->hasMany(CarParkingDaysPrice::class, 'car_parking_id');
    }
}
