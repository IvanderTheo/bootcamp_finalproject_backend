<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreLocation extends Model
{
    //
    protected $table='store_locations';
    protected $fillable=[
        'name',
        'image_url',
        'maps'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
