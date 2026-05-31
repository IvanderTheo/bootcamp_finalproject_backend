<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Table extends Model
{
    //
    protected $table = 'tables';
    protected $fillable = [
        'table_number',
        'capacity',
        'status',
    ];
    protected $hidden = [
        'capacity',
        'created_at',
        'updated_at'
    ];
    public function sale() :HasOne {
        return $this->hasOne(Sale::class,'table_id','id');
    }
}
