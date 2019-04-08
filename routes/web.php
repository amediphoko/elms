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

Route::get('/', 'PagesController@index');

Route::get('/leave/{status}', 'LeavesController@status')->name('leaves.status-index');
Route::resource('leaves', 'LeavesController');


Route::resource('departments', 'DepartmentsController');
Route::resource('leavetype', 'LeaveTypeController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('/applications', 'DashboardController@showApplications')->name('user.applications');
Route::get('/approved', 'DashboardController@showApproved')->name('user.approved');
Route::get('/rejected', 'DashboardController@showRejected')->name('user.rejected');
Route::get('/profile/{id}', 'DashboardController@profile')->name('user.profile');
Route::get('/change_pass/{id}', 'DashboardController@change_pass');
Route::put('/change_password/{id}', 'DashboardController@change_password');

Route::get('/dashboard/admin', 'AdminController@index')->name('dashboard.admin');
Route::get('/manage', 'AdminController@manage')->name('user.profile.manage');
Route::get('/users/{id}/edit', 'AdminController@edit')->name('user.profile.edit');
Route::put('/update_profile/{id}', 'AdminController@update_profile');

Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});
