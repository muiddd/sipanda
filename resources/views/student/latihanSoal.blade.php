<!DOCTYPE html>
<html lang="en" id="main-html" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>siPanda - Latihan Soal</title>
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

        h1, h2, h3, h4, h5, h6, .font-heading {
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

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        .dark ::-webkit-scrollbar-track { background: #121212; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #2a2a2a; }
        ::-webkit-scrollbar-thumb:hover { background: #75cb50; }
    </style>
</head>
<body class="relative min-h-screen">

    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>

    <div class="flex min-h-screen">
        @include('student.partials.sidebar')

        <main class="ml-72 flex-1 p-8 px-10 xl:px-14 min-h-screen">

            {{-- Header --}}
            <header class="flex flex-col md:flex-row md:justify-between md:items-end mb-12 gap-6 pt-4">
                <div>
                    <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white transition-colors">
                        Latihan <span class="text-[#75cb50]">Materi</span> 📚
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 font-medium">
                        Pilih topik yang ingin kamu kuasai hari ini.
                    </p>
                </div>

            </header>

            {{-- Grid Kartu Materi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                {{-- Kartu 1: Struktur Data --}}
                <div class="glass p-6 group cursor-pointer hover:border-[#75cb50]/50 transition-all relative overflow-hidden flex flex-col justify-between min-h-[250px]">
                    <div class="absolute -right-4 -top-4 text-6xl opacity-5 group-hover:opacity-10 transition-all">📘</div>
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-[#75cb50]/10 flex items-center justify-center text-2xl mb-4 border border-[#75cb50]/20">
                            📗
                        </div>
                        <h3 class="font-heading text-xl font-bold text-slate-900 dark:text-white mb-2">Struktur Data</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Array, Stack, Queue, dan Linked List.</p>
                    </div>
                    <div class="mt-6 flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-400 uppercase">15 Soal</span>
                        <button class="bg-[#75cb50] hover:bg-[#64b043] text-white px-4 py-2 rounded-xl font-bold text-sm transition-all active:scale-95 shadow-lg shadow-green-500/20">
                            Mulai
                        </button>
                    </div>
                </div>

                {{-- Kartu 2: Algoritma Dasar --}}
                <div class="glass p-6 group cursor-pointer hover:border-blue-500/50 transition-all relative overflow-hidden flex flex-col justify-between min-h-[250px]">
                    <div class="absolute -right-4 -top-4 text-6xl opacity-5 group-hover:opacity-10 transition-all">💡</div>
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center text-2xl mb-4 border border-blue-500/20">
                            💻
                        </div>
                        <h3 class="font-heading text-xl font-bold text-slate-900 dark:text-white mb-2">Algoritma Dasar</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Logika dasar pemrograman dan urutan instruksi.</p>
                    </div>
                    <div class="mt-6 flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-400 uppercase">10 Soal</span>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl font-bold text-sm transition-all active:scale-95 shadow-lg shadow-blue-500/20">
                            Mulai
                        </button>
                    </div>
                </div>


            </div>
        </main>
    </div>

    <script>
        const htmlElement = document.getElementById('main-html');

        // Cek local storage untuk tema, sinkron dengan sidebar
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlElement.classList.add('dark');
        } else {
            htmlElement.classList.remove('dark');
        }

        // Sinkronisasi ikon tema di sidebar (dark/light icon)
        document.addEventListener('DOMContentLoaded', () => {
            const darkIcon  = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');

            // Tampilkan ikon yang sesuai saat load
            if (htmlElement.classList.contains('dark')) {
                lightIcon?.classList.remove('hidden');
            } else {
                darkIcon?.classList.remove('hidden');
            }

            // Toggle tema saat tombol di sidebar diklik
            const themeToggleBtn = document.getElementById('theme-toggle');
            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', () => {
                    darkIcon?.classList.toggle('hidden');
                    lightIcon?.classList.toggle('hidden');

                    if (htmlElement.classList.contains('dark')) {
                        htmlElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        htmlElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                });
            }
        });
    </script>

</body>
</html>