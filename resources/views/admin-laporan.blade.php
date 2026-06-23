@extends('layouts.admin')
@section('title', 'Cetak Laporan - NEP Admin')

@section('header')
<header class="mb-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-sm sm:gap-0">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Cetak Laporan</h1>
        <p class="font-body-md text-body-md text-secondary mt-xs">Hasilkan laporan transaksi, pendapatan, dan pemesanan lapangan.</p>
    </div>
</header>
@endsection

@section('content')
<div id="pendapatanWidget" style="display: none;" class="max-w-3xl mx-auto mb-lg">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-md gap-4 lg:gap-0">
        <h3 class="font-headline-sm text-headline-sm text-on-surface">Rincian Pendapatan</h3>
        
        <div class="flex flex-col sm:flex-row items-center gap-2 w-full lg:w-auto">
            <!-- Rentang Tanggal -->
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <div class="relative w-full sm:w-auto">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary text-[18px]">calendar_today</span>
                    <input type="date" id="start_date" name="start_date" class="w-full sm:w-[140px] pl-9 pr-2 py-2 bg-surface-container-lowest border border-surface-variant rounded-lg text-body-sm focus:ring-primary focus:border-primary outline-none transition-colors text-on-surface shadow-sm">
                </div>
                <span class="text-secondary font-bold">-</span>
                <div class="relative w-full sm:w-auto">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary text-[18px]">calendar_today</span>
                    <input type="date" id="end_date" name="end_date" class="w-full sm:w-[140px] pl-9 pr-2 py-2 bg-surface-container-lowest border border-surface-variant rounded-lg text-body-sm focus:ring-primary focus:border-primary outline-none transition-colors text-on-surface shadow-sm">
                </div>
            </div>

            <!-- Tipe Transaksi -->
            <select id="transaksiFilter" class="w-full sm:w-auto pl-4 pr-10 py-2 border border-surface-variant rounded-lg font-body-sm text-body-sm bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors cursor-pointer text-on-surface shadow-sm">
                <option value="semua" selected>Semua Transaksi</option>
                <option value="masuk">Uang Masuk</option>
                <option value="keluar">Uang Keluar</option>
            </select>
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-md mb-md">
        <!-- Pemasukan Kotor -->
        <div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-variant">
            <p class="font-label-sm text-label-sm text-secondary mb-xs">Pemasukan Kotor</p>
            <h3 id="cardPemasukan" class="font-headline-md text-headline-md text-primary font-bold">Rp 0</h3>
        </div>
        <!-- Total Refund -->
        <div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-variant">
            <p class="font-label-sm text-label-sm text-secondary mb-xs">Pengeluaran (Refund)</p>
            <h3 id="cardPengeluaran" class="font-headline-md text-headline-md text-error font-bold">Rp 0</h3>
        </div>
        <!-- Pendapatan Bersih -->
        <div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-variant">
            <p class="font-label-sm text-label-sm text-secondary mb-xs">Pendapatan Bersih</p>
            <h3 id="cardBersih" class="font-headline-md text-headline-md text-on-surface font-bold">Rp 0</h3>
        </div>
    </div>

    <!-- Transaction Table -->
    <div class="bg-surface-container-lowest rounded-lg shadow-sm border border-surface-variant overflow-hidden">
        <div class="overflow-x-auto max-h-[400px]">
            <table class="w-full text-left border-collapse">
                <thead class="sticky top-0 bg-surface-container-low shadow-sm">
                    <tr class="border-b border-surface-variant">
                        <th class="p-4 font-label-md text-secondary">Tanggal</th>
                        <th class="p-4 font-label-md text-secondary">Keterangan</th>
                        <th class="p-4 font-label-md text-secondary">Tipe</th>
                        <th class="p-4 font-label-md text-secondary text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody id="transaksiTableBody" class="divide-y divide-surface-variant">
                    <tr>
                        <td colspan="4" class="p-4 text-center text-secondary font-body-sm">Memuat data...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Comparison Widget -->
