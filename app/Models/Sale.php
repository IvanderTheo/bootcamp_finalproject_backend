<?php

namespace App\Models;

use App\Enums\SaleStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    //
    protected $fillable = [
        'user_id',
        'invoice_number',
        'transaction_date',
        'total_amount',
        'tax',
        'discount',
        'grand_total',
        'status',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'transaction_date'=>'datetime',
        'status'=>SaleStatus::class,
    ];
    public function user():BelongsTo {
        return $this->belongsTo(User::class,'user_id');
    }
    public function saleDetail() : HasMany {
        return $this->hasMany(SaleDetail::class,'sale_id','id');
    }
    public function payment() : HasOne {
        return $this->hasOne(Payment::class,'sale_id','sale');
    }
    public function table() : BelongsTo {
        return $this->belongsTo(Table::class,'table_id');
    }
}
