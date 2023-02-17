<?php

use App\Http\Controllers\Jpanel\booking\BookingController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/booking/list', [BookingController::class,'index'])->name('list.booking');
    Route::get('/booking/create', [BookingController::class,'create'])->name('create.booking');
    Route::post('/booking/store', [BookingController::class,'store'])->name('store.booking');
    Route::get('/booking/package', [BookingController::class,'packageData'])->name('package.data');
    Route::get('/booking/employee', [BookingController::class,'employeeData'])->name('employee.data');
    Route::get('/booking/customer', [BookingController::class,'customerData'])->name('customer.data');
    Route::get('/booking/slot', [BookingController::class,'slotData'])->name('slot.data');
    Route::post('/booking/payment/status', [BookingController::class,'PaymentStatus'])->name('status.change.payment');
    Route::post('/booking/work/status', [BookingController::class,'workStatus'])->name('status.change.work');
    Route::post('/booking/appointment/status', [BookingController::class,'appointmentStatus'])->name('status.change.appointment');
    Route::post('/booking/delete', [BookingController::class,'delete'])->name('delete.booking');
    Route::post('/task/delete', [BookingController::class,'taskdelete'])->name('delete.task');
                                        // tasks 
    Route::get('/task', [BookingController::class,'task'])->name('list.task');
});