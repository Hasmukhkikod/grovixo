<?php include __DIR__ . '/includes/header.php'; ?>

<main class="relative bg-white pt-32 pb-24 overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0 bg-mesh opacity-30 pointer-events-none"></div>
    <div class="absolute inset-0 grid-pattern opacity-[0.12] pointer-events-none"></div>
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-brand/10 blur-[150px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/3"></div>

    <!-- Breadcrumb & Hero -->
    <section class="max-w-7xl mx-auto px-6 mb-24 relative z-10 pt-10">
        <div class="flex items-center gap-3 text-sm font-bold text-slate-400 uppercase tracking-widest mb-8">
            <a href="services" class="hover:text-brand transition-colors">Services</a>
            <span>/</span>
            <span class="text-navy">Website Development</span>
        </div>
        
        <div class="max-w-4xl">
            <h1 class="text-5xl md:text-7xl lg:text-[5.5rem] font-bold text-navy leading-[1.05] tracking-tight mb-8" data-aos="fade-up">
                High-performance <span class="text-gradient-blue">web experiences.</span>
            </h1>
            <p class="text-xl md:text-2xl text-slate-500 leading-relaxed max-w-2xl" data-aos="fade-up" data-aos-delay="100">
                We build fast, scalable, and secure websites that not only look beautiful but are engineered to convert visitors into customers.
            </p>
            
            <div class="mt-12 flex flex-wrap items-center gap-6" data-aos="fade-up" data-aos-delay="200">
                <a href="contact" class="btn-primary">Start a Project</a>
                <a href="#process" class="font-bold text-navy hover:text-brand transition-colors flex items-center gap-2">
                    View Process <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Large Image Banner -->
    <section class="max-w-7xl mx-auto px-6 mb-32 relative z-10" data-aos="zoom-in" data-aos-duration="1000">
        <div class="rounded-[2.5rem] overflow-hidden aspect-[21/9] bg-slate-100 relative group">
            <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Web Development Code" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
            <div class="absolute inset-0 bg-navy/20 mix-blend-overlay"></div>
        </div>
    </section>

    <!-- What We Do / Features -->
    <section class="max-w-7xl mx-auto px-6 mb-32 relative z-10">
        <div class="grid lg:grid-cols-12 gap-16">
            <div class="lg:col-span-4" data-aos="fade-right">
                <h2 class="text-3xl md:text-4xl font-bold text-navy sticky top-32">Everything you need to scale digitally.</h2>
            </div>
            <div class="lg:col-span-8 grid sm:grid-cols-2 gap-8">
                <div class="bg-white border border-slate-100 rounded-3xl p-8 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.02)] hover:shadow-xl hover:shadow-brand/5 hover:border-brand/30 transition-all" data-aos="fade-up">
                    <div class="w-12 h-12 rounded-xl bg-brand/10 text-brand flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy mb-3">Lightning Fast</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">We build on modern architectures (Next.js, React) ensuring your site loads in milliseconds, crucial for SEO and conversion rates.</p>
                </div>
                
                <div class="bg-white border border-slate-100 rounded-3xl p-8 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.02)] hover:shadow-xl hover:shadow-brand/5 hover:border-brand/30 transition-all" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 rounded-xl bg-brand/10 text-brand flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy mb-3">Responsive by Default</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">Over 60% of traffic is mobile. We design mobile-first, ensuring flawless experiences across phones, tablets, and massive displays.</p>
                </div>

                <div class="bg-white border border-slate-100 rounded-3xl p-8 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.02)] hover:shadow-xl hover:shadow-brand/5 hover:border-brand/30 transition-all" data-aos="fade-up">
                    <div class="w-12 h-12 rounded-xl bg-brand/10 text-brand flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy mb-3">Enterprise Security</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">Security isn't an afterthought. We implement robust authentication, data encryption, and secure APIs from day one.</p>
                </div>

                <div class="bg-white border border-slate-100 rounded-3xl p-8 shadow-[0_20px_50px_-10px_rgba(0,0,0,0.02)] hover:shadow-xl hover:shadow-brand/5 hover:border-brand/30 transition-all" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 rounded-xl bg-brand/10 text-brand flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-navy mb-3">Seamless CMS</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">We integrate modern headless CMS solutions so your marketing team can update content instantly without calling a developer.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Stack Marquee -->
    <section class="py-20 border-y border-slate-100 bg-slate-50/50 mb-32 relative z-10 overflow-hidden">
        <div class="text-center mb-10">
            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Technologies We Use</h3>
        </div>
        <div class="relative w-full overflow-hidden flex">
            <!-- First Set -->
            <div class="flex gap-16 items-center shrink-0 animate-scroll px-8">
                <span class="text-2xl font-bold text-slate-300">React</span>
                <span class="text-2xl font-bold text-slate-300">Next.js</span>
                <span class="text-2xl font-bold text-slate-300">TailwindCSS</span>
                <span class="text-2xl font-bold text-slate-300">TypeScript</span>
                <span class="text-2xl font-bold text-slate-300">Node.js</span>
                <span class="text-2xl font-bold text-slate-300">Laravel</span>
                <span class="text-2xl font-bold text-slate-300">AWS</span>
            </div>
            <!-- Duplicate for Seamless Scroll -->
            <div class="flex gap-16 items-center shrink-0 animate-scroll px-8">
                <span class="text-2xl font-bold text-slate-300">React</span>
                <span class="text-2xl font-bold text-slate-300">Next.js</span>
                <span class="text-2xl font-bold text-slate-300">TailwindCSS</span>
                <span class="text-2xl font-bold text-slate-300">TypeScript</span>
                <span class="text-2xl font-bold text-slate-300">Node.js</span>
                <span class="text-2xl font-bold text-slate-300">Laravel</span>
                <span class="text-2xl font-bold text-slate-300">AWS</span>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process" class="max-w-7xl mx-auto px-6 mb-32 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-navy mb-4">Our Methodology</h2>
            <p class="text-slate-500">How we take your project from concept to deployment.</p>
        </div>
        
        <div class="grid md:grid-cols-4 gap-6">
            <!-- Step 1 -->
            <div class="relative p-8 rounded-3xl bg-white border border-slate-100 hover:border-brand/30 transition-colors" data-aos="fade-up">
                <div class="text-5xl font-black text-slate-100 absolute top-6 right-6 z-0">01</div>
                <div class="relative z-10">
                    <h3 class="text-xl font-bold text-navy mb-3 mt-12">Discovery</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">We analyze your requirements, target audience, and business goals to define technical architecture.</p>
                </div>
            </div>
            <!-- Step 2 -->
            <div class="relative p-8 rounded-3xl bg-white border border-slate-100 hover:border-brand/30 transition-colors" data-aos="fade-up" data-aos-delay="100">
                <div class="text-5xl font-black text-slate-100 absolute top-6 right-6 z-0">02</div>
                <div class="relative z-10">
                    <h3 class="text-xl font-bold text-navy mb-3 mt-12">Design</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Creating wireframes and high-fidelity prototypes in Figma to nail the user experience.</p>
                </div>
            </div>
            <!-- Step 3 -->
            <div class="relative p-8 rounded-3xl bg-white border border-slate-100 hover:border-brand/30 transition-colors" data-aos="fade-up" data-aos-delay="200">
                <div class="text-5xl font-black text-slate-100 absolute top-6 right-6 z-0">03</div>
                <div class="relative z-10">
                    <h3 class="text-xl font-bold text-navy mb-3 mt-12">Development</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Writing clean, scalable code in rapid sprints with continuous integration and testing.</p>
                </div>
            </div>
            <!-- Step 4 -->
            <div class="relative p-8 rounded-3xl bg-white border border-slate-100 hover:border-brand/30 transition-colors" data-aos="fade-up" data-aos-delay="300">
                <div class="text-5xl font-black text-slate-100 absolute top-6 right-6 z-0">04</div>
                <div class="relative z-10">
                    <h3 class="text-xl font-bold text-navy mb-3 mt-12">Launch</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Rigorous QA, performance optimization, and seamless deployment to production servers.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="max-w-5xl mx-auto px-6 relative z-10">
        <div class="bg-navy rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-mesh opacity-20"></div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-brand/30 blur-[80px] rounded-full"></div>
            
            <div class="relative z-10">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6" data-aos="fade-up">Ready to start building?</h2>
                <p class="text-slate-300 text-lg mb-10 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="100">Let's discuss how our development team can bring your vision to life.</p>
                <div data-aos="fade-up" data-aos-delay="200">
                    <a href="contact" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-navy rounded-full font-bold hover:bg-brand hover:text-white transition-all duration-300">
                        Schedule a Consultation
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
