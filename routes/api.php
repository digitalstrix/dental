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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('clinic_post_api','App\Http\Controllers\Clinic\CommonController@post_api');

Route::put('clinic_put_api','App\Http\Controllers\Clinic\CommonController@put_api');
Route::get('clinic_search/{name}','App\Http\Controllers\Clinic\CommonController@search_api');
