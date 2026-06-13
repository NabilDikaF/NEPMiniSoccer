<!DOCTYPE html>

<html lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>NEP Mini Soccer - Booking Lapangan</title>
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
<style type="text/tailwindcss">
        @layer utilities {
            .elevation-0 { box-shadow: none; }
            .elevation-1 { box-shadow: 0 2px 4px rgba(33, 37, 41, 0.05); }
            .elevation-2 { box-shadow: 0 8px 16px rgba(33, 37, 41, 0.08); }
            .elevation-3 { box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1); }
            
            /* Hide scrollbar for horizontally scrollable areas */
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .no-scrollbar {
                -ms-overflow-style: none;  /* IE and Edge */
                scrollbar-width: none;  /* Firefox */
            }
        }
    </style>
</head>
<body class="bg-surface font-body-md text-on-surface antialiased min-h-screen flex flex-col">
<!-- TopNavBar Component -->
<nav class="bg-surface-container-lowest dark:bg-surface-container-highest docked full-width top-0 sticky z-50 shadow-sm dark:shadow-none elevation-1 relative group">
    <div class="flex justify-between items-center px-gutter py-base max-w-container-max mx-auto w-full">
        <div class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed-dim">
            NEP Mini Soccer
        </div>
        
        <div class="hidden md:flex space-x-md items-center">
            
            @auth
            {{-- Hanya muncul jika sudah login --}}
            <a class="text-primary dark:text-primary-fixed-dim border-b-2 border-primary font-bold pb-1 scale-95 active:scale-90 transition-transform" href="/">Home</a>
                <a class="text-secondary dark:text-secondary-fixed-dim font-medium hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform" href="mybooking">Riwayat </a>
                <a class="text-secondary dark:text-secondary-fixed-dim font-medium hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform" href="profile">Profile</a>
            @endauth
        </div>

        @auth
            <form method="POST" action="{{ route('logout') }}" class="hidden md:block m-0 p-0">
                @csrf
                <button type="submit" class="flex items-center space-x-xs text-secondary dark:text-secondary-fixed-dim font-medium hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform">
                    <span>Keluar</span>
                    <span class="material-symbols-outlined text-sm">logout</span>
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="hidden md:flex items-center space-x-xs text-secondary dark:text-secondary-fixed-dim font-medium hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform">
                <span>Masuk</span>
                <span class="material-symbols-outlined text-sm">login</span>
            </a>
        @endguest

        <button class="md:hidden text-on-surface p-2 focus:outline-none focus:ring-2 focus:ring-primary rounded">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>

    <div class="md:hidden hidden absolute top-full left-0 w-full bg-surface-container-lowest shadow-md elevation-2 flex flex-col items-center py-4 space-y-4 border-t border-surface-variant z-40 group-focus-within:flex md:group-focus-within:hidden">
        <a class="text-primary dark:text-primary-fixed-dim font-bold pb-1 scale-95 active:scale-90 transition-transform" href="/">Home</a>
        
        @auth
            {{-- Hanya muncul jika sudah login --}}
            <a class="text-secondary dark:text-secondary-fixed-dim font-medium hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform" href="mybooking">My Bookings</a>
            <a class="text-secondary dark:text-secondary-fixed-dim font-medium hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform" href="profile">Profile</a>
            
            <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                @csrf
                <button type="submit" class="flex items-center space-x-xs text-secondary dark:text-secondary-fixed-dim font-medium hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform">
                    <span>Logout</span>
                    <span class="material-symbols-outlined text-sm">logout</span>
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="flex items-center space-x-xs text-secondary dark:text-secondary-fixed-dim font-medium hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform">
                <span>Login</span>
                <span class="material-symbols-outlined text-sm">login</span>
            </a>
        @endguest
    </div>
