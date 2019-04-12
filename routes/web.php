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
    return view('welcome');
});

Route::resource('opskrifter', 'OpskriftController');

Route::get('/sorted-by-time', 'OpskriftController@index_time_sort')->name('opskrifter.sorted_by_time');

Route::get('autocomplete', 'IngrediensController@autocomplete')->name('autocomplete');
