<?php

use App\Http\Controllers\AdminPanel;

use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


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



// Route::get('/', [AuthController::class,'login'])->name('login');
// Route::get('/register', [AuthController::class,'registerview'])->name('register');
// Route::post('/register', [AuthController::class,'register'])->name('register');
// Route::get('/logout', [AuthController::class,'logout'])->name('logout');
// Route::get('/dashboard', [AdminPanel::class,'dashboard'])->name('dashboard');
// Route::get('/profile/{id?}', [AdminPanel::class,'profile'])->name('profile');
// Route::get('/users', [AdminPanel::class,'users'])->name('users');

// [[[[[[[[[[[[[[[[[[[[[[[----Users Routes---]]]]]]]]]]]]]]]]]]]]]]]]]]

Route::controller('App\Http\Controllers\User\AuthController'::class)->prefix('user')->group(function () {
    Route::get('/login', 'login');
    Route::get('/', 'login')->name("user_login_page");
    Route::post('/login', 'login_submit')->name("user_login");
    Route::get('/register', 'register');
    Route::post('/register', 'register_submit')->name("user_register");
});

    Route::middleware('UserGuard')->prefix('user')->group(function () {
        Route::get('/dashboard','App\Http\Controllers\User\CommonController@dashboard')->name('user_dashboard');
        Route::get('/edit','App\Http\Controllers\User\CommonController@userProfile')->name('user_edit');
        Route::post('/edit','App\Http\Controllers\User\CommonController@userProfileHandler')->name('user_edit');
        Route::get('/calendar','App\Http\Controllers\User\CommonController@userCalendar')->name('user_calendar');
        Route::get('/providerfiles','App\Http\Controllers\User\CommonController@providersFile')->name('user_providersfiles');
        Route::post('/providerfiles','App\Http\Controllers\User\CommonController@providersFileStore')->name('user_providersFileStore');
        Route::get('/providersFileDelete/{id}','App\Http\Controllers\User\CommonController@providersFileDelete')->name('user_providersFileDelete');
        Route::get('/clinicfiles','App\Http\Controllers\User\CommonController@clinicFile')->name('user_clinicfiles');
        Route::post('/clinicfiles','App\Http\Controllers\User\CommonController@clinicFileStore')->name('user_clinicFileStore');
        Route::get('/clinicFileDelete/{id}','App\Http\Controllers\User\CommonController@clinicFileDelete')->name('user_clinicFileDelete');
    }); 

// [[[[[[[[[[[[[[[[[[[[[[[----Providers Routes---]]]]]]]]]]]]]]]]]]]]]]]]]]

Route::controller('App\Http\Controllers\Provider\AuthController'::class)->prefix('providers')->group(function () {
    Route::get('/login', 'login')->name("provider_login");
    Route::get('/', 'login');
    Route::post('/login', 'login_submit')->name("dentist_login");
    Route::get('/register', 'register')->name("provider_register");
    Route::post('/register', 'register_submit')->name("dentist_register");
});

Route::middleware('ProviderGuard')->prefix('providers')->controller('App\Http\Controllers\Provider\CommonController'::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('providers_dashboard');
    Route::get('/edit','App\Http\Controllers\Provider\CommonController@userProfile')->name('provider_edit');
    Route::post('/edit','App\Http\Controllers\Provider\CommonController@userProfileHandler')->name('provider_edit');
    Route::get('/calendar','App\Http\Controllers\Provider\CommonController@userCalendar')->name('provider_calendar');
    Route::get('/userfiles','App\Http\Controllers\Provider\CommonController@providersFile')->name('provider_usersfile');
    Route::get('/providerslots','App\Http\Controllers\Provider\CommonController@providersSlot')->name('provider_slots');
    Route::post('/providerslots','App\Http\Controllers\Provider\CommonController@providersSlotSave')->name('provider_slots_save');
    Route::get('/providerslotsdelete/{id}','App\Http\Controllers\Provider\CommonController@providersSlotDelete')->name('provider_slots_delete');
    Route::get('/providersMap','App\Http\Controllers\Provider\CommonController@providersMap')->name('providersMap');
    Route::post('/providersMapSave','App\Http\Controllers\Provider\CommonController@providersMapSave')->name('providersMapSave');
    Route::get('/providersMapDelete/{id}','App\Http\Controllers\Provider\CommonController@providersMapDelete')->name('provider_visit_delete');
});


// [[[[[[[[[[[[[[[[[[[[[[[----Clinic Routes---]]]]]]]]]]]]]]]]]]]]]]]]]]

Route::controller('App\Http\Controllers\Clinic\AuthController'::class)->prefix('clinic')->group(function () {
    Route::get('/login', 'login');
    Route::get('/', 'login');
    Route::post('/login', 'login_submit');
    Route::get('/register', 'register');
    Route::post('/register', 'register_submit');
});

// [[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[----Logout---]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]

Route::get('/logout', function () {
session()->flush();
    return view('users.login');
})->name('logout');