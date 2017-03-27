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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'MainWebController@index')->name('index');
Route::get('/start', 'MainWebController@start')->name('start');
Route::get('/faq', 'MainWebController@faq')->name('faq');
Route::get('/donate', 'MainWebController@donate')->name('donate');
Route::get('/rules', 'MainWebController@rules')->name('rules');


//Route::get('/posts/create', 'PostsController@create')->middleware('auth', 'admin');
Route::resource('/posts', 'PostsController', ['middleware' => ['auth', 'admin']]);
Route::post('/ticket/reply/{id}','TicketController@reply');
Route::resource('/ticket', 'TicketController',['except' => 'reply']);
Route::resource('/screenshot','FileController');


//Route::get('/posts/create', 'PostsController@create', ['middleware' => ['auth', 'admin']]);
//Route::resource('/posts/create', 'PostsController@create')->middleware('auth', 'admin');
//Route::post('/posts/create', 'PostsController@create')->middleware('auth', 'admin');
/*
Route::get('check/{id}', function($id)
{
    return 'User '.$id;
});
*/
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

//Route::get('/posts/create','PostsController@create')->middleware('auth');


