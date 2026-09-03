<?php
require_once __DIR__ . '/includes/db.php';
$form_msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_contact'])) {
    $name = trim(($_POST['first_name'] ?? '') . ' ' . ($_POST['last_name'] ?? ''));
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['project_type'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!empty($name) && !empty($email) && !empty($message)) {
        if ($pdo) {
            $stmt = $pdo->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$name, $email, $subject, $message])) {
                $form_msg = "<div class='bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6 font-medium'>Thank you! Your message has been sent successfully. We will get back to you shortly.</div>";
            } else {
                $form_msg = "<div class='bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 font-medium'>Sorry, something went wrong. Please try again.</div>";
            }
        } else {
            $form_msg = "<div class='bg-yellow-50 border border-yellow-200 text-yellow-700 p-4 rounded-xl mb-6 font-medium'>Message not saved (Local testing mode active: Database disconnected).</div>";
        }
    } else {
        $form_msg = "<div class='bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 font-medium'>Please fill in all required fields.</div>";
    }
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<main>
        <!-- Hero + Form -->
        <section class="relative overflow-hidden border-b border-slate-100 bg-white pt-14 pb-20 lg:pt-24 lg:pb-32 grid-bg">
            <div class="max-w-6xl mx-auto px-6 relative z-10 grid lg:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <p class="inline-flex items-center gap-2 text-xs font-semibold text-brand bg-white border border-blue-100 shadow-sm rounded-full px-3 py-1.5 mb-6">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        Get in Touch
                    </p>
                    <h1 class="font-display text-4xl sm:text-5xl xl:text-[3.4rem] font-extrabold tracking-tight leading-[1.08] text-navy mb-6">
                        Ready to start your <em class="serif text-brand">next project?</em>
                    </h1>
                    <p class="text-lg text-slate-600 leading-relaxed mb-10">
                        Fill out the form and we'll get back to you within 24 hours. We're currently taking on new projects for Q3 2026.
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-brand shrink-0">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-navy">Email Us</div>
                                <div class="text-slate-500 text-sm">info@grovixo.com</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500 shrink-0">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-navy">Call Us</div>
                                <div class="text-slate-500 text-sm">+91 99787 40360</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-left" data-aos-delay="100">
                    <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-2xl shadow-slate-200/50">
                        <h3 class="text-2xl font-bold text-navy mb-6">Send us a message</h3>
                        <?= $form_msg ?>
                        <form action="contact.php" method="POST" class="space-y-5">
                            <div class="grid grid-cols-2 gap-5">
                                <div>
                                    <label for="first_name" class="block text-sm font-bold text-navy mb-2">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="w-full bg-slate-50 border border-slate-200 text-navy rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-brand/50 focus:border-brand transition-colors" placeholder="Your First Name" required>
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-bold text-navy mb-2">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="w-full bg-slate-50 border border-slate-200 text-navy rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-brand/50 focus:border-brand transition-colors" placeholder="Your Last Name" required>
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-bold text-navy mb-2">Email Address</label>
                                <input type="email" name="email" id="email" class="w-full bg-slate-50 border border-slate-200 text-navy rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-brand/50 focus:border-brand transition-colors" placeholder="Your Email Address" required>
                            </div>
                            <div>
                                <label for="project_type" class="block text-sm font-bold text-navy mb-2">What do you need help with?</label>
                                <select name="project_type" id="project_type" class="w-full bg-slate-50 border border-slate-200 text-navy rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-brand/50 focus:border-brand transition-colors appearance-none">
                                    <option value="">Select a service...</option>
                                    <option value="branding">Branding & Identity</option>
                                    <option value="web_design">Website Design</option>
                                    <option value="web_dev">Web Development</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-bold text-navy mb-2">Project Details</label>
                                <textarea name="message" id="message" rows="4" class="w-full bg-slate-50 border border-slate-200 text-navy rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-brand/50 focus:border-brand transition-colors resize-y" placeholder="Tell us about your goals, timeline, and budget..." required></textarea>
                            </div>
                            <input type="hidden" name="submit_contact" value="1">
                            <button type="submit" class="btn-primary w-full mt-4">Submit Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Locations -->
        <section class="py-24 bg-slate-50 border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-6 text-center" data-aos="fade-up">
                <p class="text-sm font-bold text-brand uppercase tracking-widest mb-2">Our Locations</p>
                <h2 class="text-3xl md:text-4xl font-bold text-navy mb-16">Where the magic happens.</h2>
                
                <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto text-left">
                    <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm flex items-start gap-4" data-aos="fade-up">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-brand shrink-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-navy mb-2">Vadodara</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-4">Alkapuri<br>Vadodara, Gujarat 390007<br>India</p>
                            <a href="#" class="text-brand font-bold text-sm hover:underline">Get Directions →</a>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm flex items-start gap-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-brand shrink-0">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-navy mb-2">Remote Hub</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-4">Our team works distributed across India and global time zones to serve our international clients.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

<?php include __DIR__ . '/includes/footer.php'; ?>
