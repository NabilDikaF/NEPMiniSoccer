@extends('layouts.admin')
@section('title', 'Profil Admin - NEP Admin')

@section('header')
<header class="mb-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-sm sm:gap-0">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Profil Admin</h1>
        <p class="font-body-md text-body-md text-secondary mt-xs">Kelola informasi pribadi dan keamanan akun Anda.</p>
    </div>
</header>
@endsection

@section('content')
<!-- Tambahkan Cropper.js CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">

<div class="flex flex-col lg:flex-row gap-lg">
    <!-- Kolom Kiri: Profil & Info -->
    <div class="w-full lg:w-1/2 flex flex-col gap-lg">
        
        <!-- Avatar Section -->
        <section class="bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] border border-surface-variant flex flex-col items-center justify-center">
            <div class="relative group cursor-pointer" onclick="document.getElementById('avatar').click()">
                <div class="w-32 h-32 rounded-full border-4 border-surface bg-surface-container-highest overflow-hidden relative shadow-sm">
                    <img id="avatar-image" alt="Avatar Admin" class="w-full h-full object-cover transition duration-300 group-hover:opacity-75" src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuCP8l0Pr6rSKgJ5xAtDkXot8_Qec7hnWW9_xgwB8cHQX4A_4f4wxQjSME3zNjkUj_6xSvGdoE5bc-_XVDQuO58ZXznXOZ3jw6wi3JtNWUG4oOic86lIshyvMxO_E9slNwmSD7meWeJ2vslUd9nsgWNEuqgqMtSqz5PPpJkq2goS9FZrlmt2Qxqw2XiqdRIxGv3cCNL6LM_4GzHTQSMHX8WdiWV4uFOJUut4VwdhpaoN5cDvK_GQKAVmv8pc6tqRK8McNgrmj8XN6WSx' }}"/>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 bg-black/30">
                        <span class="material-symbols-outlined text-white drop-shadow-md text-3xl">photo_camera</span>
                    </div>
                </div>
                <div class="absolute bottom-0 right-0 bg-primary text-on-primary rounded-full p-1 border-2 border-surface shadow-sm">
                    <span class="material-symbols-outlined text-[16px] block">edit</span>
                </div>
            </div>
            <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface mt-sm">{{ Auth::user()->name }}</h2>
            <span class="px-sm py-xs bg-tertiary-fixed text-on-tertiary-fixed rounded-full font-label-sm text-label-sm mt-xs">Administrator</span>
        </section>

        <!-- Informasi Pribadi -->
        <section class="bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] border border-surface-variant flex flex-col">
            <div class="flex items-center gap-sm mb-md border-b border-surface-variant pb-sm">
                <span class="material-symbols-outlined text-on-surface text-[24px]">manage_accounts</span>
                <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface">Informasi Pribadi</h2>
            </div>
            
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-md">
                @csrf
                <input class="hidden" id="avatar" type="file" accept="image/*" onchange="openCropper(event)"/>
                
                <div class="flex flex-col space-y-xs">
                    <label class="font-label-md text-label-md text-on-surface" for="namaLengkap">Nama Lengkap</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="person">person</span>
                        <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="namaLengkap" name="name" placeholder="Nama Admin" type="text" value="{{ Auth::user()->name ?? '' }}"/>
                    </div>
                </div>
                
                <div class="flex flex-col space-y-xs">
                    <label class="font-label-md text-label-md text-on-surface" for="email">Alamat Email</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="mail">mail</span>
                        <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="email" name="email" placeholder="Email Admin" type="email" value="{{ Auth::user()->email ?? '' }}"/>
                    </div>
                </div>

                <div class="flex flex-col space-y-xs">
                    <label class="font-label-md text-label-md text-on-surface" for="noWhatsapp">Nomor Telepon</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="phone_iphone">phone_iphone</span>
                        <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="noWhatsapp" name="no_hp" placeholder="Contoh: 0812-3456-7890" type="tel" value="{{ Auth::user()->no_hp ?? '' }}" maxlength="15" oninput="formatPhone(this)"/>
                    </div>
                </div>
                
                <div class="mt-sm flex justify-end border-t border-surface-variant pt-sm">
                    <button class="bg-primary text-on-primary font-label-md text-label-md py-2 px-lg rounded-lg shadow-sm hover:shadow-md hover:bg-primary-container transition-all duration-200 flex items-center gap-xs" type="submit">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan Profil
                    </button>
                </div>
            </form>
        </section>

    </div>

    <!-- Kolom Kanan: Keamanan -->
    <div class="w-full lg:w-1/2 flex flex-col gap-lg">
        <section class="bg-surface-container-lowest rounded-lg p-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] border border-surface-variant flex flex-col">
            <div class="flex items-center gap-sm mb-md border-b border-surface-variant pb-sm">
                <span class="material-symbols-outlined text-on-surface text-[24px]">security</span>
                <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface">Ubah Kata Sandi</h2>
            </div>

            @if($errors->any())
                <div class="bg-error-container text-on-error-container p-4 rounded-lg mb-4 font-body-md text-sm border border-error/20">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.password') }}" method="POST" class="flex flex-col gap-md">
                @csrf
                <div class="flex flex-col space-y-xs">
                    <label class="font-label-md text-label-md text-on-surface" for="passwordSekarang">Kata Sandi Saat Ini</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="lock">lock</span>
                        <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="passwordSekarang" name="current_password" placeholder="••••••••" type="password"/>
                    </div>
                </div>
                
                <div class="flex flex-col space-y-xs border-t border-surface-variant pt-md mt-xs">
                    <label class="font-label-md text-label-md text-on-surface" for="passwordBaru">Kata Sandi Baru</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="lock_reset">lock_reset</span>
                        <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="passwordBaru" name="password" placeholder="Minimal 8 karakter" type="password"/>
                    </div>
                </div>
                
                <div class="flex flex-col space-y-xs">
                    <label class="font-label-md text-label-md text-on-surface" for="konfirmasiPassword">Konfirmasi Kata Sandi Baru</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="check_circle">check_circle</span>
                        <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" id="konfirmasiPassword" name="password_confirmation" placeholder="Ulangi kata sandi baru" type="password"/>
                    </div>
                </div>
                
                <div class="mt-sm flex justify-end border-t border-surface-variant pt-sm">
                    <button class="bg-primary-container text-on-primary-container font-label-md text-label-md py-2 px-lg rounded-lg shadow-sm hover:shadow-md hover:opacity-90 transition-all duration-200 flex items-center gap-xs" type="submit">
                        <span class="material-symbols-outlined text-[18px]">key</span>
                        Perbarui Sandi
                    </button>
                </div>
            </form>
        </section>
    </div>
