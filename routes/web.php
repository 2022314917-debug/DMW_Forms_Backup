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

Route::get('forms/rfa', [\App\Http\Controllers\FormController::class, 'RFAForm'])->name('forms.rfa');
Route::post('forms/rfa', [\App\Http\Controllers\FormController::class, 'storeRFAForm'])->name('forms.rfa.store');



Route::get('/forms/step/{step}', [\App\Http\Controllers\FormController::class, 'showStep'])->name('forms.step');
Route::post('/forms/step/{step}', [\App\Http\Controllers\FormController::class, 'storeStep'])->name('forms.step.store');

// PROCESSING REQUEST FORM ROUTES

Route::get('forms/processing', [\App\Http\Controllers\FormController::class, 'processingForm'])->name('forms.processing');
Route::post('forms/processing/store', [\App\Http\Controllers\FormController::class, 'storeProcessing'])->name('forms.processing.store');


// AKSYON FORM ROUTES

Route::get('forms/aksyon', [\App\Http\Controllers\FormController::class, 'aksyonForm'])->name('forms.aksyon');



// OFW INFO SHEET PROTECTION DIVISION ROUTES
Route::get('forms/ofw_info_sheet_mwpd_protection', [\App\Http\Controllers\FormController::class, 'ofw_info_sheet_mwpd_protection'])->name('forms.ofw_info_sheet_mwpd_protection');


//SENA FORM ROUTES

Route::get('forms/sena', [\App\Http\Controllers\FormController::class, 'senaForm'])->name('forms.sena');
Route::get('forms/elpor', [\App\Http\Controllers\FormController::class, 'elporForm'])->name('forms.elpor');
Route::get('forms/ofw-statement', [\App\Http\Controllers\FormController::class, 'ofwStatementForm'])->name('forms.ofw_statement');
Route::get('forms/elporb1', [\App\Http\Controllers\FormController::class, 'elporFormB1'])->name('forms.elporb1');
Route::get('forms/business-canvas', [\App\Http\Controllers\FormController::class, 'businessCanvas'])->name('forms.business_canvas');
Route::get('forms/commitment', [\App\Http\Controllers\FormController::class, 'commitment'])->name('forms.commitment');
Route::get('forms/kasulatan', [\App\Http\Controllers\FormController::class, 'kasulatan'])->name('forms.kasulatan');

//REQUIREMENTS ROUTES
Route::get('/forms/requirements', [\App\Http\Controllers\FormController::class, 'requirements'])->name('forms.requirements');



Route::post('/forms/submit', [\App\Http\Controllers\FormController::class, 'submitAllForms'])->name('forms.submit.all');

Route::get('forms/success', [\App\Http\Controllers\FormController::class, 'submissionSuccess'])->name('forms.success');

