<div id="pomodoro-popup" class="fixed bottom-5 right-5 w-72 bg-gray-900 text-white p-4 rounded-xl shadow-lg border border-gray-700 z-50 transition-all duration-300">
    <div class="flex justify-between items-center mb-2">
        <h4 class="font-bold text-sm">🍅 Pomodoro siPanda</h4>
        <button onclick="togglePomodoro()" class="text-gray-400 hover:text-white text-lg leading-none">&times;</button>
    </div>
    
    <div class="text-center">
        <span id="pomodoro-mode" class="text-xs text-green-400 font-bold uppercase tracking-wider block mb-1">Fokus Belajar</span>
        <div id="pomodoro-display" class="text-5xl font-extrabold my-3 font-mono tracking-tight">25:00</div>
        
        <div class="flex justify-center gap-2 mt-4">
            <button id="pomodoro-start-btn" onclick="startPomodoro()" class="bg-green-500 hover:bg-green-600 px-5 py-2 rounded-lg text-sm font-bold w-full transition-colors">Mulai</button>
            <button onclick="resetPomodoro()" class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg text-sm transition-colors">🔄</button>
        </div>
    </div>
</div>
<script>
    const WORK_MINUTES = 25;
    const BREAK_MINUTES = 5;
    
    let timerInterval;

    document.addEventListener("DOMContentLoaded", () => {
        updateDisplay();
        // Jika halaman di-refresh dan timer sedang berjalan, lanjutkan
        if (localStorage.getItem('pomodoro_end_time')) {
            startTimerLogic();
        }
    });

    function togglePomodoro() {
        const popup = document.getElementById('pomodoro-popup');
        popup.classList.toggle('hidden');
    }

    function startPomodoro() {
        if (localStorage.getItem('pomodoro_end_time')) return; 
        
        // Mulai dari mode 'work'
        setTimerPhase('work', WORK_MINUTES);
        startTimerLogic();
    }

    function setTimerPhase(mode, minutes) {
        const endTime = new Date().getTime() + minutes * 60000;
        localStorage.setItem('pomodoro_end_time', endTime);
        localStorage.setItem('pomodoro_mode', mode);
    }

    function startTimerLogic() {
        const startBtn = document.getElementById('pomodoro-start-btn');
        startBtn.disabled = true;
        startBtn.classList.add('opacity-50', 'cursor-not-allowed');
        startBtn.innerText = 'Berjalan...';

        timerInterval = setInterval(() => {
            const now = new Date().getTime();
            const endTime = parseInt(localStorage.getItem('pomodoro_end_time'));
            const distance = endTime - now;

            if (distance <= 0) {
                clearInterval(timerInterval);
                handlePhaseComplete();
            } else {
                updateDisplay(distance);
            }
        }, 1000);
    }

    function updateDisplay(distance = null) {
        let minutes, seconds;
        const mode = localStorage.getItem('pomodoro_mode') || 'work';
        
        const modeText = document.getElementById('pomodoro-mode');
        if (mode === 'work') {
            modeText.innerText = '🔥 Fokus Belajar';
            modeText.className = 'text-xs text-green-400 font-bold uppercase tracking-wider block mb-1';
        } else {
            modeText.innerText = '☕ Waktu Istirahat';
            modeText.className = 'text-xs text-blue-400 font-bold uppercase tracking-wider block mb-1';
        }

        if (distance !== null) {
            minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            seconds = Math.floor((distance % (1000 * 60)) / 1000);
        } else {
            minutes = mode === 'work' ? WORK_MINUTES : BREAK_MINUTES;
            seconds = 0;
        }

        document.getElementById('pomodoro-display').innerText = 
            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }

    function handlePhaseComplete() {
        const mode = localStorage.getItem('pomodoro_mode');
        
        if (mode === 'work') {
            // Fase kerja habis (25 menit), otomatis masuk fase istirahat (5 menit)
            alert("Waktu fokus selesai! Lanjut istirahat 5 menit ya.");
            setTimerPhase('break', BREAK_MINUTES);
            startTimerLogic();
        } else {
            // Fase istirahat habis (5 menit), total siklus 30 menit selesai
            localStorage.removeItem('pomodoro_end_time');
            localStorage.removeItem('pomodoro_mode');
            
            alert("Siklus Pomodoro selesai! Data sesimu sedang disimpan.");
            saveSessionToDatabase(WORK_MINUTES); // Kirim 25 sebagai durasi belajar riil
            
            resetUIAfterComplete();
        }
    }

    function resetPomodoro() {
        clearInterval(timerInterval);
        localStorage.removeItem('pomodoro_end_time');
        localStorage.removeItem('pomodoro_mode');
        resetUIAfterComplete();
    }

    function resetUIAfterComplete() {
        const startBtn = document.getElementById('pomodoro-start-btn');
        startBtn.disabled = false;
        startBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        startBtn.innerText = 'Mulai';
        updateDisplay();
    }

    function saveSessionToDatabase(learningDurationMinutes) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("{{ route('pomodoro.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
                "Accept": "application/json"
            },
            body: JSON.stringify({
                duration: learningDurationMinutes,
                // materi_id: null // Isi dengan variabel JS jika halaman ini sedang membuka materi tertentu
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                console.log(data.message);
                // Opsional: Reload window jika ingin dashboard/grafik langsung update
                // window.location.reload(); 
            }
        })
        .catch(error => console.error("Error saving session:", error));
    }
</script>