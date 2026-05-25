<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Verifikasi Pembayaran - NEP Admin</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface antialiased min-h-screen flex">
<!-- SideNavBar Component -->
<nav class="fixed left-0 top-0 h-screen w-64 hidden md:flex flex-col bg-surface-container-low dark:bg-surface-dim shadow-sm dark:shadow-none z-40">
<div class="flex flex-col h-full p-md space-y-base">
<div class="flex items-center gap-sm mb-lg">
<img alt="Admin Avatar" class="w-12 h-12 rounded-full object-cover" src="https://www.gstatic.com/labs-code/stitch/stitch-placeholder-300x300.svg"/>
<div>
<h2 class="font-headline-sm text-headline-sm font-bold text-primary dark:text-primary-fixed-dim">NEP Admin</h2>
<p class="font-label-sm text-label-sm text-secondary">Field Management</p>
</div>
</div>
<div class="flex-1 space-y-sm">
<a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md" href="dashboard">
<span class="material-symbols-outlined">dashboard</span>
<span class="">Dashboard</span>
</a>
<a class="flex items-center gap-sm p-sm text-primary dark:text-primary-fixed-dim bg-surface-container-high dark:bg-surface-container rounded-lg transition-all translate-x-0 font-label-md text-label-md" href="verifikasi">
<span class="material-symbols-outlined">fact_check</span>
<span class="">Verifikasi</span>
</a>
<a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md" href="jadwal">
<span class="material-symbols-outlined">calendar_month</span>
<span class="">Kelola Jadwal</span>
</a>
<a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md" href="pelanggan">
<span class="material-symbols-outlined">group</span>
<span class="">Data Pelanggan</span>
</a>
</div>
<div class="mt-auto">
<a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md">
<form method="POST" action="{{ route('logout') }}" class="hidden md:block m-0 p-0">
                @csrf
                <button type="submit" class="flex items-center space-x-xs text-secondary dark:text-secondary-fixed-dim font-medium hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform">
                    <span>Logout</span>
                    <span class="material-symbols-outlined text-sm">logout</span>
                </button>
            </form>
</a>
</div>
</div>
</nav>
<!-- Main Content Area -->
<main class="flex-1 md:ml-64 p-gutter max-w-container-max mx-auto w-full">
<!-- Header -->
<header class="mb-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-sm sm:gap-0">
<div>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Payment Verification</h2>
<p class="font-body-md text-body-md text-secondary mt-xs">Review and approve incoming bank transfer proofs.</p>
</div>
<div class="flex items-center space-x-sm bg-surface-container-lowest px-sm py-xs rounded-lg shadow-sm border border-surface-variant">
<span class="material-symbols-outlined text-secondary">filter_list</span>
<span class="font-label-md text-label-md text-on-surface">Filter: Pending</span>
</div>
</header>
<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-md mb-lg">
<div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-variant flex items-center justify-between">
<div>
<p class="font-label-sm text-label-sm text-secondary mb-xs">Pending Reviews</p>
<p class="font-headline-md text-headline-md text-on-surface font-bold">12</p>
</div>
<div class="w-12 h-12 rounded-full bg-tertiary-container flex items-center justify-center text-on-tertiary-container">
<span class="material-symbols-outlined">pending_actions</span>
</div>
</div>
<div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-variant flex items-center justify-between">
<div>
<p class="font-label-sm text-label-sm text-secondary mb-xs">Approved Today</p>
<p class="font-headline-md text-headline-md text-on-surface font-bold">8</p>
</div>
<div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container">
<span class="material-symbols-outlined">check_circle</span>
</div>
</div>
<div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-variant flex items-center justify-between">
<div>
<p class="font-label-sm text-label-sm text-secondary mb-xs">Rejected</p>
<p class="font-headline-md text-headline-md text-on-surface font-bold">1</p>
</div>
<div class="w-12 h-12 rounded-full bg-error-container flex items-center justify-center text-on-error-container">
<span class="material-symbols-outlined">cancel</span>
</div>
</div>
</div>
<!-- Data Table Section -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm border border-surface-variant overflow-hidden">
<div class="overflow-x-auto w-full">
<table class="w-full text-left border-collapse min-w-[800px] md:min-w-full">
<thead>
<tr class="bg-surface-container-low border-b border-surface-variant">
<th class="font-label-md text-label-md text-secondary py-sm px-md whitespace-nowrap">Date</th>
<th class="font-label-md text-label-md text-secondary py-sm px-md whitespace-nowrap">Team Name</th>
<th class="font-label-md text-label-md text-secondary py-sm px-md whitespace-nowrap">Payment Type</th>
<th class="font-label-md text-label-md text-secondary py-sm px-md whitespace-nowrap">Amount</th>
<th class="font-label-md text-label-md text-secondary py-sm px-md whitespace-nowrap">Proof File</th>
<th class="font-label-md text-label-md text-secondary py-sm px-md text-right whitespace-nowrap">Actions</th>
</tr>
</thead>
<tbody class="font-body-md text-body-md">
<!-- Row 1 -->
<tr class="border-b border-surface-variant hover:bg-surface-bright transition-colors">
<td class="py-md px-md text-on-surface whitespace-nowrap">Oct 24, 14:30</td>
<td class="py-md px-md font-medium text-on-surface whitespace-nowrap">Garuda FC</td>
<td class="py-md px-md text-secondary whitespace-nowrap">DP (50%)</td>
<td class="py-md px-md font-medium text-on-surface whitespace-nowrap">Rp 250.000</td>
<td class="py-md px-md whitespace-nowrap">
<button class="flex items-center space-x-xs text-primary hover:text-primary-container transition-colors font-label-md text-label-md">
<span class="material-symbols-outlined text-[18px]">image</span>
<span class="">View Photo</span>
</button>
</td>
<td class="py-md px-md text-right space-x-xs flex justify-end whitespace-nowrap">
<button class="bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md py-xs px-sm rounded shadow-sm transition-all flex items-center">
<span class="material-symbols-outlined text-[18px] mr-xs">check</span>
                                    Verifikasi
                                </button>
