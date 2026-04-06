<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
//  GENERAL FORM ROUTES
Route::get('forms', [\App\Http\Controllers\FormController::class, 'index'])->name('forms.index');
Route::get('forms/general', [\App\Http\Controllers\FormController::class, 'generalForm'])->name('forms.general');
Route::post('forms/general', [\App\Http\Controllers\FormController::class, 'storeGeneralForm'])->name('forms.general.store');


// PROCESSING REQUEST FORM ROUTES

Route::get('forms/processing', [\App\Http\Controllers\FormController::class, 'processingForm'])->name('forms.processing');
Route::post('forms/processing/store', [\App\Http\Controllers\FormController::class, 'storeProcessing'])->name('forms.processing.store');


// AKSYON FORM ROUTES

Route::get('forms/aksyon', [\App\Http\Controllers\FormController::class, 'aksyonForm'])->name('forms.aksyon');
Route::post('forms/aksyon', [\App\Http\Controllers\FormController::class, 'storeAksyonForm'])->name('forms.aksyon.store');


//SENA FORM ROUTES

Route::get('forms/sena', [\App\Http\Controllers\FormController::class, 'senaForm'])->name('forms.sena');
Route::post('forms/sena', [\App\Http\Controllers\FormController::class, 'storeSenaForm'])->name('forms.sena.store');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    


    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    


});
