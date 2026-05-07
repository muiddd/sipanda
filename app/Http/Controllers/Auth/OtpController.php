<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function showOtpForm(Request $request)
    {
        $email = $request->email;
        if (!$email) {
            return redirect()->route('register');
        }
        return view('auth.otp', ['email' => $email]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);

        $cachedData = Cache::get('otp_reg_' . $request->email);

        if (!$cachedData) {
            return back()->withErrors(['otp' => 'Kode OTP kadaluarsa atau sesi pendaftaran berakhir.']);
        }

        if ($cachedData['otp'] != $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        // Jika benar, buat user
        $user = User::create([
            'name' => $cachedData['name'],
            'email' => $cachedData['email'],
            'password' => $cachedData['password'],
        ]);

        // Hapus cache
        Cache::forget('otp_reg_' . $request->email);

        // Login user
        Auth::login($user);

        return redirect('/dashboard');
    }

    public function resendOtp(Request $request)
    {
        $email = $request->email ?? session('reg_email');
        $cachedData = Cache::get('otp_reg_' . $email);

        if (!$cachedData) {
            return redirect()->route('register')->withErrors(['email' => 'Sesi pendaftaran berakhir. Silakan daftar ulang.']);
        }

        $otp = rand(100000, 999999);
        $cachedData['otp'] = $otp;
        Cache::put('otp_reg_' . $email, $cachedData, now()->addMinutes(10));

        Mail::to($email)->send(new RegisterOtpMail($otp));

        return back()->with('message', 'Kode OTP baru telah dikirim.');
    }
}
