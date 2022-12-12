<?php

use App\Http\Controllers\AdminPanel;


use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Provider\CommonController as ProviderCommonController;
use App\Http\Controllers\User\CommonController;

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
Route::get('/ourproviders', 'App\Http\Controllers\AuthController@providers')->name('providers_frontend');
Route::get('/ourclinics', 'App\Http\Controllers\AuthController@clinics')->name('clinics_frontend');
Route::get('/contact', 'App\Http\Controllers\AuthController@contact')->name('contact_frontend');
Route::post('/contactsave', 'App\Http\Controllers\AuthController@contactSave')->name('contact_save_frontend');
Route::get('/provider/{id}/{name}', 'App\Http\Controllers\AuthController@providePage')->name('providePage');
Route::get('/clinics/{id}/{name}', 'App\Http\Controllers\AuthController@clinicPage')->name('clinicPage');
Route::get('/jobs', 'App\Http\Controllers\AuthController@jobs')->name('frontend_job');
Route::get('/applyjobs/{id}', 'App\Http\Controllers\AuthController@applyJob')->name('frontend_apply_job');
Route::post('/applyJobSave', 'App\Http\Controllers\AuthController@applyJobSave')->name('applyJobSave');

// [[[[[[[[[[[[[[[[[[[[[[[----Users Routes---]]]]]]]]]]]]]]]]]]]]]]]]]]

