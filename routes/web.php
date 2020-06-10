<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::post('/create_save_row','FrontEndController@create_save_row');
Route::post('/second_time_save','FrontEndController@second_time_save');
Route::post('/submit_final_save','FrontEndController@submit_final_save');
