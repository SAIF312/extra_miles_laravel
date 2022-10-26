<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraficImage extends Model
{
    use HasFactory;
    protected $guarded = [];
    function checkPoint(){
        return $this->belongsTo(CheckPoint::class, 'checkpoint_id','title');
    }
}