Route::controller('App\Http\Controllers\User\AuthController'::class)->prefix('user')->group(function () {
    Route::get('/', 'login')->name("user_login");
    Route::post('/login', 'login_submit')->name("user_login_submit");
    Route::get('/register', 'register')->name("user_register");
    Route::post('/register', 'register_submit')->name("user_register_submit");
});

    Route::middleware('UserGuard')->prefix('user')->group(function () {
        Route::get('/dashboard','App\Http\Controllers\User\CommonController@dashboard')->name('user_dashboard');
        Route::get('/edit','App\Http\Controllers\User\CommonController@userProfile')->name('user_edit');
        Route::post('/edit','App\Http\Controllers\User\CommonController@userProfileHandler')->name('user_edit_submit');
        Route::get('/calendar','App\Http\Controllers\User\CommonController@userCalendar')->name('user_calendar');
        Route::get('/providerfiles','App\Http\Controllers\User\CommonController@providersFile')->name('user_providersfiles');
        Route::post('/providerfiles','App\Http\Controllers\User\CommonController@providersFileStore')->name('user_providersFileStore');
        Route::get('/providersFileDelete/{id}','App\Http\Controllers\User\CommonController@providersFileDelete')->name('user_providersFileDelete');
        Route::get('/clinicfiles','App\Http\Controllers\User\CommonController@clinicFile')->name('user_clinicfiles');
        Route::post('/clinicfiles','App\Http\Controllers\User\CommonController@clinicFileStore')->name('user_clinicFileStore');
        Route::get('/clinicFileDelete/{id}','App\Http\Controllers\User\CommonController@clinicFileDelete')->name('user_clinicFileDelete');
        Route::get('/schedulemeet','App\Http\Controllers\User\CommonController@scheduleMeet')->name('schedulemeet');
        Route::post('/schedulemeet','App\Http\Controllers\User\CommonController@scheduleMeetSave')->name('schedulemeet_save');
        Route::get('api/calendarMeeting', [CommonController::class, 'calendarMeeting']);
        Route::get('schedulemeetings', [CommonController::class, 'Meetings'])->name('schedulemeetings');
        Route::get('completedMeetings', [CommonController::class, 'completedMeetings'])->name('completedMeetings');
        Route::get('providerReview/{id}/{meetingid}', [CommonController::class, 'providerReview'])->name('providerReview');
        Route::post('providerReviewSave', [CommonController::class, 'providerReviewSave'])->name('providerReviewSave');
        Route::get('clinicReview/{id}/{meetingid}', [CommonController::class, 'clinicReview'])->name('clinicReview');
        Route::post('clinicReviewSave', [CommonController::class, 'clinicReviewSave'])->name('clinicReviewSave');
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
    Route::get('/myMeetings','App\Http\Controllers\Provider\CommonController@myMeetings')->name('myMeetings');
    Route::get('/myMeetingConfirmation/{id}','App\Http\Controllers\Provider\CommonController@myMeetingConfirmation')->name('myMeetingConfirmation');
    Route::get('/myMeetingCompleted/{id}','App\Http\Controllers\Provider\CommonController@myMeetingCompleted')->name('myMeetingCompleted');
    Route::get('/myMeetingLink/{id}','App\Http\Controllers\Provider\CommonController@myMeetingLink')->name('myMeetingLink');
    Route::get('api/calendarMeeting', [ProviderCommonController::class, 'calendarMeeting']);
    Route::get('/myreviews', [ProviderCommonController::class, 'myReview'])->name('myReview');
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
    Route::get('/calendar','App\Http\Controllers\Clinic\CommonController@clinicCalendar')->name('clinic_calendar');
    Route::get('/userfiles','App\Http\Controllers\Clinic\CommonController@clinicFile')->name('clinic_usersfile');
    Route::get('/clinclots','App\Http\Controllers\Clinic\CommonController@clinicSlot')->name('clinic_slots');
    Route::post('/clinclots','App\Http\Controllers\Clinic\CommonController@clinicSlotSave')->name('clinic_slots_save');
    Route::get('/clinclotsdelete/{id}','App\Http\Controllers\Clinic\CommonController@clinicSlotDelete')->name('clinic_slots_delete');
    Route::get('/clincMap','App\Http\Controllers\Clinic\CommonController@clinicMap')->name('clinicMap');
    Route::post('/clincMapSave','App\Http\Controllers\Clinic\CommonController@clinicMapSave')->name('clinicMapSave');
    Route::get('/clincMapDelete/{id}','App\Http\Controllers\Clinic\CommonController@clinicMapDelete')->name('clinic_visit_delete');
    Route::get('/addService','App\Http\Controllers\Clinic\CommonController@addService')->name('addService');
    Route::post('/addServiceSave','App\Http\Controllers\Clinic\CommonController@addServiceSave')->name('addServiceSave');
    Route::get('/myMeetings','App\Http\Controllers\Clinic\CommonController@myMeetings')->name('clinic_myMeetings');
    Route::get('/myMeetingConfirmation/{id}','App\Http\Controllers\Clinic\CommonController@myMeetingConfirmation')->name('clinic_myMeetingConfirmation');
    Route::get('/myreviews','App\Http\Controllers\Clinic\CommonController@myReview')->name('clinic_reviews');
    Route::get('/haveAssistance/{id}','App\Http\Controllers\Clinic\CommonController@haveAssistance')->name('clinic_haveAssistance');
    Route::get('/needAssistance/{id}','App\Http\Controllers\Clinic\CommonController@needAssistance')->name('clinic_needAssistance');

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
    Route::get('/users', 'App\Http\Controllers\Admin\CommonController@usersDetails')->name('users_details');
    Route::get('/providers', 'App\Http\Controllers\Admin\CommonController@providersDetails')->name('providers_details');
    Route::get('/clinics', 'App\Http\Controllers\Admin\CommonController@clinicsDetails')->name('clinics_details');
    Route::get('/user/delete/{id}', 'App\Http\Controllers\Admin\CommonController@deleteUser')->name('delete_user');
    Route::get('/provider/delete/{id}', 'App\Http\Controllers\Admin\CommonController@deleteProvider')->name('delete_provider');
    Route::get('/clinic/delete/{id}', 'App\Http\Controllers\Admin\CommonController@deleteClinic')->name('delete_clinic');
    Route::get('/queries', 'App\Http\Controllers\Admin\CommonController@queries')->name('queries');

});

// [[[[[[[[[[[[[[[[[[[[[[[[[[[[[[[----Logout---]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]]
Route::post('api/fetch-pslots', [CommonController::class, 'fetchProviderSlots']);
Route::post('api/fetch-cslots', [CommonController::class, 'fetchClinicSlots']);

Route::get('/logout', function () {
    session()->flush();
    return redirect(route('dashboard'));
})->name('logout');