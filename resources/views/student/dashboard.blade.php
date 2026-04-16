<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>siPanda - Learning Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@600;800;900&display=swap');

        body {
            background-color: #121212;
            color: #f2f1e8;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: 'Outfit', sans-serif;
            letter-spacing: -0.01em;
        }

        /* Glassmorphism Critical Rules */
        .glass {
            background: rgba(18, 18, 18, 0.7);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 40px rgba(0,0,0,0.5), inset 0 2px 0 rgba(255,255,255,0.05);
            border-radius: 1.5rem;
        }

        .glass-sidebar {
            border-radius: 0 1.5rem 1.5rem 0;
            border-left: none;
        }

        .glass-pill {
            background: rgba(18, 18, 18, 0.7);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 20px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.05);
            border-radius: 9999px;
        }

        /* Glow Effects */
        .holo-glow {
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.4);
            transition: box-shadow 0.3s ease;
        }

        .holo-glow:hover {
            box-shadow: 0 0 40px rgba(34, 197, 94, 0.6);
        }

        .glass-card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .glass-card-hover:hover {
            transform: translateY(-5px);
            border-color: rgba(34, 197, 94, 0.5);
            background: rgba(34, 197, 94, 0.03);
            box-shadow: 0 20px 40px rgba(0,0,0,0.6), 0 0 20px rgba(34, 197, 94, 0.15), inset 0 2px 0 rgba(255,255,255,0.1);
        }

        /* Ambient Orbs */
        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
            opacity: 0.25;
            pointer-events: none;
        }
        .orb-1 { width: 500px; height: 500px; background: #22c55e; top: -100px; right: -100px; }
        .orb-2 { width: 400px; height: 400px; background: #10b981; bottom: 10%; left: -50px; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #121212; 
        }
        ::-webkit-scrollbar-thumb {
            background: #2a2a2a; 
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #22c55e; 
        }
    </style>
</head>
<body class="relative min-h-screen">

    <!-- Ambient Glow Backgrounds -->
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>

    <div class="flex min-h-screen">
        
        <!-- Sidebar -->
        <aside class="fixed top-0 left-0 h-screen w-72 p-6 flex flex-col z-50">
            <div class="glass glass-sidebar h-full flex flex-col p-6 border-l-0">
                
                <!-- Logo -->
                <div class="font-heading text-3xl font-black mb-10 flex items-center gap-3">
                    <span class="text-3xl filter drop-shadow-[0_0_8px_rgba(34,197,94,0.3)]">🐼</span>
                    <span class="tracking-tight text-white">si<span class="text-[#22c55e]">Panda</span></span>
                </div>
                
                <!-- Menu Links -->
                <nav class="flex-1 space-y-2">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#22c55e]/10 text-[#22c55e] font-semibold text-sm transition relative overflow-hidden group">
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gradient-to-r from-transparent via-[#22c55e]/50 to-transparent"></div>
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 text-slate-400 hover:text-white font-medium text-sm transition">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Subjects
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 text-slate-400 hover:text-white font-medium text-sm transition">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Latihan Soal
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 text-slate-400 hover:text-white font-medium text-sm transition">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Leaderboard
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 text-slate-400 hover:text-white font-medium text-sm transition">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path></svg>
                        Streaks
                    </a>
                </nav>

                <!-- User Profile Section -->
                <div class="flex items-center gap-3 border-t border-white/10 pt-6">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#22c55e] to-[#10b981] flex items-center justify-center font-bold text-black font-heading text-lg shadow-[0_0_15px_rgba(34,197,94,0.4)]">
                        A
                    </div>
                    <div class="overflow-hidden flex-1">
                        <div class="font-bold text-sm text-white truncate">ArdhanFah</div>
                        <div class="text-xs text-slate-400 truncate">ardhan@sipanda.ai</div>
                    </div>
                    <button class="text-slate-400 hover:text-white hover:bg-white/10 p-2 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="ml-72 flex-1 p-8 px-10 xl:px-14 min-h-screen">
            
            <!-- Header -->
            <header class="flex flex-col md:flex-row md:justify-between md:items-end mb-12 gap-6 pt-4">
                @auth
                <div>
                    <h1 class="font-heading text-4xl font-black text-white">Halo, {{ auth()->user()->name }} <span class="animate-wave inline-block origin-bottom-right">👋</span></h1>
                    <p class="text-slate-400 text-sm mt-2 font-medium">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
                @endauth
            </header>

            <!-- Stat Cards (4 Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Card 1 -->
                <div class="glass p-6 group cursor-default">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-semibold mb-1 uppercase tracking-wider text-[11px]">Kartu Hari Ini</p>
                            <h2 class="font-heading text-4xl font-black text-white">0</h2>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-[#10b981] border border-[#22c55e]/20 group-hover:bg-[#22c55e]/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-1.5">
                        <span class="text-[#22c55e] bg-[#22c55e]/10 px-1.5 py-0.5 rounded text-[10px] font-bold flex items-center">
                            <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg> 0%
                        </span>
                        <span class="text-xs text-slate-500 font-medium">dari kemarin</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="glass p-6 group cursor-default">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-semibold mb-1 uppercase tracking-wider text-[11px]">Streak</p>
                            <h2 class="font-heading text-4xl font-black text-white">0 <span class="text-xl text-slate-400 font-medium">hari</span></h2>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-[#10b981] border border-[#22c55e]/20 group-hover:bg-[#22c55e]/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path></svg>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mt-5 font-medium">Belum ada streak dibangun</p>
                </div>

                <!-- Card 3 -->
                <div class="glass p-6 group cursor-default">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-semibold mb-1 uppercase tracking-wider text-[11px]">Level</p>
                            <h2 class="font-heading text-4xl font-black text-[#22c55e] drop-shadow-[0_0_10px_rgba(34,197,94,0.3)]">Lvl 1</h2>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-[#10b981] border border-[#22c55e]/20 group-hover:bg-[#22c55e]/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-5 w-full bg-[#2a2a2a] rounded-full h-1.5 overflow-hidden border border-white/5">
                        <div class="bg-gradient-to-r from-[#10b981] to-[#22c55e] h-1.5 rounded-full" style="width: 10%"></div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="glass p-6 group cursor-default">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-400 text-sm font-semibold mb-1 uppercase tracking-wider text-[11px]">Rank</p>
                            <h2 class="font-heading text-4xl font-black text-white">#0</h2>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-[#10b981] border border-[#22c55e]/20 group-hover:bg-[#22c55e]/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mt-5 font-medium">Ayo tingkatkan prestasimu!</p>
                </div>
            </div>

            <!-- Quick Actions Row -->
            <div class="flex flex-wrap items-center gap-4 mb-8">
                <span class="text-slate-400 font-semibold text-sm">Buat baru:</span>
                <div class="flex flex-wrap gap-3">
                    <button class="glass-pill px-5 py-2.5 !rounded-full !border-white/5 hover:!border-[#22c55e]/50 text-sm font-semibold flex items-center gap-2.5 transition hover:-translate-y-1 hover:bg-[#22c55e]/5">
                        <span class="text-[#22c55e] text-lg drop-shadow-[0_0_5px_rgba(34,197,94,0.5)]">📄</span> Upload File
                    </button>
                    <button class="glass-pill px-5 py-2.5 !rounded-full !border-white/5 hover:!border-red-500/50 text-sm font-semibold flex items-center gap-2.5 transition hover:-translate-y-1 hover:bg-red-500/5">
                        <span class="text-red-500 text-lg drop-shadow-[0_0_5px_rgba(239,68,68,0.5)]">📺</span> YouTube
                    </button>
                    <button class="glass-pill px-5 py-2.5 !rounded-full !border-white/5 hover:!border-[#10b981]/50 text-sm font-semibold flex items-center gap-2.5 transition hover:-translate-y-1 hover:bg-[#10b981]/5">
                        <span class="text-[#10b981] text-lg drop-shadow-[0_0_5px_rgba(16,185,129,0.5)]">🎧</span> Audio
                    </button>
                    <button class="glass-pill px-5 py-2.5 !rounded-full !border-white/5 hover:!border-blue-400/50 text-sm font-semibold flex items-center gap-2.5 transition hover:-translate-y-1 hover:bg-blue-400/5">
                        <span class="text-blue-400 text-lg drop-shadow-[0_0_5px_rgba(96,165,250,0.5)]">🎬</span> Video
                    </button>
                    <button class="glass-pill px-5 py-2.5 !rounded-full !border-white/5 hover:!border-yellow-400/50 text-sm font-semibold flex items-center gap-2.5 transition hover:-translate-y-1 hover:bg-yellow-400/5">
                        <span class="text-yellow-400 text-lg drop-shadow-[0_0_5px_rgba(250,204,21,0.5)]">✍️</span> Tulis Catatan
                    </button>
                </div>
            </div>

            <!-- Main Hero Card (Centerpiece) -->
            <div class="glass p-10 lg:p-16 flex flex-col items-center justify-center text-center relative overflow-hidden group border-t border-t-[#22c55e]/20 mt-10">
                <!-- Background Decoration Overlay -->
                <div class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-[#22c55e]/10 to-transparent opacity-60 pointer-events-none"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxjaXJjbGUgY3g9IjMiIGN5PSIzIiByPSIxIiBmaWxsPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDMpIi8+PC9zdmc+')] opacity-50 z-0"></div>

                <!-- Glow Sparkles Icon -->
                <div class="relative z-10 w-24 h-24 rounded-3xl bg-gradient-to-br from-[#10b981]/20 to-[#22c55e]/5 mb-8 flex items-center justify-center border border-[#22c55e]/30 holo-glow group-hover:scale-110 transition-transform duration-700 ease-out shadow-[inset_0_0_20px_rgba(34,197,94,0.2)]">
                    <span class="text-5xl drop-shadow-[0_0_15px_rgba(34,197,94,0.8)] filter">✨</span>
                </div>
                
                <!-- Main Text -->
                <h2 class="relative z-10 font-heading text-4xl lg:text-5xl font-black text-white mb-5 tracking-tight">
                    Mulai Belajar dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#22c55e] to-[#10b981]">AI</span>
                </h2>
                <p class="relative z-10 text-slate-400 text-lg mb-12 max-w-2xl leading-relaxed">
                    Upload materi belajarmu dan biarkan AI membuat catatan, flashcard, dan kuis otomatis dalam hitungan detik. Cerdas, cepat, dan efisien.
                </p>
                
                <!-- 5 Input Option Cards inside Hero -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 w-full relative z-10 max-w-5xl mx-auto">
                    
                    <!-- Option 1: Upload File -->
                    <div class="glass glass-card-hover p-6 rounded-2xl flex flex-col items-center text-center cursor-pointer border border-white/5 bg-[#121212]/50 group/card">
                        <div class="w-16 h-16 rounded-2xl bg-[#2a2a2a] mb-5 flex items-center justify-center border border-white/5 shadow-inner group-hover/card:border-[#22c55e]/50 group-hover/card:bg-[#22c55e]/10 transition duration-300">
                             <span class="text-3xl filter drop-shadow-[0_0_10px_rgba(34,197,94,0.3)]">📄</span>
                        </div>
                        <h3 class="font-heading font-black text-base text-white mb-1">Upload File</h3>
                        <p class="text-xs text-slate-500 font-medium">PDF, DOCX, PPT</p>
                    </div>

                    <!-- Option 2: YouTube -->
                    <div class="glass glass-card-hover p-6 rounded-2xl flex flex-col items-center text-center cursor-pointer border border-white/5 bg-[#121212]/50 group/card">
                        <div class="w-16 h-16 rounded-2xl bg-[#2a2a2a] mb-5 flex items-center justify-center border border-white/5 shadow-inner group-hover/card:border-red-500/50 group-hover/card:bg-red-500/10 transition duration-300">
                             <span class="text-3xl filter drop-shadow-[0_0_10px_rgba(239,68,68,0.3)]">📺</span>
                        </div>
                        <h3 class="font-heading font-black text-base text-white mb-1">YouTube</h3>
                        <p class="text-xs text-slate-500 font-medium">Link Video</p>
                    </div>

                    <!-- Option 3: Audio -->
                    <div class="glass glass-card-hover p-6 rounded-2xl flex flex-col items-center text-center cursor-pointer border border-white/5 bg-[#121212]/50 group/card">
                        <div class="w-16 h-16 rounded-2xl bg-[#2a2a2a] mb-5 flex items-center justify-center border border-white/5 shadow-inner group-hover/card:border-[#10b981]/50 group-hover/card:bg-[#10b981]/10 transition duration-300">
                             <span class="text-3xl filter drop-shadow-[0_0_10px_rgba(16,185,129,0.3)]">🎧</span>
                        </div>
                        <h3 class="font-heading font-black text-base text-white mb-1">Audio</h3>
                        <p class="text-xs text-slate-500 font-medium">MP3, WAV</p>
                    </div>

                    <!-- Option 4: Video -->
                    <div class="glass glass-card-hover p-6 rounded-2xl flex flex-col items-center text-center cursor-pointer border border-white/5 bg-[#121212]/50 group/card">
                        <div class="w-16 h-16 rounded-2xl bg-[#2a2a2a] mb-5 flex items-center justify-center border border-white/5 shadow-inner group-hover/card:border-blue-400/50 group-hover/card:bg-blue-400/10 transition duration-300">
                             <span class="text-3xl filter drop-shadow-[0_0_10px_rgba(96,165,250,0.3)]">🎬</span>
                        </div>
                        <h3 class="font-heading font-black text-base text-white mb-1">Video</h3>
                        <p class="text-xs text-slate-500 font-medium">MP4, MKV</p>
                    </div>

                    <!-- Option 5: Tulis Catatan -->
                    <div class="glass glass-card-hover p-6 rounded-2xl flex flex-col items-center text-center cursor-pointer border border-white/5 bg-[#121212]/50 group/card">
                        <div class="w-16 h-16 rounded-2xl bg-[#2a2a2a] mb-5 flex items-center justify-center border border-white/5 shadow-inner group-hover/card:border-yellow-400/50 group-hover/card:bg-yellow-400/10 transition duration-300">
                             <span class="text-3xl filter drop-shadow-[0_0_10px_rgba(250,204,21,0.3)]">✍️</span>
                        </div>
                        <h3 class="font-heading font-black text-base text-white mb-1">Tulis Catatan</h3>
                        <p class="text-xs text-slate-500 font-medium">Teks Bebas</p>
                    </div>

                </div>
            </div>

        </main>
    </div>

</body>
</html>
