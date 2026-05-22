<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(Request $request) {
        $query = Products::with(
            'category',
            'review');

        //query berdasarkan slug
        if($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('category_slug', $request->category);
            });
        }

        $products = $query
            ->select('product_name','price','stock')
            ->latest()
            ->paginate(10);
        return response()->json([
            'status'=>'sucess',
            'data'=>$products
        ],201);
    }

    public function show($id) {
        $result = Products::with('review')->findOrFail($id);
        return response()->json([
            'status'=>'sucess',
            'data'=>$result
        ],201);
    }
}
