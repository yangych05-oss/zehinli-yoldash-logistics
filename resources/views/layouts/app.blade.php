<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ZNY LOGISTICS') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --zny-primary: #0F172A;
            --zny-secondary: #1E3A8A;
            --zny-accent: #0EA5E9;
            --zny-light: #F8FAFC;
        }

        body {
            font-family: Inter, "Segoe UI", Roboto, system-ui, -apple-system, sans-serif;
            background: radial-gradient(circle at top right, rgba(14,165,233,0.08), transparent 35%), var(--zny-light);
            color: var(--zny-primary);
        }

        .zny-logo {
            display: inline-flex;
            align-items: center;
            gap: .75rem;
            font-weight: 800;
            letter-spacing: .08em;
        }

        .zny-logo-mark {
            width: 2.15rem;
            height: 2.15rem;
            border-radius: .7rem;
            background: linear-gradient(135deg, var(--zny-secondary), var(--zny-accent));
            color: #fff;
            font-size: .82rem;
            display: grid;
            place-items: center;
            box-shadow: 0 10px 30px rgba(30,58,138,.35);
        }

        .zny-gradient-text {
            background: linear-gradient(130deg, var(--zny-secondary), var(--zny-accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .zny-shell {
            position: relative;
            overflow: hidden;
        }

        .zny-shell::before,
        .zny-shell::after {
            content: "";
            position: absolute;
            border-radius: 9999px;
            filter: blur(8px);
            z-index: 0;
            animation: float 12s ease-in-out infinite;
        }

        .zny-shell::before {
            width: 16rem;
            height: 16rem;
            background: rgba(30,58,138,.15);
            top: -6rem;
            right: -7rem;
        }

        .zny-shell::after {
            width: 14rem;
            height: 14rem;
            background: rgba(14,165,233,.12);
            bottom: -6rem;
            left: -6rem;
            animation-delay: -4s;
        }

        @keyframes float {
            0%, 100% { transform: translate3d(0, 0, 0); }
            50% { transform: translate3d(0, 18px, 0); }
        }

        .zny-card {
            background: rgba(255,255,255,.9);
            border: 1px solid rgba(15,23,42,.08);
            border-radius: 1rem;
            box-shadow: 0 8px 35px rgba(15, 23, 42, 0.07);
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
<header class="sticky top-0 z-40 border-b border-slate-200/70 bg-white/90 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-4">
        <a href="/{{ app()->getLocale() }}" class="zny-logo">
            <span class="zny-logo-mark">ZNY</span>
            <span>
                <span class="block text-sm leading-none text-slate-500">znylogistic.com</span>
                <span class="text-base sm:text-lg leading-tight">ZNY LOGISTICS</span>
            </span>
        </a>

        <nav class="flex flex-wrap items-center gap-4 text-sm font-medium text-slate-700">
            <a href="/{{ app()->getLocale() }}" class="hover:text-sky-600 transition">{{ __('messages.nav_home') }}</a>
            <a href="/{{ app()->getLocale() }}/about" class="hover:text-sky-600 transition">{{ __('messages.nav_about') }}</a>
            <a href="/{{ app()->getLocale() }}/services" class="hover:text-sky-600 transition">{{ __('messages.nav_services') }}</a>
            <a href="/{{ app()->getLocale() }}/tracking" class="hover:text-sky-600 transition">{{ __('messages.nav_tracking') }}</a>
            <a href="/{{ app()->getLocale() }}/contact" class="hover:text-sky-600 transition">{{ __('messages.nav_contact') }}</a>
        </nav>

        <div class="flex items-center gap-3">
            <div class="rounded-full border border-slate-300 p-1 text-xs font-semibold uppercase tracking-wide">
                @foreach($supportedLocales as $lang)
                    <a href="/{{ $lang }}{{ $localizedPath ? '/' . $localizedPath : '' }}" class="px-2 py-1 rounded-full {{ app()->getLocale() === $lang ? 'bg-slate-900 text-white' : 'text-slate-600 hover:text-slate-900' }}">{{ $lang }}</a>
                @endforeach
            </div>
            <a href="/{{ app()->getLocale() }}/contact" class="rounded-full bg-slate-900 px-4 py-2 text-xs sm:text-sm font-semibold text-white hover:bg-slate-700 transition">Get a Quote</a>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 py-10 relative z-10">
    @if(session('status'))
        <div class="mb-6 rounded-xl border border-emerald-300 bg-emerald-50 p-4 text-emerald-800">{{ session('status') }}</div>
    @endif
    @yield('content')
</main>

<footer class="mt-16 bg-slate-950 text-slate-200">
    <div class="max-w-7xl mx-auto px-4 py-10 grid md:grid-cols-3 gap-6 text-sm">
        <div>
            <p class="zny-logo mb-2"><span class="zny-logo-mark">ZNY</span> <span>ZNY LOGISTICS</span></p>
            <p class="text-slate-400">znylogistic.com</p>
            <p class="text-slate-400 mt-2">Rysgal BC, 917, Ashgabat, Turkmenistan</p>
        </div>
        <div>
            <p class="font-semibold text-white">Direct Contact</p>
            <p class="mt-2">+99364 918998</p>
            <p>info@znylogistics.com</p>
            <p>akja@znylogistics.com</p>
        </div>
        <div class="md:text-right">
            <p class="font-semibold text-white">Built for Global Supply Chains</p>
            <p class="text-slate-400 mt-2">Air, road and integrated freight services with transparent shipment tracking.</p>
        </div>
    </div>
</footer>
</body>
</html>
