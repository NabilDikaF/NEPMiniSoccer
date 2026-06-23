<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Cetak Laporan Pendapatan - NEP Mini Soccer</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
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
            <p class="text-gray-600">Laporan Rincian Pendapatan</p>
            <p class="text-sm text-gray-500 mt-1">
                Periode: 
                @if($start && $end)
                    {{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($end)->translatedFormat('d F Y') }}
                @else
                    Semua Waktu (All-Time)
                @endif
            </p>
            <p class="text-sm text-gray-500 mt-1">Filter: {{ ucfirst($filter) }} Transaksi</p>
            <p class="text-sm text-gray-500 mt-1">Dicetak pada: {{ now()->translatedFormat('d F Y, H:i') }}</p>
            <button id="printBtn" onclick="window.print()" class="absolute right-0 top-0 bg-green-700 text-white px-4 py-2 rounded shadow text-sm hover:bg-green-800">Cetak PDF</button>
        </div>

        <!-- Kartu Ringkasan -->
        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="border border-gray-300 rounded-lg p-4 bg-gray-50 text-center">
                <p class="text-sm text-gray-600 font-semibold mb-1">Pemasukan Kotor</p>
                <h3 class="text-xl font-bold text-green-700">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</h3>
            </div>
            <div class="border border-gray-300 rounded-lg p-4 bg-gray-50 text-center">
                <p class="text-sm text-gray-600 font-semibold mb-1">Pengeluaran (Refund)</p>
                <h3 class="text-xl font-bold text-red-600">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</h3>
            </div>
            <div class="border border-gray-300 rounded-lg p-4 bg-gray-50 text-center">
                <p class="text-sm text-gray-600 font-semibold mb-1">Pendapatan Bersih</p>
                <h3 class="text-xl font-bold text-gray-900">Rp {{ number_format($totalBersih, 0, ',', '.') }}</h3>
            </div>
        </div>

        <!-- Tabel Transaksi -->
        <div class="border border-gray-300 rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-300">
                        <th class="p-3 text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="p-3 text-sm font-semibold text-gray-700">Keterangan</th>
                        <th class="p-3 text-sm font-semibold text-gray-700">Tipe</th>
                        <th class="p-3 text-sm font-semibold text-gray-700 text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($transactions as $t)
                        @php
                            $isMasuk = $t['tipe'] === 'Masuk';
                            $sign = $isMasuk ? '+' : '-';
                            $textColor = $isMasuk ? 'text-green-700' : 'text-red-600';
                            $badgeClass = $isMasuk ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 text-sm text-gray-900 whitespace-nowrap">{{ $t['tanggal_display'] }}</td>
                            <td class="p-3 text-sm text-gray-900">{{ $t['deskripsi'] }}</td>
                            <td class="p-3 text-sm">
                                <span class="px-2 py-1 rounded text-xs font-bold {{ $badgeClass }}">
                                    {{ $t['tipe'] }}
                                </span>
                            </td>
                            <td class="p-3 text-sm text-right font-bold {{ $textColor }}">
                                {{ $sign }} Rp {{ number_format($t['nominal'], 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500 text-sm">Tidak ada transaksi pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Tanda Tangan -->
        <div class="mt-16 flex justify-end">
            <div class="text-center w-48 break-inside-avoid">
                <p class="mb-16">Mengetahui, Administrator</p>
                <div class="border-b border-black w-full"></div>
                <p class="mt-2 font-bold">{{ Auth::user()->name ?? 'Admin' }}</p>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>
