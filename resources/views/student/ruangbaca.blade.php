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

        <main class="ml-72 flex-1 p-8 px-10 xl:px-14 min-h-screen relative z-10">
            <div class="mb-8">
                <a href="{{ route('student.materi') }}" class="text-sm font-bold text-slate-400 hover:text-[#75cb50] transition-colors flex items-center gap-2">
                    <span>←</span> Kembali ke Daftar Materi
                </a>
            </div>

            <div class="glass p-10 max-w-4xl mx-auto mb-20">
                {{-- Header Judul Materi --}}
                <div class="border-b border-slate-200 dark:border-slate-800 pb-8 mb-8 text-center">
                    <div class="inline-block w-16 h-16 rounded-2xl bg-[#75cb50]/10 flex items-center justify-center text-[#75cb50] mb-6 border border-[#75cb50]/20 mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white mb-4">
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
                <div class="konten-materi text-slate-700 dark:text-slate-300 text-lg">
                    {{-- Menggunakan {!! !!} agar tag HTML dari database (seperti <p>, <b>) tereksekusi menjadi desain, bukan text mentah --}}
                    {!! $materi->konten_teks !!}
                </div>

                {{-- Tombol Lanjut ke Kuis --}}
                <div class="mt-16 pt-8 border-t border-slate-200 dark:border-slate-800 text-center">
                    <p class="text-slate-500 font-medium mb-4">Sudah selesai membaca dan paham materinya?</p>
                    <a href="{{ route('student.latihansoal.show', $materi->materi_id) }}" class="inline-block bg-[#75cb50] hover:bg-[#64b043] text-white px-8 py-4 rounded-xl font-bold transition-all shadow-lg shadow-green-500/20 hover:-translate-y-1">
                        Uji Pemahaman Sekarang
                    </a>
                </div>
            </div>

        </main>
    </div>

    <x-pomodoro-timer />

    <script>
        // No custom page theme-toggle is needed here as it is globally managed by the sidebar.
    </script>
</body>

</html>