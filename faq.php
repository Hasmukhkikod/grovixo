<?php include 'includes/header.php'; ?>

<main class="relative bg-white pt-32 pb-24 overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0 bg-mesh opacity-30 pointer-events-none"></div>
    <div class="absolute inset-0 grid-pattern opacity-[0.12] pointer-events-none"></div>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 mb-16 relative z-10 text-center pt-10">
        <div class="max-w-4xl mx-auto">
            <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-brand/10 text-brand text-xs font-bold tracking-[0.2em] uppercase mb-8 border border-brand/20" data-aos="fade-down">
                Support
            </span>
            <h1 class="text-5xl md:text-7xl lg:text-[5.5rem] font-bold text-navy leading-[1.05] tracking-tight mb-8" data-aos="fade-up">
                Common <span class="text-gradient-blue">questions.</span>
            </h1>
            <p class="text-xl md:text-2xl text-slate-500 leading-relaxed max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Everything you need to know about how we work, pricing, and our engagement models.
            </p>
        </div>
    </section>

    <!-- Interactive FAQ Section (Extended) -->
    <section class="py-16 bg-slate-50 border-y border-slate-100 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-brand/5 blur-[120px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/3"></div>
        <div class="max-w-4xl mx-auto px-6 relative z-10">
            <div class="space-y-4" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <h4 class="text-xl font-bold text-navy">What is your typical project timeline?</h4>
                    <p class="text-slate-500 mt-3 leading-relaxed">Projects typically range from 4 to 12 weeks depending on the scope and complexity. We focus on delivering high-quality results efficiently without compromising on the details.</p>
                </div>
                <div class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <h4 class="text-xl font-bold text-navy">Do you provide maintenance after launch?</h4>
                    <p class="text-slate-500 mt-3 leading-relaxed">Yes, we offer ongoing support and optimization packages to ensure your platform stays competitive. We don't just build and leave; we partner with you for long-term success.</p>
                </div>
                <div class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <h4 class="text-xl font-bold text-navy">What is your pricing model?</h4>
                    <p class="text-slate-500 mt-3 leading-relaxed">We offer both fixed-price projects for clearly defined scopes and retainer models for ongoing product development. Our pricing is transparent and tailored to your specific needs.</p>
                </div>
                <div class="bg-white p-6 md:p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <h4 class="text-xl font-bold text-navy">Can you work with our existing development team?</h4>
                    <p class="text-slate-500 mt-3 leading-relaxed">Absolutely. We frequently collaborate with in-house teams, providing specialized expertise in design, frontend architecture, or strategic planning to complement your internal capabilities.</p>
                </div>
            </div>
            
            <div class="mt-16 text-center">
                <h4 class="text-2xl font-bold text-navy mb-4">Still have questions?</h4>
                <a href="contact.php" class="btn-primary inline-flex">Ask us anything</a>
            </div>
        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>
