<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'product_name',
        'sku',
        'description',
        'price',
        'status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function category():BelongsTo{
        return $this->belongsTo(ProductCategory::class,'category_id');
    }
    public function cartItem():HasMany {
        return $this->HasMany(CartItem::class,'product_id','id');
    }
    public function saleDetail():HasMany {
        return $this->HasMany(SaleDetail::class,'product_id','id');
    }
    public function review():HasMany {
        return $this->hasMany(Review::class,'product_id','id');
    }
}
