<?php
$currentPage = basename($_SERVER['SCRIPT_NAME']);
$title = "Grovixo — Brand & Product Studio";
$desc = "Grovixo is a strategy-first design & development studio building brands and digital products for startups and businesses.";
$keywords = "agency, development, design studio, web development, branding, SEO, Grovixo";

$meta_descriptions = [
    'about.php' => "Learn about Grovixo's mission, our expert team, and why we are the leading choice for digital product design.",
    'services.php' => "Explore Grovixo's premium services: Web Development, Branding, UI/UX Design, and Digital Marketing.",
    'work.php' => "View our portfolio of successful projects and digital products built by the Grovixo team.",
    'contact.php' => "Get in touch with Grovixo to start your next big project or inquire about our services.",
    'solutions.php' => "Discover our tailored digital solutions designed to accelerate your business growth.",
    'products.php' => "Browse proprietary digital products and SaaS tools built by Grovixo.",
    'technologies.php' => "Explore the cutting-edge tech stack we use to build scalable and secure applications.",
    'career.php' => "Join the Grovixo team. We are always looking for talented developers and designers.",
    'blog.php' => "Read the latest insights, tutorials, and news from the Grovixo engineering and design teams."
];

$titles = [
    'about.php' => "About Us - Grovixo",
    'services.php' => "Our Services - Grovixo",
    'work.php' => "Our Work - Grovixo",
    'contact.php' => "Contact Us - Grovixo",
    'solutions.php' => "Solutions - Grovixo",
    'products.php' => "Products - Grovixo",
    'technologies.php' => "Technologies - Grovixo",
    'career.php' => "Careers - Grovixo",
    'blog.php' => "Blog - Grovixo"
];

if (array_key_exists($currentPage, $titles)) $title = $titles[$currentPage];
if (array_key_exists($currentPage, $meta_descriptions)) $desc = $meta_descriptions[$currentPage];

