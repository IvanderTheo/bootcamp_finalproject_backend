<?php

namespace App\Models;

use App\Enums\CartStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    //
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'status',
        'total_price'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'status' => CartStatus::class,
    ];
    public function user():BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function cartItems():HasMany {
        return $this->hasMany(CartItem::class,'cart_id','id');
    }
}
