<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - NEP Mini Soccer</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary": "#ffffff",
                        "surface-bright": "#f8f9fa",
                        "surface-container": "#edeeef",
                        "on-primary-fixed": "#002106",
                        "background": "#f8f9fa",
                        "on-secondary-fixed-variant": "#43474c",
                        "secondary": "#5b5f63",
                        "on-tertiary-container": "#5b0025",
                        "on-primary-container": "#00330d",
                        "surface-container-high": "#e7e8e9",
                        "tertiary-container": "#ee6189",
                        "surface": "#f8f9fa",
                        "secondary-container": "#dde0e5",
                        "secondary-fixed": "#e0e3e8",
                        "primary-fixed-dim": "#66df75",
                        "surface-variant": "#e1e3e4",
                        "on-surface-variant": "#3e4a3c",
                        "secondary-fixed-dim": "#c3c7cc",
                        "on-error-container": "#93000a",
                        "tertiary-fixed": "#ffd9df",
                        "on-secondary-fixed": "#181c20",
                        "on-secondary-container": "#5f6368",
                        "on-tertiary-fixed-variant": "#8b1140",
                        "tertiary-fixed-dim": "#ffb1c1",
                        "primary-container": "#28a745",
                        "outline": "#6e7b6b",
                        "inverse-surface": "#2e3132",
                        "on-primary-fixed-variant": "#00531a",
                        "on-secondary": "#ffffff",
                        "surface-container-highest": "#e1e3e4",
                        "surface-container-lowest": "#ffffff",
                        "surface-dim": "#d9dadb",
                        "on-background": "#191c1d",
                        "primary": "#006e25",
                        "tertiary": "#ab2d57",
                        "primary-fixed": "#83fc8e",
                        "surface-tint": "#006e25",
                        "on-primary": "#ffffff",
                        "error": "#ba1a1a",
                        "outline-variant": "#bdcab9",
                        "surface-container-low": "#f3f4f5",
                        "inverse-on-surface": "#f0f1f2",
                        "on-error": "#ffffff",
                        "inverse-primary": "#66df75",
                        "on-tertiary-fixed": "#3f0018",
                        "on-surface": "#191c1d",
                        "error-container": "#ffdad6"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xl": "80px",
                        "gutter": "24px",
                        "lg": "48px",
                        "base": "8px",
                        "xs": "4px",
                        "md": "24px",
                        "container-max": "1200px",
                        "sm": "12px"
                    },
                    "fontFamily": {
                        "headline-lg-mobile": ["Inter"],
                        "label-sm": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "headline-sm": ["Inter"],
                        "body-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "display-lg": ["Inter"],
                        "headline-md": ["Inter"]
                    },
                    "fontSize": {
                        "headline-lg-mobile": ["28px", { "lineHeight": "1.3", "fontWeight": "700" }],
                        "label-sm": ["12px", { "lineHeight": "1.2", "fontWeight": "500" }],
                        "label-md": ["14px", { "lineHeight": "1.2", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "headline-sm": ["20px", { "lineHeight": "1.4", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "body-md": ["16px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "display-lg": ["48px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-md": ["24px", { "lineHeight": "1.4", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-surface-container-low min-h-screen flex flex-col justify-center items-center py-md sm:py-lg">
    <main class="w-full max-w-lg px-4 sm:px-gutter">
        <div class="bg-surface-container-lowest rounded-xl shadow-[0_12px_24px_rgba(0,0,0,0.1)] p-6 sm:p-lg flex flex-col">
            
            <div class="text-center mb-md">
                <h1 class="font-headline-lg-mobile sm:font-headline-lg text-headline-lg-mobile sm:text-headline-lg text-primary mb-sm">NEP Mini Soccer</h1>
                <h2 class="font-headline-sm sm:font-headline-md text-headline-sm sm:text-headline-md text-on-surface">Selamat datang</h2>
                <p class="font-body-md text-body-md text-secondary mt-base">Masuk untuk memesan pertandingan Anda berikutnya</p>
            </div>

            <form class="flex flex-col space-y-md" method="post" action="/login">
                @csrf

                @if($errors->any())
                    <div class="px-sm py-3 rounded-lg bg-error-container text-on-error-container border border-error flex items-center gap-2 shadow-[0_2px_4px_rgba(33,37,41,0.05)]">
                        <span class="material-symbols-outlined text-[20px]" data-icon="error">error</span>
                        <span class="font-body-md text-sm">Email atau Password yang Anda masukkan salah.</span>
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
                        <button class="absolute right-3 text-secondary hover:text-primary transition-colors flex items-center justify-center bg-transparent border-0 p-0" type="button">
                            <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                        </button>
                    </div>
                </div>

                <div class="pt-base flex flex-col items-center gap-4">
                    <button class="w-full bg-primary-container text-on-primary font-label-md text-label-md py-3 sm:py-sm rounded-lg shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-200 flex items-center justify-center gap-2" type="submit">
                        Masuk
                        <span class="material-symbols-outlined text-[18px]" data-icon="login">login</span>
                    </button>
                    
                    <a class="font-label-md text-label-md text-primary hover:underline transition-colors" href="forgetpw">Lupa Password?</a>
                </div>
            </form>

            <div class="mt-md text-center">
                <p class="font-body-md text-body-md text-secondary">
                    Tidak mempunyai akun? 
                    <a class="text-primary font-medium hover:underline p-2 -m-2 inline-block" href="register">Daftar</a>
                </p>
            </div>

        </div>
    </main>
</body>
</html>