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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'PagesController@homepage');
Route::get('about', 'PagesController@about');

Route::get('create', 'BMIController@create');
Route::get('bmi', 'BMIController@index');
Route::post('bmi', 'BMIController@generate');
Route::get('bmishow', 'BMIController@show');
Route::get('bmi/{bmi}','BMIController@detail');
Route::get('bmi/edit/{bmi}', 'BMIController@edit');
Route::patch('bmi/{bmi}', 'BMIController@update');

Route::get('calendar', 'PCalendarController@index')->name('calendar');
Route::post('calendar','PCalendarController@addEvent')->name('events.add');
Route::get('show_calendar', 'PCalendarController@show');