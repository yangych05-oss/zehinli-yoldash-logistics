<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ZNY LOGISTICS') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --zny-primary: #08152f;
            --zny-secondary: #0f2f78;
            --zny-accent: #1492ff;
            --zny-light: #f6f9ff;
            --zny-text: #10213f;
        }

        * { box-sizing: border-box; }

        body {
            font-family: Inter, "Segoe UI", Roboto, system-ui, -apple-system, sans-serif;
            background:
                radial-gradient(circle at 12% 12%, rgba(20,146,255,0.10), transparent 28%),
                radial-gradient(circle at 86% 4%, rgba(15,47,120,0.08), transparent 34%),
                var(--zny-light);
            color: var(--zny-text);
        }

        .zny-brand-link {
            display: inline-flex;
            align-items: center;
            gap: .85rem;
            min-width: 0;
        }

        .zny-brand-logo-wrap {
            display: grid;
            place-items: center;
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: linear-gradient(140deg, rgba(15,47,120,.16), rgba(20,146,255,.08));
            border: 1px solid rgba(15,47,120,.12);
            box-shadow: 0 12px 24px rgba(8,21,47,.10);
            flex-shrink: 0;
        }

        .zny-brand-logo {
            max-width: 38px;
            max-height: 38px;
            object-fit: contain;
        }

        .zny-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .zny-brand-title {
            font-size: 1.02rem;
            font-weight: 800;
            letter-spacing: .08em;
            color: #08152f;
        }

        .zny-brand-subtitle {
            margin-top: .18rem;
            font-size: .73rem;
            color: #526384;
            letter-spacing: .08em;
            font-weight: 600;
            text-transform: uppercase;
        }

        .zny-gradient-text {
            background: linear-gradient(130deg, #0f2f78 0%, #1492ff 85%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .zny-card {
            background: rgba(255,255,255,.92);
            border: 1px solid rgba(8,21,47,.08);
            border-radius: 1.25rem;
            box-shadow: 0 10px 32px rgba(8, 21, 47, 0.07);
        }

        .zny-surface-glow {
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .zny-surface-glow::before {
            content: "";
            position: absolute;
            width: 19rem;
            height: 19rem;
            border-radius: 9999px;
            background: radial-gradient(circle, rgba(20,146,255,.24) 0%, rgba(20,146,255,0) 70%);
            top: -8rem;
            right: -6rem;
            z-index: -1;
            animation: drift 12s ease-in-out infinite;
        }

        .zny-surface-glow::after {
            content: "";
            position: absolute;
            width: 16rem;
            height: 16rem;
            border-radius: 9999px;
            background: radial-gradient(circle, rgba(15,47,120,.16) 0%, rgba(15,47,120,0) 70%);
            bottom: -7rem;
            left: -5rem;
            z-index: -1;
            animation: drift 13s ease-in-out infinite reverse;
        }

        .zny-grid-overlay {
            background-image:
                linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px);
            background-size: 24px 24px;
        }

        .zny-nav-link { position: relative; }
        .zny-nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            right: 100%;
            bottom: -5px;
            border-bottom: 2px solid #1492ff;
            transition: right .25s ease;
        }
        .zny-nav-link:hover::after { right: 0; }

        @keyframes drift {
            0%, 100% { transform: translate3d(0, 0, 0); }
            50% { transform: translate3d(0, 16px, 0); }
        }

        @media (max-width: 768px) {
            .zny-brand-subtitle { display: none; }
        }
    </style>
</head>
@php
    $supportedLocales = ['en', 'ru', 'tm'];
    $segments = request()->segments();
    if (isset($segments[0]) && in_array($segments[0], $supportedLocales, true)) {
        array_shift($segments);
    }
    $localizedPath = implode('/', $segments);
