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

Route::group(['prefix' => 'dashboard', 'middleware' => 'admin'], function() {
    Route::get('','DashboardController@index')->name('dashboard');
    Route::resource('users', 'UserController');
    Route::resource('tickets','TicketController', ['except' => 'reply']);
    Route::resource('screenshots','FileController');
    Route::get('cms','CmsController@index')->name('cms');
    Route::resource('posts', 'PostsController');
    Route::resource('navbar','NavbarController');
    Route::put('notification', 'NotificationController@update')->name('notification.update');
    Route::get('notification','NotificationController@index')->name('notification.index');
});

Route::group(['prefix' => 'home'], function() {
    Route::get('', 'HomeController@index')->name('home');
    Route::post('ticket/reply/{ticket}','TicketController@reply')->name('ticket_reply');
    Route::resource('ticket', 'TicketController',['except' => 'reply']);
    Route::resource('screenshot','FileController');
    Route::post('vote', 'VoteController@store')->name('vote');

});

Route::get('/', 'MainWebController@index')->name('index');

Auth::routes();

Route::get('{nav}', ['uses' => 'MainWebController@generate'])->name('nav');

