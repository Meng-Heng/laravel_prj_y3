<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BrandController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/user', [UserController::class,'index']);
Route::get('/user/{user}', [UserController::class,'show']);

Route::get('product', [ProductController::class,'index']);
Route::get('product/{product}', [ProductController::class,'show']);
Route::post('product', [ProductController::class,'store']);
Route::put('product/{product}', [ProductController::class,'update']);
Route::delete('product/{product}', [ProductController::class,'delete']);

Route::get('brand', [BrandController::class,'index']);
Route::get('brand/{brand}', [BrandController::class,'show']);
Route::post('brand', [BrandController::class,'store']);
Route::put('brand/{brand}', [BrandController::class,'update']);
Route::delete('brand/{brand}', [BrandController::class,'delete']);
