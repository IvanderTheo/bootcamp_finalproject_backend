<?php

namespace App\Http\Controllers;

use App\Models\StoreLocation;
use Illuminate\Http\Request;

class StoreLocationController extends Controller
{
    //
    public function index() {
        $result = StoreLocation::all();
        return response()->json([
            'status'=>'success',
            'message'=>'Data retrieved Susccessfully',
            'data'=>$result
        ]);
    }
}
