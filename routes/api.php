<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StoreLocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//public api
Route::post('/auth/register',[AuthController::class,'register']);
Route::post('/auth/login',[AuthController::class,'login']);

Route::get('/category',[CategoryController::class,'index']);
Route::get('/product',[ProductController::class,'index']);
Route::get('/product/{id}',[ProductController::class,'show']);

//product add to cart controller
Route::post('/cart',[CartController::class,'addToCart']);
Route::get('/cart',[CartController::class,'index']);
Route::put('/cart/{id}',[CartController::class,'update']);
Route::delete('/cart/{id}/delete',[CartController::class,'delete']);

//order
Route::post('/order',[SaleController::class,'order']);
Route::patch('/order/{id}/cancel',[SaleController::class,'cancel']);

Route::get('/location',[StoreLocationController::class,'index']);

Route::middleware(['auth:sanctum','role:user'])->group(function() {
    //user
    Route::post('/auth/logout',[AuthController::class,'logout']);
    Route::get('/auth/profile',[AuthController::class,'profile']);
    Route::patch('/auth/tambah-saldo',[AuthController::Class,'tambahSaldo']);

    //payment
    Route::post('/payment',[PaymentController::class,'payment']);
    Route::patch('/payment-update',[PaymentController::class,'cancel']);

    //product review
    Route::post('/product/{id}/review',[ProductController::class,'review']);
});

Route::middleware(['auth:sanctum','role:karyawan'])->group(function() {
    Route::get('/order',[SaleController::class,'index']);
    Route::get('/order/{id}',[SaleController::class,'show']);
    Route::patch('/order-update',[SaleController::class,'update']);
});
Route::middleware(['auth:sanctum','role:kasir'])->group(function() {
    Route::get('/order',[SaleController::class,'index']);
    Route::get('/order/{id}',[SaleController::class,'show']);
    Route::post('/payment',[PaymentController::class,'payment']);
    Route::patch('/payment-update',[PaymentController::class,'cancel']);
});