<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;


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
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');