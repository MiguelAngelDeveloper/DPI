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
Route::resource('breaks', 'BreaksController')->middleware('auth');
Route::resource('ads', 'AdsController')->middleware('auth');
Route::resource('scheduling', 'SchedulingController')->middleware('auth');