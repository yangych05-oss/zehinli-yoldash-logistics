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

    $uiCopy = [
        'en' => [
            'header_subtitle' => 'Enterprise Freight Governance',
            'quote' => 'Request a Quote',
            'footer_tagline' => 'International logistics engineered for predictable outcomes, strict control, and long-term enterprise trust.',
            'direct_lines' => 'Direct Lines',
            'footer_title' => 'Enterprise support with accountable execution.',
            'footer_text' => 'From first booking to final delivery, every shipment is managed with milestone discipline and transparent communication.',
            'footer_nav' => 'Navigation',
            'footer_rights' => 'All rights reserved.',
        ],
        'ru' => [
            'header_subtitle' => 'Корпоративное управление грузоперевозками',
            'quote' => 'Запросить расчёт',
            'footer_tagline' => 'Международная логистика для прогнозируемых результатов, строгого контроля и долгосрочного доверия бизнеса.',
            'direct_lines' => 'Контакты',
            'footer_title' => 'Корпоративная поддержка с контролируемым исполнением.',
            'footer_text' => 'От первой заявки до финальной доставки каждая перевозка ведётся с дисциплиной этапов и прозрачной коммуникацией.',
            'footer_nav' => 'Навигация',
            'footer_rights' => 'Все права защищены.',
        ],
        'tm' => [
            'header_subtitle' => 'Korporatiw ýük dolandyryşy',
            'quote' => 'Bahany soramak',
            'footer_tagline' => 'Çaklanylýan netijeler, berk gözegçilik we uzak möhletli ynam üçin halkara logistika.',
            'direct_lines' => 'Göni aragatnaşyk',
            'footer_title' => 'Jogapkärçilikli ýerine ýetiriliş bilen korporatiw goldaw.',
            'footer_text' => 'Ilkinji sargytdan ahyrky tabşyryga çenli her daşama tapgyrlaýyn tertip we açyk aragatnaşyk bilen dolandyrylýar.',
            'footer_nav' => 'Nawigasiýa',
            'footer_rights' => 'Ähli hukuklar goralan.',
        ],
    ];
    $ui = $uiCopy[app()->getLocale()] ?? $uiCopy['en'];

    $requestPath = '/' . ltrim(request()->path(), '/');
    if ($requestPath === '/index.php') {
        $requestPath = '/';
    }

    $seoPages = [
        '/ru' => [
            'title' => 'ZNY LOGISTICS — международная логистика и грузоперевозки',
            'description' => 'ZNY LOGISTICS предоставляет корпоративные логистические решения, международные перевозки, сопровождение грузов и прозрачную коммуникацию для торговых направлений.',
            'canonical' => 'https://znylogistic.com/ru',
            'hreflang' => ['ru' => 'https://znylogistic.com/ru', 'tm' => 'https://znylogistic.com/tm', 'x-default' => 'https://znylogistic.com/ru'],
        ],
        '/tm' => [
            'title' => 'ZNY LOGISTICS — halkara logistika we ýük daşamak',
            'description' => 'ZNY LOGISTICS halkara ýük daşamalary, korporatiw logistika çözgütleri, ýük gözegçiligi we ygtybarly hyzmatlary hödürleýär.',
            'canonical' => 'https://znylogistic.com/tm',
            'hreflang' => ['ru' => 'https://znylogistic.com/ru', 'tm' => 'https://znylogistic.com/tm', 'x-default' => 'https://znylogistic.com/ru'],
        ],
        '/ru/about' => [
            'title' => 'О компании — ZNY LOGISTICS',
            'description' => 'Узнайте о ZNY LOGISTICS: логистическом партнёре для точности, контроля и долгосрочного доверия в международных перевозках.',
            'canonical' => 'https://znylogistic.com/ru/about',
            'hreflang' => ['ru' => 'https://znylogistic.com/ru/about', 'tm' => 'https://znylogistic.com/tm/about', 'x-default' => 'https://znylogistic.com/ru/about'],
        ],
        '/tm/about' => [
            'title' => 'Kompaniýa barada — ZNY LOGISTICS',
            'description' => 'ZNY LOGISTICS barada maglumat: halkara logistika ugurlarynda takyklyk, gözegçilik we uzak möhletli ynam üçin hyzmatdaş.',
            'canonical' => 'https://znylogistic.com/tm/about',
            'hreflang' => ['ru' => 'https://znylogistic.com/ru/about', 'tm' => 'https://znylogistic.com/tm/about', 'x-default' => 'https://znylogistic.com/ru/about'],
        ],
        '/ru/services' => [
            'title' => 'Логистические услуги — ZNY LOGISTICS',
            'description' => 'Международные логистические услуги ZNY LOGISTICS: сопровождение грузов, перевозки, координация маршрутов и корпоративная поддержка.',
            'canonical' => 'https://znylogistic.com/ru/services',
            'hreflang' => ['ru' => 'https://znylogistic.com/ru/services', 'tm' => 'https://znylogistic.com/tm/services', 'x-default' => 'https://znylogistic.com/ru/services'],
        ],
        '/tm/services' => [
            'title' => 'Logistika hyzmatlary — ZNY LOGISTICS',
            'description' => 'ZNY LOGISTICS halkara logistika hyzmatlaryny, ýük daşamagy, ugur utgaşdyrmagy we korporatiw goldawy hödürleýär.',
            'canonical' => 'https://znylogistic.com/tm/services',
            'hreflang' => ['ru' => 'https://znylogistic.com/ru/services', 'tm' => 'https://znylogistic.com/tm/services', 'x-default' => 'https://znylogistic.com/ru/services'],
        ],
        '/ru/contact' => [
            'title' => 'Контакты — ZNY LOGISTICS',
            'description' => 'Свяжитесь с ZNY LOGISTICS для консультации по логистике, перевозкам, сопровождению грузов и корпоративной поддержке.',
            'canonical' => 'https://znylogistic.com/ru/contact',
            'hreflang' => ['ru' => 'https://znylogistic.com/ru/contact', 'tm' => 'https://znylogistic.com/tm/contact', 'x-default' => 'https://znylogistic.com/ru/contact'],
        ],
        '/tm/contact' => [
            'title' => 'Habarlaşmak — ZNY LOGISTICS',
            'description' => 'Logistika, ýük daşamak, ýük gözegçiligi we korporatiw goldaw boýunça ZNY LOGISTICS bilen habarlaşyň.',
            'canonical' => 'https://znylogistic.com/tm/contact',
            'hreflang' => ['ru' => 'https://znylogistic.com/ru/contact', 'tm' => 'https://znylogistic.com/tm/contact', 'x-default' => 'https://znylogistic.com/ru/contact'],
        ],
        '/ru/tracking' => [
            'title' => 'Отслеживание груза — ZNY LOGISTICS',
            'description' => 'Отслеживайте груз через защищённый корпоративный доступ ZNY LOGISTICS и получайте актуальную информацию по перевозке.',
            'canonical' => 'https://znylogistic.com/ru/tracking',
            'hreflang' => ['ru' => 'https://znylogistic.com/ru/tracking', 'tm' => 'https://znylogistic.com/tm/tracking', 'x-default' => 'https://znylogistic.com/ru/tracking'],
        ],
        '/tm/tracking' => [
            'title' => 'Ýüki yzarlamak — ZNY LOGISTICS',
            'description' => 'ZNY LOGISTICS arkaly ýüküňizi ygtybarly korporatiw giriş bilen yzarlaň we daşama barada täzelikleri görüň.',
            'canonical' => 'https://znylogistic.com/tm/tracking',
            'hreflang' => ['ru' => 'https://znylogistic.com/ru/tracking', 'tm' => 'https://znylogistic.com/tm/tracking', 'x-default' => 'https://znylogistic.com/ru/tracking'],
        ],
    ];

    $canonicalRedirects = [
        '/' => '/ru',
        '/about' => '/ru/about',
        '/services' => '/ru/services',
        '/contact' => '/ru/contact',
        '/tracking' => '/ru/tracking',
    ];

    if (isset($canonicalRedirects[$requestPath])) {
        $requestPath = $canonicalRedirects[$requestPath];
    }

    $seo = $seoPages[$requestPath] ?? $seoPages['/ru'];
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $path = '/' . ltrim(request()->path(), '/');
        $seoMap = [
            '/ru' => ['title' => 'ZNY LOGISTICS — международная логистика и грузоперевозки','description' => 'ZNY LOGISTICS предоставляет корпоративные логистические решения, международные перевозки, сопровождение грузов и прозрачную коммуникацию для торговых направлений.','canonical' => 'https://znylogistic.com/ru','alt_ru' => 'https://znylogistic.com/ru','alt_tm' => 'https://znylogistic.com/tm','x_default' => 'https://znylogistic.com/ru'],
            '/tm' => ['title' => 'ZNY LOGISTICS — halkara logistika we ýük daşamak','description' => 'ZNY LOGISTICS halkara ýük daşamalary, korporatiw logistika çözgütleri, ýük gözegçiligi we ygtybarly hyzmatlary hödürleýär.','canonical' => 'https://znylogistic.com/tm','alt_ru' => 'https://znylogistic.com/ru','alt_tm' => 'https://znylogistic.com/tm','x_default' => 'https://znylogistic.com/ru'],
            '/ru/about' => ['title' => 'О компании — ZNY LOGISTICS','description' => 'Узнайте о ZNY LOGISTICS: логистическом партнёре для точности, контроля и долгосрочного доверия в международных перевозках.','canonical' => 'https://znylogistic.com/ru/about','alt_ru' => 'https://znylogistic.com/ru/about','alt_tm' => 'https://znylogistic.com/tm/about','x_default' => 'https://znylogistic.com/ru/about'],
            '/tm/about' => ['title' => 'Kompaniýa barada — ZNY LOGISTICS','description' => 'ZNY LOGISTICS barada maglumat: halkara logistika ugurlarynda takyklyk, gözegçilik we uzak möhletli ynam üçin hyzmatdaş.','canonical' => 'https://znylogistic.com/tm/about','alt_ru' => 'https://znylogistic.com/ru/about','alt_tm' => 'https://znylogistic.com/tm/about','x_default' => 'https://znylogistic.com/ru/about'],
            '/ru/services' => ['title' => 'Логистические услуги — ZNY LOGISTICS','description' => 'Международные логистические услуги ZNY LOGISTICS: сопровождение грузов, перевозки, координация маршрутов и корпоративная поддержка.','canonical' => 'https://znylogistic.com/ru/services','alt_ru' => 'https://znylogistic.com/ru/services','alt_tm' => 'https://znylogistic.com/tm/services','x_default' => 'https://znylogistic.com/ru/services'],
            '/tm/services' => ['title' => 'Logistika hyzmatlary — ZNY LOGISTICS','description' => 'ZNY LOGISTICS halkara logistika hyzmatlaryny, ýük daşamagy, ugur utgaşdyrmagy we korporatiw goldawy hödürleýär.','canonical' => 'https://znylogistic.com/tm/services','alt_ru' => 'https://znylogistic.com/ru/services','alt_tm' => 'https://znylogistic.com/tm/services','x_default' => 'https://znylogistic.com/ru/services'],
            '/ru/contact' => ['title' => 'Контакты — ZNY LOGISTICS','description' => 'Свяжитесь с ZNY LOGISTICS для консультации по логистике, перевозкам, сопровождению грузов и корпоративной поддержке.','canonical' => 'https://znylogistic.com/ru/contact','alt_ru' => 'https://znylogistic.com/ru/contact','alt_tm' => 'https://znylogistic.com/tm/contact','x_default' => 'https://znylogistic.com/ru/contact'],
            '/tm/contact' => ['title' => 'Habarlaşmak — ZNY LOGISTICS','description' => 'Logistika, ýük daşamak, ýük gözegçiligi we korporatiw goldaw boýunça ZNY LOGISTICS bilen habarlaşyň.','canonical' => 'https://znylogistic.com/tm/contact','alt_ru' => 'https://znylogistic.com/ru/contact','alt_tm' => 'https://znylogistic.com/tm/contact','x_default' => 'https://znylogistic.com/ru/contact'],
            '/ru/tracking' => ['title' => 'Отслеживание груза — ZNY LOGISTICS','description' => 'Отслеживайте груз через защищённый корпоративный доступ ZNY LOGISTICS и получайте актуальную информацию по перевозке.','canonical' => 'https://znylogistic.com/ru/tracking','alt_ru' => 'https://znylogistic.com/ru/tracking','alt_tm' => 'https://znylogistic.com/tm/tracking','x_default' => 'https://znylogistic.com/ru/tracking'],
            '/tm/tracking' => ['title' => 'Ýüki yzarlamak — ZNY LOGISTICS','description' => 'ZNY LOGISTICS arkaly ýüküňizi ygtybarly korporatiw giriş bilen yzarlaň we daşama barada täzelikleri görüň.','canonical' => 'https://znylogistic.com/tm/tracking','alt_ru' => 'https://znylogistic.com/ru/tracking','alt_tm' => 'https://znylogistic.com/tm/tracking','x_default' => 'https://znylogistic.com/ru/tracking'],
        ];
        $seo = $seoMap[$path] ?? $seoMap['/ru'];
    @endphp
    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="{{ $seo['description'] }}">
    <link rel="canonical" href="{{ $seo['canonical'] }}">
    <link rel="alternate" hreflang="ru" href="{{ $seo['alt_ru'] }}">
    <link rel="alternate" hreflang="tm" href="{{ $seo['alt_tm'] }}">
    <link rel="alternate" hreflang="x-default" href="{{ $seo['x_default'] }}">
    <meta property="og:title" content="{{ $seo['title'] }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:url" content="{{ $seo['canonical'] }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ZNY LOGISTICS">
    <meta property="og:image" content="https://znylogistic.com/images/logo-final.png">
    <meta name="twitter:card" content="summary_large_image">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="zny-shell">
    <header class="sticky top-0 z-40 zny-glass-nav">
        <div class="zny-wrap py-3.5 flex flex-wrap items-center justify-between gap-4">
            <a href="/{{ app()->getLocale() }}" class="zny-header-brand">
                <span class="zny-header-logo-wrap">
                    <img src="{{ asset('images/logo-final.png') }}" alt="{{ $companyName }}" class="zny-header-logo">
                </span>
                <div class="zny-header-brand-text min-w-0 leading-tight">
                    <div class="zny-header-brand-title">{{ $companyName }}</div>
                    <div class="zny-header-brand-subtitle">{{ $ui['header_subtitle'] }}</div>
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
                <a href="/{{ app()->getLocale() }}/contact" class="zny-primary-btn !px-4 !py-2 !text-xs sm:!text-sm">{{ $ui['quote'] }}</a>
            </div>
        </div>
    </header>

    <main class="zny-wrap zny-main relative z-10">
        @if(session('status'))
            <div class="mb-6 rounded-xl border border-emerald-300 bg-emerald-50 p-4 text-emerald-800">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>

    <footer class="zny-footer text-slate-200">
        <div class="zny-wrap py-16 md:py-20">
            <div class="grid gap-10 lg:grid-cols-[1.2fr_.9fr_.9fr_.95fr] text-sm">
                <div>
                    <a href="/{{ app()->getLocale() }}" class="zny-brand-link mb-4">
                        <span class="zny-brand-logo-wrap !w-11 !h-11 !rounded-xl !bg-white/10 !border-white/10 !shadow-none">
                            <img src="{{ asset('images/logo-final.png') }}" alt="{{ $companyName }} logo" class="zny-brand-logo">
                        </span>
                        <div>
                            <p class="zny-brand-title">{{ $companyName }}</p>
                            <p class="text-slate-300 text-xs">{{ site_setting('company_domain', 'znylogistic.com') }}</p>
                        </div>
                    </a>
                    <p class="text-slate-300/90 leading-relaxed">{{ $ui['footer_tagline'] }}</p>
                </div>

                <div>
                    <p class="font-semibold text-white mb-3 tracking-wide uppercase text-xs">{{ $ui['direct_lines'] }}</p>
                    <div class="space-y-2 text-slate-300">
                        <p>{{ site_setting('phone_primary') }}</p>
                        @if(!empty($siteSettings['phone_secondary']))
                            <p>{{ $siteSettings['phone_secondary'] }}</p>
                        @endif
                        <p>{{ site_setting('email_primary') }}</p>
                        @if(site_setting('email_secondary'))
                            <p>{{ site_setting('email_secondary') }}</p>
                        @endif
                    </div>
                </div>

                <div>
                    <p class="font-semibold text-white mb-3 tracking-wide uppercase text-xs">{{ $ui['footer_nav'] }}</p>
                    <div class="space-y-2 text-slate-300">
                        <a href="/{{ app()->getLocale() }}" class="block hover:text-white">{{ __('messages.nav_home') }}</a>
                        <a href="/{{ app()->getLocale() }}/about" class="block hover:text-white">{{ __('messages.nav_about') }}</a>
                        <a href="/{{ app()->getLocale() }}/services" class="block hover:text-white">{{ __('messages.nav_services') }}</a>
                        <a href="/{{ app()->getLocale() }}/tracking" class="block hover:text-white">{{ __('messages.nav_tracking') }}</a>
                        <a href="/{{ app()->getLocale() }}/contact" class="block hover:text-white">{{ __('messages.nav_contact') }}</a>
                    </div>
                </div>

                <div>
                    <p class="font-semibold text-white text-base">{{ $ui['footer_title'] }}</p>
                    <p class="text-slate-300 mt-2 leading-relaxed">{{ $ui['footer_text'] }}</p>
                    <p class="pt-4 text-slate-400">{{ site_setting('address') }}</p>
                </div>
            </div>
            <div class="mt-12 border-t border-white/10 pt-5 text-xs text-slate-400 flex flex-wrap justify-between gap-2">
                <p>© {{ date('Y') }} {{ $companyName }}. {{ $ui['footer_rights'] }}</p>
                <p>{{ site_setting('company_domain', 'znylogistic.com') }}</p>
            </div>
        </div>
    </footer>

    <div class="zny-floating-actions" aria-label="Quick communication shortcuts">
        <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" class="zny-floating-whatsapp" aria-label="Contact ZNY Logistics via WhatsApp">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor"><path d="M20.5 3.5A11.89 11.89 0 0 0 12.05 0C5.48 0 .14 5.35.14 11.94c0 2.1.55 4.15 1.6 5.96L0 24l6.3-1.66a11.86 11.86 0 0 0 5.73 1.46h.01c6.57 0 11.91-5.35 11.91-11.94 0-3.2-1.24-6.22-3.45-8.36ZM12.04 21.8h-.01a9.86 9.86 0 0 1-5.02-1.37l-.36-.22-3.74.98 1-3.65-.24-.37a9.91 9.91 0 0 1-1.52-5.23c0-5.47 4.44-9.93 9.91-9.93 2.65 0 5.14 1.03 7.01 2.91a9.86 9.86 0 0 1 2.89 7.01c0 5.47-4.44 9.92-9.92 9.92Zm5.44-7.42c-.3-.15-1.76-.87-2.04-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.95 1.16-.17.2-.35.22-.65.08-.3-.15-1.26-.46-2.4-1.47-.88-.78-1.47-1.75-1.64-2.04-.17-.3-.02-.46.12-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.48-.5-.67-.51h-.57c-.2 0-.52.08-.8.37-.27.3-1.04 1.02-1.04 2.5s1.07 2.9 1.22 3.1c.15.2 2.1 3.2 5.1 4.49.72.31 1.28.5 1.72.63.72.23 1.38.2 1.9.12.58-.09 1.76-.72 2-1.42.25-.7.25-1.3.17-1.42-.07-.13-.27-.2-.57-.35Z"/></svg>
            <span class="zny-floating-whatsapp-copy">
                <span class="zny-floating-whatsapp-meta">Premium Support</span>
                <span class="zny-floating-whatsapp-text">WhatsApp</span>
            </span>
            <span class="zny-floating-label">WhatsApp</span>
        </a>
    </div>
