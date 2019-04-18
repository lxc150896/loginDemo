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
Route::get('/chat', 'ChatController@getChat');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contacts', 'ChatController@getContact');
Route::get('/avatars', 'ChatController@getAvatar');
Route::get('/conversation/{id}', 'ChatController@getMessagesFor');
Route::post('/conversation/send', 'ChatController@send');
Route::get('home/user', 'HomeController@getUser');
Route::group(['namespace' => 'User'], function () {
    Route::group(['prefix' => 'admin'], function() {
        Route::post('home/add', 'UserController@postAddUser')->name('addUser');
        Route::put('home/update/{id}', 'UserController@postEditUser')->name('editUser');
        Route::delete('home/delete/{id}', 'UserController@postDeleteUser')->name('deleteUser');
        Route::get('home/avatar/{id}', 'UserController@getAvatar');
        Route::post('search/user', 'UserController@searchUser');
 });
    Route::resource('groups', 'GroupController');
});
Route::resource('conversations', 'ConversationController');
