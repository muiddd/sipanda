<div id="pomodoro-mini" onclick="maximizePomodoro()" class="fixed top-8 right-0 glass pl-3 pr-4 py-2.5 rounded-l-xl cursor-pointer hover:bg-black/5 dark:hover:bg-white/5 transition-all duration-500 transform translate-x-full z-[60] shadow-lg flex items-center gap-2 border-r-0 hidden">
    <span class="relative flex h-5 w-5 items-center justify-center">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#75cb50]/30 opacity-75"></span>
        <svg class="relative w-4 h-4 text-[#75cb50]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    </span>
    <span id="mini-timer-display" class="font-heading font-bold text-sm text-slate-900 dark:text-white tracking-wider">25:00</span>
</div>

<div id="pomodoro-popup" class="fixed top-8 right-8 w-[360px] glass p-6 z-[60] transition-all duration-500 transform translate-x-[200%] opacity-0 shadow-2xl rounded-3xl hidden">

    <div class="grid grid-cols-[100px,1fr] gap-4 items-start">

        <div class="w-full">
            <img src="{{ asset('images/panda.png') }}" alt="Panda" class="w-full h-auto object-contain scale-125 mt-2">
        </div>

        <div class="flex flex-col text-left">
            <div class="flex justify-between items-center mb-3 border-b border-black/5 dark:border-white/5 pb-2">
                <h4 class="font-bold text-sm text-slate-900 dark:text-white">Pewaktu siPanda</h4>
                <div class="flex items-center gap-1">
                    <button onclick="minimizePomodoro()" class="text-slate-400 hover:text-white p-1 rounded hover:bg-black/5 dark:hover:bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    <button onclick="closePomodoro()" class="text-slate-400 hover:text-red-500 text-lg p-1 rounded hover:bg-red-500/10">&times;</button>
                </div>
            </div>

            <div class="flex flex-col items-start">
                <div id="pomodoro-mode">
                    <span class="inline-flex items-center gap-1 bg-[#75cb50]/10 text-[#75cb50] px-2 py-0.5 rounded-full text-[9px] font-extrabold uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#75cb50] animate-pulse"></span>
                        Fokus Belajar
                    </span>
                </div>
                
                <div id="pomodoro-display" class="font-heading text-4xl font-black text-slate-900 dark:text-white tracking-widest my-1">
                    25:00
                </div>

                <div class="flex gap-2 mt-3 w-full">
                    <button id="pomodoro-start-btn" onclick="startPomodoro()" class="flex-grow bg-gradient-to-r from-[#75cb50] to-[#10b981] text-white font-bold py-2.5 rounded-xl text-sm shadow-lg hover:scale-[1.02] transition-all">
                        Mulai
                    </button>
                    <button onclick="resetPomodoro()" class="bg-black/5 dark:bg-white/5 text-slate-500 font-bold px-4 rounded-xl hover:bg-black/10 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="pomodoro-notif-modal" class="fixed inset-0 bg-slate-950/40 dark:bg-slate-950/60 backdrop-blur-sm z-[70] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 hidden">
    <div class="relative bg-white/90 dark:bg-black/60 backdrop-blur-xl border border-black/5 dark:border-white/5 w-[300px] p-6 rounded-3xl shadow-2xl text-center transform scale-90 transition-all duration-300">

        <div class="relative flex justify-center mb-4">
            <div class="absolute inset-0 bg-[#75cb50] blur-2xl opacity-20 rounded-full scale-150"></div>
            <div class="relative w-40 h-40 flex items-center justify-center">
                <img id="notif-gif" src="" alt="Notif Animasi" class="w-full h-full object-contain">
            </div>
        </div>

        <h3 id="notif-title" class="font-heading font-black text-lg text-slate-900 dark:text-white mb-2 tracking-wide"></h3>
        <p id="notif-message" class="text-xs text-slate-600 dark:text-slate-400 mb-6 leading-relaxed"></p>

        <button id="notif-btn" onclick="closeNotifModal()" class="w-full py-3 rounded-xl font-bold text-sm text-white transition-all shadow-lg hover:scale-[1.02] border border-slate-200 dark:border-white/10">
            Oke, Siap!
        </button>
    </div>
</div>

