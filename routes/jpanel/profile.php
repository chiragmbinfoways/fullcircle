<?php

use Illuminate\Support\Facades\Route;
Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', 'App\Http\Controllers\Jpanel\ProfileController@index')->name('profile');
    Route::post('/update-profile', 'App\Http\Controllers\Jpanel\ProfileController@profileUpdate')->name('profile.update');
    Route::put('/update-image-profile', 'App\Http\Controllers\Jpanel\ProfileController@profileImageUpdate')->name('profile.image.update');
    Route::post('/update-password', 'App\Http\Controllers\Jpanel\ProfileController@passwordUpdate')->name('password.update');
});