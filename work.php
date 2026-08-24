<?php include 'includes/header.php'; ?>

<main>
    <style>
        .perspective-container {
            perspective: 2000px;
        }
        .isometric-grid {
            transform: rotateX(55deg) rotateZ(-45deg) scale(1.4);
            transform-style: preserve-3d;
        }
        @keyframes scroll-up {
            0% { transform: translateY(0); }
            100% { transform: translateY(-50%); }
        }
        @keyframes scroll-down {
            0% { transform: translateY(-50%); }
            100% { transform: translateY(0); }
        }
        .animate-scroll-up {
            animation: scroll-up 40s linear infinite;
        }
        .animate-scroll-down {
            animation: scroll-down 40s linear infinite;
        }
        .grid-column {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        .grid-item {
            width: 100%;
            aspect-ratio: 16/9;
            border-radius: 1rem;
            object-fit: cover;
            box-shadow: -20px 20px 40px rgba(0, 0, 0, 0.4);
            border: 4px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.4s ease;
        }
        .grid-item:hover {
            transform: translateZ(30px);
            border-color: rgba(37, 99, 235, 0.8);
        }
    </style>

    <!-- Hero with Isometric Wall -->
    <section class="relative overflow-hidden bg-navy pt-40 pb-40 text-center flex items-center min-h-[90vh]">
        
        <!-- Isometric Background -->
        <div class="absolute inset-0 z-0 perspective-container overflow-hidden pointer-events-auto">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[180vw] md:w-[140vw] h-[250vh] isometric-grid flex gap-6 md:gap-10 opacity-40 hover:opacity-70 transition-opacity duration-1000">
                <!-- Col 1 (Scroll Up) -->
                <div class="flex-1 grid-column animate-scroll-up" style="animation-duration: 45s">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1507238692062-7937d2f9540e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <!-- Duplicate for loop -->
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1507238692062-7937d2f9540e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                </div>
                <!-- Col 2 (Scroll Down) -->
                <div class="flex-1 grid-column animate-scroll-down">
                    <img src="https://images.unsplash.com/photo-1522542550221-31fd19575a2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://grovixo.com/assets/The%20Boyz-E6BW5ekp.webp" class="grid-item bg-white object-contain p-4">
                    <img src="https://images.unsplash.com/photo-1556228578-0d85b1a4d571?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <!-- Duplicate for loop -->
                    <img src="https://images.unsplash.com/photo-1522542550221-31fd19575a2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://grovixo.com/assets/The%20Boyz-E6BW5ekp.webp" class="grid-item bg-white object-contain p-4">
                    <img src="https://images.unsplash.com/photo-1556228578-0d85b1a4d571?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                </div>
                <!-- Col 3 (Scroll Up) -->
                <div class="flex-1 grid-column animate-scroll-up hidden md:flex" style="animation-duration: 35s">
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1507238692062-7937d2f9540e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <!-- Duplicate for loop -->
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1507238692062-7937d2f9540e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="grid-item">
                </div>
            </div>
            <!-- Overlay Gradient to blend edges and make text readable -->
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,transparent_0%,#0B1121_70%)] pointer-events-none z-10"></div>
            <!-- Additional dark overlay for text contrast -->
            <div class="absolute inset-0 bg-navy/60 pointer-events-none z-10"></div>
        </div>
        
        <div class="max-w-4xl mx-auto px-6 relative z-20 pointer-events-none">
            <span class="inline-block py-1.5 px-5 rounded-full bg-brand/20 text-brand text-sm font-bold tracking-widest uppercase mb-8 border border-brand/30 shadow-lg backdrop-blur-md" data-aos="fade-down">Portfolio</span>
            <h1 class="font-display text-6xl md:text-8xl font-extrabold tracking-tight leading-[1.08] text-white mb-8 drop-shadow-2xl" data-aos="fade-up">
                Proof, <br>not promises.
            </h1>
            <p class="text-xl md:text-2xl text-slate-300 leading-relaxed mx-auto max-w-2xl mb-12 drop-shadow-lg" data-aos="fade-up" data-aos-delay="100">
                Explore our recent projects spanning across e-commerce, branding, corporate identity, and highly scalable digital platforms.
            </p>
            <div data-aos="fade-up" data-aos-delay="200" class="pointer-events-auto">
                <a href="#featured" class="inline-flex items-center justify-center h-14 px-10 rounded-full bg-white text-navy font-bold hover:bg-brand hover:text-white transition-colors duration-300 shadow-[0_10px_40px_rgba(37,99,235,0.4)] text-lg">
                    View Featured Work
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Case Study -->
    <section class="py-32 bg-navy relative overflow-hidden text-white">
        <!-- Background accents -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMSIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvc3ZnPg==')] opacity-20 pointer-events-none"></div>
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-brand/20 blur-[150px] rounded-full pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-blue-500/20 blur-[150px] rounded-full pointer-events-none -translate-x-1/3 translate-y-1/3"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-20" data-aos="fade-up">
                <p class="text-sm font-bold text-brand uppercase tracking-widest mb-4">Featured Project</p>
                <h2 class="text-4xl md:text-5xl font-bold text-white">Maa Mart E-commerce App</h2>
            </div>
            
            <div class="grid lg:grid-cols-12 gap-16 items-center">
                <div class="lg:col-span-7 relative group" data-aos="fade-right">
                    <div class="absolute inset-0 bg-gradient-to-tr from-brand to-blue-400 rounded-[2rem] transform -rotate-2 scale-[1.03] transition-transform duration-700 group-hover:rotate-0 opacity-50 blur-xl"></div>
                    <div class="relative rounded-[2rem] overflow-hidden bg-slate-900 border border-white/10 aspect-[4/3] flex items-center justify-center p-8 group-hover:border-white/20 transition-colors duration-500">
                        <img src="https://grovixo.com/assets/Maa%20Mart-BZyiBF5Q.webp" alt="Maa Mart Mockup" class="w-full h-full object-cover rounded-xl shadow-2xl transform transition-transform duration-700 group-hover:scale-105 opacity-90 group-hover:opacity-100">
                    </div>
                </div>
                
                <div class="lg:col-span-5" data-aos="fade-left">
                    <div class="flex flex-wrap gap-2 mb-8">
                        <span class="px-4 py-1.5 text-xs font-bold bg-white/10 text-white rounded-full backdrop-blur-sm border border-white/10">UI/UX</span>
                        <span class="px-4 py-1.5 text-xs font-bold bg-white/10 text-white rounded-full backdrop-blur-sm border border-white/10">Development</span>
                        <span class="px-4 py-1.5 text-xs font-bold bg-brand/20 text-brand rounded-full backdrop-blur-sm border border-brand/30">React Native</span>
                    </div>
                    
                    <h3 class="text-3xl font-bold text-white mb-6">Building a local grocery powerhouse</h3>
                    
                    <p class="text-slate-300 text-lg leading-relaxed mb-8">
                        Maa Mart came to us with a vision to digitize local grocery delivery in Vadodara. We designed and developed a complete ecosystem including a customer-facing app, a delivery partner app, and an extensive admin dashboard.
                    </p>
                    
                    <ul class="space-y-4 mb-10 text-white/90">
                        <li class="flex items-center gap-4 bg-white/5 p-4 rounded-xl border border-white/10 backdrop-blur-sm">
                            <div class="w-10 h-10 rounded-full bg-brand/20 flex items-center justify-center text-brand shrink-0">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="stroke-2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            </div>
                            <span class="font-medium text-lg">Increased conversion rate by 184%</span>
                        </li>
                        <li class="flex items-center gap-4 bg-white/5 p-4 rounded-xl border border-white/10 backdrop-blur-sm">
                            <div class="w-10 h-10 rounded-full bg-brand/20 flex items-center justify-center text-brand shrink-0">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="stroke-2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                            </div>
                            <span class="font-medium text-lg">Scaled to handle 10,000+ SKUs</span>
                        </li>
                    </ul>
                    
                    <a href="case-study" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-brand text-white rounded-full font-bold hover:bg-blue-600 transition-all duration-300 shadow-xl shadow-brand/20 hover:-translate-y-1 group">
                        Read Full Case Study
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Grid -->
    <section class="py-32 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-10">
                
                <!-- Work Item 1 -->
                <a href="https://maamart.com" target="_blank" rel="noopener noreferrer" class="group block relative rounded-[2rem] overflow-hidden bg-white shadow-sm hover:shadow-2xl transition-shadow duration-500" data-aos="fade-up">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy/90 via-navy/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <span class="absolute top-6 left-6 z-20 px-4 py-1.5 text-xs font-bold bg-white/90 text-navy rounded-full backdrop-blur-md shadow-sm border border-white/20 transform -translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">E-commerce</span>
                        <img src="https://grovixo.com/assets/Maa%20Mart-BZyiBF5Q.webp" alt="Maa Mart Mockup" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="absolute bottom-0 left-0 w-full p-8 z-20 transform translate-y-6 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 pointer-events-none">
                        <div class="text-xs font-bold text-brand uppercase tracking-widest mb-2">Web Design</div>
                        <h3 class="text-3xl font-bold text-white mb-2">Maa Mart</h3>
                        <p class="text-slate-300 text-sm leading-relaxed max-w-sm">Fresh grocery delivery platform for Vadodara — clean UX, mobile-first storefront.</p>
                    </div>
                    <!-- Default State (Hidden on Hover) -->
                    <div class="p-8 bg-white group-hover:opacity-0 transition-opacity duration-300 relative z-0">
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Web Design</div>
                        <h3 class="text-2xl font-bold text-navy mb-2">Maa Mart</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Fresh grocery delivery platform for Vadodara — clean UX, mobile-first storefront.</p>
                    </div>
                </a>

                <!-- Work Item 2 -->
                <a href="https://theboyz.in" target="_blank" rel="noopener noreferrer" class="group block relative rounded-[2rem] overflow-hidden bg-white shadow-sm hover:shadow-2xl transition-shadow duration-500 translate-y-0 md:translate-y-16" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy/90 via-navy/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <span class="absolute top-6 left-6 z-20 px-4 py-1.5 text-xs font-bold bg-white/90 text-navy rounded-full backdrop-blur-md shadow-sm border border-white/20 transform -translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">Branding</span>
                        <img src="https://grovixo.com/assets/The%20Boyz-E6BW5ekp.webp" alt="The Boyz Mockup" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="absolute bottom-0 left-0 w-full p-8 z-20 transform translate-y-6 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 pointer-events-none">
                        <div class="text-xs font-bold text-brand uppercase tracking-widest mb-2">E-commerce</div>
                        <h3 class="text-3xl font-bold text-white mb-2">The Boyz™</h3>
                        <p class="text-slate-300 text-sm leading-relaxed max-w-sm">Premium streetwear brand identity and highly converting Shopify store.</p>
                    </div>
                    <!-- Default State -->
                    <div class="p-8 bg-white group-hover:opacity-0 transition-opacity duration-300 relative z-0">
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">E-commerce</div>
                        <h3 class="text-2xl font-bold text-navy mb-2">The Boyz™</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Premium streetwear brand identity and highly converting Shopify store.</p>
                    </div>
                </a>

                <!-- Work Item 3 -->
                <a href="https://beeblissbeauty.com" target="_blank" rel="noopener noreferrer" class="group block relative rounded-[2rem] overflow-hidden bg-white shadow-sm hover:shadow-2xl transition-shadow duration-500" data-aos="fade-up">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy/90 via-navy/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <span class="absolute top-6 left-6 z-20 px-4 py-1.5 text-xs font-bold bg-white/90 text-navy rounded-full backdrop-blur-md shadow-sm border border-white/20 transform -translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">Web Design</span>
                        <img src="https://grovixo.com/assets/Beebliss%20Beauty-KS99w7Jc.webp" alt="Beebliss Beauty Mockup" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="absolute bottom-0 left-0 w-full p-8 z-20 transform translate-y-6 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 pointer-events-none">
                        <div class="text-xs font-bold text-brand uppercase tracking-widest mb-2">Booking Platform</div>
                        <h3 class="text-3xl font-bold text-white mb-2">Beebliss Beauty</h3>
                        <p class="text-slate-300 text-sm leading-relaxed max-w-sm">Salon & beauty services platform with real-time online booking and calendar sync.</p>
                    </div>
                    <!-- Default State -->
                    <div class="p-8 bg-white group-hover:opacity-0 transition-opacity duration-300 relative z-0">
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Booking Platform</div>
                        <h3 class="text-2xl font-bold text-navy mb-2">Beebliss Beauty</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Salon & beauty services platform with real-time online booking and calendar sync.</p>
                    </div>
                </a>

                <!-- Work Item 4 -->
                <a href="#" class="group block relative rounded-[2rem] overflow-hidden bg-white shadow-sm hover:shadow-2xl transition-shadow duration-500 translate-y-0 md:translate-y-16" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy/90 via-navy/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <span class="absolute top-6 left-6 z-20 px-4 py-1.5 text-xs font-bold bg-white/90 text-navy rounded-full backdrop-blur-md shadow-sm border border-white/20 transform -translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">Corporate</span>
                        <img src="https://grovixo.com/assets/Apex%20Overseas-Bw78qQww.webp" alt="Apex Overseas Mockup" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="absolute bottom-0 left-0 w-full p-8 z-20 transform translate-y-6 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 pointer-events-none">
                        <div class="text-xs font-bold text-brand uppercase tracking-widest mb-2">Corporate Identity</div>
                        <h3 class="text-3xl font-bold text-white mb-2">Apex Overseas</h3>
                        <p class="text-slate-300 text-sm leading-relaxed max-w-sm">End-to-end brand system and online presence for a major international trade firm.</p>
                    </div>
                    <!-- Default State -->
                    <div class="p-8 bg-white group-hover:opacity-0 transition-opacity duration-300 relative z-0">
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Corporate Identity</div>
                        <h3 class="text-2xl font-bold text-navy mb-2">Apex Overseas</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">End-to-end brand system and online presence for a major international trade firm.</p>
                    </div>
                </a>

            </div>
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="py-24 bg-white relative overflow-hidden border-t border-slate-100">
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <div class="w-20 h-20 bg-brand/10 rounded-full flex items-center justify-center mx-auto mb-8 text-brand" data-aos="zoom-in">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-navy mb-6 leading-tight" data-aos="fade-up">Ready to build something <br>extraordinary?</h2>
            <p class="text-xl text-slate-500 mb-10 max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">Join the visionary brands who trust Grovixo to design and develop their digital platforms.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
                <a href="contact" class="px-8 py-4 bg-navy text-white font-bold rounded-full hover:bg-brand transition-colors duration-300 shadow-xl shadow-navy/20 hover:-translate-y-1">Start a Project</a>
                <a href="services" class="px-8 py-4 bg-white text-navy font-bold rounded-full hover:bg-slate-50 transition-colors border border-slate-200">View Services</a>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
