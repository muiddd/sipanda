<!DOCTYPE html>
<html lang="id" id="main-html" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>siPanda - Ruang Baca</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { darkMode: 'class' }</script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@600;800;900&display=swap');
        body { background-color: #f8fafc; color: #0f172a; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .dark body { background-color: #121212; color: #f2f1e8; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(40px); border: 1px solid rgba(0, 0, 0, 0.05); box-shadow: 0 10px 25px rgba(0,0,0,0.03); border-radius: 1.5rem; }
        .dark .glass { background: rgba(18, 18, 18, 0.7); border: 1px solid rgba(255, 255, 255, 0.1); }
        .bg-orb { position: fixed; border-radius: 50%; filter: blur(120px); z-index: -1; opacity: 0.1; pointer-events: none; }
        .dark .bg-orb { opacity: 0.25; }
        .orb-1 { width: 500px; height: 500px; background: #75cb50; top: -100px; right: -100px; }
        
        /* Styling khusus untuk konten teks dari database */
        .konten-materi p { margin-bottom: 1.25rem; line-height: 1.8; }
        .konten-materi h1, .konten-materi h2, .konten-materi h3 { font-family: 'Outfit', sans-serif; font-weight: bold; margin-top: 2rem; margin-bottom: 1rem; color: #75cb50; }
        .konten-materi ul, .konten-materi ol { margin-left: 1.5rem; margin-bottom: 1.25rem; }
        .konten-materi li { margin-bottom: 0.5rem; }
    </style>
</head>
<body class="relative min-h-screen">
    <div class="bg-orb orb-1"></div>

    <div class="flex min-h-screen">
        @include('student.partials.sidebar')

        <main class="ml-72 flex-1 p-8 px-10 xl:px-14 min-h-screen relative z-10">
            <div class="mb-8">
                <a href="{{ route('student.materi') }}" class="text-sm font-bold text-slate-400 hover:text-[#75cb50] transition-colors flex items-center gap-2">
                    <span>←</span> Kembali ke Daftar Materi
                </a>
            </div>

            <div class="glass p-10 max-w-4xl mx-auto mb-20">
                {{-- Header Judul Materi --}}
                <div class="border-b border-slate-200 dark:border-slate-800 pb-8 mb-8 text-center">
                    <div class="inline-block w-16 h-16 rounded-2xl bg-[#75cb50]/10 flex items-center justify-center text-3xl mb-6 border border-[#75cb50]/20 mx-auto">
                        📖
                    </div>
                    <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white mb-4">
                        {{ $materi->judul_materi }}
                    </h1>
                    <div class="flex items-center justify-center gap-4 text-sm font-medium text-slate-500">
                        <span class="bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-full">
                            🕒 {{ \Carbon\Carbon::parse($materi->tanggal_publikasi)->format('d M Y') }}
                        </span>
                        <span class="bg-[#75cb50]/10 text-[#75cb50] px-3 py-1 rounded-full border border-[#75cb50]/20">
                            🎓 Materi siPanda
                        </span>
                    </div>
                </div>

                {{-- Isi Konten Materi --}}
                <div class="konten-materi text-slate-700 dark:text-slate-300 text-lg">
                    {{-- Menggunakan {!! !!} agar tag HTML dari database (seperti <p>, <b>) tereksekusi menjadi desain, bukan text mentah --}}
                    {!! $materi->konten_teks !!}
                </div>

                {{-- Tombol Lanjut ke Kuis --}}
                <div class="mt-16 pt-8 border-t border-slate-200 dark:border-slate-800 text-center">
                    <p class="text-slate-500 font-medium mb-4">Sudah selesai membaca dan paham materinya?</p>
                    <a href="{{ route('student.latihansoal.show', $materi->materi_id) }}" class="inline-block bg-[#75cb50] hover:bg-[#64b043] text-white px-8 py-4 rounded-xl font-bold transition-all shadow-lg shadow-green-500/20 hover:-translate-y-1">
                        Uji Pemahaman Sekarang 🎯
                    </a>
                </div>
            </div>

        </main>
    </div>

    {{-- Script Sinkronisasi Tema --}}
    <script>
        const htmlElement = document.getElementById('main-html');
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlElement.classList.add('dark');
        } else {
            htmlElement.classList.remove('dark');
        }
    </script>
</body>
</html>