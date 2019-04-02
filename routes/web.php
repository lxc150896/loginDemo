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

Route::group(['namespace' => 'User'], function () {
    Route::get('register', 'HomeController@getRegisterUser')->name('register');
    Route::post('register', 'HomeController@postRegisterUser');
    Route::group(['prefix' => 'login', 'middleware' => 'CheckLogedIn'], function () {
        Route::get('/', 'LoginController@getLogin')->name('login');
        Route::post('/', 'LoginController@postLogin');
    });
    Route::get('logout', 'HomeController@getLogout');
    Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogedOut'], function() {
        Route::get('home', 'HomeController@getHome');
        Route::get('home/user', 'HomeController@getUser')->name('user');
        Route::post('home/add', 'UserController@postAddUser')->name('addUser');
        Route::put('home/update/{id}', 'UserController@postEditUser')->name('editUser');
        Route::delete('home/delete/{id}', 'UserController@postDeleteUser')->name('deleteUser');
    });
});
