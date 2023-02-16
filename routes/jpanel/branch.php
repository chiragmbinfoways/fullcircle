<?php

use App\Http\Controllers\Jpanel\branch\BranchController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/branch/list', [BranchController::class,'index'])->name('list.branch');
    Route::get('/branch/create', [BranchController::class,'create'])->name('create.branch');
    Route::post('/branch/store', [BranchController::class,'store'])->name('store.branch');
    Route::get('/branch/edit/{id}', [BranchController::class,'edit'])->name('edit.branch');
    Route::post('/branch/delete', [BranchController::class,'delete'])->name('delete.branch');
    Route::post('/branch/update/{id}', [BranchController::class,'update'])->name('update.branch');
});