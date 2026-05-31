<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(Request $request) {
        $query = Product::with(['category']);

        //query berdasarkan slug
        if($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('category_slug', $request->category);
            });
        }

        $products = Product::with([
            'category:id,category_name,category_slug'
        ])
        ->select('product_name','image_url','status','id','price')
        ->orderBy('category_id')
        ->paginate(10);

        return response()->json([
            'status'=>'sucess',
            'data'=>$products
        ],201);
    }

    public function show($id) {
        $result = Product::with(['review','review.user'])->findOrFail($id);
        return response()->json([
            'status'=>'sucess',
            'data'=>$result
        ],201);
    }
}
