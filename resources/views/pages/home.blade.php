@extends('layouts.app')

@section('content')
    @php
        $siteSettings = array_merge(
            site_setting_defaults(),
            is_array($siteSettings ?? null) ? $siteSettings : []
        );

        $services = [
            [
                'title' => 'Air Freight Command',
                'text' => 'Priority uplift programs for critical cargo with strict SLA governance and milestone validation at every transfer point.',
                'image' => asset('images/premium/cargo-aircraft.svg'),
                'alt' => 'Cargo aircraft loading at an international terminal',
                'badge' => 'Time-definite',
            ],
            [
                'title' => 'Road Freight Network',
                'text' => 'Cross-border trucking built around secure handling protocols, disciplined route design, and predictable arrival windows.',
                'image' => asset('images/premium/freight-truck.svg'),
                'alt' => 'Freight truck on modern highway at sunrise',
                'badge' => 'Controlled transit',
            ],
            [
                'title' => 'Ocean Freight Execution',
                'text' => 'Containerized shipping across strategic lanes with port coordination, customs alignment, and inland continuity.',
                'image' => asset('images/premium/cargo-port.svg'),
                'alt' => 'Container terminal with cranes and vessel operations',
                'badge' => 'Global continuity',
            ],
        ];

        $operatingPillars = [
            ['title' => 'Governance by design', 'text' => 'Single-account ownership with executive-level reporting cadence.'],
            ['title' => 'Precision milestones', 'text' => 'Every handoff tracked, verified, and escalated before disruption.'],
            ['title' => 'International control', 'text' => 'Aligned mode strategy across air, road, ocean, and warehouse flows.'],
        ];

        $highlights = [
            ['value' => '24/7', 'label' => 'Operations governance'],
            ['value' => '50+', 'label' => 'Active corridors'],
            ['value' => '99.2%', 'label' => 'On-plan milestone ratio'],
            ['value' => '<15m', 'label' => 'Critical response target'],
        ];
    @endphp

    <section class="relative overflow-hidden rounded-[2.25rem] border border-slate-900/75 bg-[#031634] p-8 text-white shadow-[0_40px_95px_rgba(3,15,38,.58)] md:p-12">
        <img src="{{ asset('images/premium/hero-logistics.svg') }}" alt="Global logistics operations with aircraft, freight, and port infrastructure" class="absolute inset-0 h-full w-full object-cover opacity-28" loading="eager">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_12%_22%,rgba(85,192,255,.28),transparent_38%),linear-gradient(122deg,rgba(2,11,28,.88),rgba(7,32,79,.76)_46%,rgba(4,15,40,.95))]"></div>

        <div class="relative z-10 grid items-center gap-10 lg:grid-cols-[1.08fr_.92fr]">
            <div class="max-w-2xl">
                <p class="zny-label inline-flex rounded-full border border-white/25 bg-white/10 px-3 py-2 text-sky-100">Enterprise Logistics Infrastructure</p>
                <h1 class="mt-6 text-[2.1rem] font-black leading-[1.03] md:text-[3.35rem]">Freight certainty for global supply chains.</h1>
                <p class="mt-5 max-w-xl text-base text-slate-200 md:text-lg">{{ $siteSettings['company_name'] ?? 'ZNY LOGISTICS' }} delivers governed international transport with measurable precision, proactive risk control, and boardroom-grade accountability.</p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="/{{ app()->getLocale() }}/contact" class="zny-primary-btn">Request Enterprise Consultation</a>
                    <a href="/{{ app()->getLocale() }}/tracking" class="zny-secondary-btn !text-white !border-white/35 !bg-white/8 hover:!bg-white/16">Open Secure Tracking</a>
                </div>

                <div class="mt-8 grid gap-3 sm:grid-cols-3">
                    <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-sky-100">Integrity</p>
                        <p class="mt-1 text-sm font-semibold text-white">Validated milestone chain</p>
                    </div>
                    <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-sky-100">Reliability</p>
                        <p class="mt-1 text-sm font-semibold text-white">Disciplined ETA adherence</p>
                    </div>
                    <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-sky-100">Assurance</p>
                        <p class="mt-1 text-sm font-semibold text-white">Senior operations oversight</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-4">
                <article class="zny-soft-card overflow-hidden border-white/20 bg-white/12 p-4 text-white">
                    <img src="{{ asset('images/premium/warehouse-operations.svg') }}" alt="Warehouse operations control center with staff monitoring cargo" class="h-60 w-full rounded-2xl object-cover" loading="lazy">
                    <div class="mt-4 flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-sky-100">Operational Control Tower</p>
                            <p class="text-sm font-semibold">One governance framework from origin release to final handover</p>
                        </div>
                        <span class="rounded-full border border-white/25 bg-white/10 px-3 py-1 text-xs">Verified</span>
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
        <div class="mb-9 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="zny-label text-sky-800">Modal Expertise</p>
                <h2 class="mt-2 text-3xl font-black text-slate-900 md:text-4xl">Designed for enterprise continuity and risk control.</h2>
            </div>
            <p class="max-w-xl text-sm text-slate-600">Every shipment plan is engineered for service-level precision, landed-cost discipline, and resilient international execution.</p>
        </div>

        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach($services as $service)
                <article class="group zny-card overflow-hidden transition duration-300 hover:-translate-y-1.5 hover:shadow-[0_30px_56px_rgba(7,26,58,0.14)]">
                    <img src="{{ $service['image'] }}" alt="{{ $service['alt'] }}" class="h-48 w-full object-cover transition duration-700 group-hover:scale-[1.03]" loading="lazy">
                    <div class="p-6">
                        <p class="mb-3 text-[11px] font-bold uppercase tracking-[0.2em] text-sky-700">{{ $service['badge'] }}</p>
                        <h3 class="text-xl font-bold text-slate-900">{{ $service['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $service['text'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mt-16 grid gap-5 lg:grid-cols-[1.36fr_.64fr]">
        <div class="zny-card p-7 md:p-8">
            <p class="zny-label text-sky-700">Why procurement and operations teams choose ZNY</p>
            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                @foreach($operatingPillars as $pillar)
                    <article class="rounded-2xl border border-slate-200/80 bg-white/75 p-5 {{ $loop->last ? 'sm:col-span-2' : '' }}">
                        <h3 class="text-base font-bold">{{ $pillar['title'] }}</h3>
                        <p class="mt-2 text-sm text-slate-600">{{ $pillar['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>

        <aside class="zny-card overflow-hidden">
            <img src="{{ asset('images/premium/cargo-port.svg') }}" alt="High-volume container yard with logistics cranes" class="h-60 w-full object-cover" loading="lazy">
            <div class="p-6">
                <p class="zny-label text-sky-700">Infrastructure confidence</p>
                <p class="mt-2 text-sm text-slate-600">Execution support across airports, ports, bonded facilities, and inland distribution hubs.</p>
            </div>
        </aside>
    </section>

    <section class="mt-16 rounded-[1.8rem] border border-slate-800 bg-gradient-to-r from-slate-950 via-[#102b5d] to-slate-900 p-8 text-white shadow-xl shadow-slate-900/35 md:p-10">
        <div class="grid items-center gap-6 lg:grid-cols-[1.2fr_.8fr]">
            <div>
                <p class="zny-label text-sky-300">Client visibility portal</p>
                <h3 class="mt-2 text-3xl font-black">{{ site_setting('tracking_cta_text') }}</h3>
                <p class="mt-3 max-w-2xl text-slate-200">Access authenticated status milestones, route context, and operational notes from one secure interface.</p>
            </div>
            <div class="flex lg:justify-end">
                <a href="/{{ app()->getLocale() }}/tracking" class="zny-primary-btn">Access Tracking Interface</a>
            </div>
        </div>
    </section>

    <section class="mt-16 grid gap-5 lg:grid-cols-2">
        <article class="zny-card p-7 md:p-8">
            <p class="zny-label text-sky-700">Priority communications</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900">Direct WhatsApp operations desk.</h2>
            <p class="mt-3 text-slate-600">For urgent checks, contingency requests, or shipment adjustments, connect immediately with a live logistics specialist.</p>
            <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" class="mt-6 inline-flex items-center justify-center rounded-full bg-[#25D366] px-6 py-3 text-sm font-semibold text-white shadow-[0_20px_36px_rgba(20,90,50,.26)] transition hover:-translate-y-0.5 hover:bg-[#1ebe57]">Open WhatsApp Priority Line</a>
        </article>

        <article class="zny-card overflow-hidden">
            <img src="{{ asset('images/premium/freight-truck.svg') }}" alt="Enterprise road freight convoy" class="h-48 w-full object-cover" loading="lazy">
            <div class="p-7">
                <p class="zny-label text-sky-700">Executive contact</p>
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
