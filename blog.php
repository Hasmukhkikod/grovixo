<?php 
require_once __DIR__ . '/includes/db.php';
$blogs = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC")->fetchAll();
include __DIR__ . '/includes/header.php'; 
?>

<main class="relative bg-white pt-32 pb-24 overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0 bg-mesh opacity-30 pointer-events-none"></div>
    <div class="absolute inset-0 grid-pattern opacity-[0.12] pointer-events-none"></div>
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-indigo-500/10 blur-[150px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/3"></div>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 mb-16 relative z-10">
        <div class="max-w-3xl">
            <h1 class="text-5xl md:text-7xl font-bold text-navy leading-[1.05] tracking-tight mb-8" data-aos="fade-up">
                Insights from the <span class="text-gradient-blue">studio.</span>
            </h1>
            <p class="text-xl text-slate-500 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                Deep dives into engineering, product design, and the strategies we use to scale modern brands.
            </p>
        </div>
    </section>

    <!-- Category Filters -->
    <section class="max-w-7xl mx-auto px-6 mb-16 relative z-10" data-aos="fade-up" data-aos-delay="200">
        <div class="flex flex-wrap items-center gap-3">
            <button class="px-5 py-2.5 rounded-full bg-navy text-white text-sm font-bold shadow-md shadow-navy/20 hover:scale-105 transition-transform">All Articles</button>
            <button class="px-5 py-2.5 rounded-full bg-white border border-slate-100 text-slate-500 text-sm font-bold hover:border-brand/30 hover:text-brand transition-colors">Engineering</button>
            <button class="px-5 py-2.5 rounded-full bg-white border border-slate-100 text-slate-500 text-sm font-bold hover:border-brand/30 hover:text-brand transition-colors">Product Design</button>
            <button class="px-5 py-2.5 rounded-full bg-white border border-slate-100 text-slate-500 text-sm font-bold hover:border-brand/30 hover:text-brand transition-colors">Strategy</button>
            <button class="px-5 py-2.5 rounded-full bg-white border border-slate-100 text-slate-500 text-sm font-bold hover:border-brand/30 hover:text-brand transition-colors">Company</button>
        </div>
    </section>

    <?php if (count($blogs) > 0): 
        $featured = $blogs[0];
    ?>
    <!-- Featured Post -->
    <section class="max-w-7xl mx-auto px-6 mb-24 relative z-10" data-aos="fade-up">
        <a href="#" class="group block relative rounded-[2.5rem] overflow-hidden border border-slate-100 hover:border-brand/30 transition-all bg-navy min-h-[500px] lg:min-h-[600px] flex items-end">
            <!-- Background Image with Gradient Overlay -->
            <img src="<?= htmlspecialchars($featured['image_url']) ?>" alt="Featured Post" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000 opacity-80 mix-blend-overlay">
            <div class="absolute inset-0 bg-gradient-to-t from-[#050B14] via-[#050B14]/60 to-transparent"></div>
            
            <div class="relative z-10 p-10 md:p-16 w-full max-w-4xl">
                <div class="flex items-center gap-4 mb-6">
                    <span class="inline-block px-4 py-1.5 bg-brand text-white text-xs font-bold uppercase tracking-widest rounded-full"><?= htmlspecialchars($featured['category']) ?></span>
                    <span class="text-white/60 text-sm font-medium"><?= htmlspecialchars($featured['read_time']) ?></span>
                </div>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-[1.1] transition-transform duration-300 group-hover:translate-x-2"><?= htmlspecialchars($featured['title']) ?></h2>
                <p class="text-slate-300 text-lg md:text-xl mb-10 max-w-2xl leading-relaxed transition-transform duration-300 group-hover:translate-x-2 delay-75"><?= htmlspecialchars($featured['excerpt']) ?></p>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($featured['author']) ?>&background=random" alt="Author" class="w-12 h-12 rounded-full border-2 border-white/20">
                        <div>
                            <div class="text-white font-bold text-sm"><?= htmlspecialchars($featured['author']) ?></div>
                            <div class="text-white/50 text-xs">Author • <?= date('M d, Y', strtotime($featured['created_at'])) ?></div>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center justify-center w-12 h-12 rounded-full bg-white/10 backdrop-blur-md border border-white/20 group-hover:bg-brand group-hover:border-brand transition-all">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </div>
            </div>
        </a>
    </section>
    <?php endif; ?>

    <!-- Post Grid -->
    <section class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 gap-y-16">
            <?php 
            $grid_blogs = array_slice($blogs, 1);
            if (count($grid_blogs) > 0): 
                foreach ($grid_blogs as $index => $blog): 
            ?>
            <!-- Post -->
            <article class="group cursor-pointer flex flex-col h-full" data-aos="fade-up" data-aos-delay="<?= ($index % 3) * 100 ?>">
                <div class="relative rounded-[2rem] overflow-hidden aspect-[4/3] mb-8 bg-slate-100 border border-slate-100 group-hover:shadow-[0_20px_50px_-10px_rgba(61,102,223,0.15)] transition-all duration-500">
                    <img src="<?= htmlspecialchars($blog['image_url']) ?>" alt="Post Image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-navy/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="flex-1 flex flex-col">
                    <div class="flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-slate-400 mb-4">
                        <span class="text-brand"><?= htmlspecialchars($blog['category']) ?></span>
                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                        <span><?= date('M d, Y', strtotime($blog['created_at'])) ?></span>
                    </div>
                    <h4 class="text-2xl font-bold text-navy mb-4 leading-tight group-hover:text-brand transition-colors"><?= htmlspecialchars($blog['title']) ?></h4>
                    <p class="text-slate-500 leading-relaxed mb-8 flex-1"><?= htmlspecialchars($blog['excerpt']) ?></p>
                    <div class="flex items-center gap-3 mt-auto pt-6 border-t border-slate-100">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($blog['author']) ?>&background=random" alt="Author" class="w-8 h-8 rounded-full">
                        <div class="text-navy font-bold text-xs"><?= htmlspecialchars($blog['author']) ?></div>
                    </div>
                </div>
            </article>
            <?php 
                endforeach; 
            else: 
            ?>
                <?php if (count($blogs) == 0): ?>
                    <div class="col-span-3 text-center text-slate-500 py-12">No blogs found.</div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        
        <?php if (count($grid_blogs) > 6): ?>
        <div class="mt-20 text-center">
            <button class="px-8 py-4 rounded-full border-2 border-slate-200 text-navy font-bold hover:border-navy transition-colors">Load More Articles</button>
        </div>
        <?php endif; ?>
    </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
