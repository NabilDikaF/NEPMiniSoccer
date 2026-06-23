@extends('layouts.app')
@section('title', 'NEP Mini Soccer - Beranda')

@section('content')
    <!-- HERO SECTION -->
    <section class="relative w-full h-[300px] sm:h-[400px] md:h-[500px] bg-surface-container-high flex items-center justify-center overflow-hidden">
        <img alt="Hero Image" class="absolute inset-0 w-full h-full object-cover opacity-80" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBHei4XoW3wKQbXor9u5fe5-TnO8E7_gq-qdjhyegT5hG0l4hmUY7QG4cj2kuDMsdL7KR4ZnIW--sabJ5Y_I-mBJxErPcaA7EBxhvRIDVjKFSNX94K5Fl-caQxqGfPt4TifnjqQIsUwKGeh27FImelFAjmGAxsYGGnGjFHf6xyGlaANtdGCmqzNWyhTey0ybB2qMbYyiDK7Nv6NLepkfuvcCVhBZMWd5JkZSqH6_yl8Ua2dHvLPxg_A4I3sk5XOOqpgVQDmjpJaThu0"/>
        <div class="absolute inset-0 bg-gradient-to-t from-background via-background/40 to-transparent"></div>
        <div class="relative z-10 text-center px-gutter max-w-container-max mx-auto w-full">
            <h1 class="font-display-lg text-3xl sm:text-4xl md:text-display-lg leading-tight font-bold text-on-surface mb-sm">
                Mainkan Permainan Terbaikmu.
            </h1>
            <p class="font-body-lg text-base sm:text-lg md:text-body-lg text-secondary max-w-2xl mx-auto mb-md">
                Fasilitas mini soccer premium dengan kualitas rumput sintetis standar FIFA. Pesan jadwalmu sekarang dan nikmati pengalaman bermain kelas satu.
            </p>
            <a href="{{ route('booking') }}" class="inline-flex items-center justify-center px-md py-sm bg-primary text-on-primary rounded-lg font-label-md text-label-md shadow-sm hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all">
                Pesan Sekarang
            </a>
        </div>
    </section>

    <!-- KONTEN JADWAL DINAMIS -->
    <section class="w-full max-w-container-max mx-auto px-gutter py-xl space-y-lg" id="jadwal-section">
        
        <!-- Tab Pemilihan Tanggal -->
        <div class="bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] border border-surface-variant flex flex-col">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-sm gap-sm">
                <div>
                    <h2 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Jadwal Lapangan</h2>
                    <p class="font-body-md text-body-md text-secondary">Pilih tanggal untuk melihat ketersediaan.</p>
                </div>
                
                <!-- TOMBOL NAVIGASI NEXT & PREV -->
                <div class="flex items-center gap-xs">
                    <!-- Tombol Prev (Lompat 7 Hari Mundur) -->
                    <a href="{{ route('home', ['start_date' => $prevDate]) }}#jadwal-section" class="p-xs rounded-full hover:bg-surface-container transition-colors text-secondary flex items-center justify-center">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </a>
                    
                    <span class="font-label-md text-label-md text-on-surface font-bold px-xs">
                        {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d M') }} - {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d M Y') }}
                    </span>
                    
                    <!-- Tombol Next (Lompat 7 Hari Maju) -->
                    <a href="{{ route('home', ['start_date' => $nextDate]) }}#jadwal-section" class="p-xs rounded-full hover:bg-surface-container transition-colors text-secondary flex items-center justify-center">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                </div>
            </div>
            
            <div class="flex overflow-x-auto hide-scrollbar gap-sm pb-xs">
                @php $isFirstTab = true; @endphp
                
                @forelse($jadwalsGrouped as $tanggal => $slots)
                    <button onclick="showSchedule('{{ $tanggal }}')" data-target="{{ $tanggal }}" class="tab-btn flex-none min-w-[100px] px-md py-sm rounded-lg {{ $isFirstTab ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container-lowest border border-outline-variant text-secondary hover:bg-surface-container' }} font-label-md text-label-md text-center whitespace-nowrap transition-all">
                        {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('D d M') }}
                    </button>
                    @php $isFirstTab = false; @endphp
                @empty
                    <div class="flex flex-col w-full text-center py-6 bg-surface-container-low rounded border border-surface-variant">
                        <span class="material-symbols-outlined text-secondary text-4xl mb-2">event_busy</span>
                        <span class="text-secondary font-body-md text-body-md">Tidak ada jadwal lapangan pada rentang tanggal ini.</span>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Kontainer Rincian Jam Bermain -->
        <div id="schedule-wrapper">
            @php $isFirstContent = true; @endphp
            
            @foreach($jadwalsGrouped as $tanggal => $slots)
                <div id="content-{{ $tanggal }}" class="schedule-content {{ $isFirstContent ? 'flex' : 'hidden' }} flex-col bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] border border-surface-variant">
                    <div class="mb-sm border-b border-surface-variant pb-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-sm">
                        <div>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface">Jadwal Waktu - Reguler</h3>
                            <p class="font-body-md text-body-md text-secondary mt-xs">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}</p>
                        </div>
                        <div class="flex gap-sm font-label-sm text-label-sm">
                            <div class="flex items-center gap-xs">
                                <div class="w-3 h-3 rounded bg-[#e8f5e9]"></div>
                                <span class="text-secondary">Tersedia</span>
                            </div>
                            <div class="flex items-center gap-xs">
                                <div class="w-3 h-3 rounded bg-[#ffebee]"></div>
                                <span class="text-secondary">Tidak Tersedia</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-lg pt-xs">
                        @php
                            $slotsByBlok = $slots->sortBy(function($jadwal) {
                                return $jadwal->harga->jam_mulai;
                            })->groupBy(function($item) {
                                return $item->harga->blok_waktu;
                            });
                        @endphp

                        @foreach(['Pagi', 'Siang', 'Sore', 'Malam'] as $blok)
                            @if(isset($slotsByBlok[$blok]))
                                <div>
                                    <div class="flex justify-between items-center border-b border-surface-variant pb-xs mb-sm">
                                        <span class="font-label-md text-label-md text-on-surface font-bold">{{ strtoupper($blok) }}</span>
                                        <span class="font-label-md text-label-md text-on-surface font-bold">
                                            Rp {{ number_format($slotsByBlok[$blok]->first()->harga->harga, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-sm">
                                        @foreach($slotsByBlok[$blok] as $jadwal)
                                            @php
                                                $tglFormatted = \Carbon\Carbon::parse($tanggal)->format('Y-m-d');
                                                $jadwalTime = \Carbon\Carbon::parse($tglFormatted . ' ' . $jadwal->harga->jam_mulai);
                                                $isPast = $jadwalTime->isPast();
                                                $isUrgent = !$isPast && now()->diffInMinutes($jadwalTime) <= 60;
                                            @endphp

                                            @if($jadwal->status_jadwal === 'Tersedia' && $jadwal->harga->is_active && !$isPast)
                                                @if($isUrgent)
                                                    <button onclick="confirmUrgentBooking('{{ route('booking', ['date' => $tanggal, 'slot' => $jadwal->id_jadwal]) }}')" class="bg-[#e8f5e9] text-primary font-label-md text-label-md rounded-lg py-sm px-xs text-center transition-transform active:scale-95 hover:opacity-90 flex flex-col items-center justify-center">
                                                        <span>{{ \Carbon\Carbon::parse($jadwal->harga->jam_mulai)->format('H:i') }}</span>
                                                        <span class="text-[10px] font-normal uppercase tracking-wide mt-1 opacity-1 select-none">
                                                            Tersedia
                                                        </span>
                                                    </button>
                                                @else
                                                    <a href="{{ route('booking', ['date' => $tanggal, 'slot' => $jadwal->id_jadwal]) }}" class="bg-[#e8f5e9] text-primary font-label-md text-label-md rounded-lg py-sm px-xs text-center transition-transform active:scale-95 hover:opacity-90 flex flex-col items-center justify-center">
                                                        <span>{{ \Carbon\Carbon::parse($jadwal->harga->jam_mulai)->format('H:i') }}</span>
                                                        <span class="text-[10px] font-normal uppercase tracking-wide mt-1 opacity-1 select-none">
                                                            Tersedia
                                                        </span>
                                                    </a>
                                                @endif
                                            @else
                                                @php
                                                    if (!$jadwal->harga->is_active) {
                                                        $labelStatus = 'Maintenance';
                                                        $bgColor = 'bg-surface-container-high text-secondary';
                                                    } elseif ($jadwal->status_jadwal == 'Tutup') {
                                                        $labelStatus = 'Tutup';
                                                        $bgColor = 'bg-surface-container-high text-secondary';
                                                    } elseif ($isPast) {
                                                        $labelStatus = 'Waktu Lewat';
                                                        $bgColor = 'bg-surface-container-high text-secondary';
                                                    } else {
                                                        $labelStatus = 'Booked';
                                                        $bgColor = 'bg-[#ffebee] text-error';
                                                    }
                                                @endphp
                                                <button disabled class="{{ $bgColor }} font-label-md text-label-md rounded-lg py-sm px-xs text-center flex flex-col items-center justify-center cursor-not-allowed opacity-75">
                                                    <span>{{ \Carbon\Carbon::parse($jadwal->harga->jam_mulai)->format('H:i') }}</span>
                                                    <span class="text-[10px] font-normal uppercase tracking-wide mt-1">
                                                        {{ $labelStatus }}
                                                    </span>
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @php $isFirstContent = false; @endphp
            @endforeach
        </div>
        
    </section>

    <!-- Modal Urgent Booking -->
    <div id="urgentBookingModal" class="fixed inset-0 bg-[#191c1d]/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4 transition-opacity duration-300">
        <div class="bg-surface-container-lowest border border-surface-variant rounded-xl shadow-xl p-6 max-w-sm w-full relative transform scale-95 transition-transform duration-300" id="urgentBookingModal-card">
            <div class="flex items-center gap-3 mb-4 text-error">
                <span class="material-symbols-outlined text-4xl">warning</span>
                <h3 class="font-headline-sm font-bold text-on-surface">Peringatan Jadwal</h3>
            </div>
            <p class="font-body-md text-secondary mb-6 leading-relaxed">
                Jadwal akan segera dimulai, apakah anda yakin ingin memesan di jadwal ini?
            </p>
            <div class="flex justify-between gap-sm">
                <a id="btnUrgentIya" href="#" class="w-1/2 flex items-center justify-center px-6 py-3 bg-primary hover:opacity-90 text-on-primary rounded-lg font-label-md text-label-md transition-opacity shadow-sm">
                    Iya
                </a>
                <button type="button" onclick="closeUrgentModal()" class="w-1/2 flex items-center justify-center px-6 py-3 bg-surface-container hover:bg-surface-container-high text-on-surface rounded-lg font-label-md text-label-md transition-colors shadow-sm">
                    Tidak
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Script Modal Urgent Booking
    function confirmUrgentBooking(url) {
        document.getElementById('btnUrgentIya').href = url;
        const modal = document.getElementById('urgentBookingModal');
        const card = document.getElementById('urgentBookingModal-card');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => card.classList.replace('scale-95', 'scale-100'), 10);
    }

    function closeUrgentModal() {
        const modal = document.getElementById('urgentBookingModal');
        const card = document.getElementById('urgentBookingModal-card');
        card.classList.replace('scale-100', 'scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 150);
    }

    // Script Sistem Tab
    function showSchedule(tanggalTarget) {
        document.querySelectorAll('.schedule-content').forEach(el => {
            el.classList.remove('flex');
            el.classList.add('hidden');
        });

        const targetElement = document.getElementById('content-' + tanggalTarget);
        if (targetElement) {
            targetElement.classList.remove('hidden');
            targetElement.classList.add('flex');
        }

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.className = "tab-btn flex-none min-w-[100px] px-md py-sm rounded-lg bg-surface-container-lowest border border-outline-variant text-secondary hover:bg-surface-container transition-colors font-label-md text-label-md text-center whitespace-nowrap";
        });

        const activeBtn = document.querySelector(`.tab-btn[data-target="${tanggalTarget}"]`);
        if (activeBtn) {
            activeBtn.className = "tab-btn flex-none min-w-[100px] px-md py-sm rounded-lg bg-primary text-on-primary shadow-sm font-label-md text-label-md text-center whitespace-nowrap transition-all";
        }
    }

    // MENGHAPUS PARAMETER URL AGAR TERLIHAT BERSIH
    if (window.history.replaceState) {
        // Baris ini akan menghapus ?start_date=... dari address bar sesaat setelah halaman dimuat
        window.history.replaceState(null, null, window.location.pathname);
    }
</script>
@endpush