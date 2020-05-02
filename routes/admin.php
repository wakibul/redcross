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

Route::get('/approved-members', [
    'as' => 'approved_members',
    'middleware' => ['admin'],
    'uses' => 'Admin\MemberController@approved',
]);

Route::get('/pending-members', [
    'as' => 'pending_members',
    'middleware' => ['admin'],
    'uses' => 'Admin\MemberController@pending',
]);

Route::get('/approve/{id}', [
    'as' => 'approve',
    'middleware' => ['admin'],
    'uses' => 'Admin\MemberController@approveMember',
]);

Route::get('/delete/{id}', [
    'as' => 'delete',
    'middleware' => ['admin'],
    'uses' => 'Admin\MemberController@destroy',
]);

Route::get('/cancel/{id}', [
    'as' => 'cancel',
    'middleware' => ['admin'],
    'uses' => 'Admin\MemberController@cancelMember',
]);


Route::post('/get-member-info', [
    'as' => 'get_member_info',
    'middleware' => ['admin'],
    'uses' => 'Admin\MemberController@ajaxInfo',
]);
Route::group(['prefix' => 'help'], function () {
    Route::get('/open', [
        'as' => 'help.open',
        'middleware' => ['admin'],
        'uses' => 'Admin\HelpController@openHelp',
    ]);

    Route::get('/close', [
        'as' => 'help.close',
        'middleware' => ['admin'],
        'uses' => 'Admin\HelpController@closeHelp',
    ]);
    Route::post('/get-help-info', [
        'as' => 'help.get_help_info',
        'middleware' => ['admin'],
        'uses' => 'Admin\HelpController@ajaxInfo',
    ]);
    Route::get('/close-issue/{id}', [
        'as' => 'help.close_issue',
        'middleware' => ['admin'],
        'uses' => 'Admin\HelpController@closeIssue',
    ]);

    Route::get('/delete-issue/{id}', [
        'as' => 'help.delete',
        'middleware' => ['admin'],
        'uses' => 'Admin\HelpController@destroy',
    ]);

    Route::post('/status/update', [
        'as' => 'help.status.update',
        'middleware' => ['admin'],
        'uses' => 'Admin\HelpController@update',
    ]);

    Route::get('/pdf/{id}', [
        'as' => 'help.pdf',
        'middleware' => ['admin'],
        'uses' => 'Admin\HelpController@pdf',
    ]);
});  

Route::group(['prefix' => 'donation'], function () {
    Route::get('/index', [
        'as' => 'donation.index',
        'middleware' => ['admin'],
        'uses' => 'Admin\DonationController@index',
    ]);
    Route::post('/get-donation-info', [
        'as' => 'donation.get_donation_info',
        'middleware' => ['admin'],
        'uses' => 'Admin\DonationController@ajaxInfo',
    ]);

    Route::get('/delete/{id}', [
        'as' => 'donation.delete',
        'middleware' => ['admin'],
        'uses' => 'Admin\DonationController@destroy',
    ]);

    
});    

