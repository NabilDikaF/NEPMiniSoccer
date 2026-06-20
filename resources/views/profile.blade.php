@extends('layouts.app')
@section('title', 'Profil Pengguna - NEP Mini Soccer')

@section('content')
<!-- Tambahkan Cropper.js CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<div class="w-full max-w-container-max mx-auto px-gutter py-xl flex flex-col gap-lg">
    <div class="relative w-full rounded-lg overflow-hidden bg-surface-container-lowest border border-surface-variant shadow-[0_2px_4px_rgba(33,37,41,0.05)]">
        <div class="h-48 md:h-64 w-full bg-surface-container-highest relative">
            <img alt="Cover Profil" class="w-full h-full object-cover opacity-90" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDpp0ZJbB8hT6-aG1LqiJ5wGw-f36WXKjXZN6vEX0HJbCvEiPXimN7v_TGDPubC6J1C4RTqplboEWl185VpKFFyL48WuhPrOweAmsYKThSlvpCdjWc-9ZLSrEHlla3ogqtTFsXDnT0AHtt1uZ17GWNZm0YftVgVLVNgQUm4FcOAfCWtcDVOs8LrhsEFMM_X5HqJuVcYlP7G32YHOSUD6vGnNrUkNhHqQTfZSnKa3X8MqcyKBiF-JI8I9Mciu_EYIoGkdBMm3VQvtpi4"/>
            <div class="absolute inset-0 bg-gradient-to-t from-background/60 to-transparent"></div>
        </div>
        <div class="px-lg pb-lg relative flex flex-col md:flex-row items-center md:items-end gap-md -mt-16 md:-mt-12 z-10">
            <div class="w-32 h-32 rounded-full border-4 border-surface-container-lowest bg-surface-container-highest flex-shrink-0 overflow-hidden relative shadow-sm group cursor-pointer" onclick="document.getElementById('avatar').click()">
                <img id="avatar-image" alt="Avatar" class="w-full h-full object-cover transition duration-300 group-hover:opacity-75" src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuCP8l0Pr6rSKgJ5xAtDkXot8_Qec7hnWW9_xgwB8cHQX4A_4f4wxQjSME3zNjkUj_6xSvGdoE5bc-_XVDQuO58ZXznXOZ3jw6wi3JtNWUG4oOic86lIshyvMxO_E9slNwmSD7meWeJ2vslUd9nsgWNEuqgqMtSqz5PPpJkq2goS9FZrlmt2Qxqw2XiqdRIxGv3cCNL6LM_4GzHTQSMHX8WdiWV4uFOJUut4VwdhpaoN5cDvK_GQKAVmv8pc6tqRK8McNgrmj8XN6WSx' }}"/>
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                    <span class="material-symbols-outlined text-white drop-shadow-md text-3xl">photo_camera</span>
                </div>
            </div>
            <div class="flex flex-col items-center md:items-start flex-grow text-center md:text-left mb-2">
                <h1 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg font-bold text-on-surface mb-xs">{{ Auth::user()->name ?? 'Pengguna' }}</h1>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-lg">
        
        <aside class="w-full md:w-1/3 lg:w-1/4 flex flex-col gap-md">
            <div class="bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] border border-surface-variant flex flex-col gap-sm">
                <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface border-b border-surface-variant pb-xs mb-xs">Statistik Aktivitas</h2>
                
                <div class="flex justify-between items-center bg-surface-container-low p-sm rounded border border-surface-variant">
                    <span class="font-label-md text-label-md text-secondary">Total Jam Main</span>
                    <span class="font-headline-md text-headline-md font-bold text-primary">{{ $totalJamMain ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center bg-surface-container-low p-sm rounded border border-surface-variant">
                    <span class="font-label-md text-label-md text-secondary">Booking Menunggu</span>
                    <span class="font-headline-md text-headline-md font-bold text-on-surface">{{ $bookingMenunggu ?? 0 }}</span>
                </div>
            </div>
        </aside>

        <div class="w-full md:w-2/3 lg:w-3/4 flex flex-col gap-lg">
            
            <section class="bg-surface-container-lowest rounded-lg p-md md:p-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] border border-surface-variant flex flex-col">
                <div class="flex items-center gap-sm mb-md border-b border-surface-variant pb-sm">
                    <span class="material-symbols-outlined text-on-surface text-[24px]">manage_accounts</span>
                    <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface">Detail Profil</h2>
                </div>
                
                @if(session('success'))
                    <div class="bg-primary-container text-on-primary-container p-4 rounded-lg mb-4 font-body-md">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="bg-error-container text-on-error-container p-4 rounded-lg mb-4 font-body-md">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    @csrf
                    <input class="hidden" id="avatar" type="file" accept="image/*" onchange="openCropper(event)"/>
                    
                    <div class="flex flex-col space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface" for="namaLengkap">Nama Lengkap</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="person">person</span>
                            <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="namaLengkap" name="name" placeholder="Masukkan nama lengkap" type="text" value="{{ Auth::user()->name ?? '' }}"/>
                        </div>
                    </div>
                    
                    <div class="flex flex-col space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface" for="noWhatsapp">Nomor Telepon</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="phone_iphone">phone_iphone</span>
                            <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="noWhatsapp" name="no_hp" placeholder="Nomor Telepon" type="tel" value="{{ Auth::user()->no_hp ?? '' }}"/>
                        </div>
                    </div>
                    
                    <div class="flex flex-col space-y-xs md:col-span-2">
                        <label class="font-label-md text-label-md text-on-surface" for="email">Alamat Email</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="mail">mail</span>
                            <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="email" name="email" placeholder="Email Anda" type="email" value="{{ Auth::user()->email ?? '' }}"/>
                        </div>
                    </div>
                    
                    <div class="md:col-span-2 mt-sm flex justify-end">
                        <button class="bg-primary-container text-on-primary font-label-md text-label-md py-3 sm:py-sm px-lg rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-200 flex items-center gap-xs" type="submit">
                            <span class="material-symbols-outlined text-[18px]">save</span>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                <div class="mt-md mb-xs border-b border-surface-variant pb-xs" id="security-section">
                    <h3 class="font-headline-sm text-headline-sm font-bold text-on-surface">Keamanan</h3>
                </div>

                <form action="{{ route('profile.password') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-md mt-sm">
                    @csrf
                    <div class="flex flex-col space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface" for="passwordSekarang">Kata Sandi Saat Ini</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="lock">lock</span>
                            <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="passwordSekarang" name="current_password" placeholder="••••••••" type="password"/>
                        </div>
                    </div>
                    
                    <div class="flex flex-col space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface" for="passwordBaru">Kata Sandi Baru</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="lock_reset">lock_reset</span>
                            <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="passwordBaru" name="password" placeholder="Minimal 8 karakter" type="password"/>
                        </div>
                    </div>
                    
                    <div class="flex flex-col space-y-xs md:col-span-2">
                        <label class="font-label-md text-label-md text-on-surface" for="konfirmasiPassword">Konfirmasi Kata Sandi Baru</label>
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="check_circle">check_circle</span>
                            <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="konfirmasiPassword" name="password_confirmation" placeholder="Ulangi kata sandi baru" type="password"/>
                        </div>
                    </div>
                    
                    <div class="md:col-span-2 mt-sm flex justify-end">
                        <button class="bg-primary-container text-on-primary font-label-md text-label-md py-3 sm:py-sm px-lg rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-200 flex items-center gap-xs" type="submit">
                            <span class="material-symbols-outlined text-[18px]">save</span>
                            Simpan Perubahan Keamanan
                        </button>
                    </div>
                </form>
            </section>

        </div>
    </div>
</div>

<!-- Cropping Modal -->
<div id="cropperModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/60 backdrop-blur-sm">
    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-lg w-full max-w-md flex flex-col gap-4">
        <h3 class="font-headline-sm font-bold text-on-surface">Sesuaikan Foto Profil</h3>
        <div class="w-full h-64 bg-surface-container-highest flex items-center justify-center overflow-hidden rounded border border-surface-variant">
            <img id="cropperImage" src="" alt="Image to crop" class="max-w-full max-h-full">
        </div>
        <div class="flex justify-end gap-3 mt-2">
            <button type="button" id="saveCroppedImage" class="px-4 py-2 rounded-lg font-label-md text-on-primary bg-primary hover:bg-primary-600 transition-colors flex items-center gap-2">
                <span id="saveIcon" class="material-symbols-outlined text-[18px]">save</span>
                <span id="saveText">Simpan Foto</span>
            </button>
            <button type="button" onclick="closeCropper()" class="px-4 py-2 rounded-lg font-label-md text-on-surface bg-surface-container hover:bg-surface-container-high transition-colors">Batal</button>
        </div>
    </div>
</div>

<!-- Tambahkan Cropper.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<script>
let cropper = null;

function openCropper(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('cropperImage').src = e.target.result;
        document.getElementById('cropperModal').classList.remove('hidden');

        if (cropper) {
            cropper.destroy();
        }

        cropper = new Cropper(document.getElementById('cropperImage'), {
            aspectRatio: 1,
            viewMode: 1,
            autoCropArea: 1,
            responsive: true,
            background: false,
            dragMode: 'move'
        });
    };
    reader.readAsDataURL(file);
    event.target.value = ''; // Reset input agar bisa pilih file yang sama lagi
}

function closeCropper() {
    document.getElementById('cropperModal').classList.add('hidden');
    if (cropper) {
        cropper.destroy();
        cropper = null;
    }
}

document.getElementById('saveCroppedImage').addEventListener('click', function() {
    if (!cropper) return;

    const btn = document.getElementById('saveCroppedImage');
    const saveIcon = document.getElementById('saveIcon');
    const saveText = document.getElementById('saveText');

    btn.disabled = true;
    saveText.innerText = 'Menyimpan...';

    cropper.getCroppedCanvas({
        width: 300,
        height: 300
    }).toBlob(function(blob) {
        const formData = new FormData();
        formData.append('avatar', blob, 'avatar.png');
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route('profile.avatar') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update foto profil di halaman
                document.getElementById('avatar-image').src = data.avatar_url;
                closeCropper();
            } else {
                alert(data.message || 'Gagal menyimpan foto.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengunggah foto.');
        })
        .finally(() => {
            btn.disabled = false;
            saveText.innerText = 'Simpan Foto';
        });
    }, 'image/png');
});
</script>
@endsection