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
Route::get('/dit/is/een/test', function () {
    return view('test');
});
Route::get('/dit/is/een/test', function () {
    return view('test2')->with('varnaam',config('database.default'));
});

Route::get('/test/{id}', 'TestController@show');

Route::get('/test', 'TestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('ticket/create', 'TicketController@create')->name('ticket_create');
Route::post('ticket/save', 'TicketController@save')->name('ticket_save');
Route::get('ticket/index','TicketController@index')->name('ticket_index');
Route::get('ticket/{id}/show','TicketController@show')->name('ticket_show');
Route::put('ticket/{id}/update', 'TicketController@update')->name('ticket_update');
Route::post('ticket/{id}/comment/save', 'CommentController@save')->name('comment_save');
