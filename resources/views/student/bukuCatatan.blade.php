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
    <title>siPanda - Buku Catatan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .dark body { background-color: #121212; color: #f2f1e8; }
        h1,h2,h3,h4,h5,h6,.font-heading { font-family: 'Outfit', sans-serif; letter-spacing: -0.01em; }
        .glass {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
            border-radius: 1.5rem;
            transition: all 0.3s ease;
        }
        .dark .glass {
            background: rgba(18,18,18,0.7);
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 20px 40px rgba(0,0,0,0.5), inset 0 2px 0 rgba(255,255,255,0.05);
        }
        .glass-sidebar { border-radius: 0 1.5rem 1.5rem 0; border-left: none; }
        .bg-orb { position: fixed; border-radius: 50%; filter: blur(120px); z-index: -1; opacity: 0.1; pointer-events: none; transition: opacity 0.3s ease; }
        .dark .bg-orb { opacity: 0.25; }
        .orb-1 { width:500px;height:500px;background:#75cb50;top:-100px;right:-100px; }
        .orb-2 { width:400px;height:400px;background:#00ac73;bottom:10%;left:-50px; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #2a2a2a; }
        ::-webkit-scrollbar-thumb:hover { background: #75cb50; }

        /* Tipe badge */
        .badge-ai        { background: rgba(117,203,80,0.15); color: #75cb50; border: 1px solid rgba(117,203,80,0.3); }
        .badge-highlight { background: rgba(251,191,36,0.15); color: #f59e0b; border: 1px solid rgba(251,191,36,0.3); }
        .badge-manual    { background: rgba(99,102,241,0.15); color: #6366f1; border: 1px solid rgba(99,102,241,0.3); }
        .badge-penting   { background: rgba(239,68,68,0.15);  color: #ef4444; border: 1px solid rgba(239,68,68,0.3); }

        /* Catatan list item */
        .catatan-item { transition: all 0.2s ease; cursor: pointer; border-left: 3px solid transparent; }
        .catatan-item:hover { background: rgba(117,203,80,0.05); border-left-color: rgba(117,203,80,0.3); }
        .catatan-item.active { background: rgba(117,203,80,0.08); border-left-color: #75cb50; }
        .dark .catatan-item:hover { background: rgba(117,203,80,0.04); }
        .dark .catatan-item.active { background: rgba(117,203,80,0.06); }

        /* Buku list item */
        .buku-item { transition: all 0.2s ease; cursor: pointer; }
        .buku-item:hover { background: rgba(0,0,0,0.04); }
        .buku-item.active { background: rgba(117,203,80,0.1); border: 1px solid rgba(117,203,80,0.25); }
        .dark .buku-item:hover { background: rgba(255,255,255,0.04); }
        .dark .buku-item.active { background: rgba(117,203,80,0.08); }

        /* Prose for catatan content */
        .prose-catatan { line-height: 1.75; }
        .prose-catatan h1,.prose-catatan h2,.prose-catatan h3 { font-family:'Outfit',sans-serif; font-weight:700; margin-bottom:0.5em; }
        .prose-catatan p { margin-bottom:0.75em; }
        .prose-catatan ul,.prose-catatan ol { padding-left:1.25em; margin-bottom:0.75em; }
        .prose-catatan li { margin-bottom:0.25em; }
        .prose-catatan strong { font-weight:700; }

        /* Modal overlay */
        .modal-overlay { background: rgba(0,0,0,0.5); backdrop-filter: blur(8px); }

        /* Sidebar highlight strip */
        .buku-accent { width: 3px; background: linear-gradient(to bottom, #75cb50, #10b981); border-radius: 2px; }

        @keyframes fadeInUp {
            from { opacity:0; transform:translateY(12px); }
            to   { opacity:1; transform:translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 0.35s ease forwards; }
    </style>
</head>

<body class="relative min-h-screen">
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>

    <div class="flex min-h-screen">
        @include('student.partials.sidebar')

        <main class="ml-72 flex-1 min-h-screen flex flex-col">

            {{-- ======= TOP HEADER ======= --}}
            <header class="px-10 pt-8 pb-6 flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-1">
                        PERPUSTAKAAN BELAJAR
                    </p>
                    <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white flex items-center gap-3">
                        Buku Catatan
                        <span class="text-base font-bold bg-[#75cb50]/10 text-[#75cb50] px-3 py-1 rounded-full border border-[#75cb50]/20">
                            {{ $totalCatatan }}
                        </span>
                    </h1>
                </div>
                <div class="flex items-center gap-3">
                    {{-- Search --}}
                    <div class="relative">
                        <input type="text" id="search-input" placeholder="Cari catatan..."
                            class="w-52 pl-9 pr-4 py-2.5 rounded-xl text-sm bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 text-slate-700 dark:text-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#75cb50]/50 focus:ring-2 focus:ring-[#75cb50]/10 transition">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    {{-- Filter --}}
                    <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold border border-black/10 dark:border-white/10 text-slate-600 dark:text-slate-400 bg-white dark:bg-white/5 hover:border-[#75cb50]/40 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Filter
                    </button>
                    {{-- PDF --}}
                    <button class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold border border-black/10 dark:border-white/10 text-slate-600 dark:text-slate-400 bg-white dark:bg-white/5 hover:border-[#75cb50]/40 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        PDF
                    </button>
                    {{-- Buku Baru --}}
                    <button onclick="openModalBaru()"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold bg-gradient-to-r from-[#75cb50] to-[#10b981] text-white shadow-[0_4px_15px_rgba(34,197,94,0.25)] hover:shadow-[0_4px_20px_rgba(34,197,94,0.4)] hover:scale-[1.02] transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Buku Baru
                    </button>
                </div>
            </header>

            {{-- ======= STATS BAR ======= --}}
            <div class="px-10 mb-6 grid grid-cols-4 gap-4">
                @php
                    $stats = [
                        ['label'=>'Total Buku',    'val'=>$totalBuku,    'icon'=>'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['label'=>'Total Catatan', 'val'=>$totalCatatan, 'icon'=>'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                        ['label'=>'Dari AI',       'val'=>$totalDariAi,  'icon'=>'M13 10V3L4 14h7v7l9-11h-7z'],
                        ['label'=>'Hari ini',      'val'=>$hariIni,      'icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'sub'=>'Terakhir Diupdate'],
                    ];
                @endphp
                @foreach($stats as $s)
                <div class="glass p-5 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-[#75cb50]/10 flex items-center justify-center text-[#75cb50] border border-[#75cb50]/20 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-heading text-2xl font-black text-slate-900 dark:text-white">{{ $s['val'] }}</p>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">{{ $s['label'] }}</p>
                        @if(isset($s['sub']))
                            <p class="text-[10px] text-slate-500 mt-0.5">{{ $s['sub'] }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            {{-- ======= SUCCESS TOAST ======= --}}
            @if(session('success'))
            <div id="toast-success" class="mx-10 mb-4 px-5 py-3.5 rounded-xl bg-[#75cb50]/10 border border-[#75cb50]/30 text-[#75cb50] text-sm font-semibold flex items-center gap-3 fade-in-up">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
                <button onclick="this.parentElement.remove()" class="ml-auto opacity-60 hover:opacity-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            @endif

            {{-- ======= THREE COLUMN LAYOUT ======= --}}
            <div class="px-10 pb-10 flex gap-4 flex-1 min-h-0" style="height: calc(100vh - 280px)">

                {{-- === KOLOM 1: DAFTAR BUKU === --}}
                <div class="w-64 flex-shrink-0 glass flex flex-col overflow-hidden">
                    <div class="p-4 border-b border-black/5 dark:border-white/5 flex items-center justify-between">
                        <h3 class="font-heading text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                            Buku Saya
                        </h3>
                        <button onclick="openModalBaru()" title="Buku Baru"
                            class="w-7 h-7 rounded-lg bg-[#75cb50]/10 text-[#75cb50] flex items-center justify-center hover:bg-[#75cb50]/20 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 overflow-y-auto p-3 space-y-1">
                        @forelse($daftarBuku as $buku)
                        <a href="{{ route('student.bukucatatan', ['buku' => $buku->nama_buku]) }}"
                            class="buku-item flex items-center gap-3 p-3 rounded-xl {{ $selectedBuku === $buku->nama_buku ? 'active' : '' }}">
                            <div class="w-8 h-8 rounded-lg bg-[#75cb50]/10 flex items-center justify-center text-[#75cb50] flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 truncate">
                                    {{ $buku->nama_buku }}
                                </p>
                                <p class="text-[11px] text-slate-400 mt-0.5">
                                    {{ $buku->jumlah_catatan }} catatan
                                </p>
                            </div>
                            @if($selectedBuku === $buku->nama_buku)
                                <div class="buku-accent self-stretch"></div>
                            @endif
                        </a>
                        @empty
                        <div class="text-center py-8 px-4">
                            <div class="w-12 h-12 rounded-2xl bg-[#75cb50]/10 flex items-center justify-center text-[#75cb50] mx-auto mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <p class="text-xs text-slate-400 font-medium">Belum ada buku</p>
                            <p class="text-[11px] text-slate-400 mt-1">Ekspor ringkasan AI<br>atau buat catatan baru</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- === KOLOM 2: DAFTAR CATATAN === --}}
                <div class="w-72 flex-shrink-0 glass flex flex-col overflow-hidden">
                    <div class="p-4 border-b border-black/5 dark:border-white/5">
                        <h3 class="font-heading text-sm font-bold text-slate-700 dark:text-slate-300">
                            {{ $selectedBuku ?? 'Pilih Buku' }}
                        </h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">{{ $catatan->count() }} catatan</p>
                    </div>

                    {{-- Filter Tabs --}}
                    <div class="px-3 pt-3 flex gap-1.5" id="filter-tabs">
                        @foreach(['Semua','AI','Highlight','Manual'] as $tab)
                        <button onclick="filterCatatan('{{ $tab }}')"
                            data-tab="{{ $tab }}"
                            class="tab-btn px-3 py-1.5 rounded-lg text-[11px] font-bold transition
                                {{ $tab === 'Semua' ? 'bg-[#75cb50]/10 text-[#75cb50] border border-[#75cb50]/20' : 'text-slate-400 hover:text-slate-600 dark:hover:text-slate-300' }}">
                            {{ $tab }}
                        </button>
                        @endforeach
                    </div>

                    <div class="flex-1 overflow-y-auto p-3 space-y-1 mt-2" id="catatan-list">
                        @forelse($catatan as $c)
                        <a href="{{ route('student.bukucatatan', ['buku' => $selectedBuku, 'catatan_id' => $c->catatan_id]) }}"
                            class="catatan-item flex flex-col p-3 rounded-xl {{ optional($selectedCatatan)->catatan_id === $c->catatan_id ? 'active' : '' }}"
                            data-tipe="{{ $c->tipe }}">
                            <div class="flex items-start justify-between gap-2 mb-1">
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 leading-tight line-clamp-1">
                                    {{ $c->judul }}
                                </p>
                                <span class="badge-{{ strtolower($c->tipe) }} text-[10px] font-bold px-2 py-0.5 rounded-full flex-shrink-0">
                                    {{ $c->tipe }}
                                </span>
                            </div>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                {{ Str::limit(strip_tags($c->isi), 80) }}
                            </p>
                            <div class="flex items-center gap-2 mt-2">
                                @if($c->is_penting)
                                <span class="badge-penting text-[10px] font-bold px-2 py-0.5 rounded-full">Penting</span>
                                @endif
                                <span class="text-[10px] text-slate-400 ml-auto">
                                    {{ $c->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </a>
                        @empty
                        <div class="text-center py-10 px-4">
                            <p class="text-xs text-slate-400 font-medium">Belum ada catatan</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- === KOLOM 3: DETAIL CATATAN === --}}
                <div class="flex-1 glass flex flex-col overflow-hidden">
                    @if($selectedCatatan)
                    <div class="flex-1 overflow-y-auto p-8 fade-in-up">

                        {{-- Judul & Badge --}}
                        <div class="flex items-start justify-between gap-4 mb-2">
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-4 h-4 text-[#75cb50]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    <span class="text-[11px] font-bold text-[#75cb50] uppercase tracking-widest">RINGKASAN AI</span>
                                </div>
                                <h2 class="font-heading text-2xl font-black text-slate-900 dark:text-white leading-tight">
                                    {{ $selectedCatatan->judul }}
                                </h2>
                                <p class="text-xs text-slate-400 mt-1.5">
                                    {{ $selectedCatatan->nama_buku }} &bull;
                                    {{ $selectedCatatan->created_at->translatedFormat('j F Y, H:i') }}
                                </p>
                            </div>
                            <span class="badge-{{ strtolower($selectedCatatan->tipe) }} text-xs font-bold px-3 py-1.5 rounded-full flex-shrink-0">
                                {{ $selectedCatatan->tipe }}
                            </span>
                        </div>

                        <hr class="border-black/5 dark:border-white/5 my-5">

                        {{-- Isi Catatan --}}
                        <div class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-4">
                            ISI CATATAN
                        </div>
                        <div class="prose-catatan text-slate-700 dark:text-slate-300 text-sm leading-relaxed">
                            {!! Str::markdown($selectedCatatan->isi) !!}
                        </div>

                        {{-- Tags --}}
                        @if($selectedCatatan->tags && count($selectedCatatan->tags))
                        <div class="mt-6">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">TAG</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($selectedCatatan->tags as $tag)
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 border border-black/5 dark:border-white/10">
                                    {{ $tag }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Sumber --}}
                        @if($selectedCatatan->sumber)
                        <div class="mt-5">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">SUMBER</p>
                            <p class="text-sm text-slate-600 dark:text-slate-400">
                                {{ $selectedCatatan->sumber }}
                            </p>
                        </div>
                        @endif
                    </div>

                    {{-- Action Buttons --}}
                    <div class="p-5 border-t border-black/5 dark:border-white/5 flex flex-col gap-2">
                        @if($selectedCatatan->materi_id)
                        <a href="{{ route('student.materi.show', $selectedCatatan->materi_id) }}"
                            class="flex items-center justify-center gap-2 w-full py-3 rounded-xl text-sm font-bold bg-gradient-to-r from-[#75cb50] to-[#10b981] text-white shadow-[0_4px_15px_rgba(34,197,94,0.2)] hover:shadow-[0_4px_20px_rgba(34,197,94,0.35)] hover:scale-[1.01] transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Buka Materi Sumber
                        </a>
                        @endif
                        <div class="flex gap-2">
                            <button class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-bold border border-black/10 dark:border-white/10 text-slate-600 dark:text-slate-300 hover:bg-black/5 dark:hover:bg-white/5 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </button>
                            <button class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-bold border border-black/10 dark:border-white/10 text-slate-600 dark:text-slate-300 hover:bg-black/5 dark:hover:bg-white/5 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                PDF
                            </button>
                        </div>
                        <form action="{{ route('student.bukucatatan.destroy', $selectedCatatan->catatan_id) }}" method="POST"
                            onsubmit="return confirm('Yakin hapus catatan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-sm font-bold text-red-500 border border-red-500/20 hover:bg-red-500/5 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus Catatan
                            </button>
                        </form>
                    </div>

                    @else
                    {{-- Empty state --}}
                    <div class="flex-1 flex flex-col items-center justify-center text-center px-8">
                        <div class="w-20 h-20 rounded-3xl bg-[#75cb50]/10 flex items-center justify-center text-[#75cb50] mb-5 border border-[#75cb50]/20">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="font-heading text-xl font-bold text-slate-700 dark:text-slate-300 mb-2">
                            Pilih catatan
                        </h3>
                        <p class="text-sm text-slate-400 leading-relaxed max-w-xs">
                            Pilih catatan dari daftar di sebelah kiri, atau ekspor ringkasan AI dari halaman Dashboard.
                        </p>
                    </div>
                    @endif
                </div>

            </div>
        </main>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL: Catatan / Buku Baru                                   --}}
    {{-- ============================================================ --}}
    <div id="modal-baru" class="fixed inset-0 z-50 hidden items-center justify-center">
        <div class="modal-overlay absolute inset-0" onclick="closeModalBaru()"></div>
        <div class="relative z-10 w-full max-w-lg mx-4 glass p-8 fade-in-up">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-heading text-xl font-bold text-slate-900 dark:text-white">Catatan Baru</h3>
                <button onclick="closeModalBaru()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form action="{{ route('student.bukucatatan.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Judul Catatan</label>
                    <input type="text" name="judul" required placeholder="Judul catatan..."
                        class="w-full px-4 py-3 rounded-xl text-sm bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 text-slate-700 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:border-[#75cb50]/50 focus:ring-2 focus:ring-[#75cb50]/10 transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Buku</label>
                    <input type="text" name="nama_buku" required placeholder="Contoh: Biologi Sel"
                        list="daftar-buku-datalist"
                        class="w-full px-4 py-3 rounded-xl text-sm bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 text-slate-700 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:border-[#75cb50]/50 focus:ring-2 focus:ring-[#75cb50]/10 transition">
                    <datalist id="daftar-buku-datalist">
                        @foreach($daftarBuku as $b)
                        <option value="{{ $b->nama_buku }}">
                        @endforeach
                    </datalist>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Isi Catatan</label>
                    <textarea name="isi" required rows="5" placeholder="Tulis catatan di sini..."
                        class="w-full px-4 py-3 rounded-xl text-sm bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 text-slate-700 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:border-[#75cb50]/50 focus:ring-2 focus:ring-[#75cb50]/10 transition resize-none"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Tipe</label>
                        <select name="tipe" class="w-full px-4 py-3 rounded-xl text-sm bg-white dark:bg-[#1a1a1a] border border-black/10 dark:border-white/10 text-slate-700 dark:text-slate-200 focus:outline-none focus:border-[#75cb50]/50 transition">
                            <option value="Manual">Manual</option>
                            <option value="Highlight">Highlight</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Tags</label>
                        <input type="text" name="tags" placeholder="Bab 1, Materi, ..."
                            class="w-full px-4 py-3 rounded-xl text-sm bg-white dark:bg-white/5 border border-black/10 dark:border-white/10 text-slate-700 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:border-[#75cb50]/50 focus:ring-2 focus:ring-[#75cb50]/10 transition">
                    </div>
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_penting" value="1"
                        class="w-4 h-4 rounded accent-[#75cb50]">
                    <span class="text-sm font-medium text-slate-600 dark:text-slate-300">Tandai sebagai Penting</span>
                </label>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModalBaru()"
                        class="flex-1 py-3 rounded-xl text-sm font-bold border border-black/10 dark:border-white/10 text-slate-600 dark:text-slate-300 hover:bg-black/5 dark:hover:bg-white/5 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-3 rounded-xl text-sm font-bold bg-gradient-to-r from-[#75cb50] to-[#10b981] text-white shadow-[0_4px_15px_rgba(34,197,94,0.25)] hover:shadow-[0_4px_20px_rgba(34,197,94,0.4)] transition-all">
                        Simpan Catatan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <x-pomodoro-timer />
    @include('student.partials.loading')

    <script>
        // ==========================================
        // Modal Buku/Catatan Baru
        // ==========================================
        function openModalBaru() {
            const modal = document.getElementById('modal-baru');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeModalBaru() {
            const modal = document.getElementById('modal-baru');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // ==========================================
        // Filter catatan by tipe
        // ==========================================
        function filterCatatan(tipe) {
            // Update active tab
            document.querySelectorAll('.tab-btn').forEach(btn => {
                const isActive = btn.dataset.tab === tipe;
                btn.className = `tab-btn px-3 py-1.5 rounded-lg text-[11px] font-bold transition ${
                    isActive
                        ? 'bg-[#75cb50]/10 text-[#75cb50] border border-[#75cb50]/20'
                        : 'text-slate-400 hover:text-slate-600 dark:hover:text-slate-300'
                }`;
            });

            // Filter items
            document.querySelectorAll('#catatan-list .catatan-item').forEach(item => {
                const show = tipe === 'Semua' || item.dataset.tipe === tipe;
                item.style.display = show ? '' : 'none';
            });
        }

        // ==========================================
        // Search
        // ==========================================
        document.getElementById('search-input').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('#catatan-list .catatan-item').forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(query) ? '' : 'none';
            });
        });

        // ==========================================
        // Auto-dismiss toast after 4s
        // ==========================================
        const toast = document.getElementById('toast-success');
        if (toast) setTimeout(() => toast.remove(), 4000);
    </script>
</body>
</html>