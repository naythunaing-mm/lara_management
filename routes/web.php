<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Department\departmentController;
use App\Http\Controllers\Employee\employeeController;
use App\Http\Controllers\Home\indexContoller;
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

Route::prefix('admin-backend')->group(function() {
    Route::get('login', [LoginController::class, 'getLogin']);
    Route::post('login', [LoginController::class, 'postLogin'])->name('postLogin');
    Route::get('logout',[LoginController::class,'getLogout'])->name('logout');
});

Route::group(['prefix' => 'admin-backend', 'middleware' => 'admin'], function(){
    Route::get('index',[indexContoller::class,'Index'])->name('index');

    // view route
    Route::prefix('view')->group(function() {
        Route::get('form',[viewController::class,'viewForm'])->name('viewForm');
        Route::get('edit/{id}',[viewController::class,'editForm']);
        Route::get('delete/{id}',[viewController::class,'viewDelete']);
        Route::post('viewStore',[viewController::class,'viewStore'])->name('viewStore');
        Route::post('viewUpdate',[viewController::class,'viewUpdate'])->name('viewUpdate');
        Route::get('viewListing',[viewController::class,'viewListing'])->name('viewListing');
    });

    // Employee Route 
    Route::prefix('employee')->group(function() {
        Route::get('form',[employeeController::class,'employeeForm'])->name('employeeForm');
        Route::get('edit/{id}',[employeeController::class,'editForm']);
        Route::post('employeeStore',[employeeController::class,'employeeStore'])->name('employeeStore');
        Route::get('employeeListing',[employeeController::class,'employeeListing'])->name('employeeListing');
    });

    // Department Route 
    Route::prefix('department')->group(function() {
        Route::get('form',[departmentController::class,'departmentForm'])->name('departmentForm');
        Route::get('edit/{id}',[departmentController::class,'editForm']);
        Route::post('departmentStore',[departmentController::class,'departmentStore'])->name('departmentStore');
        Route::get('departmentListing',[departmentController::class,'departmentListing'])->name('departmentListing');
    });
});
