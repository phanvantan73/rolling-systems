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

Route::group(['prefix' => 'rolling-system'], function() {
    Route::get('login', 'Auth\LoginController@getLogin')->name('get_login');
    Route::post('login', 'Auth\LoginController@postLogin')->name('post_login');
    Route::post('logout', 'Auth\LoginController@logout')->name('post_logout');

    Route::group(['namespace' => 'Admin', 'middleware' => 'auth'], function() {
        Route::get('/', function () {
            return redirect()->route('home');
        });
        Route::get('home', 'HomeController@index')->name('home');
        Route::resource('staffs', 'UserController');
        Route::get('staff-profile', 'UserController@profile')->name('staffs.profile');
        Route::post('staff-profile', 'UserController@updateProfile')->name('staffs.update_profile');
        Route::get('staff-export', 'UserController@export')->name('staffs.export');
        Route::get('staff-diaries-export/{id}', 'UserController@staffExport')->name('staffs.diaries_export');
    });
});
