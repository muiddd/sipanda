@php
    $currentStreak = auth()->user()->streak->current_streak ?? 0;
    
    if ($currentStreak < 10) {
        $streakTier = 1;
        $streakColorName = 'orange';
        $streakTitle = 'Pembelajar Pemula';
        $streakColorClass = 'text-[#ff8c00]';
        $streakBgClass = 'bg-[rgba(255,140,0,0.1)]';
        $streakBorderClass = 'border-[#ff8c00]/20';
        $streakGlowClass = 'drop-shadow-[0_0_10px_rgba(255,140,0,0.4)]';
        $streakBtnBg = 'bg-gradient-to-r from-[#ff8c00] to-[#ff6b00] hover:from-[#ff6b00] hover:to-[#e65c00]';
        $streakBtnShadow = 'shadow-[0_0_15px_rgba(255,140,0,0.3)]';
        $streakCardBg = 'from-[#ff8c00]/10 to-[#ff6b00]/5';
        $streakIconAnim = '';
        
        // TikTok Style Card Colors (siPanda Green theme matched)
        $shareCardBg = 'bg-[#F4FBF0]';
        $shareCardHeadingColor = 'text-[#4e8e2b]';
        $shareCardNumberColor = 'text-[#75cb50]';
        $shareCardHeaderTitle = "Runtunan Belajar Terbuka";
        $shareFlameMainColor = '#ff8c00';
        $shareFlameInnerColor = '#ffe066';
        $shareAvatarRing = 'border-[#75cb50]';
    } elseif ($currentStreak < 30) {
        $streakTier = 2;
        $streakColorName = 'blue';
        $streakTitle = 'Fokus Konsisten';
        $streakColorClass = 'text-[#00c6ff]';
        $streakBgClass = 'bg-[rgba(0,198,255,0.1)]';
        $streakBorderClass = 'border-[#00c6ff]/20';
        $streakGlowClass = 'drop-shadow-[0_0_10px_rgba(0,198,255,0.5)]';
        $streakBtnBg = 'bg-gradient-to-r from-[#00c6ff] to-[#0072ff] hover:from-[#0072ff] hover:to-[#0052d4]';
        $streakBtnShadow = 'shadow-[0_0_15px_rgba(0,198,255,0.3)]';
        $streakCardBg = 'from-[#00c6ff]/10 to-[#0072ff]/5';
        $streakIconAnim = 'animate-blue-glow';
        
        // TikTok Style Card Colors (siPanda Emerald matched)
        $shareCardBg = 'bg-[#EBF9EE]';
        $shareCardHeadingColor = 'text-[#108c5d]';
        $shareCardNumberColor = 'text-[#10b981]';
        $shareCardHeaderTitle = "Lencana Runtunan Ditingkatkan";
        $shareFlameMainColor = '#10b981';
        $shareFlameInnerColor = '#a7f3d0';
        $shareAvatarRing = 'border-[#10b981]';
    } elseif ($currentStreak < 50) {
        $streakTier = 3;
        $streakColorName = 'purple';
        $streakTitle = 'Dedikasi Tinggi';
        $streakColorClass = 'text-[#bd00ff]';
        $streakBgClass = 'bg-[rgba(189,0,255,0.1)]';
        $streakBorderClass = 'border-[#bd00ff]/20';
        $streakGlowClass = 'drop-shadow-[0_0_10px_rgba(189,0,255,0.5)]';
        $streakBtnBg = 'bg-gradient-to-r from-[#bd00ff] to-[#8e2de2] hover:from-[#8e2de2] hover:to-[#4a00e0]';
        $streakBtnShadow = 'shadow-[0_0_15px_rgba(189,0,255,0.3)]';
        $streakCardBg = 'from-[#bd00ff]/10 to-[#8e2de2]/5';
        $streakIconAnim = 'animate-purple-glow';
        
        // TikTok Style Card Colors (siPanda Teal matched)
        $shareCardBg = 'bg-[#E3F5F6]';
        $shareCardHeadingColor = 'text-[#0f766e]';
        $shareCardNumberColor = 'text-[#0d9488]';
        $shareCardHeaderTitle = "Lencana Runtunan Ditingkatkan";
        $shareFlameMainColor = '#0d9488';
        $shareFlameInnerColor = '#99f6e4';
        $shareAvatarRing = 'border-[#0d9488]';
    } else {
        $streakTier = 4;
        $streakColorName = 'gold';
        $streakTitle = 'Legenda siPanda';
        $streakColorClass = 'text-[#ffd700]';
        $streakBgClass = 'bg-[rgba(255,215,0,0.15)]';
        $streakBorderClass = 'border-[#ffd700]/30';
        $streakGlowClass = 'drop-shadow-[0_0_15px_rgba(255,215,0,0.7)]';
        $streakBtnBg = 'bg-gradient-to-r from-[#ffe259] to-[#ffa751] hover:from-[#ffa751] hover:to-[#ff1b6b]';
        $streakBtnShadow = 'shadow-[0_0_20px_rgba(255,215,0,0.4)]';
        $streakCardBg = 'from-[#ffe259]/10 to-[#ffa751]/5';
        $streakIconAnim = 'animate-gold-glow';
        
        // TikTok Style Card Colors (siPanda Golden matched)
        $shareCardBg = 'bg-[#FEFBE8]';
        $shareCardHeadingColor = 'text-[#b45309]';
        $shareCardNumberColor = 'text-[#f59e0b]';
        $shareCardHeaderTitle = "Legenda Runtunan Terbuka";
        $shareFlameMainColor = '#eab308';
        $shareFlameInnerColor = '#fef08a';
        $shareAvatarRing = 'border-[#eab308]';
    }
