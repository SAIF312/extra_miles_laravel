<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenBidding extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function parent(){
        return $this->belongsTo(OpenBiddingParent::class, 'parent_id' , 'id');
    }
}
