<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Cetak Perbandingan Pendapatan - NEP Mini Soccer</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #fff; color: #000; }
        @media print {
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            #printBtn { display: none; }
        }
    </style>
</head>
<body class="p-8">

    <div class="max-w-4xl mx-auto">
        
        <!-- Header Laporan -->
        <div class="text-center mb-8 border-b-2 border-gray-800 pb-4 relative">
            <h1 class="text-2xl font-bold uppercase tracking-wider">NEP Mini Soccer</h1>
            <p class="text-gray-600">Laporan Perbandingan Pendapatan ({{ ucfirst($compare) }})</p>
            <p class="text-sm text-gray-500 mt-1">Dicetak pada: {{ now()->translatedFormat('d F Y, H:i') }}</p>
            <button id="printBtn" onclick="window.print()" class="absolute right-0 top-0 bg-green-700 text-white px-4 py-2 rounded shadow text-sm hover:bg-green-800">Cetak PDF</button>
        </div>

        <!-- Kartu Ringkasan -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="border border-gray-300 rounded-lg p-4 bg-gray-50 text-center">
                <p class="text-sm text-gray-600 font-semibold mb-1">{{ $lblIni }}</p>
                <h3 class="text-xl font-bold text-gray-900">Rp {{ number_format($pendapatanIni, 0, ',', '.') }}</h3>
            </div>
            <div class="border border-gray-300 rounded-lg p-4 bg-gray-50 text-center">
                <p class="text-sm text-gray-600 font-semibold mb-1">{{ $lblLalu }}</p>
                <h3 class="text-xl font-bold text-gray-900">Rp {{ number_format($pendapatanLalu, 0, ',', '.') }}</h3>
            </div>
            <div class="border border-gray-300 rounded-lg p-4 bg-gray-50 text-center">
                <p class="text-sm text-gray-600 font-semibold mb-1">Pertumbuhan</p>
                @php
                    $diff = $pendapatanIni - $pendapatanLalu;
                    $percent = $pendapatanLalu > 0 ? ($diff / $pendapatanLalu) * 100 : ($pendapatanIni > 0 ? 100 : 0);
                    $isPositive = $diff >= 0;
                @endphp
                <h3 class="text-xl font-bold {{ $isPositive ? 'text-green-600' : 'text-red-600' }}">
                    {{ $isPositive ? '+' : '-' }} {{ number_format(abs($percent), 1, ',', '.') }}%
                </h3>
                <p class="text-xs mt-1 {{ $isPositive ? 'text-green-600' : 'text-red-600' }}">{{ $isPositive ? '+' : '-' }} Rp {{ number_format(abs($diff), 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Grafik -->
        <div class="border border-gray-300 rounded-lg p-4">
            <h3 class="text-lg font-bold text-center mb-4">Grafik Perbandingan</h3>
            <div class="h-[400px] w-full relative">
                <canvas id="printChart"></canvas>
            </div>
        </div>

        <!-- Tanda Tangan -->
        <div class="mt-16 flex justify-end">
            <div class="text-center w-48">
                <p class="mb-16">Mengetahui, Administrator</p>
                <div class="border-b border-black w-full"></div>
                <p class="mt-2 font-bold">{{ Auth::user()->name }}</p>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('printChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['{{ $lblLalu }}', '{{ $lblIni }}'],
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: [{{ $pendapatanLalu }}, {{ $pendapatanIni }}],
                        backgroundColor: ['#a7f3d0', '#047857'], // Tailwind green-200 and green-700
                        borderWidth: 1,
                        borderColor: '#065f46' // green-800
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: false, // Nonaktifkan animasi agar langsung siap dicetak
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
                        legend: { display: false }
                    }
                }
            });

            // Otomatis memicu dialog cetak setelah chart dirender
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>
