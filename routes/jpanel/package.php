<?php

use App\Http\Controllers\Jpanel\package\PackageController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/package/list', [PackageController::class,'index'])->name('list.package');
    Route::get('/package/create', [PackageController::class,'create'])->name('create.package');
    Route::post('/package/store', [PackageController::class,'store'])->name('store.package');
    Route::get('/package/edit/{id}', [PackageController::class,'edit'])->name('edit.package');
    Route::post('/package/delete', [PackageController::class,'delete'])->name('delete.package');
    Route::post('/package/update/{id}', [PackageController::class,'update'])->name('update.package');
});