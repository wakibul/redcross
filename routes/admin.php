<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');

Route::get('/users', [
    'as' => 'users',
    'middleware' => ['admin'],
    'uses' => 'Admin\UserController@index',
]);

