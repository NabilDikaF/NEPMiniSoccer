@extends('layouts.auth')
@section('title', 'Register - NEP Mini Soccer')

@section('content')
<main class="w-full max-w-lg px-4 sm:px-gutter">
    <div class="bg-surface-container-lowest rounded-xl shadow-[0_12px_24px_rgba(0,0,0,0.1)] p-6 sm:p-lg flex flex-col">
        <div class="text-center mb-md">
            <img src="{{ asset('logo.png') }}" alt="NEP Mini Soccer Logo" class="h-16 md:h-20 w-auto mx-auto mb-sm">
            <h1 class="sr-only">NEP Mini Soccer</h1>
            <h2 class="font-headline-sm sm:font-headline-md text-headline-sm sm:text-headline-md text-on-surface">Buat Akun Baru</h2>
            <p class="font-body-md text-body-md text-secondary mt-base">Daftar untuk mulai memesan lapangan.</p>
        </div>

        <form class="flex flex-col space-y-md" method="POST" action="{{ route('register.post') }}">
            @csrf 
            @if($errors->any())
                <div class="px-sm py-3 rounded-lg bg-error-container text-on-error-container border border-error flex items-center gap-2 shadow-[0_2px_4px_rgba(33,37,41,0.05)]">
                    <span class="material-symbols-outlined text-[20px]" data-icon="error">error</span>
                    <span class="font-body-md text-sm">{{ $errors->first() }}</span>
                </div>
            @endif

            <div class="flex flex-col space-y-xs">
                <label class="font-label-md text-label-md text-on-surface" for="fullName">Nama Lengkap</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="person">person</span>
                    <input class="w-full pl-10 pr-sm py-3 sm:py-sm border @error('name') border-error @else border-surface-variant @enderror rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="fullName" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" type="text" required/>
                </div>
            </div>
            
            <div class="flex flex-col space-y-xs">
                <label class="font-label-md text-label-md text-on-surface" for="whatsapp">No. WhatsApp</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="call">call</span>
                    <input class="w-full pl-10 pr-sm py-3 sm:py-sm border @error('no_hp') border-error @else border-surface-variant @enderror rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="whatsapp" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" type="tel"/>
                </div>
            </div>
            
            <div class="flex flex-col space-y-xs">
                <label class="font-label-md text-label-md text-on-surface" for="email">Email</label>
                <div class="flex gap-2">
                    <div class="relative flex items-center flex-1">
                        <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="alternate_email">alternate_email</span>
                        <input class="w-full pl-10 pr-sm py-3 sm:py-sm border @error('email') border-error @else border-surface-variant @enderror rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" type="email" required/>
                    </div>
                    <button type="button" id="btnSendOtp" onclick="sendOtp()" class="bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-sm px-4 rounded-lg transition-colors whitespace-nowrap shadow-[0_2px_4px_rgba(33,37,41,0.05)] border border-surface-variant">
                        Kirim OTP
                    </button>
                </div>
                <span id="otpMessage" class="text-sm hidden mt-1"></span>
            </div>
            
            <div class="flex flex-col space-y-xs" id="otpContainer" style="display: none;">
                <label class="font-label-md text-label-md text-on-surface" for="otp">Kode OTP</label>
                <div class="flex gap-2">
                    <div class="relative flex items-center flex-1">
                        <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="pin">pin</span>
                        <input class="w-full pl-10 pr-sm py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="otp" name="otp" placeholder="Masukkan 5 digit kode OTP" type="text" maxlength="5"/>
                    </div>
                    <button type="button" id="btnVerifyOtp" onclick="verifyOtp()" class="bg-primary text-on-primary font-label-sm text-sm px-4 rounded-lg hover:opacity-90 transition-opacity whitespace-nowrap shadow-[0_2px_4px_rgba(33,37,41,0.05)] flex items-center gap-1">
                        Verif OTP
                    </button>
                </div>
                <span id="otpVerifyMessage" class="text-sm hidden mt-1"></span>
            </div>
            
            <div class="flex flex-col space-y-xs">
                <label class="font-label-md text-label-md text-on-surface" for="password">Password</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="lock">lock</span>
                    <input class="w-full pl-10 pr-10 py-3 sm:py-sm border @error('password') border-error @else border-surface-variant @enderror rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="password" name="password" placeholder="Minimal 8 karakter" type="password" autocomplete="new-password" required/>
                    <button class="absolute right-3 text-secondary hover:text-primary transition-colors flex items-center justify-center bg-transparent border-0 p-0" type="button" onclick="const p = document.getElementById('password'); p.type = p.type === 'password' ? 'text' : 'password';">
                        <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                    </button>
                </div>
            </div>
            
            <div class="flex flex-col space-y-xs">
                <label class="font-label-md text-label-md text-on-surface" for="confirmPassword">Konfirmasi Password</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="lock_reset">lock_reset</span>
                    <input class="w-full pl-10 pr-10 py-3 sm:py-sm border border-surface-variant rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="confirmPassword" name="password_confirmation" placeholder="Masukkan ulang password" type="password" autocomplete="new-password" required/>
                    <button class="absolute right-3 text-secondary hover:text-primary transition-colors flex items-center justify-center bg-transparent border-0 p-0" type="button" onclick="const p = document.getElementById('confirmPassword'); p.type = p.type === 'password' ? 'text' : 'password';">
                        <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                    </button>
                </div>
            </div>
            
            <div class="pt-base flex flex-col items-center gap-4">
                <button id="btnRegister" disabled class="w-full bg-primary-container text-on-primary font-label-md text-label-md py-3 sm:py-sm rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-200 opacity-50 cursor-not-allowed flex items-center justify-center gap-2" type="submit">
                    Daftar Akun
                    <span class="material-symbols-outlined text-[18px]">person_add</span>
                </button>
                <p class="text-center text-xs text-error" id="registerWarning">Verifikasi OTP terlebih dahulu untuk mengaktifkan tombol daftar.</p>
            </div>
        </form>

        <div class="mt-md text-center">
            <p class="font-body-md text-body-md text-secondary">
                Sudah punya akun? <a class="text-primary font-medium hover:underline p-2 -m-2 inline-block" href="{{ route('login') }}">Masuk</a>
            </p>
        </div>
    </div>
