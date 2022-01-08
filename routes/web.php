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
    return view('auth.login');
});

Route::group(['prefix' => 'admin' , 'middleware' => 'admin'], function(){ //管理者
    Route::get('home','Admin\AttendanceController@home')->name('admin_home');
    Route::get('site/new','Admin\AttendanceController@add_new_site')->name('new_site');
    Route::post('site/new','Admin\AttendanceController@new_site');
    Route::get('sites','Admin\AttendanceController@sites')->name('admin_sites');
    Route::get('site/edit','Admin\AttendanceController@edit_site');
    Route::post('site/edit','Admin\AttendanceController@update_site');
    Route::get('site/delete','Admin\AttendanceController@delete_site');
    Route::get('user/new','Admin\AttendanceController@add_new_user')->name('new_user');
    Route::post('user/new','Admin\AttendanceController@new_user');
    Route::get('users','Admin\AttendanceController@users')->name('users');
    Route::get('user/edit','Admin\AttendanceController@edit_user')->name('addmin_edit_user');
    Route::post('user/edit','Admin\AttendanceController@update_user');
    Route::get('user/delete','Admin\AttendanceController@delete_user');
    Route::get('attendancerecord/new', 'Admin\AttendanceController@add_new_attendancerecord')->name('new');
    Route::post('attendancerecord/new','Admin\AttendanceController@new_attendancerecord');
    Route::get('attendancerecords','Admin\AttendanceController@attendancerecords')->name('admin_attendancerecords');
    Route::get('attendancerecord/edit','Admin\AttendanceController@edit_attendancerecord')->name('admin_edit_attendancerecord');
    Route::post('attendancerecord/edit','Admin\AttendanceController@update_attendancerecord');
    Route::get('attendancerecord/delete','Admin\AttendanceController@delete_attendancerecord');
    Route::get('user/import','Admin\AttendanceController@add_import_user')->name('import_user');
    Route::post('user/import','Admin\AttendanceController@import_user');
    //Route::get('user/import/check','Admin\AttendanceController@add_import_user_check');
    Route::post('user/import/check','Admin\AttendanceController@import_user_check');
    Route::get('attendancerecord/approval','Admin\AttendanceController@approval_check');
    Route::post('attendancerecord/approval','Admin\AttendanceController@approval');
    
});
//従業員
Route::group(['prefix' => 'user' , 'middleware' => 'auth'], function(){
    Route::get('home','AttendanceController@home')->name('user_home');
    Route::get('edit','AttendanceController@edit_user')->name('edit_user');
    Route::post('edit','AttendanceController@update_user');
});



Route::group(['middleware' => 'auth'], function(){
    Route::get('/attendancerecord/new','AttendanceController@add_new_attendancerecord')->name('user_new_attendancerecord');
    Route::post('/attendancerecord/new','AttendanceController@new_attendancerecord');
    Route::get('/attendancerecord/edit','AttendanceController@edit_attendancerecord');
    Route::post('/attendancerecord/edit','AttendanceController@update_attendancerecord');
    Route::get('/attendancerecords','AttendanceController@attendancerecords')->name('user_attendancerecords');
    Route::get('/sites','AttendanceController@sites')->name('user_sites');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

