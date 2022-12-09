<?php

use App\Http\Controllers\AdminPanel;


use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

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




Route::get('/', [AuthController::class, 'dashboard'])->name('dashboard');

// [[[[[[[[[[[[[[[[[[[[[[[----Users Routes---]]]]]]]]]]]]]]]]]]]]]]]]]]

Route::controller('App\Http\Controllers\User\AuthController'::class)->prefix('user')->group(function () {
    Route::get('/', 'login')->name("user_login");
    Route::post('/login', 'login_submit')->name("user_login_submit");
    Route::get('/register', 'register')->name("user_register");
    Route::post('/register', 'register_submit')->name("user_register_submit");
});

Route::middleware('UserGuard')->prefix('user')->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\User\CommonController@dashboard')->name('user_dashboard');
    Route::get('/edit', 'App\Http\Controllers\User\CommonController@userProfile')->name('user_edit');
    Route::post('/edit', 'App\Http\Controllers\User\CommonController@userProfileHandler')->name('user_edit_submit');
});

// [[[[[[[[[[[[[[[[[[[[[[[----Providers Routes---]]]]]]]]]]]]]]]]]]]]]]]]]]

Route::controller('App\Http\Controllers\Provider\AuthController'::class)->prefix('providers')->group(function () {
    Route::get('/', 'login')->name("provider_login");
    Route::post('/login', 'login_submit')->name("provider_login_submit");
    Route::get('/register', 'register')->name("provider_register");
    Route::post('/register', 'register_submit')->name("provider_register_submit");
});

Route::middleware('ProviderGuard')->prefix('providers')->controller('App\Http\Controllers\Provider\CommonController'::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('providers_dashboard');
    Route::get('/edit', 'userProfile')->name('providers_edit');
    Route::post('/edit', 'userProfileHandler')->name('providers_edit_submit');
});


// [[[[[[[[[[[[[[[[[[[[[[[----Clinic Routes---]]]]]]]]]]]]]]]]]]]]]]]]]]

Route::controller('App\Http\Controllers\Clinic\AuthController'::class)->prefix('clinic')->group(function () {
    Route::get('/', 'login')->name('clinic_login');
    Route::post('/login', 'login_submit')->name('clinic_login_submit');
    Route::get('/register', 'register')->name('clinic_register');
    Route::post('/register', 'register_submit')->name('clinic_register_submit');
});

Route::middleware('ClinicGuard')->prefix('clinic')->controller('App\Http\Controllers\Clinic\CommonController'::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('clinic_dashboard');
    Route::get('/edit', 'userProfile')->name('clinic_edit');
    Route::post('/edit', 'userProfileHandler')->name('clinic_edit_submit');
});

// [[[[[[[[[[[[[[[[[[[[[[[----Admin Routes---]]]]]]]]]]]]]]]]]]]]]]]]]]
// problem yha h controller me Admin
Route::controller(AdminAuthController::class)->prefix('admin')->group(function () {
    Route::get('/', 'login')->name('admin_login');
    Route::post('/login', 'login_submit')->name('admin_login_submit');
    Route::get('/register', 'register')->name('admin_register');
    Route::post('/register', 'register_submit')->name('admin_register_submit');
});

Route::middleware('AdminGuard')->prefix('admin')->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\Admin\CommonController@dashboard')->name('admin_dashboard');
    Route::get('/edit', 'App\Http\Controllers\Admin\CommonController@userProfile')->name('admin_edit');
    Route::post('/edit', 'App\Http\Controllers\Admin\CommonController@userProfileHandler')->name('admin_edit_submit');
});

// [[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[----Logout---]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

Route::get('/logout', function () {
    session()->flush();
    return view('users.login');
})->name('logout');
