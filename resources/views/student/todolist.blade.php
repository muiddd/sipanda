<!DOCTYPE html>
<html lang="en" id="main-html" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>siPanda - To-Do List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
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
        .dark .bg-orb { opacity: 0.25; }
        .orb-1 { width: 500px; height: 500px; background: #75cb50; top: -100px; right: -100px; }
        .orb-2 { width: 400px; height: 400px; background: #00ac73; bottom: 10%; left: -50px; }

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
        .dark .task-checkbox { border-color: rgba(255,255,255,0.2); }
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
        .dark .filter-pill { color: rgba(255,255,255,0.35); }
        .filter-pill:hover { color: #75cb50; border-color: rgba(117,203,80,0.3); }
        .filter-pill.active {
            background: rgba(117,203,80,0.15);
            color: #75cb50;
            border-color: rgba(117,203,80,0.4);
        }

        ::-webkit-scrollbar { width: 6px; }
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
            <header class="mb-10 pt-4">
                <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white">
                    To-Do <span class="text-[#75cb50]">List</span> ✅
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 font-medium">
                    Catat dan selesaikan tugasmu hari ini.
                </p>
            </header>

            {{-- Stat Cards --}}
            <div class="grid grid-cols-3 gap-5 mb-8" id="stat-cards">
                <div class="glass px-6 py-4">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Tugas</p>
                    <p class="font-heading text-3xl font-black text-slate-900 dark:text-white mt-1" id="stat-total">0</p>
                </div>
                <div class="glass px-6 py-4">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Selesai</p>
                    <p class="font-heading text-3xl font-black text-[#75cb50] mt-1" id="stat-done">0</p>
                </div>
                <div class="glass px-6 py-4">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Belum</p>
                    <p class="font-heading text-3xl font-black text-red-500 mt-1" id="stat-pending">0</p>
                </div>
            </div>

            {{-- Input Tambah Tugas --}}
            <div class="glass px-5 py-4 flex items-center gap-4 mb-5">
                <svg class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <input
                    id="task-input"
                    type="text"
                    placeholder="Tambah tugas baru..."
                    class="flex-1 bg-transparent outline-none text-sm text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 font-medium"
                    onkeydown="if(event.key==='Enter') addTask()"
                />
                <select id="tag-select" class="bg-transparent outline-none text-xs font-bold text-slate-400 dark:text-slate-500 cursor-pointer border border-slate-200 dark:border-white/10 rounded-lg px-2 py-1">
                    <option value="Materi">📗 Materi</option>
                    <option value="Latihan">💻 Latihan</option>
                    <option value="Penting">⚠️ Penting</option>
                </select>
                <button
                    onclick="addTask()"
                    class="bg-[#75cb50] hover:bg-[#64b043] active:scale-95 text-white w-9 h-9 rounded-xl flex items-center justify-center transition-all shadow-lg shadow-green-500/20 flex-shrink-0"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                </button>
            </div>

            {{-- Filter Pills --}}
            <div class="flex items-center gap-2 mb-6" id="filter-pills">
                <button class="filter-pill active" data-filter="Semua">Semua</button>
                <button class="filter-pill" data-filter="Materi">📗 Materi</button>
                <button class="filter-pill" data-filter="Latihan">💻 Latihan</button>
                <button class="filter-pill" data-filter="Penting">⚠️ Penting</button>
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
                    <p class="text-2xl mb-2">🎉</p>
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

    <script>
        const htmlElement = document.getElementById('main-html');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlElement.classList.add('dark');
        } else {
            htmlElement.classList.remove('dark');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const darkIcon  = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');
            if (htmlElement.classList.contains('dark')) {
                lightIcon?.classList.remove('hidden');
            } else {
                darkIcon?.classList.remove('hidden');
            }
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

            loadTasks();
        });

        // ── Helpers ──────────────────────────────────────────────
        const STORAGE_KEY = 'sipanda_todos';
        let activeFilter  = 'Semua';

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

        function getTasks() {
            return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
        }

        function saveTasks(tasks) {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(tasks));
        }

        function tagStyle(tag) {
            if (tag === 'Materi')  return 'background:rgba(117,203,80,0.15);color:#4ade80;';
            if (tag === 'Latihan') return 'background:rgba(59,130,246,0.15);color:#60a5fa;';
            if (tag === 'Penting') return 'background:rgba(245,158,11,0.15);color:#fbbf24;';
            return 'background:rgba(255,255,255,0.1);color:#94a3b8;';
        }

        // ── Render ────────────────────────────────────────────────
        function loadTasks() {
            // Seed data awal kalau kosong
            if (!localStorage.getItem(STORAGE_KEY)) {
                saveTasks([
                    { id: 1, text: 'Belajar Struktur Data — Stack & Queue', tag: 'Materi',   done: false },
                    { id: 2, text: 'Kerjakan latihan soal Algoritma Dasar',  tag: 'Latihan', done: false },
                    { id: 3, text: 'Review catatan sebelum ujian besok',      tag: 'Penting', done: false },
                    { id: 4, text: 'Membaca materi Array dan Linked List',    tag: 'Materi',  done: true  },
                    { id: 5, text: 'Mengerjakan kuis Gamifikasi minggu ini',  tag: 'Latihan', done: true  },
                ]);
            }
            renderTasks();
        }

        function renderTasks() {
            const all      = getTasks();
            const filtered = activeFilter === 'Semua' ? all : all.filter(t => t.tag === activeFilter);

            const pending = filtered.filter(t => !t.done);
            const done    = filtered.filter(t =>  t.done);

            document.getElementById('pending-list').innerHTML  = pending.map(taskHTML).join('');
            document.getElementById('done-list').innerHTML     = done.map(taskHTML).join('');

            document.getElementById('pending-empty').classList.toggle('hidden', pending.length > 0);
            document.getElementById('done-section').classList.toggle('hidden',  done.length === 0);

            // Stats selalu dari semua data (tidak ikut filter)
            const total   = all.length;
            const doneLen = all.filter(t => t.done).length;
            document.getElementById('stat-total').textContent   = total;
            document.getElementById('stat-done').textContent    = doneLen;
            document.getElementById('stat-pending').textContent = all.filter(t => !t.done).length;

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
                <span class="tag" style="${tagStyle(t.tag)}">${t.tag}</span>
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

        function escapeHTML(str) {
            return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
        }

        // ── Actions ───────────────────────────────────────────────
        function addTask() {
            const input = document.getElementById('task-input');
            const tag   = document.getElementById('tag-select').value;
            const text  = input.value.trim();
            if (!text) return;

            const tasks = getTasks();
            tasks.unshift({ id: Date.now(), text, tag, done: false });
            saveTasks(tasks);
            input.value = '';
            renderTasks();
        }

        function toggleTask(id) {
            const tasks = getTasks().map(t => t.id === id ? { ...t, done: !t.done } : t);
            saveTasks(tasks);
            renderTasks();
        }

        function deleteTask(id) {
            saveTasks(getTasks().filter(t => t.id !== id));
            renderTasks();
        }
    </script>

</body>
</html>