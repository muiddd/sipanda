<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\ChatController;
use App\Http\Controllers\Auth\OtpController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('student.dashboard');
    }
    return view('welcome');
});

// Auth Routes
Route::get('/register', function() {
    return redirect('/sipanda/register');
})->name('register');

Route::get('/register/otp', [OtpController::class, 'showOtpForm'])->name('register.otp');
Route::post('/register/otp', [OtpController::class, 'verifyOtp'])->name('register.otp.verify');
Route::post('/register/otp/resend', [OtpController::class, 'resendOtp'])->name('register.otp.resend');

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Middleware filament
Route::middleware([
    \Filament\Http\Middleware\Authenticate::class,
])->group(function () {
    Route::get('/dashboard', [ChatController::class, 'index'])->name('student.dashboard');
    Route::get('/settings', function () {
        return view('student.settings');
    })->name('student.settings');
    Route::put('/settings/profile', [App\Http\Controllers\Student\SettingsController::class, 'updateProfile'])->name('student.settings.profile');
    Route::put('/settings/password', [App\Http\Controllers\Student\SettingsController::class, 'updatePassword'])->name('student.settings.password');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/ai/process', [ChatController::class, 'processAi'])->name('ai.process');
    Route::post('/learning-session', [ChatController::class, 'storeLearningSession'])->name('student.learning-session.store');
    Route::get('/gamifikasi', [ChatController::class, 'gamifikasi'])->name('student.gamifikasi');
    Route::get('/latihansoal', [ChatController::class, 'latihanSoal'])->name('latihansoal');
    Route::get('/materi', [ChatController::class, 'materi'])->name('materi');
});