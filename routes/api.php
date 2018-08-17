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

Route::post('medicines/{id}', 'MedicineController@update');
Route::post('calculate', 'OperationController@calc');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