</main>

<script>
    function showMessage(elementId, text, isError = false) {
        const el = document.getElementById(elementId);
        el.innerText = text;
        el.classList.remove('hidden', 'text-error', 'text-primary');
        el.classList.add(isError ? 'text-error' : 'text-primary');
    }

    function sendOtp() {
        const email = document.getElementById('email').value;
        const btn = document.getElementById('btnSendOtp');
        
        if(!email) {
            showMessage('otpMessage', 'Mohon isi email terlebih dahulu.', true);
            return;
        }

        btn.disabled = true;
        btn.innerText = 'Mengirim...';
        showMessage('otpMessage', 'Sedang mengirim OTP...', false);

        fetch('{{ route('register.sendOtp') }}', {
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
                showMessage('otpMessage', data.message, false);
                document.getElementById('otpContainer').style.display = 'flex';
                
                // Countdown timer for resend
                let timeLeft = 60;
                const timer = setInterval(() => {
                    timeLeft--;
                    btn.innerText = `Tunggu ${timeLeft}s`;
                    if(timeLeft <= 0) {
                        clearInterval(timer);
                        btn.disabled = false;
                        btn.innerText = 'Kirim Ulang OTP';
                    }
                }, 1000);
            } else {
                showMessage('otpMessage', data.message, true);
                btn.disabled = false;
                btn.innerText = 'Kirim OTP';
            }
        })
        .catch(error => {
            showMessage('otpMessage', 'Terjadi kesalahan sistem.', true);
            btn.disabled = false;
            btn.innerText = 'Kirim OTP';
        });
    }

    function verifyOtp() {
        const email = document.getElementById('email').value;
        const otp = document.getElementById('otp').value;
        const btn = document.getElementById('btnVerifyOtp');

        if(!otp) {
            showMessage('otpVerifyMessage', 'Mohon masukkan kode OTP.', true);
            return;
        }

        btn.disabled = true;
        btn.innerText = 'Memverifikasi...';

        fetch('{{ route('register.verifyOtp') }}', {
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
                showMessage('otpVerifyMessage', data.message, false);
                // Kunci input email dan otp agar tidak diubah lagi
                document.getElementById('email').readOnly = true;
                document.getElementById('otp').readOnly = true;
                btn.innerText = 'Terverifikasi';
                document.getElementById('btnSendOtp').style.display = 'none';
                
                // Aktifkan tombol daftar
                const registerBtn = document.getElementById('btnRegister');
                registerBtn.disabled = false;
                registerBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                document.getElementById('registerWarning').style.display = 'none';
            } else {
                showMessage('otpVerifyMessage', data.message, true);
                btn.disabled = false;
                btn.innerText = 'Verif OTP';
            }
        })
        .catch(error => {
            showMessage('otpVerifyMessage', 'Terjadi kesalahan sistem.', true);
            btn.disabled = false;
            btn.innerText = 'Verif OTP';
        });
    }
</script>
@endsection