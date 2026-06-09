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
                                <p class="text-slate-500 dark:text-slate-400 text-sm font-semibold mb-1 uppercase tracking-wider text-[11px]">Streak Belajar</p>
                                <h2 class="font-heading text-4xl font-black text-[#ff8c00] drop-shadow-[0_0_10px_rgba(255,140,0,0.3)] transition-colors">
                                    {{ auth()->user()->streak->current_streak ?? 0 }} <span class="text-xl text-slate-500 dark:text-slate-400 font-medium">hari</span>
                                </h2>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-[rgba(255,140,0,0.1)] flex items-center justify-center text-[#ff8c00] border border-[#ff8c00]/20 group-hover:bg-[#ff8c00]/20 transition duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path></svg>
                            </div>
                        </div>
                        
                        @if((auth()->user()->streak->current_streak ?? 0) > 0)
                            <p class="text-xs text-slate-500 mt-3 font-medium">Rekor tertinggi: {{ auth()->user()->streak->longest_streak ?? 0 }} hari</p>
                        @else
                            <p class="text-xs text-slate-500 mt-3 font-medium">Belum ada streak. Ayo mulai!</p>
                        @endif
                    </div>

                    @if((auth()->user()->streak->current_streak ?? 0) > 0)
                    <button onclick="shareStreak({{ auth()->user()->streak->current_streak }})" class="mt-4 w-full bg-gradient-to-r from-[#ff8c00] to-[#ff6b00] hover:from-[#ff6b00] hover:to-[#e65c00] text-white font-bold py-2.5 rounded-xl text-xs transition-all shadow-[0_0_15px_rgba(255,140,0,0.3)] hover:scale-[1.02] flex items-center justify-center gap-1.5 z-10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                        Pamerkan Streak!
                    </button>
                    @endif
                </div>

                <div class="glass p-8 relative overflow-hidden md:col-span-2 group">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                        <div class="flex-1 text-left">
                            <h2 class="font-heading text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-2">
                                Pomodoro Timer
                            </h2>
                            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-6">Fokus belajar 25 menit, lalu istirahat 5 menit. Waktu akan otomatis tercatat ke dalam statistik.</p>

                            <div class="flex gap-3 w-full max-w-xs">
                                <button id="card-pomodoro-start-btn" onclick="startPomodoro()" class="flex-1 bg-gradient-to-r from-[#75cb50] to-[#10b981] hover:from-[#10b981] hover:to-[#059669] text-white font-bold py-3 px-6 rounded-xl shadow-[0_0_20px_rgba(34,197,94,0.3)] transition-all hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span id="btn-start-text">Start</span>
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
                                <button class="flex-1 py-1.5 rounded-full text-xs font-bold transition-all bg-[#75cb50] text-white shadow-[0_0_10px_rgba(34,197,94,0.4)] cursor-default">Work</button>
                                <button class="flex-1 py-1.5 rounded-full text-xs font-bold transition-all bg-transparent text-slate-500 cursor-default">Break</button>
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
                                    {{ number_format($totalTokens ?? 0) }} <span class="text-xs font-semibold text-slate-500">tokens</span>
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

    <x-pomodoro-timer />

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
        function shareStreak(streakDays) {
            const shareTitle = "Streak Belajar siPanda 🐼🔥";
            const shareText = `Yey! Aku sudah belajar konsisten selama ${streakDays} hari berturut-turut bareng siPanda! 😎🔥 \n\nAyo atur fokusmu dan bangun kebiasaan belajarmu sekarang!`;
            const shareUrl = window.location.origin; 
            
            if (navigator.share) {
                navigator.share({
                    title: shareTitle,
                    text: shareText,
                    url: shareUrl
                }).then(() => {
                    console.log('Berhasil membagikan streak!');
                }).catch((error) => {
                    console.error('Gagal membagikan:', error);
                });
            } else {
                const fullText = `${shareTitle}\n\n${shareText}\n\nJoin di: ${shareUrl}`;
                navigator.clipboard.writeText(fullText).then(() => {
                    alert("Teks berhasil disalin! Silakan paste di status WhatsApp, Instagram, atau Twitter kamu! 🚀");
                }).catch(err => {
                    console.error('Gagal menyalin teks: ', err);
                    alert("Yah, gagal menyalin teks. Coba browser lain ya!");
                });
            }
        }
    </script>
</body>

</html>