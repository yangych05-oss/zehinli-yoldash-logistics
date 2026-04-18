@extends('layouts.app')

@section('content')
    @php
        $siteSettings = array_merge(
            site_setting_defaults(),
            is_array($siteSettings ?? null) ? $siteSettings : []
        );

        $services = [
            [
                'icon' => '✈️',
                'title' => 'Air Freight',
                'text' => 'Priority international and regional air cargo programs with milestone control.',
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1200&q=80',
                'alt' => 'Cargo aircraft at airport logistics terminal',
            ],
            [
                'icon' => '🚚',
                'title' => 'Road Transport',
                'text' => 'Cross-border trucking with route optimization, secure handling, and reliable ETA windows.',
                'image' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=1200&q=80',
                'alt' => 'Freight truck on highway',
            ],
            [
                'icon' => '🚢',
                'title' => 'Ocean Freight',
                'text' => 'Port-to-port and door-to-door container movement across key international trade lanes.',
                'image' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=1200&q=80',
                'alt' => 'Container ship at seaport',
            ],
        ];

        $highlights = [
            ['value' => '24/7', 'label' => 'Operations Desk'],
            ['value' => '99.2%', 'label' => 'On-time Milestones'],
            ['value' => '45+', 'label' => 'Trade Lanes Managed'],
            ['value' => '1:1', 'label' => 'Dedicated Coordinator'],
        ];
    @endphp

    <section class="relative overflow-hidden rounded-[2rem] border border-slate-800/70 bg-gradient-to-br from-slate-950 via-[#061739] to-[#0b2454] p-8 md:p-12 text-white shadow-2xl shadow-slate-900/40">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 14% 16%, rgba(255,255,255,0.28) 1px, transparent 1px), radial-gradient(circle at 84% 72%, rgba(56,189,248,0.32) 1px, transparent 1px); background-size: 120px 120px, 160px 160px;"></div>
        <div class="absolute -top-24 right-[-5rem] h-80 w-80 rounded-full bg-cyan-400/20 blur-3xl"></div>
        <div class="absolute -bottom-24 left-[-4rem] h-72 w-72 rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative z-10 grid items-center gap-10 lg:grid-cols-[1.05fr_.95fr]">
            <div class="max-w-2xl">
                <p class="zny-pill zny-reveal zny-reveal-delay-1 inline-flex text-sky-100">Enterprise Logistics Performance</p>
                <h1 class="zny-reveal zny-reveal-delay-2 mt-5 text-4xl font-black leading-tight md:text-[3.2rem]">Premium global freight execution for teams that cannot afford uncertainty.</h1>
                <p class="zny-reveal zny-reveal-delay-2 mt-5 max-w-xl text-base text-slate-200 md:text-lg">{{ $siteSettings['company_name'] ?? 'ZNY LOGISTICS' }} combines cargo aircraft, trucking, ports, and warehousing into one managed operating model with transparent communication and dependable delivery outcomes.</p>

                <div class="zny-reveal zny-reveal-delay-3 mt-8 flex flex-wrap gap-3">
                    <a href="/{{ app()->getLocale() }}/contact" class="zny-primary-btn">Request a Strategic Quote</a>
                    <a href="/{{ app()->getLocale() }}/tracking" class="zny-secondary-btn !text-white !border-white/35 !bg-white/10 hover:!bg-white/16">Track Shipment</a>
                </div>

                <div class="zny-reveal zny-reveal-delay-3 mt-8 grid gap-3 sm:grid-cols-3">
                    <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-sky-100">Rapid Response</p>
                        <p class="mt-1 text-sm font-semibold text-white">Expedited operational alignment</p>
                    </div>
                    <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-sky-100">Visibility</p>
                        <p class="mt-1 text-sm font-semibold text-white">Milestone-level shipment updates</p>
                    </div>
                    <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-sky-100">Risk Control</p>
                        <p class="mt-1 text-sm font-semibold text-white">Proactive exception handling</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 zny-reveal zny-reveal-delay-3">
                <article class="zny-soft-card overflow-hidden border-white/20 bg-white/12 p-4 text-white">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1400&q=80" alt="Warehouse logistics operations" class="h-52 w-full rounded-2xl object-cover" loading="lazy" referrerpolicy="no-referrer">
                    <div class="mt-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-sky-100">Control Tower</p>
                            <p class="text-sm font-semibold">Unified air, road, and ocean planning</p>
                        </div>
                        <span class="rounded-full border border-white/25 bg-white/10 px-3 py-1 text-xs">Live</span>
                    </div>
                </article>
                <div class="grid grid-cols-2 gap-3">
                    @foreach($highlights as $highlight)
                        <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-4 text-center backdrop-blur-sm">
                            <p class="text-2xl font-black text-white">{{ $highlight['value'] }}</p>
                            <p class="mt-1 text-xs uppercase tracking-[0.13em] text-slate-200">{{ $highlight['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="mt-16">
        <div class="mb-7 flex items-end justify-between gap-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-800">Core Services</p>
                <h2 class="mt-2 text-3xl font-black text-slate-900 md:text-4xl">Integrated logistics, beautifully coordinated.</h2>
            </div>
        </div>

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach($services as $service)
                <article class="group zny-card overflow-hidden transition duration-300 hover:-translate-y-1.5 hover:shadow-[0_28px_52px_rgba(7,26,58,0.14)]">
                    <img src="{{ $service['image'] }}" alt="{{ $service['alt'] }}" class="h-44 w-full object-cover transition duration-700 group-hover:scale-[1.03]" loading="lazy" referrerpolicy="no-referrer">
                    <div class="p-6">
                        <div class="mb-4 grid h-11 w-11 place-items-center rounded-xl bg-sky-100 text-2xl">{{ $service['icon'] }}</div>
                        <h3 class="text-xl font-bold text-slate-900">{{ $service['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $service['text'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mt-16 grid gap-5 lg:grid-cols-[1.35fr_.65fr]">
        <div class="zny-card p-7 md:p-8">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Why Teams Choose ZNY</p>
            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                <article class="rounded-2xl border border-slate-200/80 bg-white/75 p-5">
                    <h3 class="text-base font-bold">Single operational view</h3>
                    <p class="mt-2 text-sm text-slate-600">From booking to final-mile handoff, all milestones and risks are managed through one accountable workflow.</p>
                </article>
                <article class="rounded-2xl border border-slate-200/80 bg-white/75 p-5">
                    <h3 class="text-base font-bold">Corporate-grade communication</h3>
                    <p class="mt-2 text-sm text-slate-600">Decision-ready updates for procurement, supply chain, and finance teams who need confidence under pressure.</p>
                </article>
                <article class="rounded-2xl border border-slate-200/80 bg-white/75 p-5 sm:col-span-2">
                    <h3 class="text-base font-bold">Cost, speed, and reliability balance</h3>
                    <p class="mt-2 text-sm text-slate-600">We tailor modal mix and lane strategy to your commercial priorities—without compromising on execution quality.</p>
                </article>
            </div>
        </div>

        <aside class="zny-card overflow-hidden">
            <img src="https://images.unsplash.com/photo-1616432043562-3671ea2e5242?auto=format&fit=crop&w=1200&q=80" alt="Shipping containers at port terminal" class="h-56 w-full object-cover" loading="lazy" referrerpolicy="no-referrer">
            <div class="p-6">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-sky-700">Trusted Infrastructure</p>
                <p class="mt-2 text-sm text-slate-600">Premium partner network across major ports, airports, and inland hubs.</p>
            </div>
        </aside>
    </section>

    <section class="mt-16 rounded-[1.8rem] border border-slate-800 bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 p-8 text-white shadow-xl shadow-slate-900/35 md:p-10">
        <div class="grid items-center gap-6 lg:grid-cols-[1.2fr_.8fr]">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-300">Tracking Portal</p>
                <h3 class="mt-2 text-3xl font-black">{{ site_setting('tracking_cta_text') }}</h3>
                <p class="mt-3 max-w-2xl text-slate-200">Access secure shipment visibility with current location, milestone timestamps, and operational notes in one dashboard.</p>
            </div>
            <div class="flex lg:justify-end">
                <a href="/{{ app()->getLocale() }}/tracking" class="zny-primary-btn">Open Tracking Portal</a>
            </div>
        </div>
    </section>

    <section class="mt-16 grid gap-5 lg:grid-cols-2">
        <article class="zny-card p-7 md:p-8">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">WhatsApp Support</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900">Instant access to our freight team.</h2>
            <p class="mt-3 text-slate-600">For urgent routing questions, quote updates, and live shipment support, connect directly with our operations desk.</p>
            <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" class="mt-6 inline-flex items-center justify-center rounded-full bg-[#25D366] px-6 py-3 text-sm font-semibold text-white shadow-[0_18px_30px_rgba(20,90,50,.22)] transition hover:-translate-y-0.5 hover:bg-[#1ebe57]">Open WhatsApp</a>
        </article>

        <article class="zny-card overflow-hidden">
            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1200&q=80" alt="Logistics planning and operations analytics" class="h-44 w-full object-cover" loading="lazy" referrerpolicy="no-referrer">
            <div class="p-7">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Contact</p>
                <h2 class="mt-2 text-3xl font-black text-slate-900">{{ site_setting('contact_cta_text') }}</h2>
                <ul class="mt-4 space-y-2 text-sm text-slate-700">
                    <li>📞 {{ site_setting('phone_primary') }}</li>
                    <li>✉️ {{ site_setting('email_primary') }}</li>
                    @if(site_setting('email_secondary'))
                        <li>✉️ {{ site_setting('email_secondary') }}</li>
                    @endif
                    <li>📍 {{ site_setting('address') }}</li>
                </ul>
                <a href="/{{ app()->getLocale() }}/contact" class="mt-5 inline-flex zny-secondary-btn">Go to Contact Form</a>
            </div>
        </article>
    </section>
@endsection
