<?php include 'includes/header.php'; ?>

<main>
        <!-- Hero -->
        <section class="relative overflow-hidden border-b border-slate-100 bg-white pt-14 pb-20 lg:pt-24 lg:pb-32 grid-bg">
            <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
                <p class="inline-flex items-center gap-2 text-xs font-semibold text-brand bg-white border border-blue-100 shadow-sm rounded-full px-3 py-1.5 mb-6" data-aos="fade-down">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                    Services
                </p>
                <h1 class="font-display text-4xl sm:text-5xl xl:text-[3.4rem] font-extrabold tracking-tight leading-[1.08] text-navy mb-6" data-aos="fade-up">
                    Everything you need to <em class="serif text-brand">launch & scale.</em>
                </h1>
                <p class="text-lg text-slate-600 leading-relaxed mx-auto max-w-2xl" data-aos="fade-up" data-aos-delay="100">
                    From identity design to full-stack web applications. We offer comprehensive digital services to bring your brand to life.
                </p>
            </div>
        </section>

        <!-- Services Grid -->
        <section class="py-24 bg-slate-50 border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Branding & Identity -->
                    <div class="service-card group !p-0 overflow-hidden flex flex-col h-full bg-white border border-slate-100 rounded-3xl hover:border-brand hover:shadow-xl hover:shadow-brand/10 transition-all duration-300" data-aos="fade-up">
                        <div class="w-full h-64 bg-white relative overflow-hidden flex items-center justify-center p-8 pb-0">
                            <img src="assets/images/service_branding.jpg" alt="Branding" class="w-full h-full object-contain object-center group-hover:scale-105 mix-blend-multiply transition-transform duration-700">
                        </div>
                        <div class="p-8 pt-6 flex-1 flex flex-col relative z-10 bg-white">
                            <h3 class="text-2xl font-bold text-navy mb-3">Branding & Identity</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">Logos, visual systems and brand guidelines that make you instantly recognizable in a crowded market.</p>
                        </div>
                    </div>

                    <!-- Web Design & Development (Merged) -->
                    <div class="service-card group !p-0 overflow-hidden flex flex-col h-full bg-white border border-slate-100 rounded-3xl hover:border-brand hover:shadow-xl hover:shadow-brand/10 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-full h-64 bg-white relative overflow-hidden flex items-center justify-center p-8 pb-0">
                            <img src="assets/images/service_web.jpg" alt="Web Development" class="w-full h-full object-contain object-center group-hover:scale-105 mix-blend-multiply transition-transform duration-700">
                        </div>
                        <div class="p-8 pt-6 flex-1 flex flex-col relative z-10 bg-white">
                            <h3 class="text-2xl font-bold text-navy mb-3">Web Design & Development</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">Conversion-focused, story-driven UI/UX backed by performant, scalable modern tech stacks.</p>
                        </div>
                    </div>

                    <!-- Mobile App Development (New) -->
                    <div class="service-card group !p-0 overflow-hidden flex flex-col h-full bg-white border border-slate-100 rounded-3xl hover:border-brand hover:shadow-xl hover:shadow-brand/10 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-full h-64 bg-white relative overflow-hidden flex items-center justify-center p-8 pb-0">
                            <img src="assets/images/service_mobile.jpg" alt="Mobile Apps" class="w-full h-full object-contain object-center group-hover:scale-105 mix-blend-multiply transition-transform duration-700">
                        </div>
                        <div class="p-8 pt-6 flex-1 flex flex-col relative z-10 bg-white">
                            <h3 class="text-2xl font-bold text-navy mb-3">Mobile App Development</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">Native and cross-platform mobile experiences designed to engage users on iOS and Android.</p>
                        </div>
                    </div>

                    <!-- Social Media Design -->
                    <div class="service-card group !p-0 overflow-hidden flex flex-col h-full bg-white border border-slate-100 rounded-3xl hover:border-brand hover:shadow-xl hover:shadow-brand/10 transition-all duration-300" data-aos="fade-up">
                        <div class="w-full h-64 bg-white relative overflow-hidden flex items-center justify-center p-8 pb-0">
                            <img src="assets/images/service_social.jpg" alt="Social Media Design" class="w-full h-full object-contain object-center group-hover:scale-105 mix-blend-multiply transition-transform duration-700">
                        </div>
                        <div class="p-8 pt-6 flex-1 flex flex-col relative z-10 bg-white">
                            <h3 class="text-2xl font-bold text-navy mb-3">Social Media Design</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">Cohesive content systems for Instagram, LinkedIn and beyond — designed to scroll-stop.</p>
                        </div>
                    </div>

                    <!-- Enterprise Software -->
                    <div class="service-card group !p-0 overflow-hidden flex flex-col h-full bg-white border border-slate-100 rounded-3xl hover:border-brand hover:shadow-xl hover:shadow-brand/10 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-full h-64 bg-white relative overflow-hidden flex items-center justify-center p-8 pb-0">
                            <img src="assets/images/service_enterprise.jpg" alt="Enterprise Software" class="w-full h-full object-contain object-center group-hover:scale-105 mix-blend-multiply transition-transform duration-700">
                        </div>
                        <div class="p-8 pt-6 flex-1 flex flex-col relative z-10 bg-white">
                            <h3 class="text-2xl font-bold text-navy mb-3">Enterprise Software</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">Scalable, custom-built software architectures engineered for large operations and high availability.</p>
                        </div>
                    </div>

                    <!-- Maintenance & Support -->
                    <div class="service-card group !p-0 overflow-hidden flex flex-col h-full bg-white border border-slate-100 rounded-3xl hover:border-brand hover:shadow-xl hover:shadow-brand/10 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-full h-64 bg-white relative overflow-hidden flex items-center justify-center p-8 pb-0">
                            <img src="assets/images/service_maintenance.jpg" alt="Maintenance & Support" class="w-full h-full object-contain object-center group-hover:scale-105 mix-blend-multiply transition-transform duration-700">
                        </div>
                        <div class="p-8 pt-6 flex-1 flex flex-col relative z-10 bg-white">
                            <h3 class="text-2xl font-bold text-navy mb-3">Maintenance & Support</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">Ongoing care, updates, and optimization so your digital presence stays sharp.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Proprietary Platforms -->
        <section class="py-24 bg-white border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16" data-aos="fade-up">
                    <p class="text-sm font-bold text-brand uppercase tracking-widest mb-2">Our Products</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-navy">Proprietary Software Solutions</h2>
                    <p class="mt-4 text-slate-500 max-w-2xl mx-auto">We don't just build software for clients — we build and scale our own industry-leading enterprise products.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Billing Platform -->
                    <div class="bg-white border border-slate-100 rounded-3xl overflow-hidden group hover:border-brand hover:shadow-xl hover:shadow-brand/10 transition-all duration-300 flex flex-col h-full" data-aos="fade-right">
                        <div class="w-full h-80 bg-white relative overflow-hidden flex items-center justify-center p-8 pb-0 border-b border-slate-100">
                            <img src="assets/images/product_billing.jpg" alt="Grovixo Billing" class="w-full h-full object-contain object-center group-hover:scale-105 mix-blend-multiply transition-transform duration-700">
                        </div>
                        <div class="p-8 lg:p-10 flex-1 flex flex-col relative z-10 bg-white">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold bg-blue-100 text-brand rounded-full mb-6 w-fit">SaaS Product</span>
                            <h3 class="text-3xl font-bold text-navy mb-4">Grovixo Billing</h3>
                            <p class="text-slate-500 mb-8 leading-relaxed max-w-md">An advanced GST Billing, POS, and Inventory Management system engineered specifically for Indian retail and wholesale businesses.</p>
                            
                            <ul class="space-y-3 mb-10 text-sm text-slate-600 font-medium flex-1">
                                <li class="flex items-center gap-3"><svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Complete GST Compliance</li>
                                <li class="flex items-center gap-3"><svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Real-time Inventory Sync</li>
                                <li class="flex items-center gap-3"><svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Multi-store Management</li>
                            </ul>
                            
                            <a href="#" class="btn-primary mt-auto">View Platform <svg class="w-4 h-4 ml-2 inline-block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg></a>
                        </div>
                    </div>

                    <!-- Transport System -->
                    <div class="bg-white border border-slate-100 rounded-3xl overflow-hidden group hover:border-brand hover:shadow-xl hover:shadow-brand/10 transition-all duration-300 flex flex-col h-full" data-aos="fade-left">
                        <div class="w-full h-80 bg-white relative overflow-hidden flex items-center justify-center p-8 pb-0 border-b border-slate-100">
                            <img src="assets/images/product_logistics.jpg" alt="Grovixo Logistics" class="w-full h-full object-contain object-center group-hover:scale-105 mix-blend-multiply transition-transform duration-700">
                        </div>
                        <div class="p-8 lg:p-10 flex-1 flex flex-col relative z-10 bg-white">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold bg-indigo-100 text-indigo-600 rounded-full mb-6 w-fit">Enterprise Platform</span>
                            <h3 class="text-3xl font-bold text-navy mb-4">Grovixo Logistics</h3>
                            <p class="text-slate-500 mb-8 leading-relaxed max-w-md">A comprehensive Transport Management System (TMS) designed to optimize fleet operations, route planning, and freight tracking.</p>
                            
                            <ul class="space-y-3 mb-10 text-sm text-slate-600 font-medium flex-1">
                                <li class="flex items-center gap-3"><svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Live Fleet Tracking</li>
                                <li class="flex items-center gap-3"><svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Automated Dispatching</li>
                                <li class="flex items-center gap-3"><svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Driver App & Pods</li>
                            </ul>
                            
                            <a href="#" class="btn-primary !bg-indigo-600 hover:!bg-indigo-700 mt-auto">View Platform <svg class="w-4 h-4 ml-2 inline-block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Development Process -->
        <section class="py-24 bg-slate-50 grid-bg border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-20" data-aos="fade-up">
                    <p class="text-sm font-bold text-brand uppercase tracking-widest mb-2">Our Process</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-navy">How we build enterprise software.</h2>
                    <p class="mt-4 text-slate-500 max-w-2xl mx-auto">A systematic, transparent approach from requirements to deployment.</p>
                </div>

                <div class="relative max-w-4xl mx-auto">
                    <!-- Vertical Line -->
                    <div class="absolute left-[28px] md:left-1/2 top-0 bottom-0 w-px bg-slate-200 transform md:-translate-x-1/2"></div>
                    
                    <!-- Step 1 -->
                    <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between mb-16 group">
                        <div class="md:w-[45%] order-2 md:order-1 pl-16 md:pl-0 text-left md:text-right" data-aos="fade-right">
                            <div class="bg-white border border-slate-100 rounded-3xl p-8 shadow-lg shadow-slate-200/50 group-hover:-translate-y-2 group-hover:shadow-xl group-hover:shadow-brand/10 transition-all duration-500 relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-24 h-24 bg-brand/5 rounded-bl-full -z-10 group-hover:scale-150 transition-transform duration-700"></div>
                                <h3 class="text-xl font-bold text-navy mb-3">01. Discovery & Architecture</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">We map out your complex business logic, user flows, and technical requirements before writing a single line of code.</p>
                            </div>
                        </div>
                        <div class="absolute left-0 md:left-1/2 top-0 md:top-1/2 w-14 h-14 bg-white border-2 border-brand text-brand rounded-full flex items-center justify-center font-bold text-lg transform md:-translate-x-1/2 md:-translate-y-1/2 shadow-[0_0_20px_rgba(37,99,235,0.2)] z-10 group-hover:scale-110 group-hover:bg-brand group-hover:text-white transition-all duration-500" data-aos="zoom-in">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>
                        </div>
                        <div class="md:w-[45%] order-3 md:order-3"></div>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between mb-16 group">
                        <div class="md:w-[45%] order-2 md:order-3 pl-16 md:pl-0 text-left" data-aos="fade-left">
                            <div class="bg-white border border-slate-100 rounded-3xl p-8 shadow-lg shadow-slate-200/50 group-hover:-translate-y-2 group-hover:shadow-xl group-hover:shadow-brand/10 transition-all duration-500 relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-24 h-24 bg-brand/5 rounded-br-full -z-10 group-hover:scale-150 transition-transform duration-700"></div>
                                <h3 class="text-xl font-bold text-navy mb-3">02. UI/UX & Prototyping</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">We design high-fidelity, interactive prototypes. You get a perfect feel for the final software, ensuring zero surprises.</p>
                            </div>
                        </div>
                        <div class="absolute left-0 md:left-1/2 top-0 md:top-1/2 w-14 h-14 bg-white border-2 border-slate-200 text-slate-400 group-hover:border-brand group-hover:text-brand group-hover:shadow-[0_0_20px_rgba(37,99,235,0.2)] rounded-full flex items-center justify-center font-bold text-lg transform md:-translate-x-1/2 md:-translate-y-1/2 shadow-sm z-10 transition-all duration-500 group-hover:scale-110" data-aos="zoom-in">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"></path><path d="M3.34 19a10 10 0 1 1 17.32 0"></path></svg>
                        </div>
                        <div class="md:w-[45%] order-3 md:order-1"></div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between mb-16 group">
                        <div class="md:w-[45%] order-2 md:order-1 pl-16 md:pl-0 text-left md:text-right" data-aos="fade-right">
                            <div class="bg-white border border-slate-100 rounded-3xl p-8 shadow-lg shadow-slate-200/50 group-hover:-translate-y-2 group-hover:shadow-xl group-hover:shadow-brand/10 transition-all duration-500 relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-24 h-24 bg-brand/5 rounded-bl-full -z-10 group-hover:scale-150 transition-transform duration-700"></div>
                                <h3 class="text-xl font-bold text-navy mb-3">03. Agile Development</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">Our engineers build your platform in 2-week sprints, giving you continuous access to staging environments.</p>
                            </div>
                        </div>
                        <div class="absolute left-0 md:left-1/2 top-0 md:top-1/2 w-14 h-14 bg-white border-2 border-slate-200 text-slate-400 group-hover:border-brand group-hover:text-brand group-hover:shadow-[0_0_20px_rgba(37,99,235,0.2)] rounded-full flex items-center justify-center font-bold text-lg transform md:-translate-x-1/2 md:-translate-y-1/2 shadow-sm z-10 transition-all duration-500 group-hover:scale-110" data-aos="zoom-in">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                        </div>
                        <div class="md:w-[45%] order-3 md:order-3"></div>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between group">
                        <div class="md:w-[45%] order-2 md:order-3 pl-16 md:pl-0 text-left" data-aos="fade-left">
                            <div class="bg-white border border-slate-100 rounded-3xl p-8 shadow-lg shadow-slate-200/50 group-hover:-translate-y-2 group-hover:shadow-xl group-hover:shadow-brand/10 transition-all duration-500 relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-24 h-24 bg-brand/5 rounded-br-full -z-10 group-hover:scale-150 transition-transform duration-700"></div>
                                <h3 class="text-xl font-bold text-navy mb-3">04. Deployment & Scale</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">We deploy to secure, scalable infrastructure (AWS/Vercel) and provide ongoing enterprise SLA support.</p>
                            </div>
                        </div>
                        <div class="absolute left-0 md:left-1/2 top-0 md:top-1/2 w-14 h-14 bg-white border-2 border-slate-200 text-slate-400 group-hover:border-brand group-hover:text-brand group-hover:shadow-[0_0_20px_rgba(37,99,235,0.2)] rounded-full flex items-center justify-center font-bold text-lg transform md:-translate-x-1/2 md:-translate-y-1/2 shadow-sm z-10 transition-all duration-500 group-hover:scale-110" data-aos="zoom-in">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20"></path><path d="m17 5-5-3-5 3"></path><path d="m19 22-7-3-7 3"></path></svg>
                        </div>
                        <div class="md:w-[45%] order-3 md:order-1"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-navy text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-brand/20 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 40px 40px;"></div>
            <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
                <h2 class="text-4xl md:text-5xl font-display font-bold mb-6 text-white" data-aos="fade-up">Ready to build something massive?</h2>
                <p class="text-lg text-slate-300 mb-10 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Whether you need custom enterprise software or want to see our proprietary products in action, our engineering team is ready to talk.</p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
                    <a href="contact" class="px-8 py-4 bg-brand text-white font-bold rounded-full hover:bg-brandHover transition-all shadow-lg shadow-brand/30 transform hover:-translate-y-1">Schedule a Strategy Call</a>
                    <a href="contact" class="px-8 py-4 bg-white/10 text-white font-bold rounded-full hover:bg-white/20 transition-all backdrop-blur-sm border border-white/10">Request a Product Demo</a>
                </div>
            </div>
        </section>

        <!-- Technologies -->
        <section class="py-24 bg-white border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-6 text-center" data-aos="fade-up">
                <p class="text-sm font-bold text-brand uppercase tracking-widest mb-2">Technologies We Use</p>
                <h2 class="text-3xl md:text-4xl font-bold text-navy mb-16">Built on modern foundations.</h2>
                
                <!-- Marquee Container -->
                <div class="relative w-full overflow-hidden flex pause-marquee before:absolute before:left-0 before:top-0 before:z-10 before:h-full before:w-20 before:bg-gradient-to-r before:from-white before:to-transparent after:absolute after:right-0 after:top-0 after:z-10 after:h-full after:w-20 after:bg-gradient-to-l after:from-white after:to-transparent">
                    
                    <!-- First Set -->
                    <div class="flex shrink-0 animate-marquee gap-6 pr-6">
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/react/react-original.svg" alt="React" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">React</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg" alt="Tailwind CSS" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Tailwind</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/figma/figma-original.svg" alt="Figma" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Figma</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nodejs/nodejs-original.svg" alt="Node.js" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Node.js</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/amazonwebservices/amazonwebservices-original-wordmark.svg" alt="AWS" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">AWS</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/typescript/typescript-original.svg" alt="TypeScript" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">TypeScript</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vuejs/vuejs-original.svg" alt="Vue.js" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Vue.js</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" alt="Laravel" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Laravel</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" alt="PHP" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">PHP</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg" alt="JavaScript" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">JavaScript</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/html5/html5-original.svg" alt="HTML5" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">HTML5</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/css3/css3-original.svg" alt="CSS3" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">CSS3</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/python/python-original.svg" alt="Python" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Python</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mongodb/mongodb-original.svg" alt="MongoDB" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">MongoDB</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/docker/docker-original.svg" alt="Docker" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Docker</span>
                        </div>
                    </div>

                    <!-- Second Set (Duplicate for seamless scrolling) -->
                    <div class="flex shrink-0 animate-marquee gap-6 pr-6" aria-hidden="true">
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/react/react-original.svg" alt="React" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">React</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg" alt="Tailwind CSS" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Tailwind</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/figma/figma-original.svg" alt="Figma" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Figma</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nodejs/nodejs-original.svg" alt="Node.js" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Node.js</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/amazonwebservices/amazonwebservices-original-wordmark.svg" alt="AWS" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">AWS</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/typescript/typescript-original.svg" alt="TypeScript" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">TypeScript</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vuejs/vuejs-original.svg" alt="Vue.js" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Vue.js</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" alt="Laravel" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Laravel</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" alt="PHP" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">PHP</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg" alt="JavaScript" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">JavaScript</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/html5/html5-original.svg" alt="HTML5" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">HTML5</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/css3/css3-original.svg" alt="CSS3" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">CSS3</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/python/python-original.svg" alt="Python" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Python</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mongodb/mongodb-original.svg" alt="MongoDB" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">MongoDB</span>
                        </div>
                        <div class="px-6 py-5 w-40 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center justify-center gap-3 bg-white hover:border-brand transition-colors cursor-default">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/docker/docker-original.svg" alt="Docker" class="w-10 h-10">
                            <span class="font-bold text-navy text-sm">Docker</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="py-24 bg-slate-50 grid-bg">
            <div class="max-w-4xl mx-auto px-6">
                <div class="text-center mb-16">
                    <p class="text-sm font-bold text-brand uppercase tracking-widest mb-2">FAQ</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-navy">Common Questions</h2>
                </div>
                
                <div class="space-y-4">
                    <details class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm group [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex justify-between items-center font-bold text-navy cursor-pointer list-none text-lg">
                            How long does a typical project take?
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <p class="text-slate-500 mt-4 leading-relaxed">Most web design and development projects take between 4 to 8 weeks from discovery to launch, depending on the complexity and scope.</p>
                    </details>
                    <details class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm group [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex justify-between items-center font-bold text-navy cursor-pointer list-none text-lg">
                            Do you offer post-launch support?
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <p class="text-slate-500 mt-4 leading-relaxed">Absolutely. We offer ongoing maintenance retainers to keep your site secure, updated, and optimized for performance.</p>
                    </details>
                    <details class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm group [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex justify-between items-center font-bold text-navy cursor-pointer list-none text-lg">
                            Do you work with international clients?
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <p class="text-slate-500 mt-4 leading-relaxed">Yes, while we are based in Vadodara, India, we work with ambitious founders and businesses across the globe, adapting to your time zones for meetings.</p>
                    </details>
                </div>
            </div>
        </section>

    </main>

<?php include 'includes/footer.php'; ?>
