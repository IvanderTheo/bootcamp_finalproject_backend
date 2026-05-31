<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Saldo extends Model
{
    //
    protected $fillable = [
        'user_id',
        'payment_method',
        'saldo',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'payment_method'=>PaymentMethod::class,
    ];
    protected function user():BelongsTo {
        return $this->belongsTo(User::class,'user_id');
    }
}
