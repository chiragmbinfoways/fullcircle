<?php

use App\Http\Controllers\Jpanel\services\ServiceController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/service/list', [ServiceController::class,'index'])->name('list.services');
    Route::get('/service/create', [ServiceController::class,'create'])->name('create.services');
    Route::post('/service/store', [ServiceController::class,'store'])->name('store.services');
    Route::get('/service/edit/{id}', [ServiceController::class,'edit'])->name('edit.services');
    Route::post('/service/status', [ServiceController::class,'statusUpdate'])->name('status.change.services');
    Route::post('/service/delete', [ServiceController::class,'delete'])->name('delete.services');
    Route::post('/service/update/{id}', [ServiceController::class,'update'])->name('update.services');
});