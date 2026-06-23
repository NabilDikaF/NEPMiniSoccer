@extends('layouts.admin')
@section('title', 'Detail Pelanggan - NEP Admin')

@section('header')
<div class="mb-lg flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <a href="{{ route('admin.pelanggan') }}" class="inline-flex items-center text-secondary hover:text-primary mb-2 transition-colors font-label-md">
            <span class="material-symbols-outlined text-sm mr-1">arrow_back</span>
            Kembali ke Data Pelanggan
        </a>
        <h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Detail Akun Pelanggan</h1>
        <p class="font-body-md text-body-md text-secondary">Melihat informasi profil dan riwayat lengkap pemesanan.</p>
    </div>
</div>
@endsection

@section('content')
<!-- Profil Singkat -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm border border-surface-variant p-6 mb-lg flex flex-col md:flex-row items-center gap-6">
    <div class="w-24 h-24 rounded-full bg-surface-container overflow-hidden flex-shrink-0">
        @if($user->avatar)
            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined text-4xl">person</span>
            </div>
        @endif
    </div>
    <div class="flex-1">
        <div class="flex items-center gap-3 mb-1">
            <h2 class="font-headline-md text-headline-md text-on-surface">{{ $user->name }}</h2>
            <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')" class="inline-flex items-center justify-center w-8 h-8 rounded-full text-secondary border border-outline hover:text-primary hover:border-primary hover:bg-primary-container/10 transition-colors" title="Edit Profil">
                <span class="material-symbols-outlined text-[18px]">edit</span>
            </button>
        </div>
        <div class="flex flex-col md:flex-row gap-2 md:gap-6 text-secondary font-body-md mt-2">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">email</span>
                {{ $user->email }}
            </div>
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">call</span>
                {{ $user->formatted_no_hp !== '-' ? $user->formatted_no_hp : 'Belum ada No. HP' }}
            </div>
        </div>
        <div class="flex items-center gap-2 text-secondary font-body-md mt-2">
            <span class="material-symbols-outlined text-sm">calendar_month</span>
            Bergabung sejak {{ $user->created_at->translatedFormat('d M Y') }}
        </div>
    </div>
    <div class="text-center bg-surface-container-low px-6 py-4 rounded-lg">
        <p class="font-label-md text-label-md text-secondary mb-1">Total Transaksi</p>
        <p class="font-headline-lg text-headline-lg text-primary font-bold">{{ $user->bookings->count() }}</p>
    </div>
</div>

<!-- Riwayat Pemesanan -->
<h3 class="font-title-lg text-title-lg text-on-surface mb-md">Riwayat Pemesanan</h3>

