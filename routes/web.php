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
Route::get('/admin', function () {
    return view('auth.login');
});

//Ingredients


Route::group(['prefix' => 'admin'
// ,  'middleware' => 'auth'
], function()
{

   Route::group(['prefix' => 'post','as'=>'post.'], function()
      {

      Route::get('/index', 'PostController@index')->name('index');
      Route::get('/create', 'PostController@create')->name('create');
      Route::get('/posts', 'PostController@posts')->name('posts');
      Route::post('/store', 'PostController@store')->name('store');
      Route::get('/single/{id}', 'PostController@single')->name('single');
      Route::get('/delete/{id}', 'PostController@delete')->name('delete');
      Route::get('/available/{id}', 'PostController@available')->name('available');
   });
   //Liste Ingredients
   Route::group(['prefix' => 'list-ingredient','as'=>'list-ingredient.'], function(){
      Route::get('/listIng-listJson', 'ListIngController@listJson')->name('listJson');
      Route::get('/index', 'ListIngController@index')->name('index');
   });
});


Auth::routes();
