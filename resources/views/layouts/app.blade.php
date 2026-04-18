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

        .zny-header-brand {
            display: inline-flex;
            align-items: center;
            gap: 0.95rem;
            min-width: 0;
            flex-shrink: 0;
            text-decoration: none;
        }

        .zny-header-logo-wrap {
            display: grid;
            place-items: center;
            height: 64px;
            width: 64px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(15, 47, 120, 0.14);
            box-shadow: 0 9px 24px rgba(8, 21, 47, 0.12);
            transition: transform 0.22s ease, box-shadow 0.22s ease;
            flex-shrink: 0;
        }

        .zny-header-brand:hover .zny-header-logo-wrap {
            transform: scale(1.05);
            box-shadow: 0 12px 28px rgba(8, 21, 47, 0.16);
        }

        .zny-header-logo {
            height: 56px;
            width: auto;
            display: block;
            object-fit: contain;
        }

        .zny-header-brand-text {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 0;
            line-height: 1.05;
        }

        .zny-header-brand-title {
            color: #08152f;
            font-size: 1.18rem;
            font-weight: 900;
            letter-spacing: 0.055em;
            white-space: nowrap;
        }

        .zny-header-brand-subtitle {
            margin-top: 0.2rem;
            font-size: 0.74rem;
            color: #4f6183;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        @keyframes drift {
            0%, 100% { transform: translate3d(0, 0, 0); }
            50% { transform: translate3d(0, 16px, 0); }
        }

        @keyframes zny-fade-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .zny-reveal {
            opacity: 0;
            animation: zny-fade-up .8s ease forwards;
        }

        .zny-reveal-delay-1 { animation-delay: .08s; }
        .zny-reveal-delay-2 { animation-delay: .18s; }
        .zny-reveal-delay-3 { animation-delay: .28s; }

        .zny-floating-actions {
            position: fixed;
            right: 1rem;
            bottom: 1rem;
            z-index: 60;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: .7rem;
        }

        .zny-floating-chat,
        .zny-floating-whatsapp {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .72rem .95rem;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .01em;
            box-shadow: 0 12px 24px rgba(8, 21, 47, 0.20);
            transition: transform .24s ease, box-shadow .24s ease, filter .24s ease;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .zny-floating-chat:hover,
        .zny-floating-whatsapp:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 28px rgba(8, 21, 47, 0.24);
            filter: brightness(1.03);
        }

        .zny-floating-chat {
            background: rgba(255,255,255,.96);
            color: #0f2f78;
            border: 1px solid rgba(15,47,120,.16);
        }

        .zny-floating-chat-note {
            display: block;
            margin-top: .12rem;
            font-size: .66rem;
            line-height: 1.1;
            color: #5d6e8f;
            font-weight: 600;
        }

        .zny-floating-whatsapp {
            background: #25D366;
            color: #fff;
            border: 1px solid rgba(0,0,0,.06);
        }

        @media (max-width: 768px) {
            .zny-brand-subtitle { display: none; }
            .zny-header-brand { gap: 0.72rem; }
            .zny-header-logo-wrap {
                width: 52px;
                height: 52px;
                border-radius: 12px;
            }
            .zny-header-logo { height: 44px; }
            .zny-header-brand-title {
                font-size: 1.04rem;
                letter-spacing: 0.04em;
            }
            .zny-header-brand-subtitle {
                margin-top: 0.14rem;
                font-size: 0.68rem;
                letter-spacing: 0.06em;
            }
            .zny-floating-actions {
                right: .75rem;
                bottom: .75rem;
                gap: .55rem;
            }
            .zny-floating-chat,
            .zny-floating-whatsapp {
                padding: .62rem .82rem;
                font-size: .72rem;
            }
            .zny-floating-chat-note {
                display: none;
            }
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
        <a href="/" class="zny-header-brand">
            <span class="zny-header-logo-wrap">
                <img src="/images/logo_clean.png" alt="ZNY LOGISTICS" class="zny-header-logo">
            </span>
            <div class="zny-header-brand-text">
                <div class="zny-header-brand-title">ZNY LOGISTICS</div>
                <div class="zny-header-brand-subtitle">Global Logistics</div>
            </div>
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
@php
    $liveChatEmbedUrl = config('app.live_chat_embed_url');
    $isLiveChatUrlValid = filled($liveChatEmbedUrl) && filter_var($liveChatEmbedUrl, FILTER_VALIDATE_URL) && str_starts_with($liveChatEmbedUrl, 'https://');
@endphp

<div class="zny-floating-actions" aria-label="Quick communication shortcuts">
    @if($isLiveChatUrlValid)
        <button type="button" id="live-chat-trigger" class="zny-floating-chat text-left" aria-label="Open live chat">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5H8l-5 3V11.5A8.5 8.5 0 0 1 11.5 3h1A8.5 8.5 0 0 1 21 11.5Z"/>
            </svg>
            <span>Live Chat<span class="zny-floating-chat-note">Online support desk</span></span>
        </button>
    @else
        <button type="button" class="zny-floating-chat text-left cursor-default" aria-label="Live chat coming online shortly">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5H8l-5 3V11.5A8.5 8.5 0 0 1 11.5 3h1A8.5 8.5 0 0 1 21 11.5Z"/>
            </svg>
            <span>Live Chat<span class="zny-floating-chat-note">Coming online shortly</span></span>
        </button>
    @endif

    <a href="https://wa.me/99364918998" target="_blank" rel="noopener noreferrer" class="zny-floating-whatsapp" aria-label="Contact ZNY Logistics via WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor">
            <path d="M20.5 3.5A11.89 11.89 0 0 0 12.05 0C5.48 0 .14 5.35.14 11.94c0 2.1.55 4.15 1.6 5.96L0 24l6.3-1.66a11.86 11.86 0 0 0 5.73 1.46h.01c6.57 0 11.91-5.35 11.91-11.94 0-3.2-1.24-6.22-3.45-8.36ZM12.04 21.8h-.01a9.86 9.86 0 0 1-5.02-1.37l-.36-.22-3.74.98 1-3.65-.24-.37a9.91 9.91 0 0 1-1.52-5.23c0-5.47 4.44-9.93 9.91-9.93 2.65 0 5.14 1.03 7.01 2.91a9.86 9.86 0 0 1 2.89 7.01c0 5.47-4.44 9.92-9.92 9.92Zm5.44-7.42c-.3-.15-1.76-.87-2.04-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.95 1.16-.17.2-.35.22-.65.08-.3-.15-1.26-.46-2.4-1.47-.88-.78-1.47-1.75-1.64-2.04-.17-.3-.02-.46.12-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.48-.5-.67-.51h-.57c-.2 0-.52.08-.8.37-.27.3-1.04 1.02-1.04 2.5s1.07 2.9 1.22 3.1c.15.2 2.1 3.2 5.1 4.49.72.31 1.28.5 1.72.63.72.23 1.38.2 1.9.12.58-.09 1.76-.72 2-1.42.25-.7.25-1.3.17-1.42-.07-.13-.27-.2-.57-.35Z"/>
        </svg>
        <span>WhatsApp</span>
    </a>
</div>

@if($isLiveChatUrlValid)
    <script src="{{ $liveChatEmbedUrl }}" defer></script>
    <script>
        document.getElementById('live-chat-trigger')?.addEventListener('click', function () {
            window.dispatchEvent(new CustomEvent('zny:live-chat-open'));
            if (window.$crisp && typeof window.$crisp.push === 'function') {
                window.$crisp.push(['do', 'chat:open']);
            } else if (window.Tawk_API && typeof window.Tawk_API.maximize === 'function') {
                window.Tawk_API.maximize();
            } else if (window.jivo_api && typeof window.jivo_api.open === 'function') {
                window.jivo_api.open();
            }
        });
    </script>
@endif
</body>
</html>
