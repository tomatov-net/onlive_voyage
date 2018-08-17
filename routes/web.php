<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('test/medicines/{id}', 'MedicineController@update');
Route::resource('medicines', 'MedicineController')->middleware('auth');