</div>

<script>
    (function () {
        const actions = document.querySelector('.zny-floating-actions');
        if (!actions) return;

        const recalculateOffset = function () {
            const isTabletDown = window.matchMedia('(max-width: 1100px)').matches;
            const isMobile = window.matchMedia('(max-width: 768px)').matches;
            const baseSpacing = isMobile ? 184 : (isTabletDown ? 166 : 114);
            const extraGap = isMobile ? 56 : (isTabletDown ? 44 : 54);

            let safeBottom = baseSpacing;
            let safeRight = isMobile ? 11 : (isTabletDown ? 15 : 24);
            const tawkRects = [];

            const tawkTargets = [
                "#tawkchat-minified-iframe-element",
                "#tawkchat-container iframe",
                "#tawk-bubble-container",
                "#tawkchat-minified-wrapper",
                ".tawk-min-container",
                "[id*=\"tawk\"]",
                "[class*=\"tawk\"]",
                "[class*=\"tawk\"] iframe",
                "iframe[title*=\"tawk\" i]",
                "iframe[src*=\"tawk.to\"]"
            ];

            for (const selector of tawkTargets) {
                const chatEl = document.querySelector(selector);
                if (!chatEl) continue;
                const rect = chatEl.getBoundingClientRect();
                if (rect.width === 0 || rect.height === 0) continue;
                tawkRects.push(rect);

                const occupiedFromBottom = Math.max(0, window.innerHeight - rect.top);
                safeBottom = Math.max(safeBottom, occupiedFromBottom + extraGap);

                if (rect.right >= window.innerWidth - 10) {
                    safeRight = Math.max(safeRight || 24, Math.ceil(rect.width + (isMobile ? 16 : 48)));
                }
            }

            actions.style.setProperty('--zny-float-bottom', `${Math.ceil(safeBottom)}px`);
            actions.style.setProperty('--zny-float-right', `${Math.ceil(safeRight || 24)}px`);
            actions.style.left = 'auto';

            const whatsappBtn = actions.querySelector('.zny-floating-whatsapp');
            if (!whatsappBtn || !tawkRects.length) return;

            const waRect = whatsappBtn.getBoundingClientRect();
            const isOverlappingTawk = tawkRects.some((rect) => !(
                waRect.right < rect.left ||
                waRect.left > rect.right ||
                waRect.bottom < rect.top ||
                waRect.top > rect.bottom
            ));

            if (!isOverlappingTawk) return;

            actions.style.setProperty('--zny-float-bottom', `${Math.ceil(safeBottom + extraGap)}px`);
            actions.style.setProperty('--zny-float-right', `${Math.ceil((safeRight || 24) + (isMobile ? 10 : 16))}px`);
        };

        recalculateOffset();
        window.addEventListener('resize', recalculateOffset);
        setInterval(recalculateOffset, 1200);
        const observer = new MutationObserver(recalculateOffset);
        observer.observe(document.body, { childList: true, subtree: true });
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
