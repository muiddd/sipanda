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
            display: flex;
            flex-direction: column;
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
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-up { animation: slideUp 0.4s ease forwards; }
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
                        Pilih kategori dan materi yang ingin kamu pelajari hari ini.
                    </p>
                </div>
                <div class="relative">
                    <input
                        type="text"
                        id="search-input"
                        placeholder="Cari materi..."
                        class="glass-pill pl-10 pr-4 py-2.5 text-sm font-medium text-slate-700 dark:text-slate-300 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#75cb50]/50 w-64 transition-all"
                    >
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </header>

            @if(count($materiGrouped) > 0)
                {{-- Category Tabs (Dibuat otomatis sesuai nama Kategori di Database) --}}
                <div class="flex gap-3 mb-8 flex-wrap" id="tabs-container">
                    @foreach($materiGrouped as $kategori => $materis)
                        <button class="cat-tab {{ $loop->first ? 'active' : '' }}" 
                                data-cat="{{ $kategori }}" 
                                onclick="switchCat('{{ $kategori }}', this)">
                            📖 {{ $kategori }}
                        </button>
                    @endforeach
                </div>

                {{-- Stats Row --}}
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8" id="stats-row"></div>

                {{-- Section Label --}}
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-4" id="grid-label">
                    Daftar Materi
                </p>

                {{-- Subjects Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5" id="subjects-grid"></div>
            @else
                {{-- Tampilan Jika Database Masih Kosong --}}
                <div class="text-center py-20">
                    <p class="text-6xl mb-4">🐼</p>
                    <h3 class="text-xl font-bold dark:text-white">Belum ada materi</h3>
                    <p class="text-slate-500 mt-2">Guru belum menambahkan materi pembelajaran apapun ke dalam sistem.</p>
                </div>
            @endif

        </main>
    </div>

    {{-- Script Kirim Data dari Laravel ke JS --}}
    <script>
        // Mengubah Collection Laravel menjadi JSON agar bisa dibaca JavaScript
        const dbData = @json($materiGrouped);
        let currentCat = Object.keys(dbData)[0] || '';
        let searchQuery = '';

        function renderStats(cat) {
            if (!dbData[cat]) return;
            const materis = dbData[cat];
            
            document.getElementById('stats-row').innerHTML = `
                <div class="glass p-4 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-xl border border-[#75cb50]/20">📚</div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Total Materi</p>
                        <p class="font-heading text-2xl font-black text-slate-900 dark:text-white">${materis.length}</p>
                    </div>
                </div>
                <div class="glass p-4 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-[rgba(34,197,94,0.1)] flex items-center justify-center text-xl border border-[#75cb50]/20">🚀</div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Kategori</p>
                        <p class="font-heading text-lg font-black text-slate-900 dark:text-white pt-1">${cat}</p>
                    </div>
                </div>
            `;
        }

        function renderGrid(cat, query = '') {
            if (!dbData[cat]) return;
            
            // Logika pencarian: Cocokkan query dengan judul (atau title) dari database
            const materis = dbData[cat].filter(m => {
                const title = m.judul || m.title || '';
                return title.toLowerCase().includes(query.toLowerCase());
            });

            document.getElementById('grid-label').textContent = `Daftar Materi — ${cat}`;

            if (materis.length === 0) {
                document.getElementById('subjects-grid').innerHTML = `
                    <div class="col-span-4 text-center py-16 text-slate-400">
                        <p class="text-4xl mb-3">🔍</p>
                        <p class="font-semibold">Materi tidak ditemukan</p>
                        <p class="text-sm mt-1">Coba gunakan kata kunci lain</p>
                    </div>
                `;
                return;
            }

            document.getElementById('subjects-grid').innerHTML = materis.map((m, i) => {
                const title = m.judul || m.title || 'Tanpa Judul';
                // Jika kamu nanti membuat Ruang Baca, arahkan href ini ke URL detail materi
                const url = '#'; // Contoh nanti: /student/materi/baca/${m.id}
                
                return `
                    <a href="${url}" class="subject-card animate-up" style="animation-delay: ${i * 0.05}s">
                        <div class="card-icon-wrap">📄</div>
                        <p class="font-heading font-bold text-[1rem] text-slate-900 dark:text-slate-100 mb-1">${title}</p>
                        <p class="text-xs text-slate-500 font-medium mt-auto pt-4">Klik untuk mulai membaca</p>
                        <span class="card-arrow">→</span>
                    </a>
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

        document.getElementById('search-input').addEventListener('input', function () {
            searchQuery = this.value;
            renderGrid(currentCat, searchQuery);
        });

        // Load data pertama kali saat halaman dibuka
        if(currentCat) {
            renderStats(currentCat);
            renderGrid(currentCat);
        }
    </script>
    
    {{-- Theme Toggle Script (Tetap sama) --}}
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        // ... (asumsikan tombol toggle tema ada di sidebar) ...
        const htmlElement = document.getElementById('main-html');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlElement.classList.add('dark');
        } else {
            htmlElement.classList.remove('dark');
        }
    </script>
</body>
</html>