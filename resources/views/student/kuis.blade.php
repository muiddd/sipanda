<!DOCTYPE html>
<html lang="id" id="main-html" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>siPanda - Kuis AI</title>
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
        
        .opsi-label { cursor: pointer; transition: all 0.2s ease-in-out; }
        .opsi-label:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .opsi-radio:checked + div { background-color: rgba(117, 203, 80, 0.15); border-color: #75cb50; box-shadow: 0 0 0 2px rgba(117, 203, 80, 0.3); }
    </style>
</head>
<body class="relative min-h-screen">
    <div class="bg-orb orb-1"></div>

    <div class="flex min-h-screen">
        @include('student.partials.sidebar')

        <main class="ml-72 flex-1 p-8 px-10 xl:px-14 min-h-screen relative z-10">
            <div class="mb-8 flex justify-between items-center">
                <div>
                    <a href="{{ route('student.latihansoal') }}" class="text-sm font-bold text-slate-400 hover:text-[#75cb50] transition-colors">← Kembali ke Latihan Soal</a>
                    <h1 class="font-heading text-4xl font-black text-slate-900 dark:text-white mt-4">Kuis: {{ $materi->judul_materi }}</h1>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-[#75cb50]/10 border border-[#75cb50]/50 text-[#75cb50] p-4 rounded-xl mb-6 font-bold">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if($savedSoal->isEmpty())
                <div class="glass p-10 text-center max-w-2xl mx-auto mt-20">
                    <div class="text-6xl mb-6">🤖</div>
                    <h2 class="font-heading text-2xl font-bold mb-2 dark:text-white">Siap Menguji Pemahamanmu?</h2>
                    <p class="text-slate-500 mb-8">AI siPanda akan membaca materi secara instan dan membuatkan 5 soal pilihan ganda khusus untukmu.</p>
                    
                    <form action="{{ route('student.latihansoal.generate', $materi->materi_id) }}" method="POST">
                        @csrf
                        <button type="submit" onclick="this.innerHTML='Menganalisis Materi... ⏳'; this.classList.add('opacity-75', 'cursor-not-allowed')" class="bg-[#75cb50] hover:bg-[#64b043] text-white px-8 py-4 rounded-2xl font-bold text-lg transition-all shadow-lg shadow-green-500/30">
                            ✨ Generate Soal AI Sekarang
                        </button>
                    </form>
                </div>
            @else
                <div class="max-w-4xl mx-auto pb-20">
                    
                    <div id="score-card" class="hidden glass p-10 text-center mb-10 transform transition-all duration-500 scale-95 opacity-0">
                        <h2 class="font-heading text-3xl font-black text-slate-900 dark:text-white mb-2">Selesai! 🎉</h2>
                        <p class="text-slate-500 font-medium mb-2">Skor kamu telah otomatis tersimpan di database.</p>
                        <div class="inline-block bg-[#75cb50]/10 border-2 border-[#75cb50] rounded-3xl p-8 mt-4">
                            <p class="text-sm font-bold text-[#75cb50] tracking-widest uppercase mb-1">Total Nilai</p>
                            <p id="final-score" class="font-heading text-7xl font-black text-[#75cb50]">100</p>
                        </div>
                        <div class="mt-8 flex justify-center gap-4">
                            <a href="{{ route('student.latihansoal') }}" class="bg-slate-200 hover:bg-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-white px-6 py-3 rounded-xl font-bold transition-all">Kembali ke Menu Utama</a>
                        </div>
                    </div>

                    <form id="quiz-form">
                        @foreach($savedSoal as $index => $soal)
                        <div class="mb-8 p-8 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm" id="soal-container-{{ $index }}">
                            <div class="flex items-start gap-4 mb-6">
                                <div class="w-10 h-10 rounded-full bg-[#75cb50]/10 flex items-center justify-center text-[#75cb50] font-black flex-shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <p class="font-bold text-lg dark:text-white pt-1">{{ $soal->question }}</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pl-14">
                                @foreach($soal->options['pilihan'] as $opsiIdx => $opsi)
                                    <label class="opsi-label relative">
                                        <input type="radio" name="jawaban_{{ $index }}" value="{{ $opsi }}" class="opsi-radio hidden" required>
                                        <div class="option-card p-4 rounded-xl border-2 border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 dark:text-slate-300 font-medium transition-all h-full flex items-center">
                                            <span>{{ $opsi }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            
                            <div id="kunci_{{ $index }}" class="hidden mt-6 pl-14">
                                <div class="p-4 rounded-xl bg-amber-500/10 border border-amber-500/20">
                                    <p class="text-sm font-bold text-amber-600 dark:text-amber-400">💡 Jawaban Benar: <span class="font-normal">{{ $soal->options['jawaban_benar'] }}</span></p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="text-center mt-12" id="submit-section">
                            <button type="submit" class="bg-[#75cb50] hover:bg-[#64b043] text-white px-10 py-4 rounded-2xl font-black text-xl transition-all shadow-xl shadow-green-500/30 hover:-translate-y-1">
                                Kumpulkan Jawaban 🚀
                            </button>
                        </div>
                    </form>
                </div>
            @endif

        </main>
    </div>

    <script>
        const htmlElement = document.getElementById('main-html');
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlElement.classList.add('dark');
        } else {
            htmlElement.classList.remove('dark');
        }
    </script>

    @if($savedSoal->isNotEmpty())
    <script>
        const kuisData = @json($savedSoal);
        const form = document.getElementById('quiz-form');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault(); 
            
            let skor = 0;
            const poinPerSoal = 100 / kuisData.length; 
            const answersPayload = []; // Penampung data AJAX

            kuisData.forEach((soal, index) => {
                const selectedRadio = document.querySelector(`input[name="jawaban_${index}"]:checked`);
                const jawabanSiswa = selectedRadio ? selectedRadio.value : 'X';
                const jawabanBenar = soal.options.jawaban_benar; 
                const isCorrect = (jawabanSiswa === jawabanBenar);

                // Siapkan data untuk dikirim ke database
                answersPayload.push({
                    latihan_id: soal.latihan_id,
                    answer: jawabanSiswa, 
                    is_correct: isCorrect ? 1 : 0
                });

                document.querySelectorAll(`input[name="jawaban_${index}"]`).forEach(radio => {
                    radio.disabled = true;
                    const card = radio.nextElementSibling; 
                    card.classList.remove('bg-[rgba(117,203,80,0.15)]', 'border-[#75cb50]');

                    if (radio.value === jawabanBenar) {
                        card.classList.add('bg-emerald-500/20', 'border-emerald-500', 'text-emerald-700', 'dark:text-emerald-400');
                    } else if (radio.checked && !isCorrect) {
                        card.classList.add('bg-red-500/20', 'border-red-500', 'text-red-700', 'dark:text-red-400');
                    } else {
                        card.classList.add('opacity-40');
                    }
                });

                document.getElementById(`kunci_${index}`).classList.remove('hidden');
                if (isCorrect) skor += poinPerSoal;
            });

            // Sembunyikan tombol submit dan munculkan skor
            document.getElementById('submit-section').classList.add('hidden'); 
            const scoreCard = document.getElementById('score-card');
            scoreCard.classList.remove('hidden');
            
            setTimeout(() => {
                scoreCard.classList.remove('scale-95', 'opacity-0');
                scoreCard.classList.add('scale-100', 'opacity-100');
            }, 50);

            document.getElementById('final-score').innerText = Math.round(skor);
            window.scrollTo({ top: 0, behavior: 'smooth' });

            fetch('{{ route("student.latihansoal.submit", $materi->materi_id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ answers: answersPayload })
            })
            .then(response => response.json())
            .then(data => console.log('Sukses tersimpan di DB!', data))
            .catch(error => console.error('Error nyimpan DB:', error));
        });
    </script>
    @endif
</body>
</html>