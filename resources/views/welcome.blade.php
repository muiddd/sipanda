<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>siPanda - Digital Bamboo Forest</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|outfit:400,500,600,700,800,900" rel="stylesheet" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        
        <!-- Tailwind CSS Fallback for rapid UI styling -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                            heading: ['Outfit', 'sans-serif'],
                        },
                        colors: {
                            panda: {
                                black: '#121212',
                                gray: '#2a2a2a',
                                white: '#ffffff'
                            },
                            bamboo: {
                                fresh: '#75cb50',       /* Main brand green */
                                emerald: '#10b970',     /* Secondary green */
                                light: '#dcfce7',       /* Light glowing green */
                            },
                            cream: '#f2f1e8',
                        },
                        animation: {
                            'float-slow': 'float 8s ease-in-out infinite',
                            'float-medium': 'float 6s ease-in-out infinite',
                            'float-fast': 'float 4s ease-in-out infinite',
                            'leaf-fall': 'fall 15s linear infinite',
                            'pulse-glow': 'pulseGlow 3s ease-in-out infinite',
                        },
                        keyframes: {
                            float: {
                                '0%, 100%': { transform: 'translateY(0) rotate(-1deg)' },
                                '50%': { transform: 'translateY(-20px) rotate(2deg)' },
                            },
                            fall: {
                                '0%': { transform: 'translateY(-10vh) rotate(0deg) translateX(0)' },
                                '50%': { transform: 'translateY(50vh) rotate(180deg) translateX(50px)' },
                                '100%': { transform: 'translateY(110vh) rotate(360deg) translateX(-50px)' },
                            },
                            pulseGlow: {
                                '0%, 100%': { opacity: 1, filter: 'drop-shadow(0 0 10px rgba(34,197,94,0.6))' },
                                '50%': { opacity: 0.8, filter: 'drop-shadow(0 0 20px rgba(34,197,94,0.9))' },
                            }
                        }
                    }
                }
            }
        </script>

        <style>
            /* Glassmorphism Classes */
            .glass-panel {
                background: rgba(255, 255, 255, 0.35);
                backdrop-filter: blur(40px);
                -webkit-backdrop-filter: blur(40px);
                border: 1px solid rgba(255, 255, 255, 0.9);
                box-shadow: 0 30px 60px rgba(0, 0, 0, 0.05), inset 0 0 0 1px rgba(255, 255, 255, 0.5);
            }
            .dark .glass-panel {
                background: rgba(18, 18, 18, 0.7);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 20px 40px rgba(0,0,0,0.5), inset 0 2px 0 rgba(255,255,255,0.05);
            }
            .holo-glow {
                background: rgba(34, 197, 94, 0.05);
                backdrop-filter: blur(12px);
                box-shadow: 0 0 30px rgba(34, 197, 94, 0.5), inset 0 0 20px rgba(34, 197, 94, 0.3);
                border: 1px solid rgba(0, 123, 45, 0.8);
            }
        </style>
    </head>
    <body class="antialiased min-h-screen text-slate-800 dark:text-cream bg-f3f4f6 dark:bg-panda-black font-sans relative overflow-x-hidden flex flex-col selection:bg-bamboo-fresh selection:text-white transition-colors duration-300">
        
        <!-- Soft-focus 3D bamboo leaves and stalks Floating Ambient Background -->
        <div class="fixed top-0 bottom-0 left-[8%] w-8 bg-gradient-to-r from-bamboo-light/40 to-bamboo-fresh/10 blur-[12px] z-[-1] pointer-events-none rounded-full"></div>
        <div class="fixed top-0 bottom-0 right-[25%] w-12 bg-gradient-to-l from-bamboo-light/30 to-bamboo-emerald/10 blur-[15px] z-[-1] animate-pulse pointer-events-none rounded-full"></div>
        <div class="fixed top-[20%] left-[60%] w-6 bg-gradient-to-r from-bamboo-fresh/15 to-transparent blur-[8px] transform rotate-[35deg] z-[-1] h-[150vh] -translate-y-[50%] pointer-events-none rounded-full"></div>
        
        <!-- Floating Bamboo Leaves -->
        <div class="fixed top-[-10vh] left-[15vw] text-bamboo-fresh/40 text-7xl blur-[3px] animate-leaf-fall pointer-events-none z-[-1]" style="animation-duration: 22s;">🍃</div>
        <div class="fixed top-[-10vh] left-[45vw] text-bamboo-emerald/30 text-5xl blur-[5px] animate-leaf-fall pointer-events-none z-[-1]" style="animation-duration: 18s; animation-delay: 5s;">🍃</div>
        <div class="fixed top-[-10vh] left-[75vw] text-bamboo-fresh/20 text-8xl blur-[4px] animate-leaf-fall pointer-events-none z-[-1]" style="animation-duration: 26s; animation-delay: 2s;">🍃</div>
        <div class="fixed top-[-10vh] left-[90vw] text-bamboo-emerald/40 text-4xl blur-[2px] animate-leaf-fall pointer-events-none z-[-1]" style="animation-duration: 15s; animation-delay: 8s;">🍃</div>

        <!-- Sleek Top Navigation Bar -->
        <header class="w-full max-w-[1600px] mx-auto flex justify-between items-center p-6 md:p-8 z-50 relative">
            <div class="flex items-center gap-3 group cursor-pointer">
                <div class="flex items-center justify-center transition-transform group-hover:scale-105">
                    <img src="{{ asset('images/logo.svg') }}" alt="siPanda Logo" class="h-[3rem] w-auto block dark:hidden" />
                    <img src="{{ asset('images/logo-white.svg') }}" alt="siPanda Logo Dark" class="h-[3rem] w-auto hidden dark:block" />
                </div>
            </div>
            
            <nav class="hidden lg:flex gap-1 glass-panel dark:border-panda-gray p-1.5 rounded-full font-semibold text-slate-700 dark:text-cream shadow-sm border border-white">
                <a href="#" class="hover:bg-white/80 dark:hover:bg-panda-gray px-6 py-2 rounded-full transition-all text-sm">Beranda</a>
                <a href="#" class="hover:bg-white/80 dark:hover:bg-panda-gray px-6 py-2 rounded-full transition-all text-sm">Tentang</a>
                <a href="#" class="hover:bg-white/80 dark:hover:bg-panda-gray px-6 py-2 rounded-full transition-all text-sm">Fitur Unggulan</a>

                <!-- Dark Mode Toggle -->
                <button id="theme-toggle" class="px-4 py-2 hover:bg-white/80 dark:hover:bg-panda-gray rounded-full transition-all flex items-center">
                    <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>
            </nav>

            @auth
                <div class="flex items-center gap-3 relative z-[100]">
                    
                    <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 rounded-full font-bold text-white bg-panda-black hover:bg-panda-gray transition-all shadow-md text-sm">
                        Dashboard
                    </a>
                    
                    <a href="{{ route('filament.admin.auth.logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="text-red-500 hover:text-red-700 text-sm font-bold cursor-pointer transition">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('filament.admin.auth.logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            @else
                <div class="flex items-center gap-4 relative z-[100]">
                    <a href="{{ route('filament.admin.auth.login') }}" class="font-bold text-slate-600 dark:text-cream hover:text-panda-black dark:hover:text-white transition text-sm">
                        Log in
                    </a>
                    
                    <a href="{{ route('filament.admin.auth.register') }}" class="bg-bamboo-fresh text-white px-7 py-2.5 rounded-full font-bold hover:bg-bamboo-emerald hover:scale-105 transition-all shadow-[0_8px_20px_rgba(34,197,94,0.3)] text-sm">
                        Start Free
                    </a>
                </div>
            @endauth
        </header>

        <!-- Main Landing Content -->
        <main class="flex-1 w-full max-w-[1400px] mx-auto flex flex-col lg:flex-row items-center justify-center relative z-10 min-h-[85vh] px-6 pb-20">
            
            <!-- Left Content: Typography & CTA -->
            <div class="w-full lg:w-[45%] z-20 relative text-center lg:text-left mb-16 lg:mb-0">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mix-blend-multiply bg-bamboo-fresh/10 border border-bamboo-fresh/30 text-xs font-extrabold uppercase tracking-widest text-bamboo-emerald mb-6">
                    <span class="w-2 h-2 rounded-full bg-bamboo-fresh animate-pulse"></span>
                    Paham inti & atur jeda
                </div>
                
                <h1 class="font-heading text-6xl md:text-[80px] lg:text-[90px] font-black tracking-tighter leading-[0.95] mb-8 text-panda-black dark:text-white">
                    Si <br/> 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-bamboo-fresh to-bamboo-emerald drop-shadow-[0_10px_20px_rgba(34,197,94,0.3)]">Panda.</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-slate-500 dark:text-slate-300 font-medium max-w-xl mx-auto lg:mx-0 mb-10 leading-relaxed font-sans">
                   Belajar gak perlu begadang, biar nggak punya mata panda.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-5 justify-center lg:justify-start items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-bamboo-fresh text-white px-10 py-5 rounded-[2rem] font-bold text-lg hover:bg-bamboo-emerald hover:-translate-y-1 transition-all duration-300 shadow-[0_10px_30px_-5px_rgba(34,197,94,0.5)] flex items-center gap-3">
                            Enter Dashboard
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('filament.admin.auth.register') }}" class="bg-bamboo-fresh text-white px-10 py-5 rounded-[2rem] font-bold text-lg hover:bg-bamboo-emerald hover:-translate-y-1 transition-all duration-300 shadow-[0_10px_30px_-5px_rgba(34,197,94,0.5)] flex items-center gap-3">
                                Start Free
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        @else
                            <a href="{{ route('filament.admin.auth.register') }}" class="bg-bamboo-fresh text-white px-10 py-5 rounded-[2rem] font-bold text-lg hover:bg-bamboo-emerald hover:-translate-y-1 transition-all duration-300 shadow-[0_10px_30px_-5px_rgba(34,197,94,0.5)] flex items-center gap-3">
                                Start Free
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        @endif
                    @endauth
                    
                    <a href="" class="glass-panel px-10 py-5 rounded-[2rem] font-extrabold text-panda-gray dark:text-white/80 hover:bg-white dark:hover:bg-panda-gray hover:-translate-y-1 transition-all duration-300 flex items-center gap-3 border-2 border-white dark:border-white/10">
                        <div class="w-8 h-8 rounded-full bg-panda-black flex items-center justify-center shadow-lg border border-white/20">
                            <svg class="w-4 h-4 ml-0.5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"></path></svg>
                        </div>
                        See Bamboo AI Mode
                    </a>
                </div>
            </div>

            <!-- Right Content: Floating Hero Graphics (Panda + Glassmorphic elements) -->
            <div class="w-full lg:w-[55%] relative z-20 flex justify-center lg:justify-end">
                
                <!-- Main Glassmorphic Panel -->
                <div class="glass-panel w-full max-w-[550px] h-[550px] rounded-[3rem] p-8 flex flex-col relative animate-float-slow backdrop-blur-3xl shadow-[0_40px_80px_rgba(0,0,0,0.07)]">
                    
                    <!-- Top Window controls -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex gap-2">
                            <div class="w-3.5 h-3.5 rounded-full bg-red-400 border border-red-500 shadow-inner"></div>
                            <div class="w-3.5 h-3.5 rounded-full bg-yellow-400 border border-yellow-500 shadow-inner"></div>
                            <div class="w-3.5 h-3.5 rounded-full bg-bamboo-fresh border border-bamboo-emerald shadow-inner"></div>
                        </div>
                         @auth
                        <div class="px-5 py-1.5 bg-white/60 rounded-full text-[10px] font-extrabold text-slate-500 uppercase tracking-widest border border-white">
                            Hi, {{ auth()->user()->name }}
                        </div>
                        @endauth
                    </div>
                    
                    <!-- Inside panel workspace (Hologram & Panda) -->
                    <div class="relative flex-1 flex flex-col items-center justify-end rounded-[2rem] bg-gradient-to-b from-white/20 to-black/5 overflow-visible border border-white/50">
                        
                        <!-- Glowing Green Hologram (AI Summarized Text) -->
                        <div class="absolute top-[15%] left-1/2 transform -translate-x-1/2 w-[260px] holo-glow bg-bamboo-fresh/10 rounded-2xl p-5 animate-pulse-glow z-20 flex flex-col gap-3">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-bamboo-fresh animate-spin" style="animation-duration: 3s;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                <span class="text-xs font-bold text-bamboo-fresh uppercase tracking-widest">Processing Data...</span>
                            </div>
                            <!-- Hologram text lines -->
                            <div class="h-2.5 w-1/3 bg-bamboo-fresh opacity-80 rounded-full mb-1 drop-shadow-[0_0_5px_rgba(34,197,94,1)]"></div>
                            <div class="h-1.5 w-full bg-bamboo-fresh opacity-60 rounded-full"></div>
                            <div class="h-1.5 w-5/6 bg-bamboo-fresh opacity-60 rounded-full"></div>
                            <div class="h-1.5 w-4/6 bg-bamboo-fresh opacity-60 rounded-full"></div>
                            <div class="h-1.5 w-[90%] bg-bamboo-fresh opacity-60 rounded-full mt-1"></div>
                            
                            <div class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 border-x-[15px] border-x-transparent border-t-[25px] border-t-bamboo-fresh/20 blur-[2px]"></div>
                        </div>

                        <!-- Minimalist Cute 3D Panda character (Vector CSS) -->
                        <div class="relative z-10 w-[220px] h-[220px] bg-panda-black rounded-t-[5rem] flex justify-center shadow-2xl mt-auto transform translate-y-2 border-x-4 border-t-4 border-whtie/10">
                            <!-- Panda Face Board -->
                            <div class="w-[180px] h-[140px] bg-white rounded-[4rem] shadow-[inset_0_-10px_20px_rgba(0,0,0,0.1)] mt-6 relative">
                                
                                <!-- Panda Ears -->
                                <div class="absolute -top-6 -left-3 w-[60px] h-[60px] bg-panda-black rounded-full -z-10 shadow-[inset_0_-5px_10px_rgba(255,255,255,0.2)]"></div>
                                <div class="absolute -top-6 -right-3 w-[60px] h-[60px] bg-panda-black rounded-full -z-10 shadow-[inset_0_-5px_10px_rgba(255,255,255,0.2)]"></div>
                                
                                <!-- Emerald Green Headphones (Over ear) -->
                                <div class="absolute top-8 -left-5 w-[25px] h-[65px] bg-bamboo-emerald rounded-[1rem] shadow-[-5px_0_15px_rgba(16,185,129,0.5)] border-2 border-bamboo-light"></div>
                                <div class="absolute top-8 -right-5 w-[25px] h-[65px] bg-bamboo-emerald rounded-[1rem] shadow-[5px_0_15px_rgba(16,185,129,0.5)] border-2 border-bamboo-light"></div>
                                <!-- Headphone band -->
                                <div class="absolute -top-[45px] left-1/2 transform -translate-x-1/2 w-[220px] h-[70px] border-t-[14px] border-x-[14px] border-bamboo-emerald rounded-t-[4rem] -z-20"></div>
                                
                                <!-- Panda Eyes patches -->
                                <div class="absolute top-10 left-5 w-[45px] h-[55px] bg-panda-black rounded-[2rem] transform -rotate-[20deg] shadow-inner flex items-center justify-center">
                                    <!-- Eye sparkles looking up at hologram -->
                                    <div class="w-4 h-5 bg-white rounded-full -translate-y-2 translate-x-1 shadow-[0_0_5px_rgba(255,255,255,0.8)]"></div>
                                    <div class="absolute w-2 h-2 bg-white rounded-full translate-y-2 translate-x-3"></div>
                                </div>
                                <div class="absolute top-10 right-5 w-[45px] h-[55px] bg-panda-black rounded-[2rem] transform rotate-[20deg] shadow-inner flex items-center justify-center">
                                    <div class="w-4 h-5 bg-white rounded-full -translate-y-2 -translate-x-1 shadow-[0_0_5px_rgba(255,255,255,0.8)]"></div>
                                    <div class="absolute w-2 h-2 bg-white rounded-full translate-y-2 -translate-x-3"></div>
                                </div>
                                
                                <!-- Cute tiny Nose & Mouth -->
                                <div class="absolute top-[85px] left-1/2 transform -translate-x-1/2 w-5 h-3 bg-panda-black rounded-[2rem]"></div>
                                <div class="absolute top-[92px] left-1/2 transform -translate-x-1/2 w-8 h-4 border-b-4 border-panda-black rounded-b-full"></div>
                                
                                <!-- Hologram reflection on face -->
                                <div class="absolute top-2 left-1/2 transform -translate-x-1/2 w-[120px] h-[40px] bg-bamboo-fresh/10 blur-[10px] rounded-full pointer-events-none"></div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Floating Widget 1: Pomodoro Timer -->
                <div class="absolute -left-16 bottom-[10%] dark-glass rounded-[2.5rem] p-5 animate-float-medium z-30 shadow-[0_20px_40px_rgba(0,0,0,0.3)] flex items-center gap-5 border border-white/20 transform rotate-1">
                    <div class="relative w-20 h-20 flex items-center justify-center bg-panda-black rounded-full shadow-inner">
                        <svg class="absolute inset-0 w-full h-full transform -rotate-90 scale-90" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="44" fill="none" class="stroke-white/10" stroke-width="8"></circle>
                            <!-- Progress bar glowing green -->
                            <circle cx="50" cy="50" r="44" fill="none" class="stroke-bamboo-fresh drop-shadow-[0_0_8px_rgba(34,197,94,0.7)]" stroke-width="8" stroke-dasharray="276" stroke-dashoffset="50" stroke-linecap="round"></circle>
                        </svg>
                        <span class="text-white font-heading font-black text-xl">25<span class="animate-pulse opacity-50">:</span>00</span>
                    </div>
                    <div>
                        <h4 class="text-white font-extrabold text-base mb-1">Pomodoro</h4>
                        <p class="text-bamboo-fresh text-[10px] tracking-[0.2em] uppercase font-bold flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-bamboo-fresh rounded-full animate-pulse"></span>
                            Focus Active
                        </p>
                    </div>
                </div>

                <!-- Floating Widget 2: AI Summary Log -->
                <div class="absolute -right-10 top-[20%] glass-panel rounded-[2rem] p-6 animate-float-fast z-30 shadow-[0_20px_50px_rgba(0,0,0,0.1)] w-[240px] border border-white transform -rotate-2">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-bamboo-emerald text-white flex items-center justify-center shadow-lg shadow-bamboo-emerald/40">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <h4 class="font-heading font-extrabold text-slate-800 text-sm">Summary Log</h4>
                        </div>
                    </div>
                    <div class="space-y-3 bg-white/50 p-4 rounded-xl border border-white shadow-inner">
                        <div class="h-2 w-full bg-bamboo-emerald/30 rounded-full"></div>
                        <div class="h-2 w-4/5 bg-bamboo-emerald/30 rounded-full"></div>
                        <div class="h-2 w-[85%] bg-bamboo-emerald/30 rounded-full"></div>
                        <div class="flex items-center gap-1.5 mt-4 border-t border-white/80 pt-3">
                            <div class="w-5 h-5 rounded-full bg-bamboo-light flex items-center justify-center text-bamboo-emerald">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-[10px] font-extrabold text-slate-600 uppercase tracking-widest">Condensed</span>
                        </div>
                    </div>
                </div>

            </div>

        </main>
        
        <!-- Section 1: Fitur Cerdas untuk Calon Analis -->
        <section class="w-full max-w-[1400px] mx-auto px-6 py-20 relative z-10">
            <div class="text-center mb-16">
                <h2 class="font-heading text-4xl md:text-5xl font-black text-panda-black dark:text-cream">Fitur Cerdas untuk Calon Analis</h2>
                <div class="h-1 w-20 bg-bamboo-fresh mx-auto mt-6 rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Card 1 -->
                <div class="glass-panel dark:dark-glass p-8 rounded-3xl hover:-translate-y-2 transition-all duration-300 border border-white/50 dark:border-white/10">
                    <div class="w-14 h-14 rounded-2xl bg-bamboo-light dark:bg-bamboo-fresh/20 flex items-center justify-center text-bamboo-emerald mb-6 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.795 0-5.482-.186-8.135-.54-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"></path></svg>
                    </div>
                    <h3 class="font-heading font-extrabold text-xl text-panda-black dark:text-cream mb-3">Ringkasan AI & Catatan Digital</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">AI otomatis meringkas kebutuhan pengguna dari repositori data yang ada ke catatan tersusun.</p>
                </div>
                <!-- Card 2 -->
                <div class="glass-panel dark:dark-glass p-8 rounded-3xl hover:-translate-y-2 transition-all duration-300 border border-white/50 dark:border-white/10">
                    <div class="w-14 h-14 rounded-2xl bg-bamboo-light dark:bg-bamboo-fresh/20 flex items-center justify-center text-bamboo-emerald mb-6 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-heading font-extrabold text-xl text-panda-black dark:text-cream mb-3">Timer Fokus 25/5</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">Gunakan interval produktif untuk menyelesaikan task identifikasi tanpa burnout.</p>
                </div>
                <!-- Card 3 -->
                <div class="glass-panel dark:dark-glass p-8 rounded-3xl hover:-translate-y-2 transition-all duration-300 border border-white/50 dark:border-white/10">
                    <div class="w-14 h-14 rounded-2xl bg-bamboo-light dark:bg-bamboo-fresh/20 flex items-center justify-center text-bamboo-emerald mb-6 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h3 class="font-heading font-extrabold text-xl text-panda-black dark:text-cream mb-3">Uji Pemahaman Analis</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">Interactive quiz skenario validasi kebutuhan sistem buat mempertajam skill analis.</p>
                </div>
                <!-- Card 4 -->
                <div class="glass-panel dark:dark-glass p-8 rounded-3xl hover:-translate-y-2 transition-all duration-300 border border-white/50 dark:border-white/10">
                    <div class="w-14 h-14 rounded-2xl bg-bamboo-light dark:bg-bamboo-fresh/20 flex items-center justify-center text-bamboo-emerald mb-6 shadow-sm">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <h3 class="font-heading font-extrabold text-xl text-panda-black dark:text-cream mb-3">Target Belajar Harian</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">Timeline mini To-Do untuk checklist apa saja kebutuhan fungsional hari ini.</p>
                </div>
            </div>
        </section>

        <!-- Section 2: Visual Dashboard Analisis Log & Gamification -->
        <section class="w-full max-w-[1400px] mx-auto px-6 py-20 relative z-10 flex flex-col lg:flex-row gap-12">
            <!-- Streak Gamification -->
            <div class="glass-panel dark:dark-glass rounded-[3rem] p-10 flex-1 relative overflow-hidden border border-white/50 dark:border-white/10">
                <div class="absolute top-0 right-0 w-40 h-40 bg-orange-400/10 rounded-full blur-3xl"></div>
                <h3 class="font-heading font-black text-3xl text-panda-black dark:text-cream mb-8">Streak Belajar Aktif</h3>
                
                <div class="flex items-center gap-4 bg-white/50 dark:bg-panda-black/50 p-6 rounded-2xl border border-white/20">
                    <!-- Iteration for Flames -->
                    <div class="flex-1 flex justify-between">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-orange-100 dark:bg-orange-500/20 rounded-full animate-pulse-glow">
                            <span class="text-orange-500 text-xl sm:text-2xl drop-shadow-[0_0_8px_rgba(249,115,22,0.8)]">🔥</span>
                        </div>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-orange-100 dark:bg-orange-500/20 rounded-full animate-pulse-glow" style="animation-delay: 0.2s;">
                            <span class="text-orange-500 text-xl sm:text-2xl drop-shadow-[0_0_8px_rgba(249,115,22,0.8)]">🔥</span>
                        </div>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-orange-100 dark:bg-orange-500/20 rounded-full animate-pulse-glow" style="animation-delay: 0.4s;">
                            <span class="text-orange-500 text-xl sm:text-2xl drop-shadow-[0_0_8px_rgba(249,115,22,0.8)]">🔥</span>
                        </div>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-orange-100 dark:bg-orange-500/20 rounded-full animate-pulse-glow" style="animation-delay: 0.6s;">
                            <span class="text-orange-500 text-xl sm:text-2xl drop-shadow-[0_0_8px_rgba(249,115,22,0.8)]">🔥</span>
                        </div>
                        <!-- Inactive flames -->
                        <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-slate-200 dark:bg-slate-800 rounded-full grayscale opacity-50">
                            <span class="text-orange-500 text-xl sm:text-2xl">🔥</span>
                        </div>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-slate-200 dark:bg-slate-800 rounded-full grayscale opacity-50">
                            <span class="text-orange-500 text-xl sm:text-2xl">🔥</span>
                        </div>
                        <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-slate-200 dark:bg-slate-800 rounded-full grayscale opacity-50">
                            <span class="text-orange-500 text-xl sm:text-2xl">🔥</span>
                        </div>
                    </div>
                </div>
                <p class="mt-4 font-bold text-slate-500 dark:text-slate-400 text-center">4 Hari berturut-turut! Lanjutkan performa hebatmu! 🔥</p>
            </div>

            <!-- Dashboard Log -->
            <div class="glass-panel dark:dark-glass rounded-[3rem] p-10 flex-1 relative border border-white/50 dark:border-white/10">
                <h3 class="font-heading font-black text-3xl text-panda-black dark:text-cream mb-8">Statistik Mingguan</h3>
                
                <div class="flex h-40 items-end gap-2 sm:gap-6 bg-white/50 dark:bg-panda-black/50 p-6 rounded-2xl border border-white/20">
                    <!-- Bar Chart HTML/CSS -->
                    <div class="flex flex-col items-center flex-1 h-full justify-end">
                        <div class="w-full bg-bamboo-emerald/30 rounded-t-lg h-[40%] flex items-end justify-center group relative cursor-pointer hover:bg-bamboo-emerald/50 transition-colors">
                            <span class="absolute -top-7 px-2 py-1 bg-panda-black text-white rounded text-[10px] font-bold opacity-0 group-hover:opacity-100 transition-opacity">2 Jam</span>
                        </div>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 mt-2 font-bold uppercase">Sen</span>
                    </div>
                    <div class="flex flex-col items-center flex-1 h-full justify-end">
                        <div class="w-full bg-bamboo-emerald/80 rounded-t-lg h-[80%] flex items-end justify-center group relative cursor-pointer hover:bg-bamboo-emerald transition-colors drop-shadow-[0_0_8px_rgba(16,185,129,0.5)]">
                            <span class="absolute -top-7 px-2 py-1 bg-panda-black text-white rounded text-[10px] font-bold opacity-0 group-hover:opacity-100 transition-opacity">4 Jam</span>
                        </div>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 mt-2 font-bold uppercase">Sel</span>
                    </div>
                    <div class="flex flex-col items-center flex-1 h-full justify-end">
                        <div class="w-full bg-bamboo-emerald/50 rounded-t-lg h-[60%] flex items-end justify-center group relative cursor-pointer hover:bg-bamboo-emerald/70 transition-colors">
                            <span class="absolute -top-7 px-2 py-1 bg-panda-black text-white rounded text-[10px] font-bold opacity-0 group-hover:opacity-100 transition-opacity">3 Jam</span>
                        </div>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 mt-2 font-bold uppercase">Rab</span>
                    </div>
                    <div class="flex flex-col items-center flex-1 h-full justify-end">
                        <div class="w-full bg-bamboo-emerald rounded-t-lg h-[100%] flex items-end justify-center group relative cursor-pointer hover:bg-bamboo-emerald transition-colors drop-shadow-[0_0_10px_rgba(16,185,129,0.8)]">
                            <span class="absolute -top-7 px-2 py-1 bg-panda-black text-white rounded text-[10px] font-bold opacity-0 group-hover:opacity-100 transition-opacity">5 Jam</span>
                        </div>
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 mt-2 font-bold uppercase">Kam</span>
                    </div>
                </div>
                
                <div class="flex justify-between mt-5 px-2">
                    <p class="font-extrabold text-sm text-panda-black dark:text-cream">Durasi Belajar: <span class="text-bamboo-emerald">14 Jam</span></p>
                    <p class="font-extrabold text-sm text-panda-black dark:text-cream">Penggunaan AI: <span class="text-bamboo-fresh">32 Prompt</span></p>
                </div>
            </div>
        </section>

        <!-- Section 3: Infografis Alur Belajar -->
        <section class="w-full max-w-[1200px] mx-auto px-6 py-20 relative z-10">
            <h2 class="font-heading text-4xl md:text-5xl text-center font-black text-panda-black dark:text-cream mb-16">Alur Belajar Optimal</h2>
            
            <div class="flex flex-col md:flex-row justify-between items-center relative">
                <!-- Dashed Line Connector (Desktop) -->
                <div class="hidden md:block absolute top-[40px] left-[10%] right-[10%] border-t-[3px] border-dashed border-bamboo-fresh/50 z-[-1]"></div>
                
                <!-- Steps -->
                <div class="flex flex-col items-center mb-10 md:mb-0 bg-transparent relative group">
                    <div class="w-20 h-20 bg-white dark:bg-panda-gray rounded-full shadow-lg border-4 border-bamboo-fresh flex items-center justify-center text-3xl mb-4 z-10 transition-transform duration-300 group-hover:-translate-y-2 group-hover:shadow-[0_10px_20px_rgba(34,197,94,0.3)]">📚</div>
                    <h4 class="font-extrabold text-lg text-panda-black dark:text-cream text-center">Baca Materi</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 text-center max-w-[150px] mt-2">Pelajari teori rekayasa perangkat lunak.</p>
                </div>
                <!-- Dashed Line Connector (Mobile) -->
                <div class="md:hidden h-12 border-l-[3px] border-dashed border-bamboo-fresh/50 my-[-15px] z-[-1]"></div>
                
                <div class="flex flex-col items-center mb-10 md:mb-0 bg-transparent relative group">
                    <div class="w-20 h-20 bg-white dark:bg-panda-gray rounded-full shadow-lg border-4 border-bamboo-fresh flex items-center justify-center text-3xl mb-4 z-10 transition-transform duration-300 group-hover:-translate-y-2 group-hover:shadow-[0_10px_20px_rgba(34,197,94,0.3)] holo-glow">🤖</div>
                    <h4 class="font-extrabold text-lg text-panda-black dark:text-cream text-center">Ringkas dengan AI</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 text-center max-w-[150px] mt-2">Generate poin penting konsep analisis.</p>
                </div>
                <!-- Dashed Line Connector (Mobile) -->
                <div class="md:hidden h-12 border-l-[3px] border-dashed border-bamboo-fresh/50 my-[-15px] z-[-1]"></div>
                
                <div class="flex flex-col items-center mb-10 md:mb-0 bg-transparent relative group">
                    <div class="w-20 h-20 bg-white dark:bg-panda-gray rounded-full shadow-lg border-4 border-bamboo-fresh flex items-center justify-center text-3xl mb-4 z-10 transition-transform duration-300 group-hover:-translate-y-2 group-hover:shadow-[0_10px_20px_rgba(34,197,94,0.3)]">💡</div>
                    <h4 class="font-extrabold text-lg text-panda-black dark:text-cream text-center">Simpan Catatan</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 text-center max-w-[150px] mt-2">Review ulang di dashboard Anda.</p>
                </div>
                <!-- Dashed Line Connector (Mobile) -->
                <div class="md:hidden h-12 border-l-[3px] border-dashed border-bamboo-fresh/50 my-[-15px] z-[-1]"></div>
                
                <div class="flex flex-col items-center mb-10 md:mb-0 bg-transparent relative group">
                    <div class="w-20 h-20 bg-white dark:bg-panda-gray rounded-full shadow-lg border-4 border-bamboo-fresh flex items-center justify-center text-3xl mb-4 z-10 transition-transform duration-300 group-hover:-translate-y-2 group-hover:shadow-[0_10px_20px_rgba(34,197,94,0.3)]">🎯</div>
                    <h4 class="font-extrabold text-lg text-panda-black dark:text-cream text-center">Kerjakan Latihan</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 text-center max-w-[150px] mt-2">Selesaikan kuis uji pemahaman.</p>
                </div>
            </div>
        </section>

        <!-- Minimalis Footer -->
        <footer class="bg-panda-black w-full py-10 text-center mt-20 relative z-20 border-t border-white/5">
            <div class="max-w-[1400px] mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
                <!-- Footer Logo -->
                <div class="flex items-center gap-3">
                   <img src="{{ asset('images/logo-white.svg') }}" alt="siPanda Logo Dark" class="h-[3rem] w-auto" />
                </div>
                
                <p class="text-bamboo-light/70 text-sm font-medium">
                    &copy; {{ date('Y') }} siPanda - Analisis Kebutuhan Pengguna. Belajar lebih efektif.
                </p>
                
                <div class="flex gap-6 font-bold text-sm text-bamboo-light/70">
                    <a href="#" class="hover:text-bamboo-fresh transition-colors">Privacy</a>
                    <a href="#" class="hover:text-bamboo-fresh transition-colors">Terms</a>
                    <a href="#" class="hover:text-bamboo-fresh transition-colors">Support</a>
                </div>
            </div>
        </footer>
        
        <!-- Subtle floating particle for extra detail -->
        <div class="fixed bottom-10 left-[40%] w-2 h-2 bg-bamboo-fresh rounded-full animate-ping z-[-1] opacity-50"></div>

        <!-- Dark Mode Toggle Script -->
        <script>
            var themeToggleBtn = document.getElementById('theme-toggle');
            var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

            // Initialize Icon based on OS or Local Storage preference
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                themeToggleLightIcon.classList.remove('hidden');
                document.documentElement.classList.add('dark');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
                document.documentElement.classList.remove('dark');
            }

            // Click listener for Toggle
            if(themeToggleBtn){
                themeToggleBtn.addEventListener('click', function() {
                    themeToggleDarkIcon.classList.toggle('hidden');
                    themeToggleLightIcon.classList.toggle('hidden');

                    if (localStorage.getItem('color-theme')) {
                        if (localStorage.getItem('color-theme') === 'light') {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('color-theme', 'dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('color-theme', 'light');
                        }
                    } else {
                        if (document.documentElement.classList.contains('dark')) {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('color-theme', 'light');
                        } else {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('color-theme', 'dark');
                        }
                    }
                });
            }
        </script>
    </body>
</html>
