<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    //
    protected $fillable = [
        'sale_id',
        'paid_amount',
        'status',
        'payment_date',
        'payment_method',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'status'=>PaymentStatus::class,
        'payment_date'=>'datetime',
        'payment_method'=>PaymentMethod::class,
    ];
    public function sale(): BelongsTo {
        return $this->belongsTo(Sale::class,'sale_id');
    }
}
