<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payments extends Model
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
        'status'=>'enum',
        'payment_date'=>'datetime',
        'payment_method'=>'enum'
    ];
    public function sale(): BelongsTo {
        return $this->belongsTo(Sales::class,'sale_id');
    }
}
