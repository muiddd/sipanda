<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\ChatController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/login', function () {
//     return redirect()->route('filament.admin.auth.login');
// })->name('login');

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
});