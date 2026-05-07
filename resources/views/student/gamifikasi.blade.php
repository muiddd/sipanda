<!DOCTYPE html>
<html lang="en" id="main-html" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>siPanda - Gamifikasi</title>
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
            <header class="flex flex-col md:flex-row md:justify-between md:items-end mb-12 gap-6 pt-4">
                <div>
                    <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white transition-colors">Gamifikasi <span class="text-[#75cb50]">🏆</span></h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 font-medium">Lacak progres belajar dan raih targetmu hari ini!</p>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Summary Widget -->
                <div class="glass p-8 flex flex-col justify-center relative overflow-hidden group cursor-default h-full">
                    <div class="absolute -right-4 -bottom-4 text-7xl opacity-10 group-hover:scale-110 group-hover:opacity-20 transition-all duration-500">⏳</div>
                    <p class="text-xs uppercase font-extrabold tracking-wider text-slate-500 dark:text-slate-400 mb-2">Total Waktu Belajar</p>
                    <div class="flex items-end gap-1">
                        <span class="font-heading text-5xl font-black text-[#75cb50] drop-shadow-[0_0_15px_rgba(34,197,94,0.3)]">{{ $hours }}</span>
                        <span class="text-sm font-bold text-slate-500 dark:text-slate-400 mb-2">jam</span>
                        <span class="font-heading text-5xl font-black text-[#75cb50] drop-shadow-[0_0_15px_rgba(34,197,94,0.3)] ml-2">{{ $mins }}</span>
                        <span class="text-sm font-bold text-slate-500 dark:text-slate-400 mb-2">mnt</span>
                    </div>
                </div>

                <!-- Pomodoro Timer -->
                <div class="glass p-8 relative overflow-hidden md:col-span-2 group">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                        <div class="flex-1 text-left">
                            <h2 class="font-heading text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2 mb-2">
                                <span>🍅</span> Pomodoro Timer
                            </h2>
                            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-6">Fokus belajar 25 menit, lalu istirahat 5 menit. Waktu akan otomatis tercatat ke dalam statistik.</p>
                            
                            <div class="flex gap-3 w-full max-w-xs">
                                <button id="btn-start" class="flex-1 bg-gradient-to-r from-[#75cb50] to-[#10b981] hover:from-[#10b981] hover:to-[#059669] text-white font-bold py-3 px-6 rounded-xl shadow-[0_0_20px_rgba(34,197,94,0.3)] transition-all hover:scale-[1.02] flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span id="btn-start-text">Start</span>
                                </button>
                                <button id="btn-reset" class="px-4 py-3 bg-black/5 dark:bg-white/5 text-slate-600 dark:text-slate-300 font-bold rounded-xl hover:bg-black/10 dark:hover:bg-white/10 transition flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                </button>
                            </div>
                        </div>
                        
                        <div class="flex flex-col items-center bg-white/50 dark:bg-[#121212]/50 p-6 rounded-3xl border border-[#75cb50]/20 shadow-[0_10px_30px_rgba(34,197,94,0.1)] min-w-[250px]">
                            <div class="flex gap-2 mb-4 w-full bg-black/5 dark:bg-white/5 p-1 rounded-full">
                                <button id="mode-work" class="flex-1 py-1.5 rounded-full text-xs font-bold transition-all bg-[#75cb50] text-white shadow-[0_0_10px_rgba(34,197,94,0.4)]">Work</button>
                                <button id="mode-break" class="flex-1 py-1.5 rounded-full text-xs font-bold transition-all bg-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300">Break</button>
                            </div>
                            
                            <div class="font-heading text-6xl font-black text-slate-900 dark:text-white tracking-widest my-2" id="timer-display">
                                25:00
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Lama Belajar -->
            <div class="glass p-8 relative overflow-hidden group cursor-default">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                    <div>
                        <h2 class="font-heading text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="text-2xl">📊</span> Grafik Lama Belajar
                        </h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Lama waktu belajarmu dalam 7 hari terakhir (menit)</p>
                    </div>
                </div>
                <div class="w-full h-[350px]">
                    <canvas id="learningDurationChart"></canvas>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Theme Toggle Logic
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const htmlElement = document.getElementById('main-html');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlElement.classList.add('dark');
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            htmlElement.classList.remove('dark');
            themeToggleDarkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (htmlElement.classList.contains('dark')) {
                htmlElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                htmlElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });

        // Chart Logic
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('learningDurationChart').getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 350);
            gradient.addColorStop(0, 'rgba(117, 203, 80, 0.5)'); 
            gradient.addColorStop(1, 'rgba(117, 203, 80, 0.0)');
            
            const isDark = htmlElement.classList.contains('dark');
            const gridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
            const textColor = isDark ? '#94a3b8' : '#64748b';

            const learningChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels ?? ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']) !!},
                    datasets: [{
                        label: 'Lama Belajar',
                        data: {!! json_encode($chartData ?? [0, 0, 0, 0, 0, 0, 0]) !!},
                        borderColor: '#75cb50',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: isDark ? 'rgba(18, 18, 18, 0.8)' : 'rgba(255, 255, 255, 0.9)',
                            titleColor: isDark ? '#fff' : '#0f172a',
                            bodyColor: isDark ? '#fff' : '#0f172a',
                            borderColor: isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)',
                            borderWidth: 1,
                            padding: 10,
                            displayColors: false,
                            callbacks: {
                                label: function(context) { return context.parsed.y + ' Menit'; }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: gridColor, drawBorder: false },
                            ticks: { color: textColor, font: { family: "'Inter', sans-serif", size: 11 }, stepSize: 30 }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { color: textColor, font: { family: "'Inter', sans-serif", size: 12 } }
                        }
                    },
                    interaction: { intersect: false, mode: 'index' }
                }
            });

            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'class') {
                        const isDarkNow = htmlElement.classList.contains('dark');
                        learningChart.options.scales.y.grid.color = isDarkNow ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
                        learningChart.options.scales.y.ticks.color = isDarkNow ? '#94a3b8' : '#64748b';
                        learningChart.options.scales.x.ticks.color = isDarkNow ? '#94a3b8' : '#64748b';
                        learningChart.options.plugins.tooltip.backgroundColor = isDarkNow ? 'rgba(18, 18, 18, 0.8)' : 'rgba(255, 255, 255, 0.9)';
                        learningChart.options.plugins.tooltip.titleColor = isDarkNow ? '#fff' : '#0f172a';
                        learningChart.options.plugins.tooltip.bodyColor = isDarkNow ? '#fff' : '#0f172a';
                        learningChart.options.plugins.tooltip.borderColor = isDarkNow ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
                        learningChart.update();
                    }
                });
            });
            observer.observe(htmlElement, { attributes: true });
        });

        // Pomodoro Timer Logic
        const timerDisplay = document.getElementById('timer-display');
        const btnStart = document.getElementById('btn-start');
        const btnStartText = document.getElementById('btn-start-text');
        const btnReset = document.getElementById('btn-reset');
        const modeWork = document.getElementById('mode-work');
        const modeBreak = document.getElementById('mode-break');
        
        let timerInterval;
        let isRunning = false;
        let timeLeft = 1 * 60; // 25 minutes
        let currentMode = 'work'; // 'work' or 'break'
        let workDuration = 1; // minutes

        function updateDisplay() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        function setMode(mode) {
            clearInterval(timerInterval);
            isRunning = false;
            currentMode = mode;
            btnStartText.textContent = 'Start';
            btnStart.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> <span id="btn-start-text">Start</span>`;
            
            if (mode === 'work') {
                timeLeft = 25 * 60;
                workDuration = 25;
                modeWork.className = 'flex-1 py-1.5 rounded-full text-xs font-bold transition-all bg-[#75cb50] text-white shadow-[0_0_10px_rgba(34,197,94,0.4)]';
                modeBreak.className = 'flex-1 py-1.5 rounded-full text-xs font-bold transition-all bg-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300';
            } else {
                timeLeft = 5 * 60;
                modeBreak.className = 'flex-1 py-1.5 rounded-full text-xs font-bold transition-all bg-blue-500 text-white shadow-[0_0_10px_rgba(59,130,246,0.4)]';
                modeWork.className = 'flex-1 py-1.5 rounded-full text-xs font-bold transition-all bg-transparent text-slate-500 hover:text-slate-700 dark:hover:text-slate-300';
            }
            updateDisplay();
        }

        function saveSession() {
            fetch('{{ route('student.learning-session.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ duration: workDuration })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    window.location.reload();
                }
            })
            .catch(error => console.error('Error saving session:', error));
        }

        btnStart.addEventListener('click', () => {
            if (isRunning) {
                clearInterval(timerInterval);
                isRunning = false;
                btnStartText.textContent = 'Resume';
                btnStart.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> <span id="btn-start-text">Resume</span>`;
            } else {
                isRunning = true;
                btnStartText.textContent = 'Pause';
                btnStart.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> <span id="btn-start-text">Pause</span>`;
                
                timerInterval = setInterval(() => {
                    timeLeft--;
                    updateDisplay();
                    
                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        isRunning = false;
                        
                        if (currentMode === 'work') {
                            alert('Sesi fokus selesai! Waktunya istirahat.');
                            saveSession();
                        } else {
                            alert('Waktu istirahat selesai! Ayo fokus lagi.');
                            setMode('work');
                        }
                    }
                }, 1000);
            }
        });

        btnReset.addEventListener('click', () => setMode(currentMode));
        modeWork.addEventListener('click', () => { if(currentMode !== 'work') setMode('work'); });
        modeBreak.addEventListener('click', () => { if(currentMode !== 'break') setMode('break'); });

        updateDisplay();
    </script>
</body>
</html>
