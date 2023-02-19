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

Auth::routes();

Route::get('/verify/token/{token}', 'Auth\VerificationController@verify')->name('auth.verify');
Route::get('/verify/resend', 'Auth\VerificationController@resend')->name('auth.verify.resend');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/plan', 'PlanmanageController@index')->name('plan');
Route::get('/billing', 'BillingmanageController@index')->name('billing');
Route::get('/category', 'CategoryController@index')->name('category');


Route::get('/subpage/{id?}', 'SubpageController@index')->name('subpage');
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