<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterOtpMail;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;

class CustomRegister extends BaseRegister
{
    public function register(): ?RegistrationResponse
    {
        $data = $this->form->getState();
        
        \Illuminate\Support\Facades\Log::info('Registration attempt:', $data);

        $otp = rand(100000, 999999);
        $cacheData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'otp' => $otp
        ];

        // Simpan data di cache selama 10 menit
        Cache::put('otp_reg_' . $data['email'], $cacheData, now()->addMinutes(10));
        
        // Simpan di session untuk keperluan resend
        session(['reg_email' => $data['email'], 'reg_name' => $data['name']]);

        try {
            // Kirim Email
            Mail::to($data['email'])->send(new RegisterOtpMail($otp));
            \Illuminate\Support\Facades\Log::info('OTP sent to: ' . $data['email']);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Mail failed: ' . $e->getMessage());
        }

        $this->redirect(route('register.otp', ['email' => $data['email']]));

        return null;
    }
}