<div id="comparisonWidget" style="display: none;" class="max-w-3xl mx-auto mb-lg">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-md gap-4 sm:gap-0">
        <h3 class="font-headline-sm text-headline-sm text-on-surface">Perbandingan Pendapatan</h3>
        <select id="compareFilter" class="w-full sm:w-auto pl-4 pr-10 py-2 border border-surface-variant rounded-lg font-body-md text-body-md bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors cursor-pointer text-on-surface shadow-sm">
            <option value="mingguan" selected>Mingguan</option>
            <option value="bulanan">Bulanan</option>
        </select>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-md mb-md">
        <!-- Current Period -->
        <div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-variant">
            <p id="currentLabel" class="font-label-sm text-label-sm text-secondary mb-xs">Minggu Ini</p>
            <h3 id="currentValue" class="font-headline-md text-headline-md text-on-surface font-bold">Rp {{ number_format($pendapatanMingguIni, 0, ',', '.') }}</h3>
        </div>
        <!-- Past Period -->
        <div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-variant">
            <p id="pastLabel" class="font-label-sm text-label-sm text-secondary mb-xs">Minggu Lalu</p>
            <h3 id="pastValue" class="font-headline-md text-headline-md text-on-surface font-bold">Rp {{ number_format($pendapatanMingguLalu, 0, ',', '.') }}</h3>
        </div>
        <!-- Difference -->
        <div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-variant">
            <p class="font-label-sm text-label-sm text-secondary mb-xs">Pertumbuhan</p>
            <div id="diffContainer" class="flex items-center gap-2">
                @php
                    $diff = $pendapatanMingguIni - $pendapatanMingguLalu;
                    $percent = $pendapatanMingguLalu > 0 ? ($diff / $pendapatanMingguLalu) * 100 : ($pendapatanMingguIni > 0 ? 100 : 0);
                    $isPositive = $diff >= 0;
                @endphp
                <div id="diffIconBox" class="w-8 h-8 rounded-full flex items-center justify-center {{ $isPositive ? 'bg-primary-container text-on-primary-container' : 'bg-error-container text-on-error-container' }}">
                    <span id="diffIcon" class="material-symbols-outlined text-sm">{{ $isPositive ? 'trending_up' : 'trending_down' }}</span>
                </div>
                <div>
                    <h3 id="diffPercent" class="font-headline-sm text-headline-sm font-bold {{ $isPositive ? 'text-primary' : 'text-error' }}">{{ number_format(abs($percent), 1, ',', '.') }}%</h3>
                </div>
            </div>
            <p id="diffAmount" class="font-body-sm text-body-sm text-secondary mt-1">{{ $isPositive ? '+' : '-' }} Rp {{ number_format(abs($diff), 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Chart -->
    <div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-variant">
        <div class="h-64 w-full relative">
            <canvas id="comparisonChart"></canvas>
        </div>
    </div>
    </div>
</div>

<div class="max-w-3xl mx-auto bg-surface-container-lowest p-md sm:p-lg rounded-xl shadow-sm border border-surface-variant">
    <form action="#" method="GET" class="space-y-md">
        
        <!-- Jenis Laporan -->
        <div>
            <label class="block font-label-md text-label-md text-on-surface mb-xs" for="jenis_laporan">Jenis Laporan</label>
            <select id="jenis_laporan" name="jenis_laporan" class="w-full bg-surface border border-surface-variant rounded-lg p-3 text-body-md focus:ring-primary focus:border-primary outline-none transition-colors">
                <option value="" selected disabled>-- Pilih Jenis Laporan --</option>
                <option value="pendapatan">Laporan Pendapatan</option>
                <option value="perbandingan">Laporan Perbandingan Pendapatan</option>
            </select>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row gap-sm justify-end pt-md mt-md border-t border-surface-variant">
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 border border-outline text-secondary hover:bg-surface-container hover:text-on-surface rounded-lg font-label-md text-center transition-colors">
                Kembali
            </a>
            <button type="button" onclick="handleCetak()" class="px-6 py-3 bg-primary text-on-primary hover:bg-primary-container rounded-lg font-label-md text-center transition-colors shadow-sm flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">print</span>
                Cetak Laporan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('comparisonChart').getContext('2d');
    let compChart;

    // Initial Data
    let currentData = {{ $pendapatanMingguIni }};
    let pastData = {{ $pendapatanMingguLalu }};
    let currentLabel = 'Minggu Ini';
    let pastLabel = 'Minggu Lalu';

    function initChart(valCurrent, valPast, lblCurrent, lblPast) {
        if (compChart) {
            compChart.destroy();
        }

        compChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [lblPast, lblCurrent],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: [valPast, valCurrent],
                    backgroundColor: [
                        '#83fc8e', // primary-fixed (lighter green for past)
                        '#006e25'  // primary (darker green for current)
                    ],
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
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }

    function updateCards(data) {
        // Update Labels
        document.getElementById('currentLabel').innerText = data.currentLabel;
        document.getElementById('pastLabel').innerText = data.pastLabel;

        // Update Values
        document.getElementById('currentValue').innerText = 'Rp ' + data.current.toLocaleString('id-ID');
        document.getElementById('pastValue').innerText = 'Rp ' + data.past.toLocaleString('id-ID');

        // Update Diff
        const diff = data.current - data.past;
        const percent = data.past > 0 ? (diff / data.past) * 100 : (data.current > 0 ? 100 : 0);
        const isPositive = diff >= 0;

        const diffIconBox = document.getElementById('diffIconBox');
        const diffIcon = document.getElementById('diffIcon');
        const diffPercent = document.getElementById('diffPercent');
        const diffAmount = document.getElementById('diffAmount');

        if (isPositive) {
            diffIconBox.className = 'w-8 h-8 rounded-full flex items-center justify-center bg-primary-container text-on-primary-container';
            diffIcon.innerText = 'trending_up';
            diffPercent.className = 'font-headline-sm text-headline-sm font-bold text-primary';
            diffAmount.innerText = '+ Rp ' + Math.abs(diff).toLocaleString('id-ID');
        } else {
            diffIconBox.className = 'w-8 h-8 rounded-full flex items-center justify-center bg-error-container text-on-error-container';
            diffIcon.innerText = 'trending_down';
            diffPercent.className = 'font-headline-sm text-headline-sm font-bold text-error';
            diffAmount.innerText = '- Rp ' + Math.abs(diff).toLocaleString('id-ID');
        }

        diffPercent.innerText = Math.abs(percent).toLocaleString('id-ID', {minimumFractionDigits: 1, maximumFractionDigits: 1}) + '%';
    }

    // Init first load
    initChart(currentData, pastData, currentLabel, pastLabel);

    // Handle Dropdown Change
    document.getElementById('compareFilter').addEventListener('change', function() {
        const filter = this.value;
        
        fetch(`{{ route('admin.laporan') }}?compare=${filter}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            updateCards(data);
            initChart(data.current, data.past, data.currentLabel, data.pastLabel);
        })
        .catch(err => console.error('Error fetching comparison data:', err));
    });

    // Handle Print
    window.handleCetak = function() {
        const jenisLaporan = document.getElementById('jenis_laporan').value;
        if (jenisLaporan === 'perbandingan') {
            const filter = document.getElementById('compareFilter').value;
            const url = `{{ route('admin.laporan.cetak-perbandingan') }}?compare=${filter}`;
            window.open(url, '_blank');
        } else if (jenisLaporan === 'pendapatan') {
            const start = document.getElementById('start_date').value;
            const end = document.getElementById('end_date').value;
            const filter = document.getElementById('transaksiFilter').value;
            const url = `{{ route('admin.laporan.cetak-pendapatan') }}?start_date=${start}&end_date=${end}&filter=${filter}`;
            window.open(url, '_blank');
        } else {
            alert('Sistem ekspor PDF/Excel akan segera hadir di sini!');
        }
    };

    // Handle Jenis Laporan Change
    document.getElementById('jenis_laporan').addEventListener('change', function() {
        const widgetComp = document.getElementById('comparisonWidget');
        const widgetPend = document.getElementById('pendapatanWidget');
        
        if (this.value === 'perbandingan') {
            widgetComp.style.display = 'block';
            widgetPend.style.display = 'none';
        } else if (this.value === 'pendapatan') {
            widgetComp.style.display = 'none';
            widgetPend.style.display = 'block';
            fetchPendapatanData();
        } else {
            widgetComp.style.display = 'none';
            widgetPend.style.display = 'none';
        }
    });

    // PENDAPATAN WIDGET LOGIC
    let allTransactions = [];

    window.fetchPendapatanData = function() {
        const start = document.getElementById('start_date').value;
        const end = document.getElementById('end_date').value;
        const url = `{{ route('admin.laporan.data-pendapatan') }}?start_date=${start}&end_date=${end}`;
        
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.json())
            .then(data => {
                document.getElementById('cardPemasukan').innerText = 'Rp ' + data.total_masuk.toLocaleString('id-ID');
                document.getElementById('cardPengeluaran').innerText = 'Rp ' + data.total_keluar.toLocaleString('id-ID');
                document.getElementById('cardBersih').innerText = 'Rp ' + data.total_bersih.toLocaleString('id-ID');
                
                allTransactions = data.transactions;
                renderTransaksiTable();
            })
            .catch(err => console.error(err));
    };

    window.renderTransaksiTable = function() {
        const filter = document.getElementById('transaksiFilter').value;
        const tbody = document.getElementById('transaksiTableBody');
        
        let filtered = allTransactions;
        if (filter === 'masuk') {
            filtered = allTransactions.filter(t => t.tipe === 'Masuk');
        } else if (filter === 'keluar') {
            filtered = allTransactions.filter(t => t.tipe === 'Keluar');
        }

        if (filtered.length === 0) {
            tbody.innerHTML = `<tr><td colspan="4" class="p-4 text-center text-secondary font-body-sm">Tidak ada transaksi.</td></tr>`;
            return;
        }

        tbody.innerHTML = filtered.map(t => {
            const isMasuk = t.tipe === 'Masuk';
            const badgeClass = isMasuk ? 'bg-primary-container text-on-primary-container' : 'bg-error-container text-on-error-container';
            const icon = isMasuk ? 'arrow_downward' : 'arrow_upward';
            const sign = isMasuk ? '+' : '-';
            
            return `
                <tr class="hover:bg-surface-container-lowest transition-colors">
                    <td class="p-4 font-body-sm text-on-surface whitespace-nowrap">${t.tanggal_display}</td>
                    <td class="p-4 font-body-sm text-on-surface">${t.deskripsi}</td>
                    <td class="p-4">
                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-bold ${badgeClass}">
                            <span class="material-symbols-outlined text-[14px]">${icon}</span>
                            ${t.tipe}
                        </span>
                    </td>
                    <td class="p-4 font-label-md text-right ${isMasuk ? 'text-primary' : 'text-error'}">
                        ${sign} Rp ${t.nominal.toLocaleString('id-ID')}
                    </td>
                </tr>
            `;
        }).join('');
    };

    document.getElementById('start_date').addEventListener('change', fetchPendapatanData);
    document.getElementById('end_date').addEventListener('change', fetchPendapatanData);
    document.getElementById('transaksiFilter').addEventListener('change', renderTransaksiTable);
    
    // Initial fetch if 'pendapatan' is selected
    if (document.getElementById('jenis_laporan').value === 'pendapatan') {
        fetchPendapatanData();
    }
});
</script>
@endpush