<div class="grid grid-cols-1 gap-md">
    @forelse($bookings as $booking)
        <div class="bg-surface-container-lowest rounded-lg shadow-sm border border-surface-variant overflow-hidden">
            <!-- Header Booking -->
            <div class="bg-surface-container-low px-6 py-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-surface-variant">
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <span class="font-title-md text-title-md text-on-surface">Order #{{ $booking->id_booking }}</span>
                        
                        @php
                            $statusColor = 'bg-surface-variant text-on-surface-variant';
                            if ($booking->status_booking == 'Confirmed') $statusColor = 'bg-primary-container text-on-primary-container';
                            elseif ($booking->status_booking == 'Menunggu Pembayaran' || $booking->status_booking == 'Half Paid') $statusColor = 'bg-tertiary-container text-on-tertiary-container';
                            elseif ($booking->status_booking == 'Menunggu Verifikasi') $statusColor = 'bg-secondary-container text-on-secondary-container';
                            elseif ($booking->status_booking == 'Dibatalkan') $statusColor = 'bg-error-container text-on-error-container';
                            elseif ($booking->status_booking == 'Selesai') $statusColor = 'bg-primary/10 text-primary';
                        @endphp
                        
                        <span class="px-2.5 py-0.5 rounded-full font-label-sm text-label-sm {{ $statusColor }}">
                            {{ $booking->status_booking }}
                        </span>
                        
                        <span class="px-2.5 py-0.5 rounded-full font-label-sm text-label-sm border border-outline text-secondary">
                            {{ $booking->tipe_booking }}
                        </span>
                    </div>
                    <p class="font-body-sm text-body-sm text-secondary">
                        Dipesan pada {{ $booking->created_at->translatedFormat('d M Y, H:i') }}
                    </p>
                </div>
                <div class="text-center">
                    <p class="font-label-sm text-label-sm text-secondary mb-1">Nama Tim</p>
                    <p class="font-title-sm text-title-sm text-on-surface">{{ $booking->nama_tim ?? '-' }}</p>
                </div>
                <div class="text-center">
                    <p class="font-label-sm text-label-sm text-secondary mb-1">Total Tagihan</p>
                    <p class="font-title-sm text-title-sm text-on-surface">Rp {{ number_format($booking->total_tagihan, 0, ',', '.') }}</p>
                </div>
            </div>
            
            <!-- Detail Jadwal -->
            <div class="p-6">
                <p class="font-label-md text-label-md text-on-surface mb-3">Jadwal yang Dipesan:</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($booking->detailBookings as $detail)
                        @if($detail->jadwal && $detail->jadwal->harga)
                            @php
                                $tanggalStr = $detail->jadwal->tanggal instanceof \Carbon\Carbon ? $detail->jadwal->tanggal->format('Y-m-d') : substr($detail->jadwal->tanggal, 0, 10);
                                $jadwalDate = \Carbon\Carbon::parse($tanggalStr);
                            @endphp
                            <div class="flex items-center gap-3 p-3 rounded-lg border border-outline-variant bg-surface-container-lowest">
                                <div class="w-10 h-10 rounded bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                                    <span class="material-symbols-outlined">event_available</span>
                                </div>
                                <div>
                                    <p class="font-label-md text-label-md text-on-surface">{{ $jadwalDate->translatedFormat('d M Y') }}</p>
                                    <p class="font-body-sm text-body-sm text-secondary">{{ \Carbon\Carbon::parse($detail->jadwal->harga->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($detail->jadwal->harga->jam_selesai)->format('H:i') }}</p>
                                </div>
                            </div>
                        @else
                            <div class="p-3 text-secondary italic text-sm border border-outline-variant rounded-lg">Data jadwal tidak valid</div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-surface-variant p-8 text-center">
            <span class="material-symbols-outlined text-4xl text-secondary mb-3">inbox</span>
            <p class="font-title-md text-title-md text-on-surface mb-1">Belum Ada Transaksi</p>
            <p class="font-body-md text-body-md text-secondary">Pelanggan ini belum pernah melakukan pemesanan lapangan.</p>
        </div>
    @endforelse

    @if($bookings->hasPages())
        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    @endif
</div>

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="fixed inset-0 z-50 hidden bg-[#00000080] flex items-center justify-center p-4" style="backdrop-filter: blur(2px);">
    <div class="bg-surface-container-lowest rounded-xl shadow-lg border border-surface-variant w-full max-w-lg overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-surface-variant flex justify-between items-center bg-surface-container-low">
            <h3 class="font-title-lg text-title-lg text-on-surface flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">edit_square</span>
                Edit Profil Pelanggan
            </h3>
            <button onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="text-secondary hover:text-error transition-colors flex items-center justify-center p-1 rounded-full hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form action="{{ route('admin.pelanggan.update', $user->id) }}" method="POST" class="overflow-y-auto">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label for="name" class="block font-label-md text-label-md text-on-surface mb-1">Nama Lengkap <span class="text-error">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2.5 border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-sm">
                    @error('name')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="email" class="block font-label-md text-label-md text-on-surface mb-1">Email <span class="text-error">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2.5 border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-sm">
                    @error('email')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="no_hp" class="block font-label-md text-label-md text-on-surface mb-1">No. WhatsApp</label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" maxlength="15" oninput="formatPhone(this)" placeholder="Format Nasional: 0812-3456-7890 (12 digit)" class="w-full px-4 py-2.5 border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-sm">
                    @error('no_hp')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="bg-surface-container-low p-4 rounded-lg border border-surface-variant mt-2">
                    <label for="password" class="block font-label-md text-label-md text-on-surface mb-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px] text-secondary">lock_reset</span>
                        Password Baru (Opsional)
                    </label>
                    <p class="font-body-sm text-secondary text-sm mb-2">Isi hanya jika Anda ingin mengubah password/sandi pelanggan ini.</p>
                    <input type="password" id="password" name="password" placeholder="Minimal 8 karakter..." class="w-full px-4 py-2.5 border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-sm">
                    @error('password')<p class="text-error text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="px-6 py-4 border-t border-surface-variant bg-surface-container-low flex justify-end gap-3">
                <button type="submit" class="px-6 py-2 rounded-full font-label-md text-label-md bg-primary text-on-primary hover:bg-primary/90 transition-colors shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Simpan Perubahan
                </button>
                <button type="button" onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="px-6 py-2 rounded-full font-label-md text-label-md border border-outline text-secondary hover:bg-surface-container transition-colors">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('editProfileModal').classList.remove('hidden');
    });
</script>
@endif

<script>
function formatPhone(input) {
    let value = input.value.replace(/\D/g, ''); // Hapus semua karakter selain angka
    if (value.length > 13) value = value.substring(0, 13); // Maksimal 13 digit
    
    let formatted = '';
    if (value.length > 8) {
        formatted = value.substring(0, 4) + '-' + value.substring(4, 8) + '-' + value.substring(8);
    } else if (value.length > 4) {
        formatted = value.substring(0, 4) + '-' + value.substring(4);
    } else {
        formatted = value;
    }
    input.value = formatted;
}

document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.getElementById('no_hp');
    if (phoneInput && phoneInput.value) {
        formatPhone(phoneInput);
    }
});
</script>
@endsection
