<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Auth routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/register',  'register');
    Route::post('/login',  'login');
});


// Product routes
Route::controller(ProductController::class)->group(function (){
    Route::get('/products','index');
    Route::get('/products/{id}','show')->middleware("increase.view.count");
});

// Activity routes
Route::controller(ActivityController::class)->group(function (){
    Route::get('/Activities','index');
    Route::get('/Activities/{id}','show');
//        ->middleware("increase.view.count");
});

// Category routes
Route::controller(CategoryController::class)->group(function (){
    Route::get('/category','index');
});



Route::middleware(['auth:sanctum'])->group(function (){
    // Product routes
    Route::controller(ProductController::class)->group(function () {
        Route::post('/products','store');
        Route::put('/products/{id}','update');
        Route::delete('/products/{id}','destroy');
    });

    // Activity routes
    Route::controller(ActivityController::class)->group(function () {
        Route::post('/Activities','store');
        Route::put('/Activities/{id}','update');
        Route::delete('/Activities/{id}','destroy');
    });

    // Category routes
    Route::post('/category',[CategoryController::class,'store']);
//    Route::put('/category/{id}',[CategoryController::class,'update']);
    Route::delete('/category/{id}',[CategoryController::class,'destroy']);
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
