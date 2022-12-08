<?php

use App\Http\Controllers\AdminPanel;

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



Route::get('/', [AuthController::class,'login'])->name('login');
Route::get('/register', [AuthController::class,'registerview'])->name('register');
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');
Route::get('/dashboard', [AdminPanel::class,'dashboard'])->name('dashboard');
Route::get('/profile/{id?}', [AdminPanel::class,'profile'])->name('profile');
Route::get('/users', [AdminPanel::class,'users'])->name('users');



Route::controller('App\Http\Controllers\User\AuthController'::class)->prefix('user')->group(function () {
    Route::get('/login', 'login');
    Route::post('/login', 'login_submit')->name("user_login");
    Route::get('/register', 'register');
    Route::post('/register', 'register_submit')->name("user_register");   
});

Route::controller('App\Http\Controllers\Provider\AuthController'::class)->prefix('providers')->group(function () {
    Route::get('/login', 'login');
    Route::post('/login', 'login_submit')->name("dentist_login");
    Route::get('/register', 'register');
    Route::post('/register', 'register_submit')->name("dentist_register");
});


// Route::controller('User\AuthController'::class)->prefix('user')->group(function () {
//     Route::get('/login', 'login');
//     Route::post('/login', 'login_submit');
//     Route::get('/register', 'register');
//     Route::post('/register', 'register_submit');
// });