<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'NEP Admin')</title>
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
        /* CSS Hack for Material Symbols Outlined variations */
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        /* Overrides for specific filled icons if needed */
        .material-symbols-outlined.filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col md:flex-row antialiased">
    
    <!-- CSS Checkbox for Mobile Sidebar Toggle -->
    <input class="peer hidden" id="mobile-sidebar-toggle" type="checkbox"/>
    <label class="fixed inset-0 bg-on-background/50 z-30 hidden peer-checked:block md:hidden cursor-pointer" for="mobile-sidebar-toggle"></label>
    
    <!-- Mobile Header -->
    <header class="md:hidden flex items-center justify-between p-sm bg-surface-container-low border-b border-surface-container-highest sticky top-0 z-20">
        <div class="flex items-center gap-sm">
            <label class="material-symbols-outlined text-on-surface cursor-pointer p-xs rounded-lg hover:bg-surface-container-high transition-colors" for="mobile-sidebar-toggle">menu</label>
            <h1 class="font-headline-sm text-headline-sm font-bold text-primary">NEP Admin</h1>
        </div>
    </header>

    <!-- Sidebar (Combined layout: CSS transition from jadwal + visual content from verifikasi) -->
    <aside class="fixed left-0 top-0 h-screen w-64 flex flex-col bg-surface-container-low shadow-sm z-40 transform -translate-x-full peer-checked:translate-x-0 md:translate-x-0 transition-transform duration-300 md:sticky md:flex">
        <div class="flex flex-col h-full p-md space-y-base overflow-y-auto">
            <div class="flex flex-col w-full mb-lg px-2">
                <img alt="NEP Mini Soccer Logo" class="w-full h-auto object-contain" src="{{ asset('logo.png') }}"/>
            </div>
            
            <div class="flex-1 space-y-sm">
                <a class="flex items-center gap-sm p-sm {{ request()->routeIs('admin.dashboard') ? 'text-primary bg-surface-container-high' : 'text-secondary hover:bg-surface-container-high' }} rounded-lg transition-colors font-label-md text-label-md" href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.dashboard') ? 'filled' : '' }}">dashboard</span>
                    <span class="">Dashboard</span>
                </a>
                
                <a class="flex items-center gap-sm p-sm {{ request()->routeIs('admin.verifikasi') ? 'text-primary bg-surface-container-high' : 'text-secondary hover:bg-surface-container-high' }} rounded-lg transition-colors font-label-md text-label-md" href="{{ route('admin.verifikasi') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.verifikasi') ? 'filled' : '' }}">fact_check</span>
                    <span class="">Verifikasi</span>
                </a>
                
                <a class="flex items-center gap-sm p-sm {{ request()->routeIs('jadwal.index') ? 'text-primary bg-surface-container-high' : 'text-secondary hover:bg-surface-container-high' }} rounded-lg transition-colors font-label-md text-label-md" href="{{ route('jadwal.index') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('jadwal.index') ? 'filled' : '' }}">calendar_month</span>
                    <span class="">Kelola Jadwal</span>
                </a>
                
                <a class="flex items-center gap-sm p-sm {{ request()->routeIs('admin.pelanggan') ? 'text-primary bg-surface-container-high' : 'text-secondary hover:bg-surface-container-high' }} rounded-lg transition-colors font-label-md text-label-md" href="{{ route('admin.pelanggan') }}">
                    <span class="material-symbols-outlined {{ request()->routeIs('admin.pelanggan') ? 'filled' : '' }}">group</span>
                    <span class="">Data Pelanggan</span>
                </a>
            </div>
            
            <div class="mt-auto pt-md border-t border-surface-variant">
                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-sm p-sm text-secondary hover:bg-surface-container-high rounded-lg transition-all font-label-md text-label-md hover:text-error">
                        <span class="material-symbols-outlined text-sm">logout</span>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area (From admin-jadwal) -->
    <main class="flex-1 p-md md:p-lg w-full max-w-[1440px] mx-auto overflow-x-hidden">
        
        <!-- Global Notifications -->
        @if(session('success'))
        <div class="mb-lg px-md py-sm bg-primary-container text-on-primary-container rounded-lg shadow-sm border border-primary flex items-center gap-2">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-lg px-md py-sm bg-error-container text-on-error-container rounded-lg shadow-sm border border-error flex items-center gap-2">
            <span class="material-symbols-outlined">error</span>
            {{ session('error') }}
        </div>
        @endif

        @yield('content')
        
    </main>

    @stack('scripts')
</body>
</html>
