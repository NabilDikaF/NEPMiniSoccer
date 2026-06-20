@extends('layouts.auth')
@section('title', 'Lupa Password - NEP Mini Soccer')

@section('content')
<main class="w-full max-w-lg px-4 sm:px-gutter">
    <div class="bg-surface-container-lowest rounded-xl shadow-[0_12px_24px_rgba(0,0,0,0.1)] p-6 sm:p-lg flex flex-col">
        
        <div class="text-center mb-md">
            <img src="{{ asset('logo.png') }}" alt="NEP Mini Soccer Logo" class="h-16 md:h-20 w-auto mx-auto mb-sm">
            <h1 class="sr-only">NEP Mini Soccer</h1>
            <h2 class="font-headline-sm sm:font-headline-md text-headline-sm sm:text-headline-md text-on-surface">Lupa Password</h2>
            <p class="font-body-md text-body-md text-secondary mt-base" id="subtitle">Masukkan email Anda untuk reset password.</p>
        </div>

        <div id="alertMessage" class="hidden px-sm py-3 rounded-lg mb-4 flex items-center gap-2 shadow-[0_2px_4px_rgba(33,37,41,0.05)]">
            <span class="material-symbols-outlined text-[20px]" id="alertIcon">info</span>
            <span class="font-body-md text-sm" id="alertText"></span>
        </div>

        <!-- STAGE 1: EMAIL -->
        <div id="stage1" class="flex flex-col space-y-md">
            <div class="flex flex-col space-y-xs">
                <label class="font-label-md text-label-md text-on-surface" for="email">Email</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="alternate_email">alternate_email</span>
                    <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="email" placeholder="Email terdaftar" required type="email">
                </div>
            </div>
            
            <div class="pt-base flex flex-col items-center gap-4">
                <button id="btnSendOtp" onclick="sendOtp()" class="w-full bg-primary-container text-on-primary font-label-md text-label-md py-3 sm:py-sm rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-200 flex items-center justify-center gap-2">
                    Kirim Kode OTP
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </button>
            </div>
        </div>

        <!-- STAGE 2: OTP -->
        <div id="stage2" class="flex flex-col space-y-md hidden">
            <div class="flex flex-col space-y-xs">
                <label class="font-label-md text-label-md text-on-surface" for="otp">Kode OTP</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="pin">pin</span>
                    <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="otp" placeholder="Masukkan 5 digit angka" required type="text" maxlength="5">
                </div>
            </div>
            
            <div class="pt-base flex flex-col items-center gap-4">
                <button id="btnVerifyOtp" onclick="verifyOtp()" class="w-full bg-primary-container text-on-primary font-label-md text-label-md py-3 sm:py-sm rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-200 flex items-center justify-center gap-2">
                    Verifikasi OTP
                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                </button>
            </div>
        </div>

        <!-- STAGE 3: NEW PASSWORD -->
        <div id="stage3" class="flex flex-col space-y-md hidden">
            <div class="flex flex-col space-y-xs">
                <label class="font-label-md text-label-md text-on-surface" for="password">Password Baru</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="lock">lock</span>
                    <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="password" placeholder="Minimal 8 karakter" required type="password">
                </div>
            </div>
            <div class="flex flex-col space-y-xs">
                <label class="font-label-md text-label-md text-on-surface" for="password_confirmation">Konfirmasi Password</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="lock_reset">lock_reset</span>
                    <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="password_confirmation" placeholder="Ulangi password" required type="password">
                </div>
            </div>
            <div class="pt-base flex flex-col items-center gap-4">
                <button id="btnResetPassword" onclick="resetPassword()" class="w-full bg-primary-container text-on-primary font-label-md text-label-md py-3 sm:py-sm rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-200 flex items-center justify-center gap-2">
                    Ubah Password
                    <span class="material-symbols-outlined text-[18px]">save</span>
                </button>
            </div>
        </div>

        <div class="mt-md text-center">
            <p class="font-body-md text-body-md text-secondary">
                <a class="text-primary font-medium inline-flex items-center gap-1 group" href="{{ route('login') }}">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    <span class="group-hover:underline">Kembali ke Login</span>
                </a>
            </p>
        </div>
    </div>

    <div class="mt-md text-center">
        <p class="font-label-sm text-label-sm text-secondary">
            Butuh bantuan? <a class="text-primary hover:underline" href="#">Hubungi Support</a>
        </p>
    </div>
