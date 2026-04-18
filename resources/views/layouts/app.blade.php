<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ZNY LOGISTICS') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --zny-bg: #f4f7fd;
            --zny-text: #101a33;
            --zny-primary: #0f1f42;
            --zny-secondary: #123f93;
            --zny-accent: #37a9ff;
            --zny-card: rgba(255, 255, 255, 0.86);
            --zny-card-strong: rgba(255, 255, 255, 0.94);
            --zny-border: rgba(15, 40, 94, 0.12);
            --zny-shadow: 0 20px 44px rgba(8, 22, 48, 0.10);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: Inter, "SF Pro Display", "Segoe UI", Roboto, system-ui, -apple-system, sans-serif;
            background:
                radial-gradient(circle at 8% 7%, rgba(55,169,255,.18), transparent 35%),
                radial-gradient(circle at 92% 1%, rgba(19,63,147,.10), transparent 33%),
                linear-gradient(180deg, #f8fbff 0%, #f1f6ff 48%, #f5f8ff 100%);
            color: var(--zny-text);
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
        }

        .zny-glass-nav {
            border-bottom: 1px solid rgba(10, 24, 54, .08);
            background: linear-gradient(120deg, rgba(255,255,255,.84), rgba(255,255,255,.74));
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        .zny-header-brand,
        .zny-brand-link { display: inline-flex; align-items: center; gap: .85rem; text-decoration: none; min-width: 0; }

        .zny-header-logo-wrap,
        .zny-brand-logo-wrap {
            display: grid;
            place-items: center;
            border-radius: 15px;
            border: 1px solid rgba(19,57,130,.14);
            background: linear-gradient(150deg, rgba(255,255,255,.95), rgba(231,242,255,.82));
            box-shadow: 0 12px 30px rgba(8,20,43,.12);
            transition: transform .25s ease, box-shadow .25s ease;
            flex-shrink: 0;
        }

        .zny-header-logo-wrap { width: 62px; height: 62px; }
        .zny-brand-logo-wrap { width: 50px; height: 50px; }
        .zny-header-logo { height: 54px; width: auto; object-fit: contain; }
        .zny-brand-logo { max-width: 36px; max-height: 36px; object-fit: contain; }

        .zny-header-brand:hover .zny-header-logo-wrap,
        .zny-brand-link:hover .zny-brand-logo-wrap {
            transform: translateY(-2px);
            box-shadow: 0 15px 34px rgba(8,20,43,.15);
        }

        .zny-header-brand-title { font-size: 1.06rem; font-weight: 860; letter-spacing: .06em; color: #08152d; white-space: nowrap; }
        .zny-header-brand-subtitle,
        .zny-brand-subtitle { margin-top: .18rem; font-size: .69rem; text-transform: uppercase; letter-spacing: .10em; color: #54688d; font-weight: 620; white-space: nowrap; }
        .zny-brand-title { font-size: .98rem; letter-spacing: .08em; font-weight: 770; color: #f6f9ff; }

        .zny-nav-link { position: relative; color: #2b4268; transition: color .22s ease; }
        .zny-nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            right: 100%;
            bottom: -8px;
            height: 2px;
            border-radius: 999px;
            background: linear-gradient(90deg, #1346a0, #1aa4ff);
            transition: right .25s ease;
        }
        .zny-nav-link:hover,
        .zny-nav-link[aria-current="page"] { color: #123f93; }
        .zny-nav-link:hover::after,
        .zny-nav-link[aria-current="page"]::after { right: 0; }

        .zny-card {
            border-radius: 1.45rem;
            border: 1px solid var(--zny-border);
            background: var(--zny-card-strong);
            box-shadow: var(--zny-shadow);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .zny-soft-card {
            border-radius: 1.35rem;
            border: 1px solid rgba(255,255,255,.48);
            background: linear-gradient(150deg, rgba(255,255,255,.84), rgba(245,250,255,.68));
            box-shadow: 0 14px 34px rgba(7,22,49,.09);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .zny-pill {
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,.2);
            background: rgba(255,255,255,.09);
            padding: .46rem .84rem;
            font-size: .69rem;
            letter-spacing: .10em;
            text-transform: uppercase;
            font-weight: 700;
        }

        .zny-primary-btn,
        .zny-secondary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            font-weight: 700;
            transition: transform .24s ease, box-shadow .24s ease, border-color .24s ease, background .24s ease;
        }

        .zny-primary-btn {
            padding: .86rem 1.4rem;
            font-size: .9rem;
            color: #fff;
            background: linear-gradient(132deg, #123f93, #23a8ff);
            box-shadow: 0 16px 34px rgba(17, 62, 145, 0.29);
        }

        .zny-primary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 21px 42px rgba(17, 62, 145, 0.34);
        }

        .zny-secondary-btn {
            padding: .86rem 1.4rem;
            font-size: .9rem;
            color: #102a63;
            border: 1px solid rgba(16, 57, 133, 0.23);
            background: rgba(255,255,255,.78);
        }

        .zny-secondary-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(16, 57, 133, 0.36);
            background: #fff;
        }

        .zny-input {
            width: 100%;
            border-radius: .85rem;
            border: 1px solid rgba(16, 45, 102, .16);
            background: linear-gradient(180deg, rgba(255,255,255,.97), rgba(247,251,255,.95));
            padding: .72rem .86rem;
            font-size: .94rem;
            color: #10203e;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .zny-input:focus {
            outline: none;
            border-color: rgba(20, 76, 171, .56);
            box-shadow: 0 0 0 4px rgba(40, 135, 255, .12);
        }

        .zny-reveal { opacity: 0; animation: zny-fade-up .8s ease forwards; }
        .zny-reveal-delay-1 { animation-delay: .08s; }
        .zny-reveal-delay-2 { animation-delay: .18s; }
        .zny-reveal-delay-3 { animation-delay: .28s; }

        @keyframes zny-fade-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .zny-footer {
            background: linear-gradient(124deg, #030d23, #071837 48%, #0b2a62 100%);
            border-top: 1px solid rgba(255,255,255,.09);
        }

        .zny-floating-actions {
            position: fixed;
            right: 1.15rem;
            bottom: 8.6rem;
            z-index: 60;
            display: flex;
            align-items: flex-end;
            flex-direction: column;
            pointer-events: none;
        }

        .zny-floating-whatsapp {
            pointer-events: auto;
            position: relative;
            width: 3.75rem;
            height: 3.75rem;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: radial-gradient(circle at 30% 24%, #62f4b1 0%, #27cb69 48%, #149548 100%);
            border: 1px solid rgba(255,255,255,.56);
            box-shadow: 0 18px 38px rgba(10, 30, 56, 0.34), 0 0 0 1px rgba(22, 156, 75, 0.42) inset;
            transition: transform .28s ease, box-shadow .28s ease;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .zny-floating-whatsapp::before {
            content: '';
            position: absolute;
            inset: -9px;
            border-radius: inherit;
            background: radial-gradient(circle, rgba(37, 211, 102, 0.34) 0%, rgba(37, 211, 102, 0) 70%);
            z-index: -1;
            opacity: .9;
            transition: transform .24s ease, opacity .24s ease;
        }

        .zny-floating-whatsapp:hover {
            transform: translateY(-4px) scale(1.04);
            box-shadow: 0 24px 44px rgba(10, 30, 56, 0.38), 0 0 0 1px rgba(101, 238, 157, 0.42) inset;
        }
        .zny-floating-whatsapp:hover::before { transform: scale(1.03); opacity: 1; }
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
                align-items: flex-start;
                bottom: 6.2rem;
            }
        }

        @media (max-width: 768px) {
            .zny-header-logo-wrap { width: 52px; height: 52px; border-radius: 13px; }
            .zny-header-logo { height: 44px; }
            .zny-header-brand-title { font-size: .95rem; letter-spacing: .04em; }
            .zny-header-brand-subtitle { font-size: .62rem; }
            .zny-floating-whatsapp { width: 3.25rem; height: 3.25rem; }
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
<header class="sticky top-0 z-40 zny-glass-nav">
    <div class="max-w-7xl mx-auto px-4 py-3.5 flex flex-wrap items-center justify-between gap-4">
        <a href="/" class="zny-header-brand">
            <span class="zny-header-logo-wrap">
                <img src="{{ asset('images/logo_clean.png') }}" alt="{{ $companyName }}" class="zny-header-logo">
            </span>
            <div class="min-w-0 leading-tight">
                <div class="zny-header-brand-title">{{ $companyName }}</div>
                <div class="zny-header-brand-subtitle">Global Logistics Network</div>
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
            <p class="text-slate-300/90 leading-relaxed">{{ site_setting('footer_text') }}</p>
        </div>
        <div>
            <p class="font-semibold text-white mb-3 tracking-wide uppercase text-xs">Direct Contact</p>
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
            <p class="font-semibold text-white text-base">Operational clarity. Premium execution.</p>
            <p class="text-slate-300 mt-2 leading-relaxed">Built for importers, manufacturers, and enterprise teams that require dependable timing and proactive communication.</p>
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

<script>
(function () {
    const actions = document.querySelector('.zny-floating-actions');
    if (!actions) return;

    const recalculateOffset = function () {
        const isTabletDown = window.matchMedia('(max-width: 1024px)').matches;
        const baseSpacing = isTabletDown ? 88 : 108;
        const extraGap = isTabletDown ? 14 : 24;
        const hardReserve = isTabletDown ? 90 : 92;
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
            safeBottom = Math.max(safeBottom, occupiedFromBottom + extraGap + 8);

            if (!isTabletDown && rect.right >= window.innerWidth - 4) {
                safeRight = Math.max(safeRight || 20, Math.ceil(rect.width + 24));
            }
        }

        safeBottom = Math.max(safeBottom, hardReserve);
        actions.style.bottom = safeBottom + 'px';

        if (isTabletDown) {
            actions.style.left = '1rem';
            actions.style.right = 'auto';
            actions.style.alignItems = 'flex-start';
            return;
        }

        actions.style.left = 'auto';
        actions.style.right = (safeRight || 20) + 'px';
        actions.style.alignItems = 'flex-end';
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