</nav>
<!-- Main Content -->
<main class="flex-grow">
<!-- Hero Section -->
<section class="relative w-full h-[300px] sm:h-[400px] md:h-[500px] bg-surface-container-high flex items-center justify-center overflow-hidden transition-all duration-300">
<img alt="Hero Image" class="absolute inset-0 w-full h-full object-cover opacity-80" data-alt="A dynamic, wide-angle shot of a pristine mini soccer pitch under bright stadium lights. The vibrant, fresh green artificial turf contrasts beautifully with the stark white lines of the field. The overall aesthetic is clean, athletic, and modern, reflecting a high-end sports facility. Subtle lens flares from the overhead lights add energy to the scene without cluttering the visual space." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBHei4XoW3wKQbXor9u5fe5-TnO8E7_gq-qdjhyegT5hG0l4hmUY7QG4cj2kuDMsdL7KR4ZnIW--sabJ5Y_I-mBJxErPcaA7EBxhvRIDVjKFSNX94K5Fl-caQxqGfPt4TifnjqQIsUwKGeh27FImelFAjmGAxsYGGnGjFHf6xyGlaANtdGCmqzNWyhTey0ybB2qMbYyiDK7Nv6NLepkfuvcCVhBZMWd5JkZSqH6_yl8Ua2dHvLPxg_A4I3sk5XOOqpgVQDmjpJaThu0"/>
<div class="absolute inset-0 bg-gradient-to-t from-background via-background/20 to-transparent"></div>
<div class="relative z-10 text-center px-4 md:px-gutter max-w-container-max mx-auto w-full">
<h1 class="font-display-lg text-3xl sm:text-4xl md:text-display-lg md:text-[64px] leading-tight font-bold text-on-surface mb-sm">
                    Mainkan Permainan Terbaikmu.
                </h1>
<p class="font-body-lg text-base sm:text-lg md:text-body-lg text-on-surface-variant max-w-2xl mx-auto mb-md px-4 md:px-0">
                    Fasilitas mini soccer premium dengan kualitas rumput sintetis standar FIFA. Pesan jadwalmu sekarang dan nikmati pengalaman bermain kelas satu.
                </p>
<a class="inline-flex items-center justify-center bg-primary-container text-on-primary hover:bg-primary transition-colors duration-200 font-label-md text-label-md py-sm px-md rounded-lg elevation-2 active:scale-95 w-full sm:w-auto" href="{{ route('booking') }}">
                    Pesan Sekarang
                </a>
</div>
</section>
<!-- Availability Section -->
<section class="py-12 md:py-xl px-4 md:px-gutter max-w-container-max mx-auto w-full space-y-6">
<!-- Horizontal Date Picker Card -->
<div class="bg-surface-container-lowest rounded-xl p-6 elevation-1 border border-surface-variant">
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-4 md:space-y-0">
<div>
<h2 class="font-headline-lg text-2xl font-bold text-on-surface">Jadwal Lapangan</h2>
<p class="font-body-md text-sm text-secondary mt-1">Pilih tanggal untuk melihat ketersediaan.</p>
</div>
<div class="flex items-center space-x-4">
<button class="p-2 rounded-full hover:bg-surface-container transition-colors text-secondary">
<span class="material-symbols-outlined">chevron_left</span>
</button>
<span class="font-label-md font-bold text-on-surface">11 Mei - 17 Mei 2026</span>
<button class="p-2 rounded-full hover:bg-surface-container transition-colors text-secondary">
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
</div>
<div class="flex overflow-x-auto no-scrollbar space-x-3 pb-2">
<button class="flex-none min-w-[100px] py-3 px-4 rounded-lg bg-primary text-white font-label-md text-center transition-colors">
                Sen 11 Mei
            </button>
<button class="flex-none min-w-[100px] py-3 px-4 rounded-lg bg-white border border-surface-variant text-on-surface hover:border-primary transition-colors font-label-md text-center">
                Sel 12 Mei
            </button>
<button class="flex-none min-w-[100px] py-3 px-4 rounded-lg bg-white border border-surface-variant text-on-surface hover:border-primary transition-colors font-label-md text-center">
                Rab 13 Mei
            </button>
