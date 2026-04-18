<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ZNY LOGISTICS') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --zny-primary: #0a1735;
            --zny-secondary: #123e95;
            --zny-accent: #2ca4ff;
            --zny-light: #f4f8ff;
            --zny-text: #10203d;
            --zny-surface: rgba(255, 255, 255, 0.72);
            --zny-surface-strong: rgba(255, 255, 255, 0.92);
            --zny-border: rgba(18, 42, 88, 0.12);
            --zny-shadow: 0 22px 54px rgba(7, 23, 52, 0.10);
            --zny-floating-right: 1.3rem;
            --zny-floating-left: auto;
            --zny-floating-bottom-safe: 8rem;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: Inter, "SF Pro Display", "Segoe UI", Roboto, system-ui, -apple-system, sans-serif;
            background:
                radial-gradient(circle at 6% 8%, rgba(44,164,255,0.14), transparent 32%),
                radial-gradient(circle at 92% 2%, rgba(18,62,149,0.08), transparent 30%),
                linear-gradient(180deg, #f7faff 0%, #eef4ff 48%, #f5f8ff 100%);
            color: var(--zny-text);
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
        }

        .zny-glass-nav {
            border-bottom: 1px solid rgba(10, 23, 53, 0.07);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.83), rgba(255, 255, 255, 0.74));
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        .zny-brand-link, .zny-header-brand {
            display: inline-flex;
            align-items: center;
            gap: .9rem;
            min-width: 0;
            text-decoration: none;
        }

        .zny-header-logo-wrap,
        .zny-brand-logo-wrap {
            display: grid;
            place-items: center;
            border-radius: 16px;
            background: linear-gradient(145deg, rgba(255,255,255,.92), rgba(233,244,255,.75));
            border: 1px solid rgba(15, 47, 120, 0.14);
            box-shadow: 0 12px 26px rgba(8,21,47,.12);
            flex-shrink: 0;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .zny-header-logo-wrap { width: 64px; height: 64px; }
        .zny-brand-logo-wrap { width: 52px; height: 52px; }

        .zny-header-brand:hover .zny-header-logo-wrap,
        .zny-brand-link:hover .zny-brand-logo-wrap {
            transform: translateY(-2px);
            box-shadow: 0 16px 32px rgba(8,21,47,.17);
        }

        .zny-header-logo { height: 56px; width: auto; object-fit: contain; }
        .zny-brand-logo { max-width: 38px; max-height: 38px; object-fit: contain; }

        .zny-header-brand-text, .zny-brand-text {
            display: flex;
            flex-direction: column;
            min-width: 0;
            line-height: 1.05;
        }

        .zny-header-brand-title {
            font-size: 1.15rem;
            letter-spacing: .055em;
            font-weight: 850;
            color: #07162f;
            white-space: nowrap;
        }

        .zny-header-brand-subtitle,
        .zny-brand-subtitle {
            margin-top: .2rem;
            font-size: .72rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #516689;
            font-weight: 620;
            white-space: nowrap;
        }

        .zny-brand-title {
            font-size: 1rem;
            letter-spacing: .08em;
            font-weight: 800;
            color: #f8fbff;
        }

        .zny-gradient-text {
            background: linear-gradient(132deg, #1447a2 0%, #18a5ff 78%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .zny-nav-link {
            position: relative;
            color: #2a3f63;
            transition: color .22s ease;
        }

        .zny-nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            right: 100%;
            bottom: -8px;
            height: 2px;
            border-radius: 999px;
            background: linear-gradient(90deg, #1447a2, #18a5ff);
            transition: right .24s ease;
        }

        .zny-nav-link:hover::after,
        .zny-nav-link[aria-current="page"]::after { right: 0; }
        .zny-nav-link:hover,
        .zny-nav-link[aria-current="page"] { color: #123e95; }

        .zny-card {
            border-radius: 1.35rem;
            border: 1px solid var(--zny-border);
            background: var(--zny-surface-strong);
            box-shadow: var(--zny-shadow);
        }

        .zny-soft-card {
            border-radius: 1.3rem;
            border: 1px solid rgba(255,255,255,0.54);
            background: linear-gradient(145deg, rgba(255,255,255,.84), rgba(247,250,255,.65));
            box-shadow: 0 12px 34px rgba(7, 26, 58, 0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .zny-pill {
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,.18);
            background: rgba(255,255,255,.08);
            padding: .46rem .8rem;
            font-size: .72rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            font-weight: 680;
        }

        .zny-primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: .86rem 1.4rem;
            font-size: .9rem;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #0f3b8f, #1aa4ff);
            box-shadow: 0 16px 34px rgba(16, 66, 156, 0.28);
            transition: transform .25s ease, box-shadow .25s ease, filter .25s ease;
        }

        .zny-primary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(16, 66, 156, 0.34);
            filter: saturate(1.03);
        }

        .zny-secondary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: .86rem 1.4rem;
            font-size: .9rem;
            font-weight: 650;
            color: #0d2a61;
            border: 1px solid rgba(20, 71, 162, 0.20);
            background: rgba(255,255,255,.74);
            transition: all .25s ease;
        }

        .zny-secondary-btn:hover {
            transform: translateY(-2px);
            border-color: rgba(20, 71, 162, 0.35);
            background: #fff;
        }

        .zny-reveal { opacity: 0; animation: zny-fade-up .8s ease forwards; }
        .zny-reveal-delay-1 { animation-delay: .08s; }
        .zny-reveal-delay-2 { animation-delay: .18s; }
        .zny-reveal-delay-3 { animation-delay: .28s; }

        @keyframes zny-fade-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .zny-floating-actions {
            position: fixed;
            right: var(--zny-floating-right);
            left: var(--zny-floating-left);
            bottom: var(--zny-floating-bottom-safe);
            z-index: 55;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .zny-floating-whatsapp {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 3.75rem;
            height: 3.75rem;
            border-radius: 999px;
            color: #fff;
            background: radial-gradient(circle at 30% 24%, #60f0af 0%, #27cb69 50%, #169c4b 100%);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 18px 34px rgba(10, 30, 56, 0.30), 0 0 0 1px rgba(22, 156, 75, 0.35) inset;
            transition: transform .28s ease, box-shadow .28s ease, filter .28s ease;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            touch-action: manipulation;
        }

        .zny-floating-whatsapp::before {
            content: '';
            position: absolute;
            inset: -7px;
            border-radius: inherit;
            background: radial-gradient(circle, rgba(37, 211, 102, 0.30) 0%, rgba(37, 211, 102, 0) 72%);
            z-index: -1;
            opacity: .84;
            transition: opacity .26s ease, transform .26s ease;
        }

        .zny-floating-whatsapp:hover {
            transform: translateY(-4px) scale(1.035);
            box-shadow: 0 22px 40px rgba(10, 30, 56, 0.34), 0 0 0 1px rgba(74, 222, 128, 0.34) inset;
        }

        .zny-floating-whatsapp:hover::before {
            opacity: 1;
            transform: scale(1.02);
        }

        .zny-floating-whatsapp:focus-visible {
            outline: 2px solid rgba(255, 255, 255, 0.98);
            outline-offset: 3px;
        }

        .zny-floating-label {
            position: absolute;
            width: 1px;
            height: 1px;
            margin: -1px;
            overflow: hidden;
            clip: rect(0,0,0,0);
            white-space: nowrap;
            border: 0;
        }

        .zny-footer {
            background: linear-gradient(130deg, #030d22, #05183d 48%, #092559 100%);
            border-top: 1px solid rgba(255,255,255,.08);
        }

        @media (max-width: 1024px) {
            :root {
                --zny-floating-right: auto;
                --zny-floating-left: 1rem;
                --zny-floating-bottom-safe: 6rem;
            }
            .zny-floating-actions { align-items: flex-start; }
        }

        @media (max-width: 768px) {
            .zny-header-brand { gap: .72rem; }
            .zny-header-logo-wrap { width: 52px; height: 52px; border-radius: 13px; }
            .zny-header-logo { height: 44px; }
            .zny-header-brand-title { font-size: 1rem; letter-spacing: .04em; }
            .zny-header-brand-subtitle { font-size: .66rem; }
            .zny-floating-whatsapp { width: 3.3rem; height: 3.3rem; }
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
            <div class="zny-header-brand-text">
                <div class="zny-header-brand-title">{{ $companyName }}</div>
                <div class="zny-header-brand-subtitle">Global Logistics</div>
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
                <div class="zny-brand-text">
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
            <p class="text-slate-300 mt-2 leading-relaxed">Designed for manufacturers, importers, and distributors who need reliable timelines and proactive logistics communication.</p>
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
        const baseSpacing = isTabletDown ? 92 : 112;
        const extraGap = isTabletDown ? 16 : 22;
        const hardReserve = isTabletDown ? 92 : 86;
        let safeBottom = baseSpacing;
        let safeRight = isTabletDown ? null : 22;

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

            if (!isTabletDown && rect.right > window.innerWidth - 10) {
                safeRight = Math.max(safeRight, Math.ceil(rect.width + 22));
            }
        }

        safeBottom = Math.max(safeBottom, hardReserve + extraGap);
        actions.style.bottom = safeBottom + 'px';

        if (isTabletDown) {
            actions.style.left = '1rem';
            actions.style.right = 'auto';
            actions.style.alignItems = 'flex-start';
            return;
        }

        actions.style.left = 'auto';
        actions.style.right = (safeRight || 22) + 'px';
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
