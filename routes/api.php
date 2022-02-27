<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::fallback(function (){
   return response()->json([
     'message' => 'Route not found'
   ]);
});

Route::resource('products',ProductController::class)->only([
    'index', 'show'
]);

Route::namespace('Api')->group(function (){
    Route::get('/cart/{unique_id}',[CartController::class,'show'])->name('cart.show');
    Route::post('/cart/store',[CartController::class,'store'])->name('cart.store');
    Route::post('/cart/clear',[CartController::class,'destroy'])->name('cart.clear');
    Route::post('/cart/delete',[CartController::class,'delete'])->name('cart.delete');
});