$canonical_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($desc) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($keywords) ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonical_url) ?>">
    
    <!-- Open Graph / Social SEO -->
    <meta property="og:title" content="<?= htmlspecialchars($title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($desc) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($canonical_url) ?>">
    <meta property="og:image" content="https://grovixo.com/assets/images/og-image.jpg">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($title) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($desc) ?>">
    <link rel="icon" href="assets/images/favicon.png" type="image/png">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&family=Playfair+Display:ital,wght@0,500;0,600;1,500;1,600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#12214f',
                        brand: '#3b5bff',
                        brandHover: '#2d4cf1',
                        ink: '#111111',
                        body: '#60646f'
                    },
                    fontFamily: {
                        sans: ['"DM Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    animation: {
                        'scroll': 'scroll 40s linear infinite',
                    },
                    keyframes: {
                        scroll: {
                            '0%': { transform: 'translateX(0)' },
                            '100%': { transform: 'translateX(calc(-250px * 7))' },
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="assets/css/style.css">
    <?php if ($currentPage == 'work.php'): ?>
    <style>
        .work-card {
            background: #fff; border: 1px solid var(--border); border-radius: 20px; overflow: hidden;
            transition: all 0.3s; box-shadow: 0 4px 12px rgba(0,0,0,0.02); display: block; text-decoration: none;
        }
        .work-card:hover { border-color: #c4d1f2; transform: translateY(-4px); box-shadow: 0 12px 30px rgba(59, 91, 255, 0.08); }
        .work-img-container { width: 100%; aspect-ratio: 16/10; background: var(--bg-light); position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center; color: #a0aec0;}
        .work-badge { position: absolute; top: 16px; left: 16px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; padding: 6px 12px; border-radius: 99px; background: rgba(255,255,255,0.9); backdrop-filter: blur(4px); color: var(--navy); border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
    </style>
    <?php endif; ?>
    <?php if ($currentPage == 'contact.php'): ?>
    <style>
        .form-input {
            width: 100%; padding: 12px 16px; border: 1px solid var(--border); border-radius: 12px;
            background: #fff; color: var(--navy); font-size: 14px; font-family: "DM Sans", sans-serif;
            transition: all 0.2s; outline: none; box-shadow: 0 2px 4px rgba(0,0,0,0.01);
        }
        .form-input:focus { border-color: var(--brand); box-shadow: 0 0 0 4px rgba(59, 91, 255, 0.1); }
        .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--navy); margin-bottom: 6px; }
    </style>
    <?php endif; ?>
    <link rel="preload" href="assets/images/grovixo_logo.png" as="image" type="image/png">
</head>
<body class="bg-white antialiased selection:bg-brand selection:text-white" x-data="{ menuOpen: false }" :class="{ 'overflow-hidden': menuOpen }">

    <!-- Logo (Absolute, Stays at Top) -->
    <header class="absolute top-6 left-0 w-full z-50 pointer-events-none px-6 mix-blend-difference text-white">
        <div class="max-w-7xl mx-auto flex items-center justify-start">
            <a href="/" class="pointer-events-auto flex items-center shrink-0 group">
                <img src="assets/images/grovixo_logo.png" alt="Grovixo Logo" class="h-6 md:h-8 w-auto brightness-0 invert group-hover:opacity-70 transition-opacity">
            </a>
        </div>
    </header>

    <!-- Menu Button (Fixed, Scrolls with Page) -->
    <div class="fixed top-6 left-0 w-full z-50 pointer-events-none px-6 mix-blend-difference text-white">
        <div class="max-w-7xl mx-auto flex items-center justify-end">
            <!-- SVG Plus Icon Menu Button -->
            <button @click="menuOpen = true" aria-label="Open Menu" class="pointer-events-auto flex items-center justify-center p-2 hover:opacity-70 transition-opacity duration-300">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14m-7-7h14"/></svg>
            </button>
        </div>
    </div>

    <!-- Full-Screen Modal Overlay Menu -->
    <div x-show="menuOpen" 
         style="display: none;" 
         class="fixed inset-0 z-[100] bg-[#0A0A0A] text-white flex items-center justify-center"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-8"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-8">
         
        <div class="absolute top-6 left-0 w-full px-6">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-2xl md:text-3xl font-black tracking-tighter text-white font-display">
                        GROVIXO
                    </span>
                </div>
                <button @click="menuOpen = false" aria-label="Close Menu" class="w-12 h-12 rounded-2xl bg-[#1A1A1A] border border-[#2A2A2A] hover:bg-white hover:text-black hover:border-white transition-colors duration-300 flex items-center justify-center text-white">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- Menu Links Grid (Matches Footer Grid) -->
        <div class="w-full max-w-4xl mx-auto px-6 grid grid-cols-2 md:grid-cols-3 gap-12 pt-20">
            <!-- Explore -->
            <div>
                <h4 class="font-semibold text-white mb-6 text-xl md:text-2xl">Explore</h4>
                <ul class="space-y-4 text-base md:text-lg text-slate-400">
                    <li><a href="/" class="hover:text-white transition-colors">Overview</a></li>
                    <li><a href="about.php" class="hover:text-white transition-colors">About</a></li>
                    <li><a href="index.php#why-us" class="hover:text-white transition-colors">Why Us</a></li>
                </ul>
            </div>
            <!-- What We Do -->
            <div>
                <h4 class="font-semibold text-white mb-6 text-xl md:text-2xl">What We Do</h4>
                <ul class="space-y-4 text-base md:text-lg text-slate-400">
                    <li><a href="products.php" class="hover:text-white transition-colors">Products</a></li>
                    <li><a href="services.php" class="hover:text-white transition-colors">Features</a></li>
                    <li><a href="index.php#testimonials" class="hover:text-white transition-colors">Testimonials</a></li>
                </ul>
            </div>
            <!-- Contact -->
            <div>
                <h4 class="font-semibold text-white mb-6 text-xl md:text-2xl">Contact</h4>
                <ul class="space-y-4 text-base md:text-lg text-slate-400">
                    <li><a href="contact.php" class="hover:text-white transition-colors">Start a project</a></li>
                    <li><a href="mailto:info@grovixo.com" class="hover:text-white transition-colors">Email us</a></li>
                    <li><a href="tel:+919978740360" class="hover:text-white transition-colors">Book a call</a></li>
                </ul>
            </div>
        </div>
    </div>