<button class="bg-surface-container hover:bg-error hover:text-on-error text-error font-label-md text-label-md py-xs px-sm rounded shadow-sm border border-surface-variant hover:border-error transition-all flex items-center">
<span class="material-symbols-outlined text-[18px] mr-xs">close</span>
                                    Tolak
                                </button>
</td>
</tr>
<!-- Row 2 -->
<tr class="border-b border-surface-variant hover:bg-surface-bright transition-colors">
<td class="py-md px-md text-on-surface whitespace-nowrap">Oct 24, 11:15</td>
<td class="py-md px-md font-medium text-on-surface whitespace-nowrap">Kickers Club</td>
<td class="py-md px-md text-secondary whitespace-nowrap">Full Payment</td>
<td class="py-md px-md font-medium text-on-surface whitespace-nowrap">Rp 500.000</td>
<td class="py-md px-md whitespace-nowrap">
<button class="flex items-center space-x-xs text-primary hover:text-primary-container transition-colors font-label-md text-label-md">
<span class="material-symbols-outlined text-[18px]">image</span>
<span class="">View Photo</span>
</button>
</td>
<td class="py-md px-md text-right space-x-xs flex justify-end whitespace-nowrap">
<button class="bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md py-xs px-sm rounded shadow-sm transition-all flex items-center">
<span class="material-symbols-outlined text-[18px] mr-xs">check</span>
                                    Verifikasi
                                </button>
<button class="bg-surface-container hover:bg-error hover:text-on-error text-error font-label-md text-label-md py-xs px-sm rounded shadow-sm border border-surface-variant hover:border-error transition-all flex items-center">
<span class="material-symbols-outlined text-[18px] mr-xs">close</span>
                                    Tolak
                                </button>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface-bright transition-colors">
<td class="py-md px-md text-on-surface whitespace-nowrap">Oct 23, 19:45</td>
<td class="py-md px-md font-medium text-on-surface whitespace-nowrap">Weekend Warriors</td>
<td class="py-md px-md text-secondary whitespace-nowrap">DP (50%)</td>
<td class="py-md px-md font-medium text-on-surface whitespace-nowrap">Rp 250.000</td>
<td class="py-md px-md whitespace-nowrap">
<button class="flex items-center space-x-xs text-primary hover:text-primary-container transition-colors font-label-md text-label-md">
<span class="material-symbols-outlined text-[18px]">image</span>
<span class="">View Photo</span>
</button>
</td>
<td class="py-md px-md text-right space-x-xs flex justify-end whitespace-nowrap">
<button class="bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md py-xs px-sm rounded shadow-sm transition-all flex items-center">
<span class="material-symbols-outlined text-[18px] mr-xs">check</span>
                                    Verifikasi
                                </button>
<button class="bg-surface-container hover:bg-error hover:text-on-error text-error font-label-md text-label-md py-xs px-sm rounded shadow-sm border border-surface-variant hover:border-error transition-all flex items-center">
<span class="material-symbols-outlined text-[18px] mr-xs">close</span>
                                    Tolak
                                </button>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination Footer -->
<div class="bg-surface-container-lowest border-t border-surface-variant px-md py-sm flex flex-col sm:flex-row items-center justify-between gap-sm sm:gap-0">
<span class="font-label-sm text-label-sm text-secondary">Showing 1 to 3 of 12 entries</span>
<div class="flex space-x-xs">
<button class="px-sm py-xs border border-surface-variant rounded text-secondary hover:bg-surface-container-high transition-colors font-label-md text-label-md disabled:opacity-50" disabled="">Prev</button>
<button class="px-sm py-xs bg-primary-container text-on-primary-container rounded font-label-md text-label-md">1</button>
<button class="px-sm py-xs border border-surface-variant rounded text-secondary hover:bg-surface-container-high transition-colors font-label-md text-label-md">2</button>
<button class="px-sm py-xs border border-surface-variant rounded text-secondary hover:bg-surface-container-high transition-colors font-label-md text-label-md">Next</button>
</div>
</div>
</div>
</main>
</body></html>