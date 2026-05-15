<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>NEP Mini Soccer - Complete Your Booking</title>
<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
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
</head>
<body class="bg-background text-on-background font-body-md antialiased min-h-screen flex flex-col">
<!-- TopNavBar -->
<header class="bg-surface-container-lowest dark:bg-surface-container-highest shadow-sm dark:shadow-none docked full-width top-0 sticky z-50">
<div class="flex justify-between items-center px-gutter py-base max-w-container-max mx-auto w-full">
<!-- Brand -->
<div class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed-dim">
                NEP Mini Soccer
            </div>
<!-- Navigation Links -->
<nav class="hidden md:flex space-x-md items-center">
<!-- Active Item -->
<a class="text-primary dark:text-primary-fixed-dim border-b-2 border-primary font-bold pb-1 hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform" href="#">
                    Home
                </a>
<!-- Inactive Items -->
<a class="text-secondary dark:text-secondary-fixed-dim font-medium hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform" href="#">
                    My Bookings
                </a>
<a class="text-secondary dark:text-secondary-fixed-dim font-medium hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform" href="#">
                    Profile
                </a>
</nav>
<!-- Trailing Action -->
<div class="flex items-center">
<button class="text-secondary dark:text-secondary-fixed-dim font-medium hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform font-label-md text-label-md px-sm py-xs">
                    Logout
                </button>
</div>
</div>
</header>
<!-- Main Content Canvas -->
<main class="flex-grow max-w-container-max mx-auto w-full px-gutter py-xl">
<div class="mb-lg">
<h1 class="font-headline-lg text-headline-lg text-on-surface">Complete Your Booking</h1>
<p class="font-body-md text-body-md text-on-surface-variant mt-xs">Provide your details and select a time slot to secure your pitch.</p>
</div>
<div class="row">
<!-- Left Column: Booking Form -->
<div class="col-12 col-lg-8 flex flex-col gap-lg mb-lg lg:mb-0">
<!-- Section: Contact Info -->
<section class="bg-surface-container-lowest rounded-xl shadow-[0_2px_4px_rgba(33,37,41,0.05)] p-md md:p-lg border border-surface-variant/50">
<h2 class="font-headline-sm text-headline-sm text-on-surface mb-md flex items-center gap-sm">
<span class="material-symbols-outlined text-primary">person</span>
                        Team Information
                    </h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-md">
<div class="flex flex-col">
<label class="font-label-md text-label-md text-on-surface-variant mb-xs" for="teamName">Team Name</label>
<input class="border border-outline-variant bg-surface-bright rounded-lg px-sm py-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors font-body-md text-body-md text-on-surface placeholder:text-secondary-fixed-dim w-full" id="teamName" placeholder="Enter your team name" type="text"/>
</div>
<div class="flex flex-col">
<label class="font-label-md text-label-md text-on-surface-variant mb-xs" for="whatsapp">Captain WhatsApp</label>
<input class="border border-outline-variant bg-surface-bright rounded-lg px-sm py-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors font-body-md text-body-md text-on-surface placeholder:text-secondary-fixed-dim w-full" id="whatsapp" placeholder="e.g. 08123456789" type="tel"/>
</div>
</div>
</section>
<!-- Section: Order Type -->
<section class="bg-surface-container-lowest rounded-xl shadow-[0_2px_4px_rgba(33,37,41,0.05)] p-md md:p-lg border border-surface-variant/50">
<h2 class="font-headline-sm text-headline-sm text-on-surface mb-md flex items-center gap-sm">
<span class="material-symbols-outlined text-primary">sell</span>
                        Order Type
                    </h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-md">
