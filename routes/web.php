<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {
//    return view('home');
//});

Route::get('/imageEditor', function () {
    return view('image/imageEditor');
});

Auth::routes();
Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@index');
Route::resource('image', 'ImageController');

Route::get('/contact', 'ContactController@create');
Route::post('/contact', 'ContactController@store');

Route::get('/profiel', 'ProfileController@edit');
Route::put('/profiel/updaten', 'ProfileController@update');

Route::get('/header', 'HeaderController@edit');
Route::post('header/updaten', 'HeaderController@update');

Route::get('/home', 'HomeController@index');
Route::get('/{username}', 'HomeController@profile');


Route::get('avatar/{username}', 'ProfileController@avatar_show');
Route::post('avatar/{username}', 'ProfileController@avatar_update');

Route::get('category/{id}/edit', 'CategoryController@edit');
Route::put('category/update', 'CategoryController@update');
Route::delete('category/{id}', 'CategoryController@delete');

Route::post('/parentcomment', 'ParentcommentController@store');


