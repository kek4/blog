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

//Ingredients


   Route::get('/create', 'PostController@create')->name('create');
   Route::get('/index', 'PostController@index')->name('index');
   Route::get('/store', 'PostController@store')->name('store');
   Route::get('/single/{id}', 'PostController@single')->name('single');
   Route::get('/delete/{id}', 'PostController@delete')->name('delete');
   Route::get('/available/{id}', 'PostController@available')->name('available');
   Route::group(['prefix' => 'ingredient'], function(){
      // Route::get('/list', 'BookController@toList')->name('book.list');
      Route::get('/ingredient-listJson', 'IngredientController@listJson')->name('ingredient.listJson');
      Route::any('/store', 'IngredientController@store')->name('ingredient.store');
      // Route::get('/delete/{book}', 'BookController@delete')->name('book.delete');
      // Route::any('/viewed/{book}', 'BookController@viewed')->name('book.viewed');
   });

      //Liste Ingredients
   Route::group(['prefix' => 'list-ingredient'], function(){
      Route::get('/listIng-listJson', 'ListIngController@listJson')->name('list-ingredient.listJson');
      Route::post('/store', 'ListIngController@store')->name('list-ingredient.store');
   });


Route::get('home', 'PostController@index');

// Route::resource('admin', 'PostController');

Auth::routes();
