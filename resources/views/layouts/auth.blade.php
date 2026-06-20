<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'NEP Mini Soccer')</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
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
    <style type="text/tailwindcss">
        @layer utilities {
            .hide-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .hide-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-surface-container-low min-h-screen flex flex-col justify-center items-center py-md sm:py-lg text-on-surface font-body-md text-body-md antialiased">

    @yield('content')

    @stack('scripts')
</body>
</html>
