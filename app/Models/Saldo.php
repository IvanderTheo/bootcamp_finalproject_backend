<?php

namespace App\Models;

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
    protected function user():BelongsTo {
        return $this->belongsTo(User::class,'user_id');
    }
}
