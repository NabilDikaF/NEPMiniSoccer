@extends('layouts.app')
@section('title', 'Complete Your Booking - NEP Mini Soccer')

@section('content')
<!-- MODAL ALERT CUSTOM UNTUK REGULER -->
<div id="customAlert" class="fixed inset-0 bg-[#191c1d]/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-surface-container-lowest border border-surface-variant rounded-xl shadow-xl p-6 max-w-sm w-full relative transform scale-95 transition-transform duration-300" id="customAlert-card">
        <div class="flex items-center gap-3 mb-4 text-error">
            <span class="material-symbols-outlined text-4xl">warning</span>
            <h3 class="font-headline-sm font-bold text-on-surface">Peringatan Order</h3>
        </div>
        <p id="customAlertMessage" class="font-body-md text-secondary mb-6 leading-relaxed">
            <!-- Pesan akan diinjeksi lewat JavaScript -->
        </p>
        <div class="flex justify-end">
            <button type="button" onclick="closeCustomAlert()" class="px-6 py-3 bg-primary text-on-primary rounded-lg font-label-md hover:bg-primary-container transition-colors shadow-sm">
                Mengerti
            </button>
        </div>
    </div>
</div>

@if(session()->has('reschedule_booking_id'))
    <div class="max-w-7xl mx-auto px-6 mt-6 w-full">
        <div class="bg-blue-50 border border-blue-200 text-blue-800 p-4 rounded-lg flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-blue-600">edit_calendar</span>
                <div>
                    <h4 class="font-bold">Mode Reschedule Aktif</h4>
                    <p class="text-sm">Silakan pilih tanggal dan jam baru untuk mengganti jadwal Anda.</p>
                </div>
            </div>
            
            <!-- Tombol Batal Reschedule jika pelanggan berubah pikiran -->
            <form action="{{ route('cancel.reschedule.session') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="text-sm font-bold text-red-600 hover:text-red-800 underline">
                    Batal Reschedule
                </button>
            </form>
        </div>
    </div>
@endif

@if($errors->any())
    <div class="max-w-7xl mx-auto px-6 mt-6 w-full">
        <div class="bg-error-container border border-error text-on-error-container p-4 rounded-lg flex items-center gap-3 shadow-sm">
            <span class="material-symbols-outlined">warning</span>
            <ul class="font-body-md list-disc list-inside">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="max-w-7xl mx-auto px-6 mt-6 w-full">
        <div class="bg-error-container border border-error text-on-error-container p-4 rounded-lg flex items-center gap-3 shadow-sm">
            <span class="material-symbols-outlined">error</span>
            <p class="font-body-md">{{ session('error') }}</p>
        </div>
    </div>
@endif

