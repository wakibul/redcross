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

Route::get('/member/pdf/{id}', [
    'as' => 'member.pdf',
    'middleware' => ['admin'],
    'uses' => 'Admin\MemberController@pdf',
]);
Route::get('/member/export-excel-approve', [
    'as' => 'member.export_approve',
    'middleware' => ['admin'],
    'uses' => 'Admin\MemberController@excelApprove',
]);

Route::get('/member/export-excel-pending', [
    'as' => 'member.export_pending',
    'middleware' => ['admin'],
    'uses' => 'Admin\MemberController@excelPending',
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

    Route::get('/export-excel-open', [
        'as' => 'help.export_open',
        'middleware' => ['admin'],
        'uses' => 'Admin\HelpController@excelOpen',
    ]);
    Route::get('/export-excel-close', [
        'as' => 'help.export_close',
        'middleware' => ['admin'],
        'uses' => 'Admin\HelpController@excelClose',
    ]);
});  

Route::group(['prefix' => 'donation'], function () {
    Route::get('/cash-donation', [
        'as' => 'donation.cash_donation',
        'middleware' => ['admin'],
        'uses' => 'Admin\DonationController@cashDonation',
    ]);
    Route::post('/get_donation_info', [
        'as' => 'donation.get_donation_info',
        'middleware' => ['admin'],
        'uses' => 'Admin\DonationController@ajaxInfo',
    ]);

    Route::get('/delete/{id}', [
        'as' => 'donation.delete',
        'middleware' => ['admin'],
        'uses' => 'Admin\DonationController@destroy',
    ]);
    Route::get('/blood-donation', [
        'as' => 'donation.blood_donation',
        'middleware' => ['admin'],
        'uses' => 'Admin\DonationController@bloodDonation',
    ]);

    Route::get('/pdf/{id}', [
        'as' => 'donation.pdf',
        'middleware' => ['admin'],
        'uses' => 'Admin\DonationController@pdf',
    ]);

    Route::get('/cash-pdf/{id}', [
        'as' => 'donation.cash_pdf',
        'middleware' => ['admin'],
        'uses' => 'Admin\DonationController@cashPdf',
    ]);

    Route::get('/export-donation', [
        'as' => 'donation.export_donation',
        'middleware' => ['admin'],
        'uses' => 'Admin\DonationController@exportDonation',
    ]);

    Route::get('/export-blood-donation', [
        'as' => 'donation.export_blood_donation',
        'middleware' => ['admin'],
        'uses' => 'Admin\DonationController@exportBloodDonation',
    ]);
});    

