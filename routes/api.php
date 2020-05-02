<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', 'Api\RegisterController@register');
Route::post('/verify', 'Api\RegisterController@verify');
Route::post('/login', 'Api\RegisterController@login');
Route::post('/resend-otp', 'Api\RegisterController@resendOtp');
Route::post('/forgot-password', 'Api\ForgotPasswordController@index');
Route::post('/validate-otp', 'Api\ForgotPasswordController@validateOtp');
Route::post('/change-password', 'Api\ForgotPasswordController@changePassword');
Route::post('/forgot-resend-otp', 'Api\ForgotPasswordController@resendOtp');
Route::get('/pages', 'Api\PageController@index');
Route::middleware('auth:api')->group(function(){
    Route::post('/member-store', 'Api\MemberController@store');
    Route::get('/check-member', 'Api\MemberController@checkMember');
    Route::get('/member-package', 'Api\MemberPackageController@index');
    Route::post('/help-store', 'Api\HelpController@store');
    Route::get('/country-list', 'Api\CountryController@index');
    Route::post('/donation-store', 'Api\DonationController@store');
    Route::get('/help-list', 'Api\HelpController@index');
    Route::get('/donation-list', 'Api\DonationController@index');
});