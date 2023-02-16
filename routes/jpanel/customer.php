<?php

use App\Http\Controllers\Jpanel\customer\CustomerController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/customer/list', [CustomerController::class,'index'])->name('list.customer');
    Route::get('/customer/create', [CustomerController::class,'create'])->name('create.customer');
    Route::post('/customer/store', [CustomerController::class,'store'])->name('store.customer');
    Route::get('/customer/edit/{id}', [CustomerController::class,'edit'])->name('edit.customer');
    Route::post('/customer/delete', [CustomerController::class,'delete'])->name('delete.customer');
    Route::post('/customer/update/{id}', [CustomerController::class,'update'])->name('update.customer');
    Route::post('/customer/status', [CustomerController::class,'statusUpdate'])->name('status.change.customer');
    Route::get('/customer/package/{id}', [CustomerController::class,'packageSelector'])->name('package.customer');
    Route::post('/customer/store/package/{id}', [CustomerController::class,'storePackage'])->name('store.customerPackage');
    Route::post('/customer/package/status', [CustomerController::class,'customerStatusUpdate'])->name('status.change.customerPackage');
    Route::post('/customer/visited/status', [CustomerController::class,'appointmentStatusUpdate'])->name('status.appointment.change');
    Route::get('/customer/package/extrasession/{id}', [CustomerController::class,'extraPackage'])->name('package.extrasession.customer');
    Route::get('/customer/branch/package', [CustomerController::class,'branchPackages'])->name('branch.packages');

});