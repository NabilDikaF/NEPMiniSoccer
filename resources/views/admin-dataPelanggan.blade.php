@extends('layouts.admin')
@section('title', 'Data Pelanggan - NEP Admin')

@section('content')
<!-- Header Section -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-lg gap-md">
<div>
<h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Data Pelanggan</h1>
<p class="font-body-md text-body-md text-secondary">Manajemen data pelanggan dan riwayat pemesanan lapangan.</p>
</div>
<div class="relative w-full md:w-auto">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary">search</span>
<input class="w-full md:w-64 pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary font-body-md text-body-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] transition-shadow hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)]" placeholder="Cari nama tim..." type="text">
</div>
</div>
<!-- Data Table Card -->
<div class="bg-surface-container-lowest rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low border-b border-surface-variant">
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant w-16 text-center">No</th>
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant">Nama Kapten</th>
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant">Nama Tim</th>
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant">No. WhatsApp</th>
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant text-center">Total Booking</th>
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant">Status</th>
<th class="px-md py-sm font-label-md text-label-md text-on-surface-variant text-center">Aksi</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-variant font-body-md text-body-md">
<!-- Row 1 -->
<tr class="hover:bg-surface transition-colors">
<td class="px-md py-sm text-center text-secondary">1</td>
<td class="px-md py-sm font-medium text-on-surface">Budi Santoso</td>
<td class="px-md py-sm">Garuda FC</td>
<td class="px-md py-sm text-secondary">0812-3456-7890</td>
<td class="px-md py-sm text-center">12</td>
<td class="px-md py-sm">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-primary/10 text-primary">Member</span>
</td>
<td class="px-md py-sm text-center">
<button class="inline-flex items-center justify-center px-sm py-1 border border-outline rounded text-primary hover:bg-surface-container-low transition-colors font-label-md text-label-md">Detail</button>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface transition-colors">
<td class="px-md py-sm text-center text-secondary">2</td>
<td class="px-md py-sm font-medium text-on-surface">Ahmad Fauzi</td>
<td class="px-md py-sm">Bintang Timur</td>
<td class="px-md py-sm text-secondary">0856-7890-1234</td>
<td class="px-md py-sm text-center">3</td>
<td class="px-md py-sm">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-secondary-container text-on-secondary-container">Reguler</span>
</td>
<td class="px-md py-sm text-center">
<button class="inline-flex items-center justify-center px-sm py-1 border border-outline rounded text-primary hover:bg-surface-container-low transition-colors font-label-md text-label-md">Detail</button>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface transition-colors">
<td class="px-md py-sm text-center text-secondary">3</td>
<td class="px-md py-sm font-medium text-on-surface">Rizky Pratama</td>
<td class="px-md py-sm">Senja FC</td>
<td class="px-md py-sm text-secondary">0821-4567-8901</td>
<td class="px-md py-sm text-center">8</td>
<td class="px-md py-sm">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-primary/10 text-primary">Member</span>
</td>
<td class="px-md py-sm text-center">
<button class="inline-flex items-center justify-center px-sm py-1 border border-outline rounded text-primary hover:bg-surface-container-low transition-colors font-label-md text-label-md">Detail</button>
</td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-surface transition-colors">
<td class="px-md py-sm text-center text-secondary">4</td>
<td class="px-md py-sm font-medium text-on-surface">Dwi Saputra</td>
<td class="px-md py-sm">Kompak United</td>
<td class="px-md py-sm text-secondary">0896-1234-5678</td>
<td class="px-md py-sm text-center">1</td>
<td class="px-md py-sm">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-secondary-container text-on-secondary-container">Reguler</span>
</td>
<td class="px-md py-sm text-center">
<button class="inline-flex items-center justify-center px-sm py-1 border border-outline rounded text-primary hover:bg-surface-container-low transition-colors font-label-md text-label-md">Detail</button>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="border-t border-surface-variant px-md py-sm flex items-center justify-between bg-surface-container-lowest">
<span class="font-body-md text-body-md text-secondary text-sm">Menampilkan 1 hingga 4 dari 4 data</span>
<div class="flex gap-xs">
<button class="p-xs text-secondary hover:bg-surface-container-low rounded transition-colors disabled:opacity-50" disabled="">
<span class="material-symbols-outlined text-sm">chevron_left</span>
</button>
<button class="px-sm py-xs bg-primary text-on-primary rounded font-label-md text-label-md">1</button>
<button class="p-xs text-secondary hover:bg-surface-container-low rounded transition-colors disabled:opacity-50" disabled="">
<span class="material-symbols-outlined text-sm">chevron_right</span>
</button>
</div>
</div>
</div>
@endsection