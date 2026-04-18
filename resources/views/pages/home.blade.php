@extends('layouts.app')

@section('content')
    @php
        $siteSettings = array_merge(
            site_setting_defaults(),
            is_array($siteSettings ?? null) ? $siteSettings : []
        );

        $services = [
            [
                'title' => 'Air Freight',
                'text' => 'Priority uplift for time-critical cargo with strict handover control and milestone visibility.',
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1600&q=80',
                'alt' => 'Cargo aircraft at airport logistics terminal',
                'badge' => 'Time critical',
            ],
            [
                'title' => 'Road Freight',
                'text' => 'Cross-border trucking with secure handling, calibrated route design, and disciplined ETA performance.',
                'image' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=1600&q=80',
                'alt' => 'Freight truck on modern expressway',
                'badge' => 'Regional precision',
            ],
            [
                'title' => 'Ocean Freight',
                'text' => 'Container shipping across major lanes from booking through port execution and inland transfer.',
                'image' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=1600&q=80',
                'alt' => 'Container vessel at maritime terminal',
                'badge' => 'Global lanes',
            ],
        ];

        $highlights = [
            ['value' => '24/7', 'label' => 'Operations desk'],
            ['value' => '45+', 'label' => 'Trade lanes'],
            ['value' => '99%+', 'label' => 'Milestone reliability'],
            ['value' => '1:1', 'label' => 'Account ownership'],
        ];
    @endphp

    <section class="relative overflow-hidden rounded-[2.1rem] border border-slate-900/70 bg-gradient-to-br from-slate-950 via-[#07193e] to-[#123f93] p-8 text-white shadow-[0_30px_70px_rgba(6,20,45,.45)] md:p-12">
        <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 16% 18%, rgba(255,255,255,.36) 1px, transparent 1px), radial-gradient(circle at 90% 76%, rgba(55,169,255,.4) 1px, transparent 1px); background-size: 130px 130px, 150px 150px;"></div>
        <div class="absolute -top-28 right-[-4rem] h-[21rem] w-[21rem] rounded-full bg-cyan-400/20 blur-3xl"></div>
        <div class="absolute -bottom-28 left-[-3rem] h-[19rem] w-[19rem] rounded-full bg-blue-500/24 blur-3xl"></div>

        <div class="relative z-10 grid items-center gap-10 lg:grid-cols-[1.03fr_.97fr]">
            <div class="max-w-2xl">
                <p class="zny-label inline-flex rounded-full border border-white/22 bg-white/10 px-3 py-2 text-sky-100">Premium International Logistics</p>
                <h1 class="mt-5 text-[2.1rem] font-black leading-tight md:text-[3.15rem]">Precision freight execution for global business.</h1>
                <p class="mt-5 max-w-xl text-base text-slate-200 md:text-lg">{{ $siteSettings['company_name'] ?? 'ZNY LOGISTICS' }} delivers air, road, ocean, and warehousing under one accountable control model.</p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="/{{ app()->getLocale() }}/contact" class="zny-primary-btn">Request Enterprise Quote</a>
                    <a href="/{{ app()->getLocale() }}/tracking" class="zny-secondary-btn !text-white !border-white/35 !bg-white/10 hover:!bg-white/16">Track Shipment</a>
                </div>

                <div class="mt-8 grid gap-3 sm:grid-cols-3">
                    <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-sky-100">Visibility</p>
                        <p class="mt-1 text-sm font-semibold text-white">Real-time milestones</p>
                    </div>
                    <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-sky-100">Control</p>
                        <p class="mt-1 text-sm font-semibold text-white">Proactive exception handling</p>
                    </div>
                    <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-sky-100">Coverage</p>
                        <p class="mt-1 text-sm font-semibold text-white">International network depth</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-4">
                <article class="zny-soft-card overflow-hidden border-white/20 bg-white/12 p-4 text-white">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1600&q=80" alt="Warehouse logistics operations" class="h-60 w-full rounded-2xl object-cover" loading="lazy" referrerpolicy="no-referrer">
                    <div class="mt-4 flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-sky-100">Integrated Control Tower</p>
                            <p class="text-sm font-semibold">One command layer across every transport mode</p>
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

    <section class="mt-20">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="zny-label text-sky-800">Core Services</p>
                <h2 class="mt-2 text-3xl font-black text-slate-900 md:text-4xl">Built for enterprise timing, cost, and reliability targets.</h2>
            </div>
            <p class="max-w-xl text-sm text-slate-600">Each shipment plan is engineered around your operating priorities with fast response and disciplined execution.</p>
        </div>

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach($services as $service)
                <article class="group zny-card overflow-hidden transition duration-300 hover:-translate-y-1.5 hover:shadow-[0_30px_56px_rgba(7,26,58,0.14)]">
                    <img src="{{ $service['image'] }}" alt="{{ $service['alt'] }}" class="h-48 w-full object-cover transition duration-700 group-hover:scale-[1.03]" loading="lazy" referrerpolicy="no-referrer">
                    <div class="p-6">
                        <p class="mb-3 text-[11px] font-bold uppercase tracking-[0.2em] text-sky-700">{{ $service['badge'] }}</p>
                        <h3 class="text-xl font-bold text-slate-900">{{ $service['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $service['text'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mt-16 grid gap-5 lg:grid-cols-[1.35fr_.65fr]">
        <div class="zny-card p-7 md:p-8">
            <p class="zny-label text-sky-700">Why enterprise teams choose ZNY</p>
            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                <article class="rounded-2xl border border-slate-200/80 bg-white/75 p-5">
                    <h3 class="text-base font-bold">Single operational ownership</h3>
                    <p class="mt-2 text-sm text-slate-600">From booking to delivery, one accountable team manages milestones, handoffs, and risk response.</p>
                </article>
                <article class="rounded-2xl border border-slate-200/80 bg-white/75 p-5">
                    <h3 class="text-base font-bold">Executive-grade communication</h3>
                    <p class="mt-2 text-sm text-slate-600">Clear updates for supply chain, procurement, and finance stakeholders at every critical checkpoint.</p>
                </article>
                <article class="rounded-2xl border border-slate-200/80 bg-white/75 p-5 sm:col-span-2">
                    <h3 class="text-base font-bold">Performance-calibrated routing</h3>
                    <p class="mt-2 text-sm text-slate-600">Mode selection and schedule design aligned to your urgency, budget, and service constraints.</p>
                </article>
            </div>
        </div>

        <aside class="zny-card overflow-hidden">
            <img src="https://images.unsplash.com/photo-1616432043562-3671ea2e5242?auto=format&fit=crop&w=1500&q=80" alt="Shipping containers at port terminal" class="h-60 w-full object-cover" loading="lazy" referrerpolicy="no-referrer">
            <div class="p-6">
                <p class="zny-label text-sky-700">Trusted infrastructure</p>
                <p class="mt-2 text-sm text-slate-600">Strong execution ecosystem across airports, ports, and inland logistics gateways.</p>
            </div>
        </aside>
    </section>

    <section class="mt-16 rounded-[1.8rem] border border-slate-800 bg-gradient-to-r from-slate-950 via-[#102b5d] to-slate-900 p-8 text-white shadow-xl shadow-slate-900/35 md:p-10">
        <div class="grid items-center gap-6 lg:grid-cols-[1.2fr_.8fr]">
            <div>
                <p class="zny-label text-sky-300">Tracking portal</p>
                <h3 class="mt-2 text-3xl font-black">{{ site_setting('tracking_cta_text') }}</h3>
                <p class="mt-3 max-w-2xl text-slate-200">Access verified shipment milestones, current location, and operational notes in one secure view.</p>
            </div>
            <div class="flex lg:justify-end">
                <a href="/{{ app()->getLocale() }}/tracking" class="zny-primary-btn">Open Tracking Portal</a>
            </div>
        </div>
    </section>

    <section class="mt-16 grid gap-5 lg:grid-cols-2">
        <article class="zny-card p-7 md:p-8">
            <p class="zny-label text-sky-700">WhatsApp priority desk</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900">Direct response from operations.</h2>
            <p class="mt-3 text-slate-600">For urgent status checks or routing requests, connect immediately with our logistics team.</p>
            <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" class="mt-6 inline-flex items-center justify-center rounded-full bg-[#25D366] px-6 py-3 text-sm font-semibold text-white shadow-[0_20px_36px_rgba(20,90,50,.26)] transition hover:-translate-y-0.5 hover:bg-[#1ebe57]">Open WhatsApp</a>
        </article>

        <article class="zny-card overflow-hidden">
            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1500&q=80" alt="Logistics planning and operations analytics" class="h-48 w-full object-cover" loading="lazy" referrerpolicy="no-referrer">
            <div class="p-7">
                <p class="zny-label text-sky-700">Direct contact</p>
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
