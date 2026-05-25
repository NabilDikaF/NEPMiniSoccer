<!DOCTYPE html><html class="light" lang="en"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Forgot Password - NEP Mini Soccer</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "secondary-fixed-dim": "#c3c7cc",
                    "primary-fixed-dim": "#66df75",
                    "surface-dim": "#d9dadb",
                    "surface-bright": "#f8f9fa",
                    "primary": "#006e25",
                    "error-container": "#ffdad6",
                    "surface-container-highest": "#e1e3e4",
                    "on-error": "#ffffff",
                    "on-error-container": "#93000a",
                    "on-tertiary": "#ffffff",
                    "on-background": "#191c1d",
                    "tertiary-fixed-dim": "#ffb1c1",
                    "secondary-container": "#dde0e5",
                    "tertiary": "#ab2d57",
                    "surface-container-low": "#f3f4f5",
                    "on-primary-fixed": "#002106",
                    "error": "#ba1a1a",
                    "on-secondary-fixed": "#181c20",
                    "inverse-on-surface": "#f0f1f2",
                    "tertiary-container": "#ee6189",
                    "on-surface": "#191c1d",
                    "on-primary": "#ffffff",
                    "outline-variant": "#bdcab9",
                    "outline": "#6e7b6b",
                    "on-secondary-fixed-variant": "#43474c",
                    "surface-variant": "#e1e3e4",
                    "on-surface-variant": "#3e4a3c",
                    "background": "#f8f9fa",
                    "on-secondary": "#ffffff",
                    "secondary-fixed": "#e0e3e8",
                    "on-primary-container": "#00330d",
                    "surface-container": "#edeeef",
                    "surface": "#f8f9fa",
                    "surface-container-high": "#e7e8e9",
                    "primary-fixed": "#83fc8e",
                    "inverse-surface": "#2e3132",
                    "on-tertiary-fixed-variant": "#8b1140",
                    "secondary": "#5b5f63",
                    "on-secondary-container": "#5f6368",
                    "surface-container-lowest": "#ffffff",
                    "on-tertiary-fixed": "#3f0018",
                    "surface-tint": "#006e25",
                    "tertiary-fixed": "#ffd9df",
                    "on-tertiary-container": "#5b0025",
                    "on-primary-fixed-variant": "#00531a",
                    "inverse-primary": "#66df75",
                    "primary-container": "#28a745"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "xl": "80px",
                    "container-max": "1200px",
                    "base": "8px",
                    "gutter": "24px",
                    "lg": "48px",
                    "xs": "4px",
                    "sm": "12px",
                    "md": "24px"
            },
            "fontFamily": {
                    "display-lg": ["Inter"],
                    "headline-md": ["Inter"],
                    "body-md": ["Inter"],
                    "body-lg": ["Inter"],
                    "label-md": ["Inter"],
                    "label-sm": ["Inter"],
                    "headline-lg": ["Inter"],
                    "headline-lg-mobile": ["Inter"],
                    "headline-sm": ["Inter"]
            },
            "fontSize": {
                    "display-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "label-md": ["14px", {"lineHeight": "1.2", "fontWeight": "600"}],
                    "label-sm": ["12px", {"lineHeight": "1.2", "fontWeight": "500"}],
                    "headline-lg": ["32px", {"lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                    "headline-lg-mobile": ["28px", {"lineHeight": "1.3", "fontWeight": "700"}],
                    "headline-sm": ["20px", {"lineHeight": "1.4", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
<style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .ambient-glow {
            background: radial-gradient(circle at 50% 50%, rgba(40, 167, 69, 0.05) 0%, transparent 70%);
        }
    </style>
</head>
<body class="bg-background min-h-screen flex flex-col relative overflow-hidden">
<!-- Background Atmospheric Effect -->
<div class="fixed inset-0 ambient-glow pointer-events-none" style="transform: translate(3.86223px, 9.95788px);"></div>
<div class="fixed -top-24 -left-24 w-96 h-96 bg-primary-fixed opacity-10 rounded-full blur-3xl pointer-events-none" style="transform: translate(7.72446px, 19.9158px);"></div>
<div class="fixed -bottom-24 -right-24 w-96 h-96 bg-primary-container opacity-5 rounded-full blur-3xl pointer-events-none" style="transform: translate(11.5867px, 29.8736px);"></div>
<!-- Header / Brand Top Bar -->
<header class="w-full top-0 sticky z-50 shadow-sm bg-surface dark:bg-inverse-surface">
<div class="flex justify-between items-center max-w-container-max mx-auto px-md py-sm">
<div class="font-display-lg text-headline-md font-bold text-primary dark:text-primary-fixed-dim tracking-tight">
                NEP Mini Soccer
            </div>
<div class="hidden md:flex gap-md">
<a class="font-label-md text-label-md text-secondary hover:text-primary transition-colors" href="#">Find Pitches</a>
<a class="font-label-md text-label-md text-secondary hover:text-primary transition-colors" href="#">Community</a>
</div>
</div>
</header>
<!-- Main Content -->
<main class="flex-grow flex items-center justify-center px-md py-xl relative z-10">
<div class="w-full max-w-md">
<!-- Central Card -->
<div class="bg-surface-container-lowest rounded-xl shadow-[0_2px_4px_rgba(33,37,41,0.05)] p-md md:p-lg border border-outline-variant/30 backdrop-blur-sm">
<!-- Icon/Branding -->
<div class="flex justify-center mb-md">
<div class="w-16 h-16 bg-primary-container/10 rounded-full flex items-center justify-center">
<span class="material-symbols-outlined text-primary text-[32px]">lock_reset</span>
</div>
</div>
<!-- Header Text -->
<div class="text-center mb-lg">
<h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Forgot Password</h1>
<p class="font-body-md text-body-md text-on-surface-variant">
                        Enter your email or WhatsApp number to reset your password.
                    </p>
</div>
<!-- Form -->
<form class="space-y-md" id="forgotPasswordForm">
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface-variant block px-xs" for="contact">Email or WhatsApp Number</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/60">alternate_email</span>
<input class="w-full pl-12 pr-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none font-body-md text-body-md" id="contact" name="contact" placeholder="name@example.com or +123..." required="" type="text">
</div>
</div>
<button class="w-full py-3 bg-primary-container text-white font-label-md text-body-md rounded-lg shadow-sm active:scale-[0.98] flex items-center justify-center gap-sm" type="submit">
<span class="">Send Reset Link</span>
<span class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
</button>
</form>
<!-- Back Link -->
<div class="mt-lg pt-md border-t border-outline-variant/20 text-center">
<a class="inline-flex items-center gap-xs font-label-md text-label-md text-primary hover:underline transition-all" href="login">
<span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Back to Login
                    </a>
</div>
</div>
<!-- Additional Help/Legal -->
<div class="mt-md text-center">
<p class="font-label-sm text-label-sm text-secondary">
                    Need more help? <a class="text-primary hover:underline" href="#">Contact Support</a>
</p>
</div>
</div>
</main>
<!-- Footer -->
<footer class="w-full bg-surface-container-low dark:bg-surface-dim mt-auto">
<div class="flex flex-col md:flex-row justify-between items-center max-w-container-max mx-auto px-md py-lg gap-md">
<div class="flex flex-col items-center md:items-start gap-xs">
<span class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed-dim">NEP Mini Soccer</span>
<p class="font-label-md text-label-md text-on-surface-variant dark:text-surface-variant opacity-70">© 2024 NEP Mini Soccer. All rights reserved.</p>
</div>
<nav class="flex flex-wrap justify-center gap-md">
<a class="font-label-md text-label-md text-on-surface-variant dark:text-surface-variant hover:underline hover:text-primary transition-all" href="#">About Us</a>
<a class="font-label-md text-label-md text-on-surface-variant dark:text-surface-variant hover:underline hover:text-primary transition-all" href="#">Terms of Service</a>
<a class="font-label-md text-label-md text-on-surface-variant dark:text-surface-variant hover:underline hover:text-primary transition-all" href="#">Privacy Policy</a>
<a class="font-label-md text-label-md text-on-surface-variant dark:text-surface-variant hover:underline hover:text-primary transition-all" href="#">Contact Support</a>
</nav>
</div>
</footer>
<!-- Image for Visual Context (Hidden/Mock) -->
<div class="hidden">
<img alt="Soccer Pitch Context" data-alt="A clean, wide-angle shot of a vibrant green miniature football pitch under soft, warm late afternoon sunlight. The synthetic turf is crisp and well-maintained, with pristine white painted lines defining the boundaries. In the background, modern sports facility architecture and a clear blue sky create a professional and energetic atmosphere. The overall aesthetic is bright, minimalist, and athletic, perfectly matching a premium sports booking platform’s visual identity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBYyUA-YYV2ah-452_WbHRlvJLKV9W0zhO_76rHdTMP-9Ebz3SQ0FcCQXZsT9rUvz-FHX50IarEM5sastjXDzHHTDmBNNaipSdYbuOW_iW3YLHjvVhMO1YLhtzhikSozEHmflFpUugyFRnuuAfV2vGdDGEBcmYX9dsqkp8YfLfXs69T8Btw0_MnPuiudZQCE_Q9ZbfZ72M_42Cc5gzcAINJFhKoeLL-a_q-HZROCAcBQLc__sYdP44zQoziSyw3bbhoXuzABdjTLKfz">
</div>
<script>
        // Micro-interactions for form submission
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('button');
            const originalContent = btn.innerHTML;
            
            btn.disabled = true;
            btn.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span> <span>Processing...</span>';
            
            setTimeout(() => {
                btn.classList.replace('bg-primary-container', 'bg-green-600');
                btn.innerHTML = '<span class="material-symbols-outlined">check_circle</span> <span>Link Sent!</span>';
                
                setTimeout(() => {
                    alert('If an account exists for ' + document.getElementById('contact').value + ', you will receive a reset link shortly.');
                    btn.disabled = false;
                    btn.innerHTML = originalContent;
                    btn.classList.replace('bg-green-600', 'bg-primary-container');
                }, 1500);
            }, 1000);
        });

        // Simple parallax effect for bg elements
        document.addEventListener('mousemove', (e) => {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            const glows = document.querySelectorAll('.ambient-glow, .parallax-bg');
            glows.forEach((glow, index) => {
                const speed = (index + 1) * 10;
                glow.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
            });
        });
    </script>


</body></html>