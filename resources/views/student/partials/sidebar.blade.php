<!-- Ambient Glow Blob in Sidebar Background -->
<aside class="hidden lg:flex fixed top-0 left-0 h-screen w-72 p-6 flex-col z-50">
    <div
        class="relative glass glass-sidebar h-full flex flex-col px-4 py-6 border-l-0 overflow-hidden bg-white/70 dark:bg-[#121212]/70 backdrop-blur-3xl shadow-[0_8px_32px_0_rgba(0,0,0,0.08)] dark:shadow-[0_8px_32px_0_rgba(0,0,0,0.5)] border-r border-white/20 dark:border-white/10">

        <!-- Subtle Top Glow Decoration -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-40 h-40 bg-gradient-to-br from-[#75cb50]/20 to-[#10b981]/20 rounded-full blur-3xl pointer-events-none -z-10">
        </div>

        {{-- Logo --}}
        <div class="font-heading text-3xl font-black mb-8 flex items-center gap-3 flex-shrink-0 relative">
            <img src="{{ asset('images/logo.svg') }}" alt="siPanda Logo"
                class="h-[3rem] w-auto block dark:hidden hover:scale-105 transition duration-300" />
            <img src="{{ asset('images/logo-white.svg') }}" alt="siPanda Logo Dark"
                class="h-[3rem] w-auto hidden dark:block hover:scale-105 transition duration-300" />
        </div>

        {{-- Nav (scrollable) --}}
        <nav class="flex-1 space-y-6 overflow-y-auto pr-1 scrollbar-hide">

            <!-- Group 1: NAVIGASI UTAMA -->
            <div>
                <p
                    class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-3 px-3">
                    Menu Utama
                </p>
                <div class="space-y-1">
                    <a href="{{ route('student.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all duration-300 relative overflow-hidden group
                              {{ request()->routeIs('student.dashboard') ? 'bg-gradient-to-r from-[#75cb50] to-[#10b981] text-white font-semibold shadow-[0_4px_15px_rgba(117,203,80,0.25)]' : 'hover:translate-x-1 text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-black/[0.03] dark:hover:bg-white/[0.04] font-medium' }}">
                        <svg class="w-5 h-5 flex-shrink-0 transition-transform group-hover:scale-110" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Beranda
                    </a>

                    <a href="{{ route('student.materi') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all duration-300 group
                              {{ request()->routeIs('student.materi') ? 'bg-gradient-to-r from-[#75cb50] to-[#10b981] text-white font-semibold shadow-[0_4px_15px_rgba(117,203,80,0.25)]' : 'hover:translate-x-1 text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-black/[0.03] dark:hover:bg-white/[0.04] font-medium' }}">
                        <svg class="w-5 h-5 flex-shrink-0 transition-transform group-hover:scale-110" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Materi
                    </a>

                    <a href="{{ route('student.latihansoal') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all duration-300 group
                              {{ request()->routeIs('student.latihansoal') ? 'bg-gradient-to-r from-[#75cb50] to-[#10b981] text-white font-semibold shadow-[0_4px_15px_rgba(117,203,80,0.25)]' : 'hover:translate-x-1 text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-black/[0.03] dark:hover:bg-white/[0.04] font-medium' }}">
                        <svg class="w-5 h-5 flex-shrink-0 transition-transform group-hover:scale-110" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Latihan Soal
                    </a>

                    <a href="{{ route('student.bukucatatan') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all duration-300 group
                              {{ request()->routeIs('student.bukucatatan') ? 'bg-gradient-to-r from-[#75cb50] to-[#10b981] text-white font-semibold shadow-[0_4px_15px_rgba(117,203,80,0.25)]' : 'hover:translate-x-1 text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-black/[0.03] dark:hover:bg-white/[0.04] font-medium' }}">
                        <svg class="w-5 h-5 flex-shrink-0 transition-transform group-hover:scale-110" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Buku Catatan
                    </a>
                </div>
            </div>

            <!-- Group 2: PROGRES & MONITORING -->
            <div>
                <p
                    class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-3 px-3">
                    Progres & Aktivitas
                </p>
                <div class="space-y-1">
                    <a href="{{ route('student.riwayatskor') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all duration-300 group
                              {{ request()->routeIs('student.riwayatskor') ? 'bg-gradient-to-r from-[#75cb50] to-[#10b981] text-white font-semibold shadow-[0_4px_15px_rgba(117,203,80,0.25)]' : 'hover:translate-x-1 text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-black/[0.03] dark:hover:bg-white/[0.04] font-medium' }}">
                        <svg class="w-5 h-5 flex-shrink-0 transition-transform group-hover:scale-110" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Riwayat Skor
                    </a>

                    <a href="{{ route('student.gamifikasi') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all duration-300 group
                              {{ request()->routeIs('student.gamifikasi') ? 'bg-gradient-to-r from-[#75cb50] to-[#10b981] text-white font-semibold shadow-[0_4px_15px_rgba(117,203,80,0.25)]' : 'hover:translate-x-1 text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-black/[0.03] dark:hover:bg-white/[0.04] font-medium' }}">
                        <svg class="w-5 h-5 flex-shrink-0 transition-transform group-hover:scale-110" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                        </svg>
                        Gamifikasi
                    </a>

                    <a href="{{ route('todo') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all duration-300 group
                              {{ request()->routeIs('todo') ? 'bg-gradient-to-r from-[#75cb50] to-[#10b981] text-white font-semibold shadow-[0_4px_15px_rgba(117,203,80,0.25)]' : 'hover:translate-x-1 text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-black/[0.03] dark:hover:bg-white/[0.04] font-medium' }}">
                        <svg class="w-5 h-5 flex-shrink-0 transition-transform group-hover:scale-110" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Target Belajar
                    </a>

                    <a href="{{ route('student.activity-log.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all duration-300 group
                              {{ request()->routeIs('student.activity-log*') ? 'bg-gradient-to-r from-[#75cb50] to-[#10b981] text-white font-semibold shadow-[0_4px_15px_rgba(117,203,80,0.25)]' : 'hover:translate-x-1 text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-black/[0.03] dark:hover:bg-white/[0.04] font-medium' }}">
                        <svg class="w-5 h-5 flex-shrink-0 transition-transform group-hover:scale-110" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Riwayat Aktivitas
                    </a>
                </div>
            </div>
        </nav>

        {{-- Bottom section (fixed footer) --}}
        <div class="flex-shrink-0 mt-4 space-y-4 pt-4 border-t border-black/5 dark:border-white/10">

            {{-- Slider Theme Toggle --}}
            <div
                class="relative flex items-center bg-slate-100 dark:bg-white/5 p-1 rounded-2xl border border-black/5 dark:border-white/5">
                <button id="theme-toggle-light-btn"
                    class="flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all duration-300 z-10 text-slate-500 dark:text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Terang</span>
                </button>
                <button id="theme-toggle-dark-btn"
                    class="flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all duration-300 z-10 text-slate-500 dark:text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <span>Gelap</span>
                </button>
                <div id="theme-indicator"
                    class="absolute top-[4px] bottom-[4px] left-[4px] w-[calc(50%-4px)] bg-white dark:bg-white/10 rounded-xl shadow-md border border-black/5 dark:border-white/5 transition-all duration-300 pointer-events-none">
                </div>
            </div>

            {{-- User Card Profile --}}
            <div
                class="p-2.5 rounded-2xl bg-slate-50 dark:bg-white/5 border border-black/5 dark:border-white/5 flex items-center gap-2.5 transition hover:shadow-lg hover:border-[#75cb50]/20 duration-300">
                <div class="relative group flex-shrink-0">
                    <div
                        class="absolute -inset-0.5 bg-gradient-to-tr from-[#75cb50] to-[#10b981] rounded-full opacity-60 group-hover:opacity-100 transition duration-300 blur-sm">
                    </div>
                    <div
                        class="relative w-9 h-9 rounded-full bg-slate-900 dark:bg-white flex items-center justify-center font-bold text-white dark:text-slate-900 font-heading text-base">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
                <div class="overflow-hidden flex-1 min-w-0">
                    <div class="font-bold text-sm text-slate-800 dark:text-white truncate leading-tight">
                        {{ auth()->user()->name }}</div>
                    <div class="text-[10px] text-slate-400 dark:text-slate-500 truncate mt-0.5">
                        {{ auth()->user()->email }}</div>
                </div>
                <a href="{{ route('student.settings') }}"
                    class="flex-shrink-0 text-slate-400 hover:text-[#75cb50] dark:hover:text-[#75cb50] p-1 rounded-lg hover:bg-black/5 dark:hover:bg-white/10 transition duration-300 group">
                    <svg class="w-5 h-5 transition-transform duration-700 group-hover:rotate-180" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </a>
            </div>
        </div>

    </div>
</aside>

<!-- Mobile Top Navigation Header -->
<header
    class="lg:hidden fixed top-0 left-0 right-0 h-16 bg-white/75 dark:bg-[#121212]/75 backdrop-blur-2xl border-b border-black/5 dark:border-white/10 z-40 px-6 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <img src="{{ asset('images/logo.svg') }}" alt="siPanda Logo" class="h-8 w-auto block dark:hidden" />
        <img src="{{ asset('images/logo-white.svg') }}" alt="siPanda Logo Dark" class="h-8 w-auto hidden dark:block" />
    </div>

    <div class="flex items-center gap-2">
        <!-- Hamburger Menu Button -->
        <button id="menu-toggle-mobile"
            class="p-2.5 text-slate-700 dark:text-white hover:bg-black/5 dark:hover:bg-white/5 rounded-xl transition focus:outline-none z-50">
            <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path id="menu-toggle-mobile-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>
</header>

<!-- Mobile Floating Menu Dropdown -->
<div id="mobile-menu-dropdown"
    class="fixed top-[72px] left-6 right-6 lg:hidden bg-white/95 dark:bg-[#121212]/95 backdrop-blur-3xl border border-black/5 dark:border-white/10 rounded-3xl p-6 shadow-2xl z-[150] transform scale-95 opacity-0 pointer-events-none transition-all duration-300 origin-top flex flex-col gap-6">
    <nav class="flex flex-col gap-2 text-center text-base font-bold">
        <a href="{{ route('student.dashboard') }}"
            class="py-3 rounded-xl transition-all {{ request()->routeIs('student.dashboard') ? 'bg-[#75cb50]/15 text-[#75cb50]' : 'text-slate-800 dark:text-slate-300 hover:text-[#75cb50] hover:bg-black/5 dark:hover:bg-white/5' }}">
            Beranda
        </a>
        <a href="{{ route('student.materi') }}"
            class="py-3 rounded-xl transition-all {{ request()->routeIs('student.materi') ? 'bg-[#75cb50]/15 text-[#75cb50]' : 'text-slate-800 dark:text-slate-300 hover:text-[#75cb50] hover:bg-black/5 dark:hover:bg-white/5' }}">
            Materi
        </a>
        <a href="{{ route('student.latihansoal') }}"
            class="py-3 rounded-xl transition-all {{ request()->routeIs('student.latihansoal') ? 'bg-[#75cb50]/15 text-[#75cb50]' : 'text-slate-800 dark:text-slate-300 hover:text-[#75cb50] hover:bg-black/5 dark:hover:bg-white/5' }}">
            Latihan Soal
        </a>
        <a href="{{ route('student.bukucatatan') }}"
            class="py-3 rounded-xl transition-all {{ request()->routeIs('student.bukucatatan') ? 'bg-[#75cb50]/15 text-[#75cb50]' : 'text-slate-800 dark:text-slate-300 hover:text-[#75cb50] hover:bg-black/5 dark:hover:bg-white/5' }}">
            Buku Catatan
        </a>
        <a href="{{ route('student.riwayatskor') }}"
            class="py-3 rounded-xl transition-all {{ request()->routeIs('student.riwayatskor') ? 'bg-[#75cb50]/15 text-[#75cb50]' : 'text-slate-800 dark:text-slate-300 hover:text-[#75cb50] hover:bg-black/5 dark:hover:bg-white/5' }}">
            Riwayat Skor
        </a>
        <a href="{{ route('student.gamifikasi') }}"
            class="py-3 rounded-xl transition-all {{ request()->routeIs('student.gamifikasi') ? 'bg-[#75cb50]/15 text-[#75cb50]' : 'text-slate-800 dark:text-slate-300 hover:text-[#75cb50] hover:bg-black/5 dark:hover:bg-white/5' }}">
            Gamifikasi
        </a>
        <a href="{{ route('todo') }}"
            class="py-3 rounded-xl transition-all {{ request()->routeIs('todo') ? 'bg-[#75cb50]/15 text-[#75cb50]' : 'text-slate-800 dark:text-slate-300 hover:text-[#75cb50] hover:bg-black/5 dark:hover:bg-white/5' }}">
            Target Belajar
        </a>
        <a href="{{ route('student.activity-log.index') }}"
            class="py-3 rounded-xl transition-all {{ request()->routeIs('student.activity-log*') ? 'bg-[#75cb50]/15 text-[#75cb50]' : 'text-slate-800 dark:text-slate-300 hover:text-[#75cb50] hover:bg-black/5 dark:hover:bg-white/5' }}">
            Riwayat Aktivitas
        </a>
    </nav>

    <div class="h-px bg-black/5 dark:bg-white/10 w-full"></div>

    <!-- Mobile User Profile, Theme Switcher & Actions -->
    <div class="flex flex-col gap-4 text-center">
        <!-- Mobile Slider Theme Toggle -->
        <div
            class="relative flex items-center bg-slate-100 dark:bg-white/5 p-1 rounded-2xl border border-black/5 dark:border-white/5">
            <button id="theme-toggle-light-mobile"
                class="flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all duration-300 z-10 text-slate-500 dark:text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Terang</span>
            </button>
            <button id="theme-toggle-dark-mobile"
                class="flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all duration-300 z-10 text-slate-500 dark:text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <span>Gelap</span>
            </button>
            <div id="theme-indicator-mobile"
                class="absolute top-[4px] bottom-[4px] left-[4px] w-[calc(50%-4px)] bg-white dark:bg-white/10 rounded-xl shadow-md border border-black/5 dark:border-white/5 transition-all duration-300 pointer-events-none">
            </div>
        </div>

        <div class="flex items-center gap-3 bg-black/5 dark:bg-white/5 p-3 rounded-2xl">
            <div
                class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#75cb50] to-[#10b981] flex items-center justify-center font-bold text-white font-heading text-lg shadow-[0_0_15px_rgba(34,197,94,0.4)] flex-shrink-0">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden flex-1 min-w-0 text-left">
                <div class="font-bold text-sm text-slate-900 dark:text-white truncate">{{ auth()->user()->name }}</div>
                <div class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</div>
            </div>
            <a href="{{ route('student.settings') }}" class="flex-shrink-0 text-slate-500 dark:text-slate-400 hover:text-[#75cb50] dark:hover:text-[#75cb50] hover:bg-black/5 dark:hover:bg-white/10 p-2 rounded-lg transition
                      {{ request()->routeIs('student.settings') ? 'text-[#75cb50] dark:text-[#75cb50]' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </a>
        </div>

        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
            class="w-full text-center border border-red-500/20 text-red-500 hover:bg-red-500/5 px-6 py-3 rounded-2xl font-bold transition text-sm flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Logout
        </a>
        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>

<style>
    /* Hide scrollbar but keep scrolling functionality */
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>

<script>
    (function () {
        const initTheme = () => {
            const htmlElement = document.getElementById('main-html') || document.documentElement;

            const applyTheme = (isDark) => {
                const indicatorDesktop = document.getElementById('theme-indicator');
                const btnLightDesktop = document.getElementById('theme-toggle-light-btn');
                const btnDarkDesktop = document.getElementById('theme-toggle-dark-btn');

                const indicatorMobile = document.getElementById('theme-indicator-mobile');
                const btnLightMobile = document.getElementById('theme-toggle-light-mobile');
                const btnDarkMobile = document.getElementById('theme-toggle-dark-mobile');

                if (isDark) {
                    htmlElement.classList.add('dark');

                    if (indicatorDesktop) {
                        indicatorDesktop.style.transform = 'translateX(100%)';
                        indicatorDesktop.style.left = '-2px';
                    }
                    if (btnLightDesktop) btnLightDesktop.className = 'flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all duration-300 z-10 text-slate-500 dark:text-slate-400';
                    if (btnDarkDesktop) btnDarkDesktop.className = 'flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-extrabold transition-all duration-300 z-10 text-slate-900 dark:text-white';

                    if (indicatorMobile) {
                        indicatorMobile.style.transform = 'translateX(100%)';
                        indicatorMobile.style.left = '-2px';
                    }
                    if (btnLightMobile) btnLightMobile.className = 'flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all duration-300 z-10 text-slate-500 dark:text-slate-400';
                    if (btnDarkMobile) btnDarkMobile.className = 'flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-extrabold transition-all duration-300 z-10 text-slate-900 dark:text-white';
                } else {
                    htmlElement.classList.remove('dark');

                    if (indicatorDesktop) {
                        indicatorDesktop.style.transform = 'translateX(0)';
                        indicatorDesktop.style.left = '4px';
                    }
                    if (btnLightDesktop) btnLightDesktop.className = 'flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-extrabold transition-all duration-300 z-10 text-slate-900 dark:text-slate-800';
                    if (btnDarkDesktop) btnDarkDesktop.className = 'flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all duration-300 z-10 text-slate-500 dark:text-slate-400';

                    if (indicatorMobile) {
                        indicatorMobile.style.transform = 'translateX(0)';
                        indicatorMobile.style.left = '4px';
                    }
                    if (btnLightMobile) btnLightMobile.className = 'flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-extrabold transition-all duration-300 z-10 text-slate-900 dark:text-slate-800';
                    if (btnDarkMobile) btnDarkMobile.className = 'flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all duration-300 z-10 text-slate-500 dark:text-slate-400';
                }
            };

            const isDarkTheme = localStorage.getItem('color-theme') === 'dark' ||
                (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

            applyTheme(isDarkTheme);

            const setLightTheme = () => {
                localStorage.setItem('color-theme', 'light');
                applyTheme(false);
            };

            const setDarkTheme = () => {
                localStorage.setItem('color-theme', 'dark');
                applyTheme(true);
            };

            const lightBtnD = document.getElementById('theme-toggle-light-btn');
            const darkBtnD = document.getElementById('theme-toggle-dark-btn');
            const lightBtnM = document.getElementById('theme-toggle-light-mobile');
            const darkBtnM = document.getElementById('theme-toggle-dark-mobile');

            if (lightBtnD) {
                lightBtnD.replaceWith(lightBtnD.cloneNode(true));
                document.getElementById('theme-toggle-light-btn').addEventListener('click', setLightTheme);
            }
            if (darkBtnD) {
                darkBtnD.replaceWith(darkBtnD.cloneNode(true));
                document.getElementById('theme-toggle-dark-btn').addEventListener('click', setDarkTheme);
            }
            if (lightBtnM) {
                lightBtnM.replaceWith(lightBtnM.cloneNode(true));
                document.getElementById('theme-toggle-light-mobile').addEventListener('click', setLightTheme);
            }
            if (darkBtnM) {
                darkBtnM.replaceWith(darkBtnM.cloneNode(true));
                document.getElementById('theme-toggle-dark-mobile').addEventListener('click', setDarkTheme);
            }
        };

        const initMobileMenu = () => {
            const menuToggleMobile = document.getElementById('menu-toggle-mobile');
            const mobileMenuDropdown = document.getElementById('mobile-menu-dropdown');
            const menuToggleMobileIcon = document.getElementById('menu-toggle-mobile-icon');

            if (menuToggleMobile && mobileMenuDropdown) {
                menuToggleMobile.replaceWith(menuToggleMobile.cloneNode(true));
                const newMenuToggle = document.getElementById('menu-toggle-mobile');
                const newIcon = document.getElementById('menu-toggle-mobile-icon');

                newMenuToggle.addEventListener('click', () => {
                    const isOpen = mobileMenuDropdown.classList.contains('opacity-100');
                    if (isOpen) {
                        mobileMenuDropdown.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                        mobileMenuDropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                        newIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
                    } else {
                        mobileMenuDropdown.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                        mobileMenuDropdown.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
                        newIcon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
                    }
                });

                // Close dropdown when clicking any link
                const mobileLinks = mobileMenuDropdown.querySelectorAll('nav a, div a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenuDropdown.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                        mobileMenuDropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                        newIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
                    });
                });
            }
        };

        const init = () => {
            initTheme();
            initMobileMenu();
        };

        init();
        document.addEventListener('DOMContentLoaded', init);
    })();
</script>

<script>
    window.autoLogActivity = function (subject, topic, startTime, endTime, focusScore = 0) {
        // Ambil token keamanan Laravel agar tidak diblokir
        const csrfToken = document.querySelector('meta[name="csrf-token"]');

        if (!csrfToken) {
            console.error('CSRF Token tidak ditemukan! Pastikan ada <meta name="csrf-token" content="{{ csrf_token() }}"> di tag <head>');
            return;
        }

        fetch("{{ route('student.log-session.auto') }}", {
            method: 'POST',
            keepalive: true,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                subject: subject,
                topic: topic,
                started_at: startTime,
                ended_at: endTime,
                focus_score: focusScore
            })
        })
            .then(response => response.json())
            .then(data => console.log('✅ Sesi Belajar terekam otomatis:', data))
            .catch(error => console.error('❌ Gagal merekam sesi:', error));
    }
</script>