</main>
@endsection

@push('scripts')
<style>
    .ambient-glow {
        background: radial-gradient(circle at 50% 50%, rgba(40, 167, 69, 0.05) 0%, transparent 70%);
    }
</style>
<script>
    function showAlert(message, type = 'error') {
        const alertBox = document.getElementById('alertMessage');
        const alertIcon = document.getElementById('alertIcon');
        const alertText = document.getElementById('alertText');

        alertText.innerText = message;
        alertBox.classList.remove('hidden', 'bg-error-container', 'text-on-error-container', 'border-error', 'bg-primary-container', 'text-on-primary-container', 'border-primary');
        
        if(type === 'error') {
            alertBox.classList.add('bg-error-container', 'text-on-error-container', 'border', 'border-error');
            alertIcon.innerText = 'error';
        } else {
            alertBox.classList.add('bg-primary-container', 'text-on-primary-container', 'border', 'border-primary');
            alertIcon.innerText = 'check_circle';
        }
    }

    function hideAlert() {
        document.getElementById('alertMessage').classList.add('hidden');
    }

    function sendOtp() {
        const email = document.getElementById('email').value;
        const btn = document.getElementById('btnSendOtp');
        
        if(!email) {
            showAlert('Mohon isi email Anda.');
            return;
        }

        hideAlert();
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span> Mengirim...';

        fetch('{{ route('forgetpw.sendOtp') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                showAlert(data.message, 'success');
                document.getElementById('stage1').classList.add('hidden');
                document.getElementById('stage2').classList.remove('hidden');
                document.getElementById('subtitle').innerText = 'Cek email Anda untuk 5 digit kode OTP.';
            } else {
                showAlert(data.message, 'error');
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        })
        .catch(error => {
            showAlert('Terjadi kesalahan sistem.', 'error');
            btn.disabled = false;
            btn.innerHTML = originalText;
        });
    }

    function verifyOtp() {
        const email = document.getElementById('email').value;
        const otp = document.getElementById('otp').value;
        const btn = document.getElementById('btnVerifyOtp');

        if(!otp) {
            showAlert('Mohon masukkan kode OTP.');
            return;
        }

        hideAlert();
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span> Memverifikasi...';

        fetch('{{ route('forgetpw.verifyOtp') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ email: email, otp: otp })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                showAlert(data.message, 'success');
                document.getElementById('stage2').classList.add('hidden');
                document.getElementById('stage3').classList.remove('hidden');
                document.getElementById('subtitle').innerText = 'Buat password baru untuk akun Anda.';
            } else {
                showAlert(data.message, 'error');
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        })
        .catch(error => {
            showAlert('Terjadi kesalahan sistem.', 'error');
            btn.disabled = false;
            btn.innerHTML = originalText;
        });
    }

    function resetPassword() {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirm = document.getElementById('password_confirmation').value;
        const btn = document.getElementById('btnResetPassword');

        if(!password || !confirm) {
            showAlert('Mohon isi kedua kolom password.');
            return;
        }

        hideAlert();
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span> Menyimpan...';

        fetch('{{ route('forgetpw.reset') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ 
                email: email, 
                password: password,
                password_confirmation: confirm
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                showAlert(data.message, 'success');
                btn.innerHTML = '<span class="material-symbols-outlined">check_circle</span> Selesai!';
                setTimeout(() => {
                    window.location.href = '{{ route('login') }}';
                }, 1500);
            } else {
                showAlert(data.message, 'error');
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        })
        .catch(error => {
            showAlert('Terjadi kesalahan sistem.', 'error');
            btn.disabled = false;
            btn.innerHTML = originalText;
        });
    }
</script>
@endpush