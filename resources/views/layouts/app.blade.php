<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'NEP Mini Soccer')</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
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
            .hide-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .hide-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .nav-link-fixed::after {
            display: block;
            content: attr(data-text);
            font-weight: bold;
            height: 0;
            overflow: hidden;
            visibility: hidden;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-background text-on-background font-body-md text-body-md antialiased min-h-screen flex flex-col overflow-y-scroll">

<!-- NAVBAR -->
<nav class="bg-surface-container-lowest w-full top-0 sticky z-50 shadow-sm transition-colors duration-200 group">
    <div class="flex justify-between items-center px-gutter py-base max-w-container-max mx-auto w-full relative">
        <a href="{{ route('home') }}" class="font-headline-md text-headline-md font-bold text-primary flex items-center gap-sm hover:opacity-80 transition-opacity">
            <img src="{{ asset('logo.png') }}" alt="NEP Mini Soccer Logo" class="h-16 w-auto">
        </a>
        
        <div class="hidden md:flex items-center space-x-md pt-3 absolute left-1/2 -translate-x-1/2">
            @auth
                <a data-text="Beranda" class="nav-link-fixed flex flex-col items-center {{ request()->routeIs('home') ? 'text-primary border-primary font-bold' : 'text-secondary border-transparent font-medium' }} border-b-2 pb-1 hover:text-primary-container transition-colors duration-200 text-base" href="{{ route('home') }}">Beranda</a>
                <a data-text="Booking Saya" class="nav-link-fixed flex flex-col items-center {{ request()->routeIs('mybooking') ? 'text-primary border-primary font-bold' : 'text-secondary border-transparent font-medium' }} border-b-2 pb-1 hover:text-primary-container transition-colors duration-200 text-base" href="{{ route('mybooking') }}">Booking Saya</a>
                <a data-text="Profile" class="nav-link-fixed flex flex-col items-center {{ request()->routeIs('profile') ? 'text-primary border-primary font-bold' : 'text-secondary border-transparent font-medium' }} border-b-2 pb-1 hover:text-primary-container transition-colors duration-200 text-base" href="{{ route('profile') }}">Profile</a>
                
                @if(Auth::user()->role === 'admin')
                    <a class="text-tertiary font-bold hover:text-tertiary-container transition-colors duration-200 text-base ml-4" href="{{ route('admin.dashboard') }}">Masuk Dashboard Admin</a>
                @endif
            @endauth
        </div>

        <div class="hidden md:flex items-center pt-3">
            @auth
                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="flex items-center gap-1 text-secondary font-semibold hover:text-error transition-colors duration-200 text-base">
                        <span>Keluar</span>
                        <span class="material-symbols-outlined text-[20px]">logout</span>
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="flex items-center gap-1 text-secondary font-semibold hover:text-primary transition-colors duration-200 text-base">
                    <span>Masuk</span>
                    <span class="material-symbols-outlined text-[20px]">login</span>
                </a>
            @endguest
        </div>

        <button class="md:hidden text-on-surface p-xs rounded hover:bg-surface-container transition-colors focus:outline-none">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>

    <div class="md:hidden hidden absolute top-full left-0 w-full bg-surface-container-lowest shadow-md flex-col items-center py-4 space-y-4 border-t border-surface-variant z-40 group-focus-within:flex md:group-focus-within:hidden">
        <a class="{{ request()->routeIs('home') ? 'text-primary font-bold pb-1' : 'text-secondary font-medium' }} font-label-md text-label-md" href="{{ route('home') }}">Beranda</a>
        
        @auth
            <a class="{{ request()->routeIs('mybooking') ? 'text-primary font-bold pb-1' : 'text-secondary font-medium hover:text-primary transition-colors' }} font-label-md text-label-md" href="{{ route('mybooking') }}">Booking Saya</a>
            <a class="{{ request()->routeIs('profile') ? 'text-primary font-bold pb-1' : 'text-secondary font-medium hover:text-primary transition-colors' }} font-label-md text-label-md" href="{{ route('profile') }}">Profil</a>
            
            @if(Auth::user()->role === 'admin')
                <a class="text-tertiary font-bold hover:text-tertiary-container transition-colors font-label-md text-label-md" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="m-0 p-0 w-full text-center">
                @csrf
                <button type="submit" class="w-full flex justify-center items-center gap-xs text-secondary font-medium hover:text-error transition-colors font-label-md text-label-md">
                    <span>Keluar</span>
                    <span class="material-symbols-outlined text-sm">logout</span>
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="flex items-center gap-xs text-secondary font-medium hover:text-primary transition-colors font-label-md text-label-md">
                <span>Masuk</span>
                <span class="material-symbols-outlined text-sm">login</span>
            </a>
        @endguest
    </div>
</nav>

<main class="flex-grow flex flex-col">
    @yield('content')
</main>

<footer class="bg-surface-container-highest w-full py-lg mt-auto border-t border-surface-variant">
    <div class="flex flex-col md:flex-row justify-between items-center px-gutter max-w-container-max mx-auto gap-md">
        <div class="font-headline-sm text-headline-sm font-bold text-primary flex items-center gap-sm">
            <img src="{{ asset('logo.png') }}" alt="NEP Mini Soccer Logo" class="h-16 w-auto grayscale opacity-80">
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

<script>
    // Toggle Menu Mobile
    const mobileMenuBtn = document.querySelector('button.md\\:hidden');
    if(mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            const menu = document.querySelector('.md\\:hidden.absolute');
            if(menu) {
                menu.classList.toggle('hidden');
                menu.classList.toggle('flex');
            }
        });
    }
</script>
@stack('scripts')
</body>
</html>
