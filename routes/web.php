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

Route::get('/404', function () {
    abort(404);
});

Auth::routes();

Route::get('/verify/token/{token}', 'Auth\VerificationController@verify')->name('auth.verify');
Route::get('/verify/resend', 'Auth\VerificationController@resend')->name('auth.verify.resend');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/plan', 'PlanmanageController@index')->name('plan');
Route::get('/billing', 'BillingmanageController@index')->name('billing');


Route::get('/invite', 'InvitemanageController@index')->name('invite');
Route::post('/invite/add', 'InvitemanageController@add')->name('invite/add');
Route::get('/invite/token/{inviteURI}', 'InvitemanageController@connect');
Route::get('/invite/delete', 'InvitemanageController@remove');


Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/cate/{category}/{userId}/{categoryId}', 'CategoryController@view');
Route::get('/category_manage', 'CategoryController@category_manage')->name('category_manage');
Route::post('/category_manage/add', 'CategoryController@category_manage_add');
Route::get('/category_manage/delete', 'CategoryController@category_manage_remove');
Route::get('/category_manage/getCategory', 'CategoryController@category_manage_get');


Route::get('/subpage/edit/{category_id}/{id?}', 'SubpageController@index')->name('subpage');
Route::post('/subpage/add', 'SubpageController@add');
Route::get('/subpage/delete/{id}', 'SubpageController@remove');
Route::get('/subpage/view/{id}', 'SubpageController@view');


Route::get('/user', 'UsermanageController@index')->name('user');
Route::post('/usermanage/add', 'UsermanageController@add');
Route::get('/usermanage/delete', 'UsermanageController@remove');
Route::get('/usermanage/getUser', 'UsermanageController@getUser');

Route::get('/profile', 'ProfilemanageController@index')->name('profile');
Route::post('/profile/edit', 'ProfilemanageController@edit');
Route::get('/profile/checkPwd', 'ProfilemanageController@checkPwd');