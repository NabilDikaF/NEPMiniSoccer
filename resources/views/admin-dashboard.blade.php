@extends('layouts.admin')
@section('title', 'Dashboard - NEP Admin')

@section('content')
<div class="max-w-container-max mx-auto space-y-lg">
<!-- Header Section -->
<header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-0 mb-lg">
<div>
<h2 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-background">Ringkasan</h2>
<p class="font-body-md text-body-md text-secondary">Berikut adalah ringkasan singkat aktivitas di NEP Mini Soccer.</p>
</div>
<button class="w-full sm:w-auto bg-primary hover:bg-primary-container text-on-primary px-md py-sm rounded-DEFAULT font-label-md text-label-md transition-colors shadow-sm">
                    Buat Laporan
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
<p class="font-label-md text-label-md text-secondary mb-xs">Total Pendapatan</p>
<h3 class="font-headline-lg md:font-display-lg text-headline-lg md:text-display-lg text-on-background">Rp 4.2M</h3>
<p class="font-body-md text-body-md text-secondary mt-xs">Seminggu terakhir</p>
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
<p class="font-label-md text-label-md text-secondary mb-xs">Pesanan Aktif</p>
<h3 class="font-headline-lg md:font-display-lg text-headline-lg md:text-display-lg text-on-background">24</h3>
<p class="font-body-md text-body-md text-secondary mt-xs">Menunggu Verifikasi</p>
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
<p class="font-label-md text-label-md text-inverse-on-surface mb-xs">Jadwal Hari Ini</p>
<h3 class="font-headline-lg md:font-display-lg text-headline-lg md:text-display-lg">8/12</h3>
<p class="font-body-md text-body-md text-inverse-on-surface mt-xs">Slot Terisi</p>
</div>
</div>
</section>
<!-- Chart & Activity Section -->
<section class="grid grid-cols-1 lg:grid-cols-3 gap-md md:gap-gutter mt-lg">
<!-- Peak Hours Chart Area -->
<div class="lg:col-span-2 bg-surface-container-lowest rounded-lg shadow-sm border border-surface-variant p-md w-full overflow-hidden">
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-lg gap-4 sm:gap-0">
<h3 class="font-headline-sm text-headline-sm text-on-background">Analisis Jam Puncak</h3>
<select class="w-full sm:w-auto bg-surface border border-surface-variant text-secondary text-sm rounded-DEFAULT focus:ring-primary focus:border-primary block p-2">
<option>Minggu Ini</option>
<option>Minggu Lalu</option>
<option>Bulan Ini</option>
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
<div class="bg-surface-container-lowest rounded-lg shadow-sm border border-surface-variant p-md flex flex-col h-full min-h-[300px]">
<h3 class="font-headline-sm text-headline-sm text-on-background mb-md">Aktivitas Terbaru</h3>
<div class="space-y-md flex-1 overflow-y-auto pr-2 max-h-[270px] mb-md">

    @forelse($recentNotifications as $notif)
    <div class="flex items-start space-x-sm p-1 rounded {{ !$notif->is_read ? 'bg-surface-container-low' : '' }}">
        <div class="w-2 h-2 mt-1 rounded-full {{ $notif->is_urgent ? 'bg-error' : ($notif->is_read ? 'bg-secondary' : 'bg-primary-container') }} flex-shrink-0"></div>
        <div>
            <p class="font-label-md text-label-md {{ $notif->is_urgent ? 'text-error font-bold' : 'text-on-background' }}">{{ $notif->tipe_notifikasi }}</p>
            <p class="font-body-md text-body-md text-secondary">{{ $notif->pesan }}</p>
            <p class="font-label-sm text-label-sm text-outline mt-xs">{{ $notif->created_at->diffForHumans() }}</p>
        </div>
    </div>
    @empty
    <div class="text-center text-secondary py-4">
        <span class="material-symbols-outlined text-4xl mb-2">notifications_off</span>
        <p class="font-label-md text-label-md">Belum ada aktivitas terbaru.</p>
    </div>
    @endforelse

</div>
<button onclick="openNotificationModal()" class="w-full mt-auto py-sm border border-surface-variant rounded-DEFAULT text-secondary hover:bg-surface font-label-md text-label-md transition-colors">
    Lihat Semua
</button>
</div>
</section>
</section>
</div>

