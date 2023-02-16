<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jpanel\User\RoleController;
use App\Http\Controllers\Jpanel\User\UserController;
use App\Http\Controllers\Jpanel\User\LanguageController;
use App\Http\Controllers\Jpanel\User\ModuleController;

Route::group(['middleware' => ['auth']], function () {

    // -------------------- Users --------------------------------------------------
    Route::get('/users', [UserController::class, 'index'])->name('list.users');
    Route::get('/create-users', [UserController::class, 'createUsers'])->name('create.users');
    Route::post('/add-users', [UserController::class, 'addUser'])->name('add.user');
    Route::get('/edit-user/{id}', [UserController::class, 'editUser'])->name('edit.user');
    Route::put('/update-user/{id}', [UserController::class, 'updateUser'])->name('update.user');
    Route::get('/view-user/{id}', [UserController::class, 'viewUser'])->name('view.user');
    Route::post('/user-status-change', [UserController::class, 'userStatusChange'])->name('status.change.user');
    Route::post('/user-delete', [UserController::class, 'userDelete'])->name('user.delete');


    // -------------------- Role --------------------------------------------------
    Route::get('/role', [RoleController::class, 'index'])->name('list.role');
    Route::post('/add-role', [RoleController::class, 'addRole'])->name('add.role');
    Route::get('/edit-role/{id}', [RoleController::class, 'editRole'])->name('edit.role');
    Route::put('/update-role/{id}', [RoleController::class, 'updateRole'])->name('update.role');
    Route::post('/role-delete', [RoleController::class, 'roleDelete'])->name('role.delete');

    // -------------------- Language --------------------------------------------------
    Route::get('/language', [LanguageController::class, 'index'])->name('list.language');
    Route::post('/add-language', [LanguageController::class, 'addLanguage'])->name('add.language');
    Route::get('/edit-language/{id}', [LanguageController::class, 'editLanguage'])->name('edit.language');
    Route::put('/update-language/{id}', [LanguageController::class, 'updateLanguage'])->name('update.language');
    Route::post('/language-delete', [LanguageController::class, 'languageDelete'])->name('language.delete');

    // -------------------- Permission --------------------------------------------------
    Route::get('/module', [ModuleController::class, 'index'])->name('list.module');
    Route::post('/add-module', [ModuleController::class, 'addModule'])->name('add.module');
    Route::get('/edit-module/{id}', [ModuleController::class, 'editModule'])->name('edit.module');
    Route::put('/update-module/{id}', [ModuleController::class, 'updateModule'])->name('update.module');
    Route::post('/module-delete', [ModuleController::class, 'moduleDelete'])->name('module.delete');

    // -------------------- Role Permission --------------------------------------------------
    Route::post('/role-module', [RoleController::class, 'roleModule'])->name('role.module');

    // -------------------- User Role --------------------------------------------------
    Route::post('/user-role', [UserController::class, 'userRole'])->name('user.role');

    // -------------------- User Module --------------------------------------------------
    Route::get('/user-permission/{id}', [UserController::class, 'userPermissions'])->name('user.permissions');
    Route::post('/user-permission-update', [UserController::class, 'userPermissionsUpdate'])->name('user.permissionsUpdate');
});