<button class="flex-none min-w-[100px] py-3 px-4 rounded-lg bg-white border border-surface-variant text-on-surface hover:border-primary transition-colors font-label-md text-center">
                Kam 14 Mei
            </button>
<button class="flex-none min-w-[100px] py-3 px-4 rounded-lg bg-white border border-surface-variant text-on-surface hover:border-primary transition-colors font-label-md text-center">
                Jum 15 Mei
            </button>
<button class="flex-none min-w-[100px] py-3 px-4 rounded-lg bg-white border border-surface-variant text-on-surface hover:border-primary transition-colors font-label-md text-center">
                Sab 16 Mei
            </button>
<button class="flex-none min-w-[100px] py-3 px-4 rounded-lg bg-white border border-surface-variant text-on-surface hover:border-primary transition-colors font-label-md text-center">
                Min 17 Mei
            </button>
</div>
</div>
<!-- Time Slot Grid Card -->
<div class="bg-surface-container-lowest rounded-xl p-6 elevation-1 border border-surface-variant">
<div class="mb-6 border-b border-surface-variant pb-4 flex flex-col md:flex-row justify-between items-start md:items-center">
<div>
<h3 class="font-headline-sm text-xl font-bold text-on-surface">Jadwal Waktu - Lapangan A - Reguler</h3>
<p class="font-body-md text-secondary mt-1">Senin, 11 Mei 2026</p>
</div>
<!-- Legend -->
<div class="flex space-x-4 mt-4 md:mt-0 font-label-sm">
<div class="flex items-center space-x-2">
<div class="w-3 h-3 rounded bg-[#e8f5e9]"></div>
<span class="text-secondary">Tersedia</span>
</div>
<div class="flex items-center space-x-2">
<div class="w-3 h-3 rounded bg-[#ffebee]"></div>
<span class="text-secondary">Tidak Tersedia</span>
</div>
</div>
</div>
<div class="space-y-8">
<!-- PAGI Section -->
<div>
<div class="flex justify-between items-center border-b border-surface-variant pb-2 mb-4">
<span class="font-bold text-on-surface text-lg">PAGI</span>
<span class="font-bold text-on-surface text-lg">Rp 400.000</span>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
<button class="bg-[#e8f5e9] text-primary font-bold rounded-lg p-3 text-center transition-transform active:scale-95 hover:opacity-90">
                06:00
            </button>
<button class="bg-[#e8f5e9] text-primary font-bold rounded-lg p-3 text-center transition-transform active:scale-95 hover:opacity-90">
                07:00
            </button>
<button class="bg-[#ffebee] text-[#ba1a1a] font-bold rounded-lg p-3 text-center flex flex-col items-center justify-center cursor-not-allowed">
<span>08:00</span>
<span class="text-[10px] font-normal uppercase tracking-wide mt-1">Tidak Tersedia</span>
</button>
<button class="bg-[#ffebee] text-[#ba1a1a] font-bold rounded-lg p-3 text-center flex flex-col items-center justify-center cursor-not-allowed">
<span>09:00</span>
<span class="text-[10px] font-normal uppercase tracking-wide mt-1">Tidak Tersedia</span>
</button>
<button class="bg-[#e8f5e9] text-primary font-bold rounded-lg p-3 text-center transition-transform active:scale-95 hover:opacity-90">
                10:00
            </button>
</div>
</div>
<!-- SIANG Section -->
<div>
<div class="flex justify-between items-center border-b border-surface-variant pb-2 mb-4">
<span class="font-bold text-on-surface text-lg">SIANG</span>
<span class="font-bold text-on-surface text-lg">Rp 300.000</span>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
<button class="bg-[#e8f5e9] text-primary font-bold rounded-lg p-3 text-center transition-transform active:scale-95 hover:opacity-90">
                11:00
            </button>
<button class="bg-[#e8f5e9] text-primary font-bold rounded-lg p-3 text-center transition-transform active:scale-95 hover:opacity-90">
                12:00
            </button>
