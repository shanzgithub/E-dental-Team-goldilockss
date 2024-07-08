<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\TreatmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return view('/auth.login');
});

Route::get('/index', function () {
    return view('home');
})->name('home.screen')->middleware('guest');

Route::get('/manageprofile', function () {
    return view('/manageprofile');
});

Route::get('/generateinvoice', function () {
    return view('/generateinvoice');
});


Route::get('/makeappointment', function () {
    return view('makeappointment');
})->name('makeappointment')->middleware('auth');

Route::get('/viewappointment', function () {
    return view('viewappointment');
})->name('viewappointment')->middleware('auth');

Route::get('/approveappointment', function () {
    return view('approveappointment');
})->name('approveappointment');


Route::get('/cancelappointment', function () {
    return view('cancelappointment');
})->name('cancelappointment');

Route::get('/changepassword', function () {
    return view('auth.forgetpassword');
})->name('changepassword');
Route::post('/changepassword', [ResetPasswordController::class, 'change'])->name('password.change');


Route::get('/UploadDigitalDocument', function () {
    return view('UploadDigitalDocument');
})->name('UploadDigitalDocument');

Route::post('/UploadDigitalDocument', [DocumentController::class, 'uploaddocument'])->name('upload.document.new')->middleware('auth');
Route::get('/UploadDigitalDocument', [DocumentController::class, 'redata'])->name('req.document.data')->middleware('auth');




Route::get('/dentistdocument', [DocumentController::class, 'dentistDocument'])->name('list.patient.document')->middleware('auth');


Route::get('/specificpatientdoc{id}', [DocumentController::class, 'specificDocument'])->name('patient.view.document')->middleware('auth');


Route::get('/download/{id}', [DocumentController::class, 'getdocument'])->name('patient.download.document')->middleware('auth');


Route::get('/generateinvoice/{id}', [DocumentController::class, 'generateinvoice'])->name('generate.invoice')->middleware('auth');


Route::get('/viewnotification', function () {
    return view('viewnotification');
})->name('viewnotification');



Route::get('/deletedocument/{id}', [DocumentController::class, 'deletedocument'])->name('delete.document')->middleware('auth');



Auth::routes();

Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/viewappointment', [AppointmentController::class, 'allappointment'])->name('view.all.appointment')->middleware('auth');

Route::get('/appointments/filter', [AppointmentController::class, 'filter'])->name('filter.appointments')->middleware('auth');


Route::get('/profile', [UserController::class, 'getUserInfo'])->name('view.user.details')->middleware('auth');
Route::put('/manageprofile/{id}', [UserController::class, 'UpdateUserInfo'])->name('save.user.details')->middleware('auth');
Route::get('/manageprofile/{id}', [UserController::class, 'userdetailsinmanage'])->name('update.user.details')->middleware('auth');


Route::get('/viewnotification', [AppointmentController::class, 'notification'])->name('view.all.notification')->middleware('auth');


// Route::post('/makeappointment', [AppointmentController::class, 'makeAppointment'])->name('book.appointment.new')->middleware('auth');
// Route::get('/makeappointment', [AppointmentController::class, 'reqalldata'])->name('list.all.data')->middleware('auth');
// Route::get('/approveappointment', [AppointmentController::class, 'allappointment'])->name('list.all.appointment')->middleware('auth');

// Route::put('/approveappointment', [AppointmentController::class, 'updatestatus'])->name('update.appointment.status');

// Route::get('/cancelappointment', [AppointmentController::class, 'allappointment1'])->name('list.all.appointment.cancel')->middleware('auth');
// Route::put('/cancelappointment', [AppointmentController::class, 'updatestatus1'])->name('cancel.appointment.status');


Route::get('/rescheduleappointment/{id}', [AppointmentController::class, 'reschedule'])->name('edit.reschedule.appointment');
Route::put('/rescheduleappointment/{id}', [AppointmentController::class, 'savereschedule'])->name('save.reschedule.appointment');

//--------------Route Admin-------------------
Route::group(['middleware' => ['auth', '1']], function() {
    // your routes
    Route::get('/UserVerification', function () {
        return view("admin.UserVerification");
    })->name("UserVerification");
});

Route::group(['middleware' => ['auth', 'patient']], function() {
    // your routes
    Route::get('/makeappointment', [AppointmentController::class, 'reqalldata'])->name('list.all.data')->middleware('auth');
});



Route::group(['middleware' => ['auth', '1']], function() {
    // your routes
    Route::get('/RegistDentist', function () {
        return view("admin.RegistDentist");
    })->name("RegistDentist");
});

Route::group(['middleware' => ['auth', '1']], function() {
    // your routes
    Route::Post('/RegistDentist', [UserController::class, 'create'])->name('regist.new.dentist');
});

Route::group(['middleware' => ['auth', '1']], function() {
    // your routes
    Route::get('/adminhome', function () {
        return view("admin.home");
    })->name("adminhome");
});
Route::group(['middleware' => ['auth', '1']], function() {
    // your routes
    Route::get('/UserVerification', [UserController::class, 'getUserList'])->name('admin.user.print');
});
Route::group(['middleware' => ['auth', '1']], function() {
    // your routes
    Route::put('/updatestatus', [UserController::class, 'updateStatus'])->name('admin.user.update');
});


//--------------Route Patient-------------------
Route::group(['middleware' => ['auth', 'patient']], function() {
    // your routes
    Route::get('/makeappointment', [AppointmentController::class, 'reqalldata'])->name('list.all.data')->middleware('auth');
});

Route::group(['middleware' => ['auth', 'patient']], function() {
    // your routes
    Route::post('/makeappointment', [AppointmentController::class, 'makeAppointment'])->name('book.appointment.new')->middleware('auth');
});

// Route::group(['middleware' => ['auth', 'patient']], function() {
//     // your routes
//     Route::get('/cancelappointment', [AppointmentController::class, 'patientappointment'])->name('list.all.appointment.cancel')->middleware('auth');
// });

Route::group(['middleware' => ['auth', 'patient']], function() {
    // your routes
    Route::put('/cancelappointment', [AppointmentController::class, 'patientupdatestatus'])->name('cancel.appointment.status');
});

Route::group(['middleware' => ['auth', 'patient']], function() {
    // your routes
    Route::get('/DigitalDocument', [DocumentController::class, 'patientDocument'])->name('view.all.patient.document')->middleware('auth');
});


//--------------Route Dentist-------------------
Route::group(['middleware' => ['auth', 'dentist']], function() {
    // your routes
    Route::get('/approveappointment', [AppointmentController::class, 'dentistappointment'])->name('list.all.appointment')->middleware('auth');
});

Route::group(['middleware' => ['auth', 'dentist']], function() {
    // your routes
    Route::put('/approveappointment', [AppointmentController::class, 'dentistupdatestatus'])->name('update.appointment.status');
});
Route::group(['middleware' => ['auth', 'dentist']], function() {
    // your routes
    Route::get('/dentistdocument', [DocumentController::class, 'dentistDocument'])->name('view.all.dentist.document')->middleware('auth');
});