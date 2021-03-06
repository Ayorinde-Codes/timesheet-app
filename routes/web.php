<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeAuthorizationController;

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

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('dashboard', [LoginController::class, 'dashboard']); 
// Route::get('login', [LoginController::class, 'index'])->name('login');
// Route::post('custom-login', [LoginController::class, 'customLogin'])->name('login.custom'); 
// Route::get('registration', [RegisterController::class, 'registration'])->name('register-user');
// Route::post('custom-registration', [RegisterController::class, 'customRegistration'])->name('register.custom'); 
// Route::get('signout', [LoginController::class, 'signOut'])->name('signout');


Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 

Route::group(['middleware' => 'auth' ], function () {

Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//timesheet

Route::get('/timesheet', [TimesheetController::class, 'index'])->name('timesheet.index');
Route::get('/user/timesheet', [TimesheetController::class, 'userTimesheet'])->name('timesheet.index');
// Route::post('/timesheet/create', [TimesheetController::class, 'create'])->name('timesheet.create');
Route::post('/timesheet/update', [TimesheetController::class, 'create'])->name('timesheet.update');
Route::post('/timesheet/delete', [TimesheetController::class, 'create'])->name('timesheet.delete');
    Route::post('/timesheet/create', [TimesheetController::class, 'create'])->name('timesheet.create');

//Employee
Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee/{id}', [EmployeeController::class, 'details'])->name('employee.details');
Route::post('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee/update', [EmployeeController::class, 'editEmployee'])->name('employee.update');
Route::post('/employee/delete', [EmployeeController::class, 'create'])->name('employee.delete');

//Projects
Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');
Route::post('/project/create', [ProjectController::class, 'create'])->name('project.create');
Route::post('/project/update', [ProjectController::class, 'update'])->name('project.update');
Route::post('/project/delete', [ProjectController::class, 'create'])->name('project.delete');

//Absence
Route::get('/absence', [AbsenceController::class, 'index'])->name('absence.index');
Route::get('/user/leave', [AbsenceController::class, 'userLeave'])->name('user.leave');
Route::post('/apply/leave', [AbsenceController::class, 'userLeaveApply'])->name('user.leave.apply');
Route::get('/view/leave', [AbsenceController::class, 'viewLeave'])->name('view.leave');
Route::post('/absence/create', [AbsenceController::class, 'create'])->name('absence.create');
Route::post('/absence/update', [AbsenceController::class, 'update'])->name('absence.update');
Route::post('/approve/leave', [AbsenceController::class, 'approveLeave'])->name('approve.leave');


//My profile    view/leave  user/timesheet
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/profile/update', [ProfileController::class, 'create'])->name('profile.update');
Route::post('/profile/delete', [ProfileController::class, 'create'])->name('profile.delete');

//employee_employee  editEmployee
Route::get('/authorize_employee', [EmployeeAuthorizationController::class, 'index'])->name('auth_employee.index');
Route::post('/authorize_employee', [EmployeeAuthorizationController::class, 'approve'])->name('auth_employee.approve');
// Route::post('/authorize_employee', [EmployeeAuthorizationController::class, 'approve'])->name('auth_employee.approve');

});
