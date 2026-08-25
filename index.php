<?php 
// Fallback router for built-in PHP server or catch-all server configs
$requestPath = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
if ($requestPath && $requestPath !== 'index' && file_exists(__DIR__ . '/' . $requestPath . '.php')) {
    require __DIR__ . '/' . $requestPath . '.php';
    exit;
}
include 'includes/header.php'; 
?>

<!-- Impressive Multi-Panel Preloader (Numberless) -->
<div id="site-preloader" class="fixed inset-0 z-[10000] pointer-events-none flex">
    <!-- 4 vertical panels for the shutter effect -->
    <div class="preloader-panel w-1/4 h-full bg-[#030712] transition-transform duration-[1200ms] ease-[cubic-bezier(0.77,0,0.175,1)] pointer-events-auto origin-bottom"></div>
    <div class="preloader-panel w-1/4 h-full bg-[#030712] transition-transform duration-[1200ms] ease-[cubic-bezier(0.77,0,0.175,1)] delay-[75ms] pointer-events-auto origin-bottom"></div>
    <div class="preloader-panel w-1/4 h-full bg-[#030712] transition-transform duration-[1200ms] ease-[cubic-bezier(0.77,0,0.175,1)] delay-[150ms] pointer-events-auto origin-bottom"></div>
    <div class="preloader-panel w-1/4 h-full bg-[#030712] transition-transform duration-[1200ms] ease-[cubic-bezier(0.77,0,0.175,1)] delay-[225ms] pointer-events-auto origin-bottom"></div>
    
    <!-- Content overlay -->
    <div id="preloader-content" class="absolute inset-0 flex flex-col items-center justify-center transition-opacity duration-700 pointer-events-none">
        
        <!-- Hero Logo Animation Core -->
        <div class="relative flex items-center justify-center mb-10 md:mb-16 w-64 h-64 md:w-80 md:h-80 mx-auto scale-90 sm:scale-100">
            <!-- Complex futuristic rings -->
            <svg class="absolute inset-0 w-full h-full animate-[spin_10s_linear_infinite] opacity-60" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="48" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="0.5" />
                <circle cx="50" cy="50" r="48" fill="none" stroke="url(#loader-grad-outer)" stroke-width="1.5" stroke-dasharray="60 150 40 100" stroke-linecap="round" />
                <defs>
                    <linearGradient id="loader-grad-outer" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#3b82f6" />
                        <stop offset="100%" stop-color="#10b981" />
                    </linearGradient>
                </defs>
            </svg>
            <svg class="absolute inset-4 w-[calc(100%-32px)] h-[calc(100%-32px)] animate-[spin_7s_linear_infinite_reverse] opacity-80" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="45" fill="none" stroke="url(#loader-grad-inner)" stroke-width="2" stroke-dasharray="100 200" stroke-linecap="round" />
                <defs>
                    <linearGradient id="loader-grad-inner" x1="100%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" stop-color="#8b5cf6" />
                        <stop offset="100%" stop-color="#06b6d4" />
                    </linearGradient>
                </defs>
            </svg>

            <!-- Intense Ambient Core Glow (Optimized) -->
            <div class="absolute inset-0 rounded-full animate-pulse transform-gpu bg-[radial-gradient(circle_at_center,rgba(59,130,246,0.25)_0%,transparent_65%)]"></div>

            <!-- The Logo Container -->
            <div id="preloader-logo-wrapper" class="relative z-10 scale-125 blur-md opacity-0 transition-all duration-1000 ease-[cubic-bezier(0.16,1,0.3,1)] transform-gpu">
                <!-- Glowing Logo -->
                <div class="relative animate-[float_4s_ease-in-out_infinite] transform-gpu">
                    <img src="assets/images/grovixo_logo.png" alt="Grovixo Logo" fetchpriority="high"
                         class="h-20 md:h-28 w-auto object-contain brightness-0 invert drop-shadow-[0_0_15px_rgba(255,255,255,0.7)]">
                </div>
            </div>
        </div>
        
        <!-- Futuristic Loading Bar & Data Output -->
        <div class="mt-8 md:mt-12 flex flex-col items-center w-[85%] max-w-[320px]">
            <div class="flex justify-between items-end w-full text-[9px] md:text-[10px] font-mono text-slate-400 uppercase tracking-widest mb-3 opacity-0 transition-opacity duration-1000" id="preloader-text-wrap">
                <div class="flex flex-col gap-1">
                    <span class="text-blue-400/80">Sequence initiated</span>
                    <span class="animate-pulse">Loading core modules...</span>
                </div>
                <div class="text-right">
                    <span id="preloader-percent" class="text-lg text-white font-light tracking-normal">0%</span>
                </div>
            </div>
            
            <div class="w-full h-[1px] bg-white/10 relative overflow-hidden">
                <div id="preloader-line" class="absolute top-0 left-0 h-full bg-gradient-to-r from-blue-600 via-cyan-400 to-white w-0 transition-none shadow-[0_0_10px_rgba(34,211,238,0.8)]">
                    <!-- Laser tip -->
                    <div class="absolute top-1/2 -translate-y-1/2 right-0 w-16 h-[2px] bg-white blur-[2px]"></div>
                </div>
            </div>
        </div>
        
        <style>
            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-12px); }
            }
        </style>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const preloader = document.getElementById('site-preloader');
    const content = document.getElementById('preloader-content');
    const panels = document.querySelectorAll('.preloader-panel');
    const logoWrapper = document.getElementById('preloader-logo-wrapper');
    const line = document.getElementById('preloader-line');
    const textWrap = document.getElementById('preloader-text-wrap');
    const percentEl = document.getElementById('preloader-percent');
    
    // Quick exit if already shown in session
    if (sessionStorage.getItem('grovixo_preloader_shown')) {
        content.remove(); 
        requestAnimationFrame(() => {
            setTimeout(() => {
                panels.forEach(panel => panel.classList.add('-translate-y-full'));
                setTimeout(() => preloader.remove(), 1200);
            }, 50);
        });
        return;
    }

    // 1. Hero Logo Reveal
    setTimeout(() => {
        if (logoWrapper) {
            logoWrapper.classList.remove('scale-125', 'blur-md', 'opacity-0');
            logoWrapper.classList.add('scale-100', 'blur-none', 'opacity-100');
        }
        
        textWrap.classList.remove('opacity-0');
    }, 50);

    // 2. Smooth Line Progress & Counter
    const duration = 1200; // Optimized duration for Lighthouse Speed Index
    line.style.transition = `width ${duration}ms cubic-bezier(0.77, 0, 0.175, 1)`;
    
    // Percentage counter animation
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        
        // Custom easing for numbers
        const easeProgress = progress < 0.5 
            ? 4 * progress * progress * progress 
            : 1 - Math.pow(-2 * progress + 2, 3) / 2;
            
        percentEl.innerText = Math.floor(easeProgress * 100) + '%';
        
        if (progress < 1) {
            window.requestAnimationFrame(step);
        } else {
            percentEl.innerText = '100%';
        }
    };
    
    setTimeout(() => {
        line.style.width = '100%';
        window.requestAnimationFrame(step);
        
        // 3. Cinematic Exit (Warp Speed / Zoom)
        setTimeout(() => {
            // Scale up and blur to transition into the site
            content.style.opacity = '0';
            content.style.transform = 'scale(1.2) translateY(-20px)';
            content.style.filter = 'blur(10px)';
            content.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
            
            // 4. Slide panels up sequentially
            setTimeout(() => {
                panels.forEach(panel => {
                    panel.classList.add('-translate-y-full');
                });
                
                sessionStorage.setItem('grovixo_preloader_shown', 'true');
                
                // Cleanup DOM
                setTimeout(() => preloader.remove(), 1200);
            }, 600); // Wait for content fade out
            
        }, duration + 300); // Wait for progress line to finish
        
    }, 400); // Delay start of progress line
});
</script>

