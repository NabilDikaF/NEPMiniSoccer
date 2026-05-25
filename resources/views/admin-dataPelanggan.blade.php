<!DOCTYPE html><html lang="en"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>NEP Admin - Data Pelanggan</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#006e25",
                        "on-secondary": "#ffffff",
                        "on-secondary-container": "#5f6368",
                        "error-container": "#ffdad6",
                        "on-surface-variant": "#3e4a3c",
                        "primary-fixed": "#83fc8e",
                        "tertiary-fixed-dim": "#ffb1c1",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-highest": "#e1e3e4",
                        "outline": "#6e7b6b",
                        "surface-container-high": "#e7e8e9",
                        "surface-bright": "#f8f9fa",
                        "secondary-fixed-dim": "#c3c7cc",
                        "on-tertiary-container": "#5b0025",
                        "surface-variant": "#e1e3e4",
                        "on-secondary-fixed-variant": "#43474c",
                        "on-secondary-fixed": "#181c20",
                        "secondary-container": "#dde0e5",
                        "on-primary-fixed-variant": "#00531a",
                        "on-primary-container": "#00330d",
                        "on-background": "#191c1d",
                        "on-error-container": "#93000a",
                        "surface-dim": "#d9dadb",
                        "surface-container-low": "#f3f4f5",
                        "secondary-fixed": "#e0e3e8",
                        "surface-container": "#edeeef",
                        "tertiary": "#ab2d57",
                        "inverse-primary": "#66df75",
                        "error": "#ba1a1a",
                        "on-tertiary-fixed": "#3f0018",
                        "primary-fixed-dim": "#66df75",
                        "on-surface": "#191c1d",
                        "on-primary": "#ffffff",
                        "surface-tint": "#006e25",
                        "surface": "#f8f9fa",
                        "on-error": "#ffffff",
                        "tertiary-container": "#ee6189",
                        "tertiary-fixed": "#ffd9df",
                        "on-tertiary-fixed-variant": "#8b1140",
                        "on-primary-fixed": "#002106",
                        "outline-variant": "#bdcab9",
                        "primary-container": "#28a745",
                        "inverse-on-surface": "#f0f1f2",
                        "background": "#f8f9fa",
                        "on-tertiary": "#ffffff",
                        "inverse-surface": "#2e3132",
                        "secondary": "#5b5f63"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "md": "24px",
                        "container-max": "1200px",
                        "base": "8px",
                        "sm": "12px",
                        "gutter": "24px",
                        "xl": "80px",
                        "lg": "48px",
                        "xs": "4px"
                    },
                    "fontFamily": {
                        "body-lg": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "label-md": ["Inter"],
                        "display-lg": ["Inter"],
                        "label-sm": ["Inter"],
                        "headline-md": ["Inter"],
                        "headline-sm": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-md": ["Inter"]
                    },
                    "fontSize": {
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-lg-mobile": ["28px", {"lineHeight": "1.3", "fontWeight": "700"}],
                        "label-md": ["14px", {"lineHeight": "1.2", "fontWeight": "600"}],
                        "display-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-sm": ["12px", {"lineHeight": "1.2", "fontWeight": "500"}],
                        "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "headline-sm": ["20px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}]
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
<body class="bg-background text-on-background font-body-md antialiased flex h-screen overflow-hidden">
<!-- SideNavBar -->
<nav class="fixed left-0 top-0 h-screen w-64 hidden md:flex flex-col bg-surface-container-low dark:bg-surface-dim shadow-sm dark:shadow-none z-40">
<div class="flex flex-col h-full p-md space-y-base">
<div class="flex items-center gap-sm mb-lg">
<img alt="Admin Avatar" class="w-12 h-12 rounded-full object-cover" data-alt="A professional headshot of an administrative professional in a bright, modern office setting. The lighting is crisp and even, reflecting a high-quality SaaS dashboard aesthetic. The mood is welcoming yet authoritative, fitting for a sports management software interface. The color palette incorporates subtle green tones in the background to match the brand identity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB7P06HlnPnTGTIQuNNgTlnKq1RROsE5TAeBSnc0WLBm5xhrBSmkagDA_4_zqSQSIKnE7-Ky9btQSpHNa5hoAxkEuFrEqNldfU8t-cGgHvknlboNP5L9OiTeO48IWSDIRqgeeli43xBMRuBxMF-uiU1edHDNqriSNkQe5HmhMWeU8a-T6Y8jvKmzv25ZjuADai3bqJi3ggpWfprJowhiJAYEmsdMAWvyTDZpkaNi5QTwOc0lPgopxQu9HuR6M8IcGeL0PqXDZG0I_3c">
<div>
<h2 class="font-headline-sm text-headline-sm font-bold text-primary dark:text-primary-fixed-dim">NEP Admin</h2>
<p class="font-label-sm text-label-sm text-secondary">Field Management</p>
</div>
</div>
<div class="flex-1 space-y-sm"><a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md" href="dashboard">
<span class="material-symbols-outlined">dashboard</span>
<span class="">Dashboard</span>
</a>
<a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md" href="verifikasi">
<span class="material-symbols-outlined">fact_check</span>
<span class="">Verifikasi</span>
</a>
<a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md" href="jadwal">
<span class="material-symbols-outlined">calendar_month</span>
<span class="">Kelola Jadwal</span>
</a>
<a class="flex items-center gap-sm p-sm text-primary dark:text-primary-fixed-dim bg-surface-container-high dark:bg-surface-container rounded-lg transition-all translate-x-0 font-label-md text-label-md" href="pelanggan">
<span class="material-symbols-outlined">group</span>
<span class="">Data Pelanggan</span>
</a></div>
<div class="mt-auto">
<a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md">
<span class="material-symbols-outlined">logout</span>
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
<!-- TopNavBar (Mobile only for admin context to match requirements if needed, but using SideNav for desktop. We'll add a simplified mobile header) -->
<header class="md:hidden flex justify-between items-center px-gutter py-base w-full bg-surface-container-lowest shadow-sm sticky top-0 z-50">
<h1 class="font-headline-md text-headline-md font-bold text-primary">NEP Admin</h1>
<button class="text-secondary"><span class="material-symbols-outlined">menu</span></button>
</header>
<!-- Main Content -->
<main class="flex-1 flex flex-col h-full ml-0 md:ml-64 bg-surface-bright overflow-y-auto">
<div class="p-gutter md:p-xl max-w-container-max mx-auto w-full">
<!-- Header Section -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-lg gap-md">
<div>
<h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Data Pelanggan</h1>
<p class="font-body-md text-body-md text-secondary">Manajemen data pelanggan dan riwayat pemesanan lapangan.</p>
</div>
<div class="relative w-full md:w-auto">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary">search</span>
<input class="w-full md:w-64 pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] transition-shadow hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)]" placeholder="Cari nama tim..." type="text">
</div>
</div>
<!-- Data Table Card -->
<div class="bg-surface-container-lowest rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low border-b border-surface-variant">
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant w-16 text-center">No</th>
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant">Nama Kapten</th>
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant">Nama Tim</th>
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant">No. WhatsApp</th>
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant text-center">Total Booking</th>
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant">Status</th>
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant text-center">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-variant font-body-md text-body-md">
<!-- Row 1 -->
<tr class="hover:bg-surface transition-colors">
<td class="px-md py-sm text-center text-secondary">1</td>
<td class="px-md py-sm font-medium text-on-surface">Budi Santoso</td>
<td class="px-md py-sm">Garuda FC</td>
<td class="px-md py-sm text-secondary">0812-3456-7890</td>
<td class="px-md py-sm text-center">12</td>
<td class="px-md py-sm">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-primary/10 text-primary">Member</span>
</td>
<td class="px-md py-sm text-center">
<button class="inline-flex items-center justify-center px-sm py-1 border border-outline rounded text-primary hover:bg-surface-container-low transition-colors font-label-md text-label-md">Detail</button>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface transition-colors">
<td class="px-md py-sm text-center text-secondary">2</td>
<td class="px-md py-sm font-medium text-on-surface">Ahmad Fauzi</td>
<td class="px-md py-sm">Bintang Timur</td>
<td class="px-md py-sm text-secondary">0856-7890-1234</td>
<td class="px-md py-sm text-center">3</td>
<td class="px-md py-sm">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-secondary-container text-on-secondary-container">Reguler</span>
</td>
<td class="px-md py-sm text-center">
<button class="inline-flex items-center justify-center px-sm py-1 border border-outline rounded text-primary hover:bg-surface-container-low transition-colors font-label-md text-label-md">Detail</button>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface transition-colors">
<td class="px-md py-sm text-center text-secondary">3</td>
<td class="px-md py-sm font-medium text-on-surface">Rizky Pratama</td>
<td class="px-md py-sm">Senja FC</td>
<td class="px-md py-sm text-secondary">0821-4567-8901</td>
<td class="px-md py-sm text-center">8</td>
<td class="px-md py-sm">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-primary/10 text-primary">Member</span>
</td>
<td class="px-md py-sm text-center">
<button class="inline-flex items-center justify-center px-sm py-1 border border-outline rounded text-primary hover:bg-surface-container-low transition-colors font-label-md text-label-md">Detail</button>
</td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-surface transition-colors">
<td class="px-md py-sm text-center text-secondary">4</td>
<td class="px-md py-sm font-medium text-on-surface">Dwi Saputra</td>
<td class="px-md py-sm">Kompak United</td>
<td class="px-md py-sm text-secondary">0896-1234-5678</td>
<td class="px-md py-sm text-center">1</td>
<td class="px-md py-sm">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-secondary-container text-on-secondary-container">Reguler</span>
</td>
<td class="px-md py-sm text-center">
<button class="inline-flex items-center justify-center px-sm py-1 border border-outline rounded text-primary hover:bg-surface-container-low transition-colors font-label-md text-label-md">Detail</button>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="border-t border-surface-variant px-md py-sm flex items-center justify-between bg-surface-container-lowest">
<span class="font-body-md text-body-md text-secondary text-sm">Menampilkan 1 hingga 4 dari 4 data</span>
<div class="flex gap-xs">
<button class="p-xs text-secondary hover:bg-surface-container-low rounded transition-colors disabled:opacity-50" disabled="">
<span class="material-symbols-outlined text-sm">chevron_left</span>
</button>
<button class="px-sm py-xs bg-primary text-on-primary rounded font-label-md text-label-md">1</button>
<button class="p-xs text-secondary hover:bg-surface-container-low rounded transition-colors disabled:opacity-50" disabled="">
<span class="material-symbols-outlined text-sm">chevron_right</span>
</button>
</div>
</div>
</div>
</div>
</main>


</body></html>