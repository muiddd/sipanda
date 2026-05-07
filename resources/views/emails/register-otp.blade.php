<x-mail::message>
# Verifikasi Akun siPanda

Terima kasih telah mendaftar di siPanda. Gunakan kode OTP di bawah ini untuk menyelesaikan pendaftaran Anda:

<x-mail::panel>
# {{ $otp }}
</x-mail::panel>

Kode ini akan berlaku selama 10 menit. Jangan berikan kode ini kepada siapa pun.

Jika Anda tidak merasa mendaftar di siPanda, silakan abaikan email ini.

Terima kasih,<br>
Admin {{ config('app.name') }}
</x-mail::message>
