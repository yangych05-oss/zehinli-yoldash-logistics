<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ZNY LOGISTICS') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --zny-page: #f2f5fb;
            --zny-surface: rgba(255, 255, 255, 0.88);
            --zny-surface-strong: rgba(255, 255, 255, 0.95);
            --zny-ink: #0c1a33;
            --zny-muted: #5d6d89;
            --zny-border: rgba(20, 42, 89, 0.12);
            --zny-primary: #0d2f74;
            --zny-accent: #27a7ff;
            --zny-shadow: 0 26px 56px rgba(10, 26, 56, 0.12);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            font-family: Inter, "SF Pro Display", "Segoe UI", Roboto, system-ui, -apple-system, sans-serif;
            color: var(--zny-ink);
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            background:
                radial-gradient(circle at 8% 0%, rgba(39,167,255,.14), transparent 34%),
                radial-gradient(circle at 92% 1%, rgba(18,53,122,.12), transparent 38%),
                linear-gradient(180deg, #f7faff 0%, var(--zny-page) 46%, #f3f7fc 100%);
        }

        .zny-shell {
            background: linear-gradient(180deg, rgba(255,255,255,.55), rgba(255,255,255,.35));
            min-height: 100vh;
        }

        .zny-glass-nav {
            border-bottom: 1px solid rgba(10, 23, 53, .09);
            background: linear-gradient(130deg, rgba(255,255,255,.88), rgba(255,255,255,.75));
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .zny-header-brand,
        .zny-brand-link { display: inline-flex; align-items: center; gap: .9rem; text-decoration: none; min-width: 0; }

        .zny-header-logo-wrap,
        .zny-brand-logo-wrap {
            display: grid;
            place-items: center;
            border: 1px solid rgba(18, 57, 131, .15);
            background: linear-gradient(150deg, rgba(255,255,255,.96), rgba(232,242,255,.84));
            box-shadow: 0 16px 34px rgba(10, 27, 56, .14);
            transition: transform .2s ease, box-shadow .2s ease;
            flex-shrink: 0;
            border-radius: 15px;
        }

        .zny-header-logo-wrap { width: 60px; height: 60px; }
        .zny-brand-logo-wrap { width: 48px; height: 48px; }
        .zny-header-logo { height: 52px; width: auto; object-fit: contain; }
        .zny-brand-logo { max-width: 34px; max-height: 34px; object-fit: contain; }

        .zny-header-brand:hover .zny-header-logo-wrap,
        .zny-brand-link:hover .zny-brand-logo-wrap { transform: translateY(-2px); box-shadow: 0 20px 40px rgba(10, 27, 56, .16); }

        .zny-header-brand-title { font-size: 1.04rem; font-weight: 800; letter-spacing: .06em; color: #08152d; white-space: nowrap; }
        .zny-header-brand-subtitle,
        .zny-brand-subtitle { margin-top: .14rem; font-size: .68rem; text-transform: uppercase; letter-spacing: .11em; color: #5f7090; font-weight: 620; white-space: nowrap; }
        .zny-brand-title { font-size: .95rem; letter-spacing: .07em; font-weight: 760; color: #f4f8ff; }

        .zny-nav-link { position: relative; color: #2f456a; transition: color .22s ease; }
        .zny-nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            right: 100%;
            bottom: -8px;
            height: 2px;
            border-radius: 999px;
            background: linear-gradient(90deg, #0f3992, #1ca7ff);
            transition: right .24s ease;
        }
        .zny-nav-link:hover,
        .zny-nav-link[aria-current="page"] { color: #123f93; }
        .zny-nav-link:hover::after,
        .zny-nav-link[aria-current="page"]::after { right: 0; }

        .zny-card {
            border-radius: 1.5rem;
            border: 1px solid var(--zny-border);
            background: var(--zny-surface-strong);
            box-shadow: var(--zny-shadow);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .zny-soft-card {
            border-radius: 1.35rem;
            border: 1px solid rgba(255,255,255,.36);
            background: linear-gradient(150deg, rgba(255,255,255,.78), rgba(247,251,255,.64));
            box-shadow: 0 16px 36px rgba(9, 24, 53, .10);
        }

        .zny-label {
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        .zny-primary-btn,
        .zny-secondary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            font-weight: 700;
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease, background .25s ease;
        }

        .zny-primary-btn {
            padding: .88rem 1.45rem;
            font-size: .91rem;
            color: #fff;
            background: linear-gradient(134deg, #0f3e9b, #1ca8ff);
            box-shadow: 0 18px 34px rgba(15, 63, 147, .26);
        }

        .zny-primary-btn:hover { transform: translateY(-2px); box-shadow: 0 22px 40px rgba(15, 63, 147, .31); }

        .zny-secondary-btn {
            padding: .88rem 1.45rem;
            font-size: .91rem;
            color: #15356f;
            border: 1px solid rgba(16, 57, 133, .2);
            background: rgba(255,255,255,.82);
        }

        .zny-secondary-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(16, 57, 133, .34);
            background: #fff;
        }

        .zny-input {
            width: 100%;
            border-radius: .9rem;
            border: 1px solid rgba(16, 45, 102, .16);
            background: linear-gradient(180deg, rgba(255,255,255,.97), rgba(246,250,255,.95));
            padding: .78rem .9rem;
            font-size: .95rem;
            color: #0f2144;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .zny-input:focus {
            outline: none;
            border-color: rgba(20, 76, 171, .56);
            box-shadow: 0 0 0 4px rgba(40, 135, 255, .12);
        }

        .zny-footer {
            background: linear-gradient(128deg, #020d24, #071834 46%, #0b2a5f 100%);
            border-top: 1px solid rgba(255,255,255,.09);
        }

        .zny-floating-actions {
            position: fixed;
            right: 1.2rem;
            bottom: max(1.2rem, env(safe-area-inset-bottom));
            z-index: 60;
            pointer-events: none;
        }

        .zny-floating-whatsapp {
            pointer-events: auto;
            position: relative;
            width: 3.9rem;
            height: 3.9rem;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: radial-gradient(circle at 30% 24%, #61f4b0 0%, #28cd6b 50%, #14964a 100%);
            border: 1px solid rgba(255,255,255,.58);
            box-shadow: 0 20px 42px rgba(8, 26, 52, .35), 0 0 0 1px rgba(22, 156, 75, .44) inset;
            transition: transform .28s ease, box-shadow .28s ease;
        }

        .zny-floating-whatsapp::before {
            content: '';
            position: absolute;
            inset: -10px;
            border-radius: inherit;
            background: radial-gradient(circle, rgba(37, 211, 102, .32) 0%, rgba(37, 211, 102, 0) 70%);
            z-index: -1;
            opacity: .92;
            transition: transform .28s ease, opacity .28s ease;
        }

        .zny-floating-whatsapp:hover {
            transform: translateY(-4px) scale(1.04);
            box-shadow: 0 24px 44px rgba(8, 26, 52, .38), 0 0 0 1px rgba(101, 238, 157, .46) inset;
        }

        .zny-floating-whatsapp:hover::before { transform: scale(1.04); opacity: 1; }
        .zny-floating-whatsapp:focus-visible { outline: 2px solid #fff; outline-offset: 3px; }

        .zny-floating-label {
            position: absolute;
            width: 1px;
            height: 1px;
            margin: -1px;
            overflow: hidden;
            clip: rect(0,0,0,0);
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
            .zny-header-brand-title { font-size: .94rem; letter-spacing: .04em; }
            .zny-header-brand-subtitle { font-size: .61rem; }
            .zny-floating-whatsapp { width: 3.32rem; height: 3.32rem; }
        }
    </style>
</head>
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
                <div class="zny-header-brand-subtitle">International Freight Systems</div>
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
            <p class="text-slate-300/90 leading-relaxed">Precision-driven multimodal logistics for international supply chains.</p>
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
            <p class="font-semibold text-white text-base">Trusted by teams that run on certainty.</p>
            <p class="text-slate-300 mt-2 leading-relaxed">Rapid response, disciplined execution, and clear communication from booking to final delivery.</p>
        </div>
    </div>
</footer>

<div class="zny-floating-actions" aria-label="Quick communication shortcuts">
    <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" class="zny-floating-whatsapp" aria-label="Contact ZNY Logistics via WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor">
            <path d="M20.5 3.5A11.89 11.89 0 0 0 12.05 0C5.48 0 .14 5.35.14 11.94c0 2.1.55 4.15 1.6 5.96L0 24l6.3-1.66a11.86 11.86 0 0 0 5.73 1.46h.01c6.57 0 11.91-5.35 11.91-11.94 0-3.2-1.24-6.22-3.45-8.36ZM12.04 21.8h-.01a9.86 9.86 0 0 1-5.02-1.37l-.36-.22-3.74.98 1-3.65-.24-.37a9.91 9.91 0 0 1-1.52-5.23c0-5.47 4.44-9.93 9.91-9.93 2.65 0 5.14 1.03 7.01 2.91a9.86 9.86 0 0 1 2.89 7.01c0 5.47-4.44 9.92-9.92 9.92Zm5.44-7.42c-.3-.15-1.76-.87-2.04-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.95 1.16-.17.2-.35.22-.65.08-.3-.15-1.26-.46-2.4-1.47-.88-.78-1.47-1.75-1.64-2.04-.17-.3-.02-.46.12-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.48-.5-.67-.51h-.57c-.2 0-.52.08-.8.37-.27.3-1.04 1.02-1.04 2.5s1.07 2.9 1.22 3.1c.15.2 2.1 3.2 5.1 4.49.72.31 1.28.5 1.72.63.72.23 1.38.2 1.9.12.58-.09 1.76-.72 2-1.42.25-.7.25-1.3.17-1.42-.07-.13-.27-.2-.57-.35Z"/>
        </svg>
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
        const minBottom = isTabletDown ? 96 : 20;
        const safeAreaBottom = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('env(safe-area-inset-bottom)')) || 0;

        let safeBottom = Math.max(baseSpacing, minBottom + safeAreaBottom);
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
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='{{ $siteSettings['live_chat_src'] ?? '' }}';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
@endif
</body>
</html>
