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

Route::group(['prefix' => 'admin' , 'middleware' => 'auth'], function(){
   Route::get('attendancerecord/new', 'Admin\AttendanceController@add_new_attendancerecord');
   Route::get('site/new','Admin\AttendanceController@add_new_site')->name('new_site');
   Route::post('site/new','Admin\AttendanceController@new_site');
   Route::get('sites','Admin\AttendanceController@sites')->name('sites');
   Route::get('site/edit','Admin\AttendanceController@edit_site');
   Route::post('site/edit','Admin\AttendanceController@update_site');
   Route::get('site/delete','Admin\AttendanceController@delete_site');
   Route::get('user/new','Admin\AttendanceController@add_new_user')->name('new_user');
   Route::post('user/new','Admin\AttendanceController@new_user');
   Route::get('home','Admin\AttendanceController@home')->name('admin_home');
   Route::get('users','Admin\AttendanceController@users')->name('users');
   /*
   
   
   
   Route::post('user/edit','Admin\AttendanceController@edit_user');
   Route::post('attendancerecord/new','Admin\AttendanceController@new_attendancerecord');
   Route::get('attendancerecords','Admin\AttendanceController@attendancerecords');
   Route::post('attendancerecord/approval','Admin\AttendanceController@approval');
   */
});
/*
Route::group(['prefix' => 'user' , 'middleware' => 'auth'], function(){
    Route::get('home','AttendanceController@home');
    Route::post('edit','AttendanceController@edit_user');
});

Route::group(['prefix' => 'attendancerecord' , 'middleware' => 'auth'], function(){
    Route::post('new','AttendanceController@new_attendancerecord');
    Route::post('edit','AttendanceController@edit_attendancerecord');
});

Route::get('/attendancerecords','AttendanceController@attendancerecords');

Route::get('/sites','AttendanceController@sites');
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sites','AttendanceController@site');
