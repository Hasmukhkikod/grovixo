<?php include 'includes/header.php'; ?>

<main class="pt-32 pb-24">
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 mb-24 text-center">
        <div class="max-w-3xl mx-auto">
            <span class="inline-block py-1 px-3 rounded-full bg-brand/10 text-brand text-sm font-bold tracking-widest uppercase mb-6" data-aos="fade-down">Our Stack</span>
            <h1 class="text-5xl md:text-7xl font-bold text-navy leading-tight mb-8" data-aos="fade-up">
                Powered by modern <span class="text-brand">tech.</span>
            </h1>
            <p class="text-xl text-slate-500 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                We leverage the best tools, frameworks, and infrastructure to build digital products that are fast, secure, and infinitely scalable.
            </p>
        </div>
    </section>

    <!-- Tech Grid -->
    <section class="max-w-7xl mx-auto px-6 mb-24">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Frontend -->
            <div class="bg-white border border-slate-100 rounded-3xl p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group" data-aos="fade-up">
                <div class="flex items-start justify-between gap-4 mb-4">
                    <h3 class="text-xl font-bold text-navy mt-2">Frontend Development</h3>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-brand flex items-center justify-center shrink-0 group-hover:bg-brand group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed mb-6">We build pixel-perfect, highly interactive user interfaces using modern reactive frameworks.</p>
                <div class="flex flex-wrap gap-2 mt-auto">
                    <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-xs font-bold text-slate-600">React.js</span>
                    <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-xs font-bold text-slate-600">Next.js</span>
                    <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-xs font-bold text-slate-600">Vue.js</span>
                    <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-xs font-bold text-slate-600">Tailwind CSS</span>
                </div>
            </div>

            <!-- Backend -->
            <div class="bg-white border border-slate-100 rounded-3xl p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-start justify-between gap-4 mb-4">
                    <h3 class="text-xl font-bold text-navy mt-2">Backend & APIs</h3>
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                    </div>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed mb-6">Robust server-side architectures, RESTful APIs, and complex database designs that scale gracefully.</p>
                <div class="flex flex-wrap gap-2 mt-auto">
                    <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-xs font-bold text-slate-600">PHP / Laravel</span>
                    <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-xs font-bold text-slate-600">Node.js</span>
                    <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-xs font-bold text-slate-600">Python</span>
                    <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-xs font-bold text-slate-600">MySQL / PostgreSQL</span>
                </div>
            </div>

            <!-- CMS & E-commerce -->
            <div class="bg-white border border-slate-100 rounded-3xl p-8 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-start justify-between gap-4 mb-4">
                    <h3 class="text-xl font-bold text-navy mt-2">CMS & E-Commerce</h3>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed mb-6">Customized content management systems and high-converting headless commerce solutions.</p>
                <div class="flex flex-wrap gap-2 mt-auto">
                    <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-xs font-bold text-slate-600">WordPress</span>
                    <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-xs font-bold text-slate-600">Shopify Plus</span>
                    <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-xs font-bold text-slate-600">WooCommerce</span>
                    <span class="px-3 py-1 bg-slate-50 border border-slate-100 rounded-lg text-xs font-bold text-slate-600">Sanity / Strapi</span>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>
