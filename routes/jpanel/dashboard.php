<?php

use App\Http\Controllers\Jpanel\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/admin-settings', [DashboardController::class,'adminSettings'])->name('admin.settings');
    Route::get('/dashboard/booking/package', [DashboardController::class,'packageData'])->name('dashboard.package.data');
    Route::get('/dashboard/booking/employee', [DashboardController::class,'employeeData'])->name('dashboard.employee.data'); // Ajax request
    Route::get('/dashboard/booking/branch', [DashboardController::class,'branchData'])->name('dashboard.branch.data'); // Ajax request
    Route::post('/booking/store/dashboard', [DashboardController::class,'store'])->name('store.booking.dashboard');
    Route::get('/dashboard/booking/edit/{id}', [DashboardController::class,'edit'])->name('edit.booking.dashboard');
    Route::post('/dashboard/booking/update/{id}', [DashboardController::class,'update'])->name('update.booking.employee'); // update page post request
    Route::post('/booking/delete/dashboard', [DashboardController::class,'delete'])->name('delete.booking.dashboard');
    Route::post('/booking/update/dashboard', [DashboardController::class,'dragUpdate'])->name('dragupdate.booking.dashboard'); // Drag Update 
});
