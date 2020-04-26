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
