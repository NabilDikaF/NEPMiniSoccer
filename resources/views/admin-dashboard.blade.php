@extends('layouts.admin')
@section('title', 'Dashboard - NEP Admin')

@section('header')
<header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-0 mb-lg">
    <div>
        <h2 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-background">Ringkasan</h2>
        <p class="font-body-md text-body-md text-secondary">Berikut adalah ringkasan singkat aktivitas di NEP Mini Soccer.</p>
    </div>
    <a href="{{ route('admin.laporan') }}" class="w-full sm:w-auto bg-primary hover:bg-primary-container text-on-primary px-md py-sm rounded-DEFAULT font-label-md text-label-md transition-colors shadow-sm inline-block text-center">
        Buat Laporan
    </a>
</header>
@endsection

@section('content')
<div class="max-w-container-max mx-auto space-y-lg">
<!-- Metrics Bento Grid -->
<section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-md md:gap-gutter">
<!-- Total Revenue Card -->
<div class="bg-surface-container-lowest rounded-lg p-md shadow-sm border border-surface-variant flex flex-col justify-between">
<div class="flex justify-between items-start mb-md">
<div class="bg-surface-container-high p-sm rounded-full inline-flex">
<span class="material-symbols-outlined text-primary">payments</span>
</div>
</div>
<div>
<p class="font-label-md text-label-md text-secondary mb-xs">Total Pendapatan</p>
<h3 class="font-headline-lg md:font-display-lg text-headline-lg md:text-display-lg text-on-background">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
<p class="font-body-md text-body-md text-secondary mt-xs">Seminggu terakhir</p>
</div>
</div>
<!-- Active Orders Card -->
<div class="bg-surface-container-lowest rounded-lg p-md shadow-sm border border-surface-variant flex flex-col justify-between">
<div class="flex justify-between items-start mb-md">
<div class="bg-surface-container-high p-sm rounded-full inline-flex">
<span class="material-symbols-outlined text-tertiary">receipt_long</span>
</div>
</div>
<div>
<p class="font-label-md text-label-md text-secondary mb-xs">Pesanan Aktif</p>
<h3 class="font-headline-lg md:font-display-lg text-headline-lg md:text-display-lg text-on-background">{{ $pesananMenungguVerifikasi }}</h3>
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
<h3 class="font-headline-lg md:font-display-lg text-headline-lg md:text-display-lg">{{ $jadwalHariIni }}</h3>
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
<select id="chartFilter" class="w-full sm:w-auto pl-4 pr-10 py-2 border border-surface-variant rounded-lg font-body-md text-body-md bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors cursor-pointer text-on-surface">
<option value="hari_ini">Hari Ini</option>
<option value="seminggu" selected>Seminggu</option>
<option value="sebulan">Sebulan</option>
</select>
</div>
<!-- Chart Canvas -->
<div class="h-48 md:h-64 w-full relative">
    <canvas id="peakHoursChart"></canvas>
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

<!-- Expired Verifications Section -->
@if($expiredVerifications->count() > 0)
<section class="mt-lg">
    <div class="bg-error-container/10 rounded-lg shadow-sm border border-error/20 p-md">
        <div class="flex items-center justify-between mb-md">
            <h3 class="font-headline-sm text-headline-sm text-error flex items-center gap-2">
                <span class="material-symbols-outlined">warning</span> Pesanan Lewat Waktu (Belum Diverifikasi)
            </h3>
            <span class="bg-error text-white text-xs font-bold px-2 py-1 rounded-full">{{ $expiredVerifications->count() }}</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-error/20">
                        <th class="font-label-sm text-label-sm text-secondary pb-2 px-2">Booking ID</th>
                        <th class="font-label-sm text-label-sm text-secondary pb-2 px-2">Pelanggan</th>
                        <th class="font-label-sm text-label-sm text-secondary pb-2 px-2">Tipe</th>
                        <th class="font-label-sm text-label-sm text-secondary pb-2 px-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expiredVerifications as $expired)
                    <tr class="border-b border-error/10 hover:bg-error/5 transition-colors">
                        <td class="py-2 px-2 font-body-sm text-body-sm">{{ $expired->booking->id_booking }}</td>
                        <td class="py-2 px-2 font-body-sm text-body-sm">{{ $expired->booking->user->name ?? 'Unknown' }}</td>
                        <td class="py-2 px-2 font-body-sm text-body-sm font-bold {{ $expired->jenis_pembayaran == 'Pelunasan' ? 'text-primary' : 'text-secondary' }}">{{ $expired->jenis_pembayaran }}</td>
                        <td class="py-2 px-2">
                            <button onclick="openExpiredActionModal('{{ $expired->id_pembayaran }}', '{{ $expired->booking->id_booking }}', '{{ $expired->jenis_pembayaran }}', '{{ $expired->nominal_dibayar }}')" class="bg-error hover:bg-error/90 text-white font-label-sm text-label-sm px-3 py-1 rounded shadow-sm transition-colors flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">gavel</span> Tindak Lanjuti
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endif

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