<main>
        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-[#030712] min-h-screen flex items-center justify-center pt-24 pb-32 border-b border-white/5">
            
            <!-- Immersive Background Effects -->
            <div class="absolute inset-0 pointer-events-none flex items-center justify-center overflow-hidden z-0">
                <!-- Massive Glowing Orbs -->
                <div class="absolute top-1/4 left-1/4 w-[40vw] h-[40vw] rounded-full bg-blue-600/10 blur-[120px] mix-blend-screen animate-pulse duration-1000"></div>
                <div class="absolute bottom-1/4 right-1/4 w-[30vw] h-[30vw] rounded-full bg-emerald-500/10 blur-[100px] mix-blend-screen"></div>
                
                <!-- Interactive High-End Particle Globe -->
                <canvas id="hero-particle-globe" class="absolute inset-0 w-full h-full mix-blend-screen opacity-40 md:opacity-80"></canvas>
                
                <!-- Subtle Grid & Noise overlay -->
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div>
                <div class="absolute inset-0 opacity-[0.15] mix-blend-overlay bg-[url('data:image/svg+xml;base64,PHN2ZyB2aWV3Qm94PSIwIDAgMjAwIDIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZmlsdGVyIGlkPSJub2lzZUZpbHRlciI+PGZlVHVyYnVsZW5jZSB0eXBlPSJmcmFjdGFsTm9pc2UiIGJhc2VGcmVxdWVuY3k9IjAuNjUiIG51bU9jdGF2ZXM9IjMiIHN0aXRjaFRpbGVzPSJzdGl0Y2giLz48L2ZpbHRlcj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWx0ZXI9InVybCgibm9pc2VGaWx0ZXIpIi8+PC9zdmc+')]"></div>
                
                <!-- Fade to black at bottom to blend with content below -->
                <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-[#030712] via-[#030712]/80 to-transparent"></div>
            </div>

            <div class="max-w-6xl mx-auto px-6 relative z-10 flex flex-col items-center text-center mt-32 sm:mt-40 md:mt-12 w-full">
                <!-- Dark gradient halo to ensure text readability against particles -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[150%] md:w-full h-[150%] bg-[radial-gradient(circle_at_center,rgba(3,7,18,0.9)_0%,transparent_70%)] -z-10 pointer-events-none blur-xl"></div>

                <h1 class="text-4xl sm:text-5xl md:text-7xl lg:text-[6.5rem] font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-emerald-300 md:text-white md:bg-none leading-[1.05] mb-8 [text-shadow:0_4px_24px_rgba(0,0,0,1)] max-w-5xl" data-aos="fade-up" data-aos-duration="1000">
                    Turning bold ideas<br class="hidden md:block">
                    into powerful <em class="font-serif italic font-light tracking-normal pr-2 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-emerald-300 [text-shadow:none]">realities.</em>
                </h1>
                
                <p class="text-lg md:text-xl text-slate-200 leading-relaxed max-w-2xl mb-12 font-medium [text-shadow:0_2px_10px_rgba(0,0,0,1)]" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    Product strategy, premium design, and scalable engineering<br class="hidden sm:block">
                    for startups that want to lead their market.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 relative z-10 mb-8" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                    <a href="contact.php" class="relative group bg-blue-600 text-white font-semibold text-sm px-6 py-3 rounded-full transition-all duration-300 overflow-hidden shadow-[0_0_40px_rgba(37,99,235,0.3)] hover:shadow-[0_0_60px_rgba(37,99,235,0.5)] hover:-translate-y-1 flex items-center justify-center">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <span class="relative flex items-center gap-2">Start Your Project <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i></span>
                    </a>
                </div>

                <!-- Services Rotator (Normal Document Flow) -->
                <div class="w-full max-w-lg z-10 opacity-70 px-6 h-8 flex justify-center items-center overflow-hidden mb-12" 
                     x-data="{ active: 0, items: 6 }" 
                     x-init="setInterval(() => active = (active + 1) % items, 2500)">
                    
                    <div class="relative w-full h-full flex justify-center items-center text-sm md:text-base font-bold text-white font-display uppercase tracking-widest">
                        <!-- Item 1 -->
                        <span class="absolute flex items-center justify-center gap-3 transition-all duration-500 w-full"
                              :class="active === 0 ? 'translate-y-0 opacity-100' : (active > 0 ? '-translate-y-8 opacity-0' : 'translate-y-8 opacity-0')">
                            <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg> WEB DEVELOPMENT
                        </span>
                        
                        <!-- Item 2 -->
                        <span class="absolute flex items-center justify-center gap-3 transition-all duration-500 w-full"
                              :class="active === 1 ? 'translate-y-0 opacity-100' : (active > 1 ? '-translate-y-8 opacity-0' : 'translate-y-8 opacity-0')">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg> APP DESIGN
                        </span>
                        
                        <!-- Item 3 -->
                        <span class="absolute flex items-center justify-center gap-3 transition-all duration-500 w-full"
                              :class="active === 2 ? 'translate-y-0 opacity-100' : (active > 2 ? '-translate-y-8 opacity-0' : 'translate-y-8 opacity-0')">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg> UI/UX EXPERTS
                        </span>
                        
                        <!-- Item 4 -->
                        <span class="absolute flex items-center justify-center gap-3 transition-all duration-500 w-full"
                              :class="active === 3 ? 'translate-y-0 opacity-100' : (active > 3 ? '-translate-y-8 opacity-0' : 'translate-y-8 opacity-0')">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg> CUSTOM ECOSYSTEMS
                        </span>
                        
                        <!-- Item 5 -->
                        <span class="absolute flex items-center justify-center gap-3 transition-all duration-500 w-full"
                              :class="active === 4 ? 'translate-y-0 opacity-100' : (active > 4 ? '-translate-y-8 opacity-0' : 'translate-y-8 opacity-0')">
                            <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg> BRANDING
                        </span>
                        
                        <!-- Item 6 -->
                        <span class="absolute flex items-center justify-center gap-3 transition-all duration-500 w-full"
                              :class="active === 5 ? 'translate-y-0 opacity-100' : (active === 0 ? 'translate-y-8 opacity-0' : '-translate-y-8 opacity-0')">
                            <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><circle cx="12" cy="12" r="6" stroke-width="2"/><circle cx="12" cy="12" r="2" stroke-width="2"/></svg> PRODUCT STRATEGY
                        </span>
                    </div>
                </div>

            </div>
        </section>

        <!-- Bento Grid Showcase -->
        <section class="py-24 bg-slate-50 border-b border-slate-100 overflow-hidden relative">
            <div class="absolute inset-0 bg-mesh opacity-30 pointer-events-none"></div>
            
            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
                    <p class="text-sm font-bold text-brand uppercase tracking-widest mb-2">Our Capabilities</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-navy">Built to dominate your market.</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 auto-rows-auto md:auto-rows-[280px]">
                    
                    <!-- Large Card (2 columns wide) -->
                    <div class="md:col-span-2 rounded-[2rem] bg-white border border-slate-100 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.02)] p-8 overflow-hidden relative group hover:shadow-xl hover:border-brand/20 transition-all duration-300" data-aos="fade-up">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-brand/10 blur-[80px] rounded-full group-hover:bg-brand/20 transition-all"></div>
                        <div class="relative z-10 h-full flex flex-col justify-between">
                            <div>
                                <h3 class="text-2xl md:text-3xl font-bold text-navy mb-3">Digital Marketing & SEO</h3>
                                <p class="text-slate-500 max-w-sm leading-relaxed">Data-driven marketing strategies designed to increase your visibility, drive traffic, and turn visitors into paying customers.</p>
                            </div>
                            
                            <!-- Faux Chart UI -->
                            <div class="mt-8 bg-slate-50/50 rounded-2xl p-6 border border-slate-100 flex items-end gap-3 h-40 transform translate-y-8 group-hover:translate-y-0 transition-transform duration-500">
                                <div class="w-1/5 bg-blue-100 rounded-t-xl h-[30%] relative group-hover:h-[40%] transition-all duration-500 delay-100"><div class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-blue-800">MAY</div></div>
                                <div class="w-1/5 bg-blue-200 rounded-t-xl h-[45%] relative group-hover:h-[55%] transition-all duration-500 delay-200"><div class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-blue-900">JUN</div></div>
                                <div class="w-1/5 bg-blue-300 rounded-t-xl h-[35%] relative group-hover:h-[45%] transition-all duration-500 delay-300"><div class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-blue-900">JUL</div></div>
                                <div class="w-1/5 bg-blue-400 rounded-t-xl h-[60%] relative group-hover:h-[75%] transition-all duration-500 delay-150"><div class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-white">AUG</div></div>
                                <div class="w-1/5 bg-brand rounded-t-xl h-[85%] relative group-hover:h-[95%] transition-all duration-500 shadow-[0_0_20px_rgba(37,99,235,0.3)] delay-75"><div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-navy text-white text-sm font-bold py-1.5 px-3 rounded-lg shadow-lg transform -translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 delay-300">+142%</div></div>
                            </div>
                        </div>
                    </div>

                    <!-- Small Card (1 column wide) -->
                    <div class="rounded-[2rem] bg-navy border border-navy shadow-[0_20px_50px_-10px_rgba(0,0,0,0.1)] p-8 overflow-hidden relative group hover:shadow-2xl transition-all duration-300 text-white" data-aos="fade-up" data-aos-delay="100">
                        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-brand/30 blur-[60px] rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMSIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvc3ZnPg==')]"></div>
                        <div class="relative z-10 h-full flex flex-col">
                            <h3 class="text-2xl font-bold mb-3 text-white">Web Development</h3>
                            <p class="text-slate-300 text-sm leading-relaxed">Performant, scalable websites and web apps built on modern tech stacks that load instantly.</p>
                            
                            <!-- Faux Speed Score UI -->
                            <div class="mt-auto flex justify-center items-center">
                                <div class="relative w-36 h-36 flex items-center justify-center transform group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                        <path class="text-white/10" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="2.5" stroke-dasharray="100, 100" />
                                        <!-- Score animation is achieved by changing stroke-dasharray. We'll simulate 99. -->
                                        <path class="text-green-400 drop-shadow-[0_0_12px_rgba(74,222,128,0.5)]" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="2.5" stroke-dasharray="99, 100" />
                                    </svg>
                                    <div class="absolute flex flex-col items-center justify-center">
                                        <span class="text-5xl font-black font-display tracking-tighter text-green-400 drop-shadow-md">99</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Small Card (1 column wide) -->
                    <div class="rounded-[2rem] bg-white border border-slate-100 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.02)] p-8 overflow-hidden relative group hover:shadow-xl hover:border-brand/20 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                        <div class="relative z-10 h-full flex flex-col">
                            <h3 class="text-2xl font-bold text-navy mb-3">Branding & Identity</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-auto">Logos, visual systems and brand guidelines that make you instantly recognizable.</p>
                            
                            <div class="flex flex-wrap gap-2 mt-8">
                                <span class="px-4 py-2.5 bg-slate-50 text-slate-700 rounded-xl font-bold text-xs border border-slate-100 hover:border-brand/30 hover:bg-brand/5 hover:text-brand transition-colors cursor-default shadow-sm">Logos</span>
                                <span class="px-4 py-2.5 bg-slate-50 text-slate-700 rounded-xl font-bold text-xs border border-slate-100 hover:border-brand/30 hover:bg-brand/5 hover:text-brand transition-colors cursor-default shadow-sm">Typography</span>
                                <span class="px-4 py-2.5 bg-slate-50 text-slate-700 rounded-xl font-bold text-xs border border-slate-100 hover:border-brand/30 hover:bg-brand/5 hover:text-brand transition-colors cursor-default shadow-sm">Colors</span>
                                <span class="px-4 py-2.5 bg-slate-50 text-slate-700 rounded-xl font-bold text-xs border border-slate-100 hover:border-brand/30 hover:bg-brand/5 hover:text-brand transition-colors cursor-default shadow-sm">Guidelines</span>
                            </div>
                        </div>
                    </div>

                    <!-- Medium Card (2 columns wide) -->
                    <div class="md:col-span-2 rounded-[2rem] bg-gradient-to-br from-[#f8faff] to-[#eff4ff] border border-blue-100 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.02)] p-8 md:p-10 relative group hover:shadow-xl transition-all duration-300">
                        <!-- Wrapper to contain background pattern within rounded corners -->
                        <div class="absolute inset-0 rounded-[2rem] overflow-hidden pointer-events-none">
                            <div class="absolute top-0 right-0 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMSIgZmlsbD0icmdiYSgzNywgOTksIDIzNSwgMC4wNSkiLz48L3N2Zz4=')] opacity-60"></div>
                        </div>
                        <div class="relative z-10 h-full flex flex-col md:flex-row items-center gap-10">
                            <div class="flex-1 text-center md:text-left">
                                <h3 class="text-2xl md:text-3xl font-bold text-navy mb-4">UI/UX Design</h3>
                                <p class="text-slate-600 leading-relaxed">Conversion-focused, story-driven UI/UX that mirrors your brand's ambition and delivers bespoke digital experiences.</p>
                            </div>
                            <div class="shrink-0 relative group-hover:rotate-6 transition-transform duration-700 ease-out">
                                <div class="w-36 h-36 bg-white rounded-[2rem] shadow-xl flex items-center justify-center border border-slate-100/50 p-5 transform -rotate-3 group-hover:rotate-0 transition-transform duration-500">
                                    <div class="w-full h-full bg-gradient-to-tr from-brand via-[#3b82f6] to-[#818cf8] rounded-[1.2rem] shadow-inner"></div>
                                </div>
                                <div class="absolute -top-4 -right-4 w-14 h-14 bg-white rounded-full shadow-lg flex items-center justify-center transform scale-90 group-hover:scale-110 transition-transform duration-500 delay-100">
                                    <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Medium Card (2 columns wide) - Custom Software -->
                    <div class="md:col-span-2 rounded-[2rem] bg-slate-900 border border-slate-800 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.2)] p-8 md:p-10 relative group hover:shadow-2xl hover:border-slate-700 transition-all duration-300 overflow-hidden text-white" data-aos="fade-up">
                        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMSIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjAyKSIvPjwvc3ZnPg==')]"></div>
                        <div class="absolute top-0 right-0 w-64 h-64 bg-brand/20 blur-[80px] rounded-full group-hover:bg-brand/30 transition-all"></div>
                        
                        <div class="relative z-10 h-full flex flex-col md:flex-row items-center gap-10">
                            <div class="flex-1 text-center md:text-left">
                                <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">Enterprise Custom Software</h3>
                                <p class="text-slate-400 leading-relaxed">We build robust, highly scalable ERP systems and custom software tailored to manage complex business logic and operations.</p>
                            </div>
                            
                            <!-- Faux Server/Database UI -->
                            <div class="shrink-0 relative group-hover:-translate-y-2 transition-transform duration-500">
                                <div class="flex flex-col gap-3">
                                    <div class="w-40 h-10 bg-slate-800/80 backdrop-blur rounded-xl border border-slate-700 flex items-center px-4 shadow-lg">
                                        <div class="w-2 h-2 rounded-full bg-green-400 mr-3 animate-pulse"></div>
                                        <div class="w-16 h-2 bg-slate-600 rounded-full"></div>
                                    </div>
                                    <div class="w-40 h-10 bg-slate-800/80 backdrop-blur rounded-xl border border-slate-700 flex items-center px-4 shadow-lg ml-6 group-hover:ml-4 transition-all duration-300">
                                        <div class="w-2 h-2 rounded-full bg-brand mr-3"></div>
                                        <div class="w-12 h-2 bg-slate-600 rounded-full"></div>
                                    </div>
                                    <div class="w-40 h-10 bg-slate-800/80 backdrop-blur rounded-xl border border-slate-700 flex items-center px-4 shadow-lg ml-12 group-hover:ml-8 transition-all duration-300">
                                        <div class="w-2 h-2 rounded-full bg-purple-400 mr-3"></div>
                                        <div class="w-20 h-2 bg-slate-600 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Small Card (1 column wide) - AI Automations -->
                    <div class="rounded-[2rem] bg-gradient-to-br from-indigo-50 to-purple-50 border border-indigo-100 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.02)] p-8 overflow-hidden relative group hover:shadow-xl hover:border-indigo-200 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                        <div class="relative z-10 h-full flex flex-col">
                            <h3 class="text-2xl font-bold text-navy mb-3">AI Automations</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-auto">Streamline workflows and cut operational costs with intelligent AI-driven automation.</p>
                            
                            <!-- Faux AI Node UI -->
                            <div class="mt-8 flex justify-center items-center h-32 relative">
                                <!-- Center core -->
                                <div class="w-12 h-12 bg-indigo-600 rounded-full shadow-[0_0_30px_rgba(79,70,229,0.5)] flex items-center justify-center z-10 group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10H12V2z"></path><path d="M21.18 8.02c-1-2.3-2.85-4.17-5.16-5.18"></path><path d="M12 12l9.39-2.22"></path><path d="M12 12L2.61 9.78"></path></svg>
                                </div>
                                <!-- Orbiting nodes -->
                                <div class="absolute w-24 h-24 border border-indigo-200 rounded-full animate-[spin_10s_linear_infinite]">
                                    <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-purple-400 rounded-full shadow-md"></div>
                                </div>
                                <div class="absolute w-32 h-32 border border-indigo-100 rounded-full animate-[spin_15s_linear_infinite_reverse]">
                                    <div class="absolute -bottom-1.5 left-1/2 -translate-x-1/2 w-3 h-3 bg-blue-400 rounded-full shadow-md"></div>
                                    <div class="absolute top-1/2 -left-1.5 -translate-y-1/2 w-3 h-3 bg-brand rounded-full shadow-md"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>



        <!-- Technologies We Use -->
        <section class="py-24 bg-white border-b border-slate-100 overflow-hidden relative">
            <style>
                @keyframes scroll {
                    0% { transform: translateX(0); }
                    100% { transform: translateX(calc(-50% - 0.75rem)); }
                }
                .animate-scroll {
                    animation: scroll 40s linear infinite;
                }
                .animate-scroll-reverse {
                    animation: scroll 45s linear infinite reverse;
                }
                .animate-scroll:hover, .animate-scroll-reverse:hover {
                    animation-play-state: paused;
                }
                .hide-scrollbar::-webkit-scrollbar { display: none; }
                .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
            </style>
            
            <div class="max-w-7xl mx-auto px-6 mb-16">
                <div class="text-center" data-aos="fade-up">
                    <p class="text-sm font-bold text-brand uppercase tracking-widest mb-2">Technologies We Use</p>
                    <h2 class="text-3xl md:text-5xl font-bold text-navy">Built on modern foundations.</h2>
                </div>
            </div>
            
                        <!-- Marquee Container -->
            <div class="w-full relative flex flex-col gap-6 hide-scrollbar overflow-hidden">
                <!-- Fade edges -->
                <div class="absolute left-0 top-0 bottom-0 w-24 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
                <div class="absolute right-0 top-0 bottom-0 w-24 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>
                
                <!-- Row 1 -->
                <div class="flex animate-scroll w-max gap-6 px-6 py-8">
                    <!-- Set 1 (14 items) -->
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/figma/figma-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Figma">
                        <span class="text-sm font-bold text-navy">Figma</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nodejs/nodejs-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Node.js">
                        <span class="text-sm font-bold text-navy">Node.js</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/amazonwebservices/amazonwebservices-original-wordmark.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="AWS">
                        <span class="text-sm font-bold text-navy">AWS</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-brand rounded-2xl shadow-md flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/typescript/typescript-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="TypeScript">
                        <span class="text-sm font-bold text-navy">TypeScript</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vuejs/vuejs-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Vue.js">
                        <span class="text-sm font-bold text-navy">Vue.js</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Laravel">
                        <span class="text-sm font-bold text-navy">Laravel</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="PHP">
                        <span class="text-sm font-bold text-slate-500">PHP</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/postgresql/postgresql-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="PostgreSQL">
                        <span class="text-sm font-bold text-navy">PostgreSQL</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/redis/redis-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Redis">
                        <span class="text-sm font-bold text-navy">Redis</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mongodb/mongodb-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="MongoDB">
                        <span class="text-sm font-bold text-navy">MongoDB</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/graphql/graphql-plain.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="GraphQL">
                        <span class="text-sm font-bold text-navy">GraphQL</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/firebase/firebase-plain.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Firebase">
                        <span class="text-sm font-bold text-navy">Firebase</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/android/android-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Android">
                        <span class="text-sm font-bold text-navy">Android</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/apple/apple-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Apple">
                        <span class="text-sm font-bold text-navy">Apple</span>
                    </div>

                    <!-- Set 2 (Duplicate of Set 1 for seamless scroll) -->
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/figma/figma-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Figma">
                        <span class="text-sm font-bold text-navy">Figma</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nodejs/nodejs-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Node.js">
                        <span class="text-sm font-bold text-navy">Node.js</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/amazonwebservices/amazonwebservices-original-wordmark.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="AWS">
                        <span class="text-sm font-bold text-navy">AWS</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-brand rounded-2xl shadow-md flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/typescript/typescript-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="TypeScript">
                        <span class="text-sm font-bold text-navy">TypeScript</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vuejs/vuejs-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Vue.js">
                        <span class="text-sm font-bold text-navy">Vue.js</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Laravel">
                        <span class="text-sm font-bold text-navy">Laravel</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="PHP">
                        <span class="text-sm font-bold text-slate-500">PHP</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/postgresql/postgresql-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="PostgreSQL">
                        <span class="text-sm font-bold text-navy">PostgreSQL</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/redis/redis-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Redis">
                        <span class="text-sm font-bold text-navy">Redis</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mongodb/mongodb-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="MongoDB">
                        <span class="text-sm font-bold text-navy">MongoDB</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/graphql/graphql-plain.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="GraphQL">
                        <span class="text-sm font-bold text-navy">GraphQL</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/firebase/firebase-plain.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Firebase">
                        <span class="text-sm font-bold text-navy">Firebase</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/android/android-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Android">
                        <span class="text-sm font-bold text-navy">Android</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/apple/apple-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Apple">
                        <span class="text-sm font-bold text-navy">Apple</span>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="flex animate-scroll-reverse w-max gap-6 px-6 py-8">
                    <!-- Set 1 (14 items) -->
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/react/react-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="React">
                        <span class="text-sm font-bold text-navy">React</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Tailwind">
                        <span class="text-sm font-bold text-navy">Tailwind</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="MySQL">
                        <span class="text-sm font-bold text-navy">MySQL</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/docker/docker-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Docker">
                        <span class="text-sm font-bold text-navy">Docker</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="JavaScript">
                        <span class="text-sm font-bold text-navy">JavaScript</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/python/python-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Python">
                        <span class="text-sm font-bold text-navy">Python</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/github/github-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="GitHub">
                        <span class="text-sm font-bold text-navy">GitHub</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/angularjs/angularjs-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Angular">
                        <span class="text-sm font-bold text-navy">Angular</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/svelte/svelte-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Svelte">
                        <span class="text-sm font-bold text-navy">Svelte</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/gitlab/gitlab-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="GitLab">
                        <span class="text-sm font-bold text-navy">GitLab</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/webpack/webpack-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Webpack">
                        <span class="text-sm font-bold text-navy">Webpack</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/kubernetes/kubernetes-plain.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Kubernetes">
                        <span class="text-sm font-bold text-navy">Kubernetes</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nginx/nginx-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="NGINX">
                        <span class="text-sm font-bold text-navy">NGINX</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/swift/swift-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Swift">
                        <span class="text-sm font-bold text-navy">Swift</span>
                    </div>

                    <!-- Set 2 (Duplicate of Set 1 for seamless scroll) -->
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/react/react-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="React">
                        <span class="text-sm font-bold text-navy">React</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Tailwind">
                        <span class="text-sm font-bold text-navy">Tailwind</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="MySQL">
                        <span class="text-sm font-bold text-navy">MySQL</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/docker/docker-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Docker">
                        <span class="text-sm font-bold text-navy">Docker</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="JavaScript">
                        <span class="text-sm font-bold text-navy">JavaScript</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/python/python-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Python">
                        <span class="text-sm font-bold text-navy">Python</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/github/github-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="GitHub">
                        <span class="text-sm font-bold text-navy">GitHub</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/angularjs/angularjs-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Angular">
                        <span class="text-sm font-bold text-navy">Angular</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/svelte/svelte-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Svelte">
                        <span class="text-sm font-bold text-navy">Svelte</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/gitlab/gitlab-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="GitLab">
                        <span class="text-sm font-bold text-navy">GitLab</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/webpack/webpack-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Webpack">
                        <span class="text-sm font-bold text-navy">Webpack</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/kubernetes/kubernetes-plain.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Kubernetes">
                        <span class="text-sm font-bold text-navy">Kubernetes</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nginx/nginx-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="NGINX">
                        <span class="text-sm font-bold text-navy">NGINX</span>
                    </div>
                    <div class="w-[140px] h-[140px] shrink-0 bg-white border border-slate-100 rounded-2xl shadow-sm flex flex-col items-center justify-center gap-3 group hover:-translate-y-2 hover:shadow-lg hover:border-brand/30 transition-all duration-300 cursor-pointer">
                        <img loading="lazy" src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/swift/swift-original.svg" class="w-12 h-12 group-hover:scale-110 transition-transform duration-300" alt="Swift">
                        <span class="text-sm font-bold text-navy">Swift</span>
                    </div>
                </div>
            </div>
        </section>

        
        <!-- Why Choose Us -->
        <section id="why-us" class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid lg:grid-cols-12 gap-16 lg:gap-12 items-start">
                    
                    <!-- Left: Sticky Header -->
                    <div class="lg:col-span-5 lg:sticky lg:top-32" data-aos="fade-right">
                        <p class="text-sm font-bold text-brand uppercase tracking-widest mb-2">Why Grovixo</p>
                        <h2 class="text-4xl md:text-5xl font-bold text-navy leading-tight mb-6">Not just another <em class="serif text-brand">agency.</em></h2>
                        <p class="text-slate-500 text-lg leading-relaxed mb-8 max-w-md">We combine high-end aesthetics with robust engineering to deliver digital products that outperform the competition. Here is how we do it differently.</p>
                        <a href="about.php" class="inline-flex items-center justify-center h-12 px-8 rounded-full bg-navy text-white font-bold hover:bg-brand transition-colors duration-300 shadow-lg shadow-navy/20">Learn about our culture</a>
                    </div>
                    
                    <!-- Right: Vertical Feature List -->
                    <div class="lg:col-span-7 flex flex-col gap-12 pb-24 relative">
                        
                        <!-- Feature 1 -->
                        <div class="p-10 md:p-12 rounded-3xl bg-slate-50 border border-slate-100 transition-all shadow-[0_-10px_40px_rgba(0,0,0,0.05)] group sticky top-[120px] z-10 min-h-[400px] flex flex-col justify-center">
                            <div class="flex flex-row justify-between items-center mb-6 gap-4">
                                <h3 class="text-2xl md:text-3xl font-bold text-navy">Pixel-Perfect Design</h3>
                                <div class="w-14 h-14 shrink-0 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-brand shadow-sm group-hover:bg-brand group-hover:text-white transition-all duration-300">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                </div>
                            </div>
                            <p class="text-slate-500 text-xl leading-relaxed">We obsess over every detail, ensuring your brand looks premium and functions flawlessly across all devices. We do not settle for "good enough" when perfection is possible.</p>
                        </div>
                        
                        <!-- Feature 2 -->
                        <div class="p-10 md:p-12 rounded-3xl bg-white border border-slate-100 transition-all shadow-[0_-10px_40px_rgba(0,0,0,0.05)] group sticky top-[150px] z-20 min-h-[400px] flex flex-col justify-center">
                            <div class="flex flex-row justify-between items-center mb-6 gap-4">
                                <h3 class="text-2xl md:text-3xl font-bold text-navy">Lightning Fast Development</h3>
                                <div class="w-14 h-14 shrink-0 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center text-brand shadow-sm group-hover:bg-brand group-hover:text-white transition-all duration-300">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path></svg>
                                </div>
                            </div>
                            <p class="text-slate-500 text-xl leading-relaxed">Using modern stacks like React, Next.js, and specialized caching strategies, we build digital experiences that load instantly and perform at massive scale without breaking a sweat.</p>
                        </div>
                        
                        <!-- Feature 3 -->
                        <div class="p-10 md:p-12 rounded-3xl bg-slate-900 border border-slate-800 transition-all shadow-[0_-10px_40px_rgba(0,0,0,0.2)] group sticky top-[180px] z-30 min-h-[400px] flex flex-col justify-center text-white">
                            <div class="flex flex-row justify-between items-center mb-6 gap-4">
                                <h3 class="text-2xl md:text-3xl font-bold text-white">Strategic Revenue Growth</h3>
                                <div class="w-14 h-14 shrink-0 rounded-2xl bg-slate-800 border border-slate-700 flex items-center justify-center text-brand shadow-sm group-hover:bg-brand group-hover:text-white group-hover:border-brand transition-all duration-300">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="20" x2="12" y2="10"></line><line x1="18" y1="20" x2="18" y2="4"></line><line x1="6" y1="20" x2="6" y2="16"></line></svg>
                                </div>
                            </div>
                            <p class="text-slate-400 text-xl leading-relaxed">We don't just hand off design files. We design holistic systems engineered specifically to increase your conversion rates, minimize churn, and drive actual revenue.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Work Showcase -->
        <section class="py-24 bg-white border-t border-slate-100 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16" data-aos="fade-up">
                    <p class="text-sm font-bold text-brand uppercase tracking-widest mb-2">Featured Work</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-navy">Transforming ideas into reality.</h2>
                </div>
            </div>

            <!-- Auto-scrolling Marquee Container -->
            <div class="relative w-full overflow-hidden pb-12 flex">
                <style>
                    @keyframes featuredMarquee {
                        0% { transform: translateX(0); }
                        100% { transform: translateX(-50%); }
                    }
                    .animate-featured-marquee {
                        animation: featuredMarquee 40s linear infinite;
                        width: max-content;
                    }
                    .animate-featured-marquee:hover {
                        animation-play-state: paused;
                    }
                </style>
                
                <!-- Fade overlays for edges -->
                <div class="absolute top-0 bottom-12 left-0 w-24 md:w-48 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
                <div class="absolute top-0 bottom-12 right-0 w-24 md:w-48 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>

                <div class="flex gap-8 px-4 animate-featured-marquee">
                    <?php
                    // Array of projects for the marquee
                    $projects = [
                        [
                            'url' => 'https://beeblissbeauty.com',
                            'img' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                            'tag' => 'E-Commerce',
                            'tagColor' => 'bg-brand',
                            'title' => 'beeblissbeauty.com',
                            'desc' => 'Premium cosmetics e-commerce platform.'
                        ],
                        [
                            'url' => 'https://theboyz.in',
                            'img' => 'https://grovixo.com/assets/The%20Boyz-E6BW5ekp.webp',
                            'tag' => 'Branding',
                            'tagColor' => 'bg-indigo-500',
                            'title' => 'The Boyz™',
                            'desc' => 'Premium streetwear brand identity.'
                        ],
                        [
                            'url' => 'https://maamart.com',
                            'img' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1200&q=80',
                            'tag' => 'Marketplace',
                            'tagColor' => 'bg-orange-500',
                            'title' => 'Maamart.com',
                            'desc' => 'Next-gen online grocery & retail marketplace.'
                        ],
                        [
                            'url' => '#',
                            'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80',
                            'tag' => 'Custom ERP',
                            'tagColor' => 'bg-emerald-500',
                            'title' => 'Enterprise ERP',
                            'desc' => 'Bespoke resource planning and management.'
                        ],
                        [
                            'url' => '#',
                            'img' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80',
                            'tag' => 'Custom Software',
                            'tagColor' => 'bg-blue-600',
                            'title' => 'Data Analytics Suite',
                            'desc' => 'Custom data processing and visualization.'
                        ],
                        [
                            'url' => '#',
                            'img' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=80',
                            'tag' => 'App Development',
                            'tagColor' => 'bg-cyan-500',
                            'title' => 'HealthSync AI',
                            'desc' => 'Next-generation patient monitoring ecosystem.'
                        ]
                    ];
                    
                    // Duplicate array for seamless infinite loop
                    $loopProjects = array_merge($projects, $projects);
                    
                    foreach($loopProjects as $p):
                    ?>
                    <a href="<?= $p['url'] ?>" target="_blank" rel="noopener noreferrer" class="w-[85vw] sm:w-[450px] md:w-[550px] shrink-0 group block relative rounded-[2rem] overflow-hidden border border-slate-200/50 aspect-[4/3] bg-slate-900 shadow-sm hover:shadow-2xl transition-all duration-500">
                        <div class="absolute inset-0 flex items-center justify-center p-0">
                            <img loading="lazy" src="<?= $p['img'] ?>" alt="<?= htmlspecialchars($p['title']) ?>" class="w-full h-full object-cover opacity-90 transition-transform duration-700 group-hover:scale-110">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-navy/95 via-navy/40 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-8 sm:p-10 transform transition-transform duration-500 group-hover:-translate-y-2">
                            <div>
                                <span class="inline-block px-4 py-1.5 <?= $p['tagColor'] ?> text-white text-[11px] uppercase tracking-wider font-bold rounded-full mb-4 shadow-sm"><?= $p['tag'] ?></span>
                                <h3 class="text-2xl sm:text-3xl font-bold text-white mb-3 leading-tight"><?= $p['title'] ?></h3>
                                <p class="text-slate-300 text-sm sm:text-base font-medium max-w-sm"><?= $p['desc'] ?></p>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mt-4">
                    <a href="work.php" class="btn-primary inline-flex">View All Case Studies</a>
                </div>
            </div>
        </section>

        <!-- By the Numbers -->
        <section class="py-24 bg-navy text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMSIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvc3ZnPg==')]"></div>
            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-white/10" data-aos="fade-up">
                    <div class="px-4">
                        <div class="text-4xl md:text-6xl font-display font-extrabold text-brand mb-2">50+</div>
                        <div class="text-sm text-slate-300 font-bold uppercase tracking-widest">Projects Delivered</div>
                    </div>
                    <div class="px-4">
                        <div class="text-4xl md:text-6xl font-display font-extrabold text-brand mb-2">100%</div>
                        <div class="text-sm text-slate-300 font-bold uppercase tracking-widest">In-house Team</div>
                    </div>
                    <div class="px-4">
                        <div class="text-4xl md:text-6xl font-display font-extrabold text-brand mb-2">4.9</div>
                        <div class="text-sm text-slate-300 font-bold uppercase tracking-widest">Average Rating</div>
                    </div>
                    <div class="px-4">
                        <div class="text-4xl md:text-6xl font-display font-extrabold text-brand mb-2">5+</div>
                        <div class="text-sm text-slate-300 font-bold uppercase tracking-widest">Years Experience</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Process Section -->
        <section class="py-24 bg-white border-b border-slate-100 overflow-hidden relative">
            <div class="max-w-7xl mx-auto px-6 mb-16">
                <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
                    <p class="text-sm font-bold text-brand uppercase tracking-widest mb-2">How We Work</p>
                    <h2 class="text-3xl md:text-5xl font-bold text-navy">A proven framework for <em class="serif text-brand">digital success.</em></h2>
                </div>
            </div>
            
            <div class="max-w-7xl mx-auto px-6 relative">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10 relative z-10">
                    
                    <!-- Step 1 -->
                    <div class="group h-full" data-aos="fade-up">
                        <div class="relative pt-8 h-full">
                            <!-- Overlapping Number Node -->
                            <div class="absolute top-0 left-8 md:left-10 w-16 h-16 rounded-full border-[6px] border-white bg-blue-50 text-brand font-bold text-xl flex items-center justify-center shadow-sm group-hover:bg-brand group-hover:text-white group-hover:scale-110 transition-all duration-300 z-20">
                                1
                            </div>
                            <!-- Card -->
                            <div class="bg-white border border-slate-100 rounded-3xl p-8 pt-10 shadow-[0_4px_20px_rgba(0,0,0,0.03)] group-hover:shadow-xl group-hover:-translate-y-2 group-hover:border-brand/30 transition-all duration-300 relative z-10 overflow-hidden h-full flex flex-col">
                                <h3 class="text-xl font-bold text-navy mb-4 relative z-10">Discovery & Strategy</h3>
                                <p class="text-slate-500 leading-relaxed relative z-10 flex-grow">We deep dive into your business goals, target audience, and market landscape to create a robust foundation for the project.</p>
                                
                                <!-- Decorative watermark number -->
                                <div class="absolute -bottom-6 -right-2 text-[8rem] font-black text-slate-50 leading-none select-none pointer-events-none group-hover:text-slate-100 transition-colors duration-300 z-0">
                                    1
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="group h-full" data-aos="fade-up" data-aos-delay="100">
                        <div class="relative pt-8 h-full">
                            <!-- Overlapping Number Node -->
                            <div class="absolute top-0 left-8 md:left-10 w-16 h-16 rounded-full border-[6px] border-white bg-blue-50 text-brand font-bold text-xl flex items-center justify-center shadow-sm group-hover:bg-brand group-hover:text-white group-hover:scale-110 transition-all duration-300 z-20">
                                2
                            </div>
                            <!-- Card -->
                            <div class="bg-white border border-slate-100 rounded-3xl p-8 pt-10 shadow-[0_4px_20px_rgba(0,0,0,0.03)] group-hover:shadow-xl group-hover:-translate-y-2 group-hover:border-brand/30 transition-all duration-300 relative z-10 overflow-hidden h-full flex flex-col">
                                <h3 class="text-xl font-bold text-navy mb-4 relative z-10">Design & Prototyping</h3>
                                <p class="text-slate-500 leading-relaxed relative z-10 flex-grow">Our designers craft stunning visual identities and interactive wireframes, ensuring a flawless user experience before writing any code.</p>
                                
                                <!-- Decorative watermark number -->
                                <div class="absolute -bottom-6 -right-2 text-[8rem] font-black text-slate-50 leading-none select-none pointer-events-none group-hover:text-slate-100 transition-colors duration-300 z-0">
                                    2
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="group h-full" data-aos="fade-up" data-aos-delay="200">
                        <div class="relative pt-8 h-full">
                            <!-- Overlapping Number Node -->
                            <div class="absolute top-0 left-8 md:left-10 w-16 h-16 rounded-full border-[6px] border-white bg-brand text-white font-bold text-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-all duration-300 z-20">
                                3
                            </div>
                            <!-- Card -->
                            <div class="bg-gradient-to-br from-brand to-blue-700 border border-brand rounded-3xl p-8 pt-10 shadow-lg group-hover:shadow-2xl transition-all duration-300 group-hover:-translate-y-2 relative z-10 overflow-hidden h-full flex flex-col">
                                <h3 class="text-xl font-bold text-white mb-4 relative z-10">Development & Launch</h3>
                                <p class="text-blue-100 leading-relaxed relative z-10 flex-grow">We translate approved designs into fast, scalable, and secure digital products, followed by a smooth and monitored launch.</p>
                                
                                <!-- Decorative watermark number (faint white) -->
                                <div class="absolute -bottom-6 -right-2 text-[8rem] font-black text-white/5 leading-none select-none pointer-events-none group-hover:text-white/10 transition-colors duration-300 z-0">
                                    3
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section id="testimonials" class="py-24 bg-slate-50 border-b border-slate-100 grid-bg">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
                    <p class="text-sm font-bold text-brand uppercase tracking-widest mb-2">Testimonials</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-navy">Don't just take our word for it.</h2>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Summary Card -->
                    <div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-aos="fade-up">
                        <div class="flex items-center text-orange-500 gap-1 mb-4">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        </div>
                        <h3 class="text-6xl font-bold text-navy mb-3 tracking-tight">4.8</h3>
                        <p class="text-lg font-medium text-slate-700">500+ reviews</p>
                    </div>

                    <!-- Review 1 -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                        <svg class="w-10 h-10 text-slate-200/80 mb-6" fill="currentColor" viewBox="0 0 32 32"><path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/></svg>
                        <p class="text-lg text-slate-800 mb-8 font-medium leading-relaxed">Grovixo delivered our project with incredible speed and a strong design sense. Their attention to detail transformed our web presence completely.</p>
                        <div class="mt-auto flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-brand/10 text-brand flex items-center justify-center font-bold text-xl font-display uppercase shadow-inner border border-brand/20">P</div>
                            <div>
                                <h4 class="font-bold text-navy text-sm">Priya Sharma</h4>
                                <p class="text-xs text-slate-500 font-medium">VP of Marketing</p>
                            </div>
                        </div>
                    </div>

                    <!-- Review 2 -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                        <svg class="w-10 h-10 text-slate-200/80 mb-6" fill="currentColor" viewBox="0 0 32 32"><path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/></svg>
                        <p class="text-lg text-slate-800 mb-8 font-medium leading-relaxed">The Grovixo team quickly understood our vision. They transformed our early ideas into a clean, scalable custom ecosystem that perfectly fit our needs.</p>
                        <div class="mt-auto flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-emerald-400/10 text-emerald-500 flex items-center justify-center font-bold text-xl font-display uppercase shadow-inner border border-emerald-400/20">R</div>
                            <div>
                                <h4 class="font-bold text-navy text-sm">Rohan Desai</h4>
                                <p class="text-xs text-slate-500 font-medium">Startup Founder</p>
                            </div>
                        </div>
                    </div>

                    <!-- Review 3 -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-aos="fade-up">
                        <svg class="w-10 h-10 text-slate-200/80 mb-6" fill="currentColor" viewBox="0 0 32 32"><path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/></svg>
                        <p class="text-lg text-slate-800 mb-8 font-medium leading-relaxed">Every revision with Grovixo pushed our product further. They handled feedback clearly and delivered bespoke features incredibly fast every single time.</p>
                        <div class="mt-auto flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-blue-400/10 text-blue-500 flex items-center justify-center font-bold text-xl font-display uppercase shadow-inner border border-blue-400/20">A</div>
                            <div>
                                <h4 class="font-bold text-navy text-sm">Ananya Patel</h4>
                                <p class="text-xs text-slate-500 font-medium">Brand Strategist</p>
                            </div>
                        </div>
                    </div>

                    <!-- Review 4 -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                        <svg class="w-10 h-10 text-slate-200/80 mb-6" fill="currentColor" viewBox="0 0 32 32"><path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/></svg>
                        <p class="text-lg text-slate-800 mb-8 font-medium leading-relaxed">From performance optimization to UI layout, Grovixo ensured every detail felt polished, intentional, and carefully crafted for our enterprise.</p>
                        <div class="mt-auto flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-purple-400/10 text-purple-500 flex items-center justify-center font-bold text-xl font-display uppercase shadow-inner border border-purple-400/20">V</div>
                            <div>
                                <h4 class="font-bold text-navy text-sm">Vikram Singh</h4>
                                <p class="text-xs text-slate-500 font-medium">Tech Lead</p>
                            </div>
                        </div>
                    </div>

                    <!-- Review 5 -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                        <svg class="w-10 h-10 text-slate-200/80 mb-6" fill="currentColor" viewBox="0 0 32 32"><path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/></svg>
                        <p class="text-lg text-slate-800 mb-8 font-medium leading-relaxed">Grovixo is a highly collaborative agency. Their strong focus on quality, clarity, and building scalable apps has been a game-changer for us.</p>
                        <div class="mt-auto flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-orange-400/10 text-orange-500 flex items-center justify-center font-bold text-xl font-display uppercase shadow-inner border border-orange-400/20">N</div>
                            <div>
                                <h4 class="font-bold text-navy text-sm">Neha Gupta</h4>
                                <p class="text-xs text-slate-500 font-medium">Product Manager</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Insights / Blog -->
   

    </main>

<script>
// Canvas Particle Globe Background for Hero
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('hero-particle-globe');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    
    let width, height;
    function resize() {
        width = canvas.width = window.innerWidth;
        height = canvas.height = document.querySelector('.min-h-screen').offsetHeight || window.innerHeight;
    }
    window.addEventListener('resize', resize);
    resize();
    
    // Create dense particle field
    const particles = [];
    const numParticles = 8000; // Increased for dense ring
    
    // Ring properties
    const ringRadius = 500;
    const ringThickness = 250;
    
    for (let i = 0; i < numParticles; i++) {
        // Random angle
        const angle = Math.random() * Math.PI * 2;
        // Distribute heavily around the core edge
        const distance = (Math.random() > 0.3) 
            ? ringRadius + (Math.random() - 0.5) * 60 // Core dense band
            : ringRadius + (Math.random() - 0.5) * ringThickness; // Outer scatter
            
        // 3D coordinates on a flat disc
        const x3d = Math.cos(angle) * distance;
        const z3d = Math.sin(angle) * distance;
        
        // Very slight vertical variance for thickness
        const y3d = (Math.random() - 0.5) * 40;
            
        particles.push({
            x3d, y3d, z3d,
            // Core particles are slightly larger
            size: Math.random() > 0.7 ? 1.8 : 0.8,
            speed: 0.0003 + (Math.random() * 0.0005)
        });
    }
    
    // Mouse tracking
    let mouse = { x: -1000, y: -1000 };
    window.addEventListener('mousemove', (e) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
    });
    window.addEventListener('mouseleave', () => {
        mouse.x = -1000;
        mouse.y = -1000;
    });
    
    let globalTime = 0;

    function animate() {
        ctx.clearRect(0, 0, width, height);
        globalTime += 0.002;
        
        // Draw mouse glow
        if (mouse.x > -100 && mouse.y > -100) {
            const gradient = ctx.createRadialGradient(mouse.x, mouse.y, 0, mouse.x, mouse.y, 400);
            gradient.addColorStop(0, 'rgba(255, 255, 255, 0.08)'); 
            gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');
            ctx.globalAlpha = 1;
            ctx.fillStyle = gradient;
            ctx.fillRect(0, 0, width, height);
        }
        
        const cx = width / 2;
        const cy = height / 2 + (height * 0.15); 
        
        // Scale factor based on screen size
        const scale = Math.min(width, height) / 1000;
        
        // Tilt the disc (rotate around X axis)
        const tiltX = -Math.PI * 0.40; // Tilt back
        
        particles.forEach(p => {
            // Rotate around Y axis over time
            const angle = Math.atan2(p.z3d, p.x3d) + p.speed;
            const dist = Math.sqrt(p.x3d*p.x3d + p.z3d*p.z3d);
            
            p.x3d = Math.cos(angle) * dist;
            p.z3d = Math.sin(angle) * dist;
            
            // Apply Y-axis rotation (globalTime)
            const rx = p.x3d * Math.cos(globalTime) - p.z3d * Math.sin(globalTime);
            const rz = p.x3d * Math.sin(globalTime) + p.z3d * Math.cos(globalTime);
            const ry = p.y3d;
            
            // Apply X-axis tilt
            const finalX = rx;
            const finalY = ry * Math.cos(tiltX) - rz * Math.sin(tiltX);
            const finalZ = ry * Math.sin(tiltX) + rz * Math.cos(tiltX);
            
            // Perspective projection
            const fov = 1000;
            const zOffset = 800; // Move it back
            const z = finalZ + zOffset;
            
            if (z > 0) {
                const perspective = fov / z;
                let x = cx + finalX * perspective * scale;
                let y = cy + finalY * perspective * scale;
                
                // Depth calculation for opacity
                let opacity = Math.min(1, Math.max(0, (600 - finalZ) / 800));
                opacity = Math.pow(opacity, 1.8); // boost contrast
                
                // Fade out the bottom half so it blends smoothly into the background
                if (y > cy) {
                    const fadeDist = y - cy;
                    opacity -= (fadeDist / (150 * scale));
                }
                
                // Mouse interaction
                const dx = x - mouse.x;
                const dy = y - mouse.y;
                const mDist = Math.sqrt(dx * dx + dy * dy);
                
                let drawX = x;
                let drawY = y;
                let pSize = p.size * perspective * 1.2;
                
                if (mDist < 200) {
                    const force = (200 - mDist) / 200;
                    drawX += (dx / mDist) * force * 15;
                    drawY += (dy / mDist) * force * 15;
                    opacity = Math.min(1, opacity + force * 0.8);
                    pSize += force * 2.5;
                }
                
                if (opacity > 0) {
                    ctx.globalAlpha = opacity;
                    ctx.fillStyle = '#ffffff';
                    ctx.beginPath();
                    ctx.arc(drawX, drawY, pSize, 0, Math.PI * 2);
                    ctx.fill();
                }
            }
        });
        
        requestAnimationFrame(animate);
    }
    animate();
});
</script>

<?php include 'includes/footer.php'; ?>
