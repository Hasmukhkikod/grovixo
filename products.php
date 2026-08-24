<?php include 'includes/header.php'; ?>

<main class="pt-32 pb-0">
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 mb-24 text-center relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-brand/5 blur-[120px] rounded-full pointer-events-none"></div>
        <div class="max-w-3xl mx-auto relative z-10">
            <span class="inline-block py-1 px-4 rounded-full bg-brand/10 text-brand text-sm font-bold tracking-widest uppercase mb-6 border border-brand/20" data-aos="fade-down">Our Products</span>
            <h1 class="text-5xl md:text-7xl font-bold text-navy leading-tight mb-8 font-display" data-aos="fade-up">
                Proprietary <span class="text-brand">Software.</span>
            </h1>
            <p class="text-xl text-slate-500 leading-relaxed max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                We don't just build for clients — we build and scale our own industry-leading enterprise products that solve complex operational challenges.
            </p>
        </div>
    </section>

    <!-- Product 1: Billing -->
    <section class="py-32 bg-slate-900 overflow-hidden relative">
        <!-- Background Ambient Glow -->
        <div class="absolute top-1/2 left-0 w-[600px] h-[600px] bg-brand/10 blur-[150px] rounded-full pointer-events-none -translate-x-1/2 -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Image Side -->
                <div class="relative group" data-aos="fade-right">
                    <div class="absolute inset-0 bg-brand/20 rounded-[3rem] transform -rotate-3 scale-[1.02] transition-transform duration-700 group-hover:rotate-0 blur-xl"></div>
                    <div class="relative bg-white/5 backdrop-blur-2xl border border-white/10 shadow-2xl rounded-[3rem] overflow-hidden p-8 flex items-center justify-center">
                        <img src="assets/images/product_billing.jpg" alt="Grovixo Billing" class="w-full h-auto rounded-xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] transform transition-transform duration-700 group-hover:scale-105">
                    </div>
                </div>
                
                <!-- Content Side -->
                <div data-aos="fade-left" data-aos-delay="100">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 text-xs font-bold bg-brand/20 text-brand border border-brand/30 rounded-full mb-8 shadow-[0_0_15px_rgba(37,99,235,0.3)]">
                        <span class="w-2 h-2 rounded-full bg-brand animate-pulse shadow-[0_0_8px_rgba(37,99,235,0.8)]"></span>
                        SaaS Product
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Grovixo Billing</h2>
                    <p class="text-lg text-slate-400 mb-10 leading-relaxed">An advanced GST Billing, POS, and Inventory Management system engineered specifically for Indian retail and wholesale businesses. Automate compliance, sync inventory in real-time, and scale across multiple locations effortlessly.</p>
                    
                    <div class="space-y-8 mb-12">
                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-brand/20 border border-brand/30 flex items-center justify-center text-brand shrink-0 shadow-[0_0_15px_rgba(37,99,235,0.2)]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-lg">Complete GST Compliance</h4>
                                <p class="text-sm text-slate-400 mt-2 leading-relaxed">Automated tax calculations, HSN/SAC code mapping, and one-click GSTR reports.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-brand/20 border border-brand/30 flex items-center justify-center text-brand shrink-0 shadow-[0_0_15px_rgba(37,99,235,0.2)]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-lg">Real-time Inventory Sync</h4>
                                <p class="text-sm text-slate-400 mt-2 leading-relaxed">Prevent stockouts with low-stock alerts, barcode scanning, and multi-warehouse tracking.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-brand/20 border border-brand/30 flex items-center justify-center text-brand shrink-0 shadow-[0_0_15px_rgba(37,99,235,0.2)]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-lg">Multi-store Architecture</h4>
                                <p class="text-sm text-slate-400 mt-2 leading-relaxed">Manage users, permissions, and consolidated analytics across hundreds of retail branches.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-10 pb-10 border-b border-white/10">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">Tech Stack</p>
                        <div class="flex flex-wrap gap-3">
                            <span class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-lg text-xs font-bold text-slate-300 backdrop-blur-sm hover:bg-white/10 transition-colors">React.js</span>
                            <span class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-lg text-xs font-bold text-slate-300 backdrop-blur-sm hover:bg-white/10 transition-colors">Node.js</span>
                            <span class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-lg text-xs font-bold text-slate-300 backdrop-blur-sm hover:bg-white/10 transition-colors">PostgreSQL</span>
                            <span class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-lg text-xs font-bold text-slate-300 backdrop-blur-sm hover:bg-white/10 transition-colors">AWS</span>
                        </div>
                    </div>
                    
                    <a href="contact" class="btn-primary group !bg-brand hover:!bg-brandHover shadow-[0_0_20px_rgba(37,99,235,0.4)]">Request Platform Demo <svg class="w-4 h-4 ml-2 inline-block group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Product 2: Logistics -->
    <section class="py-32 bg-navy overflow-hidden relative">
        <!-- Background Ambient Glow -->
        <div class="absolute top-1/2 right-0 w-[600px] h-[600px] bg-indigo-500/10 blur-[150px] rounded-full pointer-events-none translate-x-1/3 -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Content Side -->
                <div class="order-2 lg:order-1" data-aos="fade-right" data-aos-delay="100">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 text-xs font-bold bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 rounded-full mb-8 shadow-[0_0_15px_rgba(99,102,241,0.2)]">
                        <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse shadow-[0_0_8px_rgba(99,102,241,0.8)]"></span>
                        Enterprise Platform
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Grovixo Logistics</h2>
                    <p class="text-lg text-slate-400 mb-10 leading-relaxed">A comprehensive Transport Management System (TMS) designed to optimize fleet operations, route planning, and freight tracking for modern logistics enterprises.</p>
                    
                    <div class="space-y-8 mb-12">
                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center text-indigo-400 shrink-0 shadow-[0_0_15px_rgba(99,102,241,0.2)]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-lg">Live Fleet Tracking</h4>
                                <p class="text-sm text-slate-400 mt-2 leading-relaxed">Real-time GPS integration, geofencing, and automated ETA calculations for dispatchers.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center text-indigo-400 shrink-0 shadow-[0_0_15px_rgba(99,102,241,0.2)]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-lg">Automated Dispatching</h4>
                                <p class="text-sm text-slate-400 mt-2 leading-relaxed">Algorithm-driven load assignments based on driver availability, capacity, and route efficiency.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center text-indigo-400 shrink-0 shadow-[0_0_15px_rgba(99,102,241,0.2)]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-lg">Driver App & PODs</h4>
                                <p class="text-sm text-slate-400 mt-2 leading-relaxed">Dedicated mobile apps for drivers to manage routes, capture digital signatures (ePOD), and upload expenses.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-10 pb-10 border-b border-white/10">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">Tech Stack</p>
                        <div class="flex flex-wrap gap-3">
                            <span class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-lg text-xs font-bold text-slate-300 backdrop-blur-sm hover:bg-white/10 transition-colors">Flutter (Mobile)</span>
                            <span class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-lg text-xs font-bold text-slate-300 backdrop-blur-sm hover:bg-white/10 transition-colors">Laravel</span>
                            <span class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-lg text-xs font-bold text-slate-300 backdrop-blur-sm hover:bg-white/10 transition-colors">Redis</span>
                            <span class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-lg text-xs font-bold text-slate-300 backdrop-blur-sm hover:bg-white/10 transition-colors">Google Maps API</span>
                        </div>
                    </div>
                    
                    <a href="contact" class="inline-flex items-center justify-center px-8 py-4 bg-indigo-600 text-white rounded-full font-bold hover:bg-indigo-700 transition-all duration-300 shadow-[0_0_20px_rgba(79,70,229,0.4)] hover:-translate-y-1 group">Request Platform Demo <svg class="w-4 h-4 ml-2 inline-block group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg></a>
                </div>

                <!-- Image Side -->
                <div class="relative group order-1 lg:order-2" data-aos="fade-left">
                    <div class="absolute inset-0 bg-indigo-500/20 rounded-[3rem] transform rotate-3 scale-[1.02] transition-transform duration-700 group-hover:rotate-0 blur-xl"></div>
                    <div class="relative bg-white/5 backdrop-blur-2xl border border-white/10 shadow-2xl rounded-[3rem] overflow-hidden p-8 flex items-center justify-center h-full min-h-[400px]">
                        <img src="assets/images/product_logistics.jpg" alt="Grovixo Logistics" class="w-full h-auto mix-blend-screen opacity-90 transform transition-transform duration-700 group-hover:scale-105">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA -->
    <section class="py-24 bg-brand relative overflow-hidden text-white">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMSIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvc3ZnPg==')] opacity-30 pointer-events-none"></div>
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/10 blur-[100px] rounded-full pointer-events-none"></div>
        
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight" data-aos="fade-up">Ready to transform your operations?</h2>
            <p class="text-xl text-white/80 mb-10 max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">Whether you need to license our existing platforms or build a custom enterprise solution, we're ready to help you scale.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
                <a href="contact" class="px-8 py-4 bg-white text-navy font-bold rounded-full hover:scale-105 transition-transform shadow-[0_10px_40px_rgba(0,0,0,0.1)]">Book a Consultation</a>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
