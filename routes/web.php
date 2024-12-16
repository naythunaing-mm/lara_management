<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\Home\indexContoller;
use App\Http\Controllers\Role\roleController;
use App\Http\Controllers\View\viewController;
use App\Http\Controllers\attendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Setting\settingController;
use App\Http\Controllers\Employee\employeeController;
use App\Http\Controllers\Department\departmentController;
use App\Http\Controllers\Permission\permissionController;

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
        Route::get('edit/{id}', [employeeController::class,'editForm'])->name('employeeEdit');
        Route::get('employeeListing', [employeeController::class,'employeeListing'])->name('employeeListing');
        Route::get('employee/employeeDataTable', [employeeController::class,'employeeDataTable'])->name('employeeDataTable');
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

    // Attendance Route
    Route::prefix('attendance')->group(function () {
        Route::get('form', [attendanceController::class, 'attendanceForm'])->name('attendanceForm');
        Route::get('edit/{id}', [attendanceController::class,'editForm']);
        Route::get('delete/{id}', [attendanceController::class, 'attendanceDelete']);
        Route::get('attendanceListing', [attendanceController::class,'attendanceListing'])->name('attendanceListing');
        Route::post('attendanceUpdate', [attendanceController::class,'attendanceUpdate'])->name('attendanceUpdate');
        Route::post('attendanceStore', [attendanceController::class,'attendanceStore'])->name('attendanceStore');
    });

    // Role Route
    Route::prefix('role')->group(function () {
        Route::get('form', [roleController::class,'roleForm'])->name('roleForm');
        Route::get('edit/{id}', [roleController::class,'editForm'])->name('roleEdit');
        Route::get('delete/{id}', [roleController::class, 'roleDelete'])->name('roleDelete');
        Route::get('roleDataTable', [roleController::class, 'roleDatatableListing'])->name('roleDatatableListing');
        Route::get('roleListing', [roleController::class,'roleListing'])->name('roleListing');
        Route::post('roleUpdate', [roleController::class,'roleUpdate'])->name('roleUpdate');
        Route::post('roleStore', [roleController::class,'roleStore'])->name('roleStore');
    });

    // Permission Route
    Route::prefix('permission')->group(function () {
        Route::get('form', [permissionController::class,'permissionForm'])->name('permissionForm');
        Route::get('edit/{id}', [permissionController::class,'editForm']);
        Route::get('delete/{id}', [permissionController::class, 'permissionDelete']);
        Route::get('permissionListing', [permissionController::class,'permissionListing'])->name('permissionListing');
        Route::post('permissionUpdate', [permissionController::class,'permissionUpdate'])->name('permissionUpdate');
        Route::post('permissionStore', [permissionController::class,'permissionStore'])->name('permissionStore');
    });

    // Setting Route
    Route::prefix('setting')->group(function () {
        Route::get('edit', [settingController::class, 'editForm'])->name('siteSetting');
        Route::post('settingUpdate', [settingController::class, 'settingUpdate'])->name('settingUpdate');
    });

    //QR Genereater
    Route::get('/checkin/{id}', [QrCodeController::class, 'QRgenerator'])->name('attendance');
    Route::post('/postCheckin', [QrCodeController::class, 'checkin'])->name('checkin');
    Route::post('/postCheckout', [QrCodeController::class, 'checkout'])->name('checkout');
    Route::get('attendanceListing', [QrCodeController::class,'attendanceListing'])->name('attendanceListing');
    Route::get('attendanceDataTable', [QrCodeController::class,'attendanceDataTable'])->name('attendanceDataTable');
    Route::get('attendance-overview', [QrCodeController::class, 'attendanceOverView'])->name('attendanceOverView');
});
