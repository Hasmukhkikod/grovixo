<?php 
require_once 'includes/db.php';
$careers = $pdo->query("SELECT * FROM careers ORDER BY created_at DESC")->fetchAll();
include 'includes/header.php'; 
?>

<main class="relative bg-white pt-32 pb-24 overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0 bg-mesh opacity-30 pointer-events-none"></div>
    <div class="absolute inset-0 grid-pattern opacity-[0.12] pointer-events-none"></div>
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-brand/10 blur-[150px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute top-[20%] left-0 w-[600px] h-[600px] bg-indigo-500/10 blur-[150px] rounded-full pointer-events-none -translate-x-1/2"></div>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 mb-32 relative z-10 text-center pt-10">
        <div class="max-w-4xl mx-auto">
            <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-brand/10 text-brand text-xs font-bold tracking-[0.2em] uppercase mb-8 border border-brand/20" data-aos="fade-down">
                <span class="w-2 h-2 rounded-full bg-brand animate-pulse"></span>
                We are hiring
            </span>
            <h1 class="text-5xl md:text-7xl lg:text-[5.5rem] font-bold text-navy leading-[1.05] tracking-tight mb-8" data-aos="fade-up">
                Build the digital <span class="text-gradient-blue">future.</span>
            </h1>
            <p class="text-xl md:text-2xl text-slate-500 leading-relaxed max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Join a multidisciplinary team of designers, engineers, and strategists crafting exceptional products for ambitious founders.
            </p>
        </div>
    </section>

    <!-- Culture Bento Grid -->
    <section class="max-w-7xl mx-auto px-6 mb-32 relative z-10">
        <div class="grid md:grid-cols-3 gap-6 auto-rows-[300px]">
            <!-- Bento Item 1: Large image -->
            <div class="md:col-span-2 rounded-[2rem] overflow-hidden relative group" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Team Collaboration" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-navy/90 via-navy/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-10">
                    <h3 class="text-3xl font-bold text-white mb-3">Autonomy & Trust</h3>
                    <p class="text-white/80 max-w-md leading-relaxed">We hire smart people and get out of their way. No micromanagement, just clear goals and the freedom to achieve them.</p>
                </div>
            </div>

            <!-- Bento Item 2: Small stat -->
            <div class="bg-navy rounded-[2rem] p-10 flex flex-col justify-center relative overflow-hidden group" data-aos="fade-left" data-aos-delay="100">
                <div class="absolute inset-0 bg-brand/20 blur-[50px] rounded-full -translate-y-1/2 translate-x-1/2 opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10">
                    <div class="text-5xl font-black text-white mb-2">100%</div>
                    <div class="text-brand font-bold tracking-widest uppercase text-sm mb-4">Remote First</div>
                    <p class="text-slate-400 text-sm leading-relaxed">Work from anywhere in the world. We care about output, not hours logged at a desk.</p>
                </div>
            </div>

            <!-- Bento Item 3: Perks -->
            <div class="bg-white border border-slate-100 rounded-[2rem] p-10 shadow-lg hover:shadow-2xl hover:border-brand/30 transition-all duration-500 hover:-translate-y-2 group cursor-default" data-aos="fade-up">
                <div class="flex justify-between items-start mb-6">
                    <h3 class="text-xl font-bold text-navy pr-4 transition-colors duration-300 group-hover:text-brand">Premium Healthcare</h3>
                    <div class="w-14 h-14 shrink-0 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center group-hover:scale-110 group-hover:bg-emerald-100 group-hover:shadow-[0_0_20px_rgba(16,185,129,0.3)] transition-all duration-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed group-hover:text-slate-700 transition-colors duration-300">Comprehensive medical, dental, and vision coverage for you and your dependents.</p>
            </div>

            <!-- Bento Item 4: Equipment -->
            <div class="bg-white border border-slate-100 rounded-[2rem] p-10 shadow-lg hover:shadow-2xl hover:border-brand/30 transition-all duration-500 hover:-translate-y-2 group cursor-default" data-aos="fade-up" data-aos-delay="100">
                <div class="flex justify-between items-start mb-6">
                    <h3 class="text-xl font-bold text-navy pr-4 transition-colors duration-300 group-hover:text-brand">Top-Tier Setup</h3>
                    <div class="w-14 h-14 shrink-0 rounded-2xl bg-blue-50 text-brand flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-100 group-hover:shadow-[0_0_20px_rgba(37,99,235,0.3)] transition-all duration-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed group-hover:text-slate-700 transition-colors duration-300">Generous workstation stipend upon joining, plus annual budgets for home office upgrades.</p>
            </div>

            <!-- Bento Item 5: Learning -->
            <div class="bg-white border border-slate-100 rounded-[2rem] p-10 shadow-lg hover:shadow-2xl hover:border-brand/30 transition-all duration-500 hover:-translate-y-2 group cursor-default" data-aos="fade-up" data-aos-delay="200">
                <div class="flex justify-between items-start mb-6">
                    <h3 class="text-xl font-bold text-navy pr-4 transition-colors duration-300 group-hover:text-brand">Continuous Growth</h3>
                    <div class="w-14 h-14 shrink-0 rounded-2xl bg-purple-50 text-purple-500 flex items-center justify-center group-hover:scale-110 group-hover:bg-purple-100 group-hover:shadow-[0_0_20px_rgba(168,85,247,0.3)] transition-all duration-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477-4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed group-hover:text-slate-700 transition-colors duration-300">Dedicated annual learning budget for courses, conferences, and books.</p>
            </div>
        </div>
    </section>

    <!-- Open Positions -->
    <section class="max-w-5xl mx-auto px-6 relative z-10">
        <div class="flex items-end justify-between mb-12" data-aos="fade-up">
            <div>
                <h2 class="text-4xl md:text-5xl font-bold text-navy mb-4">Open Roles</h2>
                <p class="text-lg text-slate-500">Find your next career-defining opportunity.</p>
            </div>
            <div class="hidden md:flex gap-2">
                <span class="px-4 py-2 rounded-full bg-brand text-white text-sm font-bold shadow-md shadow-brand/30">All Roles</span>
                <span class="px-4 py-2 rounded-full bg-slate-100 text-slate-500 text-sm font-bold hover:bg-slate-200 cursor-pointer transition-colors">Engineering</span>
                <span class="px-4 py-2 rounded-full bg-slate-100 text-slate-500 text-sm font-bold hover:bg-slate-200 cursor-pointer transition-colors">Design</span>
            </div>
        </div>
        
        <div class="space-y-4">
            <?php if (count($careers) > 0): ?>
                <?php foreach ($careers as $index => $career): ?>
                <!-- Position -->
                <button onclick="openApplyModal('<?= htmlspecialchars(addslashes($career['title'])) ?>')" class="group w-full text-left bg-white border border-slate-100 hover:border-brand/50 rounded-3xl p-8 transition-all duration-300 hover:shadow-[0_20px_50px_-10px_rgba(61,102,223,0.1)] relative overflow-hidden" data-aos="fade-up" data-aos-delay="<?= ($index % 3) * 100 ?>">
                    <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-brand/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-3 mb-3">
                                <h3 class="text-2xl font-bold text-navy group-hover:text-brand transition-colors"><?= htmlspecialchars($career['title']) ?></h3>
                                <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase tracking-widest border border-emerald-100"><?= htmlspecialchars($career['type']) ?></span>
                            </div>
                            <p class="text-slate-500 text-sm max-w-xl leading-relaxed"><?= htmlspecialchars($career['description']) ?></p>
                        </div>
                        <div class="flex items-center gap-6 shrink-0 w-full md:w-auto">
                            <div class="text-sm font-medium text-slate-400">
                                <div class="flex items-center gap-2 mb-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> <?= htmlspecialchars($career['location']) ?></div>
                                <div class="flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> <?= htmlspecialchars($career['department']) ?></div>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-slate-50 group-hover:bg-brand flex items-center justify-center transition-colors shrink-0">
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </div>
                    </div>
                </button>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center text-slate-500 py-12">No open positions right now. Please check back later!</div>
            <?php endif; ?>
            
            <!-- Spontaneous Application -->
            <div class="mt-8 text-center p-12 bg-slate-50/50 rounded-3xl border border-slate-200 border-dashed backdrop-blur-sm relative overflow-hidden group hover:border-brand/40 transition-colors" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-brand/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center mx-auto mb-6 text-2xl">👋</div>
                <h4 class="text-2xl font-bold text-navy mb-3">Don't see a perfect fit?</h4>
                <p class="text-slate-500 max-w-md mx-auto mb-8">We're always looking for extraordinary talent. If you think you'd be a great addition to Grovixo, send us an open application.</p>
                <button onclick="openApplyModal('Open Application')" class="btn-primary inline-flex relative z-10">Send Open Application</button>
            </div>
        </div>
    </section>

    <!-- Application Modal -->
    <div id="applyModal" class="fixed inset-0 z-[100] flex items-center justify-center opacity-0 invisible transition-all duration-300">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-navy/80 backdrop-blur-sm" onclick="closeApplyModal()"></div>
        
        <!-- Modal Content -->
        <div class="relative w-full max-w-lg bg-white rounded-3xl shadow-2xl p-8 md:p-10 mx-4 transform scale-95 opacity-0 transition-all duration-300" id="applyModalContent">
            <button onclick="closeApplyModal()" class="absolute top-6 right-6 w-10 h-10 rounded-full bg-slate-50 hover:bg-slate-100 text-slate-500 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            <div class="mb-8">
                <p class="text-sm font-bold text-brand uppercase tracking-widest mb-2">Apply Now</p>
                <h3 class="text-3xl font-bold text-navy" id="modalJobTitle">Job Title</h3>
            </div>
            
            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-5">
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-navy mb-2">First Name</label>
                        <input type="text" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 transition-all text-sm" placeholder="Your First Name" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-navy mb-2">Last Name</label>
                        <input type="text" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 transition-all text-sm" placeholder="Your Last Name" required>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-navy mb-2">Email Address</label>
                    <input type="email" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 transition-all text-sm" placeholder="Your Email Address" required>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-navy mb-2">Portfolio / LinkedIn URL</label>
                    <input type="url" class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 transition-all text-sm" placeholder="Your Portfolio URL" required>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-navy mb-2">Upload CV (PDF)</label>
                    <div class="relative flex items-center justify-center w-full px-5 py-8 rounded-xl bg-slate-50 border border-slate-200 border-dashed hover:border-brand hover:bg-brand/5 transition-all cursor-pointer overflow-hidden group">
                        <input type="file" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required onchange="document.getElementById('fileName').textContent = this.files[0]?.name || 'Click or drag file to upload'">
                        <div class="text-center relative z-0 flex flex-col items-center">
                            <svg class="w-8 h-8 text-slate-400 group-hover:text-brand transition-colors mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <span id="fileName" class="text-sm text-slate-500 font-medium">Click or drag file to upload</span>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="w-full btn-primary py-4 mt-4">Submit Application</button>
            </form>
        </div>
    </div>
</main>

<script>
function openApplyModal(jobTitle) {
    document.getElementById('modalJobTitle').textContent = jobTitle;
    const modal = document.getElementById('applyModal');
    const content = document.getElementById('applyModalContent');
    
    modal.classList.remove('opacity-0', 'invisible');
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeApplyModal() {
    const modal = document.getElementById('applyModal');
    const content = document.getElementById('applyModalContent');
    
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('opacity-0', 'invisible');
    }, 300);
}
</script>

<?php include 'includes/footer.php'; ?>
