<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//public api
Route::get('/category',[CategoryController::class,'index']);
Route::get('/product',[ProductController::class,'index']);
Route::get('/product/{id}',[ProductController::class,'show']);

Route::middleware('auth:sanctum')->group(function() {
    //user
    Route::post('/auth/register',[AuthController::class,'register']);
    Route::post('/auth/login',[AuthController::class,'login']);
    Route::post('/auth/logout',[AuthController::class,'logout']);
    
    //cart
    Route::get('/cart',[CartController::class,'index']);
    Route::post('/cart',[CartController::class,'store']);
    Route::put('/cart-update',[CartController::class,'update']);
    Route::delete('/cart-delete',[CartController::class,'delete']);

    //sale
    Route::get('/sale',[SaleController::class,'index']);
    Route::get('/sale/{id}',[SaleController::class,'shpw']);
    Route::post('/sale',[SaleController::class,'store']);

    //payment
    Route::post('/payment',[PaymentController::class,'payment']);
    Route::patch('/payment-update',[PaymentController::class,'cancel']);

    //product review
    Route::post('/product/{id}/review',[ProductController::class,'review']);

    //product add to cart controller
    Route::post('/cart',[CartController::class,'addToCart']);
    Route::get('/cart',[CartController::class,'index']);
    Route::put('/cart/{id}',[CartController::class,'update']);
    Route::delete('/cart/{id}',[CartController::class,'delete']);

    //checkout
    Route::get('/checkout',[SaleController::class,'index']);
    Route::get('/checkout/{id}',[SaleController::class,'show']);
    Route::post('/checkout',[SaleController::class,'checkout']);
    Route::patch('/checkout/{id}/cancel',[SaleController::class,'cancel']);
});