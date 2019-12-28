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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/', 'TopController@index');
// Route::get('/', function () {
//   return view('test');
// });



Route::group(['middleware' => 'auth'], function() {
  Route::resource('users', 'UserController');
  Route::resource('users.contents', 'ContentController');
  Route::get('/users/{user}/contents/{content}/delete', 'ContentController@delete');
});

Route::get('/ajax/get_json', function(){ return view('develop.ajax_get_json'); });
Route::get('/api/ajax/get_json', 'UranaiController@ajax_get_json');