<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');

Route::post('/register', [UserController::class, 'store'])->name('register.store');
Route::post('/login', [UserController::class, 'authenticate'])->name('login.authenticate');

// Protected route example
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/userdashboard', [App\Http\Controllers\AppointmentController::class, 'index'])->middleware('auth')->name('userdashboard');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('create-appointment', function () {
    return view('create_appointment');
})->middleware('auth')->name('appointment.create');

Route::post('store-appointment', [App\Http\Controllers\AppointmentController::class, 'store'])->middleware('auth')->name('appointments.store');

Route::get('/admindashboard', [App\Http\Controllers\UserController::class, 'adminDashboard'])->middleware('auth')->name('admindashboard');
Route::post('/adminlogin', [UserController::class, 'adminAuthenticate'])->name('admin.login.authenticate');
Route::get('/adminlogin', [UserController::class, 'adminLogin'])->name('admin.login');

Route::patch('/appointment/{id}/approve', [AppointmentController::class, 'approve'])
    ->name('appointment.approve');


    Route::patch('/appointment/{id}/reject', [AppointmentController::class, 'reject'])
    ->name('appointment.reject');

    Route::get('/appointment/{id}/reschedule', [AppointmentController::class, 'rescheduleForm'])
    ->name('appointment.reschedule.form');

    Route::post('/appointment/{id}/reschedule', [AppointmentController::class, 'reschedule'])
    ->name('appointment.reschedule');
 
    
