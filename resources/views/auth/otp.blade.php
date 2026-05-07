<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - siPanda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        bamboo: {
                            fresh: '#75cb50',
                            emerald: '#10b970',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@600;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #121212; color: #f2f1e8; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .glass {
            background: rgba(18, 18, 18, 0.7);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    <div class="fixed top-0 left-0 w-full h-full z-[-1]">
        <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-bamboo-fresh/10 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[400px] h-[400px] bg-bamboo-emerald/10 blur-[100px] rounded-full"></div>
    </div>

    <div class="w-full max-w-md text-center">
        <div class="mb-10">
            <div class="w-20 h-20 bg-bamboo-fresh/20 rounded-3xl flex items-center justify-center mx-auto mb-6 text-bamboo-fresh">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <h1 class="font-heading text-3xl font-black">Verifikasi Email</h1>
            <p class="text-slate-400 mt-2">Kami telah mengirimkan kode OTP ke <strong>{{ $email }}</strong></p>
        </div>

        @if(session('message'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-emerald-400 text-sm font-medium">
                {{ session('message') }}
            </div>
        @endif

        <div class="glass p-8 rounded-3xl text-left">
            <form action="{{ route('register.otp.verify') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                
                <div>
                    <label class="block text-sm font-semibold mb-3 text-center">Masukkan 6 Digit Kode OTP</label>
                    <input type="text" name="otp" maxlength="7" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-center text-3xl font-black tracking-[1em] focus:outline-none focus:border-bamboo-fresh transition-all" placeholder="000000" autofocus>
                    @error('otp') <p class="text-red-500 text-xs mt-2 text-center">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-bamboo-fresh to-bamboo-emerald text-white font-bold py-4 rounded-xl shadow-lg shadow-bamboo-fresh/20 hover:scale-[1.02] transition-all">
                    Verifikasi & Selesaikan
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-slate-400">
                Belum menerima kode? 
                <form action="{{ route('register.otp.resend') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <button type="submit" class="text-bamboo-fresh font-bold hover:underline">Kirim Ulang</button>
                </form>
            </div>
        </div>
        
        <a href="{{ route('register') }}" class="inline-block mt-8 text-slate-500 hover:text-white transition-colors text-sm font-medium">
            &larr; Kembali ke Pendaftaran
        </a>
    </div>
</body>
</html>
