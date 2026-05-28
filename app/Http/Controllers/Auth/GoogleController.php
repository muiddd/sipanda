<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and log them in / register them.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Exception $e) {
            Log::error('Google Auth Error: ' . $e->getMessage());
            return redirect('/sipanda/login')->withErrors([
                'email' => 'Gagal masuk dengan Google. Silakan coba lagi.'
            ]);
        }

        // 1. Cari user berdasarkan google_id
        $user = User::where('google_id', $googleUser->id)->first();

        if ($user) {
            Auth::login($user);
            return redirect()->intended('/dashboard');
        }

        // 2. Cari user berdasarkan email (jika google_id belum terhubung)
        $userByEmail = User::where('email', $googleUser->email)->first();

        if ($userByEmail) {
            // Hubungkan akun Google ke user yang sudah ada
            $userByEmail->update([
                'google_id' => $googleUser->id,
                'foto_profile' => $userByEmail->foto_profile ?? $googleUser->avatar,
            ]);

            Auth::login($userByEmail);
            return redirect()->intended('/dashboard');
        }

        // 3. Jika belum terdaftar, buat user baru (Sign Up langsung via Google)
        $newUser = User::create([
            'name' => $googleUser->name ?? $googleUser->nickname ?? 'Google User',
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            'password' => Hash::make(Str::random(24)), // Random password aman
            'foto_profile' => $googleUser->avatar,
            'role' => 'user', // Default role untuk student/user biasa
        ]);

        Auth::login($newUser);

        return redirect('/dashboard');
    }
}
