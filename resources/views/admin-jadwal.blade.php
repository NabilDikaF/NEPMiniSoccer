@extends('layouts.admin')
@section('title', 'Kelola Jadwal - NEP Admin')

@section('content')
@php
    $hargaPagi = $hargas->where('blok_waktu', 'Pagi')->first()->harga ?? 0;
    $hargaSiang = $hargas->where('blok_waktu', 'Siang')->first()->harga ?? 0;
    $hargaSore = $hargas->where('blok_waktu', 'Sore')->first()->harga ?? 0;
    $hargaMalam = $hargas->where('blok_waktu', 'Malam')->first()->harga ?? 0;
@endphp

<form method="POST" action="{{ route('harga.massUpdate') }}">
@csrf
<header class="mb-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md">
<div>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Kelola Jadwal &amp; Harga</h2>
<p class="font-body-md text-body-md text-secondary mt-xs">Atur tarif blok waktu dan ketersediaan lapangan.</p>
</div>
<button type="submit" class="w-full sm:w-auto bg-primary text-on-primary font-label-md text-label-md px-md py-sm rounded-DEFAULT shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all">
                Simpan Perubahan
            </button>
</header>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-md">
<section class="lg:col-span-8 bg-surface-container-lowest rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] p-md flex flex-col border border-surface-container-highest">
<div class="flex items-center gap-sm mb-md border-b border-surface-container-highest pb-sm">
<span class="material-symbols-outlined text-primary" data-icon="payments">payments</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Pengaturan Harga Dasar</h3>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-md">
<div class="flex flex-col gap-xs">
<label class="font-label-md text-label-md text-on-surface flex justify-between">
<span class="">Blok Pagi</span>
<span class="text-secondary font-label-sm text-label-sm font-normal">06:00 - 10:00</span>
</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 flex items-center pl-sm text-secondary font-body-md text-body-md">Rp</span>
<input name="harga_pagi" class="w-full pl-xl pr-sm py-sm bg-surface-bright border border-outline-variant rounded-DEFAULT font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="0" type="number" value="{{ intval($hargaPagi) }}"/>
</div>
</div>
<div class="flex flex-col gap-xs">
<label class="font-label-md text-label-md text-on-surface flex justify-between">
<span class="">Blok Siang</span>
<span class="text-secondary font-label-sm text-label-sm font-normal">10:00 - 15:00</span>
</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 flex items-center pl-sm text-secondary font-body-md text-body-md">Rp</span>
<input name="harga_siang" class="w-full pl-xl pr-sm py-sm bg-surface-bright border border-outline-variant rounded-DEFAULT font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="0" type="number" value="{{ intval($hargaSiang) }}"/>
</div>
</div>
<div class="flex flex-col gap-xs">
<label class="font-label-md text-label-md text-on-surface flex justify-between">
<span class="">Blok Sore</span>
<span class="text-secondary font-label-sm text-label-sm font-normal">15:00 - 18:00</span>
</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 flex items-center pl-sm text-secondary font-body-md text-body-md">Rp</span>
<input name="harga_sore" class="w-full pl-xl pr-sm py-sm bg-surface-bright border border-outline-variant rounded-DEFAULT font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="0" type="number" value="{{ intval($hargaSore) }}"/>
</div>
</div>
<div class="flex flex-col gap-xs">
<label class="font-label-md text-label-md text-on-surface flex justify-between">
<span class="">Blok Malam</span>
<span class="text-secondary font-label-sm text-label-sm font-normal">18:00 - 23:00</span>
</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 flex items-center pl-sm text-secondary font-body-md text-body-md">Rp</span>
<input name="harga_malam" class="w-full pl-xl pr-sm py-sm bg-surface-bright border border-outline-variant rounded-DEFAULT font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="0" type="number" value="{{ intval($hargaMalam) }}"/>
</div>
</div>
</div>
</section>
<section class="lg:col-span-4 bg-surface-container-lowest rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] p-md flex flex-col border border-surface-container-highest">
<div class="flex items-center gap-sm mb-md border-b border-surface-container-highest pb-sm">
<span class="material-symbols-outlined text-tertiary" data-icon="loyalty">loyalty</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Keanggotaan</h3>
</div>
<div class="flex flex-col gap-base">
<p class="font-body-md text-body-md text-secondary">Atur persentase potongan harga untuk pelanggan yang memilih jenis member.</p>
<div class="flex flex-col gap-xs mt-sm">
<label class="font-label-md text-label-md text-on-surface">Diskon Member</label>
<div class="relative flex items-center">
<input name="diskon_member" class="w-full pl-sm pr-lg py-sm bg-surface-bright border border-outline-variant rounded-DEFAULT font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="0" type="number" value="15"/>
<span class="absolute right-sm text-secondary font-body-md text-body-md">%</span>
</div>
</div>
</div>
</section>
<section class="lg:col-span-12 bg-surface-container-lowest rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] p-md flex flex-col border border-surface-container-highest mt-base">
<div class="flex flex-col sm:flex-row sm:items-center justify-between mb-md border-b border-surface-container-highest pb-sm gap-sm">
<div class="flex items-center gap-sm">
<span class="material-symbols-outlined text-primary" data-icon="event_busy">event_busy</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Ketersediaan Lapangan (Maintenance)</h3>
</div>
<div class="flex items-center gap-xs">
<span class="w-3 h-3 rounded-full bg-primary-container"></span>
<span class="font-label-sm text-label-sm text-secondary">Tersedia</span>
<span class="w-3 h-3 rounded-full bg-surface-variant ml-sm"></span>
<span class="font-label-sm text-label-sm text-secondary">Ditutup</span>
</div>
</div>
<p class="font-body-md text-body-md text-secondary mb-md">Gunakan sakelar di bawah untuk mengunci slot jadwal secara manual. Slot yang terkunci tidak akan muncul di halaman pemesanan pelanggan.</p>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-md">
@foreach($hargas as $slot)
<div class="border border-surface-container-highest rounded-DEFAULT p-sm flex items-center justify-between bg-surface-bright">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface">{{ \Carbon\Carbon::parse($slot->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->jam_selesai)->format('H:i') }}</span>
<span class="font-label-sm text-label-sm text-secondary">{{ $slot->blok_waktu }}</span>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input name="slot_aktif[]" class="sr-only peer" type="checkbox" value="{{ $slot->id_harga }}" {{ $slot->is_active ? 'checked' : '' }}/>
<div class="w-11 h-6 bg-surface-variant rounded-full peer peer-focus:ring-2 peer-focus:ring-primary-fixed-dim peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-container shadow-inner"></div>
</label>
</div>
@endforeach
</div>
</section>
</div>
</form>
@endsection