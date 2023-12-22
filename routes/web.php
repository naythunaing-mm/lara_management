<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Department\departmentController;
use App\Http\Controllers\Employee\employeeController;
use App\Http\Controllers\Home\indexContoller;
use App\Http\Controllers\Setting\settingController;
use App\Http\Controllers\View\viewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin-backend')->group(function () {
    Route::get('login', [LoginController::class, 'getLogin']);
    Route::get('logout', [LoginController::class,'getLogout'])->name('logout');
    Route::post('login', [LoginController::class, 'postLogin'])->name('postLogin');
});

Route::group(['prefix' => 'admin-backend', 'middleware' => 'admin'], function () {
    Route::get('index', [indexContoller::class,'Index'])->name('index');

    // view route
    Route::prefix('view')->group(function () {
        Route::get('form', [viewController::class,'viewForm'])->name('viewForm');
        Route::get('edit/{id}', [viewController::class,'editForm']);
        Route::get('delete/{id}', [viewController::class,'viewDelete']);
        Route::get('viewListing', [viewController::class,'viewListing'])->name('viewListing');
        Route::post('viewStore', [viewController::class,'viewStore'])->name('viewStore');
        Route::post('viewUpdate', [viewController::class,'viewUpdate'])->name('viewUpdate');
    });

    // Employee Route
    Route::prefix('employee')->group(function () {
        Route::get('form', [employeeController::class,'employeeForm'])->name('employeeForm');
        Route::get('edit/{id}', [employeeController::class,'editForm']);
        Route::get('employeeListing', [employeeController::class,'employeeListing'])->name('employeeListing');
        Route::get('detail/{id}', [employeeController::class, 'employeeDetail'])->name('employeeDetail');
        Route::get('delete/{id}', [employeeController::class, 'employeeDelete'])->name('employeeDelete');
        Route::post('employeeUpdate', [employeeController::class,'employeeUpdate'])->name('employeeUpdate');
        Route::post('employeeStore', [employeeController::class,'employeeStore'])->name('employeeStore');
    });

    // Department Route
    Route::prefix('department')->group(function () {
        Route::get('form', [departmentController::class,'departmentForm'])->name('departmentForm');
        Route::get('edit/{id}', [departmentController::class,'editForm']);
        Route::get('delete/{id}', [departmentController::class, 'departmentDelete']);
        Route::get('departmentListing', [departmentController::class,'departmentListing'])->name('departmentListing');
        Route::post('departmentUpdate', [departmentController::class,'departmentUpdate'])->name('departmentUpdate');
        Route::post('departmentStore', [departmentController::class,'departmentStore'])->name('departmentStore');
    });

    // Setting Route
    Route::prefix('setting')->group(function () {
        Route::get('edit', [settingController::class, 'editForm'])->name('siteSetting');
        Route::post('settingUpdate', [settingController::class, 'settingUpdate'])->name('settingUpdate');
    });
});
