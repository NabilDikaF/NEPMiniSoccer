<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>NEP Mini Soccer - Payment</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
<body class="bg-background text-on-background font-body-md antialiased min-h-screen flex flex-col">
<!-- TopNavBar (Nav suppressed due to transactional nature of Payment, but keeping structure as requested by prompt, highlighting none) -->
<header class="bg-surface-container-lowest shadow-sm docked full-width top-0 sticky z-50 transition-colors duration-200">
<div class="flex justify-between items-center px-4 md:px-gutter py-base max-w-container-max mx-auto w-full">
<div class="font-headline-sm md:font-headline-md text-headline-sm md:text-headline-md font-bold text-primary">
                NEP Mini Soccer
            </div>
<nav class="hidden md:flex space-x-md">
<a class="text-secondary font-medium hover:text-primary-container transition-colors duration-200 scale-95 active:scale-90 transition-transform" href="#">Home</a>
<a class="text-secondary font-medium hover:text-primary-container transition-colors duration-200 scale-95 active:scale-90 transition-transform" href="#">My Bookings</a>
<a class="text-secondary font-medium hover:text-primary-container transition-colors duration-200 scale-95 active:scale-90 transition-transform" href="#">Profile</a>
</nav>
<div>
<button class="text-primary font-label-md text-label-md hover:text-primary-container transition-colors duration-200">Logout</button>
</div>
</div>
</header>
<main class="flex-grow w-full max-w-container-max mx-auto px-4 md:px-gutter py-6 md:py-lg flex flex-col items-center">
<div class="w-full max-w-2xl">
<h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg mb-2 md:mb-xs">Complete Payment</h1>
<p class="font-body-md text-body-md text-secondary mb-6 md:mb-lg">Please review your booking details and upload proof of payment.</p>
<div class="bg-surface-container-lowest rounded-lg shadow-sm border border-surface-variant overflow-hidden mb-8 md:mb-lg">
<!-- Receipt Header -->
<div class="bg-surface-container-low px-4 md:px-md py-sm border-b border-surface-variant flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 sm:gap-0">
<span class="font-label-md text-label-md text-secondary uppercase tracking-wider">Invoice #INV-2024-892</span>
<span class="bg-surface-variant text-on-surface-variant font-label-sm text-label-sm px-2 py-1 rounded-full">Pending</span>
</div>
<!-- Receipt Body -->
<div class="p-4 md:p-md space-y-6 md:space-y-md">
<div class="flex flex-col sm:flex-row justify-between items-start gap-4 sm:gap-0">
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Main Field (Rumput Sintetis)</h3>
<p class="font-body-md text-body-md text-secondary">Saturday, 24 August 2024</p>
<p class="font-body-md text-body-md text-secondary">19:00 - 21:00 (2 Hours)</p>
</div>
<div class="text-left sm:text-right">
<span class="font-headline-md text-headline-md text-primary">Rp 400.000</span>
</div>
</div>
<div class="border-t border-surface-variant pt-6 md:pt-md">
<h4 class="font-label-md text-label-md text-on-surface mb-sm">Payment Options</h4>
<div class="space-y-sm">
<label class="flex items-center p-4 md:p-sm min-h-[48px] border border-surface-variant rounded-DEFAULT cursor-pointer hover:bg-surface-container-low transition-colors">
<input checked="" class="text-primary focus:ring-primary h-4 w-4 border-outline" name="payment_type" type="radio" value="dp"/>
<div class="ml-3 flex-grow flex justify-between">
<span class="font-body-md text-body-md">DP (50%)</span>
<span class="font-label-md text-label-md">Rp 200.000</span>
</div>
</label>
<label class="flex items-center p-4 md:p-sm min-h-[48px] border border-surface-variant rounded-DEFAULT cursor-pointer hover:bg-surface-container-low transition-colors">
<input class="text-primary focus:ring-primary h-4 w-4 border-outline" name="payment_type" type="radio" value="full"/>
<div class="ml-3 flex-grow flex justify-between">
<span class="font-body-md text-body-md">Bayar Lunas (100%)</span>
<span class="font-label-md text-label-md">Rp 400.000</span>
</div>
</label>
</div>
<p class="font-label-sm text-label-sm text-secondary mt-xs flex items-start gap-1">
<span class="material-symbols-outlined text-[16px] mt-0.5">info</span>
                            If paying DP, the remaining balance must be settled before kickoff at the venue.
                        </p>
