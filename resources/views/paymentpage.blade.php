@extends('layouts.app')
@section('title', 'Selesaikan Pembayaran - NEP Mini Soccer')

@section('content')
<div class="w-full max-w-container-max mx-auto px-4 md:px-gutter py-6 md:py-lg flex flex-col items-center">
    <div class="w-full max-w-2xl">
        <h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg mb-2 md:mb-xs">Selesaikan Pembayaran</h1>
        <p class="font-body-md text-body-md text-secondary mb-6 md:mb-lg">Silahkan tinjau detail pemesanan Anda dan unggah bukti pembayaran.</p>

        @if($errors->any())
            <div class="bg-error/10 text-error p-4 rounded-lg text-sm font-medium mb-4 border border-error/20">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-error/10 text-error p-4 rounded-lg text-sm font-medium mb-4 border border-error/20">
                <div class="font-bold flex items-center gap-1 mb-1">
                    <span class="material-symbols-outlined text-[18px]">error</span>
                    Pemberitahuan:
                </div>
                Terjadi kendala saat memproses permintaan Anda. Silakan coba beberapa saat lagi atau hubungi Admin.
            </div>
        @endif

        <form action="{{ route('payment.store', $booking->id_booking) }}" method="POST" enctype="multipart/form-data" class="bg-surface-container-lowest rounded-lg shadow-sm border border-surface-variant overflow-hidden mb-8 md:mb-lg">
            @csrf

            <input type="hidden" name="nominal_dibayar" id="nominal_dibayar" value="{{ $booking->status_booking != 'Half Paid' ? ($booking->total_tagihan / 2) : ($booking->total_tagihan / 2) }}">

            <div class="bg-surface-container-low px-4 md:px-md py-sm border-b border-surface-variant flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 sm:gap-0">
                <span class="font-label-md text-label-md text-secondary uppercase tracking-wider">Invoice #INV-{{ $booking->id_booking }}</span>
                <span class="bg-surface-variant text-on-surface-variant font-label-sm text-label-sm px-2 py-1 rounded-full">{{ $booking->status_booking }}</span>
            </div>

            <div class="p-4 md:p-md space-y-6 md:space-y-md">
                <div class="flex flex-col sm:flex-row justify-between items-start gap-4 sm:gap-0">
                    
                    @php
                        $firstDetail = $booking->detailBookings->first();
                        $lastDetail = $booking->detailBookings->last();
                    @endphp

                    <div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface">Main Field ({{ $booking->tipe_booking }})</h3>
                        <p class="font-body-md text-body-md text-secondary">{{ \Carbon\Carbon::parse($firstDetail->jadwal->tanggal)->translatedFormat('l, d F Y') }}</p>
                        <p class="font-body-md text-body-md text-secondary">{{ \Carbon\Carbon::parse($firstDetail->jadwal->harga->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($lastDetail->jadwal->harga->jam_selesai)->format('H:i') }} ({{ $booking->detailBookings->count() }} Jam)</p>
                    </div>
                    <div class="text-left sm:text-right">
                        <span class="font-headline-md text-headline-md text-primary">Rp {{ number_format($booking->total_tagihan, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="border-t border-surface-variant pt-6 md:pt-md">
                    <h4 class="font-label-md text-label-md text-on-surface mb-sm">Metode Pembayaran</h4>
                    <div class="space-y-sm">
                        
                        @if($booking->status_booking != 'Half Paid')
                        <label class="flex items-center p-4 md:p-sm min-h-[48px] border border-surface-variant rounded-DEFAULT cursor-pointer hover:bg-surface-container-low transition-colors">
                            <input class="text-primary focus:ring-primary h-4 w-4 border-outline" name="payment_type" type="radio" value="dp" onchange="document.getElementById('nominal_dibayar').value = '{{ $booking->total_tagihan / 2 }}'"/>
                            <div class="ml-3 flex-grow flex justify-between">
                                <span class="font-body-md text-body-md">DP (50%)</span>
                                <span class="font-label-md text-label-md">Rp {{ number_format($booking->total_tagihan / 2, 0, ',', '.') }}</span>
                            </div>
                        </label>
                        @endif

                        <label class="flex items-center p-4 md:p-sm min-h-[48px] border border-surface-variant rounded-DEFAULT cursor-pointer hover:bg-surface-container-low transition-colors">
                            <input {{ $booking->status_booking == 'Half Paid' ? 'checked' : '' }} class="text-primary focus:ring-primary h-4 w-4 border-outline" name="payment_type" type="radio" value="full" onchange="document.getElementById('nominal_dibayar').value = '{{ $booking->status_booking == 'Half Paid' ? $booking->total_tagihan / 2 : $booking->total_tagihan }}'"/>
                            <div class="ml-3 flex-grow flex justify-between">
                                <span class="font-body-md text-body-md">{{ $booking->status_booking == 'Half Paid' ? 'Pelunasan (Sisa 50%)' : 'Bayar Lunas (100%)' }}</span>
                                <span class="font-label-md text-label-md">Rp {{ number_format($booking->status_booking == 'Half Paid' ? $booking->total_tagihan / 2 : $booking->total_tagihan, 0, ',', '.') }}</span>
                            </div>
                        </label>
                    </div>
                    <p class="font-label-sm text-label-sm text-secondary mt-xs flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">info</span>
                        Jika membayar DP, sisa tagihan harus dibayar sebelum pertandingan.
                    </p>
                </div>

                <div class="border-t border-surface-variant pt-6 md:pt-md">
                    <h4 class="font-label-md text-label-md text-on-surface mb-sm">Transfer Kesini</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-sm">
                        <div class="bg-surface p-4 md:p-sm rounded-DEFAULT border border-surface-variant flex flex-col min-h-[100px]">
                            <span class="font-label-md text-label-md text-secondary">BCA</span>
                            <span class="font-headline-sm text-headline-sm tracking-widest mt-1">123 456 7890</span>
                            <span class="font-label-sm text-label-sm text-secondary mt-auto pt-2">a.n NEP Mini Soccer</span>
                        </div>
                        <div class="bg-surface p-4 md:p-sm rounded-DEFAULT border border-surface-variant flex flex-col min-h-[100px]">
                            <span class="font-label-md text-label-md text-secondary">Mandiri</span>
                            <span class="font-headline-sm text-headline-sm tracking-widest mt-1">098 765 4321</span>
                            <span class="font-label-sm text-label-sm text-secondary mt-auto pt-2">a.n NEP Mini Soccer</span>
                        </div>
                    </div>
                </div>

                <div class="border-t border-surface-variant pt-6 md:pt-md">
                    <h4 class="font-label-md text-label-md text-on-surface mb-sm">Upload Bukti Transfer</h4>
                    <div class="flex flex-col items-center justify-center w-full relative">
                        <!-- Initial Dropzone (Label) -->
                        <label id="upload-label" class="flex flex-col items-center justify-center w-full min-h-[160px] md:min-h-[200px] border-2 border-outline-variant border-dashed rounded-lg cursor-pointer bg-surface hover:bg-surface-container-low transition-colors p-4" for="dropzone-file">
                            <div class="flex flex-col items-center justify-center text-center">
                                <span class="material-symbols-outlined text-secondary mb-2 text-3xl md:text-4xl">cloud_upload</span>
                                <p class="mb-2 font-label-md text-label-md text-secondary">Klik untuk Upload</p>
                                <p class="font-label-sm text-label-sm text-secondary">JPG, PNG only (MAX. 5MB)</p>
                            </div>
                        </label>
                        <input class="hidden" id="dropzone-file" name="bukti_pembayaran" type="file" accept=".jpg,.jpeg,.png" required onchange="previewImage(this)"/>
                        
                        <!-- Preview Dropzone (Div, replaces label when file selected) -->
                        <div id="preview-container" class="hidden flex-col items-center justify-center w-full min-h-[160px] md:min-h-[200px] border-2 border-primary border-dashed rounded-lg cursor-pointer bg-surface hover:bg-surface-container-low transition-colors p-2 relative overflow-hidden group" onclick="openActionModal()">
                            <img id="image-preview" src="#" alt="Pratinjau Bukti Pembayaran" class="w-full h-full object-contain max-h-[200px] rounded">
                            <div class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                                <span class="material-symbols-outlined text-white text-3xl mb-1">ads_click</span>
                                <span class="text-white font-label-sm text-label-sm font-medium">Klik untuk Opsi Foto</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-surface-container-low p-4 md:p-md border-t border-surface-variant">
                <button type="submit" class="w-full bg-primary text-on-primary font-label-md text-label-md py-3.5 px-4 rounded-DEFAULT hover:bg-primary-container shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined" data-icon="check_circle">check_circle</span>
                    Kirim Bukti Pembayaran
                </button>
            </div>
        </form>

        <div class="text-center pb-8 md:pb-0">
            <a href="{{ route('mybooking') }}" class="text-secondary hover:text-on-surface font-label-md text-label-md transition-colors flex items-center justify-center gap-2 mx-auto py-2">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Batalkan dan Kembali
            </a>
        </div>
    </div>
</div>

<!-- Action Modal untuk Foto -->
<div id="action-modal" class="fixed inset-0 bg-gray-900/60 z-50 hidden items-center justify-center p-4 backdrop-blur-sm transition-opacity duration-300">
    <div class="bg-surface-container-lowest rounded-xl max-w-sm w-full p-6 shadow-xl border border-surface-variant transform scale-95 transition-transform duration-300" id="action-modal-card">
        <div class="flex justify-center mb-4">
            <div class="w-12 h-12 bg-primary-container text-on-primary-container rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">photo_library</span>
            </div>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-on-surface mb-2 text-center">Opsi Foto</h3>
        <p class="font-body-md text-body-md text-secondary text-center mb-6">Apa yang ingin Anda lakukan dengan foto ini?</p>
        
        <div class="flex flex-col gap-3">
            <button type="button" onclick="triggerReupload()" class="w-full py-3 bg-primary hover:bg-primary-container text-on-primary rounded-lg font-label-md text-label-md transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">upload_file</span> Unggah Ulang
            </button>
            <button type="button" onclick="viewPhotoFullscreen()" class="w-full py-3 bg-surface border border-surface-variant hover:bg-surface-container-low rounded-lg font-label-md text-label-md text-on-surface transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">zoom_in</span> Lihat Foto
            </button>
            <button type="button" onclick="closeActionModal()" class="w-full py-3 mt-2 bg-transparent text-secondary hover:text-on-surface rounded-lg font-label-md text-label-md transition-colors">
                Batal
            </button>
        </div>
    </div>
</div>

<!-- Fullscreen Photo Modal -->
<div id="photo-modal" class="fixed inset-0 bg-black/95 z-[60] hidden items-center justify-center p-4 transition-opacity duration-300" onclick="closePhotoFullscreen()">
    <button type="button" onclick="closePhotoFullscreen(); event.stopPropagation();" class="absolute top-4 right-4 md:top-6 md:right-6 text-white hover:text-white w-12 h-12 bg-white/10 hover:bg-white/20 border border-white/20 rounded-full flex items-center justify-center transition-colors z-10 cursor-pointer">
        <span class="material-symbols-outlined text-3xl leading-none">close</span>
    </button>
    <img id="fullscreen-image" src="#" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl transform scale-95 transition-transform duration-300" onclick="event.stopPropagation()">
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const uploadLabel = document.getElementById('upload-label');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('image-preview');
        const fullscreenImage = document.getElementById('fullscreen-image');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                fullscreenImage.src = e.target.result;
                
                // Sembunyikan label upload default, tampilkan container pratinjau
                uploadLabel.classList.add('hidden');
                uploadLabel.classList.remove('flex');
                
                previewContainer.classList.remove('hidden');
                previewContainer.classList.add('flex');
            }
            
            reader.readAsDataURL(file);
        } else {
            // Jika dibatalkan/kosong, kembalikan ke awal
            uploadLabel.classList.remove('hidden');
            uploadLabel.classList.add('flex');
            
            previewContainer.classList.add('hidden');
            previewContainer.classList.remove('flex');
            previewImage.src = '#';
            fullscreenImage.src = '#';
        }
    }

    function openActionModal() {
        const modal = document.getElementById('action-modal');
        const card = document.getElementById('action-modal-card');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            card.classList.replace('scale-95', 'scale-100');
        }, 10);
    }

    function closeActionModal() {
        const modal = document.getElementById('action-modal');
        const card = document.getElementById('action-modal-card');
        card.classList.replace('scale-100', 'scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 300);
    }

    function triggerReupload() {
        closeActionModal();
        setTimeout(() => {
            document.getElementById('dropzone-file').click();
        }, 300);
    }

    function viewPhotoFullscreen() {
        closeActionModal();
        const photoModal = document.getElementById('photo-modal');
        const photoImg = document.getElementById('fullscreen-image');
        photoModal.classList.remove('hidden');
        photoModal.classList.add('flex');
        setTimeout(() => {
            photoImg.classList.replace('scale-95', 'scale-100');
        }, 10);
    }

    function closePhotoFullscreen() {
        const photoModal = document.getElementById('photo-modal');
        const photoImg = document.getElementById('fullscreen-image');
        photoImg.classList.replace('scale-100', 'scale-95');
        setTimeout(() => {
            photoModal.classList.remove('flex');
            photoModal.classList.add('hidden');
        }, 300);
    }
</script>
@endpush