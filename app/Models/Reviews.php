<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reviews extends Model
{
    //
    public function product():BelongsTo {
        return $this->belongsTo(Products::class,'product_id');
    }
}
