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
    <title>siPanda - Riwayat Skor</title>

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

        <main class="ml-72 flex-1 p-8 px-10 xl:px-14 min-h-screen">

            {{-- Header --}}
            <header class="flex flex-col md:flex-row md:justify-between md:items-end mb-12 gap-6 pt-4">
                <div>
                    <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white transition-colors">
                        Riwayat <span class="text-[#75cb50]">Skor</span>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-2 font-medium">
                        Lihat histori skor anda dari latihan soal yang telah anda kerjakan!
                    </p>
                </div>
            </header>

            <div class="mt-8">
                @if($history->isEmpty())
                <div class="glass p-6 text-center py-12">
                    <div class="mb-6 text-slate-400/80 flex justify-center">
                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-slate-900 dark:text-white">Belum Ada Riwayat Skor</h3>
                    <p class="text-slate-500 mt-2">Kerjakan kuis untuk mulai membangun riwayat skor Anda.</p>
                </div>
                @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($history as $row)
                    <div class="glass p-6 group cursor-pointer hover:border-[#75cb50]/50 transition-all relative overflow-hidden flex flex-col justify-between">
                        <div class="absolute -right-6 -top-6 text-slate-400/10 dark:text-slate-500/5 group-hover:scale-110 group-hover:-rotate-12 transition-all duration-500 pointer-events-none">
                            <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>

                        <div>
                            <div class="w-12 h-12 rounded-xl bg-[#75cb50]/10 flex items-center justify-center text-[#75cb50] mb-4 border border-[#75cb50]/20 group-hover:bg-[#75cb50]/20 transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>

                            <h3 class="font-heading text-lg font-bold text-slate-900 dark:text-white mb-2">{{ $row->judul_materi }}</h3>

                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-500 dark:text-slate-400">Tanggal</span>
                                    <span class="font-semibold text-slate-700 dark:text-slate-300">{{ \Carbon\Carbon::parse($row->attempt_date)->translatedFormat('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-500 dark:text-slate-400">Hasil</span>
                                    <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $row->correct_count }}/{{ $row->total_questions }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-end justify-between gap-3">
                            <div>
                                <div class="text-xs text-slate-500 mb-1">Skor</div>
                                <div class="font-heading text-3xl font-black text-[#75cb50]">{{ $row->score }}<span class="text-lg">%</span></div>
                            </div>
                            <button data-materi="{{ $row->materi_id }}" data-date="{{ $row->attempt_date }}" data-materi-name="{{ $row->judul_materi }}" class="open-detail bg-[#75cb50] hover:bg-[#64b043] text-white px-4 py-2 rounded-xl font-bold text-sm transition-all active:scale-95 shadow-lg shadow-green-500/20">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </main>
    </div>

    <x-pomodoro-timer />

    <!-- Detail Modal -->
    <div id="detail-modal" class="fixed inset-0 z-50 hidden items-center justify-center px-4">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" id="modal-backdrop"></div>
        <div class="relative max-w-3xl w-full glass p-6 rounded-xl z-10">
            <div class="flex justify-between items-start gap-4">
                <div>
                    <h3 id="modal-title" class="font-heading text-xl font-bold text-slate-900 dark:text-white">Detail Jawaban</h3>
                    <p id="modal-sub" class="text-slate-500 text-sm mt-1">Rangkuman jawaban kuis</p>
                </div>
                <button id="close-modal" class="text-slate-500 hover:text-slate-900 dark:hover:text-white">✕</button>
            </div>

            <div id="modal-body" class="mt-6 space-y-6 max-h-[60vh] overflow-y-auto">
                <!-- populated by JS -->
            </div>
        </div>
    </div>

    <script>
        // No custom page theme-toggle is needed here as it is globally managed by the sidebar.

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('detail-modal');
            const modalBody = document.getElementById('modal-body');
            const modalTitle = document.getElementById('modal-title');
            const modalSub = document.getElementById('modal-sub');
            const closeModal = document.getElementById('close-modal');
            const backdrop = document.getElementById('modal-backdrop');

            function openModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function close() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modalBody.innerHTML = '';
            }

            closeModal.addEventListener('click', close);
            backdrop.addEventListener('click', close);

            document.querySelectorAll('.open-detail').forEach(btn => {
                btn.addEventListener('click', async function() {
                    const materi = this.dataset.materi;
                    const date = this.dataset.date;
                    const materiName = this.dataset.materiName;
                    modalTitle.textContent = 'Detail Jawaban — ' + materiName;
                    modalSub.textContent = new Date(date).toLocaleDateString();

                    openModal();
                    modalBody.innerHTML = '<div class="text-center py-8">Memuat...</div>';

                    try {
                        const res = await fetch(`/riwayatskor/${materi}/${date}`);
                        if (!res.ok) throw new Error('Gagal memuat data');
                        const json = await res.json();
                        if (json.status !== 'success') throw new Error('Response error');

                        const items = json.data;
                        modalBody.innerHTML = '';

                        items.forEach((it, idx) => {
                            const correct = it.is_correct;
                            const wrapper = document.createElement('div');
                            wrapper.className = 'p-4 border rounded-lg ' + (correct ? 'border-green-200 bg-green-50/40' : 'border-red-200 bg-red-50/30');

                            let optionsHtml = '';
                            it.options.forEach(opt => {
                                const letter = opt.trim().slice(0, 1);
                                const isUser = letter === it.user_answer_letter;
                                const isCorrect = letter === it.correct_letter;
                                let cls = 'text-slate-700';
                                if (isCorrect) cls = 'font-bold text-green-700';
                                if (isUser && !isCorrect) cls = 'font-semibold text-red-700';
                                optionsHtml += `<div class="px-3 py-1 rounded-md ${isCorrect ? 'bg-green-100/60' : ''}">
                                    <span class="${cls}">${opt}</span>
                                </div>`;
                            });

                            wrapper.innerHTML = `
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="text-sm text-slate-500">Soal ${idx + 1}</div>
                                        <div class="font-semibold text-slate-900 dark:text-white mt-2">${it.question}</div>
                                        <div class="mt-3 space-y-2">${optionsHtml}</div>
                                    </div>
                                    <div class="w-40 text-right">
                                        <div class="text-xs text-slate-500">Jawaban Anda</div>
                                        <div class="font-bold mt-1">${it.user_answer_text ?? it.user_answer_letter}</div>
                                        <div class="text-xs text-slate-500 mt-2">Jawaban Benar</div>
                                        <div class="font-bold mt-1 text-green-700">${it.correct_text ?? it.correct_letter}</div>
                                    </div>
                                </div>
                            `;

                            modalBody.appendChild(wrapper);
                        });

                    } catch (err) {
                        modalBody.innerHTML = '<div class="text-center text-red-600 py-8">Gagal memuat detail.</div>';
                        console.error(err);
                    }
                });
            });
        });
    </script>
</body>

</html>