<button class="bg-[#ffebee] text-[#ba1a1a] font-bold rounded-lg p-3 text-center flex flex-col items-center justify-center cursor-not-allowed">
<span>13:00</span>
<span class="text-[10px] font-normal uppercase tracking-wide mt-1">Tidak Tersedia</span>
</button>
<button class="bg-[#e8f5e9] text-primary font-bold rounded-lg p-3 text-center transition-transform active:scale-95 hover:opacity-90">
                14:00
            </button>
<button class="bg-[#e8f5e9] text-primary font-bold rounded-lg p-3 text-center transition-transform active:scale-95 hover:opacity-90">
                15:00
            </button>
</div>
</div>
<!-- SORE Section -->
<div>
<div class="flex justify-between items-center border-b border-surface-variant pb-2 mb-4">
<span class="font-bold text-on-surface text-lg">SORE</span>
<span class="font-bold text-on-surface text-lg">Rp 500.000</span>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
<button class="bg-[#e8f5e9] text-primary font-bold rounded-lg p-3 text-center transition-transform active:scale-95 hover:opacity-90">
                16:00
            </button>
<button class="bg-[#ffebee] text-[#ba1a1a] font-bold rounded-lg p-3 text-center flex flex-col items-center justify-center cursor-not-allowed">
<span>17:00</span>
<span class="text-[10px] font-normal uppercase tracking-wide mt-1">Tidak Tersedia</span>
</button>
</div>
</div>
<!-- MALAM Section -->
<div>
<div class="flex justify-between items-center border-b border-surface-variant pb-2 mb-4">
<span class="font-bold text-on-surface text-lg">MALAM</span>
<span class="font-bold text-on-surface text-lg">Rp 600.000</span>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
<button class="bg-[#ffebee] text-[#ba1a1a] font-bold rounded-lg p-3 text-center flex flex-col items-center justify-center cursor-not-allowed">
<span>18:00</span>
<span class="text-[10px] font-normal uppercase tracking-wide mt-1">Tidak Tersedia</span>
</button>
<button class="bg-[#e8f5e9] text-primary font-bold rounded-lg p-3 text-center transition-transform active:scale-95 hover:opacity-90">
                19:00
            </button>
<button class="bg-[#e8f5e9] text-primary font-bold rounded-lg p-3 text-center transition-transform active:scale-95 hover:opacity-90">
                20:00
            </button>
<button class="bg-[#e8f5e9] text-primary font-bold rounded-lg p-3 text-center transition-transform active:scale-95 hover:opacity-90">
                21:00
            </button>
<button class="bg-[#e8f5e9] text-primary font-bold rounded-lg p-3 text-center transition-transform active:scale-95 hover:opacity-90">
                22:00
            </button>
</div>
</div>
</div>
</div>
</section>
</main>
<!-- Footer Component -->
<footer class="bg-surface-container-highest dark:bg-inverse-surface w-full py-lg mt-xl flat no shadows">
<div class="flex flex-col md:flex-row justify-between items-center px-4 md:px-gutter max-w-container-max mx-auto text-center md:text-left space-y-6 md:space-y-0">
<div class="font-headline-sm text-headline-sm font-bold text-primary dark:text-primary-fixed-dim">
                NEP Mini Soccer
            </div>
<div class="flex flex-wrap justify-center space-x-6 md:space-x-md">
<a class="font-body-md text-body-md text-secondary dark:text-secondary-fixed-dim hover:text-primary transition-colors opacity-80 hover:opacity-100" href="#">Terms</a>
<a class="font-body-md text-body-md text-secondary dark:text-secondary-fixed-dim hover:text-primary transition-colors opacity-80 hover:opacity-100" href="#">Privacy</a>
<a class="font-body-md text-body-md text-secondary dark:text-secondary-fixed-dim hover:text-primary transition-colors opacity-80 hover:opacity-100" href="#">Support</a>
</div>
<div class="font-body-md text-sm md:text-body-md text-on-surface dark:text-inverse-on-surface">
                © 2024 NEP Mini Soccer. All rights reserved.
            </div>
</div>
</footer>
</body></html>