<div class="flex-grow max-w-container-max mx-auto w-full px-gutter py-xl flex flex-col gap-lg">
    <div>
        <h1 class="font-headline-lg text-headline-lg font-bold text-on-surface mb-xs">Selesaikan Booking Anda</h1>
        <p class="font-body-md text-body-md text-secondary">Isi detail Anda dan pilih slot waktu untuk mengamankan lapangan.</p>
    </div>

    <form action="{{ route('booking.store') }}" method="POST" id="bookingForm" class="flex flex-col lg:flex-row gap-lg items-start w-full">
        @csrf
        
        <div class="w-full lg:w-2/3 flex flex-col gap-lg">
            
            <section class="bg-surface-container-lowest rounded-lg p-md md:p-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] border border-surface-variant flex flex-col">
                <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface mb-md flex items-center gap-sm">
                    <span class="material-symbols-outlined text-primary text-[24px]">person</span>
                    Informasi Tim
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    <div class="flex flex-col space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface" for="teamName">Nama Tim <span class="text-error">*</span></label>
                        <!-- PERUBAHAN: Value dikosongkan agar pelanggan mengisi nama tim murni -->
                        <input class="w-full py-3 sm:py-sm px-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="teamName" name="nama_tim" value="{{ old('nama_tim') }}" placeholder="Masukkan Nama Tim Anda" type="text" required/>
                        @error('nama_tim')
                            <p class="text-error font-body-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            @if(session()->has('reschedule_booking_id'))
                @php
                    $oldTipe = \App\Models\Booking::find(session('reschedule_booking_id'))->tipe_booking;
                @endphp
                <section class="bg-surface-container-lowest rounded-lg p-md md:p-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] border border-surface-variant flex flex-col">
                    <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface mb-md flex items-center gap-sm">
                        <span class="material-symbols-outlined text-primary text-[24px]">sell</span>
                        Jenis Order (Mode Reschedule)
                    </h2>
                    <div class="bg-surface-container border border-surface-variant rounded-lg p-md flex items-start gap-3">
                        <span class="material-symbols-outlined text-secondary">info</span>
                        <div>
                            <p class="font-bold text-on-surface">Pesanan {{ $oldTipe }}</p>
                            <p class="font-body-sm text-secondary mt-1">Saat melakukan Reschedule, Anda harus memilih jadwal baru yang sesuai dengan tipe pesanan awal Anda.</p>
                        </div>
                    </div>
                    <!-- Radio tersembunyi agar validasi JS dan form submit tetap bekerja dengan nilai yang benar -->
                    <input type="radio" name="tipe_booking" value="{{ $oldTipe }}" checked class="hidden">
                </section>
            @else
                <section class="bg-surface-container-lowest rounded-lg p-md md:p-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] border border-surface-variant flex flex-col">
                    <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface mb-md flex items-center gap-sm">
                        <span class="material-symbols-outlined text-primary text-[24px]">sell</span>
                        Jenis Order
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                        <label class="relative cursor-pointer block">
                            <input checked class="peer sr-only" name="tipe_booking" type="radio" value="Reguler"/>
                            <div class="border rounded-lg p-md transition-all duration-200 border-surface-variant bg-surface-container-lowest hover:border-primary-container hover:shadow-[0_2px_4px_rgba(33,37,41,0.05)] peer-checked:border-2 peer-checked:border-primary peer-checked:bg-primary-container/10 peer-checked:shadow-[0_2px_8px_rgba(40,167,69,0.1)] peer-checked:[&_.icon-unchecked]:hidden peer-checked:[&_.icon-checked]:block">
                                <div class="flex justify-between items-center mb-xs">
                                    <span class="font-label-md text-label-md text-on-surface font-bold">Reguler</span>
                                    <span class="material-symbols-outlined text-secondary icon-unchecked block">radio_button_unchecked</span>
                                    <span class="material-symbols-outlined text-primary icon-checked hidden" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                </div>
                                <p class="font-body-md text-sm text-secondary">Pesan untuk 1 hari saja.</p>
                            </div>
                        </label>

                        <label class="relative cursor-pointer block">
                            <input class="peer sr-only" name="tipe_booking" type="radio" value="Member"/>
                            <div class="border rounded-lg p-md transition-all duration-200 border-surface-variant bg-surface-container-lowest hover:border-primary-container hover:shadow-[0_2px_4px_rgba(33,37,41,0.05)] peer-checked:border-2 peer-checked:border-primary peer-checked:bg-primary-container/10 peer-checked:shadow-[0_2px_8px_rgba(40,167,69,0.1)] peer-checked:[&_.icon-unchecked]:hidden peer-checked:[&_.icon-checked]:block">
                                <div class="flex justify-between items-center mb-xs">
                                    <span class="font-label-md text-label-md text-on-surface font-bold">Member</span>
                                    <span class="material-symbols-outlined text-secondary icon-unchecked block">radio_button_unchecked</span>
                                    <span class="material-symbols-outlined text-primary icon-checked hidden" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                </div>
                                <p class="font-body-md text-sm text-secondary">Pesan min. 4 hari (Diskon 15%).</p>
                            </div>
                        </label>
                    </div>
                </section>
            @endif

            <section class="bg-surface-container-lowest rounded-lg p-md md:p-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] border border-surface-variant flex flex-col">
                
                @php
                    $jadwalsGrouped = $jadwals->groupBy('tanggal');
                @endphp

                <div class="flex justify-between items-center mb-md border-b border-surface-variant pb-sm">
                    <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface flex items-center gap-sm">
                        <span class="material-symbols-outlined text-primary text-[24px]">schedule</span>
                        Pilih Jam Bermain
                    </h2>
                    
                    <div class="relative">
                        <select id="dateSelector" class="font-label-sm text-label-sm font-bold bg-surface-container-low border border-surface-variant py-xs pl-sm pr-8 rounded-lg text-secondary cursor-pointer focus:ring-primary focus:border-primary outline-none appearance-none shadow-sm hover:opacity-80 transition-opacity">
                            @foreach($jadwalsGrouped->keys() as $tgl)
                                <option value="{{ $tgl }}">
                                    {{ \Carbon\Carbon::parse($tgl)->translatedFormat('l, d M Y') }}
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-[18px] pointer-events-none text-secondary">arrow_drop_down</span>
                    </div>
                </div>

                <div id="scheduleContainersWrapper">
                    @foreach($jadwalsGrouped as $tanggal => $slots)
                        <div id="schedule-{{ $tanggal }}" class="schedule-container hidden flex-col">
                            
                            <div class="space-y-lg pt-xs pb-4">
                                @php
                                    $slotsByBlok = $slots->sortBy(function($jadwal) { return $jadwal->harga->jam_mulai; })
                                                         ->groupBy(function($item) { return $item->harga->blok_waktu; });
                                @endphp

                                @foreach(['Pagi', 'Siang', 'Sore', 'Malam'] as $blok)
                                    @if(isset($slotsByBlok[$blok]))
                                        <div>
                                            <div class="flex justify-between items-center border-b border-surface-variant pb-xs mb-sm">
                                                <h3 class="font-label-md text-label-md text-on-surface font-bold">{{ strtoupper($blok) }}</h3>
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
                                                    @endphp
                                                    
                                                    @if($jadwal->status_jadwal === 'Tersedia' && $jadwal->harga->is_active && !$isPast)
                                                        <label class="relative cursor-pointer block">
                                                            <input type="checkbox" name="id_jadwal[]" value="{{ $jadwal->id_jadwal }}" 
                                                                   data-price="{{ $jadwal->harga->harga }}" 
                                                                   data-time="{{ \Carbon\Carbon::parse($jadwal->harga->jam_mulai)->format('H:i') }}" 
                                                                   data-formatted-date="{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d M') }}"
                                                                   data-raw-date="{{ $tanggal }}"
                                                                   class="peer sr-only slot-checkbox"/>
                                                            <div class="bg-surface-container-lowest text-on-surface border border-surface-variant font-label-md text-label-md rounded-lg py-sm px-xs text-center transition-all hover:border-primary hover:text-primary peer-checked:border-2 peer-checked:border-primary peer-checked:bg-primary-container/20 peer-checked:text-primary peer-checked:font-bold peer-checked:shadow-[0_2px_8px_rgba(40,167,69,0.15)] flex flex-col items-center justify-center">
                                                                <span>{{ \Carbon\Carbon::parse($jadwal->harga->jam_mulai)->format('H:i') }}</span>
                                                                <span class="text-[10px] font-normal uppercase tracking-wide mt-1 opacity-1 select-none">
                                                                    Tersedia
                                                                </span>
                                                            </div>
                                                        </label>
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
                                                        <button disabled type="button" class="{{ $bgColor }} font-label-md text-label-md rounded-lg py-sm px-xs text-center flex flex-col items-center justify-center cursor-not-allowed opacity-75">
                                                            <span>{{ \Carbon\Carbon::parse($jadwal->harga->jam_mulai)->format('H:i') }}</span>
                                                            <span class="text-[10px] font-normal uppercase tracking-wide mt-1">{{ $labelStatus }}</span>
                                                        </button>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        <div class="w-full lg:w-1/3 sticky top-24 flex flex-col">
            <div class="bg-surface-container-lowest rounded-lg p-md md:p-lg shadow-[0_4px_12px_rgba(33,37,41,0.06)] border border-surface-variant flex flex-col">
                <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface mb-md">Rincian Pesanan</h2>
                
                <div class="hidden md:block">
                    <div id="validationWarning" class="text-on-surface text-sm font-bold mb-4 bg-[#e8f5e9] p-3 rounded-lg border border-[#c8e6c9] hidden">
                    </div>

                    @if($errors->has('id_jadwal'))
                        <div class="text-on-surface text-sm font-bold mb-4 bg-[#e8f5e9] p-3 rounded-lg border border-[#c8e6c9]">
                            {{ $errors->first('id_jadwal') }}
                        </div>
                    @endif
                </div>

                <div class="flex flex-col gap-sm mb-md">
                    <div class="flex flex-col border-b border-surface-variant pb-xs">
                        <span class="font-label-sm text-label-sm text-secondary">Slot Waktu Terpilih</span>
                        <span id="summaryTime" class="font-label-md text-label-md text-on-surface font-bold text-primary leading-relaxed">Belum ada yang dipilih</span>
                    </div>
                    <div class="flex flex-col border-b border-surface-variant pb-xs">
                        <span class="font-label-sm text-label-sm text-secondary">Jenis Order</span>
                        <span id="summaryOrderType" class="font-label-md text-label-md text-on-surface font-bold">Reguler</span>
                    </div>
                </div>
                
                <div class="flex flex-col gap-xs mb-md">
                    <div class="flex justify-between items-center">
                        <span class="font-body-md text-sm text-secondary">Subtotal</span>
                        <span id="txtSubtotal" class="font-body-md text-body-md text-on-surface font-medium">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-body-md text-sm text-secondary">Biaya Admin (Pajak)</span>
                        <span id="txtTax" class="font-body-md text-body-md text-on-surface font-medium">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-body-md text-sm text-secondary">Diskon Member</span>
                        <span id="txtDiscount" class="font-body-md text-body-md text-primary font-medium">Rp 0</span>
                    </div>
                </div>
                
                <div class="border-t border-surface-variant pt-sm mb-lg flex justify-between items-center">
                    <span class="font-headline-sm text-headline-sm text-on-surface font-bold">Total</span>
                    <span id="txtTotal" class="font-headline-sm text-headline-sm text-primary font-bold">Rp 0</span>
                </div>
                
                <button type="submit" id="btnSubmit" class="w-full bg-primary-container text-on-primary hover:bg-primary transition-colors duration-200 py-3 sm:py-sm px-md rounded-lg font-label-md text-label-md shadow-[0_2px_4px_rgba(40,167,69,0.2)] hover:shadow-[0_4px_8px_rgba(40,167,69,0.3)] flex justify-center items-center gap-xs disabled:opacity-50 disabled:cursor-not-allowed">
                    Proses Pembayaran
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </button>
                
                <p class="font-label-sm text-label-sm text-center text-secondary mt-sm flex items-center justify-center gap-xs">
                    <span class="material-symbols-outlined text-[16px]">lock</span>
                    Transaksi dijamin aman
                </p>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Fungsi Menampilkan/Menyembunyikan Custom Modal Alert
    function showCustomAlert(message) {
        const alertBox = document.getElementById('customAlert');
        const alertMsg = document.getElementById('customAlertMessage');
        alertMsg.innerHTML = message;
        alertBox.classList.remove('hidden');
        alertBox.classList.add('flex');
        setTimeout(() => document.getElementById('customAlert-card').classList.replace('scale-95', 'scale-100'), 10);
    }

    function closeCustomAlert() {
        document.getElementById('customAlert-card').classList.replace('scale-100', 'scale-95');
        setTimeout(() => {
            document.getElementById('customAlert').classList.remove('flex');
            document.getElementById('customAlert').classList.add('hidden');
        }, 150);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const orderTypeRadios = document.querySelectorAll('input[name="tipe_booking"]');
        const slotCheckboxes = document.querySelectorAll('.slot-checkbox');
        const dateSelector = document.getElementById('dateSelector');
        const scheduleContainers = document.querySelectorAll('.schedule-container');
        
        const summaryOrderType = document.getElementById('summaryOrderType');
        const summaryTime = document.getElementById('summaryTime');
        const txtSubtotal = document.getElementById('txtSubtotal');
        const txtTax = document.getElementById('txtTax');
        const txtDiscount = document.getElementById('txtDiscount');
        const txtTotal = document.getElementById('txtTotal');
        const btnSubmit = document.getElementById('btnSubmit');
        const validationWarning = document.getElementById('validationWarning');

        // Fungsi Format Rupiah
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
        }

        // ==========================================
        // 1. LOGIKA DROPDOWN TANGGAL
        // ==========================================
        function switchDateView(dateVal) {
            scheduleContainers.forEach(container => {
                if(container.id === 'schedule-' + dateVal) {
                    container.classList.remove('hidden');
                    container.classList.add('flex');
                } else {
                    container.classList.add('hidden');
                    container.classList.remove('flex');
                }
            });
        }

        if (dateSelector) {
            dateSelector.addEventListener('change', function() {
                switchDateView(this.value);
            });
            
            // BACA URL PARAMETER (Integrasi dari halaman Home)
            const urlParams = new URLSearchParams(window.location.search);
            const dateParam = urlParams.get('date');
            const slotParam = urlParams.get('slot'); // 1. Tangkap parameter slot dari URL
            
            if (dateParam && document.querySelector(`#dateSelector option[value="${dateParam}"]`)) {
                dateSelector.value = dateParam;
                switchDateView(dateParam);
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.pathname);
                }
            } else if(dateSelector.options.length > 0) {
                switchDateView(dateSelector.options[0].value);
            }

            // 2. LOGIKA OTOMATIS CENTANG JAM BERMAIN
            if (slotParam) {
                // Cari checkbox yang value-nya sama dengan ID Jadwal di URL
                const targetCheckbox = document.querySelector(`.slot-checkbox[value="${slotParam}"]`);
                // Jika ketemu dan belum dibooking orang lain (tidak disabled), centang otomatis!
                if (targetCheckbox && !targetCheckbox.disabled) {
                    targetCheckbox.checked = true;
                }
            }
        }

        // ==========================================
        // 2. LOGIKA VALIDASI & KALKULATOR
        // ==========================================
        function calculateTotal() {
            let subtotal = 0;
            let selectedTimes = [];
            let selectedDates = new Set();
            let checkedRadio = document.querySelector('input[name="tipe_booking"]:checked');
            let isMember = checkedRadio ? checkedRadio.value === 'Member' : false;

            slotCheckboxes.forEach(cb => {
                if (cb.checked) {
                    subtotal += parseInt(cb.getAttribute('data-price'));
                    selectedTimes.push(cb.getAttribute('data-formatted-date') + ' - ' + cb.getAttribute('data-time'));
                    selectedDates.add(cb.getAttribute('data-raw-date'));
                }
            });

            if (selectedTimes.length > 0) {
                summaryTime.innerHTML = selectedTimes.join('<br>');
            } else {
                summaryTime.innerHTML = "Belum ada yang dipilih";
            }

            let discount = isMember ? (subtotal * 0.15) : 0; 
            let tax = selectedTimes.length > 0 ? 5000 : 0; 
            let grandTotal = subtotal - discount + tax;

            txtSubtotal.innerText = formatRupiah(subtotal);
            txtDiscount.innerText = isMember ? "- " + formatRupiah(discount) : "Rp 0";
            txtTax.innerText = formatRupiah(tax);
            txtTotal.innerText = formatRupiah(grandTotal);

            btnSubmit.disabled = true;
            validationWarning.classList.add('hidden');

            if (selectedTimes.length === 0) {
                validationWarning.innerText = "Silakan pilih minimal 1 jam bermain.";
                validationWarning.classList.remove('hidden');
            } else {
                if (isMember) {
                    if (selectedDates.size < 4) {
                        validationWarning.innerHTML = `⚠️ Member wajib memilih jadwal di minimal 4 hari yang berbeda. (Baru terpilih ${selectedDates.size} hari)`;
                        validationWarning.classList.remove('hidden');
                    } else {
                        btnSubmit.disabled = false;
                    }
                } else {
                    if (selectedDates.size > 1) {
                         validationWarning.innerHTML = "⚠️ Reguler hanya dapat memilih jadwal pada 1 hari yang sama.";
                         validationWarning.classList.remove('hidden');
                    } else {
                         btnSubmit.disabled = false; 
                    }
                }
            }
        }

        // PERUBAHAN JS: Custom Modal Alert menggantikan window.alert()
        slotCheckboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                let isMember = document.querySelector('input[name="tipe_booking"]:checked').value === 'Member';
                
                if (!isMember && this.checked) {
                    let clickedDate = this.getAttribute('data-raw-date');
                    let hasDifferentDate = false;
                    
                    slotCheckboxes.forEach(otherCb => {
                        if (otherCb.checked && otherCb !== this && otherCb.getAttribute('data-raw-date') !== clickedDate) {
                            hasDifferentDate = true;
                        }
                    });

                    if (hasDifferentDate) {
                        showCustomAlert('Untuk pesanan <b>Reguler</b>, Anda hanya bisa memilih jam pada tanggal yang sama.<br><br>Silakan ubah Jenis Order menjadi <b>Member</b> jika ingin mem-booking jadwal untuk beberapa hari sekaligus.');
                        this.checked = false; 
                    }
                }
                calculateTotal();
            });
        });

        // PERUBAHAN JS: Custom Modal Alert saat switch dari Member ke Reguler
        orderTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                summaryOrderType.textContent = this.value;
                let isMember = this.value === 'Member';

                if (!isMember) {
                    let selectedDates = new Set();
                    slotCheckboxes.forEach(cb => {
                        if(cb.checked) selectedDates.add(cb.getAttribute('data-raw-date'));
                    });
                    
                    if (selectedDates.size > 1) {
                        showCustomAlert('Pilihan jam Anda telah direset.<br><br>Karena order <b>Reguler</b> hanya mengizinkan booking untuk maksimal 1 hari saja.');
                        slotCheckboxes.forEach(cb => cb.checked = false);
                    }
                }
                
                calculateTotal();
            });
        });

        calculateTotal();
    });
</script>
@endpush