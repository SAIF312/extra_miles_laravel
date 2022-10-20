<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function motorist_fuel_prices(){

        return $this->hasMany(MotoristFuelPrice::class, 'grade_id');

    }

}
