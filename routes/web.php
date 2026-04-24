<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// ========================================PRE LOG IN ROUTES=======================================
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
//==================================================================================================

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');
//======================================================================================================




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
//  GENERAL FORM ROUTES
Route::get('forms', [\App\Http\Controllers\FormController::class, 'index'])->name('forms.index');
Route::get('forms/dataprivacy', [\App\Http\Controllers\FormController::class, 'dataprivacy'])->name('forms.dataprivacy');
Route::get('forms/general', [\App\Http\Controllers\FormController::class, 'generalForm'])->name('forms.general');
Route::post('forms/general', [\App\Http\Controllers\FormController::class, 'storeGeneralForm'])->name('forms.general.store');


// PROCESSING REQUEST FORM ROUTES

Route::get('forms/processing', [\App\Http\Controllers\FormController::class, 'processingForm'])->name('forms.processing');
Route::post('forms/processing/store', [\App\Http\Controllers\FormController::class, 'storeProcessing'])->name('forms.processing.store');


// AKSYON FORM ROUTES

Route::get('forms/aksyon', [\App\Http\Controllers\FormController::class, 'aksyonForm'])->name('forms.aksyon');
Route::post('forms/aksyon/store', [\App\Http\Controllers\FormController::class, 'storeAksyonForm'])->name('forms.aksyon.store');

// OFW INFO SHEET PROTECTION DIVISION ROUTES
Route::get('forms/ofw_info_sheet_mwpd_protection', [\App\Http\Controllers\FormController::class, 'ofw_info_sheet_mwpd_protection'])->name('forms.ofw_info_sheet_mwpd_protection');


//SENA FORM ROUTES

Route::get('forms/sena', [\App\Http\Controllers\FormController::class, 'senaForm'])->name('forms.sena');
Route::post('forms/sena', [\App\Http\Controllers\FormController::class, 'storeSenaForm'])->name('forms.sena.store');


//REQUIREMENTS ROUTES
Route::get('/forms/requirements', [\App\Http\Controllers\FormController::class, 'requirements'])->name('forms.requirements');

// FORMS ROUTES
Route::get('/forms/step/{step}', [\App\Http\Controllers\FormController::class, 'showStep']);
Route::post('/forms/step/{step}', [\App\Http\Controllers\FormController::class, 'storeStep']);

Route::post('/forms/submit', [\App\Http\Controllers\FormController::class, 'submitAllForms'])->name('forms.submit.all');

Route::get('forms/success', [\App\Http\Controllers\FormController::class, 'submissionSuccess'])->name('forms.success');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    


    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    
    Route::get('forms-submitted', [\App\Http\Controllers\SubmittedFormController::class, 'index'])->name('forms-submitted.index');

    Route::get('forms-submitted/general', [\App\Http\Controllers\SubmittedFormController::class, 'generalFormSubmitted'])->name('forms-submitted.general');

    // -------------------------------------------------------
    // DYNAMIC ROUTES AFTER
    // -------------------------------------------------------
    Route::get('forms-submitted/request/{id}', [\App\Http\Controllers\SubmittedFormController::class, 'show'])->name('forms-submitted.show');
    Route::get('forms-submitted/{requestId}/form/{formId}', [\App\Http\Controllers\SubmittedFormController::class, 'openForm'])->name('forms-submitted.open-form');
    Route::get('/requirements/view/{id}', [\App\Http\Controllers\SubmittedFormController::class, 'viewFile'])->name('requirements.view');
    Route::get('/requirements/download/{id}', [\App\Http\Controllers\SubmittedFormController::class, 'downloadFile'])->name('requirements.download');



    Route::get('/forms-submitted/{requestId}/{formId}/editGeneral',[\App\Http\Controllers\SubmittedFormController::class, 'editGeneral'])->name('forms-submitted.edit.general');
    Route::put('/forms-submitted/{requestId}/{formId}/editGeneral',[\App\Http\Controllers\SubmittedFormController::class, 'saveEditGeneral'])->name('forms-submitted.save-edit-general');

    Route::get('/forms-submitted/{requestId}/{formId}/editOFWInfoSheetMWPSD',[\App\Http\Controllers\SubmittedFormController::class, 'editOFWInfoSheetMWPSD'])->name('forms-submitted.edit.processing');
    Route::put('/forms-submitted/{requestId}/{formId}/editOFWInfoSheetMWPSD',[\App\Http\Controllers\SubmittedFormController::class, 'saveEditOFWInfoSheetMWPSD'])->name('forms-submitted.save-edit-processing');

    Route::get('/forms-submitted/{requestId}/{formId}/editAksyon',[\App\Http\Controllers\SubmittedFormController::class, 'editAksyon'])->name('forms-submitted.edit.aksyon');
    Route::put('/forms-submitted/{requestId}/{formId}/editAksyon',[\App\Http\Controllers\SubmittedFormController::class, 'saveEditAksyon'])->name('forms-submitted.save-edit-aksyon');

    Route::get('/forms-submitted/{requestId}/{formId}/editSENA',[\App\Http\Controllers\SubmittedFormController::class, 'editSENA'])->name('forms-submitted.edit.sena');
    Route::put('/forms-submitted/{requestId}/{formId}/editSENA',[\App\Http\Controllers\SubmittedFormController::class, 'saveEditSENA'])->name('forms-submitted.save-edit-sena');

    Route::get('/forms-submitted/search', [\App\Http\Controllers\SubmittedFormController::class, 'search'])->name('forms-submitted.search');

    Route::get('forms-submitted/general', [\App\Http\Controllers\SubmittedFormController::class, 'generalFormSubmitted'])->name('forms-submitted.general');
    Route::post('forms-submitted/general', [\App\Http\Controllers\SubmittedFormController::class, 'storeGeneralForm'])->name('forms-submitted.general.store');

});
