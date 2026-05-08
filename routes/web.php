<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Student\ChatController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\MateriController;
use App\Http\Controllers\Student\GamifikasiController;
use App\Http\Controllers\Student\LatihanSoalController;
use App\Http\Controllers\Student\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('student.dashboard');
    }
    return view('welcome');
});

// ==========================================
// AUTHENTICATION ROUTES
// ==========================================
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

// ==========================================
// STUDENT AREA ROUTES 
// ==========================================
Route::middleware([
    \Filament\Http\Middleware\Authenticate::class,
])->group(function () {
    
    // 1. Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('student.dashboard');
    
    // 2. Materi
    Route::get('/materi', [MateriController::class, 'index'])->name('student.materi');
    
    // 3. Gamifikasi & Sesi Belajar
    Route::get('/gamifikasi', [GamifikasiController::class, 'index'])->name('student.gamifikasi');
    Route::post('/learning-session', [GamifikasiController::class, 'storeLearningSession'])->name('student.learning-session.store');
    
    // 4. Latihan Soal
    Route::get('/latihansoal', [LatihanSoalController::class, 'index'])->name('student.latihansoal');
    
    // 5. Proses AI & Chatbot
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/ai/process', [ChatController::class, 'processAi'])->name('ai.process');
    
    // 6. Settings & Profile
    Route::get('/settings', function () {
        return view('student.settings');
    })->name('student.settings');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('student.settings.profile');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('student.settings.password');
});