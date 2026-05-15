<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>My Bookings - NEP Mini Soccer</title>
<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Theme Configuration -->
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary": "#ffffff",
                        "surface-bright": "#f8f9fa",
                        "surface-container": "#edeeef",
                        "on-primary-fixed": "#002106",
                        "background": "#f8f9fa",
                        "on-secondary-fixed-variant": "#43474c",
                        "secondary": "#5b5f63",
                        "on-tertiary-container": "#5b0025",
                        "on-primary-container": "#00330d",
                        "surface-container-high": "#e7e8e9",
                        "tertiary-container": "#ee6189",
                        "surface": "#f8f9fa",
                        "secondary-container": "#dde0e5",
                        "secondary-fixed": "#e0e3e8",
                        "primary-fixed-dim": "#66df75",
                        "surface-variant": "#e1e3e4",
                        "on-surface-variant": "#3e4a3c",
                        "secondary-fixed-dim": "#c3c7cc",
                        "on-error-container": "#93000a",
                        "tertiary-fixed": "#ffd9df",
                        "on-secondary-fixed": "#181c20",
                        "on-secondary-container": "#5f6368",
                        "on-tertiary-fixed-variant": "#8b1140",
                        "tertiary-fixed-dim": "#ffb1c1",
                        "primary-container": "#28a745",
                        "outline": "#6e7b6b",
                        "inverse-surface": "#2e3132",
                        "on-primary-fixed-variant": "#00531a",
                        "on-secondary": "#ffffff",
                        "surface-container-highest": "#e1e3e4",
                        "surface-container-lowest": "#ffffff",
                        "surface-dim": "#d9dadb",
                        "on-background": "#191c1d",
                        "primary": "#006e25",
                        "tertiary": "#ab2d57",
                        "primary-fixed": "#83fc8e",
                        "surface-tint": "#006e25",
                        "on-primary": "#ffffff",
                        "error": "#ba1a1a",
                        "outline-variant": "#bdcab9",
                        "surface-container-low": "#f3f4f5",
                        "inverse-on-surface": "#f0f1f2",
                        "on-error": "#ffffff",
                        "inverse-primary": "#66df75",
                        "on-tertiary-fixed": "#3f0018",
                        "on-surface": "#191c1d",
                        "error-container": "#ffdad6"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xl": "80px",
                        "gutter": "24px",
                        "lg": "48px",
                        "base": "8px",
                        "xs": "4px",
                        "md": "24px",
                        "container-max": "1200px",
                        "sm": "12px"
                    },
                    "fontFamily": {
                        "headline-lg-mobile": ["Inter"],
                        "label-sm": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "headline-sm": ["Inter"],
                        "body-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "display-lg": ["Inter"],
                        "headline-md": ["Inter"]
                    },
                    "fontSize": {
                        "headline-lg-mobile": ["28px", { "lineHeight": "1.3", "fontWeight": "700" }],
                        "label-sm": ["12px", { "lineHeight": "1.2", "fontWeight": "500" }],
                        "label-md": ["14px", { "lineHeight": "1.2", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "headline-sm": ["20px", { "lineHeight": "1.4", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "body-md": ["16px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "display-lg": ["48px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-md": ["24px", { "lineHeight": "1.4", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-md text-body-md antialiased min-h-screen flex flex-col">
<!-- TopNavBar Component -->
<nav class="bg-surface-container-lowest w-full top-0 sticky z-50 shadow-sm transition-colors duration-200">
<div class="flex justify-between items-center px-gutter py-base max-w-container-max mx-auto w-full">
<div class="font-headline-md text-headline-md font-bold text-primary flex items-center gap-sm">
<span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">sports_soccer</span>
                NEP Mini Soccer
            </div>
<div class="hidden md:flex items-center space-x-md">
<a class="text-secondary font-medium hover:text-primary-container transition-colors duration-200 font-label-md text-label-md" href="#">Home</a>
<!-- Active State Applied Here based on exact intent match -->
<a class="text-primary border-b-2 border-primary font-bold pb-1 hover:text-primary-container transition-colors duration-200 font-label-md text-label-md" href="#">My Bookings</a>
<a class="text-secondary font-medium hover:text-primary-container transition-colors duration-200 font-label-md text-label-md" href="#">Profile</a>
</div>
<div class="hidden md:flex items-center">
<button class="text-secondary font-label-md text-label-md hover:text-primary transition-colors scale-95 active:scale-90 transition-transform">Logout</button>
</div>
<button class="md:hidden text-on-surface p-xs rounded hover:bg-surface-container transition-colors">
<span class="material-symbols-outlined">menu</span>
</button>
</div>
</nav>
<!-- Main Content Canvas -->
<main class="flex-grow w-full max-w-container-max mx-auto px-gutter py-xl">
<!-- Page Header -->
<header class="mb-lg flex flex-col md:flex-row md:items-end justify-between gap-md">
<div>
<h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Booking History</h1>
<p class="font-body-md text-body-md text-secondary">Manage your upcoming matches and review past bookings.</p>
</div>
<!-- Filter Pills -->
<div class="flex gap-sm overflow-x-auto pb-xs hide-scrollbar">
<button class="px-md py-xs bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-sm whitespace-nowrap">All Bookings</button>
<button class="px-md py-xs bg-surface-container-lowest border border-outline-variant text-secondary rounded-full font-label-md text-label-md hover:bg-surface-container transition-colors whitespace-nowrap">Upcoming</button>
<button class="px-md py-xs bg-surface-container-lowest border border-outline-variant text-secondary rounded-full font-label-md text-label-md hover:bg-surface-container transition-colors whitespace-nowrap">Past</button>
</div>
</header>
<!-- Bento Grid Layout for Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-md">
<!-- Card 1: Half-Paid/DP (Action Required) -->
<article class="bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-300 flex flex-col border border-surface-variant relative overflow-hidden">
<div class="absolute top-0 left-0 w-full h-1 bg-secondary-fixed-dim"></div>
<div class="flex flex-col sm:flex-row justify-between items-start mb-sm gap-sm">
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Main Field A</h3>
<p class="font-label-sm text-label-sm text-secondary flex items-center gap-xs mt-xs">
<span class="material-symbols-outlined text-[16px]">calendar_today</span>
                            Sat, 28 Oct 2024 • 19:00 - 21:00
                        </p>
</div>
<!-- Half-Paid Badge (Mapped to secondary-fixed for a neutral/blue-ish intent within palette) -->
<span class="px-sm py-xs bg-secondary-fixed text-on-secondary-fixed rounded-full font-label-sm text-label-sm whitespace-nowrap">Half-Paid/DP</span>
</div>
<div class="flex flex-col gap-xs py-sm border-t border-surface-variant mt-sm">
<div class="flex justify-between items-center">
<span class="font-label-md text-label-md text-secondary">Booking ID</span>
<span class="font-body-md text-body-md text-on-surface font-medium">#NEP-8842</span>
</div>
<div class="flex justify-between items-center">
<span class="font-label-md text-label-md text-secondary">Total Price</span>
<span class="font-body-md text-body-md text-on-surface font-medium">Rp 600.000</span>
</div>
<div class="flex justify-between items-center mt-xs p-xs bg-surface-container-low rounded">
<span class="font-label-md text-label-md text-secondary">Remaining Balance</span>
<span class="font-body-md text-body-md text-on-surface font-bold">Rp 300.000</span>
</div>
</div>
<div class="mt-auto pt-sm flex flex-col sm:flex-row gap-sm justify-end w-full">
<button class="w-full sm:w-auto text-center justify-center px-md py-sm border border-outline text-secondary rounded font-label-md text-label-md hover:bg-surface-container-low transition-colors">Reschedule</button>
<button class="w-full sm:w-auto text-center justify-center px-md py-sm bg-primary text-on-primary rounded font-label-md text-label-md shadow-sm hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all flex items-center gap-xs">
<span class="material-symbols-outlined text-[18px]">payments</span>
                        Bayar Pelunasan
                    </button>
</div>
</article>
<!-- Card 2: Menunggu Verifikasi -->
<article class="bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-300 flex flex-col border border-surface-variant relative overflow-hidden">
<div class="absolute top-0 left-0 w-full h-1 bg-tertiary-fixed"></div>
<div class="flex flex-col sm:flex-row justify-between items-start mb-sm gap-sm">
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Training Pitch C</h3>
<p class="font-label-sm text-label-sm text-secondary flex items-center gap-xs mt-xs">
<span class="material-symbols-outlined text-[16px]">calendar_today</span>
                            Sun, 29 Oct 2024 • 16:00 - 18:00
                        </p>
</div>
<!-- Menunggu Verifikasi Badge (Mapped to tertiary for warning intent) -->
<span class="px-sm py-xs bg-tertiary-fixed text-on-tertiary-fixed rounded-full font-label-sm text-label-sm whitespace-nowrap">Menunggu Verifikasi</span>
</div>
<div class="flex flex-col gap-xs py-sm border-t border-surface-variant mt-sm">
<div class="flex justify-between items-center">
<span class="font-label-md text-label-md text-secondary">Booking ID</span>
<span class="font-body-md text-body-md text-on-surface font-medium">#NEP-8845</span>
</div>
<div class="flex justify-between items-center">
<span class="font-label-md text-label-md text-secondary">Total Price</span>
<span class="font-body-md text-body-md text-on-surface font-medium">Rp 450.000</span>
</div>
<div class="mt-xs font-label-sm text-label-sm text-secondary bg-surface-container p-xs rounded">
                        Admin is reviewing your payment proof.
                    </div>
</div>
<div class="mt-auto pt-sm flex flex-col sm:flex-row gap-sm justify-end w-full">
<button class="w-full sm:w-auto text-center justify-center px-md py-sm border border-error text-error rounded font-label-md text-label-md hover:bg-error-container transition-colors">Cancel</button>
</div>
</article>
<!-- Card 3: Confirmed/Lunas -->
<article class="bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-300 flex flex-col border border-surface-variant relative overflow-hidden">
<div class="absolute top-0 left-0 w-full h-1 bg-primary-container"></div>
<div class="flex flex-col sm:flex-row justify-between items-start mb-sm gap-sm">
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Main Field B</h3>
<p class="font-label-sm text-label-sm text-secondary flex items-center gap-xs mt-xs">
<span class="material-symbols-outlined text-[16px]">calendar_today</span>
                            Mon, 30 Oct 2024 • 20:00 - 22:00
                        </p>
</div>
<!-- Confirmed Badge -->
<span class="px-sm py-xs bg-primary-container text-on-primary-container rounded-full font-label-sm text-label-sm whitespace-nowrap">Confirmed/Lunas</span>
</div>
<div class="flex flex-col gap-xs py-sm border-t border-surface-variant mt-sm">
<div class="flex justify-between items-center">
<span class="font-label-md text-label-md text-secondary">Booking ID</span>
<span class="font-body-md text-body-md text-on-surface font-medium">#NEP-8812</span>
</div>
<div class="flex justify-between items-center">
<span class="font-label-md text-label-md text-secondary">Total Price</span>
<span class="font-body-md text-body-md text-on-surface font-medium">Rp 600.000</span>
</div>
</div>
<div class="mt-auto pt-sm flex flex-col sm:flex-row gap-sm justify-end w-full">
<button class="w-full sm:w-auto text-center justify-center px-md py-sm border border-outline text-secondary rounded font-label-md text-label-md hover:bg-surface-container-low transition-colors">Reschedule</button>
<button class="w-full sm:w-auto text-center justify-center px-md py-sm border border-error text-error rounded font-label-md text-label-md hover:bg-error-container transition-colors">Cancel</button>
</div>
</article>
<!-- Card 4: Canceled -->
<article class="bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] opacity-80 flex flex-col border border-surface-variant relative overflow-hidden">
<div class="absolute top-0 left-0 w-full h-1 bg-error"></div>
<div class="flex flex-col sm:flex-row justify-between items-start mb-sm gap-sm">
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface line-through text-secondary">Main Field A</h3>
<p class="font-label-sm text-label-sm text-secondary flex items-center gap-xs mt-xs">
<span class="material-symbols-outlined text-[16px]">calendar_today</span>
                            Fri, 20 Oct 2024 • 19:00 - 21:00
                        </p>
</div>
<!-- Canceled Badge -->
<span class="px-sm py-xs bg-error-container text-on-error-container rounded-full font-label-sm text-label-sm whitespace-nowrap">Canceled</span>
</div>
<div class="flex flex-col gap-xs py-sm border-t border-surface-variant mt-sm">
<div class="flex justify-between items-center">
<span class="font-label-md text-label-md text-secondary">Booking ID</span>
<span class="font-body-md text-body-md text-secondary font-medium">#NEP-8750</span>
</div>
</div>
</article>
</div>
</main>
<!-- Footer Component -->
<footer class="bg-surface-container-highest w-full py-lg mt-auto">
<div class="flex flex-col md:flex-row justify-between items-center px-gutter max-w-container-max mx-auto gap-md">
<div class="font-headline-sm text-headline-sm font-bold text-primary flex items-center gap-sm">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">sports_soccer</span>
                NEP Mini Soccer
            </div>
<div class="flex gap-md items-center">
<a class="text-secondary font-body-md text-body-md hover:text-primary transition-colors opacity-80 hover:opacity-100" href="#">Terms</a>
<a class="text-secondary font-body-md text-body-md hover:text-primary transition-colors opacity-80 hover:opacity-100" href="#">Privacy</a>
<a class="text-secondary font-body-md text-body-md hover:text-primary transition-colors opacity-80 hover:opacity-100" href="#">Support</a>
</div>
<div class="text-on-surface font-body-md text-body-md opacity-80 text-center md:text-right">
                © 2024 NEP Mini Soccer. All rights reserved.
            </div>
</div>
</footer>
</body></html>