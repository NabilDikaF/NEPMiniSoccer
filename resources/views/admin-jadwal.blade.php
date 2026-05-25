<!DOCTYPE html>

<html lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Kelola Jadwal - NEP Admin</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
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
                      "headline-lg-mobile": ["28px", {"lineHeight": "1.3", "fontWeight": "700"}],
                      "label-sm": ["12px", {"lineHeight": "1.2", "fontWeight": "500"}],
                      "label-md": ["14px", {"lineHeight": "1.2", "fontWeight": "600"}],
                      "headline-lg": ["32px", {"lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                      "headline-sm": ["20px", {"lineHeight": "1.4", "fontWeight": "600"}],
                      "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                      "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                      "display-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                      "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "600"}]
              }
            }
          }
        }
    </script>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col md:flex-row antialiased">
<input class="peer hidden" id="mobile-sidebar-toggle" type="checkbox"/>
<label class="fixed inset-0 bg-on-background/50 z-30 hidden peer-checked:block md:hidden" for="mobile-sidebar-toggle"></label>
<header class="md:hidden flex items-center justify-between p-sm bg-surface-container-low border-b border-surface-container-highest sticky top-0 z-20">
<div class="flex items-center gap-sm">
<label class="material-symbols-outlined text-on-surface cursor-pointer p-xs rounded-lg hover:bg-surface-container-high transition-colors" for="mobile-sidebar-toggle">menu</label>
<h1 class="font-headline-sm text-headline-sm font-bold text-primary">NEP Admin</h1>
</div>
</header>
<aside class="fixed left-0 top-0 h-screen w-64 flex flex-col bg-surface-container-low shadow-sm z-40 transform -translate-x-full peer-checked:translate-x-0 md:translate-x-0 transition-transform duration-300 md:sticky md:flex">
<div class="p-md flex flex-col h-full space-y-base"><div class="flex flex-col h-full p-md space-y-base">
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
<span>Dashboard</span>
</a>
<a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md" href="verifikasi">
<span class="material-symbols-outlined">fact_check</span>
<span>Verifikasi</span>
</a>
<a class="flex items-center gap-sm p-sm text-primary dark:text-primary-fixed-dim bg-surface-container-high dark:bg-surface-container rounded-lg transition-all translate-x-0 font-label-md text-label-md" href="jadwal">
<span class="material-symbols-outlined">calendar_month</span>
<span>Kelola Jadwal</span>
</a>
<a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md" href="pelanggan">
<span class="material-symbols-outlined">group</span>
<span>Data Pelanggan</span>
</a>
</div>
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
</div></div>
</aside>
<main class="flex-1 p-md md:p-lg w-full max-w-[1440px] mx-auto overflow-x-hidden">
<header class="mb-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md">
<div>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Kelola Jadwal &amp; Harga</h2>
<p class="font-body-md text-body-md text-secondary mt-xs">Atur tarif blok waktu dan ketersediaan lapangan.</p>
</div>
<button class="w-full sm:w-auto bg-primary text-on-primary font-label-md text-label-md px-md py-sm rounded-DEFAULT shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all">
                Simpan Perubahan
            </button>
