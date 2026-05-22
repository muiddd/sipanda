<div id="pomodoro-mini" onclick="maximizePomodoro()" class="fixed top-8 right-0 glass pl-3 pr-4 py-2.5 rounded-l-xl cursor-pointer hover:bg-black/5 dark:hover:bg-white/5 transition-all duration-500 transform translate-x-full z-[60] shadow-lg flex items-center gap-2 border-r-0 hidden">
    <span class="animate-pulse drop-shadow-md">🐼</span>
    <span id="mini-timer-display" class="font-heading font-bold text-sm text-slate-900 dark:text-white tracking-wider">25:00</span>
</div>

<div id="pomodoro-popup" class="fixed top-8 right-8 w-[280px] glass p-6 z-[60] transition-all duration-500 transform translate-x-[200%] opacity-0 shadow-[0_15px_40px_rgba(0,0,0,0.15)] dark:shadow-[0_15px_40px_rgba(0,0,0,0.5)] hidden">
    
    <div class="flex justify-between items-center mb-4 border-b border-black/5 dark:border-white/5 pb-3">
        <h4 class="font-bold text-sm text-slate-900 dark:text-white flex items-center gap-2">
            <span>🐼</span> <span class="font-heading tracking-wide">siPanda Timer</span>
        </h4>
        <div class="flex items-center gap-2">
            <button onclick="minimizePomodoro()" class="text-slate-400 hover:text-slate-800 dark:hover:text-white transition-colors p-1 rounded hover:bg-black/5 dark:hover:bg-white/5" title="Sembunyikan ke samping">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
            </button>
            <button onclick="closePomodoro()" class="text-slate-400 hover:text-red-500 transition-colors text-xl leading-none p-1 rounded hover:bg-red-500/10" title="Tutup Timer">
                &times;
            </button>
        </div>
    </div>
    
    <div class="text-center mt-2">
        <span id="pomodoro-mode" class="text-[10px] uppercase font-extrabold tracking-wider text-[#75cb50] block mb-1">
            🔥 Fokus Belajar
        </span>
        
        <div id="pomodoro-display" class="font-heading text-5xl font-black text-slate-900 dark:text-white tracking-widest my-3">
            25:00
        </div>
        
        <div class="flex justify-center gap-3 mt-5">
            <button id="pomodoro-start-btn" onclick="startPomodoro()" class="flex-1 bg-gradient-to-r from-[#75cb50] to-[#10b981] hover:from-[#10b981] hover:to-[#059669] text-white font-bold py-2.5 px-4 rounded-xl shadow-[0_0_15px_rgba(34,197,94,0.3)] transition-all hover:scale-[1.02] text-sm flex items-center justify-center gap-1.5">
                Mulai
            </button>
            <button onclick="resetPomodoro()" class="px-4 py-2.5 bg-black/5 dark:bg-white/5 text-slate-600 dark:text-slate-300 font-bold rounded-xl hover:bg-black/10 dark:hover:bg-white/10 transition flex items-center justify-center" title="Reset Sesi">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            </button>
        </div>
    </div>
</div>

