<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carts extends Model
{
    //
    protected $fillable = [
        'user_id',
        'status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'status' => 'enum',
    ];
    public function user():BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function cartItem():HasMany {
        return $this->hasMany(CartItems::class,'cart_id','id');
    }
}