</div>

<!-- Cropping Modal -->
<div id="cropperModal" class="fixed inset-0 bg-[#191c1d]/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-surface-container-lowest rounded-xl max-w-md w-full p-6 shadow-xl border border-surface-variant relative transform scale-95 transition-transform duration-300" id="cropper-modal-card">
        <h3 class="font-headline-sm font-bold text-on-surface">Sesuaikan Foto Profil</h3>
        <div class="w-full h-64 bg-surface-container-highest flex items-center justify-center overflow-hidden rounded border border-surface-variant mt-sm">
            <img id="cropperImage" src="" alt="Image to crop" class="max-w-full max-h-full">
        </div>
        <div class="flex justify-end gap-3 mt-md">
            <button type="button" onclick="closeCropper()" class="px-4 py-2 rounded-lg font-label-md text-secondary hover:bg-surface-container transition-colors">Batal</button>
            <button type="button" id="saveCroppedImage" class="px-4 py-2 rounded-lg font-label-md text-on-primary bg-primary hover:bg-primary-container transition-colors flex items-center gap-2">
                <span id="saveIcon" class="material-symbols-outlined text-[18px]">save</span>
                <span id="saveText">Simpan</span>
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
function formatPhone(input) {
    let value = input.value.replace(/\D/g, ''); 
    if (value.length > 13) value = value.substring(0, 13); 
    
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
    const phoneInput = document.getElementById('noWhatsapp');
    if (phoneInput && phoneInput.value) {
        formatPhone(phoneInput);
    }
});

let cropper = null;

function openCropper(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('cropperImage').src = e.target.result;
        document.getElementById('cropperModal').classList.remove('hidden');
        document.getElementById('cropperModal').classList.add('flex');
        setTimeout(() => document.getElementById('cropper-modal-card').classList.replace('scale-95', 'scale-100'), 10);

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
    event.target.value = ''; 
}

function closeCropper() {
    document.getElementById('cropper-modal-card').classList.replace('scale-100', 'scale-95');
    setTimeout(() => {
        document.getElementById('cropperModal').classList.remove('flex');
        document.getElementById('cropperModal').classList.add('hidden');
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    }, 150);
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
            saveText.innerText = 'Simpan';
        });
    }, 'image/png');
});
</script>
@endsection