<script>
    const WORK_MINUTES = 25;
    const BREAK_MINUTES = 5;
    
    let timerInterval;

    document.addEventListener("DOMContentLoaded", () => {
        updateDisplay();
        
        // UX Cerdas: Jika refresh halaman saat timer masih jalan, 
        // munculkan dalam mode Mini Tab saja agar tidak menghalangi layar
        if (localStorage.getItem('pomodoro_end_time')) {
            const mini = document.getElementById('pomodoro-mini');
            if (mini) {
                mini.classList.remove('hidden');
                setTimeout(() => mini.classList.remove('translate-x-full'), 10);
            }
            startTimerLogic();
        }
    });

    // --- FUNGSI ANIMASI SLIDE --- //
    
    function minimizePomodoro() {
        const popup = document.getElementById('pomodoro-popup');
        const mini = document.getElementById('pomodoro-mini');
        
        if (popup) {
            // Geser keluar layar
            popup.classList.add('translate-x-[200%]', 'opacity-0');
            setTimeout(() => popup.classList.add('hidden'), 500); 
        }
        
        if (mini) {
            // Munculkan tab kecil
            mini.classList.remove('hidden');
            setTimeout(() => mini.classList.remove('translate-x-full'), 100);
        }
    }

    function maximizePomodoro() {
        const popup = document.getElementById('pomodoro-popup');
        const mini = document.getElementById('pomodoro-mini');
        
        if (mini) {
            // Sembunyikan tab kecil
            mini.classList.add('translate-x-full');
            setTimeout(() => mini.classList.add('hidden'), 500);
        }
        
        if (popup) {
            // Munculkan popup utama
            popup.classList.remove('hidden');
            setTimeout(() => popup.classList.remove('translate-x-[200%]', 'opacity-0'), 10);
        }
    }

    function closePomodoro() {
        const popup = document.getElementById('pomodoro-popup');
        if (popup) {
            popup.classList.add('translate-x-[200%]', 'opacity-0');
            setTimeout(() => popup.classList.add('hidden'), 500);
        }
    }

    // --- LOGIKA TIMER --- //

    function startPomodoro() {
        if (localStorage.getItem('pomodoro_end_time')) return; 
        
        const popup = document.getElementById('pomodoro-popup');
        if (popup) {
            popup.classList.remove('hidden');
            setTimeout(() => popup.classList.remove('translate-x-[200%]', 'opacity-0'), 10);
        }
        
        setTimerPhase('work', WORK_MINUTES);
        startTimerLogic();
    }

    function setTimerPhase(mode, minutes) {
        const endTime = new Date().getTime() + minutes * 60000;
        localStorage.setItem('pomodoro_end_time', endTime);
        localStorage.setItem('pomodoro_mode', mode);
    }

    function startTimerLogic() {
        const startBtnPopup = document.getElementById('pomodoro-start-btn');
        if (startBtnPopup) {
            startBtnPopup.disabled = true;
            startBtnPopup.classList.add('opacity-50', 'cursor-not-allowed');
            startBtnPopup.innerText = 'Berjalan...';
        }

        const startBtnCard = document.getElementById('card-pomodoro-start-btn');
        if (startBtnCard) {
            startBtnCard.disabled = true;
            startBtnCard.classList.add('opacity-50', 'cursor-not-allowed');
            if(document.getElementById('btn-start-text')) {
                document.getElementById('btn-start-text').innerText = 'Berjalan...';
            }
        }

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
        if (modeText) {
            if (mode === 'work') {
                modeText.innerText = '🔥 Fokus Belajar';
                modeText.className = 'text-[10px] uppercase font-extrabold tracking-wider text-[#75cb50] block mb-1';
            } else {
                modeText.innerText = '☕ Waktu Istirahat';
                modeText.className = 'text-[10px] uppercase font-extrabold tracking-wider text-blue-500 block mb-1';
            }
        }

        if (distance !== null) {
            minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            seconds = Math.floor((distance % (1000 * 60)) / 1000);
        } else {
            minutes = mode === 'work' ? WORK_MINUTES : BREAK_MINUTES;
            seconds = 0;
        }

        const timeString = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        // Update semua angka timer yang ada
        const popupDisplay = document.getElementById('pomodoro-display');
        if (popupDisplay) popupDisplay.innerText = timeString;

        const cardDisplay = document.getElementById('card-pomodoro-display');
        if (cardDisplay) cardDisplay.innerText = timeString;

        const miniDisplay = document.getElementById('mini-timer-display');
        if (miniDisplay) miniDisplay.innerText = timeString;
    }

    function handlePhaseComplete() {
        const mode = localStorage.getItem('pomodoro_mode');
        
        if (mode === 'work') {
            // Popup muncul otomatis saat work selesai untuk notifikasi istirahat
            maximizePomodoro(); 
            alert("Waktu fokus selesai! Lanjut istirahat 5 menit ya.");
            setTimerPhase('break', BREAK_MINUTES);
            startTimerLogic();
        } else {
            localStorage.removeItem('pomodoro_end_time');
            localStorage.removeItem('pomodoro_mode');
            
            alert("Siklus Pomodoro selesai! Data sesimu sedang disimpan.");
            saveSessionToDatabase(WORK_MINUTES);
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
        const popup = document.getElementById('pomodoro-popup');
        const mini = document.getElementById('pomodoro-mini');
        
        if (popup) {
            popup.classList.add('translate-x-[200%]', 'opacity-0');
            setTimeout(() => popup.classList.add('hidden'), 500);
        }
        if (mini) {
            mini.classList.add('translate-x-full');
            setTimeout(() => mini.classList.add('hidden'), 500);
        }

        const startBtnPopup = document.getElementById('pomodoro-start-btn');
        if (startBtnPopup) {
            startBtnPopup.disabled = false;
            startBtnPopup.classList.remove('opacity-50', 'cursor-not-allowed');
            startBtnPopup.innerText = 'Mulai';
        }

        const startBtnCard = document.getElementById('card-pomodoro-start-btn');
        if (startBtnCard) {
            startBtnCard.disabled = false;
            startBtnCard.classList.remove('opacity-50', 'cursor-not-allowed');
            if(document.getElementById('btn-start-text')) {
                document.getElementById('btn-start-text').innerText = 'Start';
            }
        }

        updateDisplay();
    }

    function saveSessionToDatabase(learningDurationMinutes) {
        const metaTag = document.querySelector('meta[name="csrf-token"]');
        if (!metaTag) return;

        fetch("{{ route('pomodoro.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": metaTag.getAttribute('content'),
                "Accept": "application/json"
            },
            body: JSON.stringify({
                duration: learningDurationMinutes
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                console.log(data.message);
                // Biarkan user yang merefresh manual agar tidak mengganggu aktivitas 
            }
        })
        .catch(error => console.error("Error saving session:", error));
    }
</script>