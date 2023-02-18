<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
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
Route::get('/', function () {
    return "";
});
// Auth routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/register',  'register');
    Route::post('/login',  'login');
});

// Activity routes
Route::controller(ActivityController::class)->group(function (){
    Route::get('/Activities','index');
    Route::get('/Activities/{id}','show');
//        ->middleware("increase.view.count");
});



Route::middleware(['auth:sanctum'])->group(function (){

    // Activity routes
    Route::controller(ActivityController::class)->group(function () {
        Route::post('/Activities','store');
        Route::put('/Activities/{id}','update');
        Route::delete('/Activities/{id}','destroy');
    });

    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
