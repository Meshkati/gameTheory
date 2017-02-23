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


Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('/games/{game_id}', 'HomeController@showGame')->where('game_id', '[0-9]+');
Route::post('/games/{game_id}/submit','MatchController@storeRecord')->where('game_id', '[0-9]+');
Route::post('/games/{game_id}/checkRecordStatus/{record_id}', 'MatchController@checkRecordStatus')->where('game_id', '[0-9]+');