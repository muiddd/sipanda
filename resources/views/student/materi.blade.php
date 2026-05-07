<!DOCTYPE html>
<html lang="id" id="main-html" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>siPanda - Materi</title>
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
        .glass-pill {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 9999px;
            transition: all 0.3s ease;
        }
        .dark .glass-pill {
            background: rgba(18, 18, 18, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 20px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.05);
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
        .cat-tab {
            padding: 0.625rem 1.25rem;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 0.875rem;
            cursor: pointer;
            border: 1px solid rgba(0,0,0,0.08);
            background: rgba(255,255,255,0.7);
            color: #6b7280;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .dark .cat-tab {
            border-color: rgba(255,255,255,0.1);
            background: rgba(18,18,18,0.6);
            color: #9ca3af;
        }
        .cat-tab:hover {
            border-color: rgba(117,203,80,0.4);
            color: #374151;
            background: rgba(117,203,80,0.07);
        }
        .dark .cat-tab:hover {
            color: #e2e8f0;
            background: rgba(117,203,80,0.05);
        }
        .cat-tab.active {
            background: linear-gradient(135deg, #75cb50, #10b981);
            border-color: transparent;
            color: #fff !important;
            box-shadow: 0 0 20px rgba(117,203,80,0.35);
        }
        .subject-card {
            padding: 1.25rem;
            border-radius: 1.25rem;
            border: 1px solid rgba(0,0,0,0.06);
            background: rgba(255,255,255,0.6);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            position: relative;
            overflow: hidden;
            display: block;
            text-decoration: none;
            color: inherit;
        }
        .dark .subject-card {
            border-color: rgba(255,255,255,0.07);
            background: rgba(255,255,255,0.03);
        }
        .subject-card::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(117,203,80,0.08), transparent);
            opacity: 0; transition: opacity 0.3s;
            border-radius: inherit;
        }
        .subject-card:hover {
            transform: translateY(-4px);
            border-color: rgba(117,203,80,0.4);
            box-shadow: 0 12px 30px rgba(0,0,0,0.1), 0 0 15px rgba(117,203,80,0.1);
        }
        .dark .subject-card:hover {
            box-shadow: 0 12px 30px rgba(0,0,0,0.4), 0 0 15px rgba(117,203,80,0.1);
        }
        .subject-card:hover::before { opacity: 1; }
        .card-icon-wrap {
            width: 48px; height: 48px;
            border-radius: 14px;
            background: rgba(117,203,80,0.1);
            border: 1px solid rgba(117,203,80,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 0.85rem;
            transition: background 0.3s;
        }
        .subject-card:hover .card-icon-wrap {
            background: rgba(117,203,80,0.22);
        }
        .card-arrow {
            position: absolute; bottom: 1rem; right: 1rem;
            color: #d1d5db;
            font-size: 1rem;
            transition: color 0.2s, transform 0.2s;
        }
        .dark .card-arrow { color: #374151; }
        .subject-card:hover .card-arrow {
            color: #75cb50;
            transform: translate(2px, -2px);
        }
        .topic-item {
            padding: 0.875rem 1.125rem;
            border-radius: 1rem;
            border: 1px solid rgba(0,0,0,0.06);
            background: rgba(255,255,255,0.5);
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.25s ease;
            text-decoration: none;
            color: inherit;
        }
        .dark .topic-item {
            border-color: rgba(255,255,255,0.07);
            background: rgba(255,255,255,0.03);
        }
        .topic-item:hover {
            border-color: rgba(117,203,80,0.35);
            background: rgba(117,203,80,0.05);
            transform: translateX(4px);
        }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        .dark ::-webkit-scrollbar-track { background: #121212; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #2a2a2a; }
        ::-webkit-scrollbar-thumb:hover { background: #75cb50; }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-up { animation: slideUp 0.4s ease forwards; }
        .animate-up:nth-child(1) { animation-delay: 0.05s; }
        .animate-up:nth-child(2) { animation-delay: 0.10s; }
        .animate-up:nth-child(3) { animation-delay: 0.15s; }
        .animate-up:nth-child(4) { animation-delay: 0.20s; }
        .animate-up:nth-child(5) { animation-delay: 0.25s; }
        .animate-up:nth-child(6) { animation-delay: 0.30s; }
    </style>
</head>
<body class="relative min-h-screen">

    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>

    <div class="flex min-h-screen">
        @include('student.partials.sidebar')

        <main class="ml-72 flex-1 p-8 px-10 xl:px-14 min-h-screen">

            {{-- Header --}}
            <header class="flex flex-col md:flex-row md:justify-between md:items-end mb-10 gap-6 pt-4">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2">📚 Perpustakaan Belajar</p>
                    <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white">Materi Belajar</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 font-medium">
                        Pilih jenjang dan mata pelajaran yang ingin kamu pelajari.
                    </p>
                </div>
                <div class="relative">
                    <input
                        type="text"
                        id="search-input"
                        placeholder="Cari mata pelajaran..."
                        class="glass-pill pl-10 pr-4 py-2.5 text-sm font-medium text-slate-700 dark:text-slate-300 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#75cb50]/50 w-64 transition-all"
                    >
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </header>

            {{-- Category Tabs --}}
            <div class="flex gap-3 mb-8 flex-wrap">
                <button class="cat-tab active" data-cat="smp" onclick="switchCat('smp', this)">🏫 SMP</button>
                <button class="cat-tab" data-cat="sma" onclick="switchCat('sma', this)">🎒 SMA</button>
                <button class="cat-tab" data-cat="kuliah" onclick="switchCat('kuliah', this)">🎓 Kuliah</button>
            </div>

            {{-- Stats Row --}}
            <div class="grid grid-cols-3 gap-4 mb-8" id="stats-row"></div>

            {{-- Section Label --}}
            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-4" id="grid-label">
                Mata Pelajaran — SMP
            </p>

            {{-- Subjects Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5" id="subjects-grid"></div>

            {{-- Topic Detail Panel --}}
            <div id="topic-panel" class="hidden fixed inset-0 z-50 flex items-start justify-end">
                <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closePanel()"></div>
                <div class="relative z-10 w-full max-w-lg h-screen overflow-y-auto glass rounded-none rounded-l-3xl p-8 shadow-2xl" style="border-right: none;">
                    <div class="flex items-center gap-4 mb-6">
                        <button onclick="closePanel()"
                            class="w-9 h-9 rounded-xl border border-black/10 dark:border-white/10 flex items-center justify-center text-slate-500 hover:text-[#75cb50] hover:border-[#75cb50]/40 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <div>
                            <h2 class="font-heading text-2xl font-black text-slate-900 dark:text-white" id="panel-title"></h2>
                            <span id="panel-badge" class="text-[10px] font-bold uppercase tracking-widest px-2 py-0.5 rounded-full bg-[#75cb50]/10 text-[#75cb50] border border-[#75cb50]/20"></span>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3 mb-6" id="panel-stats"></div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-3">Daftar Topik</p>
                    <div class="space-y-2.5" id="topics-list"></div>
                </div>
            </div>

        </main>
    </div>

    {{-- Theme Toggle Script --}}
    <script>
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
    </script>

    {{-- Materi Logic Script --}}
    <script>
        const materiData = @json($materiData);

        let currentCat = 'smp';
        let searchQuery = '';

        function renderStats(cat) {
            const subjects = materiData[cat].subjects;
            const totalTopics = subjects.reduce((a, s) => a + s.topics.length, 0);
            const totalSoal = subjects.reduce((a, s) => {
                return a + s.topics.reduce((b, t) => {
                    const match = t.meta.match(/(\d+) soal/);
                    return b + (match ? parseInt(match[1]) : 0);
                }, 0);
            }, 0);

            document.getElementById('stats-row').innerHTML = `
                <div class="glass p-4 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-xl border border-[#75cb50]/20">📚</div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Mata Pelajaran</p>
                        <p class="font-heading text-2xl font-black text-slate-900 dark:text-white">${subjects.length}</p>
                    </div>
                </div>
                <div class="glass p-4 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-xl border border-[#75cb50]/20">📋</div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Total Topik</p>
                        <p class="font-heading text-2xl font-black text-slate-900 dark:text-white">${totalTopics}</p>
                    </div>
                </div>
                <div class="glass p-4 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-xl border border-[#75cb50]/20">🎯</div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Latihan Soal</p>
                        <p class="font-heading text-2xl font-black text-slate-900 dark:text-white">${totalSoal}+</p>
                    </div>
                </div>
            `;
        }

        function renderGrid(cat, query = '') {
            const subjects = materiData[cat].subjects.filter(s =>
                s.title.toLowerCase().includes(query.toLowerCase())
            );
            const label = materiData[cat].label;
            document.getElementById('grid-label').textContent = `Mata Pelajaran — ${label}`;

            if (subjects.length === 0) {
                document.getElementById('subjects-grid').innerHTML = `
                    <div class="col-span-4 text-center py-16 text-slate-400">
                        <p class="text-4xl mb-3">🔍</p>
                        <p class="font-semibold">Mata pelajaran tidak ditemukan</p>
                        <p class="text-sm mt-1">Coba kata kunci lain</p>
                    </div>
                `;
                return;
            }

            document.getElementById('subjects-grid').innerHTML = subjects.map((s, i) => {
                const totalTopics = s.topics.length;
                const totalSoal = s.topics.reduce((a, t) => {
                    const match = t.meta.match(/(\d+) soal/);
                    return a + (match ? parseInt(match[1]) : 0);
                }, 0);
                return `
                    <div class="subject-card animate-up" onclick="openPanel('${cat}', ${i})">
                        <div class="card-icon-wrap">${s.icon}</div>
                        <p class="font-heading font-bold text-[1rem] text-slate-900 dark:text-slate-100 mb-1">${s.title}</p>
                        <p class="text-xs text-slate-500 font-medium">${totalTopics} topik · ${totalSoal} soal</p>
                        <span class="inline-block mt-3 text-[10px] font-bold uppercase tracking-widest px-2 py-0.5 rounded-full bg-[#75cb50]/10 text-[#75cb50] border border-[#75cb50]/20">
                            ${label}
                        </span>
                        <span class="card-arrow">→</span>
                    </div>
                `;
            }).join('');
        }

        function switchCat(cat, el) {
            document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
            currentCat = cat;
            renderStats(cat);
            renderGrid(cat, searchQuery);
        }

        const diffConfig = {
            easy: { cls: 'bg-emerald-500/10 text-emerald-500 border border-emerald-500/20', label: 'Mudah' },
            mid:  { cls: 'bg-amber-400/10 text-amber-400 border border-amber-400/20',       label: 'Sedang' },
            hard: { cls: 'bg-red-500/10 text-red-400 border border-red-400/20',             label: 'Sulit' },
        };

        function openPanel(cat, idx) {
            const subj = materiData[cat].subjects[idx];

            document.getElementById('panel-title').textContent = subj.icon + ' ' + subj.title;
            document.getElementById('panel-badge').textContent = materiData[cat].label;

            const totalSoal = subj.topics.reduce((a, t) => {
                const match = t.meta.match(/(\d+) soal/);
                return a + (match ? parseInt(match[1]) : 0);
            }, 0);
            const hardCount = subj.topics.filter(t => t.diff === 'hard').length;

            document.getElementById('panel-stats').innerHTML = `
                <div class="glass p-3 text-center">
                    <p class="font-heading text-xl font-black text-[#75cb50]">${subj.topics.length}</p>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mt-0.5">Topik</p>
                </div>
                <div class="glass p-3 text-center">
                    <p class="font-heading text-xl font-black text-[#75cb50]">${totalSoal}</p>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mt-0.5">Latihan Soal</p>
                </div>
                <div class="glass p-3 text-center">
                    <p class="font-heading text-xl font-black text-red-400">${hardCount}</p>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mt-0.5">Topik Sulit</p>
                </div>
            `;

            document.getElementById('topics-list').innerHTML = subj.topics.map((t, i) => {
                const d = diffConfig[t.diff];
                return `
                    <a href="${t.url}" class="topic-item group">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-lg bg-[#75cb50]/10 border border-[#75cb50]/20 flex items-center justify-center text-[#75cb50] text-xs font-extrabold flex-shrink-0">
                                ${i + 1}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">${t.name}</p>
                                <p class="text-[11px] text-slate-500 mt-0.5">${t.meta}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full ${d.cls}">${d.label}</span>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-[#75cb50] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                `;
            }).join('');

            document.getElementById('topic-panel').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePanel() {
            document.getElementById('topic-panel').classList.add('hidden');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closePanel();
        });

        document.getElementById('search-input').addEventListener('input', function () {
            searchQuery = this.value;
            renderGrid(currentCat, searchQuery);
        });

        renderStats('smp');
        renderGrid('smp');
    </script>

</body>
</html>