@extends('layouts.admin')
@section('title', 'Verifikasi Pembayaran - NEP Admin')

@section('content')
<header class="mb-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-sm sm:gap-0">
<div>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Verifikasi Pembayaran</h2>
<p class="font-body-md text-body-md text-secondary mt-xs">Meninjau dan menyetujui bukti transfer bank yang masuk.</p>
</div>
</header>

<div class="grid grid-cols-1 md:grid-cols-3 gap-md mb-lg">
<div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-variant flex items-center justify-between">
<div>
<p class="font-label-sm text-label-sm text-secondary mb-xs">Menunggu Untuk Ditinjau</p>
<p class="font-headline-md text-headline-md text-on-surface font-bold">{{ $pendingCount }}</p>
</div>
<div class="w-12 h-12 rounded-full bg-tertiary-container flex items-center justify-center text-on-tertiary-container">
<span class="material-symbols-outlined">pending_actions</span>
</div>
</div>
<div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-variant flex items-center justify-between">
<div>
<p class="font-label-sm text-label-sm text-secondary mb-xs">Disetujui Hari Ini</p>
<p class="font-headline-md text-headline-md text-on-surface font-bold">{{ $approvedTodayCount }}</p>
</div>
<div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container">
<span class="material-symbols-outlined">check_circle</span>
</div>
</div>
<div class="bg-surface-container-lowest p-md rounded-lg shadow-sm border border-surface-variant flex items-center justify-between">
<div>
<p class="font-label-sm text-label-sm text-secondary mb-xs">Ditolak</p>
<p class="font-headline-md text-headline-md text-on-surface font-bold">{{ $rejectedCount }}</p>
</div>
<div class="w-12 h-12 rounded-full bg-error-container flex items-center justify-center text-on-error-container">
<span class="material-symbols-outlined">cancel</span>
</div>
</div>
</div>

<!-- Search & Filter Form -->
<form method="GET" action="{{ route('admin.verifikasi') }}" class="mb-lg bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-surface-variant flex flex-col lg:flex-row gap-4 items-center justify-between">
    <div class="flex-1 w-full relative">
        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary">search</span>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama Pelanggan..." class="w-full pl-10 pr-4 py-2 border border-surface-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors">
    </div>
    
    <div class="flex flex-col sm:flex-row gap-4 w-full lg:w-auto">
        <select name="tipe_pembayaran" class="w-full sm:w-auto pl-4 pr-10 py-2 border border-surface-variant rounded-lg font-body-md text-body-md bg-surface-container-lowest focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors cursor-pointer text-on-surface">
            <option value="Semua" {{ request('tipe_pembayaran', 'Semua') === 'Semua' ? 'selected' : '' }}>Semua</option>
            <option value="Pertama" {{ request('tipe_pembayaran') === 'Pertama' ? 'selected' : '' }}>Bayar Pertama</option>
            <option value="Pelunasan" {{ request('tipe_pembayaran') === 'Pelunasan' ? 'selected' : '' }}>Pelunasan</option>
        </select>
        
        <button type="submit" class="bg-primary hover:bg-primary-container text-on-primary px-6 py-2 rounded-lg font-label-md text-label-md transition-colors whitespace-nowrap shadow-sm flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-[18px]">search</span>
            Cari & Filter
        </button>
    </div>
</form>

<div class="bg-surface-container-lowest rounded-xl shadow-sm border border-surface-variant overflow-hidden">
<div class="overflow-x-auto w-full">
<table class="w-full text-left border-collapse min-w-[800px] md:min-w-full">
<thead>
<tr class="bg-surface-container-low border-b border-surface-variant">
<th class="font-label-md text-label-md text-secondary py-sm px-md whitespace-nowrap text-center">Nama Pelanggan</th>
<th class="font-label-md text-label-md text-secondary py-sm px-md whitespace-nowrap text-center">Tanggal</th>
<th class="font-label-md text-label-md text-secondary py-sm px-md whitespace-nowrap text-center">Data Booking</th>
<th class="font-label-md text-label-md text-secondary py-sm px-md whitespace-nowrap text-center">Tipe Pembayaran</th>
<th class="font-label-md text-label-md text-secondary py-sm px-md whitespace-nowrap text-center">Jumlah</th>
<th class="font-label-md text-label-md text-secondary py-sm px-md whitespace-nowrap text-center">Bukti Transfer</th>
<th class="font-label-md text-label-md text-secondary py-sm px-md whitespace-nowrap w-[1%] text-center">Aksi</th>
</tr>
</thead>
<tbody class="font-body-md text-body-md">

