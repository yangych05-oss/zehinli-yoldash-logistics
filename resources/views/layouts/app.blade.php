<!doctype html>
<html lang="{{ app()->getLocale() }}">
@php
    $supportedLocales = ['en', 'ru', 'tm'];
    $siteSettings = array_merge(
        site_setting_defaults(),
        is_array($siteSettings ?? null) ? $siteSettings : []
    );
    $companyName = $siteSettings['company_name'] ?? 'ZNY LOGISTICS';

    $segments = request()->segments();
    if (isset($segments[0]) && in_array($segments[0], $supportedLocales, true)) {
        array_shift($segments);
    }
    $localizedPath = implode('/', $segments);
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $companyName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --zny-bg-start: #f7faff;
            --zny-bg-mid: #f1f5fc;
            --zny-bg-end: #eef3fb;
            --zny-surface: rgba(255, 255, 255, 0.88);
            --zny-surface-strong: rgba(255, 255, 255, 0.96);
            --zny-border: rgba(17, 45, 95, 0.12);
            --zny-ink: #0b1d3c;
            --zny-muted: #5b6d8d;
            --zny-primary: #0f3d96;
            --zny-accent: #22a6fb;
            --zny-shadow-lg: 0 24px 56px rgba(9, 26, 60, 0.14);
            --zny-shadow-md: 0 16px 38px rgba(9, 24, 53, 0.11);
        }

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            font-family: Inter, "SF Pro Display", "Segoe UI", Roboto, system-ui, -apple-system, sans-serif;
            color: var(--zny-ink);
            line-height: 1.5;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            background:
                radial-gradient(circle at 10% 0%, rgba(34, 166, 251, 0.14), transparent 34%),
                radial-gradient(circle at 90% 2%, rgba(15, 61, 150, 0.12), transparent 38%),
                linear-gradient(180deg, var(--zny-bg-start) 0%, var(--zny-bg-mid) 44%, var(--zny-bg-end) 100%);
        }

        .zny-shell {
            min-height: 100vh;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.58), rgba(255, 255, 255, 0.3));
        }

        .zny-glass-nav {
            border-bottom: 1px solid rgba(8, 26, 56, 0.1);
            background: linear-gradient(128deg, rgba(255, 255, 255, 0.93), rgba(255, 255, 255, 0.77));
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .zny-header-brand,
        .zny-brand-link {
            display: inline-flex;
            align-items: center;
            gap: 0.9rem;
            min-width: 0;
            text-decoration: none;
        }

        .zny-header-logo-wrap,
        .zny-brand-logo-wrap {
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 14px;
            border: 1px solid rgba(16, 53, 124, 0.18);
            background: linear-gradient(155deg, rgba(255, 255, 255, 0.96), rgba(232, 243, 255, 0.86));
            box-shadow: var(--zny-shadow-md);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .zny-header-logo-wrap { width: 60px; height: 60px; }
        .zny-brand-logo-wrap { width: 48px; height: 48px; }
        .zny-header-logo { width: auto; height: 52px; object-fit: contain; }
        .zny-brand-logo { max-width: 34px; max-height: 34px; object-fit: contain; }

        .zny-header-brand:hover .zny-header-logo-wrap,
        .zny-brand-link:hover .zny-brand-logo-wrap {
            transform: translateY(-2px);
            box-shadow: 0 18px 36px rgba(8, 26, 56, 0.18);
        }

        .zny-header-brand-title {
            font-size: 1.05rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            color: #081a37;
            white-space: nowrap;
        }

        .zny-header-brand-subtitle,
        .zny-brand-subtitle {
            margin-top: 0.14rem;
            font-size: 0.68rem;
            font-weight: 640;
            letter-spacing: 0.11em;
            text-transform: uppercase;
            color: #607191;
            white-space: nowrap;
        }

        .zny-brand-title {
            font-size: 0.95rem;
            font-weight: 760;
            letter-spacing: 0.07em;
            color: #f5f8ff;
        }

        .zny-nav-link {
            position: relative;
            color: #2d4469;
            transition: color 0.22s ease;
        }

        .zny-nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            right: 100%;
            bottom: -8px;
            height: 2px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--zny-primary), var(--zny-accent));
            transition: right 0.24s ease;
        }

        .zny-nav-link:hover,
        .zny-nav-link[aria-current="page"] { color: var(--zny-primary); }

        .zny-nav-link:hover::after,
        .zny-nav-link[aria-current="page"]::after { right: 0; }

        .zny-card {
            border-radius: 1.5rem;
            border: 1px solid var(--zny-border);
            background: var(--zny-surface-strong);
            box-shadow: var(--zny-shadow-lg);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .zny-soft-card {
            border-radius: 1.35rem;
            border: 1px solid rgba(255, 255, 255, 0.38);
            background: linear-gradient(150deg, rgba(255, 255, 255, 0.82), rgba(246, 250, 255, 0.68));
            box-shadow: var(--zny-shadow-md);
        }

        .zny-label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .zny-primary-btn,
        .zny-secondary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            font-weight: 700;
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease, background 0.25s ease;
        }

        .zny-primary-btn {
            padding: 0.88rem 1.45rem;
            font-size: 0.91rem;
            color: #fff;
            background: linear-gradient(134deg, var(--zny-primary), var(--zny-accent));
            box-shadow: 0 18px 34px rgba(15, 63, 147, 0.28);
        }

        .zny-primary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 22px 40px rgba(15, 63, 147, 0.32);
        }

        .zny-secondary-btn {
            padding: 0.88rem 1.45rem;
            font-size: 0.91rem;
            color: #15356f;
            border: 1px solid rgba(16, 57, 133, 0.2);
            background: rgba(255, 255, 255, 0.82);
        }

        .zny-secondary-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(16, 57, 133, 0.34);
            background: #fff;
        }

        .zny-input {
            width: 100%;
            padding: 0.78rem 0.9rem;
            border-radius: 0.9rem;
            border: 1px solid rgba(16, 45, 102, 0.16);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.97), rgba(246, 250, 255, 0.95));
            font-size: 0.95rem;
            color: #0f2144;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .zny-input:focus {
            outline: none;
            border-color: rgba(20, 76, 171, 0.56);
            box-shadow: 0 0 0 4px rgba(40, 135, 255, 0.12);
        }

        .zny-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.09);
            background: linear-gradient(126deg, #010b1f, #071936 50%, #0a2d66 100%);
        }

        .zny-floating-actions {
            position: fixed;
            right: 1.25rem;
            bottom: max(1.2rem, env(safe-area-inset-bottom));
            z-index: 60;
            pointer-events: none;
        }

        .zny-floating-whatsapp {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            pointer-events: auto;
            min-width: 3.95rem;
            height: 3.95rem;
            padding: 0 1rem;
            border-radius: 999px;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.62);
            background: radial-gradient(circle at 30% 24%, #67f6b4 0%, #27cb69 52%, #129248 100%);
            box-shadow:
                0 22px 46px rgba(8, 26, 52, 0.36),
                0 0 0 1px rgba(22, 156, 75, 0.46) inset,
                0 0 30px rgba(37, 211, 102, 0.22);
            transition: transform 0.28s ease, box-shadow 0.28s ease, filter 0.28s ease;
        }

        .zny-floating-whatsapp::before {
            content: '';
            position: absolute;
            inset: -10px;
            z-index: -1;
            border-radius: inherit;
            opacity: 0.9;
            background: radial-gradient(circle, rgba(37, 211, 102, 0.32) 0%, rgba(37, 211, 102, 0) 70%);
            transition: transform 0.28s ease, opacity 0.28s ease;
        }

        .zny-floating-whatsapp:hover {
            transform: translateY(-4px) scale(1.02);
            filter: saturate(1.05);
            box-shadow:
                0 26px 52px rgba(8, 26, 52, 0.4),
                0 0 0 1px rgba(115, 242, 166, 0.52) inset,
                0 0 36px rgba(37, 211, 102, 0.26);
        }

        .zny-floating-whatsapp:hover::before {
            transform: scale(1.05);
            opacity: 1;
        }

        .zny-floating-whatsapp:focus-visible {
            outline: 2px solid #fff;
            outline-offset: 3px;
        }

        .zny-floating-whatsapp-text {
            font-size: 0.73rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .zny-floating-label {
            position: absolute;
            width: 1px;
            height: 1px;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        @media (max-width: 1024px) {
            .zny-floating-actions {
                left: 1rem;
                right: auto;
                bottom: calc(max(1rem, env(safe-area-inset-bottom)) + 5rem);
            }
        }

        @media (max-width: 768px) {
            .zny-header-logo-wrap { width: 52px; height: 52px; border-radius: 13px; }
            .zny-header-logo { height: 44px; }
            .zny-header-brand-title { font-size: 0.94rem; letter-spacing: 0.04em; }
            .zny-header-brand-subtitle { font-size: 0.61rem; }

            .zny-floating-whatsapp {
                width: 3.32rem;
                height: 3.32rem;
                min-width: 3.32rem;
                padding: 0;
            }

            .zny-floating-whatsapp-text { display: none; }
        }
    </style>
</head>
<body>
<div class="zny-shell">
    <header class="sticky top-0 z-40 zny-glass-nav">
        <div class="max-w-7xl mx-auto px-4 py-3.5 flex flex-wrap items-center justify-between gap-4">
            <a href="/{{ app()->getLocale() }}" class="zny-header-brand">
                <span class="zny-header-logo-wrap">
                    <img src="{{ asset('images/logo_clean.png') }}" alt="{{ $companyName }}" class="zny-header-logo">
                </span>
                <div class="min-w-0 leading-tight">
                    <div class="zny-header-brand-title">{{ $companyName }}</div>
                    <div class="zny-header-brand-subtitle">Enterprise Freight Governance</div>
                </div>
            </a>

            <nav class="flex flex-wrap items-center gap-4 md:gap-5 text-sm font-semibold">
                <a href="/{{ app()->getLocale() }}" class="zny-nav-link" @if(request()->routeIs('home')) aria-current="page" @endif>{{ __('messages.nav_home') }}</a>
                <a href="/{{ app()->getLocale() }}/about" class="zny-nav-link" @if(request()->routeIs('about')) aria-current="page" @endif>{{ __('messages.nav_about') }}</a>
                <a href="/{{ app()->getLocale() }}/services" class="zny-nav-link" @if(request()->routeIs('services')) aria-current="page" @endif>{{ __('messages.nav_services') }}</a>
                <a href="/{{ app()->getLocale() }}/tracking" class="zny-nav-link" @if(request()->routeIs('tracking')) aria-current="page" @endif>{{ __('messages.nav_tracking') }}</a>
                <a href="/{{ app()->getLocale() }}/contact" class="zny-nav-link" @if(request()->routeIs('contact')) aria-current="page" @endif>{{ __('messages.nav_contact') }}</a>
            </nav>

            <div class="flex items-center gap-3">
                <div class="rounded-full border border-slate-200 p-1 text-xs font-semibold uppercase tracking-wide bg-white/80 backdrop-blur-sm">
                    @foreach($supportedLocales as $lang)
                        <a href="/{{ $lang }}{{ $localizedPath ? '/' . $localizedPath : '' }}" class="px-2 py-1 rounded-full {{ app()->getLocale() === $lang ? 'bg-slate-900 text-white' : 'text-slate-600 hover:text-slate-900' }}">{{ $lang }}</a>
                    @endforeach
                </div>
                <a href="/{{ app()->getLocale() }}/contact" class="zny-primary-btn !px-4 !py-2 !text-xs sm:!text-sm">Request a Quote</a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-10 relative z-10">
        @if(session('status'))
            <div class="mb-6 rounded-xl border border-emerald-300 bg-emerald-50 p-4 text-emerald-800">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>

    <footer class="mt-20 zny-footer text-slate-200">
        <div class="max-w-7xl mx-auto px-4 py-14 grid md:grid-cols-3 gap-9 text-sm">
            <div>
                <a href="/{{ app()->getLocale() }}" class="zny-brand-link mb-4">
                    <span class="zny-brand-logo-wrap !w-11 !h-11 !rounded-xl !bg-white/10 !border-white/10 !shadow-none">
                        <img src="{{ asset('images/logo_clean.png') }}" alt="{{ $companyName }} logo" class="zny-brand-logo">
                    </span>
                    <div>
                        <p class="zny-brand-title">{{ $companyName }}</p>
                        <p class="text-slate-300 text-xs">{{ site_setting('company_domain', 'znylogistic.com') }}</p>
                    </div>
                </a>
                <p class="text-slate-300/90 leading-relaxed">International logistics engineered for predictable outcomes, strict control, and long-term enterprise trust.</p>
            </div>

            <div>
                <p class="font-semibold text-white mb-3 tracking-wide uppercase text-xs">Direct Lines</p>
                <div class="space-y-2 text-slate-300">
                    <p>{{ site_setting('phone_primary') }}</p>
                    @if(!empty($siteSettings['phone_secondary']))
                        <p>{{ $siteSettings['phone_secondary'] }}</p>
                    @endif
                    <p>{{ site_setting('email_primary') }}</p>
                    @if(site_setting('email_secondary'))
                        <p>{{ site_setting('email_secondary') }}</p>
                    @endif
                    <p class="pt-2 text-slate-400">{{ site_setting('address') }}</p>
                </div>
            </div>

            <div class="md:text-right">
                <p class="font-semibold text-white text-base">Enterprise support with accountable execution.</p>
                <p class="text-slate-300 mt-2 leading-relaxed">From first booking to final delivery, every shipment is managed with milestone discipline and transparent communication.</p>
            </div>
        </div>
    </footer>

    <div class="zny-floating-actions" aria-label="Quick communication shortcuts">
        <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" class="zny-floating-whatsapp" aria-label="Contact ZNY Logistics via WhatsApp">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                <path d="M20.5 3.5A11.89 11.89 0 0 0 12.05 0C5.48 0 .14 5.35.14 11.94c0 2.1.55 4.15 1.6 5.96L0 24l6.3-1.66a11.86 11.86 0 0 0 5.73 1.46h.01c6.57 0 11.91-5.35 11.91-11.94 0-3.2-1.24-6.22-3.45-8.36ZM12.04 21.8h-.01a9.86 9.86 0 0 1-5.02-1.37l-.36-.22-3.74.98 1-3.65-.24-.37a9.91 9.91 0 0 1-1.52-5.23c0-5.47 4.44-9.93 9.91-9.93 2.65 0 5.14 1.03 7.01 2.91a9.86 9.86 0 0 1 2.89 7.01c0 5.47-4.44 9.92-9.92 9.92Zm5.44-7.42c-.3-.15-1.76-.87-2.04-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.95 1.16-.17.2-.35.22-.65.08-.3-.15-1.26-.46-2.4-1.47-.88-.78-1.47-1.75-1.64-2.04-.17-.3-.02-.46.12-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.48-.5-.67-.51h-.57c-.2 0-.52.08-.8.37-.27.3-1.04 1.02-1.04 2.5s1.07 2.9 1.22 3.1c.15.2 2.1 3.2 5.1 4.49.72.31 1.28.5 1.72.63.72.23 1.38.2 1.9.12.58-.09 1.76-.72 2-1.42.25-.7.25-1.3.17-1.42-.07-.13-.27-.2-.57-.35Z"/>
            </svg>
            <span class="zny-floating-whatsapp-text">WhatsApp</span>
            <span class="zny-floating-label">WhatsApp</span>
        </a>
    </div>
</div>

<script>
    (function () {
        const actions = document.querySelector('.zny-floating-actions');
        if (!actions) return;

        const recalculateOffset = function () {
            const isTabletDown = window.matchMedia('(max-width: 1024px)').matches;
            const baseSpacing = isTabletDown ? 104 : 28;
            const extraGap = isTabletDown ? 16 : 24;

            let safeBottom = baseSpacing;
            let safeRight = isTabletDown ? null : 20;

            const tawkTargets = [
                '#tawkchat-minified-iframe-element',
                '#tawkchat-container iframe',
                'iframe[title*="tawk"]',
                'iframe[title*="chat"]',
                'iframe[title*="Chat"]'
            ];

            for (const selector of tawkTargets) {
                const chatEl = document.querySelector(selector);
                if (!chatEl) continue;

                const rect = chatEl.getBoundingClientRect();
                if (rect.width === 0 || rect.height === 0) continue;

                const occupiedFromBottom = Math.max(0, window.innerHeight - rect.top);
                safeBottom = Math.max(safeBottom, occupiedFromBottom + extraGap);

                if (!isTabletDown && rect.right >= window.innerWidth - 4) {
                    safeRight = Math.max(safeRight || 20, Math.ceil(rect.width + 24));
                }
            }

            actions.style.bottom = `${Math.ceil(safeBottom)}px`;

            if (isTabletDown) {
                actions.style.left = '1rem';
                actions.style.right = 'auto';
                return;
            }

            actions.style.left = 'auto';
            actions.style.right = `${safeRight || 20}px`;
        };

        recalculateOffset();
        window.addEventListener('resize', recalculateOffset);
        setInterval(recalculateOffset, 1400);
    })();
</script>

@if(!empty($siteSettings['live_chat_enabled']) && !empty($siteSettings['live_chat_src']))
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement('script'), s0 = document.getElementsByTagName('script')[0];
        s1.async = true;
        s1.src = '{{ $siteSettings['live_chat_src'] ?? '' }}';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
@endif
</body>
</html>
