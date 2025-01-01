<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('auth/login', 'App\Http\Controllers\AuthController@login');

Route::group(['middleware' => ['apiJwt']],function(){
    Route::post('auth/logout', 'App\Http\Controllers\AuthController@logout');

    Route::get('/restaurants','App\Http\Controllers\api\RestaurantController@index');
    Route::get('/restaurants/find','App\Http\Controllers\api\RestaurantController@find');
    Route::post('/restaurants','App\Http\Controllers\api\RestaurantController@store');
    Route::delete('/restaurants','App\Http\Controllers\api\RestaurantController@delete');
});


