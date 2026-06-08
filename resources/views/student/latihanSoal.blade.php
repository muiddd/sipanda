<!DOCTYPE html>
<html lang="en" id="main-html">

<head>
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>siPanda - Latihan Soal</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

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

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .font-heading {
            font-family: 'Outfit', sans-serif;
            letter-spacing: -0.01em;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03);
            border-radius: 1.5rem;
            transition: all 0.3s ease;
        }

        .dark .glass {
            background: rgba(18, 18, 18, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), inset 0 2px 0 rgba(255, 255, 255, 0.05);
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

        .orb-1 {
            width: 500px;
            height: 500px;
            background: #75cb50;
            top: -100px;
            right: -100px;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: #00ac73;
            bottom: 10%;
            left: -50px;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f8fafc;
        }

        .dark ::-webkit-scrollbar-track {
            background: #121212;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #2a2a2a;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #75cb50;
        }
    </style>
</head>

<body class="relative min-h-screen">

    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>

    <div class="flex min-h-screen">
        @include('student.partials.sidebar')

        <main class="ml-0 lg:ml-72 flex-1 p-8 px-10 xl:px-14 min-h-screen pt-20 lg:pt-8">

            {{-- Header --}}
            <header class="flex flex-col md:flex-row md:justify-between md:items-end mb-12 gap-6 pt-4">
                <div>
                    <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white transition-colors">
                        Latihan <span class="text-[#75cb50]">Soal</span>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 font-medium">
                        Pilih materi pembelajaran untuk menguji pemahamanmu dengan AI siPanda.
                    </p>
                </div>
            </header>

            {{-- Grid Kartu Materi (Dinamis dari Database) --}}
            @if($materis->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($materis as $materi)
                <div class="glass p-6 group cursor-pointer hover:border-[#75cb50]/50 transition-all relative overflow-hidden flex flex-col justify-between min-h-[250px]">
                    <div class="absolute -right-6 -top-6 text-slate-400/10 dark:text-slate-500/5 group-hover:scale-110 group-hover:-rotate-12 transition-all duration-500 pointer-events-none">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-[#75cb50]/10 flex items-center justify-center text-[#75cb50] mb-4 border border-[#75cb50]/20 group-hover:bg-[#75cb50]/20 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        {{-- Mengambil judul dari database --}}
                        <h3 class="font-heading text-xl font-bold text-slate-900 dark:text-white mb-2">
                            {{ $materi->judul_materi ?? $materi->title ?? 'Tanpa Judul' }}
                        </h3>
                        {{-- Menampilkan kategori materi --}}
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                            Kategori: <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $materi->kategori ? $materi->kategori->nama_kategori : 'Umum' }}</span>
                        </p>
                    </div>
                    <div class="mt-6 flex justify-between items-center">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded-lg">
                            Generate AI
                        </span>
                        <a href="{{ route('student.latihansoal.show', $materi->materi_id) }}" class="bg-[#75cb50] hover:bg-[#64b043] text-white px-4 py-2 rounded-xl font-bold text-sm transition-all active:scale-95 shadow-lg shadow-green-500/20 inline-block">
                            Mulai Kuis
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            {{-- Tampilan Kosong Jika Belum Ada Materi --}}
            <div class="text-center py-20 glass flex flex-col items-center justify-center">
                <div class="flex justify-center mb-6 text-slate-400/80">
                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <h3 class="font-heading text-xl font-bold text-slate-900 dark:text-white">Belum Ada Materi</h3>
                <p class="text-slate-500 mt-2">Tunggu gurumu menambahkan materi pembelajaran terlebih dahulu ya!</p>
            </div>
            @endif

        </main>
    </div>

    <x-pomodoro-timer />

    <script>
        // No custom page theme-toggle is needed here as it is globally managed by the sidebar.
    </script>
</body>

</html>