@endphp
<body>
<header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/90 backdrop-blur-xl">
    <div class="max-w-7xl mx-auto px-4 py-3.5 flex flex-wrap items-center justify-between gap-4">
        <a href="/{{ app()->getLocale() }}" class="zny-brand-link">
            <span class="zny-brand-logo-wrap">
                <img src="/images/logo_clean.png" alt="ZNY LOGISTICS logo" class="zny-brand-logo">
            </span>
            <span class="zny-brand-text">
                <span class="zny-brand-title">ZNY LOGISTICS</span>
                <span class="zny-brand-subtitle">International Freight Solutions</span>
            </span>
        </a>

        <nav class="flex flex-wrap items-center gap-4 md:gap-5 text-sm font-semibold text-slate-700">
            <a href="/{{ app()->getLocale() }}" class="zny-nav-link hover:text-sky-700 transition">{{ __('messages.nav_home') }}</a>
            <a href="/{{ app()->getLocale() }}/about" class="zny-nav-link hover:text-sky-700 transition">{{ __('messages.nav_about') }}</a>
            <a href="/{{ app()->getLocale() }}/services" class="zny-nav-link hover:text-sky-700 transition">{{ __('messages.nav_services') }}</a>
            <a href="/{{ app()->getLocale() }}/tracking" class="zny-nav-link hover:text-sky-700 transition">{{ __('messages.nav_tracking') }}</a>
            <a href="/{{ app()->getLocale() }}/contact" class="zny-nav-link hover:text-sky-700 transition">{{ __('messages.nav_contact') }}</a>
        </nav>

        <div class="flex items-center gap-3">
            <div class="rounded-full border border-slate-300 p-1 text-xs font-semibold uppercase tracking-wide bg-white">
                @foreach($supportedLocales as $lang)
                    <a href="/{{ $lang }}{{ $localizedPath ? '/' . $localizedPath : '' }}" class="px-2 py-1 rounded-full {{ app()->getLocale() === $lang ? 'bg-slate-900 text-white' : 'text-slate-600 hover:text-slate-900' }}">{{ $lang }}</a>
                @endforeach
            </div>
            <a href="/{{ app()->getLocale() }}/contact" class="rounded-full bg-slate-900 px-4 py-2 text-xs sm:text-sm font-semibold text-white hover:bg-blue-900 transition">Request a Quote</a>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 py-10 relative z-10">
    @if(session('status'))
        <div class="mb-6 rounded-xl border border-emerald-300 bg-emerald-50 p-4 text-emerald-800">{{ session('status') }}</div>
    @endif
    @yield('content')
</main>

<footer class="mt-16 bg-slate-950 text-slate-200 border-t border-slate-800/80">
    <div class="max-w-7xl mx-auto px-4 py-12 grid md:grid-cols-3 gap-8 text-sm">
        <div>
            <div class="flex items-center gap-3 mb-4">
                <span class="zny-brand-logo-wrap !w-11 !h-11 !rounded-xl !bg-white/10 !border-white/10 !shadow-none">
                    <img src="/images/logo_clean.png" alt="ZNY LOGISTICS logo" class="zny-brand-logo">
                </span>
                <div>
                    <p class="font-bold tracking-[0.12em] text-white text-xs">ZNY LOGISTICS</p>
                    <p class="text-slate-400 text-xs">znylogistic.com</p>
                </div>
            </div>
            <p class="text-slate-400">Strategic freight partner for air, road, and integrated cargo programs across global supply chains.</p>
        </div>
        <div>
            <p class="font-semibold text-white mb-2">Direct Contact</p>
            <p class="text-slate-300">+99364918998</p>
            <p class="text-slate-300">info@znylogistics.com</p>
            <p class="text-slate-300">akja@znylogistics.com</p>
            <p class="text-slate-400 mt-3">Rysgal BC, 917, Ashgabat, Turkmenistan</p>
        </div>
        <div class="md:text-right">
            <p class="font-semibold text-white">Operational Clarity, Premium Service</p>
            <p class="text-slate-400 mt-2">Built for manufacturers, importers, and distributors requiring dependable visibility and responsive execution.</p>
        </div>
    </div>
</footer>
</body>
</html>
