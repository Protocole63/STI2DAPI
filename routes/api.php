<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('data', 'DataAPIController');

Route::resource('heats', 'HeatAPIController');

Route::resource('foods', 'FoodAPIController');

Route::resource('acids', 'AcidAPIController');


Route::get('GetDatas/{howmany}', 'DataAPIController@GetDatas');
Route::get('GetData/{data_id}', 'DataAPIController@GetData');