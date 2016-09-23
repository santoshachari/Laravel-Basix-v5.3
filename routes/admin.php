<?php
/**
 * All the Admin routes can be listed here.
 */

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    /* Note: The default guard assumed is 'admin'.
     * Hence to get the general user logged, one needs to
     * specify guard 'web' clearly.
     */
    $users[] = Auth::guard('web')->user();

    dd($users);
})->name('home');

