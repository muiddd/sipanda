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
    <title>siPanda - Learning Dashboard</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Konfigurasi agar tailwind mendeteksi class 'dark'
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@600;800;900&display=swap');

        body {
            /* Warna Light Mode */
            background-color: #f8fafc;
            color: #0f172a;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Warna Dark Mode (Original) */
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

        /* Glassmorphism Critical Rules - Light Mode */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03);
            border-radius: 1.5rem;
            transition: all 0.3s ease;
        }

        /* Glassmorphism - Dark Mode (Original) */
        .dark .glass {
            background: rgba(18, 18, 18, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), inset 0 2px 0 rgba(255, 255, 255, 0.05);
        }

        .glass-sidebar {
            border-radius: 0 1.5rem 1.5rem 0;
            border-left: none;
        }

        .glass-pill {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 9999px;
            transition: all 0.3s ease;
        }

        .dark .glass-pill {
            background: rgba(18, 18, 18, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.05);
        }

        /* Glow Effects */
        .holo-glow {
            box-shadow: 0 0 20px rgba(34, 197, 94, 0.15);
            transition: box-shadow 0.3s ease;
        }

        .dark .holo-glow {
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.4);
        }

        .holo-glow:hover {
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.3);
        }

        .dark .holo-glow:hover {
            box-shadow: 0 0 40px rgba(34, 197, 94, 0.6);
        }

        .glass-card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card-hover:hover {
            transform: translateY(-5px);
            border-color: rgba(34, 197, 94, 0.5);
            background: rgba(34, 197, 94, 0.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1), 0 0 20px rgba(34, 197, 94, 0.15);
        }

        .dark .glass-card-hover:hover {
            background: rgba(34, 197, 94, 0.03);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 0 0 20px rgba(34, 197, 94, 0.15), inset 0 2px 0 rgba(255, 255, 255, 0.1);
        }

        /* Ambient Orbs */
        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
            opacity: 0.1;
            /* Light mode opacity */
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .dark .bg-orb {
            opacity: 0.25;
            /* Dark mode opacity */
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

        /* Custom Scrollbar */
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

        <!-- sideabar -->
        @include('student.partials.sidebar')

        <main class="ml-0 lg:ml-72 flex-1 p-8 px-10 xl:px-14 min-h-screen pt-20 lg:pt-8">

            <header class="flex flex-col md:flex-row md:justify-between md:items-end mb-12 gap-6 pt-4">
                @auth
                <div>
                    <h1
                        class="font-heading text-4xl font-black text-slate-900 dark:text-white transition-colors flex items-center gap-2">
                        Halo, {{ auth()->user()->name }}
                        <svg class="w-8 h-8 text-[#75cb50] animate-pulse" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                            </path>
                        </svg>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 font-medium">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </p>
                </div>
                @endauth
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="glass p-6 group cursor-default">
                    <div class="flex justify-between items-start">
                        <div>
                            <p
                                class="text-slate-500 dark:text-slate-400 text-sm font-semibold mb-1 uppercase tracking-wider text-[11px]">
                                Kartu Hari Ini</p>
                            <h2
                                class="font-heading text-4xl font-black text-slate-900 dark:text-white transition-colors">
                                0</h2>
                        </div>
                        <div
                            class="w-12 h-12 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-[#10b981] border border-[#75cb50]/20 group-hover:bg-[#75cb50]/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-1.5">
                        <span
                            class="text-[#75cb50] bg-[#75cb50]/10 px-1.5 py-0.5 rounded text-[10px] font-bold flex items-center">
                            <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg> 0%
                        </span>
                        <span class="text-xs text-slate-500 font-medium">dari kemarin</span>
                    </div>
                </div>

                <div class="glass p-6 group cursor-default">
                    <div class="flex justify-between items-start">
                        <div>
                            <p
                                class="text-slate-500 dark:text-slate-400 text-sm font-semibold mb-1 uppercase tracking-wider text-[11px]">
                                Streak</p>
                             <h2
                                class="font-heading text-4xl font-black text-[#ff8c00] drop-shadow-[0_0_10px_rgba(255,140,0,0.3)] transition-colors">
                                {{ auth()->user()->streak->current_streak ?? 0 }} <span class="text-xl text-slate-500 dark:text-slate-400 font-medium">hari</span></h2>
                        </div>
                        <div
                            class="w-12 h-12 rounded-xl bg-[rgba(255,140,0,0.1)] flex items-center justify-center text-[#ff8c00] border border-[#ff8c00]/20 group-hover:bg-[#ff8c00]/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    @if((auth()->user()->streak->current_streak ?? 0) > 0)
                        <p class="text-xs text-slate-500 mt-5 font-medium">Rekor tertinggi: {{ auth()->user()->streak->longest_streak ?? 0 }} hari</p>
                    @else
                        <p class="text-xs text-slate-500 mt-5 font-medium">Belum ada streak dibangun</p>
                    @endif
                </div>

                <div class="glass p-6 group cursor-default">
                    <div class="flex justify-between items-start">
                        <div>
                            <p
                                class="text-slate-500 dark:text-slate-400 text-sm font-semibold mb-1 uppercase tracking-wider text-[11px]">
                                Level</p>
                            <h2
                                class="font-heading text-4xl font-black text-[#75cb50] drop-shadow-[0_0_10px_rgba(34,197,94,0.3)]">
                                Lvl 1</h2>
                        </div>
                        <div
                            class="w-12 h-12 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-[#10b981] border border-[#75cb50]/20 group-hover:bg-[#75cb50]/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div
                        class="mt-5 w-full bg-slate-200 dark:bg-[#2a2a2a] rounded-full h-1.5 overflow-hidden border border-black/5 dark:border-white/5">
                        <div class="bg-gradient-to-r from-[#10b981] to-[#75cb50] h-1.5 rounded-full" style="width: 10%">
                        </div>
                    </div>
                </div>

                <div class="glass p-6 group cursor-default">
                    <div class="flex justify-between items-start">
                        <div>
                            <p
                                class="text-slate-500 dark:text-slate-400 text-sm font-semibold mb-1 uppercase tracking-wider text-[11px]">
                                Rank</p>
                            <h2
                                class="font-heading text-4xl font-black text-slate-900 dark:text-white transition-colors">
                                #0</h2>
                        </div>
                        <div
                            class="w-12 h-12 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-[#10b981] border border-[#75cb50]/20 group-hover:bg-[#75cb50]/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mt-5 font-medium">Ayo tingkatkan prestasimu!</p>
                </div>
            </div>

            <div
                class="glass p-10 lg:p-16 flex flex-col items-center justify-center text-center relative overflow-hidden group border-t border-t-[#75cb50]/20 mt-10">
                <div
                    class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-[#75cb50]/10 to-transparent opacity-60 pointer-events-none">
                </div>
                <div
                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxjaXJjbGUgY3g9IjMiIGN5PSIzIiByPSIxIiBmaWxsPSJyZ2JhKDAsMCwwLDAuMDUpIi8+PC9zdmc+')] dark:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxjaXJjbGUgY3g9IjMiIGN5PSIzIiByPSIxIiBmaWxsPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDMpIi8+PC9zdmc+')] opacity-50 z-0">
                </div>

                <div
                    class="relative z-10 w-24 h-24 rounded-3xl bg-gradient-to-br from-[#10b981]/20 to-[#75cb50]/5 mb-8 flex items-center justify-center border border-[#75cb50]/30 holo-glow group-hover:scale-110 transition-transform duration-700 ease-out shadow-[inset_0_0_20px_rgba(34,197,94,0.2)]">
                    <svg class="w-10 h-10 text-[#75cb50] drop-shadow-[0_0_15px_rgba(34,197,94,0.8)] animate-pulse"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                        </path>
                    </svg>
                </div>

                <h2
                    class="relative z-10 font-heading text-4xl lg:text-5xl font-black text-slate-900 dark:text-white mb-5 tracking-tight transition-colors">
                    Mulai Belajar dengan <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-[#75cb50] to-[#10b981]">AI</span>
                </h2>
                <p class="relative z-10 text-slate-500 dark:text-slate-400 text-lg mb-12 max-w-2xl leading-relaxed">
                    Upload materi belajarmu dan biarkan AI membuat ringkasan materi serta latihan soal secara otomatis
                    dalam hitungan detik. Cerdas, cepat, dan efisien.
                </p>

                <form action="{{ route('ai.process') }}" method="POST" enctype="multipart/form-data"
                    class="w-full relative z-10 max-w-3xl mx-auto glass p-8 rounded-3xl flex flex-col md:flex-row items-center gap-8 border border-[#75cb50]/20 bg-white/50 dark:bg-[#121212]/50 shadow-[0_10px_40px_rgba(34,197,94,0.1)]">
                    @csrf

                    <!-- File Upload Area -->
                    <div class="flex-1 w-full relative">
                        <label
                            class="block text-left text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3 ml-1">Upload
                            Materi <span class="text-xs font-normal text-slate-500">(PDF, DOCX, PPT)</span></label>
                        <label id="dropzone-container"
                            class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-[#75cb50]/40 rounded-2xl cursor-pointer bg-[#75cb50]/5 hover:bg-[#75cb50]/10 hover:border-[#75cb50]/60 transition-all duration-300 group">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <div id="upload-icon"
                                    class="mb-3 filter drop-shadow-[0_0_10px_rgba(34,197,94,0.3)] group-hover:scale-110 transition-transform">
                                    <svg class="w-10 h-10 text-[#75cb50]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                </div>
                                <p id="file-name" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Pilih
                                    file materi</p>
                                <p id="upload-subtext" class="text-xs text-slate-500 mt-1 font-medium">atau drag & drop
                                    ke sini</p>
                            </div>
                            <input type="file" id="file-upload" name="file" class="hidden"
                                accept=".pdf,.doc,.docx,.ppt,.pptx" />
                        </label>
                    </div>

                    <!-- Action Selection (Summary Only) -->
                    <div class="flex-1 w-full flex flex-col justify-center mt-2 md:mt-0 text-left">
                        <input type="hidden" name="action" value="summary">

                        <div class="mb-5 px-2">
                            <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Meringkas Otomatis
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed font-medium">AI siPanda akan membaca file
                                Anda secara mendalam dan mengekstrak poin-poin terpentingnya ke dalam format yang rapi
                                dan mudah dipahami.</p>
                        </div>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-[#75cb50] to-[#10b981] hover:from-[#10b981] hover:to-[#059669] text-white font-bold py-4 px-6 rounded-xl shadow-[0_0_20px_rgba(34,197,94,0.3)] transition-all hover:scale-[1.02] hover:shadow-[0_0_25px_rgba(34,197,94,0.4)] flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span>Upload & Ringkas File</span>
                        </button>
                    </div>
                </form>
                {{-- TEMPAT MENAMPILKAN ERROR JIKA PDF/AI GAGAL --}}
                @if(session('error'))
                <div
                    class="mt-8 relative z-10 w-full max-w-3xl mx-auto bg-red-500/10 border border-red-500/30 text-red-500 px-6 py-4 rounded-xl flex items-center gap-4 animate-in fade-in slide-in-from-top-4">
                    <svg class="w-8 h-8 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-bold text-sm">Gagal Memproses File</h4>
                        <p class="font-medium text-xs mt-0.5 opacity-80">{{ session('error') }}</p>
                    </div>
                </div>
                @endif

                {{-- KOTAK HASIL RANGKUMAN DARI UPLOAD PDF --}}
                @if(session('ai_summary'))
                <div id="ai-summary-result"
                    class="mt-16 w-full max-w-4xl mx-auto bg-[#75cb50]/5 dark:bg-[#75cb50]/10 border-2 border-[#75cb50]/30 rounded-3xl p-8 md:p-10 relative overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-500 text-left">
                    <div class="flex items-center gap-4 mb-8 border-b border-[#75cb50]/20 pb-6">
                        <div
                            class="w-14 h-14 rounded-2xl bg-[#75cb50] flex items-center justify-center text-white shadow-lg shadow-green-500/30">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-heading text-2xl font-bold text-slate-900 dark:text-white">Rangkuman AI</h3>
                            <p class="text-sm text-[#75cb50] font-bold uppercase tracking-wider mt-1">Dari File Upload
                                Anda</p>
                        </div>
                    </div>

                    {{-- Render Markdown persis seperti di Ruang Baca --}}
                    <div
                        class="prose prose-slate dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 leading-relaxed text-lg">
                        {!! Str::markdown(session('ai_summary')) !!}
                    </div>
                </div>

                {{-- Script otomatis scroll ke bawah jika hasil/error muncul --}}
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const resultBox = document.getElementById('ai-summary-result');
                        if (resultBox) {
                            resultBox.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }
                    });
                </script>
                @endif
            </div>


            <div id="ai-output-container" class="mt-8 space-y-6">

                @if(isset($summary))
                <div
                    class="glass p-10 lg:p-16 flex flex-col relative overflow-hidden group border-t border-t-[#75cb50]/30 mt-10 animate-in fade-in slide-in-from-bottom-4 duration-500 text-left">
                    <div
                        class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-[#75cb50]/10 to-transparent opacity-60 pointer-events-none">
                    </div>
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxjaXJjbGUgY3g9IjMiIGN5PSIzIiByPSIxIiBmaWxsPSJyZ2JhKDAsMCwwLDAuMDUpIi8+PC9zdmc+')] dark:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxjaXJjbGUgY3g9IjMiIGN5PSIzIiByPSIxIiBmaWxsPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDMpIi8+PC9zdmc+')] opacity-50 z-0">
                    </div>

                    <div class="relative z-10 flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 rounded-xl bg-[#75cb50]/20 flex items-center justify-center text-[#75cb50]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-heading text-xl font-bold text-slate-900 dark:text-white">Rangkuman Materi
                            </h3>
                            <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Processed by siPanda
                                AI</p>
                        </div>
                    </div>

                    <div
                        class="relative z-10 prose prose-slate dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 leading-relaxed italic">
                        {!! Str::markdown($summary->summary_text ?? '') !!}
                    </div>

                    <div class="relative z-10 mt-6 pt-6 border-t border-black/5 dark:border-white/5 flex justify-end">
                        <button class="text-sm font-bold text-[#75cb50] hover:underline flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                </path>
                            </svg>
                            Download PDF
                        </button>
                    </div>
                </div>
                @endif

                @if(session('quiz_result'))
                <div
                    class="glass p-10 lg:p-16 flex flex-col relative overflow-hidden group border-t border-t-blue-500/30 mt-10 animate-in fade-in slide-in-from-bottom-4 duration-700 text-left">
                    <div
                        class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-blue-500/10 to-transparent opacity-60 pointer-events-none">
                    </div>
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxjaXJjbGUgY3g9IjMiIGN5PSIzIiByPSIxIiBmaWxsPSJyZ2JhKDAsMCwwLDAuMDUpIi8+PC9zdmc+')] dark:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxjaXJjbGUgY3g9IjMiIGN5PSIzIiByPSIxIiBmaWxsPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDMpIi8+PC9zdmc+')] opacity-50 z-0">
                    </div>

                    <div class="relative z-10 flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-blue-500/20 flex items-center justify-center text-blue-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-heading text-xl font-bold text-slate-900 dark:text-white">Latihan Soal</h3>
                            <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Uji Pemahamanmu</p>
                        </div>
                    </div>

                    <div class="relative z-10 space-y-4 text-slate-700 dark:text-slate-300">
                        <div
                            class="whitespace-pre-line bg-black/5 dark:bg-white/5 p-6 rounded-2xl border border-black/5 dark:border-white/5 font-medium leading-relaxed">
                            {!! session('quiz_result') !!}
                        </div>
                    </div>

                    <div class="relative z-10 mt-6 flex gap-3">
                        <button
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-blue-500/20">
                            Kerjakan Sekarang
                        </button>
                        <button
                            class="px-6 py-3 glass border-blue-500/20 text-blue-500 font-bold rounded-xl hover:bg-blue-500/10 transition">
                            Share
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </main>
    </div>

    <x-pomodoro-timer />

    <script>
        // 3. File Upload Preview Logic
        const fileUpload = document.getElementById('file-upload');
        const uploadIcon = document.getElementById('upload-icon');
        const fileNameDisp = document.getElementById('file-name');
        const uploadSubtext = document.getElementById('upload-subtext');
        const dropzoneContainer = document.getElementById('dropzone-container');

        fileUpload.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                const file = this.files[0];
                const fileName = file.name;

                // Update UI for selected file with premium SVG
                uploadIcon.innerHTML = `
                    <svg class="w-10 h-10 text-[#10b981]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                `;
                fileNameDisp.innerText = fileName;
                uploadSubtext.innerText = 'File terpilih (Klik untuk mengganti)';

                // Add success styling
                dropzoneContainer.classList.remove('border-dashed');
                dropzoneContainer.classList.add('border-solid', 'bg-[#75cb50]/10', 'border-[#75cb50]');
            } else {
                // Reset to original cloud SVG
                uploadIcon.innerHTML = `
                    <svg class="w-10 h-10 text-[#75cb50]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                `;
                fileNameDisp.innerText = 'Pilih file materi';
                uploadSubtext.innerText = 'atau drag & drop ke sini';

                dropzoneContainer.classList.add('border-dashed');
                dropzoneContainer.classList.remove('border-solid', 'bg-[#75cb50]/10', 'border-[#75cb50]');
            }
        });

        // 4. AI Process Loading Overlay trigger
        const aiForm = document.querySelector('form[action*="ai/process"]');
        if (aiForm) {
            aiForm.addEventListener('submit', function(e) {
                const fileInput = document.getElementById('file-upload');
                if (fileInput && fileInput.files.length > 0) {
                    window.showSipandaLoader();
                }
            });
        }
    </script>

    @include('student.partials.loading')
</body>

</html>