<!-- Selected State (Regular) -->
<label class="relative cursor-pointer">
<input checked="" class="peer sr-only" name="orderType" type="radio" value="regular"/>
<div class="border-2 border-primary-container bg-surface-bright rounded-lg p-md transition-all shadow-[0_8px_16px_rgba(33,37,41,0.08)]">
<div class="flex justify-between items-center mb-xs">
<span class="font-label-md text-label-md text-on-surface font-bold">Regular</span>
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
</div>
<p class="font-body-md text-body-md text-on-surface-variant text-sm">Standard booking for a single session.</p>
</div>
</label>
<!-- Unselected State (Member) -->
<label class="relative cursor-pointer">
<input class="peer sr-only" name="orderType" type="radio" value="member"/>
<div class="border border-outline-variant bg-surface-container-lowest rounded-lg p-md transition-all hover:border-primary-container hover:shadow-[0_2px_4px_rgba(33,37,41,0.05)]">
<div class="flex justify-between items-center mb-xs">
<span class="font-label-md text-label-md text-on-surface font-bold">Member</span>
<span class="material-symbols-outlined text-outline-variant">radio_button_unchecked</span>
</div>
<p class="font-body-md text-body-md text-on-surface-variant text-sm">Recurring booking with member benefits.</p>
</div>
</label>
</div>
</section>
<!-- Section: Time Slot Selection -->
<section class="bg-surface-container-lowest rounded-xl shadow-[0_2px_4px_rgba(33,37,41,0.05)] p-md md:p-lg border border-surface-variant/50">
<div class="flex justify-between items-center mb-md">
<h2 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-sm">
<span class="material-symbols-outlined text-primary">schedule</span>
                            Select Time Slot
                        </h2>
<span class="font-label-sm text-label-sm bg-surface-container py-xs px-sm rounded-full text-on-surface-variant">Today, Oct 24</span>
</div>
<div class="flex flex-col gap-lg">
<!-- Pagi Group -->
<div>
<div class="flex justify-between items-end mb-sm border-b border-surface-variant pb-xs">
<h3 class="font-label-md text-label-md text-on-surface">Pagi (06:00 - 10:00)</h3>
<span class="font-label-md text-label-md text-secondary">Rp 400.000</span>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-sm">
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">06:00</button>
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">07:00</button>
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">08:00</button>
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">09:00</button>
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">10:00</button>
</div>
</div>
<!-- Siang Group -->
<div>
<div class="flex justify-between items-end mb-sm border-b border-surface-variant pb-xs">
<h3 class="font-label-md text-label-md text-on-surface">Siang (11:00 - 15:00)</h3>
<span class="font-label-md text-label-md text-secondary">Rp 300.000</span>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-sm">
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">11:00</button>
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">12:00</button>
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">13:00</button>
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">14:00</button>
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">15:00</button></div>
</div>
<!-- Sore Group -->
<div>
<div class="flex justify-between items-end mb-sm border-b border-surface-variant pb-xs">
<h3 class="font-label-md text-label-md text-on-surface">Sore (16:00 - 17:00)</h3>
<span class="font-label-md text-label-md text-secondary">Rp 500.000</span>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-sm">
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">16:00</button>
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">17:00</button>
</div>
</div>
<!-- Malam Group -->
<div>
<div class="flex justify-between items-end mb-sm border-b border-surface-variant pb-xs">
<h3 class="font-label-md text-label-md text-on-surface">Malam (18:00 - 22:00)</h3>
<span class="font-label-md text-label-md text-secondary">Rp 600.000</span>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-sm">
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">18:00</button>
<!-- Selected Slot -->
<button class="py-md md:py-sm px-sm text-center border-2 border-primary-container bg-primary/10 rounded-lg font-label-sm text-label-sm text-primary font-bold shadow-[0_2px_8px_rgba(40,167,69,0.15)] transition-colors">19:00</button>
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">20:00</button>
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">21:00</button>
<button class="py-md md:py-sm px-sm text-center border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface hover:border-primary hover:text-primary transition-colors bg-surface-container-lowest">22:00</button>
</div>
</div>
</div>
</section>
</div>
<!-- Right Column: Order Summary -->
<div class="col-12 col-lg-4">
<div class="bg-surface-container-lowest rounded-xl shadow-[0_4px_12px_rgba(33,37,41,0.06)] p-md md:p-lg border border-surface-variant/50 sticky top-[100px]">
<h2 class="font-headline-sm text-headline-sm text-on-surface mb-md">Order Summary</h2>
<div class="flex flex-col gap-sm mb-md">
<!-- Summary Item -->
<div class="flex justify-between items-start">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant">Field</span>
<span class="font-label-md text-label-md text-on-surface">Main Pitch A</span>
</div>
</div>
<div class="flex justify-between items-start">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant">Date</span>
<span class="font-label-md text-label-md text-on-surface">Thursday, Oct 24, 2024</span>
</div>
</div>
<div class="flex justify-between items-start">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant">Time Slot (Malam)</span>
<span class="font-label-md text-label-md text-primary font-bold">19:00</span>
</div>
</div>
<div class="flex justify-between items-start">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant">Order Type</span>
<span class="font-label-md text-label-md text-on-surface">Regular</span>
</div>
</div>
</div>
<div class="border-t border-surface-variant pt-md mb-md flex flex-col gap-xs">
<div class="flex justify-between items-center">
<span class="font-body-md text-body-md text-on-surface-variant">Subtotal</span>
<span class="font-body-md text-body-md text-on-surface">Rp 600.000</span>
</div>
<div class="flex justify-between items-center">
<span class="font-body-md text-body-md text-on-surface-variant">Service Fee</span>
<span class="font-body-md text-body-md text-on-surface">Rp 5.000</span>
</div>
</div>
<div class="border-t border-surface-variant pt-sm mb-lg flex justify-between items-center">
<span class="font-headline-sm text-headline-sm text-on-surface font-bold">Total</span>
<span class="font-headline-sm text-headline-sm text-primary font-bold">Rp 605.000</span>
</div>
<button class="w-full bg-primary-container text-on-tertiary hover:bg-primary transition-colors duration-200 rounded-lg py-sm px-md font-label-md text-label-md shadow-[0_2px_4px_rgba(40,167,69,0.2)] hover:shadow-[0_4px_8px_rgba(40,167,69,0.3)] flex justify-center items-center gap-xs">
                        Proceed to Payment
                        <span class="material-symbols-outlined" style="font-size: 18px;">arrow_forward</span>
