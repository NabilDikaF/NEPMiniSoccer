@extends('layouts.app')
@section('title', 'My Bookings - NEP Mini Soccer')

@section('content')
<!-- Main Content Canvas -->
<div class="w-full max-w-container-max mx-auto px-gutter py-xl">
    <!-- Page Header -->
    <header class="mb-lg flex flex-col md:flex-row md:items-end justify-between gap-md">
        <div>
            <h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Status Booking</h1>
            <p class="font-body-md text-body-md text-secondary">Kelola pertandingan Anda yang akan datang dan tinjau pemesanan sebelumnya.</p>
        </div>
        <!-- Filter Pills -->
        <div class="flex gap-sm overflow-x-auto pb-xs hide-scrollbar" id="filter-buttons">
            <button onclick="filterBookings('all', this)" class="filter-btn px-md py-xs bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-sm whitespace-nowrap transition-colors">Semua Booking</button>
            <button onclick="filterBookings('upcoming', this)" class="filter-btn px-md py-xs bg-surface-container-lowest border border-outline-variant text-secondary rounded-full font-label-md text-label-md hover:bg-surface-container transition-colors whitespace-nowrap">Akan Datang</button>
            <button onclick="filterBookings('completed', this)" class="filter-btn px-md py-xs bg-surface-container-lowest border border-outline-variant text-secondary rounded-full font-label-md text-label-md hover:bg-surface-container transition-colors whitespace-nowrap">Selesai</button>
        </div>
    </header>

    <!-- Notifikasi Sukses / Error -->
    @if(session('success'))
        <div class="bg-primary-container/20 text-primary-fixed-variant p-4 rounded-lg text-sm font-bold mb-6 border border-primary-container/50">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-error/10 text-error p-4 rounded-lg text-sm font-bold mb-6 border border-error/20">
            {{ session('error') }}
        </div>
    @endif

    <!-- Bento Grid Layout for Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-md">
        
        @forelse($bookings as $booking)
            @php
                $firstDetail = $booking->detailBookings->first();
                $lastDetail  = $booking->detailBookings->last();
                
                if(!$firstDetail) continue;

                $tanggal = \Carbon\Carbon::parse($firstDetail->jadwal->tanggal)->translatedFormat('D, d M Y');
                $jamMulai = \Carbon\Carbon::parse($firstDetail->jadwal->harga->jam_mulai)->format('H:i');
                $jamSelesai = \Carbon\Carbon::parse($lastDetail->jadwal->harga->jam_selesai)->format('H:i');
                
                // Hitung sisa tagihan secara aman
                $sudahDibayar = $booking->pembayaran ? $booking->pembayaran->where('status_pembayaran', 'Valid')->sum('nominal_dibayar') : 0;
                $sisaTagihan = $booking->total_tagihan - $sudahDibayar;

                // Logika H-x untuk kancing fitur Reschedule & Cancel
                $jadwalMulaiDate = \Carbon\Carbon::parse($firstDetail->jadwal->tanggal)->startOfDay();
                $selisihHari = \Carbon\Carbon::now()->startOfDay()->diffInDays($jadwalMulaiDate, false);
                $isRescheduleLocked = $selisihHari <= 3;

                // Tentukan Kategori Filter
                $filterCategory = 'upcoming';
                if ($booking->status_booking == 'Dibatalkan' || $selisihHari < 0 || $booking->isPastPlayTime()) {
                    $filterCategory = 'completed';
                }
                
                $isExpired = $booking->isPastPlayTime();
                $isPlaying = $booking->isPlayingTime();
            @endphp

            {{-- KONDISI 1: MENUNGGU PEMBAYARAN ATAU HALF PAID --}}
            @if($booking->status_booking == 'Menunggu Pembayaran' || $booking->status_booking == 'Half Paid')
                <article data-category="{{ $filterCategory }}" class="booking-card bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-300 flex flex-col border border-surface-variant relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-secondary-fixed-dim"></div>
                    <div class="flex-1 flex flex-col"><div class="flex flex-col sm:flex-row justify-between items-start mb-sm gap-sm">
                        <div>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface">NEP Mini Soccer ({{ $booking->tipe_booking }})</h3>
                            <p class="font-label-sm text-label-sm text-secondary flex items-center gap-xs mt-xs">
                                <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                {{ $tanggal }} • {{ $jamMulai }} - {{ $jamSelesai }}
                            </p>
                        </div>
                        <span class="px-sm py-xs bg-secondary-fixed text-on-secondary-fixed rounded-full font-label-sm text-label-sm whitespace-nowrap">{{ $booking->status_booking }}</span>
                    </div><div class="flex flex-col gap-xs py-sm border-t border-surface-variant mt-sm">
                        <div class="flex justify-between items-center">
                            <span class="font-label-md text-label-md text-secondary">Booking ID</span>
                            <span class="font-body-md text-body-md text-on-surface font-medium">{{ $booking->id_booking }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-label-md text-label-md text-secondary">Total Tagihan</span>
                            <span class="font-body-md text-body-md text-on-surface font-medium">Rp {{ number_format($booking->total_tagihan, 0, ',', '.') }}</span>
                        </div>
                        @if($booking->status_booking == 'Half Paid')
                        <div class="flex justify-between items-center mt-xs p-xs bg-surface-container-low rounded">
                            <span class="font-label-md text-label-md text-secondary">Sisa Pembayaran</span>
                            <span class="font-body-md text-body-md text-on-surface font-bold">Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        
                        @if($booking->pembayaranTerakhir && $booking->pembayaranTerakhir->status_pembayaran == 'Ditolak')
                        <div class="mt-sm p-sm bg-error-container text-on-error-container rounded-DEFAULT border border-error/20 flex flex-col gap-xs">
                            <span class="font-label-md text-label-md font-bold flex items-center gap-xs whitespace-nowrap">
                                <span class="material-symbols-outlined text-[18px]">error</span> Pembayaran Terakhir Ditolak
                            </span>
                            <span class="font-label-md text-label-md">
                                <strong>Alasan:</strong> {{ $booking->pembayaranTerakhir->catatan_admin ?? 'Tidak ada catatan dari admin.' }}
                            </span>
                        </div>
                        @endif
                    </div></div><!-- FOOTER TOMBOL AKSI -->
                    @if($isExpired)
                    <div class="mt-auto pt-sm w-full border-t border-surface-variant mt-sm text-center">
                        <span class="inline-block px-md py-sm bg-error-container text-on-error-container rounded-lg font-label-md text-label-md w-full">
                            <span class="material-symbols-outlined text-[16px] align-middle mr-1">timer_off</span> Waktu Terlewat
                        </span>
                    </div>
                    @else
                    <div class="mt-auto pt-sm grid grid-cols-1 xl:grid-cols-3 gap-xs w-full border-t border-surface-variant mt-sm">
                        <!-- Pembayaran -->
                        <a href="{{ route('payment.page', $booking->id_booking) }}" class="w-full xl:w-auto flex-1 text-center justify-center px-sm py-sm bg-primary text-on-primary rounded font-label-md text-label-md shadow-sm hover:opacity-90 transition-all flex items-center gap-xs whitespace-nowrap">
                            <span class="material-symbols-outlined text-[18px]">payments</span> Bayar
                        </a>

                        <!-- Reschedule -->
                        @if($isRescheduleLocked)
                            <button type="button" onclick="openAlertModal('Peringatan Sistem', 'Permintaan Reschedule ditolak. Mengubah jadwal hanya dapat dilakukan maksimal <strong>H-3 sebelum jadwal bermain.</strong>')" class="w-full xl:w-auto flex-1 text-center justify-center px-sm py-sm border border-outline-variant text-secondary opacity-70 cursor-not-allowed rounded font-label-md text-label-md flex items-center gap-xs whitespace-nowrap">
                                <span class="material-symbols-outlined text-[18px]">event_busy</span> Ubah
                            </button>
                        @else
                            <button type="button" onclick="openRescheduleModal('{{ $booking->id_booking }}')" class="w-full xl:w-auto flex-1 text-center justify-center px-sm py-sm border border-outline text-secondary rounded font-label-md text-label-md hover:bg-surface-container-low transition-colors flex items-center gap-xs whitespace-nowrap">
                                <span class="material-symbols-outlined text-[18px]">edit_calendar</span> Ubah
                            </button>
                        @endif

                        <!-- Cancel -->
                        <button type="button" onclick="openCancelModal('{{ $booking->id_booking }}', {{ $selisihHari }}, '{{ $booking->status_booking }}')" class="w-full xl:w-auto flex-1 text-center justify-center px-sm py-sm border border-error text-error hover:bg-error/10 rounded font-label-md text-label-md transition-colors flex items-center gap-xs whitespace-nowrap">
                            <span class="material-symbols-outlined text-[18px]">cancel</span> Batal
                        </button>
                    </div>
                    @endif
                </article>

            {{-- KONDISI 2: MENUNGGU VERIFIKASI --}}
            @elseif($booking->status_booking == 'Menunggu Verifikasi')
                <article data-category="{{ $filterCategory }}" class="booking-card bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-300 flex flex-col border border-surface-variant relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-tertiary-fixed"></div>
                    <div class="flex-1 flex flex-col"><div class="flex flex-col sm:flex-row justify-between items-start mb-sm gap-sm">
                        <div>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface">NEP Mini Soccer ({{ $booking->tipe_booking }})</h3>
                            <p class="font-label-sm text-label-sm text-secondary flex items-center gap-xs mt-xs">
                                <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                {{ $tanggal }} • {{ $jamMulai }} - {{ $jamSelesai }}
                            </p>
                        </div>
                        <span class="px-sm py-xs bg-tertiary-fixed text-on-tertiary-fixed rounded-full font-label-sm text-label-sm whitespace-nowrap">Menunggu Verifikasi</span>
                    </div><div class="flex flex-col gap-xs py-sm border-t border-surface-variant mt-sm">
                        <div class="flex justify-between items-center">
                            <span class="font-label-md text-label-md text-secondary">Booking ID</span>
                            <span class="font-body-md text-body-md text-on-surface font-medium">{{ $booking->id_booking }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-label-md text-label-md text-secondary">Total Tagihan</span>
                            <span class="font-body-md text-body-md text-on-surface font-medium">Rp {{ number_format($booking->total_tagihan, 0, ',', '.') }}</span>
                        </div>
                        <div class="mt-xs font-label-sm text-label-sm text-secondary bg-surface-container p-xs rounded">
                            Admin sedang meninjau bukti pembayaran Anda.
                        </div>
                    </div></div><!-- FOOTER TOMBOL AKSI -->
                    @if($isExpired)
                    <div class="mt-auto pt-sm w-full border-t border-surface-variant mt-sm text-center">
                        <span class="inline-block px-md py-sm bg-error-container text-on-error-container rounded-lg font-label-md text-label-md w-full">
                            <span class="material-symbols-outlined text-[16px] align-middle mr-1">timer_off</span> Waktu Terlewat (Menunggu Verifikasi Admin)
                        </span>
                    </div>
                    @else
                    <div class="mt-auto pt-sm grid grid-cols-2 gap-xs w-full border-t border-surface-variant mt-sm">
                        <!-- Reschedule -->
                        @if($isRescheduleLocked)
                            <button type="button" onclick="openAlertModal('Peringatan Sistem', 'Permintaan Reschedule ditolak. Mengubah jadwal hanya dapat dilakukan maksimal <strong>H-3 sebelum jadwal bermain.</strong>')" class="w-full sm:w-auto flex-1 text-center justify-center px-sm py-sm border border-outline-variant text-secondary opacity-70 cursor-not-allowed rounded font-label-md text-label-md flex items-center gap-xs whitespace-nowrap">
                                <span class="material-symbols-outlined text-[18px]">event_busy</span> Ubah
                            </button>
                        @else
                            <button type="button" onclick="openRescheduleModal('{{ $booking->id_booking }}')" class="w-full sm:w-auto flex-1 text-center justify-center px-sm py-sm border border-outline text-secondary rounded font-label-md text-label-md hover:bg-surface-container-low transition-colors flex items-center gap-xs whitespace-nowrap">
                                <span class="material-symbols-outlined text-[18px]">edit_calendar</span> Ubah
                            </button>
                        @endif

                        <!-- Cancel -->
                        <button type="button" onclick="openCancelModal('{{ $booking->id_booking }}', {{ $selisihHari }}, '{{ $booking->status_booking }}')" class="w-full sm:w-auto flex-1 text-center justify-center px-sm py-sm border border-error text-error hover:bg-error/10 rounded font-label-md text-label-md transition-colors flex items-center gap-xs whitespace-nowrap">
                            <span class="material-symbols-outlined text-[18px]">cancel</span> Batal
                        </button>
                    </div>
                    @endif
                </article>

            {{-- KONDISI 3: CONFIRMED / LUNAS --}}
            @elseif($booking->status_booking == 'Confirmed' || $booking->status_booking == 'Lunas')
                <article data-category="{{ $filterCategory }}" class="booking-card bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-300 flex flex-col border border-surface-variant relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-primary-container"></div>
                    <div class="flex-1 flex flex-col"><div class="flex flex-col sm:flex-row justify-between items-start mb-sm gap-sm">
                        <div>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface">NEP Mini Soccer ({{ $booking->tipe_booking }})</h3>
                            <p class="font-label-sm text-label-sm text-secondary flex items-center gap-xs mt-xs">
                                <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                {{ $tanggal }} • {{ $jamMulai }} - {{ $jamSelesai }}
                            </p>
                        </div>
                        @if($isPlaying)
                            <span class="px-sm py-xs bg-[#dcfce7] text-[#166534] border border-[#bbf7d0] rounded-full font-label-sm text-label-sm whitespace-nowrap animate-pulse flex items-center gap-1">
                                <span class="w-2 h-2 bg-[#22c55e] rounded-full"></span> Waktu Dimulai
                            </span>
                        @else
                            <span class="px-sm py-xs bg-primary-container text-on-primary-container rounded-full font-label-sm text-label-sm whitespace-nowrap">Confirmed/Lunas</span>
                        @endif
                    </div><div class="flex flex-col gap-xs py-sm border-t border-surface-variant mt-sm">
                        <div class="flex justify-between items-center">
                            <span class="font-label-md text-label-md text-secondary">Booking ID</span>
                            <span class="font-body-md text-body-md text-on-surface font-medium">{{ $booking->id_booking }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-label-md text-label-md text-secondary">Total Tagihan</span>
                            <span class="font-body-md text-body-md text-on-surface font-medium">Rp {{ number_format($booking->total_tagihan, 0, ',', '.') }}</span>
                        </div>
                    </div></div><!-- FOOTER TOMBOL AKSI -->
                    <div class="mt-auto pt-sm grid grid-cols-2 gap-xs w-full border-t border-surface-variant mt-sm">
                        <!-- Reschedule -->
                        @if($isRescheduleLocked)
                            <button type="button" onclick="openAlertModal('Peringatan Sistem', 'Permintaan Reschedule ditolak. Mengubah jadwal hanya dapat dilakukan maksimal <strong>H-3 sebelum jadwal bermain.</strong>')" class="w-full sm:w-auto flex-1 text-center justify-center px-sm py-sm border border-outline-variant text-secondary opacity-70 cursor-not-allowed rounded font-label-md text-label-md flex items-center gap-xs whitespace-nowrap">
                                <span class="material-symbols-outlined text-[18px]">event_busy</span> Ubah
                            </button>
                        @else
                            <button type="button" onclick="openRescheduleModal('{{ $booking->id_booking }}')" class="w-full sm:w-auto flex-1 text-center justify-center px-sm py-sm border border-outline text-secondary rounded font-label-md text-label-md hover:bg-surface-container-low transition-colors flex items-center gap-xs whitespace-nowrap">
                                <span class="material-symbols-outlined text-[18px]">edit_calendar</span> Ubah
                            </button>
                        @endif

                        <!-- Cancel -->
                        <button type="button" onclick="openCancelModal('{{ $booking->id_booking }}', {{ $selisihHari }}, '{{ $booking->status_booking }}')" class="w-full sm:w-auto flex-1 text-center justify-center px-sm py-sm border border-error text-error hover:bg-error/10 rounded font-label-md text-label-md transition-colors flex items-center gap-xs whitespace-nowrap">
                            <span class="material-symbols-outlined text-[18px]">cancel</span> Batal
                        </button>
                    </div>
                </article>

            {{-- KONDISI 4: SELESAI --}}
            @elseif($booking->status_booking == 'Selesai')
                <article data-category="{{ $filterCategory }}" class="booking-card bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] opacity-80 flex flex-col h-full border border-surface-variant relative overflow-hidden grayscale-[0.3]">
                    <div class="absolute top-0 left-0 w-full h-1 bg-secondary"></div>
                    <div class="flex flex-col sm:flex-row justify-between items-start mb-sm gap-sm">
                        <div>
                            <h3 class="font-headline-sm text-headline-sm text-secondary">NEP Mini Soccer ({{ $booking->tipe_booking }})</h3>
                            <p class="font-label-sm text-label-sm text-secondary flex items-center gap-xs mt-xs">
                                <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                {{ $tanggal }} • {{ $jamMulai }} - {{ $jamSelesai }}
                            </p>
                        </div>
                        <span class="px-sm py-xs bg-surface-variant text-on-surface-variant rounded-full font-label-sm text-label-sm whitespace-nowrap">Selesai</span>
                    </div>
                    <div class="flex flex-col gap-xs py-sm border-t border-surface-variant mt-sm">
                        <div class="flex justify-between items-center">
                            <span class="font-label-md text-label-md text-secondary">Booking ID</span>
                            <span class="font-body-md text-body-md text-secondary font-medium">{{ $booking->id_booking }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-label-md text-label-md text-secondary">Total Tagihan</span>
                            <span class="font-body-md text-body-md text-secondary font-medium">Rp {{ number_format($booking->total_tagihan, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </article>

            {{-- KONDISI 4: DIBATALKAN --}}
            @elseif($booking->status_booking == 'Dibatalkan')
                <article data-category="{{ $filterCategory }}" class="booking-card bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] opacity-80 flex flex-col h-full border border-surface-variant relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-error"></div>
                    <div class="flex flex-col sm:flex-row justify-between items-start mb-sm gap-sm">
                        <div>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface line-through text-secondary">NEP Mini Soccer</h3>
                            <p class="font-label-sm text-label-sm text-secondary flex items-center gap-xs mt-xs">
                                <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                                {{ $tanggal }} • {{ $jamMulai }} - {{ $jamSelesai }}
                            </p>
                        </div>
                        <span class="px-sm py-xs bg-error-container text-on-error-container rounded-full font-label-sm text-label-sm whitespace-nowrap">Dibatalkan</span>
                    </div>
                    <div class="flex flex-col gap-xs py-sm border-t border-surface-variant mt-sm">
                        <div class="flex justify-between items-center">
                            <span class="font-label-md text-label-md text-secondary">Booking ID</span>
                            <span class="font-body-md text-body-md text-secondary font-medium">{{ $booking->id_booking }}</span>
                        </div>
                    </div>
                </article>
            @endif

        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-10 bg-surface-container-lowest rounded-lg border border-surface-variant">
                <span class="material-symbols-outlined text-secondary text-6xl mb-4">event_note</span>
                <h3 class="font-headline-sm text-on-surface font-bold">Belum Ada Pesanan</h3>
                <p class="text-secondary mt-2">Anda belum pernah memesan lapangan. Yuk, main sekarang!</p>
                <a href="{{ route('booking') }}" class="inline-block mt-4 px-6 py-2 bg-primary text-on-primary rounded font-label-md text-label-md shadow hover:shadow-md transition">Pesan Lapangan</a>
            </div>
        @endforelse
        
    </div>
</div>

<!-- ======================================================= -->
<!-- BAGIAN KOMPONEN MODAL (MENGGUNAKAN THEME ASLI ANDA)     -->
<!-- ======================================================= -->

<!-- 1. MODAL CANCEL (Hitung Denda Otomatis) -->
<div id="cancel-modal" class="fixed inset-0 bg-[#191c1d]/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-surface-container-lowest rounded-xl max-w-md w-full p-6 shadow-xl border border-surface-variant relative transform scale-95 transition-transform duration-300" id="cancel-modal-card">
        <div class="w-12 h-12 rounded-full bg-error-container flex items-center justify-center text-on-error-container mb-4 mx-auto">
            <span class="material-symbols-outlined text-[24px]">warning</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-center text-on-surface mb-2">Batalkan Pesanan?</h3>
        <!-- Pesan peringatan denda disuntikkan kesini -->
        <div id="cancel-warning-message" class="font-body-md text-body-md p-4 rounded-lg mb-6 text-center leading-relaxed"></div>

        <form id="cancel-form" method="POST" class="flex flex-col sm:flex-row gap-sm m-0">
            @csrf
            <button type="submit" class="w-full sm:w-1/2 bg-error hover:opacity-90 text-on-error font-label-md text-label-md py-3 rounded-lg transition-opacity shadow-sm">
                Ya, Batalkan
            </button>
            <button type="button" onclick="closeModal('cancel-modal', 'cancel-modal-card')" class="w-full sm:w-1/2 bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md py-3 rounded-lg transition-colors">
                Batal
            </button>
        </form>
    </div>
</div>

<!-- 2. MODAL RESCHEDULE KONFIRMASI -->
<div id="reschedule-modal" class="fixed inset-0 bg-[#191c1d]/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-surface-container-lowest rounded-xl max-w-md w-full p-6 shadow-xl border border-surface-variant relative transform scale-95 transition-transform duration-300" id="reschedule-modal-card">
        <div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container mb-4 mx-auto">
            <span class="material-symbols-outlined text-[24px]">edit_calendar</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-center text-on-surface mb-2">Ubah Jadwal Main?</h3>
        <div class="bg-surface-container text-on-surface font-body-md text-body-md p-4 rounded-lg mb-6 text-center leading-relaxed">
            Apakah Anda yakin ingin mengajukan Reschedule?
        </div>

        <form id="reschedule-form" method="POST" class="flex flex-col sm:flex-row gap-sm m-0">
            @csrf
            <button type="submit" class="w-full sm:w-1/2 bg-primary hover:opacity-90 text-on-primary font-label-md text-label-md py-3 rounded-lg transition-opacity shadow-sm">
                Ya, Ubah
            </button>
            <button type="button" onclick="closeModal('reschedule-modal', 'reschedule-modal-card')" class="w-full sm:w-1/2 bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md py-3 rounded-lg transition-colors">
                Batal
            </button>
        </form>
    </div>
</div>

<!-- 3. MODAL ALERT PERINGATAN (Untuk H-3 Locked) -->
<div id="alert-modal" class="fixed inset-0 bg-[#191c1d]/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-surface-container-lowest rounded-xl max-w-md w-full p-6 shadow-xl border border-surface-variant relative transform scale-95 transition-transform duration-300" id="alert-modal-card">
        <div class="w-12 h-12 rounded-full bg-tertiary-container flex items-center justify-center text-on-tertiary-container mb-4 mx-auto">
            <span class="material-symbols-outlined text-[24px]">event_busy</span>
        </div>
        <h3 id="alert-title" class="font-headline-sm text-headline-sm text-center text-on-surface mb-2">Peringatan</h3>
        <div id="alert-message" class="text-secondary font-body-md text-body-md mb-6 text-center leading-relaxed"></div>
        <button type="button" onclick="closeModal('alert-modal', 'alert-modal-card')" class="w-full bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md py-3 rounded-lg transition-colors">
            Saya Mengerti
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // FUNGSI FILTER BOOKING
    function filterBookings(category, btn) {
        const buttons = document.querySelectorAll('.filter-btn');
        buttons.forEach(b => {
            b.className = "filter-btn px-md py-xs bg-surface-container-lowest border border-outline-variant text-secondary rounded-full font-label-md text-label-md hover:bg-surface-container transition-colors whitespace-nowrap";
        });
        btn.className = "filter-btn px-md py-xs bg-primary text-on-primary rounded-full font-label-md text-label-md shadow-sm whitespace-nowrap transition-colors";

        const cards = document.querySelectorAll('.booking-card');
        cards.forEach(card => {
            if (category === 'all' || card.getAttribute('data-category') === category) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // FUNGSI UMUM UNTUK MENUTUP MODAL
    function closeModal(modalId, cardId) {
        const modal = document.getElementById(modalId);
        const card = document.getElementById(cardId);
        card.classList.remove('scale-100');
        card.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 150);
    }

    // 1. Logika Buka Modal Cancel
    function openCancelModal(bookingId, selisihHari, statusPembayaran) {
        document.getElementById('cancel-form').action = `/mybooking/${bookingId}/cancel`;
        const warningBox = document.getElementById('cancel-warning-message');

        if (statusPembayaran === 'Menunggu Pembayaran') {
            warningBox.innerHTML = `Apakah Anda yakin ingin membatalkan pesanan ini?`;
        } else {
            if (selisihHari <= 2) {
                if (statusPembayaran === 'Half Paid' || statusPembayaran === 'DP') {
                    warningBox.innerHTML = `Anda membatalkan pada <strong>H-2</strong> atau kurang. Sesuai kebijakan, <strong>uang DP Anda hangus (Tidak dikembalikan)</strong>.`;
                } else {
                    warningBox.innerHTML = `Anda membatalkan pada <strong>H-2</strong> atau kurang. Sesuai kebijakan, dana akan <strong>dikembalikan sebesar 50%</strong> dari total.`;
                }
            } else {
                warningBox.innerHTML = `Aman! Anda membatalkan lebih awal dari H-2. Seluruh dana akan <strong>dikembalikan 100%</strong>.`;
            }
        }
        
        // Seragamkan tema seperti modal reschedule
        warningBox.className = "bg-surface-container text-on-surface font-body-md text-body-md p-4 rounded-lg mb-6 text-center leading-relaxed";

        document.getElementById('cancel-modal').classList.remove('hidden');
        document.getElementById('cancel-modal').classList.add('flex');
        setTimeout(() => document.getElementById('cancel-modal-card').classList.replace('scale-95', 'scale-100'), 10);
    }

    // 2. Logika Buka Modal Reschedule
    function openRescheduleModal(bookingId) {
        document.getElementById('reschedule-form').action = `/mybooking/${bookingId}/reschedule`;
        document.getElementById('reschedule-modal').classList.remove('hidden');
        document.getElementById('reschedule-modal').classList.add('flex');
        setTimeout(() => document.getElementById('reschedule-modal-card').classList.replace('scale-95', 'scale-100'), 10);
    }

    // 3. Logika Buka Modal Alert Kustom
    function openAlertModal(title, message) {
        document.getElementById('alert-title').innerHTML = title;
        document.getElementById('alert-message').innerHTML = message;
        
        document.getElementById('alert-modal').classList.remove('hidden');
        document.getElementById('alert-modal').classList.add('flex');
        setTimeout(() => document.getElementById('alert-modal-card').classList.replace('scale-95', 'scale-100'), 10);
    }

    // Event Klik di luar area card untuk tutup semua modal
    window.onclick = function(event) {
        if (event.target.id === 'cancel-modal') closeModal('cancel-modal', 'cancel-modal-card');
        if (event.target.id === 'reschedule-modal') closeModal('reschedule-modal', 'reschedule-modal-card');
        if (event.target.id === 'alert-modal') closeModal('alert-modal', 'alert-modal-card');
    }
</script>
@endpush





