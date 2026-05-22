<!-- AI Loading Overlay -->
<div id="ai-loading-overlay" class="fixed inset-0 z-[9999] hidden flex-col items-center justify-center bg-slate-900/60 dark:bg-black/75 backdrop-blur-md transition-all duration-300">
    <style>
        @keyframes loadingProgress {
            0% { width: 5%; }
            20% { width: 35%; }
            40% { width: 55%; }
            60% { width: 75%; }
            80% { width: 88%; }
            95% { width: 95%; }
        }
        .animate-loading-progress {
            animation: loadingProgress 20s cubic-bezier(0.1, 0.8, 0.1, 1) forwards;
        }
        #loading-subtitle {
            transition: opacity 0.3s ease-in-out;
        }
    </style>
    
    <div class="glass max-w-md w-[90%] p-10 rounded-3xl border border-[#75cb50]/30 shadow-[0_20px_50px_rgba(34,197,94,0.15)] flex flex-col items-center text-center relative overflow-hidden bg-white/80 dark:bg-[#121212]/90 backdrop-blur-xl">
        <!-- Floating Glow Orbs -->
        <div class="absolute -right-16 -top-16 w-36 h-36 rounded-full bg-[#75cb50] opacity-25 blur-2xl"></div>
        <div class="absolute -left-16 -bottom-16 w-36 h-36 rounded-full bg-[#10b981] opacity-25 blur-2xl"></div>

        <!-- Animated Panda Image -->
        <div class="relative w-32 h-32 mb-8 animate-bounce" style="animation-duration: 2s;">
            <img src="{{ asset('images/logo.svg') }}" alt="siPanda Loading" class="w-full h-full object-contain dark:hidden">
            <img src="{{ asset('images/logo-white.svg') }}" alt="siPanda Loading" class="w-full h-full object-contain hidden dark:block">
            <!-- Pulsing Halo -->
            <div class="absolute inset-0 rounded-full border-4 border-dashed border-[#75cb50]/40 animate-spin" style="animation-duration: 10s;"></div>
        </div>

        <h3 id="loading-title" class="font-heading text-2xl font-black text-slate-900 dark:text-white mb-3">siPanda Sedang Bekerja...</h3>
        <p class="text-slate-500 dark:text-slate-400 text-sm mb-6 max-w-xs leading-relaxed" id="loading-subtitle">
            siPanda sedang membaca dan menganalisis materi belajarmu...
        </p>

        <!-- Progress Bar -->
        <div class="w-full bg-slate-200 dark:bg-[#2a2a2a] rounded-full h-2 overflow-hidden border border-black/5 dark:border-white/5 relative mb-2">
            <div class="bg-gradient-to-r from-[#10b981] to-[#75cb50] h-full rounded-full animate-loading-progress"></div>
        </div>

        <span class="text-[10px] uppercase font-extrabold tracking-wider text-[#75cb50] mt-3 animate-pulse">Mohon tunggu sebentar</span>
    </div>
</div>

<script>
    window.showSipandaLoader = function(customTitle = null, customSubtitles = null) {
        const overlay = document.getElementById('ai-loading-overlay');
        if (!overlay) return;

        // Set custom title if provided
        if (customTitle) {
            const titleEl = document.getElementById('loading-title');
            if (titleEl) titleEl.innerText = customTitle;
        }

        overlay.classList.remove('hidden');
        overlay.classList.add('flex');

        // Set subtitles rotating
        const subtitles = customSubtitles || [
            "siPanda sedang membaca dan menganalisis materi belajarmu...",
            "siPanda sedang mengekstrak teks penting...",
            "Menghubungi AI untuk memproses konten...",
            "Merumuskan rangkuman dan soal latihan khusus untukmu...",
            "Hampir selesai, sedang merapikan hasil..."
        ];
        
        let subIdx = 0;
        const subEl = document.getElementById('loading-subtitle');
        if (subEl && subtitles.length > 0) {
            subEl.innerText = subtitles[0];
            
            // Clear existing interval if any to prevent duplicates
            if (window.sipandaLoaderInterval) {
                clearInterval(window.sipandaLoaderInterval);
            }
            
            window.sipandaLoaderInterval = setInterval(() => {
                subEl.style.opacity = '0';
                setTimeout(() => {
                    subIdx = (subIdx + 1) % subtitles.length;
                    subEl.innerText = subtitles[subIdx];
                    subEl.style.opacity = '1';
                }, 300);
            }, 3500);
        }
    };

    window.hideSipandaLoader = function() {
        const overlay = document.getElementById('ai-loading-overlay');
        if (overlay) {
            overlay.classList.remove('flex');
            overlay.classList.add('hidden');
        }
        if (window.sipandaLoaderInterval) {
            clearInterval(window.sipandaLoaderInterval);
        }
    };
</script>