<!-- MODAL SEMUA NOTIFIKASI -->
<div id="all-notifications-modal" class="fixed inset-0 bg-[#191c1d]/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-surface-container-lowest rounded-xl max-w-2xl w-full h-[90vh] flex flex-col shadow-xl border border-surface-variant relative transform scale-95 transition-transform duration-300" id="notif-modal-card">
        
        <!-- Header Modal -->
        <div class="flex-shrink-0 p-md border-b border-surface-variant flex justify-between items-center">
            <h3 class="font-headline-sm text-headline-sm text-on-surface flex items-center gap-2">
                <span class="material-symbols-outlined">notifications</span> Riwayat Aktivitas
            </h3>
            <button onclick="closeNotificationModal()" class="text-secondary hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <!-- Filter -->
        <div class="flex-shrink-0 px-md py-sm bg-surface-container-low border-b border-surface-variant flex gap-sm overflow-x-auto">
            <button onclick="filterNotif('all')" id="btn-filter-all" class="px-sm py-xs bg-primary text-on-primary rounded-full font-label-sm text-label-sm transition-colors whitespace-nowrap">Semua</button>
            <button onclick="filterNotif('urgent')" id="btn-filter-urgent" class="px-sm py-xs bg-surface text-secondary border border-outline-variant rounded-full font-label-sm text-label-sm hover:bg-surface-container transition-colors whitespace-nowrap text-error font-bold border-error">Penting</button>
            <button onclick="filterNotif('unread')" id="btn-filter-unread" class="px-sm py-xs bg-surface text-secondary border border-outline-variant rounded-full font-label-sm text-label-sm hover:bg-surface-container transition-colors whitespace-nowrap">Belum Dibaca</button>
            <button onclick="filterNotif('read')" id="btn-filter-read" class="px-sm py-xs bg-surface text-secondary border border-outline-variant rounded-full font-label-sm text-label-sm hover:bg-surface-container transition-colors whitespace-nowrap">Sudah Dibaca</button>
        </div>

        <!-- List Notifikasi -->
        <div class="p-md overflow-y-auto flex-1 space-y-md" id="notif-list-container">
            @forelse($allNotifications as $notif)
            <div data-status="{{ $notif->is_read ? 'read' : 'unread' }}" data-urgent="{{ $notif->is_urgent ? 'true' : 'false' }}" data-id="{{ $notif->id }}" class="notif-item flex items-start space-x-sm p-3 rounded-lg border border-surface-variant {{ !$notif->is_read ? 'bg-surface-container' : 'bg-surface' }}">
                <div class="w-3 h-3 mt-1.5 rounded-full {{ $notif->is_urgent ? 'bg-error' : ($notif->is_read ? 'bg-secondary' : 'bg-primary') }} flex-shrink-0"></div>
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <p class="font-label-md text-label-md {{ $notif->is_urgent ? 'text-error font-bold' : 'text-on-background' }}">{{ $notif->tipe_notifikasi }}</p>
                        <p class="font-label-sm text-label-sm text-outline">{{ $notif->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <p class="font-body-md text-body-md text-secondary mt-1">{{ $notif->pesan }}</p>
                    
                    @if(!$notif->is_read)
                    <button onclick="markAsRead({{ $notif->id }}, this)" class="group mt-2 text-primary font-label-sm text-label-sm flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">done_all</span> <span class="group-hover:underline">Tandai sudah dibaca</span>
                    </button>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center text-secondary py-10">
                <span class="material-symbols-outlined text-4xl mb-2">inbox</span>
                <p class="font-label-md text-label-md">Tidak ada riwayat aktivitas.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openNotificationModal() {
        const modal = document.getElementById('all-notifications-modal');
        const card = document.getElementById('notif-modal-card');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            card.classList.replace('scale-95', 'scale-100');
        }, 10);
    }

    function closeNotificationModal() {
        const modal = document.getElementById('all-notifications-modal');
        const card = document.getElementById('notif-modal-card');
        card.classList.replace('scale-100', 'scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 300);
    }

    function filterNotif(type) {
        // Reset buttons
        document.getElementById('btn-filter-all').className = "px-sm py-xs bg-surface text-secondary border border-outline-variant rounded-full font-label-sm text-label-sm hover:bg-surface-container transition-colors whitespace-nowrap";
        document.getElementById('btn-filter-unread').className = "px-sm py-xs bg-surface text-secondary border border-outline-variant rounded-full font-label-sm text-label-sm hover:bg-surface-container transition-colors whitespace-nowrap";
        document.getElementById('btn-filter-read').className = "px-sm py-xs bg-surface text-secondary border border-outline-variant rounded-full font-label-sm text-label-sm hover:bg-surface-container transition-colors whitespace-nowrap";
        document.getElementById('btn-filter-urgent').className = "px-sm py-xs bg-surface text-secondary border border-outline-variant rounded-full font-label-sm text-label-sm hover:bg-surface-container transition-colors whitespace-nowrap text-error font-bold border-error";
        
        // Active button
        if(type === 'urgent') {
            document.getElementById('btn-filter-' + type).className = "px-sm py-xs bg-error text-white rounded-full font-label-sm text-label-sm transition-colors whitespace-nowrap shadow-sm";
        } else {
            document.getElementById('btn-filter-' + type).className = "px-sm py-xs bg-primary text-on-primary rounded-full font-label-sm text-label-sm transition-colors whitespace-nowrap shadow-sm";
        }

        // Filter items
        const items = document.querySelectorAll('.notif-item');
        items.forEach(item => {
            if (type === 'all') {
                item.style.display = 'flex';
            } else if (type === 'urgent') {
                if (item.getAttribute('data-urgent') === 'true') {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            } else if (item.getAttribute('data-status') === type) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function markAsRead(id, btnElement) {
        fetch(`/admin/notifications/${id}/mark-read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI without refreshing
                const notifContainer = btnElement.closest('.notif-item');
                notifContainer.classList.replace('bg-surface-container', 'bg-surface');
                notifContainer.setAttribute('data-status', 'read');
                
                const dot = notifContainer.querySelector('.w-3.h-3');
                if(!dot.classList.contains('bg-error')) {
                    dot.classList.replace('bg-primary', 'bg-secondary');
                }

                btnElement.remove(); // Remove the button
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endpush