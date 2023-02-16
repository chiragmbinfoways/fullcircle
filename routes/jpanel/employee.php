<?php

use App\Http\Controllers\Jpanel\employee\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/employee/list', [EmployeeController::class,'index'])->name('list.employee');
    Route::get('/employee/create', [EmployeeController::class,'create'])->name('create.employee');
    Route::post('/employee/store', [EmployeeController::class,'store'])->name('store.employee');
    Route::get('/employee/edit/{id}', [EmployeeController::class,'edit'])->name('edit.employee');
    Route::post('/employee/status', [EmployeeController::class,'statusUpdate'])->name('status.change.employee');
    Route::post('/employee/delete', [EmployeeController::class,'delete'])->name('delete.employee');
    Route::post('/employee/update/{id}', [EmployeeController::class,'update'])->name('update.employee');
    Route::get('/employee/availability/{id}', [EmployeeController::class,'availability'])->name('availability.employee');
    Route::post('/employee/availability/store/{id}', [EmployeeController::class,'storeAvailability'])->name('store.availability');
    Route::post('/employee/availability/delete', [EmployeeController::class,'deleteAvl'])->name('delete.availability');
});