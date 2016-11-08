<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    /**
     * Sample Flash Message.
     * Generated using Laracast/Flash plugin
     * Use '->important()' if you want to add "x" button to your message.
     */
    flash('Hey There! This message is generated using Laracasts Flash Plugin','info')->important();
    return view('welcome');
});

Auth::routes();

//Facebook Login
Route::get('/auth/facebook', 'Auth\SocialController@redirectToProvider');
Route::get('/auth/facebook/callback', 'Auth\SocialController@handleProviderCallback');

Route::get('/home', 'HomeController@index');

//Admin Login
Route::get('admin/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'AdminAuth\LoginController@login');
Route::get('admin/logout', 'AdminAuth\LoginController@logout');

//Admin Register
Route::get('admin/register', 'AdminAuth\RegisterController@showRegistrationForm');
Route::post('admin/register', 'AdminAuth\RegisterController@register');

//Admin Passwords
Route::post('admin/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
Route::post('admin/password/reset', 'AdminAuth\ResetPasswordController@reset');
Route::get('admin/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
Route::get('admin/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');


Route::get('imageupload',function(){
    return view('imageUpload') ;
});

Route::post('image/upload','ImagesController@store');

Route::get('test',function(){
    Storage::disk('local')->put('file.txt', 'Contents');
    return asset('storage/file.txt');
});