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
    <title>siPanda - Target Belajar</title>

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

        /* Custom checkbox */
        .task-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 6px;
            border: 1.5px solid #cbd5e1;
            cursor: pointer;
            flex-shrink: 0;
            transition: all 0.2s ease;
            position: relative;
        }

        .dark .task-checkbox {
            border-color: rgba(255, 255, 255, 0.2);
        }

        .task-checkbox:checked {
            background-color: #75cb50;
            border-color: #75cb50;
        }

        .task-checkbox:checked::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 2px;
            width: 6px;
            height: 10px;
            border: 2px solid white;
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
        }

        .task-item.completed .task-label {
            text-decoration: line-through;
            opacity: 0.4;
        }

        .tag {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            white-space: nowrap;
        }

        /* Filter pills */
        .filter-pill {
            padding: 6px 16px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s ease;
            background: transparent;
            color: #94a3b8;
        }

        .dark .filter-pill {
            color: rgba(255, 255, 255, 0.35);
        }

        .filter-pill:hover {
            color: #75cb50;
            border-color: rgba(117, 203, 80, 0.3);
        }

        .filter-pill.active {
            background: rgba(117, 203, 80, 0.15);
            color: #75cb50;
            border-color: rgba(117, 203, 80, 0.4);
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
    </style>
</head>

<body class="relative min-h-screen">

    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>

    <div class="flex min-h-screen">

        @include('student.partials.sidebar')

        <main class="ml-0 lg:ml-72 flex-1 p-8 px-10 xl:px-14 min-h-screen pt-20 lg:pt-8">

            {{-- Header --}}
            <header class="mb-10 pt-4">
                <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white flex items-center gap-2">
                    Target <span class="text-[#75cb50]">Belajar</span>
                    <svg class="w-8 h-8 text-[#75cb50]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 font-medium">
                    Catat dan selesaikan tugasmu hari ini.
                </p>
            </header>

            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" id="stat-cards">
                {{-- Card 1: Total Tugas --}}
                <div class="glass p-6 group cursor-default hover:border-[#75cb50]/40 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-500 dark:text-slate-400 text-[11px] font-semibold uppercase tracking-wider mb-1">Total Tugas</p>
                            <h2 class="font-heading text-4xl font-black text-slate-900 dark:text-white mt-1" id="stat-total">0</h2>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-[#10b981] border border-[#75cb50]/20 group-hover:bg-[#75cb50]/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Selesai --}}
                <div class="glass p-6 group cursor-default hover:border-[#75cb50]/40 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-500 dark:text-slate-400 text-[11px] font-semibold uppercase tracking-wider mb-1">Selesai</p>
                            <h2 class="font-heading text-4xl font-black text-[#75cb50] drop-shadow-[0_0_10px_rgba(34,197,94,0.3)] mt-1" id="stat-done">0</h2>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[#75cb50]/10 flex items-center justify-center text-[#75cb50] border border-[#75cb50]/20 group-hover:bg-[#75cb50]/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Belum --}}
                <div class="glass p-6 group cursor-default hover:border-red-500/40 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-slate-500 dark:text-slate-400 text-[11px] font-semibold uppercase tracking-wider mb-1">Belum Selesai</p>
                            <h2 class="font-heading text-4xl font-black text-red-500 mt-1" id="stat-pending">0</h2>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-red-500/10 flex items-center justify-center text-red-500 border border-red-500/20 group-hover:bg-red-500/20 transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Input Tambah Tugas --}}
            <div class="glass px-5 py-4 flex items-center gap-4 mb-5">
                <svg class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <input
                    id="task-input"
                    type="text"
                    placeholder="Tambah tugas baru..."
                    class="flex-1 bg-transparent outline-none text-sm text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 font-medium"
                    onkeydown="if(event.key==='Enter') addTask()" />
                
                <!-- Custom Dropdown Tag Select -->
                <div class="relative flex-shrink-0" id="custom-tag-dropdown">
                    <button type="button" id="custom-tag-btn" class="flex items-center justify-between text-xs font-bold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 pr-9 outline-none min-w-[110px] transition hover:bg-slate-200 dark:hover:bg-white/10">
                        <span id="selected-tag-label">Materi</span>
                    </button>
                    <!-- Chevron Icon -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 dark:text-slate-500">
                        <svg class="w-3.5 h-3.5 transition-transform duration-200" id="custom-tag-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <!-- Dropdown Options List -->
                    <div id="custom-tag-options" class="absolute right-0 mt-2 w-36 origin-top-right rounded-2xl bg-white dark:bg-[#1f1f1f] border border-black/5 dark:border-white/10 shadow-xl dark:shadow-2xl opacity-0 scale-95 pointer-events-none transition-all duration-200 z-[100] p-1.5 flex flex-col gap-1">
                        <button type="button" class="custom-option-item text-left px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5 transition flex items-center gap-1.5" data-value="Materi">
                            <svg class="w-3.5 h-3.5 text-[#4ade80]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Materi
                        </button>
                        <button type="button" class="custom-option-item text-left px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5 transition flex items-center gap-1.5" data-value="Latihan">
                            <svg class="w-3.5 h-3.5 text-[#60a5fa]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Latihan
                        </button>
                        <button type="button" class="custom-option-item text-left px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5 transition flex items-center gap-1.5" data-value="Penting">
                            <svg class="w-3.5 h-3.5 text-[#fbbf24]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Penting
                        </button>
                    </div>
                    <!-- Hidden Input for actual value submission -->
                    <input type="hidden" id="tag-select" value="Materi" />
                </div>

                <button
                    onclick="addTask()"
                    class="bg-[#75cb50] hover:bg-[#64b043] active:scale-95 text-white w-9 h-9 rounded-xl flex items-center justify-center transition-all shadow-lg shadow-green-500/20 flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
            </div>

            {{-- Filter Pills --}}
            <div class="flex items-center gap-2 mb-6" id="filter-pills">
                <button class="filter-pill active flex items-center gap-1.5" data-filter="Semua">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Semua
                </button>
                <button class="filter-pill flex items-center gap-1.5" data-filter="Materi">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Materi
                </button>
                <button class="filter-pill flex items-center gap-1.5" data-filter="Latihan">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Latihan
                </button>
                <button class="filter-pill flex items-center gap-1.5" data-filter="Penting">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Penting
                </button>
            </div>

            {{-- Progress Bar --}}
            <div class="mb-8">
                <div class="flex justify-between items-center mb-2">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Progress Hari Ini</p>
                    <p class="text-xs font-bold text-[#75cb50]" id="progress-text">0%</p>
                </div>
                <div class="w-full h-2 bg-slate-200 dark:bg-white/10 rounded-full overflow-hidden">
                    <div id="progress-bar" class="h-2 bg-[#75cb50] rounded-full transition-all duration-500" style="width: 0%"></div>
                </div>
            </div>

            {{-- List: Belum Selesai --}}
            <div class="mb-8">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">Belum Selesai</p>
                <div id="pending-list" class="flex flex-col gap-3">
                    {{-- Diisi oleh JS --}}
                </div>
                <div id="pending-empty" class="hidden glass px-6 py-8 text-center">
                    <svg class="w-12 h-12 text-[#75cb50] mx-auto mb-3 animate-pulse" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    <p class="text-sm font-bold text-slate-400">Semua tugas selesai!</p>
                </div>
            </div>

            {{-- List: Selesai --}}
            <div id="done-section" class="hidden">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">Selesai</p>
                <div id="done-list" class="flex flex-col gap-3"></div>
            </div>

        </main>
    </div>

    <x-pomodoro-timer />

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            loadTasks();

            // ── Custom Dropdown Logic ───────────────────────────────
            const dropdown = document.getElementById('custom-tag-dropdown');
            const btn = document.getElementById('custom-tag-btn');
            const options = document.getElementById('custom-tag-options');
            const chevron = document.getElementById('custom-tag-chevron');
            const label = document.getElementById('selected-tag-label');
            const hiddenInput = document.getElementById('tag-select');

            const toggleDropdown = () => {
                const isOpen = options.classList.contains('opacity-100');
                if (isOpen) {
                    options.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                    options.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                    chevron.classList.remove('rotate-180');
                } else {
                    options.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                    options.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
                    chevron.classList.add('rotate-180');
                }
            };

            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleDropdown();
            });

            document.querySelectorAll('.custom-option-item').forEach(item => {
                item.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const val = item.dataset.value;
                    hiddenInput.value = val;
                    label.textContent = val;
                    // Close dropdown
                    options.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                    options.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                    chevron.classList.remove('rotate-180');
                });
            });

            // Close when clicking outside
            document.addEventListener('click', () => {
                options.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                options.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                chevron.classList.remove('rotate-180');
            });
        });

        // ── Helpers ──────────────────────────────────────────────
        let activeFilter = 'Semua';
        let allTasks = [];

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('filter-pills').addEventListener('click', (e) => {
                const btn = e.target.closest('.filter-pill');
                if (!btn) return;
                activeFilter = btn.dataset.filter;
                document.querySelectorAll('.filter-pill').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                renderTasks();
            });
        });

        function tagStyle(tag) {
            if (tag === 'Materi') return 'background:rgba(117,203,80,0.15);color:#4ade80;';
            if (tag === 'Latihan') return 'background:rgba(59,130,246,0.15);color:#60a5fa;';
            if (tag === 'Penting') return 'background:rgba(245,158,11,0.15);color:#fbbf24;';
            return 'background:rgba(255,255,255,0.1);color:#94a3b8;';
        }

        const getHeaders = () => ({
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        });

        // ── Actions & API Calls ────────────────────────────────────
        async function loadTasks() {
            try {
                const res = await fetch('/todo/get');
                if (res.ok) {
                    allTasks = await res.json();
                    renderTasks();
                }
            } catch (err) {
                console.error('Failed to load tasks:', err);
            }
        }

        function renderTasks() {
            const filtered = activeFilter === 'Semua' ? allTasks : allTasks.filter(t => t.tag === activeFilter);

            const pending = filtered.filter(t => !t.done);
            const done = filtered.filter(t => t.done);

            document.getElementById('pending-list').innerHTML = pending.map(taskHTML).join('');
            document.getElementById('done-list').innerHTML = done.map(taskHTML).join('');

            document.getElementById('pending-empty').classList.toggle('hidden', pending.length > 0);
            document.getElementById('done-section').classList.toggle('hidden', done.length === 0);

            // Stats
            const total = allTasks.length;
            const doneLen = allTasks.filter(t => t.done).length;
            document.getElementById('stat-total').textContent = total;
            document.getElementById('stat-done').textContent = doneLen;
            document.getElementById('stat-pending').textContent = allTasks.filter(t => !t.done).length;

            const pct = total > 0 ? Math.round((doneLen / total) * 100) : 0;
            document.getElementById('progress-bar').style.width = pct + '%';
            document.getElementById('progress-text').textContent = pct + '%';
        }

        function taskHTML(t) {
            return `
            <div class="glass px-5 py-4 flex items-center gap-4 group task-item ${t.done ? 'completed' : ''}" id="task-${t.id}">
                <input
                    type="checkbox"
                    class="task-checkbox"
                    ${t.done ? 'checked' : ''}
                    onchange="toggleTask(${t.id})"
                />
                <span class="task-label flex-1 text-sm font-medium text-slate-800 dark:text-slate-200 transition-all">
                    ${escapeHTML(t.text)}
                </span>
                <span class="tag flex items-center gap-1" style="${tagStyle(t.tag)}">
                    ${getTagIcon(t.tag)}
                    <span>${t.tag}</span>
                </span>
                <button
                    onclick="deleteTask(${t.id})"
                    class="opacity-0 group-hover:opacity-100 text-slate-400 hover:text-red-500 transition-all p-1 rounded-lg"
                    title="Hapus"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>`;
        }

        function getTagIcon(tag) {
            if (tag === 'Materi') {
                return `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>`;
            }
            if (tag === 'Latihan') {
                return `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>`;
            }
            if (tag === 'Penting') {
                return `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>`;
            }
            return '';
        }

        function escapeHTML(str) {
            return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        }

        async function addTask() {
            const input = document.getElementById('task-input');
            const tag = document.getElementById('tag-select').value;
            const text = input.value.trim();
            if (!text) return;

            try {
                const res = await fetch('/todo/add', {
                    method: 'POST',
                    headers: getHeaders(),
                    body: JSON.stringify({ text, tag })
                });
                if (res.ok) {
                    const newTodo = await res.json();
                    allTasks.unshift(newTodo);
                    input.value = '';
                    // Reset custom dropdown values
                    document.getElementById('tag-select').value = 'Materi';
                    document.getElementById('selected-tag-label').textContent = 'Materi';
                    renderTasks();
                }
            } catch (err) {
                console.error('Failed to add task:', err);
            }
        }

        async function toggleTask(id) {
            try {
                const res = await fetch(`/todo/${id}/toggle`, {
                    method: 'POST',
                    headers: getHeaders()
                });
                if (res.ok) {
                    const updated = await res.json();
                    allTasks = allTasks.map(t => t.id === id ? updated : t);
                    renderTasks();
                }
            } catch (err) {
                console.error('Failed to toggle task:', err);
            }
        }

        async function deleteTask(id) {
            try {
                const res = await fetch(`/todo/${id}/delete`, {
                    method: 'DELETE',
                    headers: getHeaders()
                });
                if (res.ok) {
                    allTasks = allTasks.filter(t => t.id !== id);
                    renderTasks();
                }
            } catch (err) {
                console.error('Failed to delete task:', err);
            }
        }
    </script>

</body>

</html>