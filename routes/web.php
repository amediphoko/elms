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

Route::get('/', 'PagesController@index')->name('home');

Route::get('/leave/{status}', 'LeavesController@status')->name('leaves.status-index');
Route::resource('leaves', 'LeavesController');

Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');


Route::resource('departments', 'DepartmentsController');
Route::resource('leavetype', 'LeaveTypeController');
Route::resource('leavedays', 'LeaveDaysController');

Auth::routes();

Route::get('/manage', 'PrincipalAdminController@manage')->name('user.profile.manage');
Route::get('/users/{id}/edit', 'PrincipalAdminController@edit')->name('user.profile.edit');
Route::put('/update_profile/{id}', 'PrincipalAdminController@update_profile');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('/applications', 'DashboardController@showApplications')->name('user.applications');
Route::get('/approved', 'DashboardController@showApproved')->name('user.approved');
Route::get('/rejected', 'DashboardController@showRejected')->name('user.rejected');
Route::get('/profile/{id}', 'DashboardController@profile')->name('user.profile');
Route::put('/profile/image/{id}', 'DashboardController@img_update')->name('user.image.update');
Route::get('/change_pass/{id}', 'DashboardController@change_pass');
Route::put('/change_password/{id}', 'DashboardController@change_password');

Route::get('/manage', 'PrincipalAdminController@manage');
Route::get('staff/dalete/{id}', 'PrincipalAdminController@destroy');

Route::get('/dashboard/admin', 'AdminController@index')->name('dashboard.admin');

Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});

Route::prefix('principaladmin')->group(function(){
    Route::get('/login', 'Auth\PrincipalAdminLoginController@showLoginForm')->name('principaladmin.login');
    Route::post('/login', 'Auth\PrincipalAdminLoginController@login')->name('principaladmin.login.submit');
    Route::get('/', 'PrincipalAdminController@index')->name('principaladmin.dashboard');
    Route::get('/logout', 'Auth\PrincipalAdminLoginController@logout')->name('principaladmin.logout');
});
