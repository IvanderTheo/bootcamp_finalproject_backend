<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItems extends Model
{
    //
    protected $fillable = [
        'card_id',
        'product_id',
        'quantity',
        'price',
        'sub_total'
    ];
    public function cart():BelongsTo {
        return $this->belongsTo(Carts::class,'card_id');
    }
    public function product():BelongsTo {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
