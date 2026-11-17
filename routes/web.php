<?php

use App\Http\Controllers\DonorRegistrationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/donneur/inscription', [DonorRegistrationController::class, 'create'])
    ->name('donors.create');

Route::post('/donneur/inscription', [DonorRegistrationController::class, 'store'])
    ->middleware('throttle:donor-registration')
    ->name('donors.store');

Route::get('/donneur/inscription/merci', [DonorRegistrationController::class, 'thanks'])
    ->name('donors.thanks');
