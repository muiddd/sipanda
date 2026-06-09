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
                <h4 class="font-bold text-sm text-slate-900 dark:text-white">siPanda Timer</h4>
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
                <span class="inline-flex items-center gap-1 bg-[#75cb50]/10 text-[#75cb50] px-2 py-0.5 rounded-full text-[9px] font-extrabold uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#75cb50] animate-pulse"></span>
                    Fokus Belajar
                </span>
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

<div id="pomodoro-notif-modal" class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-[70] flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 hidden">
    <div class="relative bg-black/60 backdrop-blur-xl border border-white/5 w-[300px] p-6 rounded-3xl shadow-2xl text-center transform scale-90 transition-all duration-300">

        <div class="relative flex justify-center mb-4">
            <div class="absolute inset-0 bg-[#75cb50] blur-2xl opacity-20 rounded-full scale-150"></div>
            <div class="relative w-40 h-40 flex items-center justify-center">
                <img id="notif-gif" src="" alt="Notif Animasi" class="w-full h-full object-contain">
            </div>
        </div>

        <h3 id="notif-title" class="font-heading font-black text-lg text-white mb-2 tracking-wide"></h3>
        <p id="notif-message" class="text-xs text-slate-400 mb-6 leading-relaxed"></p>

        <button id="notif-btn" onclick="closeNotifModal()" class="w-full py-3 rounded-xl font-bold text-sm text-white transition-all shadow-lg hover:scale-[1.02] border border-white/10">
            Oke, Siap!
        </button>
    </div>
</div>

<script>
    const WORK_MINUTES = 25;
    const BREAK_MINUTES = 5;

    let timerInterval;
    let notifCallback = null;

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
    }

    function handlePhaseComplete() {
        const mode = localStorage.getItem('pomodoro_mode');

        if (mode === 'work') {
            // Popup muncul otomatis saat work selesai untuk notifikasi istirahat
            maximizePomodoro();
            // alert("Waktu fokus selesai! Lanjut istirahat 5 menit ya.");
            // setTimerPhase('break', BREAK_MINUTES);
            // startTimerLogic();
            showCustomNotif(
                "Fokus Selesai!",
                "Waktu fokus selesai! Lanjut istirahat 5 menit ya.",
                PANDA_GIFS.workComplete,
                "bg-gradient-to-r from-[#75cb50] to-[#10b981] shadow-[0_4px_12px_rgba(34,197,94,0.2)]",
                () => {
                    setTimerPhase('break', BREAK_MINUTES);
                    startTimerLogic();
                }
            );
        } else {
            localStorage.removeItem('pomodoro_end_time');
            localStorage.removeItem('pomodoro_mode');

            // alert("Siklus Pomodoro selesai! Data sesimu sedang disimpan.");
            // saveSessionToDatabase(WORK_MINUTES);
            // resetUIAfterComplete();
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