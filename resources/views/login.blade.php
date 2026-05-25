<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login - NEP Mini Soccer</title>
<!-- Material Symbols Outlined -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<!-- Tailwind CSS Script -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Theme Configuration -->
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
                    "headline-lg-mobile": ["28px", {"lineHeight": "1.3", "fontWeight": "700"}],
                    "label-sm": ["12px", {"lineHeight": "1.2", "fontWeight": "500"}],
                    "label-md": ["14px", {"lineHeight": "1.2", "fontWeight": "600"}],
                    "headline-lg": ["32px", {"lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                    "headline-sm": ["20px", {"lineHeight": "1.4", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "display-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "600"}]
            }
          }
        }
      }
    </script>
<style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface min-vh-100 position-relative d-flex align-items-center justify-content-center p-3 p-md-4 p-lg-5">
<!-- Background Image with Overlay -->
<div class="position-absolute top-0 start-0 w-100 h-100 z-0">
<img alt="Mini soccer field background" class="w-100 h-100 object-fit-cover" data-alt="A stunning, high-definition photograph of an empty mini soccer pitch under bright, natural daylight. The vibrant, fresh green artificial turf is perfectly maintained with crisp white penalty lines. The lighting is high-key and modern, creating a welcoming and energetic atmosphere typical of a premium sports facility. The scene is shot from a slightly elevated angle, providing a clean and minimal backdrop that aligns with a bright, professional SaaS interface aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCClFhdoWyfShVZMWsuPh4E3hjXHFawLEL1HefPRAWSKhcaJw-MGK3tw-BDUac0Yz2dmMWWUvNxZbkrxWS0xNVbQH0bag19h52ywxDYvH9QK9bUgAK0Rq9Ckcw_ESYnBSt0Q4hhPKhSv60rRys4l4zLiyAU76dzpO7Tx52LrS29M8OsqIGGtXrKNIJpCTkcTybgp_o7VLvO1AGv7vLzGwdnRyvtjN0x7WqOtNw1YUNKM8YrWQMsH7QKgCfbyGSZQO_7PJ5MBFDw0sh2"/>
<!-- Subtle Split/Overlay effect to ensure form readability -->
<div class="position-absolute top-0 start-0 w-100 h-100 bg-surface/80 backdrop-blur-sm lg:bg-gradient-to-r lg:from-surface lg:via-surface/90 lg:to-surface/40"></div>
</div>
<!-- Login Card Container -->
<main class="position-relative z-10 bg-surface-container-lowest rounded-xl shadow-[0_12px_24px_rgba(0,0,0,0.1)] p-4 p-md-5 d-flex flex-column border border-surface-variant w-full max-w-lg mx-4 sm:mx-gutter">
<!-- Header Section -->
<div class="text-center mb-4 mb-md-5">
<h1 class="font-headline-md text-headline-md tracking-tight mb-2 text-primary-container">NEP Mini Soccer</h1>
<h2 class="font-headline-sm text-headline-sm text-on-surface mt-3">Welcome Back</h2>
<p class="font-body-md text-body-md text-secondary mt-2">Sign in to book your next match.</p>
</div>
<!-- Login Form -->
<form class="d-flex flex-column gap-3 gap-md-4" method="post" action="/login">
        @csrf
<!-- Email / WhatsApp Input -->
<div class="d-flex flex-column gap-2">
<label class="font-label-md text-label-md text-on-surface" for="identifier">Email or WhatsApp</label>
<div class="position-relative d-flex align-items-center">
<span class="material-symbols-outlined position-absolute ms-3 text-secondary-fixed-dim" data-icon="person">person</span>
<input class="w-100 ps-5 pe-3 py-2 rounded-lg border border-surface-variant bg-surface-bright font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="identifier" name="identifier" placeholder="Enter your email or phone number" type="text"/>
</div>
</div>
<!-- Password Input -->
<div class="d-flex flex-column gap-2">
<label class="font-label-md text-label-md text-on-surface" for="password">Password</label>
<div class="position-relative d-flex align-items-center">
<span class="material-symbols-outlined position-absolute ms-3 text-secondary-fixed-dim" data-icon="lock">lock</span>
<input class="w-100 ps-5 pe-5 py-2 rounded-lg border border-surface-variant bg-surface-bright font-body-md text-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors shadow-[0_2px_4px_rgba(33,37,41,0.05)]" id="password" name="password" placeholder="Enter your password" type="password"/>
<button class="position-absolute end-0 me-3 text-secondary hover:text-primary transition-colors d-flex align-items-center justify-content-center bg-transparent border-0 p-0" type="button">
<span class="material-symbols-outlined" data-icon="visibility">visibility</span>
</button>
</div>
</div>
<!-- Options Group (Remember Me & Forgot Password) -->
<div class="d-flex align-items-center justify-content-between pt-2">
<label class="d-flex align-items-center gap-2 cursor-pointer group mb-0">
<div class="position-relative d-flex align-items-center justify-content-center" style="width: 20px; height: 20px;">
<input class="peer position-absolute opacity-0 w-100 h-100 cursor-pointer m-0" type="checkbox"/>
<div class="w-100 h-100 rounded border border-surface-variant bg-surface-bright group-hover:border-primary transition-colors d-flex align-items-center justify-content-center">
<span class="material-symbols-outlined text-[16px] text-primary opacity-0 peer-checked:opacity-100 pointer-events-none" data-icon="check" style="font-variation-settings: 'wght' 600;">check</span>
</div>
</div>
<span class="font-body-md text-body-md text-secondary select-none">Remember Me</span>
</label>
<a class="font-label-md text-label-md text-primary text-decoration-none hover:text-primary-container transition-colors" href="forgetpw">Forgot Password?</a>
</div>
<!-- Submit Button -->
<div class="pt-3">
<button class="w-100 py-2 px-4 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md shadow-[0_2px_4px_rgba(33,37,41,0.05)] hover:shadow-[0_8px_16px_rgba(33,37,41,0.08)] transition-all duration-200 border-0 d-flex align-items-center justify-content-center gap-2" type="submit">
                    Login
                    <span class="material-symbols-outlined text-[18px]" data-icon="login">login</span>
</button>
</div>
</form>
<!-- Footer / Register Link -->
<div class="mt-4 mt-md-5 pt-3 pt-md-4 border-top border-surface-variant text-center">
<p class="font-body-md text-body-md text-secondary mb-0">
                Don't have an account? 
                <a class="font-label-md text-label-md text-primary text-decoration-none hover:text-primary-container transition-colors ms-2" href="register">Register here</a>
</p>
</div>
</main>
<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body></html>