@endphp
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
    <title>siPanda - Gamifikasi</title>

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

        .glass-sidebar {
            border-radius: 0 1.5rem 1.5rem 0;
            border-left: none;
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

        /* Milestone-based custom glowing animations */
        @keyframes gold-pulse {
            0%, 100% {
                transform: scale(1);
                filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.6)) brightness(1);
            }
            50% {
                transform: scale(1.06);
                filter: drop-shadow(0 0 22px rgba(255, 215, 0, 0.9)) brightness(1.2);
            }
        }
        .animate-gold-glow {
            animation: gold-pulse 2s infinite ease-in-out;
        }

        @keyframes purple-pulse {
            0%, 100% {
                transform: scale(1);
                filter: drop-shadow(0 0 8px rgba(189, 0, 255, 0.5));
            }
            50% {
                transform: scale(1.04);
                filter: drop-shadow(0 0 18px rgba(189, 0, 255, 0.8));
            }
        }
        .animate-purple-glow {
            animation: purple-pulse 2.5s infinite ease-in-out;
        }

        @keyframes blue-pulse {
            0%, 100% {
                transform: scale(1);
                filter: drop-shadow(0 0 8px rgba(0, 198, 255, 0.5));
            }
            50% {
                transform: scale(1.03);
                filter: drop-shadow(0 0 18px rgba(0, 198, 255, 0.8));
            }
        }
        .animate-blue-glow {
            animation: blue-pulse 3s infinite ease-in-out;
        }
    </style>
</head>