<div id="pomodoro-lock-screen" class="fixed inset-0 bg-[#f8fafc]/95 dark:bg-[#0c0d12]/95 backdrop-blur-xl z-[100] flex flex-col items-center justify-center opacity-0 pointer-events-none transition-all duration-500 hidden select-none">
    <div class="max-w-md w-full px-6 text-center flex flex-col items-center">
        <!-- Header -->
        <span class="inline-flex items-center gap-1.5 bg-blue-500/10 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest mb-4">
            <span class="w-2 h-2 rounded-full bg-blue-500 dark:bg-blue-400 animate-ping"></span>
            Mode Istirahat Terkunci
        </span>
        
        <h2 class="font-heading font-black text-2xl text-slate-900 dark:text-white mb-2 tracking-wide">Waktunya Istirahat!</h2>
        <p class="text-xs text-slate-600 dark:text-slate-400 mb-6 leading-relaxed max-w-sm">
            Web ini terkunci sementara agar Anda benar-benar beristirahat. Regangkan tubuh Anda atau mainkan game Lompat Panda ini.
        </p>

        <!-- Large Timer Display -->
        <div id="lock-timer-display" class="font-heading text-6xl font-black text-blue-600 dark:text-blue-400 tracking-widest mb-8 drop-shadow-[0_0_20px_rgba(59,130,246,0.3)]">
            05:00
        </div>

        <!-- Panda Jump Game Box -->
        <div class="glass border border-slate-200 dark:border-white/5 p-4 bg-white/60 dark:bg-white/[0.02] rounded-3xl w-full max-w-[500px]">
            <div class="flex justify-between items-center mb-3 text-slate-500 dark:text-slate-400 text-[11px] font-bold px-1">
                <span>Lompat Panda (Lompati Bambu)</span>
                <span>Skor: <span id="game-score" class="text-blue-600 dark:text-blue-400">0</span></span>
            </div>
            
            <!-- Canvas for Game -->
            <div class="relative bg-slate-200/50 dark:bg-slate-950/50 rounded-2xl overflow-hidden border border-slate-300 dark:border-white/10 w-full h-[250px] flex items-center justify-center">
                <canvas id="panda-jump-canvas" width="500" height="250" class="block w-full h-full"></canvas>
                <!-- Start/Restart overlay -->
                <div id="game-overlay" class="absolute inset-0 bg-white/90 dark:bg-black/65 flex flex-col items-center justify-center cursor-pointer">
                    <span class="text-slate-900 dark:text-white text-xs font-bold mb-1">Klik untuk Mulai Lompat!</span>
                    <span class="text-[10px] text-slate-600 dark:text-slate-400">Tekan [Spasi] atau Sentuh Layar</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const WORK_MINUTES = 1;
    const BREAK_MINUTES = 1;

    let timerInterval;
    let notifCallback = null;
    
    // Variabel Game Lompat Panda
    let canvas, ctx;
    let animationFrameId;
    let gameRunning = false;
    let score = 0;
    
    // Fisika & Objek Game
    const gravity = 0.6;
    const panda = {
        x: 50,
        y: 166, // 210 (tanah) - 44 (tinggi)
        width: 44,
        height: 44,
        vy: 0,
        jumpForce: -12,
        isGrounded: true
    };
    
    let obstacles = [];
    let obstacleTimer = 0;
    let obstacleSpeed = 4;

    // Kloning Gambar SVG Full Body Panda & Bambu
    const pandaSvg = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="44" height="44">
        <!-- Telinga -->
        <circle cx="14" cy="12" r="6" fill="#1e293b"/>
        <circle cx="34" cy="12" r="6" fill="#1e293b"/>
        
        <!-- Tubuh -->
        <ellipse cx="24" cy="32" rx="14" ry="12" fill="#ffffff" stroke="#1e293b" stroke-width="2"/>
        <!-- Bagian lengan/dada hitam -->
        <path d="M10 26c2-4 26-4 28 0 2 3-2 6-4 4s-6-1-10-1-8 0-10 1-6-1-4-4z" fill="#1e293b"/>
        <!-- Kaki belakang -->
        <circle cx="15" cy="38" r="5.5" fill="#1e293b"/>
        <circle cx="33" cy="38" r="5.5" fill="#1e293b"/>
        
        <!-- Kepala -->
        <circle cx="24" cy="19" r="11" fill="#ffffff" stroke="#1e293b" stroke-width="2"/>
        
        <!-- Kantung mata & Mata -->
        <ellipse cx="19" cy="18" rx="3" ry="4" fill="#1e293b" transform="rotate(-10, 19, 18)"/>
        <ellipse cx="29" cy="18" rx="3" ry="4" fill="#1e293b" transform="rotate(10, 29, 18)"/>
        <circle cx="19.5" cy="17.5" r="1" fill="#ffffff"/>
        <circle cx="28.5" cy="17.5" r="1" fill="#ffffff"/>
        
        <!-- Hidung/Mulut -->
        <ellipse cx="24" cy="22" rx="2" ry="1.2" fill="#1e293b"/>
    </svg>`;

    const bambooSvg = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="40">
        <path d="M12 2v20" stroke="#22c55e" stroke-width="4" stroke-linecap="round"/>
        <path d="M12 7c-2-1-4 0-5 1.5M12 13c2-1 4 0 5 1.5M12 18c-2-1-4 0-5 1.5" stroke="#16a34a" stroke-width="2" stroke-linecap="round" fill="none"/>
    </svg>`;

    const pandaImg = new Image();
    pandaImg.src = 'data:image/svg+xml;utf8,' + encodeURIComponent(pandaSvg);

    const bambooImg = new Image();
    bambooImg.src = 'data:image/svg+xml;utf8,' + encodeURIComponent(bambooSvg);

    const PANDA_GIFS = {
        workComplete: "{{ asset('images/panda-rehat.GIF') }}", // GIF pas selesai Belajar (waktunya istirahat)
        breakComplete: "{{ asset('images/panda-ambis.GIF') }}", // GIF pas selesai Istirahat (waktunya ambis lagi)
        popup: "{{ asset('images/panda-popup.GIF') }}" // Tambahan GIF untuk popup
    };

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
            
            // Check if break mode
            if (localStorage.getItem('pomodoro_mode') === 'break') {
                showLockScreen();
            }
        }
    });

    // --- FUNGSI ANIMASI SLIDE --- //

    function minimizePomodoro() {
        const popup = document.getElementById('pomodoro-popup');
        const mini = document.getElementById('pomodoro-mini');

        if (popup) {
            popup.classList.add('translate-x-[150%]', 'opacity-0', 'pointer-events-none');
            popup.classList.remove('translate-x-0', 'opacity-100');
            setTimeout(() => {
                if (popup.classList.contains('opacity-0')) {
                    popup.classList.add('hidden');
                }
            }, 500);
        }

        if (mini) {
            mini.classList.remove('hidden');
            setTimeout(() => {
                mini.classList.remove('translate-x-full', 'opacity-0', 'pointer-events-none');
                mini.classList.add('translate-x-0', 'opacity-100');
            }, 10);
        }
    }

    function maximizePomodoro() {
        const popup = document.getElementById('pomodoro-popup');
        const mini = document.getElementById('pomodoro-mini');

        if (mini) {
            mini.classList.add('translate-x-full', 'opacity-0', 'pointer-events-none');
            mini.classList.remove('translate-x-0', 'opacity-100');
            setTimeout(() => {
                if (mini.classList.contains('opacity-0')) {
                    mini.classList.add('hidden');
                }
            }, 500);
        }

        if (popup) {
            popup.classList.remove('hidden');
            setTimeout(() => {
                popup.classList.remove('translate-x-[150%]', 'translate-x-[200%]', 'opacity-0', 'pointer-events-none');
                popup.classList.add('translate-x-0', 'opacity-100');
            }, 10);
        }
    }

    function closePomodoro() {
        const popup = document.getElementById('pomodoro-popup');
        if (popup) {
            popup.classList.add('translate-x-[150%]', 'opacity-0', 'pointer-events-none');
            popup.classList.remove('translate-x-0', 'opacity-100');
            setTimeout(() => {
                if (popup.classList.contains('opacity-0')) {
                    popup.classList.add('hidden');
                }
            }, 500);
        }
    }

    // --- LOGIKA TIMER --- //

    function startPomodoro() {
        if (localStorage.getItem('pomodoro_end_time')) return;

        // const popup = document.getElementById('pomodoro-popup');
        // if (popup) {
        //     popup.classList.remove('hidden');
        //     setTimeout(() => popup.classList.remove('translate-x-[200%]', 'opacity-0'), 10);
        // }
        maximizePomodoro();

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
            if (document.getElementById('btn-start-text')) {
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
                modeText.innerHTML = `
                    <span class="inline-flex items-center gap-1 bg-[#75cb50]/10 text-[#75cb50] px-2 py-0.5 rounded-full text-[9px] font-extrabold uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#75cb50] animate-pulse"></span>
                        Fokus Belajar
                    </span>
                `;
            } else {
                modeText.innerHTML = `
                    <span class="inline-flex items-center gap-1 bg-blue-500/10 text-blue-500 px-2 py-0.5 rounded-full text-[9px] font-extrabold uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                        Waktu Istirahat
                    </span>
                `;
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

        const lockDisplay = document.getElementById('lock-timer-display');
        if (lockDisplay) lockDisplay.innerText = timeString;
    }

    function handlePhaseComplete() {
        const mode = localStorage.getItem('pomodoro_mode');

        if (mode === 'work') {
            // Popup muncul otomatis saat work selesai untuk notifikasi istirahat
            maximizePomodoro();
            showCustomNotif(
                "Fokus Selesai!",
                "Waktu fokus selesai! Lanjut istirahat 5 menit ya.",
                PANDA_GIFS.workComplete,
                "bg-gradient-to-r from-[#75cb50] to-[#10b981] shadow-[0_4px_12px_rgba(34,197,94,0.2)]",
                () => {
                    setTimerPhase('break', BREAK_MINUTES);
                    updateDisplay();
                    startTimerLogic();
                    showLockScreen();
                }
            );
        } else {
            localStorage.removeItem('pomodoro_end_time');
            localStorage.removeItem('pomodoro_mode');

            hideLockScreen();

            showCustomNotif(
                "Istirahat Selesai! ",
                "Siklus Pomodoro selesai! Data sesimu sedang disimpan.",
                PANDA_GIFS.breakComplete,
                "bg-gradient-to-r from-[#75cb50] to-[#10b981] shadow-[0_4px_12px_rgba(34,197,94,0.2)]",
                () => {
                    saveSessionToDatabase(WORK_MINUTES);
                    resetUIAfterComplete();
                }
            );
        }
    }

    function resetPomodoro() {
        clearInterval(timerInterval);
        localStorage.removeItem('pomodoro_end_time');
        localStorage.removeItem('pomodoro_mode');
        resetUIAfterComplete();
    }

    function resetUIAfterComplete() {
        // const popup = document.getElementById('pomodoro-popup');
        // const mini = document.getElementById('pomodoro-mini');

        // if (popup) {
        //     popup.classList.add('translate-x-[200%]', 'opacity-0');
        //     setTimeout(() => popup.classList.add('hidden'), 500);
        // }
        // if (mini) {
        //     mini.classList.add('translate-x-full');
        //     setTimeout(() => mini.classList.add('hidden'), 500);
        // }
        closePomodoro(); // Tutup popup
        const mini = document.getElementById('pomodoro-mini');
        if (mini) {
            mini.classList.add('translate-x-full', 'opacity-0', 'pointer-events-none');
            mini.classList.remove('translate-x-0', 'opacity-100');
            setTimeout(() => {
                if (mini.classList.contains('opacity-0')) {
                    mini.classList.add('hidden');
                }
            }, 500);
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
            if (document.getElementById('btn-start-text')) {
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
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.message || 'Error server');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showCustomNotif(
                        "Siklus Disimpan! ",
                        "Siklus Pomodoro berhasil disimpan! Halaman akan dimuat ulang untuk memperbarui statistik Anda.",
                        PANDA_GIFS.popup,
                        "bg-gradient-to-r from-[#75cb50] to-[#10b981]",
                        () => {
                            window.location.reload();
                        }
                    );
                } else {
                    showCustomNotif(
                        "Gagal Menyimpan! ",
                        "Gagal menyimpan sesi: " + data.message,
                        PANDA_GIFS.popup,
                        "bg-gradient-to-r from-red-500 to-rose-600 shadow-[0_4px_12px_rgba(244,63,94,0.2)]",
                        () => {}
                    );
                }
            })
            .catch(error => {
                console.error("Error saving session:", error);
                showCustomNotif(
                    "Gangguan Server!",
                    "Gagal menghubungi server untuk menyimpan sesi: " + error.message,
                    PANDA_GIFS.popup,
                    "bg-gradient-to-r from-amber-500 to-orange-600 shadow-[0_4px_12px_rgba(245,158,11,0.2)]",
                    () => {}
                );
            });
    }

    function showCustomNotif(title, message, gifUrl, btnClass, callback) {
        const modal = document.getElementById('pomodoro-notif-modal');
        const modalContent = modal.querySelector('div');

        document.getElementById('notif-title').innerText = title;
        document.getElementById('notif-message').innerText = message;
        document.getElementById('notif-gif').src = gifUrl;

        const btn = document.getElementById('notif-btn');
        btn.className = `w-full py-2.5 rounded-xl font-bold text-sm text-white transition-all shadow-md hover:scale-[1.02] ${btnClass}`;

        notifCallback = callback;

        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modalContent.classList.remove('scale-90');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    // --- LOCK SCREEN & PANDA JUMP GAME --- //

    function showLockScreen() {
        const lockScreen = document.getElementById('pomodoro-lock-screen');
        if (lockScreen) {
            lockScreen.classList.remove('hidden');
            setTimeout(() => {
                lockScreen.classList.remove('opacity-0', 'pointer-events-none');
            }, 10);
            initPandaJump();
        }
    }

    function hideLockScreen() {
        const lockScreen = document.getElementById('pomodoro-lock-screen');
        if (lockScreen) {
            lockScreen.classList.add('opacity-0', 'pointer-events-none');
            setTimeout(() => {
                lockScreen.classList.add('hidden');
            }, 500);
            
            // Hentikan permainan jika lock screen tertutup
            gameRunning = false;
            if (animationFrameId) cancelAnimationFrame(animationFrameId);
            document.removeEventListener('keydown', handleKeyDown);
        }
    }

    function initPandaJump() {
        canvas = document.getElementById('panda-jump-canvas');
        if (!canvas) return;
        ctx = canvas.getContext('2d');
        
        score = 0;
        document.getElementById('game-score').innerText = '0';
        
        const overlay = document.getElementById('game-overlay');
        if (overlay) {
            overlay.innerHTML = `
                <span class="text-white text-xs font-bold mb-1">Klik untuk Mulai Lompat!</span>
                <span class="text-[10px] text-slate-400">Tekan [Spasi] atau Sentuh Layar</span>
            `;
            overlay.classList.remove('hidden');
        }
        
        obstacles = [];
        panda.y = 166;
        panda.vy = 0;
        panda.isGrounded = true;
        gameRunning = false;
        
        // Setup control listeners
        canvas.removeEventListener('click', handleGameInteraction);
        canvas.addEventListener('click', handleGameInteraction);
        
        // Sembunyikan instruksi saat overlay di-klik
        overlay.removeEventListener('click', handleGameInteraction);
        overlay.addEventListener('click', handleGameInteraction);
        
        document.removeEventListener('keydown', handleKeyDown);
        document.addEventListener('keydown', handleKeyDown);
        
        drawGame();
    }

    function handleGameInteraction(e) {
        if (e) {
            e.stopPropagation();
            e.preventDefault();
        }
        if (!gameRunning) {
            startGame();
        } else {
            jump();
        }
    }

    function handleKeyDown(e) {
        if (e.code === 'Space' || e.code === 'ArrowUp') {
            e.preventDefault();
            if (!gameRunning) {
                startGame();
            } else {
                jump();
            }
        }
    }

    function startGame() {
        const overlay = document.getElementById('game-overlay');
        if (overlay) overlay.classList.add('hidden');
        
        gameRunning = true;
        score = 0;
        obstacles = [];
        obstacleSpeed = 4.5;
        obstacleTimer = 0;
        panda.y = 166;
        panda.vy = 0;
        panda.isGrounded = true;
        
        if (animationFrameId) cancelAnimationFrame(animationFrameId);
        gameLoop();
    }

    function jump() {
        if (panda.isGrounded) {
            panda.vy = panda.jumpForce;
            panda.isGrounded = false;
        }
    }

    function spawnObstacle() {
        // Spawn bamboo with random height variation matching the bigger screen
        const height = 45 + Math.random() * 20;
        const width = height * 0.6;
        obstacles.push({
            x: 500,
            y: 210 - height,
            width: width,
            height: height
        });

        // Pada skor tinggi, acak kemunculan rintangan bambu ganda (berdekatan)
        const currentScore = Math.floor(score / 5);
        if (currentScore > 50 && Math.random() < 0.45) {
            const gap = 70 + Math.random() * 50; // Jarak aman yang tetap bisa dilompati
            const height2 = 35 + Math.random() * 20;
            const width2 = height2 * 0.6;
            obstacles.push({
                x: 500 + gap,
                y: 210 - height2,
                width: width2,
                height: height2
            });
        }
    }

    function gameLoop() {
        if (!gameRunning) return;
        
        updateGame();
        drawGame();
        
        animationFrameId = requestAnimationFrame(gameLoop);
    }

    function updateGame() {
        score += 1;
        document.getElementById('game-score').innerText = Math.floor(score / 5);
        
        // Progressive difficulty: Obstacle speed increases continuously based on score
        obstacleSpeed = 4.5 + (score / 300);
        
        panda.vy += gravity;
        panda.y += panda.vy;
        
        if (panda.y >= 166) {
            panda.y = 166;
            panda.vy = 0;
            panda.isGrounded = true;
        }
        
        // Progressive difficulty: Spawn delay threshold decreases continuously as score goes up
        const spawnThreshold = Math.max(30, 85 - (score / 180));
        obstacleTimer++;
        if (obstacleTimer > spawnThreshold) {
            spawnObstacle();
            obstacleTimer = 0;
        }
        
        for (let i = obstacles.length - 1; i >= 0; i--) {
            obstacles[i].x -= obstacleSpeed;
            
            // Hitbox checks (making them slightly smaller than visual bounds for better gameplay feel)
            const pandaHitbox = {
                x: panda.x + 5,
                y: panda.y + 4,
                width: panda.width - 10,
                height: panda.height - 8
            };
            
            const obsHitbox = {
                x: obstacles[i].x + 5,
                y: obstacles[i].y + 4,
                width: obstacles[i].width - 10,
                height: obstacles[i].height - 4
            };
            
            if (
                pandaHitbox.x < obsHitbox.x + obsHitbox.width &&
                pandaHitbox.x + pandaHitbox.width > obsHitbox.x &&
                pandaHitbox.y < obsHitbox.y + obsHitbox.height &&
                pandaHitbox.y + pandaHitbox.height > obsHitbox.y
            ) {
                gameOver();
                return;
            }
            
            if (obstacles[i].x < -60) {
                obstacles.splice(i, 1);
            }
        }
    }

    function drawGame() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        // Garis Tanah (Ground Line) - Menyesuaikan tema Light/Dark Mode
        const isDark = document.documentElement.classList.contains('dark');
        ctx.strokeStyle = isDark ? 'rgba(255,255,255,0.15)' : 'rgba(15,23,42,0.15)';
        ctx.lineWidth = 3;
        ctx.beginPath();
        ctx.moveTo(0, 210);
        ctx.lineTo(500, 210);
        ctx.stroke();
        
        // Gambar Panda SVG
        try {
            ctx.drawImage(pandaImg, panda.x, panda.y, panda.width, panda.height);
        } catch (e) {
            // Fallback to emoji
            ctx.font = '32px serif';
            ctx.fillText('🐼', panda.x, panda.y);
        }
        
        // Gambar Rintangan Bambu SVG
        obstacles.forEach(obs => {
            try {
                ctx.drawImage(bambooImg, obs.x, obs.y, obs.width, obs.height);
            } catch (e) {
                // Fallback to emoji
                ctx.font = '24px serif';
                ctx.fillText('🎋', obs.x, obs.y);
            }
        });
    }

    function gameOver() {
        gameRunning = false;
        cancelAnimationFrame(animationFrameId);
        
        const overlay = document.getElementById('game-overlay');
        if (overlay) {
            overlay.innerHTML = `
                <span class="text-red-500 text-sm font-bold mb-1">Permainan Berakhir!</span>
                <span class="text-slate-900 dark:text-white text-[12px] mb-2 font-semibold">Skor Anda: ${Math.floor(score / 5)}</span>
                <span class="bg-blue-600 hover:bg-blue-700 text-white text-[11px] font-bold px-4 py-2 rounded-xl transition active:scale-95">Main Lagi</span>
            `;
            overlay.classList.remove('hidden');
        }
    }

    function closeNotifModal() {
        const modal = document.getElementById('pomodoro-notif-modal');
        const modalContent = modal.querySelector('div');

        modal.classList.add('opacity-0', 'pointer-events-none');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-90');

        setTimeout(() => {
            modal.classList.add('hidden');
            if (notifCallback) {
                notifCallback();
                notifCallback = null;
            }
        }, 300);
    }
</script>