<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Products extends Model
{
    //
    protected $fillable = [
        'category_id',
        'product_name',
        'sku',
        'description',
        'price',
        'stock',
        'status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function category():BelongsTo{
        return $this->belongsTo(Categories::class,'category_id');
    }
    public function cartItem():HasMany {
        return $this->HasMany(CartItems::class,'product_id','id');
    }
    public function saleDetail():HasMany {
        return $this->HasMany(SaleDetails::class,'product_id','id');
    }
    public function review():HasMany {
        return $this->hasMany(Reviews::class,'product_id','id');
    }
}
