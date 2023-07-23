<?php

use App\Http\Controllers\Frontend\Auth\ConfirmPasswordController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\Auth\VerificationController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        // Home page
        Route::get('/', [PageController::class, 'index'])->name('home');

        Route::group(['middleware' => ['auth']], function () {
            // Logout Routes
            Route::post('logout', [LoginController::class, 'logout'])->name('logout');
            // Profile Routes
            Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
        });

        // Registration Routes
        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [RegisterController::class, 'register']);

        // Login Routes
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);

        // Password Reset Routes
        Route::get(
            'password/reset',
            [ForgotPasswordController::class, 'showLinkRequestForm']
        )->name('password.request');
        Route::post(
            'password/email',
            [ForgotPasswordController::class, 'sendResetLinkEmail']
        )->name('password.email');
        Route::get(
            'password/reset/{token}',
            [ResetPasswordController::class, 'showResetForm']
        )->name('password.reset');
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

        // Password Confirmation Routes
        Route::get(
            'password/confirm',
            [ConfirmPasswordController::class, 'showConfirmForm']
        )->name('password.confirm');
        Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

        // Email Verification Routes
        Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
        Route::get(
            'email/verify/{id}/{hash}',
            [VerificationController::class, 'verify']
        )->name('verification.verify');
        Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    }
);
