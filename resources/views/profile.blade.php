<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Profile - NEP Mini Soccer</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary-fixed": "#002106",
                        "tertiary-container": "#ee6189",
                        "on-primary-container": "#00330d",
                        "surface": "#f8f9fa",
                        "on-tertiary-fixed": "#3f0018",
                        "surface-bright": "#f8f9fa",
                        "inverse-surface": "#2e3132",
                        "surface-container-high": "#e7e8e9",
                        "secondary-container": "#dde0e5",
                        "surface-container": "#edeeef",
                        "surface-container-low": "#f3f4f5",
                        "secondary-fixed": "#e0e3e8",
                        "surface-variant": "#e1e3e4",
                        "on-tertiary-container": "#5b0025",
                        "error-container": "#ffdad6",
                        "primary": "#006e25",
                        "outline-variant": "#bdcab9",
                        "on-background": "#191c1d",
                        "tertiary-fixed-dim": "#ffb1c1",
                        "secondary-fixed-dim": "#c3c7cc",
                        "on-tertiary-fixed-variant": "#8b1140",
                        "secondary": "#5b5f63",
                        "on-tertiary": "#ffffff",
                        "on-secondary-fixed": "#181c20",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed-dim": "#66df75",
                        "on-primary": "#ffffff",
                        "tertiary-fixed": "#ffd9df",
                        "outline": "#6e7b6b",
                        "inverse-on-surface": "#f0f1f2",
                        "tertiary": "#ab2d57",
                        "on-surface": "#191c1d",
                        "primary-fixed": "#83fc8e",
                        "on-error-container": "#93000a",
                        "error": "#ba1a1a",
                        "on-secondary-container": "#5f6368",
                        "surface-container-highest": "#e1e3e4",
                        "background": "#f8f9fa",
                        "on-secondary": "#ffffff",
                        "on-primary-fixed-variant": "#00531a",
                        "inverse-primary": "#66df75",
                        "on-surface-variant": "#3e4a3c",
                        "surface-tint": "#006e25",
                        "surface-dim": "#d9dadb",
                        "on-secondary-fixed-variant": "#43474c",
                        "on-error": "#ffffff",
                        "primary-container": "#28a745"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "md": "24px",
                        "base": "8px",
                        "lg": "48px",
                        "container-max": "1200px",
                        "gutter": "24px",
                        "xs": "4px",
                        "xl": "80px",
                        "sm": "12px"
                    },
                    "fontFamily": {
                        "label-sm": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "display-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "headline-sm": ["Inter"],
                        "headline-lg": ["Inter"],
                        "headline-md": ["Inter"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
                        "label-sm": ["12px", { "lineHeight": "1.2", "fontWeight": "500" }],
                        "label-md": ["14px", { "lineHeight": "1.2", "fontWeight": "600" }],
                        "headline-lg-mobile": ["28px", { "lineHeight": "1.3", "fontWeight": "700" }],
                        "display-lg": ["48px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "body-md": ["16px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "headline-sm": ["20px", { "lineHeight": "1.4", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "headline-md": ["24px", { "lineHeight": "1.4", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }]
                    }
                },
            },
        }
    </script>
<style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .active-tab {
            background-color: #f3f4f5;
            border-left: 4px solid #006e25;
            color: #006e25;
        }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen flex flex-col">
<!-- TopNavBar -->
<header class="fixed top-0 w-full z-50 shadow-sm bg-surface dark:bg-inverse-surface h-16">
<div class="flex justify-between items-center h-full px-md md:px-lg max-w-container-max mx-auto">
<div class="flex items-center gap-base">
<span class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed-dim">NEP Mini Soccer</span>
</div>
<!-- Desktop Nav -->
<nav class="hidden md:flex items-center gap-lg">
<a class="font-body-md text-body-md text-secondary hover:text-primary transition-colors" href="/">Home</a>
<a class="font-body-md text-body-md text-secondary hover:text-primary transition-colors" href="mybooking">My Bookings</a>
<a class="font-body-md text-body-md text-primary font-bold border-b-2 border-primary pb-1" href="profile">Profile</a>
</nav>
<div class="flex items-center gap-md">
<button class="material-symbols-outlined text-secondary hover:bg-surface-container-low p-2 rounded-full transition-all" data-icon="notifications">notifications</button>
<form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
    @csrf
    <button type="submit" class="material-symbols-outlined text-secondary hover:bg-surface-container-low p-2 rounded-full transition-all" data-icon="logout" title="Logout">logout</button>
</form>
<div class="w-10 h-10 rounded-full overflow-hidden border border-outline-variant">
<img alt="User profile avatar" class="w-full h-full object-cover" data-alt="A professional headshot of a young adult male with a friendly expression, set against a blurred outdoor athletic background. The lighting is natural and bright, reflecting a clean and modern sports aesthetic. The image is crisp, with high-quality focus on the subject's face, conveying reliability and energy consistent with a premium sports booking platform." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDtG1JnyiMWK7ciwD3BgvE-ZsoGtX44F7pfE3owEkmR3KSTJRpJ5o772dXRSRbVaolwPn29ftCftSw6OSoqIPSaxI-EFUcY2JpCMOfsIzug1AO3noi57fZiu9DCFoIkZ_Q6sibtXg72D1ln2EVMW13RG424_n4ZFJsP142oNoxwstYFsulMZCinhKjHPDABs4KbMxMeMPrNvn01kPswY8a6DPtcIYqjQD3MoT5LmgNckHb7RX8IGQw0L6fGziGWEA1HwAOYwfoZBawE"/>
</div>
</div>
</div>
</header>
<!-- Main Content Shell -->
<main class="flex-grow pt-xl pb-lg px-md md:px-lg max-w-container-max mx-auto w-full mt-16">
<div class="grid grid-cols-1 md:grid-cols-12 gap-lg">
<!-- Sidebar Navigation -->
<aside class="md:col-span-3 space-y-sm">
<div class="bg-surface-container-lowest rounded-xl p-md shadow-sm">
<div class="flex flex-col items-center text-center mb-lg">
<div class="w-24 h-24 rounded-full overflow-hidden mb-sm border-2 border-primary p-1">
<img alt="User avatar large" class="w-full h-full object-cover rounded-full" data-alt="A close-up portrait of a smiling young male athlete in high-definition. The setting is a brightly lit, modern indoor facility with clean lines and soft lighting. The visual style is professional and energetic, using a fresh color palette of white and greens to suggest a healthy, active lifestyle." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBbnuNVpKsvektxc55Qx9GAl_7uZmwdJUYR4yRo85b_u3mcCQNSDukzfUDssinfhvD-cDLzpTRgvFM3BYY7XFcqa6pHl7PSRHmeEoLlij1bqqEVj8s-5PaauF-IHrChjgBbHDOMkUaFSZLjAjG0mng9K1IFvGPKEMI86-4DnjRQCPFmzE2su5EjBSzWol7aUQOWdDzHfm74X5ItYPL_dANzLlpyLuf584eWkQQS79bfMk9SaVU3sNsnbhp18VBGPaSGOYDuM1DcNJOH"/>
</div>
<h2 class="font-headline-sm text-headline-sm text-on-surface">Alex Thompson</h2>
<p class="font-label-md text-label-md text-secondary">Amateur League Member</p>
</div>
<nav class="flex flex-col gap-xs">
<button class="active-tab flex items-center gap-sm px-md py-sm rounded-lg text-left transition-all hover:bg-surface-container-low" id="tab-account" onclick="switchTab('account')">
<span class="material-symbols-outlined" data-icon="person">person</span>
<span class="font-label-md text-label-md">Account Information</span>
</button>
<button class="flex items-center gap-sm px-md py-sm rounded-lg text-left transition-all text-secondary hover:bg-surface-container-low" id="tab-team" onclick="switchTab('team')">
<span class="material-symbols-outlined" data-icon="groups">groups</span>
<span class="font-label-md text-label-md">Team Details</span>
</button>
<button class="flex items-center gap-sm px-md py-sm rounded-lg text-left transition-all text-secondary hover:bg-surface-container-low" id="tab-security" onclick="switchTab('security')">
<span class="material-symbols-outlined" data-icon="security">security</span>
<span class="font-label-md text-label-md">Security</span>
</button>
<hr class="my-sm border-outline-variant"/>
<button class="flex items-center gap-sm px-md py-sm rounded-lg text-left transition-all text-error hover:bg-error-container/10">
<span class="material-symbols-outlined" data-icon="delete">delete</span>
<span class="font-label-md text-label-md">Deactivate Account</span>
</button>
</nav>
</div>
</aside>
<!-- Form Content -->
<section class="md:col-span-9">
<div class="bg-surface-container-lowest rounded-xl p-md md:p-lg shadow-sm">
<!-- Account Information Section -->
<div class="space-y-lg" id="section-account">
<div>
<h3 class="font-headline-md text-headline-md text-on-surface mb-xs">Account Information</h3>
<p class="font-body-md text-body-md text-secondary">Update your personal details and contact information.</p>
</div>
<form class="grid grid-cols-1 md:grid-cols-2 gap-md">
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface">Full Name</label>
<input class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md text-body-md" type="text" value="Alex Thompson"/>
</div>
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface">Email Address</label>
<input class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md text-body-md" type="email" value="alex.thompson@example.com"/>
</div>
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface">WhatsApp Number</label>
<div class="relative">
<span class="absolute left-md top-1/2 -translate-y-1/2 text-secondary font-body-md">+62</span>
<input class="w-full pl-16 pr-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md text-body-md" type="text" value="812-3456-7890"/>
</div>
</div>
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface">Date of Birth</label>
<input class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md text-body-md text-secondary" type="date" value="1992-05-14"/>
</div>
<div class="md:col-span-2 pt-md border-t border-outline-variant flex justify-end">
<button class="bg-primary hover:bg-on-primary-fixed-variant text-on-primary font-label-md text-label-md px-lg py-sm rounded-full shadow-sm active:scale-95 transition-all" type="button">Save Changes</button>
</div>
</form>
</div>
<!-- Team Details Section (Hidden by default) -->
<div class="hidden space-y-lg" id="section-team">
<div>
<h3 class="font-headline-md text-headline-md text-on-surface mb-xs">Team Details</h3>
<p class="font-body-md text-body-md text-secondary">Manage your primary team settings for faster bookings.</p>
</div>
<form class="space-y-md">
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface">Default Team Name</label>
<input class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md text-body-md" type="text" value="Green Rockets FC"/>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-md">
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface">Preferred Position</label>
<select class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md text-body-md">
<option>Forward</option>
<option selected="">Midfielder</option>
<option>Defender</option>
<option>Goalkeeper</option>
</select>
</div>
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface">Jersey Number</label>
<input class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md text-body-md" type="number" value="10"/>
</div>
</div>
<div class="pt-md border-t border-outline-variant flex justify-end">
<button class="bg-primary hover:bg-on-primary-fixed-variant text-on-primary font-label-md text-label-md px-lg py-sm rounded-full shadow-sm active:scale-95 transition-all" type="button">Update Team</button>
</div>
</form>
</div>
<!-- Security Section (Hidden by default) -->
<div class="hidden space-y-lg" id="section-security">
<div>
<h3 class="font-headline-md text-headline-md text-on-surface mb-xs">Security Settings</h3>
<p class="font-body-md text-body-md text-secondary">Manage your password and account protection.</p>
</div>
<form class="space-y-md">
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface">Current Password</label>
<input class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md text-body-md" placeholder="••••••••" type="password"/>
</div>
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface">New Password</label>
<input class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md text-body-md" placeholder="Min. 8 characters" type="password"/>
</div>
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface">Confirm New Password</label>
<input class="w-full px-md py-sm rounded-lg border border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body-md text-body-md" placeholder="Re-type new password" type="password"/>
</div>
<div class="pt-md border-t border-outline-variant flex justify-end">
<button class="bg-primary hover:bg-on-primary-fixed-variant text-on-primary font-label-md text-label-md px-lg py-sm rounded-full shadow-sm active:scale-95 transition-all" type="button">Change Password</button>
</div>
</form>
</div>
</div>
</section>
</div>
</main>
<!-- Footer -->
<footer class="w-full py-xl mt-auto border-t border-outline-variant dark:border-outline bg-surface-container-lowest dark:bg-surface-container-high">
<div class="grid grid-cols-1 md:grid-cols-2 gap-md px-md md:px-lg max-w-container-max mx-auto">
<div class="space-y-sm">
<span class="font-headline-sm text-headline-sm font-bold text-primary dark:text-primary-fixed-dim">NEP Mini Soccer</span>
<p class="font-label-md text-label-md text-on-secondary-container max-w-xs">
                    The premium platform for booking mini-soccer pitches and managing your weekly matches with ease.
                </p>
<p class="font-label-md text-label-md text-secondary mt-md">© 2024 NEP Mini Soccer. All rights reserved.</p>
</div>
<div class="flex flex-wrap gap-lg md:justify-end items-start">
<div class="flex flex-col gap-xs">
<span class="font-label-md text-label-md text-on-surface font-bold mb-xs">Quick Links</span>
<a class="font-label-md text-label-md text-on-secondary-container hover:text-primary hover:underline decoration-primary transition-opacity" href="#">Terms of Service</a>
<a class="font-label-md text-label-md text-on-secondary-container hover:text-primary hover:underline decoration-primary transition-opacity" href="#">Privacy Policy</a>
</div>
<div class="flex flex-col gap-xs">
<span class="font-label-md text-label-md text-on-surface font-bold mb-xs">Support</span>
<a class="font-label-md text-label-md text-on-secondary-container hover:text-primary hover:underline decoration-primary transition-opacity" href="#">Contact Support</a>
<a class="font-label-md text-label-md text-on-secondary-container hover:text-primary hover:underline decoration-primary transition-opacity" href="#">About Us</a>
</div>
</div>
</div>
</footer>
<script>
        function switchTab(tabId) {
            // Hide all sections
            const sections = ['account', 'team', 'security'];
            sections.forEach(id => {
                document.getElementById('section-' + id).classList.add('hidden');
                document.getElementById('tab-' + id).classList.remove('active-tab');
                document.getElementById('tab-' + id).classList.add('text-secondary');
            });

            // Show selected section
            document.getElementById('section-' + tabId).classList.remove('hidden');
            document.getElementById('tab-' + tabId).classList.add('active-tab');
            document.getElementById('tab-' + tabId).classList.remove('text-secondary');
        }

        // Simple button interaction feedback
        document.querySelectorAll('button').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.innerText === 'Save Changes' || this.innerText === 'Update Team' || this.innerText === 'Change Password') {
                    const originalText = this.innerText;
                    this.innerText = 'Processing...';
                    this.classList.add('opacity-80');
                    setTimeout(() => {
                        this.innerText = 'Saved Successfully!';
                        this.classList.replace('bg-primary', 'bg-on-primary-fixed-variant');
                        setTimeout(() => {
                            this.innerText = originalText;
                            this.classList.replace('bg-on-primary-fixed-variant', 'bg-primary');
                            this.classList.remove('opacity-80');
                        }, 2000);
                    }, 800);
                }
            });
        });
    </script>
</body></html>