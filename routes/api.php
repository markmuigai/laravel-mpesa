<?php

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
// Generate mpesa access token
Route::post('v1/access/token', 'MpesaController@generateAccessToken');

// Initiate STK push
Route::post('v1/laravel-mpesa/stk/push', 'MpesaController@customerMpesaSTKPush');