</div>
<div class="border-t border-surface-variant pt-6 md:pt-md">
<h4 class="font-label-md text-label-md text-on-surface mb-sm">Transfer Destination</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-sm">
<div class="bg-surface p-4 md:p-sm rounded-DEFAULT border border-surface-variant flex flex-col min-h-[100px]">
<span class="font-label-md text-label-md text-secondary">BCA</span>
<span class="font-headline-sm text-headline-sm tracking-widest mt-1">123 456 7890</span>
<span class="font-label-sm text-label-sm text-secondary mt-auto pt-2">a.n NEP Mini Soccer</span>
</div>
<div class="bg-surface p-4 md:p-sm rounded-DEFAULT border border-surface-variant flex flex-col min-h-[100px]">
<span class="font-label-md text-label-md text-secondary">Mandiri</span>
<span class="font-headline-sm text-headline-sm tracking-widest mt-1">098 765 4321</span>
<span class="font-label-sm text-label-sm text-secondary mt-auto pt-2">a.n NEP Mini Soccer</span>
</div>
</div>
</div>
<div class="border-t border-surface-variant pt-6 md:pt-md">
<h4 class="font-label-md text-label-md text-on-surface mb-sm">Upload Proof of Transfer</h4>
<div class="flex items-center justify-center w-full">
<label class="flex flex-col items-center justify-center w-full min-h-[160px] md:h-32 border-2 border-outline-variant border-dashed rounded-lg cursor-pointer bg-surface hover:bg-surface-container-low transition-colors p-4" for="dropzone-file">
<div class="flex flex-col items-center justify-center text-center">
<span class="material-symbols-outlined text-secondary mb-2 text-3xl md:text-4xl">cloud_upload</span>
<p class="mb-2 font-label-md text-label-md text-secondary">Click to upload or drag and drop</p>
<p class="font-label-sm text-label-sm text-secondary">JPG, PNG or PDF (MAX. 5MB)</p>
</div>
<input class="hidden" id="dropzone-file" type="file"/>
</label>
</div>
</div>
</div>
<!-- Receipt Footer Action -->
<div class="bg-surface-container-low p-4 md:p-md border-t border-surface-variant">
<button class="w-full bg-primary text-on-primary font-label-md text-label-md py-3.5 px-4 rounded-DEFAULT hover:bg-primary-container shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined" data-icon="check_circle">check_circle</span>
                        Submit Payment Proof
                    </button>
</div>
</div>
<div class="text-center pb-8 md:pb-0">
<button class="text-secondary hover:text-on-surface font-label-md text-label-md transition-colors flex items-center justify-center gap-2 mx-auto py-2">
<span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Cancel and Return
                </button>
</div>
</div>
</main>
<!-- Footer -->
<footer class="bg-surface-container-highest w-full py-8 md:py-lg mt-8 md:mt-xl flat no shadows">
<div class="flex flex-col md:flex-row justify-between items-center px-4 md:px-gutter max-w-container-max mx-auto text-center md:text-left gap-6 md:gap-0">
<div class="font-headline-sm text-headline-sm font-bold text-primary">
                NEP Mini Soccer
            </div>
<div class="flex flex-wrap justify-center md:justify-start gap-4 md:space-x-md">
<a class="text-secondary font-body-md text-body-md hover:text-primary transition-colors opacity-80 hover:opacity-100" href="#">Terms</a>
<a class="text-secondary font-body-md text-body-md hover:text-primary transition-colors opacity-80 hover:opacity-100" href="#">Privacy</a>
<a class="text-secondary font-body-md text-body-md hover:text-primary transition-colors opacity-80 hover:opacity-100" href="#">Support</a>
</div>
<div class="text-secondary font-body-md text-body-md">
                © 2024 NEP Mini Soccer. All rights reserved.
            </div>
</div>
</footer>
</body></html>