<!-- MODAL TINDAKAN VERIFIKASI KADALUARSA -->
<div id="expired-action-modal" class="fixed inset-0 bg-[#191c1d]/60 backdrop-blur-sm z-[60] hidden items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-surface-container-lowest rounded-xl max-w-lg w-full p-6 shadow-xl border border-error/30 relative transform scale-95 transition-transform duration-300" id="expired-action-card">
        
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-full bg-error-container flex items-center justify-center text-error">
                <span class="material-symbols-outlined text-2xl">gavel</span>
            </div>
            <div>
                <h3 class="text-lg font-bold text-on-surface">Tindak Lanjuti Pesanan Expired</h3>
                <p class="text-xs text-secondary">ID Booking: <span id="expired-booking-id" class="font-bold"></span></p>
            </div>
        </div>

        <div class="mb-6 bg-surface-container-low p-4 rounded-lg">
            <p class="text-sm text-on-surface mb-2">Tipe Pembayaran: <strong id="expired-tipe-pembayaran"></strong></p>
            <p class="text-sm text-on-surface">Nominal Ditransfer: <strong id="expired-nominal" class="text-primary"></strong></p>
            
            <div id="expired-action-description" class="mt-4 text-sm text-secondary border-t border-surface-variant pt-2">
                <!-- Description injected via JS based on DP vs Pelunasan -->
            </div>
        </div>

        <form id="expired-action-form" method="POST" action="" class="m-0 p-0 flex flex-col gap-sm">
            @csrf
            <input type="hidden" name="action_type" id="expired-action-type" value="">

            <div class="flex flex-col sm:flex-row justify-end gap-sm mt-4">
                <button type="button" onclick="closeExpiredModal()" class="w-full sm:w-auto bg-surface-container hover:bg-surface-container-high text-on-surface font-medium py-2 px-4 rounded-lg text-sm transition-colors text-center">
                    Batal
                </button>
                <button type="submit" id="expired-submit-btn" class="w-full sm:w-auto text-white font-bold py-2 px-5 rounded-lg text-sm transition-all shadow-xs flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-[18px]">done</span>
                    <span id="expired-btn-text">Proses</span>
                </button>
            </div>
        </form>

    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    function openExpiredActionModal(idPembayaran, idBooking, tipePembayaran, nominal) {
        document.getElementById('expired-booking-id').innerText = idBooking;
        document.getElementById('expired-tipe-pembayaran').innerText = tipePembayaran;
        document.getElementById('expired-nominal').innerText = 'Rp ' + parseInt(nominal).toLocaleString('id-ID');
        
        const form = document.getElementById('expired-action-form');
        form.action = `/admin/verifikasi/${idPembayaran}/expired-action`;
        
        const desc = document.getElementById('expired-action-description');
        const submitBtn = document.getElementById('expired-submit-btn');
        const btnText = document.getElementById('expired-btn-text');
        const actionTypeInput = document.getElementById('expired-action-type');

        if (tipePembayaran === 'Pelunasan') {
            desc.innerHTML = `Karena jadwal telah terlewat, pesanan akan <strong>otomatis dibatalkan</strong> dan <strong>DP akan hangus</strong> (aturan H-2). Namun, dana pelunasan yang telah ditransfer ini akan masuk ke daftar <strong>Pengembalian Dana (Refund)</strong>.`;
            submitBtn.className = "w-full sm:w-auto bg-primary hover:bg-primary-container text-white font-bold py-2 px-5 rounded-lg text-sm transition-all shadow-xs flex items-center justify-center gap-1";
            btnText.innerText = "Batalkan & Refund Pelunasan";
            actionTypeInput.value = 'RefundPelunasan';
        } else {
            desc.innerHTML = `Karena yang terlewat adalah pembayaran awal <strong>(DP/Lunas)</strong> tanpa pelanggan bermain, Anda dapat memilih untuk menolak pembayaran dan menghanguskan dana. Pesanan akan otomatis dibatalkan.`;
            submitBtn.className = "w-full sm:w-auto bg-error hover:bg-error/90 text-white font-bold py-2 px-5 rounded-lg text-sm transition-all shadow-xs flex items-center justify-center gap-1";
            btnText.innerText = "Tolak & Batalkan Pesanan";
            actionTypeInput.value = 'Forfeit';
        }

        const modal = document.getElementById('expired-action-modal');
        const card = document.getElementById('expired-action-card');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => card.classList.replace('scale-95', 'scale-100'), 10);
    }

    function closeExpiredModal() {
        const modal = document.getElementById('expired-action-modal');
        const card = document.getElementById('expired-action-card');
        card.classList.replace('scale-100', 'scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 150);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('peakHoursChart').getContext('2d');
        let peakChart;

        // Data inisial dari backend
        const initialLabels = @json($labels);
        const initialData = @json($data);

        function initChart(labels, data) {
            if (peakChart) {
                peakChart.destroy();
            }

            peakChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Pemesanan',
                        data: data,
                        backgroundColor: '#005954', // Tailwind primary color
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        // Inisialisasi chart pertama kali
        initChart(initialLabels, initialData);

        // Handle filter change
        document.getElementById('chartFilter').addEventListener('change', function() {
            const filter = this.value;
            
            fetch(`{{ route('admin.dashboard') }}?filter=${filter}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(json => {
                initChart(json.labels, json.data);
            })
            .catch(err => console.error('Error fetching chart data:', err));
        });
    });
</script>
@endpush