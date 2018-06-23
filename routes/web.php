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

Route::get('/', function () {
    return view('dpi/index');
})->middleware('auth');

Route::resource('channels', 'ChannelsController')->middleware('auth');
Route::resource('windows', 'WindowsController')->middleware('auth');
Route::resource('ads', 'AdsController')->middleware('auth');
Route::resource('scheduling', 'SchedulingController')->middleware('auth');
Route::resource('reports', 'ReportsController')->middleware('auth');
Route::post('scheduling/search', 'SchedulingController@search')->middleware('auth');
//Route::get('scheduling/saveBreak', 'SchedulingController@saveBreak');
Route::post('scheduling/fileGeneration', 'SchedulingController@fileGeneration');
