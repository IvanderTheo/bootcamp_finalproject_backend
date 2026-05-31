<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    //
    protected $fillable = [
        'category_name',
        'category_slug',
        'description',
    ];
    protected $hidden = [
        'updated_at',
        'created_at',
    ];
    public function product():HasMany {
        return $this->hasMany(Product::class,'category_id','id');
    }
}
