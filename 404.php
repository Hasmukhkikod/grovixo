<?php
http_response_code(404);
include __DIR__ . '/includes/header.php';
?>

<main class="relative bg-white pt-40 pb-32 overflow-hidden min-h-[70vh] flex items-center">
    <div class="absolute inset-0 bg-mesh opacity-30 pointer-events-none"></div>
    <div class="absolute inset-0 grid-pattern opacity-[0.12] pointer-events-none"></div>

    <div class="max-w-3xl mx-auto px-6 relative z-10 text-center">
        <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-brand/10 text-brand text-xs font-bold tracking-[0.2em] uppercase mb-8 border border-brand/20">
            404
        </span>
        <h1 class="text-5xl md:text-7xl font-bold text-navy leading-[1.05] tracking-tight mb-6">
            Page not <span class="text-gradient-blue">found.</span>
        </h1>
        <p class="text-xl text-slate-500 leading-relaxed max-w-xl mx-auto mb-10">
            The page you're looking for doesn't exist or may have moved. Let's get you back on track.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/" class="btn-primary inline-flex">Back to Home</a>
            <a href="/services" class="inline-flex items-center gap-2 text-navy font-semibold hover:text-brand transition-colors">
                Explore our services
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
