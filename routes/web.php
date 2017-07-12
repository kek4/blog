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

Route::group(['prefix' => 'admin'], function(){
   Route::get('create',function () {
       return view('posts.new');
   });
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
});

Route::get('home', 'PostController@index');

Route::resource('admin', 'PostController');

Auth::routes();
