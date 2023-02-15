<?php

use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\employee\EmployeeAttendanceController;
use App\Http\Controllers\employee\EmployeeController;
use App\Http\Controllers\employee\EmployeeDashboardController;
use App\Http\Controllers\employee\SocialController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH--Auth Routes--HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH

Route::get('/',[AuthController::class, 'loginPage'])->name('loginPage');
Route::get('/login',[AuthController::class, 'login'])->name('login');

Route::get('/logout',[AuthController::class, 'logout'])->name('logout');

//Googlee Login

Route::get('auth/google', [SocialController::class, 'redirectToGoogle'])->name('redirectToGoogle');
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);



//HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH--Admin Routes--HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH

//Employe Crud
Route::middleware(['adminWare'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/create-new-employee-page',[EmployeeController::class, 'EmployeeCreatePage'])->name('EmployeeCreatePage');
        Route::post('/create-new-employee',[EmployeeController::class, 'EmployeeCreate'])->name('EmployeeCreate');
        Route::get('/employee-list',[EmployeeController::class, 'EmployeeList'])->name('EmployeeList');
        Route::get('/dashboard',[AdminDashboardController::class, 'AdminDashboard'])->name('AdminDashboard');
        Route::get('/attendance/{id}',[EmployeeAttendanceController::class, 'employeeAttendance'])->name('employeeAttendance');
        Route::get('/employee-details/{id}',[EmployeeController::class, 'employeeDetails'])->name('employeeDetails');
        Route::get('/employee-edit/{id}',[EmployeeController::class, 'employeeEdit'])->name('employeeEdit');
        Route::post('/employee-update/{id}',[EmployeeController::class, 'employeeUpdate'])->name('employeeUpdate');
        Route::get('/employee-delete/{id}',[EmployeeController::class, 'employeeDelete'])->name('employeeDelete');

        Route::post('/send-message/{id}',[AdminDashboardController::class, 'sendMessage'])->name('sendMessage');
        Route::get('/messages',[AdminDashboardController::class, 'seeMessage'])->name('seeMessage');
        Route::get('/message-delete/{id}',[AdminDashboardController::class, 'deleteMessage'])->name('deleteMessage');

        });
});


//HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH--Employee Routes--HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH




Route::middleware(['employeeWare'])->group(function () {
    Route::prefix('employee')->group(function () {
        Route::get('/dashboard',[EmployeeDashboardController::class, 'EmployeeDashboard'])->name('EmployeeDashboard');
        Route::get('/in-time',[EmployeeAttendanceController::class, 'inTime'])->name('inTime');
        Route::get('/out-time',[EmployeeAttendanceController::class, 'outTime'])->name('outTime');
        Route::get('/last-30-days',[EmployeeDashboardController::class, 'Last30'])->name('Last30');

        //Employee Profile
        Route::get('/profile',[EmployeeController::class, 'EmployeeProfile'])->name('EmployeeProfile');
        Route::post('/profile-update',[EmployeeController::class, 'profileUpdate'])->name('profileUpdate');
    });
});