</header>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-md">
<section class="lg:col-span-8 bg-surface-container-lowest rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] p-md flex flex-col border border-surface-container-highest">
<div class="flex items-center gap-sm mb-md border-b border-surface-container-highest pb-sm">
<span class="material-symbols-outlined text-primary" data-icon="payments">payments</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Pengaturan Harga Dasar</h3>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-md">
<div class="flex flex-col gap-xs">
<label class="font-label-md text-label-md text-on-surface flex justify-between">
<span class="">Blok Pagi</span>
<span class="text-secondary font-label-sm text-label-sm font-normal">06:00 - 10:00</span>
</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 flex items-center pl-sm text-secondary font-body-md text-body-md">Rp</span>
<input class="w-full pl-xl pr-sm py-sm bg-surface-bright border border-outline-variant rounded-DEFAULT font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="0" type="text" value="150.000"/>
</div>
</div>
<div class="flex flex-col gap-xs">
<label class="font-label-md text-label-md text-on-surface flex justify-between">
<span class="">Blok Siang</span>
<span class="text-secondary font-label-sm text-label-sm font-normal">10:00 - 15:00</span>
</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 flex items-center pl-sm text-secondary font-body-md text-body-md">Rp</span>
<input class="w-full pl-xl pr-sm py-sm bg-surface-bright border border-outline-variant rounded-DEFAULT font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="0" type="text" value="120.000"/>
</div>
</div>
<div class="flex flex-col gap-xs">
<label class="font-label-md text-label-md text-on-surface flex justify-between">
<span class="">Blok Sore</span>
<span class="text-secondary font-label-sm text-label-sm font-normal">15:00 - 18:00</span>
</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 flex items-center pl-sm text-secondary font-body-md text-body-md">Rp</span>
<input class="w-full pl-xl pr-sm py-sm bg-surface-bright border border-outline-variant rounded-DEFAULT font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="0" type="text" value="200.000"/>
</div>
</div>
<div class="flex flex-col gap-xs">
<label class="font-label-md text-label-md text-on-surface flex justify-between">
<span class="">Blok Malam</span>
<span class="text-secondary font-label-sm text-label-sm font-normal">18:00 - 23:00</span>
</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 flex items-center pl-sm text-secondary font-body-md text-body-md">Rp</span>
<input class="w-full pl-xl pr-sm py-sm bg-surface-bright border border-outline-variant rounded-DEFAULT font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="0" type="text" value="250.000"/>
</div>
</div>
</div>
</section>
<section class="lg:col-span-4 bg-surface-container-lowest rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] p-md flex flex-col border border-surface-container-highest">
<div class="flex items-center gap-sm mb-md border-b border-surface-container-highest pb-sm">
<span class="material-symbols-outlined text-tertiary" data-icon="loyalty">loyalty</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Keanggotaan</h3>
</div>
<div class="flex flex-col gap-base">
<p class="font-body-md text-body-md text-secondary">Atur persentase potongan harga untuk akun yang terdaftar sebagai Member aktif.</p>
<div class="flex flex-col gap-xs mt-sm">
<label class="font-label-md text-label-md text-on-surface">Diskon Member</label>
<div class="relative flex items-center">
<input class="w-full pl-sm pr-lg py-sm bg-surface-bright border border-outline-variant rounded-DEFAULT font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="0" type="number" value="15"/>
<span class="absolute right-sm text-secondary font-body-md text-body-md">%</span>
</div>
</div>
</div>
</section>
<section class="lg:col-span-12 bg-surface-container-lowest rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] p-md flex flex-col border border-surface-container-highest mt-base">
<div class="flex flex-col sm:flex-row sm:items-center justify-between mb-md border-b border-surface-container-highest pb-sm gap-sm">
<div class="flex items-center gap-sm">
<span class="material-symbols-outlined text-primary" data-icon="event_busy">event_busy</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Ketersediaan Lapangan (Maintenance)</h3>
</div>
<div class="flex items-center gap-xs">
<span class="w-3 h-3 rounded-full bg-primary-container"></span>
<span class="font-label-sm text-label-sm text-secondary">Tersedia</span>
<span class="w-3 h-3 rounded-full bg-surface-variant ml-sm"></span>
<span class="font-label-sm text-label-sm text-secondary">Ditutup</span>
</div>
</div>
<p class="font-body-md text-body-md text-secondary mb-md">Gunakan sakelar di bawah untuk mengunci slot jadwal secara manual. Slot yang terkunci tidak akan muncul di halaman pemesanan pelanggan.</p>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-md">
<div class="border border-surface-container-highest rounded-DEFAULT p-sm flex items-center justify-between bg-surface-bright">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface">06:00 - 08:00</span>
<span class="font-label-sm text-label-sm text-secondary">Pagi</span>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox" value=""/>
<div class="w-11 h-6 bg-surface-variant rounded-full peer peer-focus:ring-2 peer-focus:ring-primary-fixed-dim peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-container shadow-inner"></div>
</label>
</div>
<div class="border border-surface-container-highest rounded-DEFAULT p-sm flex items-center justify-between bg-surface-bright">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface">08:00 - 10:00</span>
<span class="font-label-sm text-label-sm text-secondary">Pagi</span>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox" value=""/>
<div class="w-11 h-6 bg-surface-variant rounded-full peer peer-focus:ring-2 peer-focus:ring-primary-fixed-dim peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-container shadow-inner"></div>
</label>
</div>
<div class="border border-surface-container-highest rounded-DEFAULT p-sm flex items-center justify-between bg-surface-bright">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface">10:00 - 12:00</span>
<span class="font-label-sm text-label-sm text-secondary">Siang</span>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input class="sr-only peer" type="checkbox" value=""/>
<div class="w-11 h-6 bg-surface-variant rounded-full peer peer-focus:ring-2 peer-focus:ring-primary-fixed-dim peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-container shadow-inner"></div>
</label>
</div>
<div class="border border-surface-container-highest rounded-DEFAULT p-sm flex items-center justify-between bg-surface-bright">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface">13:00 - 15:00</span>
<span class="font-label-sm text-label-sm text-secondary">Siang</span>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox" value=""/>
<div class="w-11 h-6 bg-surface-variant rounded-full peer peer-focus:ring-2 peer-focus:ring-primary-fixed-dim peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-container shadow-inner"></div>
</label>
</div>
<div class="border border-surface-container-highest rounded-DEFAULT p-sm flex items-center justify-between bg-surface-bright">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface">15:00 - 17:00</span>
<span class="font-label-sm text-label-sm text-secondary">Sore</span>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox" value=""/>
<div class="w-11 h-6 bg-surface-variant rounded-full peer peer-focus:ring-2 peer-focus:ring-primary-fixed-dim peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-container shadow-inner"></div>
</label>
</div>
<div class="border border-surface-container-highest rounded-DEFAULT p-sm flex items-center justify-between bg-surface-bright">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface">18:00 - 20:00</span>
<span class="font-label-sm text-label-sm text-secondary">Malam</span>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox" value=""/>
<div class="w-11 h-6 bg-surface-variant rounded-full peer peer-focus:ring-2 peer-focus:ring-primary-fixed-dim peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-container shadow-inner"></div>
</label>
</div>
<div class="border border-surface-container-highest rounded-DEFAULT p-sm flex items-center justify-between bg-surface-bright">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface">20:00 - 22:00</span>
<span class="font-label-sm text-label-sm text-secondary">Malam</span>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input checked="" class="sr-only peer" type="checkbox" value=""/>
<div class="w-11 h-6 bg-surface-variant rounded-full peer peer-focus:ring-2 peer-focus:ring-primary-fixed-dim peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-container shadow-inner"></div>
</label>
</div>
</div>
</section>
</div>
</main>
</body></html>