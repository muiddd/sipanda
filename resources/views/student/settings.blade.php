<!DOCTYPE html>
<html lang="en" id="main-html" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - siPanda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@600;800;900&display=swap');

        body {
            background-color: #f8fafc;
            color: #0f172a;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dark body {
            background-color: #121212;
            color: #f2f1e8;
        }

        h1, h2, h3, h4, .font-heading {
            font-family: 'Outfit', sans-serif;
            letter-spacing: -0.01em;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
            border-radius: 1.5rem;
            transition: all 0.3s ease;
        }

        .dark .glass {
            background: rgba(18, 18, 18, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 40px rgba(0,0,0,0.5), inset 0 2px 0 rgba(255,255,255,0.05);
        }

        .glass-sidebar {
            border-radius: 0 1.5rem 1.5rem 0;
            border-left: none;
        }

        .holo-glow {
            box-shadow: 0 0 20px rgba(34, 197, 94, 0.15);
            transition: box-shadow 0.3s ease;
        }
        .dark .holo-glow {
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.4);
        }

        .glass-card-hover:hover {
            transform: translateY(-5px);
            border-color: rgba(34, 197, 94, 0.5);
            background: rgba(34, 197, 94, 0.05);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1), 0 0 20px rgba(34, 197, 94, 0.15);
        }
        .dark .glass-card-hover:hover {
            background: rgba(34, 197, 94, 0.03);
            box-shadow: 0 20px 40px rgba(0,0,0,0.6), 0 0 20px rgba(34, 197, 94, 0.15), inset 0 2px 0 rgba(255,255,255,0.1);
        }

        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
            opacity: 0.1;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .dark .bg-orb {
            opacity: 0.25;
        }
        .orb-1 { width: 500px; height: 500px; background: #75cb50; top: -100px; right: -100px; }
        .orb-2 { width: 400px; height: 400px; background: #00ac73; bottom: 10%; left: -50px; }

        .glass-input {
            @apply bg-white/50 dark:bg-white/5 border-black/10 dark:border-white/10 focus:ring-[#75cb50] focus:border-[#75cb50];
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .dark .glass-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glass-input:focus {
            outline: none;
            border-color: #75cb50;
            box-shadow: 0 0 0 4px rgba(117, 203, 80, 0.2);
            background: rgba(255, 255, 255, 0.8);
        }
        .dark .glass-input:focus {
            background: rgba(255, 255, 255, 0.08);
        }

        /* Toggle Switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0,0,0,0.1);
            transition: .4s;
            border-radius: 24px;
        }
        .dark .slider { background-color: rgba(255,255,255,0.1); }
        .slider:before {
            position: absolute;
            content: "";
            height: 18px; width: 18px;
            left: 3px; bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        input:checked + .slider { background-color: #75cb50; }
        input:checked + .slider:before { transform: translateX(20px); }
    </style>
</head>
<body class="relative min-h-screen">

    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>

    <div class="flex min-h-screen">
        
        @include('student.partials.sidebar')

        <main class="ml-72 flex-1 p-8 px-10 xl:px-14 min-h-screen">
            
            <header class="mb-12 pt-4">
                <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white transition-colors">Pengaturan Akun</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 font-medium">Kelola profil, keamanan, dan preferensi aplikasi Anda.</p>
            </header>

            @if (session('message'))
                <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl flex gap-3 items-center">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <p class="text-sm text-emerald-600 dark:text-emerald-400 font-medium">{{ session('message') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                
                <!-- Profile Card -->
                <div class="glass p-8 glass-card-hover group">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-[#75cb50]/10 flex items-center justify-center text-[#75cb50] border border-[#75cb50]/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h2 class="font-heading text-2xl font-bold text-slate-900 dark:text-white">Profil Pengguna</h2>
                    </div>

                    <form action="{{ route('student.settings.profile') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col md:flex-row items-center gap-6 mb-8">
                            <div class="relative group/avatar">
                                <div class="w-24 h-24 rounded-3xl bg-gradient-to-tr from-[#75cb50] to-[#10b981] flex items-center justify-center font-black text-white text-3xl shadow-xl shadow-[#75cb50]/20">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="flex-1 text-center md:text-left">
                                <p class="text-slate-900 dark:text-white font-bold text-lg leading-none mb-1">Foto Profil</p>
                                <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Foto profil saat ini</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2 ml-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full glass-input rounded-xl px-5 py-3.5 text-slate-900 dark:text-white font-medium" />
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2 ml-1">Alamat Email</label>
                                <input type="email" value="{{ auth()->user()->email }}" class="w-full glass-input rounded-xl px-5 py-3.5 text-slate-900/50 dark:text-white/50 font-medium cursor-not-allowed" readonly />
                                <p class="text-[10px] text-slate-400 mt-1 ml-1">Email tidak dapat diubah.</p>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-[#75cb50] to-[#10b981] hover:from-[#10b981] hover:to-[#059669] text-white font-bold py-4 rounded-2xl shadow-lg shadow-[#75cb50]/20 holo-glow transition-all hover:scale-[1.01] flex items-center justify-center gap-2 mt-4">
                            <span>Simpan Perubahan</span>
                        </button>
                    </form>
                </div>

                <!-- Password Card -->
                <div class="glass p-8 glass-card-hover group">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-[#75cb50]/10 flex items-center justify-center text-[#75cb50] border border-[#75cb50]/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <h2 class="font-heading text-2xl font-bold text-slate-900 dark:text-white">Keamanan Akun</h2>
                    </div>

                    <form action="{{ route('student.settings.password') }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2 ml-1">Password Saat Ini</label>
                                <input type="password" name="current_password" placeholder="••••••••" class="w-full glass-input rounded-xl px-5 py-3.5 text-slate-900 dark:text-white font-medium" />
                                @error('current_password', 'updatePassword')
                                    <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2 ml-1">Password Baru</label>
                                <input type="password" name="password" placeholder="••••••••" class="w-full glass-input rounded-xl px-5 py-3.5 text-slate-900 dark:text-white font-medium" />
                                @error('password', 'updatePassword')
                                    <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2 ml-1">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" placeholder="••••••••" class="w-full glass-input rounded-xl px-5 py-3.5 text-slate-900 dark:text-white font-medium" />
                            </div>
                        </div>

                        <div class="p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-2xl flex gap-3 items-start">
                            <svg class="w-5 h-5 text-yellow-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-xs text-yellow-600 dark:text-yellow-400 font-medium leading-relaxed">Pastikan password baru Anda minimal 8 karakter dengan kombinasi angka dan simbol.</p>
                        </div>

                        <button type="submit" class="w-full bg-[#75cb50] hover:bg-[#10b981] text-white font-bold py-4 rounded-2xl shadow-lg shadow-[#75cb50]/10 transition-all hover:scale-[1.01] mt-2">
                            Perbarui Keamanan
                        </button>
                    </form>
                </div>

                <!-- Account Actions Card -->
                <div class="glass p-8 glass-card-hover group border-red-500/10 dark:border-red-500/20">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-red-500/10 flex items-center justify-center text-red-500 border border-red-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <h2 class="font-heading text-2xl font-bold text-slate-900 dark:text-white">Danger Zone</h2>
                    </div>

                    <p class="text-red-500/80 text-sm font-medium mb-8 leading-relaxed">Tindakan berikut bersifat permanen dan tidak dapat dibatalkan. Mohon berhati-hati sebelum melanjutkan.</p>

                    <div class="space-y-4">
                        <form action="{{ route('filament.admin.auth.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 text-slate-900 dark:text-white font-bold py-4 rounded-2xl transition-all flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar Akun
                            </button>
                        </form>
                        
                        <button class="w-full bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white font-bold py-4 rounded-2xl border border-red-500/20 transition-all flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus Akun Permanen
                        </button>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const htmlElement = document.getElementById('main-html');
        const modeText = document.getElementById('mode-text');
        const modeIconContainer = document.getElementById('mode-icon-container');

        function updateModeStatus(isDark) {
            if (isDark) {
                if(modeText) modeText.innerText = "Aktif - Nyaman di mata.";
                if(modeIconContainer) modeIconContainer.innerHTML = '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>';
                if(modeIconContainer) modeIconContainer.classList.add('text-indigo-400');
                if(modeIconContainer) modeIconContainer.classList.remove('text-yellow-500');
            } else {
                if(modeText) modeText.innerText = "Nonaktif - Mode Terang.";
                if(modeIconContainer) modeIconContainer.innerHTML = '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>';
                if(modeIconContainer) modeIconContainer.classList.add('text-yellow-500');
                if(modeIconContainer) modeIconContainer.classList.remove('text-indigo-400');
            }
        }

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlElement.classList.add('dark');
            themeToggleLightIcon.classList.remove('hidden');
            updateModeStatus(true);
        } else {
            htmlElement.classList.remove('dark');
            themeToggleDarkIcon.classList.remove('hidden');
            updateModeStatus(false);
        }

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (htmlElement.classList.contains('dark')) {
                htmlElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
                updateModeStatus(false);
            } else {
                htmlElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
                updateModeStatus(true);
            }
        });
    </script>
</body>
</html>