</button>
<p class="font-label-sm text-label-sm text-center text-on-surface-variant mt-sm flex items-center justify-center gap-xs">
<span class="material-symbols-outlined" style="font-size: 14px;">lock</span>
                        Secure transaction
                    </p>
</div>
</div>
</div>
</main>
<!-- Footer -->
<footer class="bg-surface-container-highest dark:bg-inverse-surface w-full py-lg mt-xl flat no shadows">
<div class="flex flex-col md:flex-row justify-between items-center px-gutter max-w-container-max mx-auto space-y-md md:space-y-0">
<!-- Brand / Copyright -->
<div class="flex flex-col items-center md:items-start">
<span class="font-headline-sm text-headline-sm font-bold text-primary dark:text-primary-fixed-dim mb-xs">
                    NEP Mini Soccer
                </span>
<span class="font-body-md text-body-md text-on-surface dark:text-inverse-on-surface">
                    © 2024 NEP Mini Soccer. All rights reserved.
                </span>
</div>
<!-- Links -->
<nav class="flex space-x-md">
<a class="font-body-md text-body-md text-secondary dark:text-secondary-fixed-dim hover:text-primary transition-colors opacity-80 hover:opacity-100 transition-opacity" href="#">
                    Terms
                </a>
<a class="font-body-md text-body-md text-secondary dark:text-secondary-fixed-dim hover:text-primary transition-colors opacity-80 hover:opacity-100 transition-opacity" href="#">
                    Privacy
                </a>
<a class="font-body-md text-body-md text-secondary dark:text-secondary-fixed-dim hover:text-primary transition-colors opacity-80 hover:opacity-100 transition-opacity" href="#">
                    Support
                </a>
</nav>
</div>
</footer>
<script crossorigin="anonymous" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body></html>