@forelse($pembayarans as $pembayaran)
@php
    $bookingIdentifier = $pembayaran->booking->tipe_booking ? ($pembayaran->booking->tipe_booking . ' (#'.$pembayaran->id_booking.')') : 'Booking #'.$pembayaran->id_booking;
@endphp
<tr class="border-b border-surface-variant hover:bg-surface-bright transition-colors">
<td class="py-md px-md font-medium text-on-surface whitespace-nowrap text-center">
    {{ $pembayaran->booking->user->name ?? 'Tidak Diketahui' }}
</td>
<td class="py-md px-md text-on-surface whitespace-nowrap text-center">
    {{ \Carbon\Carbon::parse($pembayaran->created_at)->translatedFormat('d M Y, H:i') }}
</td>
<td class="py-md px-md font-medium text-on-surface whitespace-nowrap text-center">
    {{ $pembayaran->booking->tipe_booking ?? 'Booking #'.$pembayaran->id_booking }}
</td>
<td class="py-md px-md text-secondary whitespace-nowrap text-center">
    {{ $pembayaran->jenis_pembayaran }}
</td>
<td class="py-md px-md font-medium text-on-surface whitespace-nowrap text-center">
    Rp {{ number_format($pembayaran->nominal_dibayar, 0, ',', '.') }}
</td>
<td class="py-md px-md whitespace-nowrap">
    <a href="{{ asset('storage/' . $pembayaran->bukti_transfer) }}" target="_blank" class="flex items-center justify-center space-x-xs text-primary hover:text-primary-container transition-colors font-label-md text-label-md">
        <span class="material-symbols-outlined text-[18px]">image</span>
        <span class="">Lihat Foto</span>
    </a>
</td>
<td class="py-md px-md whitespace-nowrap w-[1%]">
    <div class="flex justify-center space-x-xs items-center">
        <button type="button" onclick="triggerConfirmModal('{{ $pembayaran->id_pembayaran }}', 'Valid', '{{ $bookingIdentifier }}')" class="bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md py-xs px-sm rounded shadow-sm transition-all flex items-center">
            <span class="material-symbols-outlined text-[18px] mr-xs">check</span> Verifikasi
        </button>

        <button type="button" onclick="triggerConfirmModal('{{ $pembayaran->id_pembayaran }}', 'Ditolak', '{{ $bookingIdentifier }}')" class="bg-surface-container hover:bg-error hover:text-on-error text-error font-label-md text-label-md py-xs px-sm rounded shadow-sm border border-surface-variant hover:border-error transition-all flex items-center">
            <span class="material-symbols-outlined text-[18px] mr-xs">close</span> Tolak
        </button>
    </div>
</td>
</tr>
@empty
<tr>
    <td colspan="7" class="py-lg px-md text-center text-secondary font-label-md text-label-md">
        Belum ada pembayaran yang perlu diverifikasi.
    </td>
</tr>
@endforelse

</tbody>
</table>
</div>
<div class="bg-surface-container-lowest border-t border-surface-variant px-md py-sm">
    {{ $pembayarans->links() }}
</div>
</div>

