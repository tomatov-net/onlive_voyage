<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('medicines', 'MedicineController')->middleware('auth');
