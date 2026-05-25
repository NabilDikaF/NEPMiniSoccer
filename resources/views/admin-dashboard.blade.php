<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>NEP Admin Dashboard</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
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
<style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-background text-on-background flex h-screen overflow-hidden flex-col md:flex-row">
<!-- Mobile Header -->
<header class="md:hidden flex items-center justify-between p-sm bg-surface-container-low shadow-sm z-40 border-b border-surface-variant">
<div class="flex items-center space-x-sm">
<button class="p-sm text-secondary hover:bg-surface-container-high rounded-full focus:outline-none focus:ring-2 focus:ring-primary" id="sidebar-toggle">
<span class="material-symbols-outlined">menu</span>
</button>
<div class="w-8 h-8 rounded-full text-on-primary-container font-headline-sm text-headline-sm font-bold"><img alt="Admin Avatar" class="w-full h-full rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB7P06HlnPnTGTIQuNNgTlnKq1RROsE5TAeBSnc0WLBm5xhrBSmkagDA_4_zqSQSIKnE7-Ky9btQSpHNa5hoAxkEuFrEqNldfU8t-cGgHvknlboNP5L9OiTeO48IWSDIRqgeeli43xBMRuBxMF-uiU1edHDNqriSNkQe5HmhMWeU8a-T6Y8jvKmzv25ZjuADai3bqJi3ggpWfprJowhiJAYEmsdMAWvyTDZpkaNi5QTwOc0lPgopxQu9HuR6M8IcGeL0PqXDZG0I_3c"/></div>
</div>
<h1 class="font-headline-sm text-headline-sm font-bold text-primary dark:text-primary-fixed-dim">NEP Admin</h1>
</header>
<!-- Overlay -->
<div class="fixed inset-0 bg-on-background/50 z-40 hidden transition-opacity duration-300 opacity-0 md:hidden" id="sidebar-overlay"></div>
<!-- SideNavBar -->
<nav class="bg-surface-container-low dark:bg-surface-dim shadow-lg md:shadow-sm dark:shadow-none fixed md:relative left-0 top-0 h-screen w-64 flex flex-col p-md space-y-base z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out" id="sidebar"><div class="flex flex-col h-full p-md space-y-base"><div class="flex items-center justify-between md:justify-start mb-lg"><div class="flex items-center gap-sm"><img alt="Admin Avatar" class="w-12 h-12 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB7P06HlnPnTGTIQuNNgTlnKq1RROsE5TAeBSnc0WLBm5xhrBSmkagDA_4_zqSQSIKnE7-Ky9btQSpHNa5hoAxkEuFrEqNldfU8t-cGgHvknlboNP5L9OiTeO48IWSDIRqgeeli43xBMRuBxMF-uiU1edHDNqriSNkQe5HmhMWeU8a-T6Y8jvKmzv25ZjuADai3bqJi3ggpWfprJowhiJAYEmsdMAWvyTDZpkaNi5QTwOc0lPgopxQu9HuR6M8IcGeL0PqXDZG0I_3c"/><div><h2 class="font-headline-sm text-headline-sm font-bold text-primary dark:text-primary-fixed-dim">NEP Admin</h2><p class="font-label-sm text-label-sm text-secondary">Field Management</p></div></div><button class="md:hidden p-sm text-secondary hover:bg-surface-container-high rounded-full focus:outline-none focus:ring-2 focus:ring-primary" id="sidebar-close"><span class="material-symbols-outlined">close</span></button></div><div class="flex-1 space-y-sm"><a class="flex items-center gap-sm p-sm text-primary dark:text-primary-fixed-dim bg-surface-container-high dark:bg-surface-container rounded-lg transition-all translate-x-0 font-label-md text-label-md" href="dashboard"><span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">dashboard</span><span class="">Dashboard</span></a><a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md" href="verifikasi"><span class="material-symbols-outlined">fact_check</span><span class="">Verifikasi</span></a><a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md" href="jadwal"><span class="material-symbols-outlined">calendar_month</span><span class="">Kelola Jadwal</span></a><a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md" href="pelanggan"><span class="material-symbols-outlined">group</span><span class="">Data Pelanggan</span></a></div><div class="mt-auto"><a class="flex items-center gap-sm p-sm text-secondary dark:text-secondary-fixed-dim hover:bg-surface-container-high dark:hover:bg-surface-container rounded-lg transition-all translate-x-1 active:translate-x-0 font-label-md text-label-md" href="#"><span class="material-symbols-outlined">logout</span><form method="POST" action="{{ route('logout') }}" class="hidden md:block m-0 p-0">
                @csrf
                <button type="submit" class="flex items-center space-x-xs text-secondary dark:text-secondary-fixed-dim font-medium hover:text-primary-container dark:hover:text-primary-fixed transition-colors duration-200 scale-95 active:scale-90 transition-transform">
                    <span>Logout</span>
                    <span class="material-symbols-outlined text-sm">logout</span>
                </button>
            </form></a></div></div></nav>
