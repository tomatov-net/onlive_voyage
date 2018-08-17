<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('medicines', 'MedicineController')->middleware('auth');

Route::group(['prefix' => 'operations', 'as' => 'operations.'], function (){
    Route::get('/', 'OperationController@index');
});
