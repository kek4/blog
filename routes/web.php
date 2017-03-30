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

Auth::routes();

Route::get('/home', 'HomeController@index');




Route::group(['prefix' => 'admin'], function(){
   Route::get('/', 'ArticleController@index')->name('article.index');
   Route::get('/create-article', 'ArticleController@create');
   Route::post('/create-article', 'ArticleController@store');
   // Route::any('/update-article/{id}', 'ArticleController@update')->name('article.edit');
   Route::get('/delete/{id}', 'ArticleController@delete')->name('article.delete');
});
