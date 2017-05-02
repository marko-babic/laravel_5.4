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


Route::get('/', 'MainWebController@index')->name('index');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'home'], function() {
    Route::put('notification', 'NotificationController@update')->name('notification');
    Route::resource('posts', 'PostsController');
    Route::post('ticket/reply/{ticket}','TicketController@reply')->name('ticket_reply');
    Route::resource('ticket', 'TicketController',['except' => 'reply']);
    Route::resource('screenshot','FileController');
    Route::post('vote', 'VoteController@store')->name('vote');
    Route::resource('navbar','NavbarController');
});

Route::get('{nav}', ['uses' => 'MainWebController@generate'])->name('nav');




