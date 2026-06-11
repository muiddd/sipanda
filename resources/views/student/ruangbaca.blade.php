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
    <title>siPanda - Ruang Baca</title>

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
        }

        .dark body {
            background-color: #121212;
            color: #f2f1e8;
        }

        .font-heading {
            font-family: 'Outfit', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03);
            border-radius: 1.5rem;
        }

        .dark .glass {
            background: rgba(18, 18, 18, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
            opacity: 0.1;
            pointer-events: none;
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

        /* Styling khusus untuk konten teks dari database */
        .konten-materi p {
            margin-bottom: 1.25rem;
            line-height: 1.8;
        }

        .konten-materi h1,
        .konten-materi h2,
        .konten-materi h3 {
            font-family: 'Outfit', sans-serif;
            font-weight: bold;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #75cb50;
        }

        .konten-materi ul,
        .konten-materi ol {
            margin-left: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .konten-materi li {
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body class="relative min-h-screen">
    <div class="bg-orb orb-1"></div>

    <div class="flex min-h-screen">
        @include('student.partials.sidebar')

        {{-- Penyesuaian padding mobile (p-4) dan desktop (md:p-8) --}}
        <main class="ml-0 lg:ml-72 flex-1 p-4 md:p-8 md:px-10 xl:px-14 min-h-screen relative z-10 transition-all pt-20 lg:pt-8">

            <div class="mb-6 md:mb-8 pt-4 md:pt-0">
                <a href="{{ route('student.materi') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-[#75cb50] transition-colors bg-white/50 dark:bg-black/20 px-4 py-2 rounded-full border border-slate-200 dark:border-slate-800">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>

            {{-- Flash Alert Messages --}}
            @if(session('error'))
            <div class="max-w-4xl mx-auto mb-6 bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-900/50 text-red-800 dark:text-red-200 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm" role="alert">
                <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium text-sm">{{ session('error') }}</span>
            </div>
            @endif

            @if(session('success'))
            <div class="max-w-4xl mx-auto mb-6 bg-green-50 dark:bg-green-950/30 border border-green-200 dark:border-green-900/50 text-green-800 dark:text-green-200 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm" role="alert">
                <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
            @endif

            <div class="glass p-6 md:p-12 lg:p-16 max-w-4xl mx-auto mb-20 shadow-xl shadow-slate-200/50 dark:shadow-none relative overflow-hidden">

                {{-- Aksen Latar Atas --}}
                <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-[#75cb50]/10 to-transparent pointer-events-none"></div>

                {{-- Header Judul Materi --}}
                <div class="border-b border-slate-200 dark:border-slate-800 pb-8 md:pb-12 mb-8 md:mb-12 text-center relative z-10">
                    <div class="inline-flex w-16 h-16 md:w-20 md:h-20 rounded-2xl md:rounded-3xl bg-gradient-to-br from-[#75cb50]/20 to-[#10b981]/10 items-center justify-center text-[#75cb50] mb-6 border border-[#75cb50]/30 mx-auto shadow-[inset_0_0_15px_rgba(34,197,94,0.1)]">
                        <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>

                    <h1 class="font-heading text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white mb-6 leading-tight">
                        {{ $materi->judul_materi }}
                    </h1>
                    <div class="flex items-center justify-center gap-4 text-sm font-medium text-slate-500">
                        <span class="bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-full flex items-center gap-1">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($materi->tanggal_publikasi)->format('d M Y') }}</span>
                        </span>
                        <span class="bg-[#75cb50]/10 text-[#75cb50] px-3 py-1 rounded-full border border-[#75cb50]/20 flex items-center gap-1">
                            <svg class="w-4 h-4 text-[#75cb50]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                            </svg>
                            <span>Materi siPanda</span>
                        </span>
                    </div>
                </div>

                {{-- Isi Konten Materi --}}
                <div class="konten-materi relative z-10">
                    {!! $materi->konten_teks !!}
                </div>

                {{-- Action Panel Bawah (Dual CTA) --}}
                <div class="mt-16 md:mt-24 pt-8 md:pt-10 border-t border-slate-200 dark:border-slate-800 relative z-10">
                    <div class="text-center mb-8">
                        <h4 class="font-heading text-xl font-bold text-slate-900 dark:text-white mb-2">Selesai Membaca?</h4>
                        <p class="text-slate-500 text-sm">Pilih tindakan selanjutnya untuk memperdalam pemahamanmu.</p>
                    </div>

                    {{-- Flexbox untuk menyusun tombol agar responsif & Serasi --}}
                    <div class="flex flex-col md:flex-row items-center justify-center gap-4">

                        {{-- Tombol 1: Buatkan Rangkuman AI (Style: Outline Green) --}}
                        <form action="{{ route('ai.process') }}" method="POST" class="w-full md:w-auto">
                            @csrf
                            <input type="hidden" name="action" value="summary">
                            <input type="hidden" name="materi_id" value="{{ $materi->materi_id }}">
                            <button type="submit" onclick="this.innerHTML='Menganalisis Materi... ⏳'; this.classList.add('opacity-75', 'cursor-not-allowed')" class="w-full md:w-auto px-8 py-4 rounded-xl font-bold transition-all bg-[#75cb50]/10 hover:bg-[#75cb50]/20 text-[#75cb50] border-2 border-[#75cb50]/30 hover:border-[#75cb50]/50 flex items-center justify-center gap-2 group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                                Buatkan Rangkuman AI
                            </button>
                        </form>

                        {{-- Tombol 2: Uji Pemahaman (Style: Solid Green) --}}
                        <a href="{{ route('student.latihansoal.show', $materi->materi_id) }}" class="w-full md:w-auto bg-[#75cb50] hover:bg-[#64b043] text-white px-8 py-4 rounded-xl font-bold transition-all border-2 border-[#75cb50] hover:border-[#64b043] shadow-[0_10px_20px_rgba(34,197,94,0.2)] hover:-translate-y-1 hover:shadow-[0_15px_25px_rgba(34,197,94,0.3)] flex items-center justify-center gap-2">
                            Uji Pemahaman Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- KOTAK HASIL RANGKUMAN (Akan muncul setelah proses AI selesai) --}}
                @if(session('ai_summary'))
                <div id="ai-summary-result" class="mt-16 bg-[#75cb50]/5 dark:bg-[#75cb50]/10 border-2 border-[#75cb50]/30 rounded-3xl p-8 md:p-10 relative overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-500 text-left">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 border-b border-[#75cb50]/20 pb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-[#75cb50] flex items-center justify-center text-white shadow-lg shadow-green-500/30">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-heading text-2xl font-bold text-slate-900 dark:text-white">Rangkuman AI</h3>
                                <p class="text-sm text-[#75cb50] font-bold uppercase tracking-wider mt-1">Berdasarkan Materi Ini</p>
                            </div>
                        </div>
                        <button onclick="openSummaryModal()" class="w-full sm:w-auto bg-[#75cb50] hover:bg-[#64b043] text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-all shadow-md shadow-green-500/20 active:scale-95 flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                            Simpan ke Buku Catatan
                        </button>
                    </div>

                    <div class="prose prose-slate dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 leading-relaxed text-lg">
                        {!! Str::markdown(session('ai_summary')) !!}
                    </div>
                </div>
                @endif

            </div>
        </main>
    </div>

    {{-- MODAL POPUP RANGKUMAN AI & EKSPOR KE BUKU CATATAN (Ditempatkan di luar .glass agar z-index & fixed position tidak terganggu) --}}
    @if(session('ai_summary'))
    <div id="ai-summary-modal" class="fixed inset-0 z-[150] overflow-y-auto hidden animate-in fade-in duration-300">
        {{-- Backdrop / Overlay --}}
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeSummaryModal()"></div>

        {{-- Centering container --}}
        <div class="flex min-h-screen items-center justify-center p-4">
            {{-- Modal Content Card --}}
            <div class="relative w-full max-w-4xl bg-white dark:bg-[#121212] border border-slate-200 dark:border-white/10 rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row md:h-[80vh] my-8">

                {{-- Left Side: AI Summary Display --}}
                <div class="w-full md:w-3/5 p-6 md:p-8 flex flex-col border-b md:border-b-0 md:border-r border-slate-100 dark:border-white/5 md:overflow-y-auto custom-scrollbar md:h-full text-left">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-[#75cb50]/20 flex items-center justify-center text-[#75cb50]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Rangkuman AI Berhasil Dibuat!</h3>
                            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Hasil Rangkuman Materi</p>
                        </div>
                    </div>

                    <div class="text-slate-700 dark:text-slate-300 text-sm leading-relaxed prose prose-slate dark:prose-invert max-w-none">
                        {!! Str::markdown(session('ai_summary')) !!}
                    </div>
                </div>

                {{-- Right Side: Save to Buku Catatan Form --}}
                <div class="w-full md:w-2/5 p-6 md:p-8 bg-slate-50/50 dark:bg-white/[0.01] flex flex-col justify-between md:overflow-y-auto custom-scrollbar md:h-full text-left">
                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-950 dark:text-white">Simpan ke Buku Catatan</h4>
                                <p class="text-[10px] text-slate-400 font-semibold">Simpan permanen rangkuman ini</p>
                            </div>
                        </div>

                        <form action="{{ route('student.bukucatatan.export-ai') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="summaries_id" value="{{ session('summaries_id') }}">

                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Judul Catatan</label>
                                <input type="text" name="judul" value="Rangkuman AI: {{ $materi->judul }}" required class="w-full px-3 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-800 dark:text-slate-200 focus:outline-none focus:border-[#75cb50]/50 transition font-medium" />
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Nama Buku Catatan</label>
                                <input type="text" id="nama_buku_input" name="nama_buku" value="Rangkuman Materi" required class="w-full px-3 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-800 dark:text-slate-200 focus:outline-none focus:border-[#75cb50]/50 transition font-semibold" />

                                @if(!empty($existingBooks))
                                <div class="mt-2">
                                    <p class="text-[9px] text-slate-400 dark:text-slate-500 font-bold mb-1.5 uppercase">Pilih Buku Anda (Klik untuk mengisi):</p>
                                    <div class="flex flex-wrap gap-1.5 max-h-[100px] overflow-y-auto pr-1 custom-scrollbar">
                                        @foreach($existingBooks as $bookName)
                                        <button type="button" onclick="document.getElementById('nama_buku_input').value='{{ $bookName }}'" class="px-2.5 py-1 bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-[10px] text-slate-600 dark:text-slate-300 font-semibold rounded-lg transition-colors">
                                            {{ $bookName }}
                                        </button>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-1.5">Tags (Pisahkan dengan koma)</label>
                                <input type="text" name="tags" placeholder="AI, Rangkuman, {{ $materi->judul }}" class="w-full px-3 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-800 dark:text-slate-200 focus:outline-none focus:border-[#75cb50]/50 transition font-medium" />
                            </div>

                            <button type="submit" class="w-full mt-2 bg-[#75cb50] hover:bg-[#64b043] text-white py-3 rounded-xl text-xs font-bold transition-all shadow-lg shadow-green-500/20 active:scale-95 flex items-center justify-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                Simpan ke Buku Catatan
                            </button>
                        </form>
                    </div>

                    <button type="button" onclick="closeSummaryModal()" class="w-full mt-6 bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-500 dark:text-slate-400 py-2.5 rounded-xl text-xs font-bold transition-all active:scale-95">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Scrollbar Styling & Script --}}
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.3);
            border-radius: 99px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(156, 163, 175, 0.5);
        }
    </style>

    <script>
        function openSummaryModal() {
            const modal = document.getElementById('ai-summary-modal');
            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                if (!history.state || !history.state.modalOpen) {
                    history.pushState({
                        modalOpen: true
                    }, '');
                }
            }
        }

        function closeSummaryModal(shouldGoBack = true) {
            const modal = document.getElementById('ai-summary-modal');
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
                if (shouldGoBack && history.state && history.state.modalOpen) {
                    history.back();
                }
            }
        }

        window.addEventListener('popstate', function(event) {
            closeSummaryModal(false);
        });

        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById('ai-summary-modal');
            if (modal) {
                openSummaryModal();
            }

            const resultBox = document.getElementById('ai-summary-result');
            if (resultBox) {
                resultBox.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    </script>
    @endif

    </div>
    </main>
    </div>

    <x-pomodoro-timer />

</body>

</html>

<script>
    let waktuMulaiBelajar = new Date();
    let dataSudahTerkirim = false;

    // Fungsi untuk menghitung dan mengirim
    function kirimDataSesi() {
        if (dataSudahTerkirim) return;

        let waktuSelesaiBelajar = new Date();
        let durasiMenit = Math.round((waktuSelesaiBelajar - waktuMulaiBelajar) / 60000);

        // SYARAT UJI COBA: Ganti >= 1 jadi >= 0 sementara biar gampang ngetesnya
        if (durasiMenit >= 1){
            let tzOffset = (new Date()).getTimezoneOffset() * 60000;
            let mulaiLocal = (new Date(waktuMulaiBelajar - tzOffset)).toISOString().slice(0, 19).replace('T', ' ');
            let selesaiLocal = (new Date(waktuSelesaiBelajar - tzOffset)).toISOString().slice(0, 19).replace('T', ' ');

            window.autoLogActivity(
                "Membaca Materi", 
                "{{ $materi->judul ?? 'Materi Pembelajaran' }}", 
                mulaiLocal, 
                selesaiLocal, 
                80
            );
            dataSudahTerkirim = true;
        }
    }

    // Pemicu 1: Saat pindah tab / minimize browser (Sangat disarankan oleh Google)
    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'hidden') {
            kirimDataSesi();
        }
    });

    // Pemicu 2: Saat refresh atau close browser (Cadangan)
    window.addEventListener('beforeunload', function () {
        kirimDataSesi();
    });
</script>