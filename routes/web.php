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



Route::group(['middleware' => 'auth'], function() {
  Route::resource('users', 'UserController');
  Route::resource('users.contents', 'ContentController');
  Route::get('/users/{user}/contents/{content}/delete', 'ContentController@delete');
});

Route::get('/ajax/get_json', function(){ return view('develop.ajax_get_json'); });
Route::get('/api/ajax/get_json', 'UranaiController@ajax_get_json');
Route::post('/api/ajax/get_uranai', 'UranaiController@ajax_get_uranai');
Route::post('/api/ajax/make_graph', 'UranaiController@ajax_post_json');
Route::get('/api/ajax/graph', 'UranaiController@ajax_graph_json');
Route::post('/api/ajax/new_content', 'ContentController@ajax_new_content_json');
Route::get('/api/ajax/get_user', 'UserController@ajax_get_user');
Route::get('/api/ajax/get_edit_content', 'ContentController@ajax_get_content_json');
Route::post('/api/ajax/edit_content', 'ContentController@ajax_edit_content_json');
