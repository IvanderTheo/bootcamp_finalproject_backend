<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index() {
        $result = ProductCategory::all();
        return response()->json([
            'status'=>"success",
            'message'=> "Success Retreieved Data",
            'data'=>$result,
        ]);
    }
}
