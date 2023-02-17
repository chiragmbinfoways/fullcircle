<?php

use App\Http\Controllers\Jpanel\report\ReportController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/report/branch', [ReportController::class,'branch'])->name('report.branch');
    Route::get('/report/trainer', [ReportController::class,'trainer'])->name('report.trainer');
    Route::post('/report/branchFilter', [ReportController::class,'branchFilter'])->name('report.branchFilter');
    Route::post('/report/trainerFilter', [ReportController::class,'trainerFilter'])->name('report.trainerFilter');
    Route::get('/report/customer', [ReportController::class,'customer'])->name('report.customer');
    Route::post('/report/customerFilter', [ReportController::class,'customerFilter'])->name('report.customerFilter');




});