<!-- Main Content Canvas -->
<main class="flex-1 overflow-y-auto p-md md:p-gutter lg:p-xl w-full">
<div class="max-w-container-max mx-auto space-y-lg">
<!-- Header Section -->
<header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-0">
<div>
<h2 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-background">Overview</h2>
<p class="font-body-md text-body-md text-secondary">Here's what's happening at NEP Mini Soccer today.</p>
</div>
<button class="w-full sm:w-auto bg-primary hover:bg-primary-container text-on-primary px-md py-sm rounded-DEFAULT font-label-md text-label-md transition-colors shadow-sm">
                    Generate Report
                </button>
</header>
<!-- Metrics Bento Grid -->
<section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-md md:gap-gutter">
<!-- Total Revenue Card -->
<div class="bg-surface-container-lowest rounded-lg p-md shadow-sm border border-surface-variant flex flex-col justify-between">
<div class="flex justify-between items-start mb-md">
<div class="bg-surface-container-high p-sm rounded-full inline-flex">
<span class="material-symbols-outlined text-primary">payments</span>
</div>
<span class="font-label-sm text-label-sm text-primary-container bg-surface flex items-center px-2 py-1 rounded-full">+12.5%</span>
</div>
<div>
<p class="font-label-md text-label-md text-secondary mb-xs">Total Revenue</p>
<h3 class="font-headline-lg md:font-display-lg text-headline-lg md:text-display-lg text-on-background">Rp 4.2M</h3>
<p class="font-body-md text-body-md text-secondary mt-xs">vs last week</p>
</div>
</div>
<!-- Active Orders Card -->
<div class="bg-surface-container-lowest rounded-lg p-md shadow-sm border border-surface-variant flex flex-col justify-between">
<div class="flex justify-between items-start mb-md">
<div class="bg-surface-container-high p-sm rounded-full inline-flex">
<span class="material-symbols-outlined text-tertiary">receipt_long</span>
</div>
<span class="font-label-sm text-label-sm text-secondary bg-surface flex items-center px-2 py-1 rounded-full">-2.1%</span>
</div>
<div>
<p class="font-label-md text-label-md text-secondary mb-xs">Active Orders</p>
<h3 class="font-headline-lg md:font-display-lg text-headline-lg md:text-display-lg text-on-background">24</h3>
<p class="font-body-md text-body-md text-secondary mt-xs">Awaiting verification</p>
</div>
</div>
<!-- Today's Schedule Card -->
<div class="bg-primary text-on-primary rounded-lg p-md shadow-sm flex flex-col justify-between relative overflow-hidden sm:col-span-2 md:col-span-1">
<div class="absolute right-0 top-0 opacity-10 transform translate-x-1/4 -translate-y-1/4">
<span class="material-symbols-outlined" style="font-size: 160px;">sports_soccer</span>
</div>
<div class="relative z-10 flex justify-between items-start mb-md">
<div class="bg-on-primary-fixed-variant p-sm rounded-full inline-flex">
<span class="material-symbols-outlined text-on-primary">calendar_today</span>
</div>
</div>
<div class="relative z-10">
<p class="font-label-md text-label-md text-inverse-on-surface mb-xs">Today's Schedule</p>
<h3 class="font-headline-lg md:font-display-lg text-headline-lg md:text-display-lg">8/12</h3>
<p class="font-body-md text-body-md text-inverse-on-surface mt-xs">Slots booked</p>
</div>
</div>
</section>
<!-- Chart & Activity Section -->
<section class="grid grid-cols-1 lg:grid-cols-3 gap-md md:gap-gutter">
<!-- Peak Hours Chart Area -->
<div class="lg:col-span-2 bg-surface-container-lowest rounded-lg shadow-sm border border-surface-variant p-md w-full overflow-hidden">
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-lg gap-4 sm:gap-0">
<h3 class="font-headline-sm text-headline-sm text-on-background">Peak Hours Analysis</h3>
<select class="w-full sm:w-auto bg-surface border border-surface-variant text-secondary text-sm rounded-DEFAULT focus:ring-primary focus:border-primary block p-2">
<option>This Week</option>
<option>Last Week</option>
<option>This Month</option>
</select>
</div>
<!-- Chart Placeholder -->
<div class="h-48 md:h-64 w-full relative flex items-end space-x-1 sm:space-x-2">
<!-- Simulated Bar Chart -->
<div class="flex-1 bg-surface-container rounded-t-DEFAULT relative group h-[30%]"><div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 font-label-sm text-label-sm text-secondary transition-opacity hidden sm:block">10</div></div>
<div class="flex-1 bg-surface-container rounded-t-DEFAULT relative group h-[40%]"><div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 font-label-sm text-label-sm text-secondary transition-opacity hidden sm:block">15</div></div>
<div class="flex-1 bg-primary rounded-t-DEFAULT relative group h-[80%]"><div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 font-label-sm text-label-sm text-primary transition-opacity hidden sm:block">35</div></div>
<div class="flex-1 bg-primary-container rounded-t-DEFAULT relative group h-[95%]"><div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 font-label-sm text-label-sm text-primary-container transition-opacity hidden sm:block">42</div></div>
<div class="flex-1 bg-surface-container rounded-t-DEFAULT relative group h-[60%]"><div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 font-label-sm text-label-sm text-secondary transition-opacity hidden sm:block">25</div></div>
<div class="flex-1 bg-surface-container rounded-t-DEFAULT relative group h-[85%]"><div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 font-label-sm text-label-sm text-secondary transition-opacity hidden sm:block">38</div></div>
<div class="flex-1 bg-surface-container rounded-t-DEFAULT relative group h-[45%]"><div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 font-label-sm text-label-sm text-secondary transition-opacity hidden sm:block">18</div></div>
</div>
<!-- X-Axis Labels -->
<div class="flex justify-between items-center mt-sm text-secondary font-label-sm text-label-sm">
<span class="">M<span class="hidden sm:inline">on</span></span>
<span class="">T<span class="hidden sm:inline">ue</span></span>
<span class="">W<span class="hidden sm:inline">ed</span></span>
<span class="">T<span class="hidden sm:inline">hu</span></span>
<span class="">F<span class="hidden sm:inline">ri</span></span>
<span class="">S<span class="hidden sm:inline">at</span></span>
<span class="">S<span class="hidden sm:inline">un</span></span>
</div>
</div>
<!-- Recent Activity Feed -->
<div class="bg-surface-container-lowest rounded-lg shadow-sm border border-surface-variant p-md flex flex-col h-auto md:h-96 lg:h-auto">
<h3 class="font-headline-sm text-headline-sm text-on-background mb-md">Recent Activity</h3>
<div class="space-y-md flex-1 overflow-y-auto pr-2">
<div class="flex items-start space-x-sm">
<div class="w-2 h-2 mt-2 rounded-full bg-primary-container flex-shrink-0"></div>
<div>
<p class="font-label-md text-label-md text-on-background">Booking Confirmed</p>
<p class="font-body-md text-body-md text-secondary">Field A - 19:00, Budi Santoso</p>
<p class="font-label-sm text-label-sm text-outline mt-xs">10 mins ago</p>
</div>
</div>
<div class="flex items-start space-x-sm">
<div class="w-2 h-2 mt-2 rounded-full bg-tertiary flex-shrink-0"></div>
<div>
<p class="font-label-md text-label-md text-on-background">Payment Pending</p>
<p class="font-body-md text-body-md text-secondary">Field B - 20:00, Tim Garuda</p>
<p class="font-label-sm text-label-sm text-outline mt-xs">45 mins ago</p>
</div>
</div>
<div class="flex items-start space-x-sm">
<div class="w-2 h-2 mt-2 rounded-full bg-secondary flex-shrink-0"></div>
<div>
<p class="font-label-md text-label-md text-on-background">Schedule Updated</p>
<p class="font-body-md text-body-md text-secondary">Maintenance scheduled for tomorrow</p>
<p class="font-label-sm text-label-sm text-outline mt-xs">2 hours ago</p>
</div>
</div>
</div>
<button class="w-full mt-md py-sm border border-surface-variant rounded-DEFAULT text-secondary hover:bg-surface font-label-md text-label-md transition-colors">
                        View All
                    </button>
</div>
</section>
</div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarClose = document.getElementById('sidebar-close');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            const isClosed = sidebar.classList.contains('-translate-x-full');
            if (isClosed) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarClose.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    });
</script>
</body></html>