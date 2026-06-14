<!DOCTYPE html>

<html lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>NEP MINI SOCCER - Profil Pengguna</title>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind Configuration -->
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "background": "#f8f9fb",
                        "on-background": "#1a1c19",
                        "surface": "#ffffff",
                        "on-surface": "#1a1c19",
                        "surface-variant": "#f3f4f6",
                        "on-surface-variant": "#4b5563",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f8f9fb",
                        "surface-container": "#ffffff",
                        "surface-container-high": "#ffffff",
                        "surface-container-highest": "#f3f4f6",
                        "outline": "#9ca3af",
                        "outline-variant": "#e5e7eb",
                        "primary": "#006e25",
                        "on-primary": "#ffffff",
                        "primary-container": "#e6f4ea",
                        "on-primary-container": "#006e25",
                        "primary-fixed": "#006e25",
                        "on-primary-fixed": "#ffffff",
                        "secondary": "#6b7280",
                        "secondary-container": "#f3f4f6",
                        "on-secondary-container": "#4b5563",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-error-container": "#410002"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "xs": "4px",
                        "xl": "40px",
                        "container-max": "1280px",
                        "base": "8px",
                        "lg": "24px",
                        "sm": "8px",
                        "md": "16px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "headline-lg-mobile": ["Barlow Condensed"],
                        "stats-number": ["Barlow Condensed"],
                        "display-lg": ["Barlow Condensed"],
                        "body-md": ["Inter"],
                        "headline-lg": ["Barlow Condensed"],
                        "body-lg": ["Inter"],
                        "label-bold": ["Barlow Condensed"],
                        "headline-md": ["Barlow Condensed"]
                    },
                    "fontSize": {
                        "headline-lg-mobile": ["32px", { "lineHeight": "1.1", "fontWeight": "700" }],
                        "stats-number": ["24px", { "lineHeight": "1.0", "fontWeight": "800" }],
                        "display-lg": ["72px", { "lineHeight": "1.0", "letterSpacing": "-0.02em", "fontWeight": "800" }],
                        "body-md": ["16px", { "lineHeight": "1.5", "fontWeight": "400" }],
                        "headline-lg": ["48px", { "lineHeight": "1.1", "fontWeight": "700" }],
                        "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "label-bold": ["14px", { "lineHeight": "1.0", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "headline-md": ["32px", { "lineHeight": "1.2", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined.filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
<!-- TopNavBar -->
<header class="w-full sticky top-0 z-50 bg-surface border-b border-outline-variant px-lg py-md">
<div class="max-w-container-max mx-auto flex justify-between items-center">
<div class="font-display text-2xl md:text-3xl font-bold text-primary tracking-tight uppercase">NEP MINI SOCCER</div>
<nav class="hidden md:flex gap-lg absolute left-1/2 -translate-x-1/2">
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors font-label-bold text-label-bold cursor-pointer active:scale-95 transition-transform hover:bg-primary-container duration-200 py-1 px-2 rounded" href="/">Home</a>
<a class="text-on-surface-variant font-medium hover:text-primary transition-colors font-label-bold text-label-bold cursor-pointer active:scale-95 transition-transform hover:bg-primary-container duration-200 py-1 px-2 rounded" href="mybooking">My Bookings</a>
<a class="text-primary font-bold border-b-2 border-primary pb-1 font-label-bold text-label-bold cursor-pointer active:scale-95 transition-transform hover:bg-primary-container duration-200 py-1 px-2" href="#">Profile</a>
</nav>
<div class="hidden md:flex items-center gap-md">
<button class="bg-transparent text-on-surface-variant hover:text-primary font-label-bold text-label-bold py-2 px-4 rounded transition-colors uppercase border-none outline-none focus:outline-none">
                    Logout
                </button>
</div>
</div>
</header>
<!-- Main Content -->
<main class="flex-grow w-full max-w-container-max mx-auto px-md md:px-lg py-xl flex flex-col gap-lg">
<!-- Header Profil -->
<div class="relative w-full rounded-xl overflow-hidden bg-surface-container-high border border-outline-variant shadow-sm">
<!-- Cover Image -->
<div class="h-48 md:h-64 w-full bg-surface-variant relative">
<img alt="Cover Profil" class="w-full h-full object-cover opacity-90" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDpp0ZJbB8hT6-aG1LqiJ5wGw-f36WXKjXZN6vEX0HJbCvEiPXimN7v_TGDPubC6J1C4RTqplboEWl185VpKFFyL48WuhPrOweAmsYKThSlvpCdjWc-9ZLSrEHlla3ogqtTFsXDnT0AHtt1uZ17GWNZm0YftVgVLVNgQUm4FcOAfCWtcDVOs8LrhsEFMM_X5HqJuVcYlP7G32YHOSUD6vGnNrUkNhHqQTfZSnKa3X8MqcyKBiF-JI8I9Mciu_EYIoGkdBMm3VQvtpi4"/>
<div class="absolute inset-0 bg-gradient-to-t from-surface-container-high to-transparent"></div>
</div>
<!-- Avatar & Info -->
<div class="px-lg pb-lg relative flex flex-col md:flex-row items-center md:items-end gap-md -mt-16 md:-mt-12 z-10">
<div class="w-32 h-32 rounded-full border-4 border-surface bg-surface-container flex-shrink-0 overflow-hidden relative shadow-sm">
<img alt="Ahmad Syarif Avatar" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCP8l0Pr6rSKgJ5xAtDkXot8_Qec7hnWW9_xgwB8cHQX4A_4f4wxQjSME3zNjkUj_6xSvGdoE5bc-_XVDQuO58ZXznXOZ3jw6wi3JtNWUG4oOic86lIshyvMxO_E9slNwmSD7meWeJ2vslUd9nsgWNEuqgqMtSqz5PPpJkq2goS9FZrlmt2Qxqw2XiqdRIxGv3cCNL6LM_4GzHTQSMHX8WdiWV4uFOJUut4VwdhpaoN5cDvK_GQKAVmv8pc6tqRK8McNgrmj8XN6WSx"/>
</div>
<div class="flex flex-col items-center md:items-start flex-grow text-center md:text-left mb-2">
<h1 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface uppercase mb-xs">Ahmad Syarif</h1>
</div>
</div>
</div>
<!-- Two-Column Layout -->
<div class="flex flex-col md:flex-row gap-lg">
<!-- Left Sidebar -->
<aside class="w-full md:w-1/3 lg:w-1/4 flex flex-col gap-md">
<!-- Activity Stats -->
<div class="bg-surface-container p-md rounded-lg border border-outline-variant flex flex-col gap-md relative overflow-hidden shadow-sm">
<div class="absolute top-0 right-0 w-32 h-32 bg-primary-container/50 rounded-full blur-2xl -mr-10 -mt-10 pointer-events-none"></div>
<h2 class="font-label-bold text-label-bold text-on-surface-variant uppercase tracking-wider border-b border-outline-variant pb-sm">Statistik Aktivitas</h2>
<div class="flex justify-between items-center bg-surface-container-high p-sm rounded border border-outline-variant">
<span class="text-on-surface-variant text-sm">Total Jam Main</span>
<span class="font-stats-number text-stats-number text-primary">24</span>
</div>
<div class="flex justify-between items-center bg-surface-container-high p-sm rounded border border-outline-variant">
<span class="text-on-surface-variant text-sm">Booking Menunggu</span>
<span class="font-stats-number text-stats-number text-on-surface">2</span>
</div>
</div>
<!-- Navigation Menu -->
<nav class="bg-surface-container rounded-lg border border-outline-variant overflow-hidden flex flex-col shadow-sm">
<a class="flex items-center gap-sm p-md text-on-surface hover:bg-surface-variant bg-surface-variant transition-colors" href="#">
<span class="material-symbols-outlined">person</span>
<span class="font-label-bold text-label-bold uppercase">Account Information</span>
</a>
<a class="flex items-center gap-sm p-md text-on-surface-variant hover:bg-surface-variant hover:text-on-surface transition-colors border-t border-outline-variant" href="#security-section">
<span class="material-symbols-outlined">security</span>
<span class="font-label-bold text-label-bold uppercase">Security</span>
</a>
</nav>
</aside>
<!-- Main Content (Right) -->
<div class="w-full md:w-2/3 lg:w-3/4 flex flex-col gap-lg">
<!-- Form Detail Profil -->
<section class="bg-surface-container p-md md:p-lg rounded-xl border border-outline-variant relative shadow-sm">
<div class="absolute inset-0 bg-gradient-to-br from-primary-container/30 to-transparent rounded-xl pointer-events-none"></div>
<div class="flex items-center gap-sm mb-lg border-b border-outline-variant pb-sm relative z-10">
<span class="material-symbols-outlined text-primary">manage_accounts</span>
<h2 class="font-headline-md text-[24px] uppercase text-on-surface">Detail Profil</h2>
</div>
<form class="grid grid-cols-1 md:grid-cols-2 gap-md relative z-10">
<!-- Nama Lengkap -->
<div class="flex flex-col gap-xs">
<label class="font-label-bold text-label-bold text-on-surface-variant" for="namaLengkap">Nama Lengkap</label>
<input class="bg-surface-container-high border border-outline-variant focus:border-primary text-on-surface p-sm rounded focus:outline-none focus:ring-1 focus:ring-primary transition-colors w-full font-body-md" id="namaLengkap" placeholder="Masukkan nama lengkap" type="text" value="Ahmad Syarif"/>
</div>
<!-- Nomor WhatsApp -->
<div class="flex flex-col gap-xs">
<label class="font-label-bold text-label-bold text-on-surface-variant" for="noWhatsapp">Nomor WhatsApp</label>
<div class="relative">
<span class="absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant material-symbols-outlined text-[20px]">phone_iphone</span>
<input class="bg-surface-container-high border border-outline-variant focus:border-primary text-on-surface p-sm pl-8 rounded focus:outline-none focus:ring-1 focus:ring-primary transition-colors w-full font-body-md" id="noWhatsapp" placeholder="Nomor WA aktif" type="tel" value="+62 812 3456 7890"/>
</div>
</div>
<!-- Email -->
<div class="flex flex-col gap-xs md:col-span-2">
<label class="font-label-bold text-label-bold text-on-surface-variant" for="email">Alamat Email</label>
<div class="relative">
<span class="absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant material-symbols-outlined text-[20px]">mail</span>
<input class="bg-surface-container-high border border-outline-variant focus:border-primary text-on-surface p-sm pl-8 rounded focus:outline-none focus:ring-1 focus:ring-primary transition-colors w-full font-body-md" id="email" placeholder="Email Anda" type="email" value="ahmad.syarif@example.com"/>
</div>
</div>
<!-- Submit Button -->
<div class="md:col-span-2 mt-md flex justify-end">
<button class="bg-primary hover:bg-primary-fixed text-on-primary font-headline-md text-[20px] uppercase px-lg py-sm rounded transition-all duration-200 shadow-[0_4px_0_0_#004718] active:shadow-[0_0px_0_0_#004718] active:translate-y-1 flex items-center gap-xs" type="button">
<span class="material-symbols-outlined">save</span>
                                Simpan Perubahan
                            </button>
</div>
<div class="md:col-span-2 mt-lg border-b border-outline-variant pb-xs" id="security-section">
<h3 class="font-label-bold text-label-bold text-on-surface-variant uppercase tracking-wider">KEAMANAN</h3>
</div>
<div class="flex flex-col gap-xs">
<label class="font-label-bold text-label-bold text-on-surface-variant" for="passwordSekarang">Kata Sandi Saat Ini</label>
<div class="relative">
<span class="absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant material-symbols-outlined text-[20px]">lock</span>
<input class="bg-surface-container-high border border-outline-variant focus:border-primary text-on-surface p-sm pl-8 rounded focus:outline-none focus:ring-1 focus:ring-primary transition-colors w-full font-body-md" id="passwordSekarang" placeholder="••••••••" type="password"/>
</div>
</div>
<div class="flex flex-col gap-xs">
<label class="font-label-bold text-label-bold text-on-surface-variant" for="passwordBaru">Kata Sandi Baru</label>
<div class="relative">
<span class="absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant material-symbols-outlined text-[20px]">lock_reset</span>
<input class="bg-surface-container-high border border-outline-variant focus:border-primary text-on-surface p-sm pl-8 rounded focus:outline-none focus:ring-1 focus:ring-primary transition-colors w-full font-body-md" id="passwordBaru" placeholder="Minimal 8 karakter" type="password"/>
</div>
</div>
<div class="flex flex-col gap-xs md:col-span-2">
<label class="font-label-bold text-label-bold text-on-surface-variant" for="konfirmasiPassword">Konfirmasi Kata Sandi Baru</label>
<div class="relative">
<span class="absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant material-symbols-outlined text-[20px]">check_circle</span>
<input class="bg-surface-container-high border border-outline-variant focus:border-primary text-on-surface p-sm pl-8 rounded focus:outline-none focus:ring-1 focus:ring-primary transition-colors w-full font-body-md" id="konfirmasiPassword" placeholder="Ulangi kata sandi baru" type="password"/>
</div>
</div>
<div class="md:col-span-2 mt-sm flex justify-end">
<button class="bg-primary hover:bg-primary-fixed text-on-primary font-headline-md text-[20px] uppercase px-lg py-sm rounded transition-all duration-200 shadow-[0_4px_0_0_#004718] active:shadow-[0_0px_0_0_#004718] active:translate-y-1 flex items-center gap-xs" type="button">
<span class="material-symbols-outlined">save</span>
                                Simpan Perubahan
                            </button>
</div>
</form>
</section>
</div>
</div>
</main>
<!-- Footer -->
<footer class="bg-surface-container text-on-surface-variant py-xl w-full border-t border-outline-variant mt-auto">
<div class="max-w-container-max mx-auto px-lg flex flex-col md:flex-row justify-between items-center space-y-md md:space-y-0">
<div class="font-headline-md text-headline-md text-primary font-bold uppercase">
                NEP MINI SOCCER
            </div>
<div class="flex flex-wrap justify-center gap-md font-label-bold text-label-bold">
<a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
<a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Terms of Service</a>
<a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Contact Support</a>
</div>
<div class="font-body-md text-body-md text-on-surface-variant text-center md:text-right">
                © 2024 NEP MINI SOCCER. Professional Turf Management.
            </div>
</div>
</footer>
</body></html>