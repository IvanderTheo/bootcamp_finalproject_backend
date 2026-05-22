<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index() {
        $result = Categories::all();
        return response()->json([
            'status'=>"success",
            'message'=> "Success Retreieved Data",
            'data'=>$result,
        ]);
    }
}