<body class="relative min-h-screen">

    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>

    <div class="flex min-h-screen">
        @include('student.partials.sidebar')

        <main class="ml-0 lg:ml-72 flex-1 p-8 px-10 xl:px-14 min-h-screen pt-20 lg:pt-8">
            <header class="flex flex-col md:flex-row md:justify-between md:items-end mb-12 gap-6 pt-4">
                <div>
                    <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white transition-colors">Gamifikasi<span class="text-[#75cb50]"></span></h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 font-medium">Lacak progres belajar dan raih targetmu hari ini!</p>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                <div class="glass p-8 flex flex-col justify-center relative overflow-hidden group cursor-default h-full">
                    <div class="absolute -right-8 -bottom-8 text-slate-400/10 dark:text-slate-500/5 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 pointer-events-none">
                        <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-xs uppercase font-extrabold tracking-wider text-slate-500 dark:text-slate-400 mb-2">Total Waktu Belajar</p>
                    <div class="flex items-end gap-1">
                        <span class="font-heading text-5xl font-black text-[#75cb50] drop-shadow-[0_0_15px_rgba(34,197,94,0.3)]">{{ $hours ?? 0 }}</span>
                        <span class="text-sm font-bold text-slate-500 dark:text-slate-400 mb-2">jam</span>
                        <span class="font-heading text-5xl font-black text-[#75cb50] drop-shadow-[0_0_15px_rgba(34,197,94,0.3)] ml-2">{{ $mins ?? 0 }}</span>
                        <span class="text-sm font-bold text-slate-500 dark:text-slate-400 mb-2">mnt</span>
                    </div>
                </div>

                <div class="glass p-6 group cursor-default relative overflow-hidden flex flex-col justify-between h-full">
                    <div class="absolute -right-4 -top-4 text-7xl opacity-5 group-hover:scale-110 group-hover:opacity-10 transition-all duration-500 pointer-events-none">🔥</div>
                    
                    <div>
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-slate-500 dark:text-slate-400 text-sm font-semibold mb-1 uppercase tracking-wider text-[11px]">Runtunan Belajar</p>
                                <h2 class="font-heading text-4xl font-black {{ $streakColorClass }} {{ $streakGlowClass }} transition-colors">
                                    {{ $currentStreak }} <span class="text-xl text-slate-500 dark:text-slate-400 font-medium">hari</span>
                                </h2>
                            </div>
                            <div class="w-12 h-12 rounded-xl {{ $streakBgClass }} flex items-center justify-center {{ $streakColorClass }} border {{ $streakBorderClass }} group-hover:scale-105 transition duration-300 {{ $streakIconAnim }}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path></svg>
                            </div>
                        </div>
                        
                        @if($currentStreak > 0)
                            <p class="text-xs text-slate-500 mt-3 font-medium">Rekor tertinggi: {{ auth()->user()->streak->longest_streak ?? 0 }} hari</p>
                            <span class="inline-flex mt-2 items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold {{ $streakBgClass }} {{ $streakColorClass }} border {{ $streakBorderClass }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $currentStreak >= 50 ? 'bg-yellow-400 animate-ping' : ($currentStreak >= 30 ? 'bg-purple-500 animate-pulse' : ($currentStreak >= 10 ? 'bg-blue-400 animate-pulse' : 'bg-orange-500')) }}"></span>
                                {{ $streakTitle }}
                            </span>
                        @else
                            <p class="text-xs text-slate-500 mt-3 font-medium">Belum ada runtunan. Ayo mulai!</p>
                        @endif
                    </div>

                    @if($currentStreak > 0)
                    <button onclick="openShareModal()" class="mt-4 w-full {{ $streakBtnBg }} text-white font-bold py-2.5 rounded-xl text-xs transition-all {{ $streakBtnShadow }} hover:scale-[1.02] flex items-center justify-center gap-1.5 z-10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                        Pamerkan Runtunan!
                    </button>
                    @endif
                </div>

                <div class="glass p-8 relative overflow-hidden md:col-span-2 group">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                        <div class="flex-1 text-left">
                            <h2 class="font-heading text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-2">
                                Pewaktu Pomodoro
                            </h2>
                            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-6">Fokus belajar 25 menit, lalu istirahat 5 menit. Waktu akan otomatis tercatat ke dalam statistik.</p>

                            <div class="flex gap-3 w-full max-w-xs">
                                <button id="card-pomodoro-start-btn" onclick="startPomodoro()" class="flex-1 bg-gradient-to-r from-[#75cb50] to-[#10b981] hover:from-[#10b981] hover:to-[#059669] text-white font-bold py-3 px-6 rounded-xl shadow-[0_0_20px_rgba(34,197,94,0.3)] transition-all hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span id="btn-start-text">Mulai</span>
                                </button>
                                <button onclick="resetPomodoro()" class="px-4 py-3 bg-black/5 dark:bg-white/5 text-slate-600 dark:text-slate-300 font-bold rounded-xl hover:bg-black/10 dark:hover:bg-white/10 transition flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col items-center bg-white/50 dark:bg-[#121212]/50 p-6 rounded-3xl border border-[#75cb50]/20 shadow-[0_10px_30px_rgba(34,197,94,0.1)] min-w-[250px]">
                            <div class="flex gap-2 mb-4 w-full bg-black/5 dark:bg-white/5 p-1 rounded-full">
                                <button class="flex-1 py-1.5 rounded-full text-xs font-bold transition-all bg-[#75cb50] text-white shadow-[0_0_10px_rgba(34,197,94,0.4)] cursor-default">Belajar</button>
                                <button class="flex-1 py-1.5 rounded-full text-xs font-bold transition-all bg-transparent text-slate-500 cursor-default">Istirahat</button>
                            </div>

                            <div class="font-heading text-6xl font-black text-slate-900 dark:text-white tracking-widest my-2" id="card-pomodoro-display">
                                25:00
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                <div class="glass p-8 relative overflow-hidden group cursor-default lg:col-span-2">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div>
                            <h2 class="font-heading text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <span class="text-2xl"></span>Grafik Lama Belajar
                            </h2>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Lama waktu belajarmu dalam 7 hari terakhir (menit)</p>
                        </div>
                    </div>
                    <div class="w-full" style="height: 300px; position: relative;">
                        <canvas id="learningDurationChart"></canvas>
                        <div id="chart-error-console" class="text-xs text-red-500 font-mono mt-2 hidden p-4 bg-red-500/10 rounded-xl border border-red-500/20 absolute bottom-0 left-0 right-0"></div>
                    </div>
                </div>

                <div class="glass p-8 relative overflow-hidden group cursor-default flex flex-col justify-between">
                    <div class="absolute -right-8 -bottom-8 text-slate-400/10 dark:text-slate-500/5 group-hover:scale-110 group-hover:-rotate-12 transition-all duration-500 pointer-events-none">
                        <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-heading text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-2">
                            <span></span>Statistik AI siPanda
                        </h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Lacak penggunaan asisten AI dalam belajarmu.</p>

                        <div class="space-y-5">
                            <div class="bg-black/5 dark:bg-white/5 p-4 rounded-2xl border border-black/5 dark:border-white/5">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">Total Token Terpakai</span>
                                    <span class="text-xs font-bold text-[#75cb50]">{{ number_format($totalTokens ?? 0) }} / 50.000</span>
                                </div>
                                <div class="text-2xl font-black text-slate-900 dark:text-white">
                                    {{ number_format($totalTokens ?? 0) }} <span class="text-xs font-semibold text-slate-500">token</span>
                                </div>
                                <div class="mt-2 w-full bg-slate-200 dark:bg-[#2a2a2a] rounded-full h-1.5 overflow-hidden border border-black/5 dark:border-white/5">
                                    <div class="bg-gradient-to-r from-[#10b981] to-[#75cb50] h-1.5 rounded-full" style="width: {{ min(100, (($totalTokens ?? 0) / 50000) * 100) }}%"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-black/5 dark:bg-white/5 p-4 rounded-2xl border border-black/5 dark:border-white/5 text-center">
                                    <span class="text-[10px] uppercase font-extrabold tracking-wider text-slate-500 dark:text-slate-400">Rangkuman AI</span>
                                    <div class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ $summaryRequests ?? 0 }}</div>
                                    <span class="text-[10px] text-slate-500">kali proses</span>
                                </div>
                                <div class="bg-black/5 dark:bg-white/5 p-4 rounded-2xl border border-black/5 dark:border-white/5 text-center">
                                    <span class="text-[10px] uppercase font-extrabold tracking-wider text-slate-500 dark:text-slate-400">Latihan Soal</span>
                                    <div class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ $quizRequests ?? 0 }}</div>
                                    <span class="text-[10px] text-slate-500">kali dibuat</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-black/5 dark:border-white/5 mt-6 flex justify-between items-center text-xs text-slate-500">
                        <span>Total Request AI: <strong>{{ $totalAiRequests ?? 0 }} kali</strong></span>
                        <span class="text-[#75cb50] font-bold">Aktif</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- TikTok-Style Share Streak Modal -->
    <div id="share-streak-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/65 backdrop-blur-xl transition-opacity duration-300 opacity-0">
        <div class="glass max-w-3xl w-full p-6 sm:p-8 flex flex-col md:flex-row gap-6 md:gap-8 relative overflow-y-auto max-h-[90vh] bg-white/95 dark:bg-zinc-950/95 border border-white/20 dark:border-white/5 shadow-2xl animate-in fade-in zoom-in-95 duration-300">
            <!-- Ambient glows matching website colors -->
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-[#75cb50]/15 dark:bg-[#75cb50]/10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-[#10b981]/15 dark:bg-[#10b981]/5 rounded-full blur-[120px] pointer-events-none"></div>
            
            <!-- Close Button -->
            <button onclick="closeShareModal()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-2 rounded-full hover:bg-black/5 dark:hover:bg-white/5 transition z-30">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

@php
    // Custom share card styles for html2canvas compatibility (radial gradient background instead of CSS blur filter)
    if ($streakTier == 1) {
        $cardBgStyle = "background: radial-gradient(circle at 20% 20%, rgba(255, 140, 0, 0.25), transparent 60%), radial-gradient(circle at 80% 80%, rgba(255, 107, 0, 0.15), transparent 60%), #0c0d12;";
        $cardThemeColor = '#ff8c00';
        $cardTextClass = 'text-[#ff8c00]';
        $cardBorderClass = 'border-[#ff8c00]/30';
    } elseif ($streakTier == 2) {
        $cardBgStyle = "background: radial-gradient(circle at 20% 20%, rgba(0, 198, 255, 0.25), transparent 60%), radial-gradient(circle at 80% 80%, rgba(0, 114, 255, 0.15), transparent 60%), #0c0d12;";
        $cardThemeColor = '#00c6ff';
        $cardTextClass = 'text-[#00c6ff]';
        $cardBorderClass = 'border-[#00c6ff]/30';
    } elseif ($streakTier == 3) {
        $cardBgStyle = "background: radial-gradient(circle at 20% 20%, rgba(189, 0, 255, 0.25), transparent 60%), radial-gradient(circle at 80% 80%, rgba(142, 45, 226, 0.15), transparent 60%), #0c0d12;";
        $cardThemeColor = '#bd00ff';
        $cardTextClass = 'text-[#bd00ff]';
        $cardBorderClass = 'border-[#bd00ff]/30';
    } else {
        $cardBgStyle = "background: radial-gradient(circle at 20% 20%, rgba(255, 215, 0, 0.35), transparent 60%), radial-gradient(circle at 80% 80%, rgba(255, 27, 107, 0.2), transparent 60%), #0c0d12;";
        $cardThemeColor = '#ffd700';
        $cardTextClass = 'text-[#ffd700]';
        $cardBorderClass = 'border-[#ffd700]/30';
    }
@endphp

            <!-- Left: Card Preview -->
            <div class="flex-shrink-0 flex justify-center items-center mx-auto md:mx-0">
                <!-- Share Card Element (Modern Pixel-Perfect Design) -->
                <div id="streak-share-card-element" class="relative w-[300px] h-[500px] rounded-[2rem] text-white overflow-hidden shadow-[0_30px_60px_rgba(0,0,0,0.5)] border border-white/10 select-none font-sans" style="{{ $cardBgStyle }}">
                    
                    <!-- Header -->
                    <div class="absolute top-0 left-0 right-0 h-[72px] px-6 flex items-center justify-between border-b border-white/10">
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center overflow-hidden shadow-md">
                                <img src="{{ asset('images/panda.PNG') }}" class="w-full h-full object-cover" alt="siPanda Logo" />
                            </div>
                            <div class="text-left">
                                <h4 class="font-heading text-xs font-black tracking-wider text-white leading-none">siPanda</h4>
                                <p class="text-[8px] uppercase tracking-widest {{ $cardTextClass }} font-black mt-1 leading-none">Fokus Belajar</p>
                            </div>
                        </div>
                        <div class="px-2.5 py-1 rounded-full bg-white/5 border {{ $cardBorderClass }} text-[9px] font-black {{ $cardTextClass }} tracking-wider shadow-inner">
                            KARTU RUNTUNAN
                        </div>
                    </div>

                    <!-- Center Body -->
                    <div class="absolute top-[72px] bottom-[76px] left-0 right-0 flex flex-col items-center justify-center">
                        <!-- Flame Container -->
                        <div class="relative w-24 h-24 rounded-full bg-white/[0.03] border border-white/10 flex items-center justify-center shadow-2xl mb-4">
                            <!-- Background Aura Glow -->
                            <div class="absolute inset-2 rounded-full opacity-35" style="background: radial-gradient(circle, {{ $cardThemeColor }} 0%, transparent 70%);"></div>
                            
                            <!-- Glowing Flame SVG -->
                            <svg class="w-14 h-14 relative z-10" viewBox="0 0 24 24">
                                <defs>
                                    <linearGradient id="cardFlameGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                        @if($streakTier == 1)
                                            <stop offset="0%" stop-color="#ff8c00"/>
                                            <stop offset="100%" stop-color="#ff4500"/>
                                        @elseif($streakTier == 2)
                                            <stop offset="0%" stop-color="#00c6ff"/>
                                            <stop offset="100%" stop-color="#0072ff"/>
                                        @elseif($streakTier == 3)
                                            <stop offset="0%" stop-color="#bd00ff"/>
                                            <stop offset="100%" stop-color="#8e2de2"/>
                                        @else
                                            <stop offset="0%" stop-color="#ffe259"/>
                                            <stop offset="50%" stop-color="#ffa751"/>
                                            <stop offset="100%" stop-color="#ff1b6b"/>
                                        @endif
                                    </linearGradient>
                                </defs>
                                <path fill="url(#cardFlameGrad)" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                            </svg>
                        </div>

                        <!-- Days Display -->
                        <div class="flex flex-col items-center mb-4 text-center">
                            <span class="text-6xl font-heading font-black tracking-tight text-white leading-[1] block">
                                {{ $currentStreak }}
                            </span>
                            <span class="text-[10px] font-black uppercase tracking-widest {{ $cardTextClass }} mt-2.5 block text-center">
                                Hari Berturut-turut
                            </span>
                        </div>

                        <!-- Badge title -->
                        <div class="px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs font-bold text-slate-100 flex items-center justify-center gap-1.5 shadow-inner">
                            <span class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $cardThemeColor }};"></span>
                            {{ $streakTitle }}
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="absolute bottom-0 left-0 right-0 h-[76px] px-6 pb-4 flex items-center justify-between border-t border-white/10">
                        <div class="text-left">
                            <div class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Pelajar</div>
                            <div class="text-xs font-heading font-extrabold text-white truncate max-w-[120px]">
                                {{ auth()->user()->name }}
                            </div>
                        </div>
                        <div class="flex flex-col items-end">
                            <div class="text-[9px] font-black uppercase tracking-widest {{ $cardTextClass }}">#siPandaRuntunan</div>
                            <div class="text-[8px] text-slate-400 mt-0.5">sipanda.xhizoracodes.my.id</div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Right: Share Controls -->
            <div class="flex-1 flex flex-col justify-between text-left md:h-[500px] w-full">
                <!-- Top Section: Badge, Title & Description -->
                <div class="space-y-3">
                    <span class="inline-block text-[10px] font-extrabold uppercase tracking-widest text-[#75cb50] bg-[#75cb50]/10 border border-[#75cb50]/20 px-2.5 py-1 rounded-full">
                        Pencapaian Keren!
                    </span>
                    <h3 class="font-heading text-2xl font-black text-slate-900 dark:text-white leading-tight">
                        Bagikan Runtunan Belajarmu!
                    </h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">
                        Unduh kartu runtunan prestasimu atau salin tautan promosi untuk dibagikan ke media sosial.
                    </p>
                </div>

                <!-- Middle Section: Quote Widget -->
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-white/5 border border-black/5 dark:border-white/5 text-slate-600 dark:text-slate-400 text-xs italic font-medium leading-relaxed flex gap-2 my-4 md:my-0">
                    <span class="text-xl text-[#75cb50] font-heading font-black leading-none flex-shrink-0">“</span>
                    <span class="flex-1 min-w-0">Membangun konsistensi harian adalah kunci dari keberhasilan jangka panjang. Lanjutkan runtunan belajarmu hari ini!</span>
                </div>

                <!-- Bottom Section: Buttons and Brand Footer -->
                <div class="space-y-4">
                    <div class="flex flex-col gap-3">
                        <!-- Download Button -->
                        <button onclick="downloadShareCardImage()" class="w-full flex items-center justify-center gap-3 py-3.5 px-6 rounded-2xl bg-gradient-to-r from-[#75cb50] to-[#10b981] hover:from-[#10b981] hover:to-[#059669] text-white font-extrabold text-sm transition-all duration-300 shadow-[0_8px_25px_rgba(117,203,80,0.3)] hover:scale-[1.01] active:scale-[0.99]">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                             </svg>
                             Unduh Gambar Kartu Runtunan (PNG)
                        </button>

                        <!-- Copy Button -->
                        <button onclick="copyStreakLink()" class="w-full flex items-center justify-center gap-3 py-3 px-6 rounded-2xl bg-white dark:bg-white/5 border border-[#75cb50]/30 hover:border-[#75cb50] text-slate-800 dark:text-slate-200 hover:text-white hover:bg-[#75cb50] dark:hover:bg-[#75cb50] font-bold text-xs transition duration-300 shadow-sm">
                             <div id="copy-icon-container" class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-white/10 text-slate-700 dark:text-white flex items-center justify-center transition-colors">
                                 <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2M8 5a2 2 0 012-2h2a2 2 0 012 2" />
                                 </svg>
                             </div>
                             <span id="copy-btn-text">Salin Teks & Tautan Rekomendasi</span>
                        </button>
                    </div>

                    <!-- Footer Brand Tag -->
                    <div class="text-[10px] text-slate-400 flex items-center justify-between border-t border-black/5 dark:border-white/5 pt-3">
                        <span>Sistem Gamifikasi siPanda</span>
                        <span>Versi 2.0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-pomodoro-timer />

    <!-- html2canvas library for capturing the card -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script>
        // Global Error Visualizer
        window.addEventListener('error', function(e) {
            const consoleDiv = document.getElementById('chart-error-console');
            if (consoleDiv) {
                consoleDiv.classList.remove('hidden');
                consoleDiv.innerHTML = `<strong>Error:</strong> ${e.message} di baris ${e.lineno}`;
            }
        });
    </script>
    <script>
        window.chartLabels = @json($chartLabels);
        window.chartData = @json($chartData);
    </script>
    <script src="{{ asset('js/gamifikasi-chart.js') }}"></script>

    <script>
        // Share modal operations
        function openShareModal() {
            const modal = document.getElementById('share-streak-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.classList.add('opacity-100');
            }, 10);
        }

        // Close share modal
        function closeShareModal() {
            const modal = document.getElementById('share-streak-modal');
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
        }

        // Close on clicking outside content
        document.getElementById('share-streak-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeShareModal();
            }
        });

        // Copy Text & Link to Clipboard
        function copyStreakLink() {
            const streak = "{{ $currentStreak }}";
            const fullText = `Runtunan Belajar siPanda 🐼🔥\n\nYey! Aku sudah belajar konsisten selama ${streak} hari berturut-turut bareng siPanda!\n\nAyo atur fokusmu dan bangun kebiasaan belajarmu sekarang!\n\nGabung sekarang di: https://sipanda.xhizoracodes.my.id`;
            
            navigator.clipboard.writeText(fullText).then(() => {
                const btnText = document.getElementById('copy-btn-text');
                const btnIcon = document.getElementById('copy-icon-container');
                
                btnText.innerText = "Teks Berhasil Disalin!";
                btnIcon.innerHTML = `
                    <svg class="w-4 h-4 text-[#10b981]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                `;
                
                setTimeout(() => {
                    btnText.innerText = "Salin Teks & Tautan";
                    btnIcon.innerHTML = `
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2M8 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    `;
                }, 2000);
            }).catch(err => {
                console.error('Gagal menyalin:', err);
            });
        }

        // Captures streak-share-card-element as image and triggers download
        function downloadShareCardImage() {
            const cardElement = document.getElementById('streak-share-card-element');
            
            // 1. Clone the element to apply specific rendering optimizations
            const clone = cardElement.cloneNode(true);
            
            // 2. Style the clone to be visible but off-screen
            clone.style.position = 'absolute';
            clone.style.top = '-9999px';
            clone.style.left = '-9999px';
            clone.style.display = 'flex';
            clone.style.flexDirection = 'column';
            clone.style.justifyContent = 'space-between';
            clone.style.padding = '20px';
            clone.style.height = '500px';
            clone.style.width = '300px';
            clone.style.boxSizing = 'border-box';
            document.body.appendChild(clone);
            
            // 3. Apply the dynamic layout styles on the clone to prevent cutting via inline styles
            const header = clone.querySelector('.border-b');
            if (header) {
                header.style.position = 'static';
                header.style.height = '60px';
                header.style.padding = '0 8px';
                header.style.display = 'flex';
                header.style.alignItems = 'center';
                header.style.justifyContent = 'space-between';
                header.style.boxSizing = 'border-box';
                
                const h4 = header.querySelector('h4');
                if (h4) {
                    h4.style.fontSize = '12px';
                    h4.style.lineHeight = '1';
                }
                
                const p = header.querySelector('p');
                if (p) {
                    p.style.fontSize = '7px';
                    p.style.lineHeight = '1';
                    p.style.marginTop = '2px';
                }
                
                const tag = header.querySelector('.rounded-full');
                if (tag) {
                    tag.style.fontSize = '8px';
                    tag.style.padding = '2px 8px';
                }
            }
            
            const body = clone.querySelector('.absolute.top-\\[72px\\].bottom-\\[76px\\]');
            if (body) {
                body.style.position = 'static';
                body.style.display = 'flex';
                body.style.flexDirection = 'column';
                body.style.alignItems = 'center';
                body.style.justifyContent = 'center';
                body.style.flexGrow = '1';
                body.style.padding = '12px 0';
                
                const flameContainer = body.querySelector('.relative.w-24');
                if (flameContainer) {
                    flameContainer.style.width = '80px';
                    flameContainer.style.height = '80px';
                    flameContainer.style.marginBottom = '12px';
                    const svg = flameContainer.querySelector('svg');
                    if (svg) {
                        svg.style.width = '44px';
                        svg.style.height = '44px';
                    }
                }
                
                const daysDisplay = body.querySelector('.mb-4');
                if (daysDisplay) {
                    daysDisplay.style.marginBottom = '12px';
                    const span1 = daysDisplay.querySelector('span:first-child');
                    if (span1) {
                        span1.style.fontSize = '48px';
                        span1.style.lineHeight = '1';
                    }
                    const span2 = daysDisplay.querySelector('span:last-child');
                    if (span2) {
                        span2.style.fontSize = '8px';
                        span2.style.marginTop = '6px';
                    }
                }
                
                const badge = body.querySelector('.text-xs');
                if (badge) {
                    badge.style.fontSize = '10px';
                    badge.style.padding = '4px 10px';
                }
            }
            
            const footer = clone.querySelector('.border-t');
            if (footer) {
                footer.style.position = 'static';
                footer.style.height = '64px';
                footer.style.padding = '8px 8px 0 8px';
                footer.style.display = 'flex';
                footer.style.alignItems = 'center';
                footer.style.justifyContent = 'space-between';
                footer.style.boxSizing = 'border-box';
                
                const leftDiv = footer.querySelector('.text-left');
                if (leftDiv) {
                    const label = leftDiv.querySelector('div:first-child');
                    if (label) {
                        label.style.fontSize = '8px';
                        label.style.marginBottom = '2px';
                    }
                    const name = leftDiv.querySelector('.text-xs');
                    if (name) {
                        name.style.fontSize = '11px';
                        name.style.lineHeight = '1.2';
                        name.style.fontFamily = 'Inter, sans-serif';
                        name.style.fontWeight = 'bold';
                        name.style.maxWidth = '110px';
                    }
                }
                
                const rightDiv = footer.querySelector('.items-end');
                if (rightDiv) {
                    const hashtag = rightDiv.querySelector('div:first-child');
                    if (hashtag) {
                        hashtag.style.fontSize = '8px';
                        hashtag.style.lineHeight = '1';
                    }
                    const domain = rightDiv.querySelector('div:last-child');
                    if (domain) {
                        domain.style.fontSize = '7px';
                        domain.style.lineHeight = '1';
                        domain.style.marginTop = '3px';
                    }
                }
            }

            // Wait for fonts to load
            document.fonts.ready.then(() => {
                const options = {
                    scale: 3, // Higher scale = higher resolution export
                    useCORS: true,
                    backgroundColor: null,
                    logging: false
                };

                html2canvas(clone, options).then(canvas => {
                    const imgData = canvas.toDataURL('image/png');
                    const link = document.createElement('a');
                    link.download = `sipanda-streak-{{ auth()->user()->name }}-${new Date().toISOString().slice(0,10)}.png`;
                    link.href = imgData;
                    link.click();
                    
                    // Clean up clone
                    document.body.removeChild(clone);
                });
            });
        }
    </script>
</body>

</html>