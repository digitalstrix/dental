<?php

use App\Http\Controllers\AdminPanel;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Admin;
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



// Route::prefix('admin')->middleware('Admin')->group(function () {
Route::get('/', [AuthController::class,'login'])->name('login');
Route::get('/register', [AuthController::class,'registerview'])->name('register');
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');
Route::get('/dashboard', [AdminPanel::class,'dashboard'])->name('dashboard');
Route::get('/profile/{id?}', [AdminPanel::class,'profile'])->name('profile');
Route::get('/users', [AdminPanel::class,'users'])->name('users');
// });