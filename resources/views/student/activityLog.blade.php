@php
    $currentStreak = auth()->user()->streak->current_streak ?? 0;
    
    if ($currentStreak < 10) {
        $streakTier = 1;
        $streakColorName = 'orange';
        $streakTitle = 'Pelajar Pemula';
        $streakColorClass = 'text-[#ff8c00]';
        $streakBgClass = 'bg-[rgba(255,140,0,0.1)]';
        $streakBorderClass = 'border-[#ff8c00]/20';
        $streakGlowClass = 'drop-shadow-[0_0_10px_rgba(255,140,0,0.4)]';
        $streakBtnBg = 'bg-gradient-to-r from-[#ff8c00] to-[#ff6b00] hover:from-[#ff6b00] hover:to-[#e65c00]';
        $streakBtnShadow = 'shadow-[0_0_15px_rgba(255,140,0,0.3)]';
        $streakCardBg = 'from-[#ff8c00]/10 to-[#ff6b00]/5';
        $streakIconAnim = '';
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
    }
@endphp
<!DOCTYPE html>
<html lang="id" id="main-html">

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
    <title>siPanda — Riwayat Aktivitas</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
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

        .heatmap-cell {
            width: 14px;
            height: 14px;
            border-radius: 3px;
            flex-shrink: 0;
        }

        .heat-0 {
            background: rgba(117, 203, 80, 0.06);
        }

        .heat-1 {
            background: rgba(117, 203, 80, 0.20);
        }

        .heat-2 {
            background: rgba(117, 203, 80, 0.40);
        }

        .heat-3 {
            background: rgba(117, 203, 80, 0.65);
        }

        .heat-4 {
            background: #75cb50;
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

            {{-- Header --}}
            <header class="flex flex-col md:flex-row md:justify-between md:items-end mb-12 gap-6 pt-4">
                <div>
                    <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white flex items-center gap-2">
                        Riwayat Aktivitas
                        <svg class="w-8 h-8 text-[#75cb50]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 font-medium">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </p>
                </div>
            </header>

            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                {{-- Card 1: Durasi Hari Ini --}}
                <div class="glass p-6 group cursor-default hover:border-[#75cb50]/40 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-500 dark:text-slate-400 text-[11px] font-semibold uppercase tracking-wider mb-1">Durasi Hari Ini</p>
                            <h2 class="font-heading text-4xl font-black text-slate-900 dark:text-white">
                                {{ $todayMinutes }} <span class="text-xl text-slate-500 font-medium">mnt</span>
                            </h2>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-[#10b981] border border-[#75cb50]/20 group-hover:bg-[#75cb50]/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mt-4 font-medium">{{ $todayCount }} sesi selesai</p>
                </div>

                {{-- Card 2: Runtunan --}}
                <div class="glass p-6 group cursor-default hover:border-[#75cb50]/40 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-500 dark:text-slate-400 text-[11px] font-semibold uppercase tracking-wider mb-1">Runtunan</p>
                            <h2 class="font-heading text-4xl font-black {{ $streakColorClass }} {{ $streakGlowClass }}">
                                {{ $streak }} <span class="text-xl text-slate-500 font-medium">hari</span>
                            </h2>
                        </div>
                        <div class="w-12 h-12 rounded-xl {{ $streakBgClass }} flex items-center justify-center {{ $streakColorClass }} border {{ $streakBorderClass }} group-hover:scale-105 transition duration-300 {{ $streakIconAnim }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                            </svg>
                        </div>
                    </div>
                    @if($streak > 0)
                        <div class="mt-2 flex flex-col gap-1">
                            <p class="text-xs text-slate-500 font-medium">Pertahankan terus!</p>
                            <span class="inline-flex self-start items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $streakBgClass }} {{ $streakColorClass }} border {{ $streakBorderClass }} {{ $streakIconAnim }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $streak >= 50 ? 'bg-yellow-400 animate-ping' : ($streak >= 30 ? 'bg-purple-500 animate-pulse' : ($streak >= 10 ? 'bg-blue-400 animate-pulse' : 'bg-orange-500')) }}"></span>
                                {{ $streakTitle }}
                            </span>
                        </div>
                    @else
                        <p class="text-xs text-slate-500 mt-4 font-medium">Belum ada runtunan</p>
                    @endif
                </div>

                {{-- Card 3: Minggu Ini --}}
                <div class="glass p-6 group cursor-default hover:border-[#75cb50]/40 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-500 dark:text-slate-400 text-[11px] font-semibold uppercase tracking-wider mb-1">Minggu Ini</p>
                            <h2 class="font-heading text-4xl font-black text-slate-900 dark:text-white">
                                {{ round($weekMinutes / 60, 1) }} <span class="text-xl text-slate-500 font-medium">jam</span>
                            </h2>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-[#10b981] border border-[#75cb50]/20 group-hover:bg-[#75cb50]/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mt-4 font-medium">Target: 10 jam</p>
                </div>

                {{-- Card 4: Rata-rata Fokus --}}
                <div class="glass p-6 group cursor-default hover:border-[#75cb50]/40 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-500 dark:text-slate-400 text-[11px] font-semibold uppercase tracking-wider mb-1">Rata-rata Fokus</p>
                            <h2 class="font-heading text-4xl font-black text-[#75cb50] drop-shadow-[0_0_10px_rgba(34,197,94,0.3)]">
                                {{ round($avgFocus) }}<span class="text-xl font-medium text-slate-500">%</span>
                            </h2>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-[#10b981] border border-[#75cb50]/20 group-hover:bg-[#75cb50]/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 w-full bg-slate-200 dark:bg-[#2a2a2a] rounded-full h-1.5 overflow-hidden">
                        <div class="bg-gradient-to-r from-[#10b981] to-[#75cb50] h-1.5 rounded-full" style="width: {{ round($avgFocus) }}%"></div>
                    </div>
                </div>
            </div>

            {{-- Main 2-col --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Kiri: Timeline sesi --}}
                <div class="lg:col-span-2 glass p-0 overflow-hidden">
                    <div class="flex items-center justify-between p-6 border-b border-black/5 dark:border-white/5">
                        <h3 class="font-heading text-xl font-bold text-slate-900 dark:text-white">Riwayat Sesi</h3>
                    </div>

                    @forelse($sessions as $date => $daySessions)
                    {{-- Tanggal group --}}
                    <div class="px-6 py-3 bg-slate-50/50 dark:bg-white/[0.02] border-b border-black/5 dark:border-white/5">
                        <p class="text-[11px] font-bold text-[#75cb50] uppercase tracking-widest">
                            {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}
                        </p>
                    </div>

                    @foreach($daySessions as $session)
                    <div class="flex gap-5 items-start px-6 py-5 border-b border-black/5 dark:border-white/[0.05] hover:bg-[#75cb50]/[0.02] transition">
                        {{-- Waktu --}}
                        <div class="flex flex-col items-center gap-1 flex-shrink-0 w-12 text-center">
                            <span class="text-xs font-semibold text-[#75cb50]">{{ $session->started_at->format('H:i') }}</span>
                            <div class="w-px flex-1 min-h-[32px] bg-[#75cb50]/20"></div>
                            <span class="text-xs text-slate-400">{{ $session->ended_at->format('H:i') }}</span>
                        </div>

                        {{-- Konten --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap mb-1">
                                <span class="font-semibold text-slate-900 dark:text-white text-sm">
                                    {{ $session->subject }}{{ $session->topic ? ' — ' . $session->topic : '' }}
                                </span>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-[#75cb50]/10 text-[#75cb50]">selesai</span>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-slate-500 flex-wrap">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $session->started_at->diffInMinutes($session->ended_at) }} mnt
                                </span>
                                @if($session->focus_score > 0)
                                <span class="flex items-center gap-1 text-[#75cb50]">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                                    </svg>
                                    {{ $session->focus_score }}% fokus
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @empty
                    <div class="flex flex-col items-center justify-center py-20 text-center">
                        <svg class="w-12 h-12 text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p class="text-slate-500 font-medium">Belum ada sesi belajar</p>
                        <p class="text-slate-400 text-sm mt-1">Mulai catat aktivitas belajarmu!</p>
                    </div>
                    @endforelse
                </div>

                {{-- Kanan --}}
                <div class="flex flex-col gap-6">

                    {{-- Heatmap --}}
                    <div class="glass p-6">
                        <h3 class="font-heading text-base font-bold text-slate-900 dark:text-white mb-4">Peta Intensitas Belajar</h3>
                        <div class="flex flex-col gap-1.5">
                            {{-- Label hari --}}
                            <div class="flex gap-1.5 justify-between mb-1">
                                @foreach(['S','S','R','K','J','S','M'] as $d)
                                <span class="text-[9px] text-slate-400 w-[14px] text-center">{{ $d }}</span>
                                @endforeach
                            </div>
                            {{-- Grid 5 minggu --}}
                            @php
                            $heatChunks = array_chunk($heatmapData, 7);
                            @endphp
                            @foreach($heatChunks as $week)
                            <div class="flex gap-1.5 justify-between">
                                @foreach($week as $day)
                                <div class="heatmap-cell heat-{{ $day['level'] }}" title="{{ $day['formatted_date'] }}: {{ $day['minutes'] }} menit"></div>
                                @endforeach
                                {{-- Padding kalau minggu terakhir < 7 hari --}}
                                @for($i = count($week); $i < 7; $i++)
                                    <div class="heatmap-cell heat-0"></div>
                                @endfor
                            </div>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-1.5 mt-3 justify-end">
                            <span class="text-[10px] text-slate-400">Sedikit</span>
                            @foreach([0,1,2,3,4] as $l)
                            <div class="heatmap-cell heat-{{ $l }}"></div>
                            @endforeach
                            <span class="text-[10px] text-slate-400">Banyak</span>
                        </div>
                    </div>

                    {{-- Distribusi Pelajaran --}}
                    <div class="glass p-6">
                        <h3 class="font-heading text-base font-bold text-slate-900 dark:text-white mb-4">Distribusi Pelajaran</h3>
                        @forelse($subjectBreakdown as $subject => $data)
                        <div class="mb-3">
                            <div class="flex justify-between mb-1.5">
                                <span class="text-sm text-slate-700 dark:text-slate-300 font-medium">{{ $subject }}</span>
                                <span class="text-sm font-bold text-[#75cb50]">{{ $data['percent'] }}%</span>
                            </div>
                            <div class="w-full bg-slate-200 dark:bg-[#2a2a2a] rounded-full h-1.5 overflow-hidden">
                                <div class="bg-gradient-to-r from-[#10b981] to-[#75cb50] h-1.5 rounded-full transition-all duration-700" style="width: {{ $data['percent'] }}%"></div>
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-slate-400 text-center py-6">Belum ada data minggu ini</p>
                        @endforelse
                    </div>

                    {{-- Target Harian --}}
                    <div class="glass p-6">
                        <h3 class="font-heading text-base font-bold text-slate-900 dark:text-white mb-3">Target Harian</h3>
                        @php $targetMenit = 120; $persen = min(100, round($todayMinutes / $targetMenit * 100)); @endphp
                        <div class="flex items-baseline gap-2 mb-3">
                            <span class="font-heading text-4xl font-black text-[#75cb50]">{{ $todayMinutes }}</span>
                            <span class="text-slate-500 text-sm">/ {{ $targetMenit }} mnt</span>
                        </div>
                        <div class="w-full bg-slate-200 dark:bg-[#2a2a2a] rounded-full h-2 overflow-hidden mb-3">
                            <div class="bg-gradient-to-r from-[#10b981] to-[#75cb50] h-2 rounded-full transition-all duration-700" style="width: {{ $persen }}%"></div>
                        </div>
                        @if($persen >= 100)
                        <div class="flex items-center gap-2 text-[#75cb50]">
                            <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <p class="text-xs font-bold">Target hari ini tercapai!</p>
                        </div>
                        {{-- Data attribute to tell JS to trigger auto confetti --}}
                        <div id="target-achieved-trigger" data-achieved="true" class="hidden"></div>
                        @else
                        <p class="text-xs text-slate-500">{{ $targetMenit - $todayMinutes }} menit lagi untuk mencapai target</p>
                        @endif
                    </div>
                </div>
            </div>
    </div>

    </main>
    </div>

    @include('student.partials.loading')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const achievedTrigger = document.getElementById('target-achieved-trigger');
            if (achievedTrigger && achievedTrigger.getAttribute('data-achieved') === 'true') {
                const todayStr = new Date().toDateString();
                const isConfettiFired = localStorage.getItem('daily_target_confetti_' + todayStr);
                
                if (!isConfettiFired) {
                    if (typeof confetti === 'undefined') {
                        const script = document.createElement('script');
                        script.src = 'https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js';
                        script.onload = triggerConfetti;
                        document.head.appendChild(script);
                    } else {
                        triggerConfetti();
                    }
                }
            }
            
            function triggerConfetti() {
                // Fire confetti!
                confetti({
                    particleCount: 150,
                    spread: 80,
                    origin: { y: 0.6 }
                });
                
                // Save state to avoid double firing on every reload
                const todayStr = new Date().toDateString();
                localStorage.setItem('daily_target_confetti_' + todayStr, 'true');
            }
        });
    </script>
</body>

</html>