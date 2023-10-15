<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
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

Route::get('/', [LandingController::class, 'welcome'])->middleware('startpoint')->name('welcome');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
    Route::post('/email', [LandingController::class, 'store'])->name('landing.store');
});


Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');
    });

    Route::middleware(['user'])->group(function () {
        Route::get('/user/home', [UserController::class, 'home'])->name('user.home');
    });

    Route::middleware(['worker'])->group(function () {
        Route::get('/worker/home', [WorkerController::class, 'home'])->name('worker.home');
    });

    //Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});