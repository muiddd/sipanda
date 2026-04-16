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
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/ai/process', [ChatController::class, 'processAi'])->name('ai.process');
});