<!-- Modal Konfirmasi -->
<div id="custom-confirm-modal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-xs z-50 hidden items-center justify-center p-4 transition-all duration-300">
    <div class="bg-white dark:bg-zinc-900 rounded-xl max-w-md w-full p-6 shadow-xl border border-gray-100 dark:border-zinc-800 transform scale-95 transition-transform duration-300 flex flex-col" id="modal-card">
        
        <div class="flex items-center gap-4 mb-4">
            <div id="modal-icon-container" class="w-12 h-12 rounded-full flex items-center justify-center">
                <span id="modal-icon" class="material-symbols-outlined text-2xl">help</span>
            </div>
            <div>
                <h3 id="modal-title" class="text-lg font-bold text-gray-900 dark:text-white">Konfirmasi Aksi</h3>
                <p id="modal-subtitle" class="text-xs text-secondary">Aksi ini akan memperbarui status booking pelanggan</p>
            </div>
        </div>

        <div class="mb-6">
            <p id="modal-description" class="text-sm text-gray-600 dark:text-zinc-400 leading-relaxed">
                Apakah Anda yakin ingin memproses data pembayaran ini?
            </p>
        </div>

        <form id="modal-action-form" method="POST" class="m-0 p-0 flex flex-col sm:flex-row justify-end gap-sm flex-wrap">
            @csrf
            <input type="hidden" name="status_pembayaran" id="modal-status-input" value="">

            <div id="rejection-note-container" class="w-full mb-4 hidden">
                <label for="modal-catatan-admin" class="block font-label-md text-label-md text-on-surface mb-xs">Catatan Penolakan (Opsional)</label>
                <textarea id="modal-catatan-admin" name="catatan_admin" rows="3" class="w-full px-sm py-xs border border-outline-variant rounded-DEFAULT focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md bg-surface-bright" placeholder="Berikan alasan mengapa pembayaran ditolak..."></textarea>
            </div>
            
            <button type="submit" id="modal-submit-btn" class="w-full sm:w-auto text-white font-bold py-2 px-5 rounded-lg text-sm transition-all shadow-xs flex items-center justify-center gap-1">
                <span class="material-symbols-outlined text-[18px]">done</span>
                <span id="modal-btn-text">Ya, Lanjutkan</span>
            </button>
            <button type="button" onclick="closeConfirmModal()" class="w-full sm:w-auto bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg text-sm transition-colors text-center">
                Batal
            </button>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function triggerConfirmModal(idPembayaran, actionType, bookingInfo) {
        const modalContainer = document.getElementById('custom-confirm-modal');
        const modalCard = document.getElementById('modal-card');
        const actionForm = document.getElementById('modal-action-form');
        const statusInput = document.getElementById('modal-status-input');
        
        const titleText = document.getElementById('modal-title');
        const descText = document.getElementById('modal-description');
        const btnText = document.getElementById('modal-btn-text');
        const submitBtn = document.getElementById('modal-submit-btn');
        const iconContainer = document.getElementById('modal-icon-container');
        const icon = document.getElementById('modal-icon');

        // 1. Set URL Action Form Dinamis sesuai ID Pembayaran
        actionForm.action = `/admin/verifikasi/${idPembayaran}/verify`;
        
        // 2. Pasang value status ('Valid' / 'Ditolak') untuk dikirim ke Controller
        statusInput.value = actionType;

        // 3. Cabang Desain & Text antara Setuju (Valid) vs Tolak (Ditolak)
        if (actionType === 'Valid') {
            titleText.innerText = "Verifikasi Pembayaran";
            descText.innerHTML = `Apakah Anda yakin ingin <strong>MENYETUJUI</strong> bukti transfer untuk <strong>${bookingInfo}</strong>? Data akan ditandai sah dan status jadwal akan langsung terkunci.`;
            btnText.innerText = "Ya, Verifikasi";
            
            // Sembunyikan Textarea catatan
            document.getElementById('rejection-note-container').classList.add('hidden');
            
            // Set skema warna Hijau (Success)
            submitBtn.className = "w-full sm:w-auto bg-primary hover:bg-green-700 text-white font-bold py-2 px-5 rounded-lg text-sm transition-all shadow-xs flex items-center justify-center gap-1";
            iconContainer.className = "w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-700";
            icon.innerText = "check_circle";
        } else {
            titleText.innerText = "Tolak Pembayaran";
            descText.innerHTML = `Apakah Anda yakin ingin <strong>MENOLAK</strong> bukti transfer untuk <strong>${bookingInfo}</strong>? Status pesanan pelanggan akan dikembalikan agar mereka bisa mengunggah ulang foto yang benar.`;
            btnText.innerText = "Ya, Tolak";
            
            // Set skema warna Merah (Danger)
            submitBtn.className = "w-full sm:w-auto bg-error hover:bg-red-700 text-white font-bold py-2 px-5 rounded-lg text-sm transition-all shadow-xs flex items-center justify-center gap-1";
            iconContainer.className = "w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-700";
            icon.innerText = "cancel";
            
            // Tampilkan Textarea catatan
            document.getElementById('rejection-note-container').classList.remove('hidden');
        }

        // 4. Munculkan Modal dengan animasi transisi yang halus
        modalContainer.classList.remove('hidden');
        modalContainer.classList.add('flex');
        setTimeout(() => {
            modalCard.classList.remove('scale-95');
            modalCard.classList.add('scale-100');
        }, 10);
    }

    function closeConfirmModal() {
        const modalContainer = document.getElementById('custom-confirm-modal');
        const modalCard = document.getElementById('modal-card');
        
        modalCard.classList.remove('scale-100');
        modalCard.classList.add('scale-95');
        
        setTimeout(() => {
            modalContainer.classList.remove('flex');
            modalContainer.classList.add('hidden');
        }, 150);
    }

    // Menutup modal otomatis jika admin mengklik area luar kartu modal (backdrop)
    document.getElementById('custom-confirm-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeConfirmModal();
        }
    });

    // Sembunyikan parameter URL dari address bar agar terlihat rapi (seperti menggunakan POST)
    if (window.history && window.history.replaceState) {
        window.history.replaceState(null, null, window.location.pathname);
    }
</script>
@endpush