Route::get('forms/mail/success', [\App\Http\Controllers\FormController::class, 'formsSubmittedSuccess'])->name('mail.forms_submitted_success');



Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    


    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('forms-submitted', [\App\Http\Controllers\SubmittedFormController::class, 'index'])->name('forms-submitted.index');

    // Employee Routes
    Route::get('employees', [\App\Http\Controllers\EmployeeController::class, 'index'])->name('employees.index');
    Route::post('employees', [\App\Http\Controllers\EmployeeController::class, 'store'])->name('employees.store');
    Route::get('employees/{employee}/edit', [\App\Http\Controllers\EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('employees/{employee}', [\App\Http\Controllers\EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('employees/{employee}', [\App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employees.destroy');

    Route::get('forms-submitted/general', [\App\Http\Controllers\SubmittedFormController::class, 'generalFormSubmitted'])->name('forms-submitted.general');

    // -------------------------------------------------------
    // DYNAMIC ROUTES AFTER
    // -------------------------------------------------------
    Route::get('forms-submitted/request/{id}', [\App\Http\Controllers\SubmittedFormController::class, 'show'])->name('forms-submitted.show');
    Route::get('forms-submitted/{requestId}/form/{formId}', [\App\Http\Controllers\SubmittedFormController::class, 'openForm'])->name('forms-submitted.open-form');
    Route::get('/requirements/view/{id}', [\App\Http\Controllers\SubmittedFormController::class, 'viewFile'])->name('requirements.view');
    Route::get('/requirements/download/{id}', [\App\Http\Controllers\SubmittedFormController::class, 'downloadFile'])->name('requirements.download');

    Route::post('forms-submitted/request/{id}/approve', [\App\Http\Controllers\SubmittedFormController::class, 'approveRequestStatus'])->name('forms-submitted.request-approve');
    Route::post('forms-submitted/request/{id}/reject', [\App\Http\Controllers\SubmittedFormController::class, 'rejectRequestStatus'])->name('forms-submitted.request-reject');

    Route::get('/forms-submitted/{requestId}/{formId}/editGeneral',[\App\Http\Controllers\SubmittedFormController::class, 'editGeneral'])->name('forms-submitted.edit.general');
    Route::put('/forms-submitted/{requestId}/{formId}/editGeneral',[\App\Http\Controllers\SubmittedFormController::class, 'saveEditGeneral'])->name('forms-submitted.save-edit-general');

    Route::get('/forms-submitted/{requestId}/{formId}/editRFA',[\App\Http\Controllers\SubmittedFormController::class, 'editRFA'])->name('forms-submitted.edit.rfa');
    Route::put('/forms-submitted/{requestId}/{formId}/editRFA',[\App\Http\Controllers\SubmittedFormController::class, 'saveEditRFA'])->name('forms-submitted.save-edit-rfa');

    Route::get('/forms-submitted/{requestId}/{formId}/editOFWInfoSheetMWPSD',[\App\Http\Controllers\SubmittedFormController::class, 'editOFWInfoSheetMWPSD'])->name('forms-submitted.edit.processing');
    Route::put('/forms-submitted/{requestId}/{formId}/editOFWInfoSheetMWPSD',[\App\Http\Controllers\SubmittedFormController::class, 'saveEditOFWInfoSheetMWPSD'])->name('forms-submitted.save-edit-processing');

    Route::get('/forms-submitted/{requestId}/{formId}/editAksyon',[\App\Http\Controllers\SubmittedFormController::class, 'editAksyon'])->name('forms-submitted.edit.aksyon');
    Route::post('/forms-submitted/{requestId}/{formId}/editAksyon',[\App\Http\Controllers\SubmittedFormController::class, 'saveEditAksyon'])->name('forms-submitted.save-edit-aksyon');

    Route::get('/forms-submitted/{requestId}/{formId}/editSENA',[\App\Http\Controllers\SubmittedFormController::class, 'editSENA'])->name('forms-submitted.edit.sena');
    Route::put('/forms-submitted/{requestId}/{formId}/editSENA',[\App\Http\Controllers\SubmittedFormController::class, 'saveEditSENA'])->name('forms-submitted.save-edit-sena');

    Route::get('/forms-submitted/{requestId}/{formId}/editElpor',[\App\Http\Controllers\SubmittedFormController::class, 'editElpor'])->name('forms-submitted.edit.elpor');
    Route::put('/forms-submitted/{requestId}/{formId}/editElpor',[\App\Http\Controllers\SubmittedFormController::class, 'saveEditElpor'])->name('forms-submitted.save-edit-elpor');

    Route::get('/forms-submitted/{requestId}/{formId}/editOFWStatement',[\App\Http\Controllers\SubmittedFormController::class, 'editOFWStatement'])->name('forms-submitted.edit.ofw_statement');
    Route::put('/forms-submitted/{requestId}/{formId}/editOFWStatement',[\App\Http\Controllers\SubmittedFormController::class, 'saveEditOFWStatement'])->name('forms-submitted.save-edit-ofw_statement');

    Route::get('/forms-submitted/{requestId}/{formId}/editElporB1', [\App\Http\Controllers\SubmittedFormController::class, 'editElporB1'])->name('forms-submitted.edit.elporb1');
    Route::put('/forms-submitted/{requestId}/{formId}/editElporB1', [\App\Http\Controllers\SubmittedFormController::class, 'saveEditElporB1'])->name('forms-submitted.save-edit-elporb1');

    Route::get('/forms-submitted/{requestId}/{formId}/editBusinessCanvas', [\App\Http\Controllers\SubmittedFormController::class, 'editBusinessCanvas'])->name('forms-submitted.edit.business_canvas');
    Route::put('/forms-submitted/{requestId}/{formId}/editBusinessCanvas', [\App\Http\Controllers\SubmittedFormController::class, 'saveEditBusinessCanvas'])->name('forms-submitted.save-edit-business_canvas');

    Route::get('/forms-submitted/search', [\App\Http\Controllers\SubmittedFormController::class, 'search'])->name('forms-submitted.search');

    Route::put('/forms-submitted/{requestId}/updateNewSubmission', [\App\Http\Controllers\SubmittedFormController::class, 'updateNewSubmission'])->name('forms-submitted.update-new-submission');

    Route::get('forms-submitted/general', [\App\Http\Controllers\SubmittedFormController::class, 'generalFormSubmitted'])->name('forms-submitted.general');
    Route::post('forms-submitted/general', [\App\Http\Controllers\SubmittedFormController::class, 'storeGeneralForm'])->name('forms-submitted.general.store');

});
