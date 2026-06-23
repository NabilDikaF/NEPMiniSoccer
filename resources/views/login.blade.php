@extends('layouts.auth')
@section('title', 'Login - NEP Mini Soccer')

@section('content')
<main class="w-full max-w-lg px-4 sm:px-gutter">
    <div class="bg-surface-container-lowest rounded-xl shadow-[0_12px_24px_rgba(0,0,0,0.1)] p-6 sm:p-lg flex flex-col">
        
        <div class="text-center mb-md">
            <img src="{{ asset('logo.png') }}" alt="NEP Mini Soccer Logo" class="h-16 md:h-20 w-auto mx-auto mb-sm">
            <h1 class="sr-only">NEP Mini Soccer</h1>
            <h2 class="font-headline-sm sm:font-headline-md text-headline-sm sm:text-headline-md text-on-surface">Selamat datang</h2>
            <p class="font-body-md text-body-md text-secondary mt-base">Masuk untuk memesan pertandingan Anda berikutnya</p>
        </div>

        <form class="flex flex-col space-y-md" method="POST" action="{{ route('login.post') }}">
            @csrf

            @if($errors->any())
                <div class="px-sm py-3 rounded-lg bg-error-container text-on-error-container border border-error flex items-center gap-2 shadow-[0_2px_4px_rgba(33,37,41,0.05)]">
                    <span class="material-symbols-outlined text-[20px]" data-icon="error">error</span>
                    <span class="font-body-md text-sm">{{ $errors->first() }}</span>
                </div>
            @endif

            <div class="flex flex-col space-y-xs">
                <label class="font-label-md text-label-md text-on-surface" for="identifier">Email</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="person">person</span>
                    <input class="w-full pl-10 pr-sm py-3 sm:py-sm border @error('identifier') border-error @else border-surface-variant @enderror rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="identifier" name="identifier" value="{{ old('identifier') }}" placeholder="Masukkan Email" type="text" autocomplete="username" required/>
                </div>
            </div>

            <div class="flex flex-col space-y-xs">
                <label class="font-label-md text-label-md text-on-surface" for="password">Password</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-secondary-fixed-dim" data-icon="lock">lock</span>
                    <input class="w-full pl-10 pr-10 py-3 sm:py-sm border @error('password') border-error @else border-surface-variant @enderror rounded-lg font-body-md text-body-md text-on-surface bg-surface-bright focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="password" name="password" placeholder="Masukkan Password" type="password" autocomplete="current-password" required/>
                    
                    <button class="absolute right-3 text-secondary hover:text-primary transition-colors flex items-center justify-center bg-transparent border-0 p-0" type="button" onclick="const p = document.getElementById('password'); p.type = p.type === 'password' ? 'text' : 'password';">
                        <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                    </button>
                </div>
            </div>

            <div class="pt-base flex flex-col items-center gap-4">
                <button class="w-full bg-primary-container text-on-primary font-label-md text-label-md py-3 sm:py-sm rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-200 flex items-center justify-center gap-2" type="submit">
                    Masuk
                    <span class="material-symbols-outlined text-[18px]" data-icon="login">login</span>
                </button>
                
                <a class="font-label-md text-label-md text-primary hover:underline transition-colors" href="{{ route('forgetpw') }}">Lupa Password?</a>
            </div>
        </form>

        <div class="mt-md text-center">
            <p class="font-body-md text-body-md text-secondary">
                Belum punya akun? 
                <a class="text-primary font-medium hover:underline p-2 -m-2 inline-block" href="{{ route('register') }}">Daftar</a>
            </p>
        </div>

    </div>
</main>
@endsection