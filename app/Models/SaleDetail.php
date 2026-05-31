<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleDetail extends Model
{
    //
    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'price',
        'sub_total'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function sale():BelongsTo {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
    public function product():BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
