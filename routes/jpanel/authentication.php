<?php
use Illuminate\Support\Facades\Route;

// -----------------------------login-----------------------------------------
Route::get('/login', 'App\Http\Controllers\Jpanel\Auth\AuthController@index')->name('login');
Route::post('/post-login', 'App\Http\Controllers\Jpanel\Auth\AuthController@postLogin')->name('login.post');
Route::get('/logout', '\App\Http\Controllers\Jpanel\Auth\AuthController@logout')->name('logout');
// // -----------------------------forget password-----------------------------------------
Route::get('/forgot-password', 'App\Http\Controllers\Jpanel\Auth\ForgotPasswordController@index')->name('forgotPassword');
Route::post('/post-forgot-password', 'App\Http\Controllers\Jpanel\Auth\ForgotPasswordController@forgotPasswordPost')->name('forgotPassword.post');
// // -----------------------------reset password-----------------------------------------
 Route::get('/reset-password/{token}', 'App\Http\Controllers\Jpanel\Auth\ResetPasswordController@index')->name('resetPassword');
 Route::post('/post-reset-password', 'App\Http\Controllers\Jpanel\Auth\ResetPasswordController@resetPasswordPost')->name('resetPassword.post');