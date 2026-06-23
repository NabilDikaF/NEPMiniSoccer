@extends('layouts.admin')
@section('title', 'Data Pelanggan - NEP Admin')

@section('header')
<header class="mb-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-sm sm:gap-0">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Data Pelanggan</h1>
        <p class="font-body-md text-body-md text-secondary mt-xs">Manajemen data pelanggan dan riwayat pemesanan lapangan.</p>
    </div>
</header>
@endsection

@section('content')

<!-- Search & Filter Form -->
<form method="GET" action="{{ route('admin.pelanggan') }}" class="mb-lg bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-surface-variant flex flex-col lg:flex-row gap-4 items-center justify-between">
    <div class="flex-1 w-full relative">
        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary">search</span>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama akun atau no whatsapp..." class="w-full pl-10 pr-4 py-2 border border-surface-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors">
    </div>
    
    <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">
        <button type="submit" class="bg-primary hover:bg-primary-container text-on-primary px-6 py-2 rounded-lg font-label-md text-label-md transition-colors whitespace-nowrap shadow-sm flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[18px]">search</span>
            Cari Pelanggan
        </button>
    </div>
</form>

<!-- Data Table Card -->
<div class="bg-surface-container-lowest rounded-lg shadow-sm border border-surface-variant overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-center border-collapse">
            <thead>
                <tr class="bg-surface-container-low border-b border-surface-variant">
                    <th class="px-md py-sm font-label-md text-label-md text-on-surface-variant w-16">No</th>
                    <th class="px-md py-sm font-label-md text-label-md text-on-surface-variant">Nama Akun</th>
                    <th class="px-md py-sm font-label-md text-label-md text-on-surface-variant">No. WhatsApp</th>
                    <th class="px-md py-sm font-label-md text-label-md text-on-surface-variant">Total Booking</th>
                    <th class="px-md py-sm font-label-md text-label-md text-on-surface-variant">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-variant font-body-md text-body-md">
                @forelse($pelanggans as $index => $pelanggan)
                    @php
                        $latestBooking = $pelanggan->bookings->first();
                        $namaTim = $latestBooking ? $latestBooking->nama_tim : '-';
                    @endphp
                    <tr class="hover:bg-surface transition-colors">
                        <td class="px-md py-sm text-secondary">{{ $pelanggans->firstItem() + $index }}</td>
                        <td class="px-md py-sm font-medium text-on-surface">{{ $pelanggan->name }}</td>
                        <td class="px-md py-sm text-secondary">{{ $pelanggan->formatted_no_hp }}</td>
                        <td class="px-md py-sm">{{ $pelanggan->bookings_count }}</td>
                        <td class="px-md py-sm">
                            <a href="{{ route('admin.pelanggan.detail', $pelanggan->id) }}" class="inline-flex items-center justify-center px-sm py-1 border border-outline rounded text-primary hover:bg-surface-container-low transition-colors font-label-md text-label-md">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-md py-xl text-center text-secondary font-body-md">
                            Tidak ada data pelanggan yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pelanggans->hasPages())
        <div class="border-t border-surface-variant px-md py-sm bg-surface-container-lowest">
            {{ $pelanggans->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Menghilangkan parameter pencarian & filter (?search=...&filter=...) dari URL bar 
    // agar terlihat lebih bersih, tanpa mengganggu fungsionalitas pencarian/pagination
    if (window.history.replaceState && window.location.search) {
        const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({path: cleanUrl}, '', cleanUrl);
    }
</script>
@endpush