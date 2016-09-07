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
