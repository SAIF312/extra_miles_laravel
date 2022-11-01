<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenBiddingParent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function children(){
        return $this->belongsTo(OpenBidding::class, 'id' , 'parent_id');
    }
}
