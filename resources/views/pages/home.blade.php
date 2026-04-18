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
                'text' => 'Priority international air cargo programs with strict milestone governance and exception response.',
                'image' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1400&q=80',
                'alt' => 'Cargo aircraft at airport logistics terminal',
                'badge' => 'Time-critical',
            ],
            [
                'title' => 'Road Transport',
                'text' => 'Cross-border trucking with calibrated routing, secured handling, and dependable ETA windows.',
                'image' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=1400&q=80',
                'alt' => 'Freight truck on modern expressway',
                'badge' => 'Regional depth',
            ],
            [
                'title' => 'Ocean Freight',
                'text' => 'Containerized maritime execution across major trade lanes from port planning to inland handoff.',
                'image' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=1400&q=80',
                'alt' => 'Container vessel at maritime terminal',
                'badge' => 'Global lanes',
            ],
        ];

        $highlights = [
            ['value' => '24/7', 'label' => 'Control desk'],
            ['value' => '99.2%', 'label' => 'On-time milestones'],
            ['value' => '45+', 'label' => 'Trade lanes'],
            ['value' => '1:1', 'label' => 'Dedicated manager'],
        ];
    @endphp

    <section class="relative overflow-hidden rounded-[2.2rem] border border-slate-900/70 bg-gradient-to-br from-slate-950 via-[#071b42] to-[#123f93] p-8 text-white shadow-[0_26px_64px_rgba(6,20,45,.42)] md:p-12">
        <div class="absolute inset-0 opacity-[0.24]" style="background-image: radial-gradient(circle at 15% 18%, rgba(255,255,255,.34) 1px, transparent 1px), radial-gradient(circle at 86% 72%, rgba(55,169,255,.34) 1px, transparent 1px); background-size: 120px 120px, 150px 150px;"></div>
        <div class="absolute -top-28 right-[-4.8rem] h-[22rem] w-[22rem] rounded-full bg-cyan-400/22 blur-3xl"></div>
        <div class="absolute -bottom-32 left-[-5rem] h-[20rem] w-[20rem] rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative z-10 grid items-center gap-10 lg:grid-cols-[1.03fr_.97fr]">
            <div class="max-w-2xl">
                <p class="zny-pill zny-reveal zny-reveal-delay-1 inline-flex text-sky-100">Enterprise Logistics, Premium Execution</p>
                <h1 class="zny-reveal zny-reveal-delay-2 mt-5 text-[2.15rem] font-black leading-tight md:text-[3.2rem]">Global freight orchestration built for teams that run on precision.</h1>
                <p class="zny-reveal zny-reveal-delay-2 mt-5 max-w-xl text-base text-slate-200 md:text-lg">{{ $siteSettings['company_name'] ?? 'ZNY LOGISTICS' }} integrates air cargo, road freight, maritime shipping, and warehousing into one accountable operating model with clear communication and reliable outcomes.</p>

                <div class="zny-reveal zny-reveal-delay-3 mt-8 flex flex-wrap gap-3">
                    <a href="/{{ app()->getLocale() }}/contact" class="zny-primary-btn">Request Strategic Quote</a>
                    <a href="/{{ app()->getLocale() }}/tracking" class="zny-secondary-btn !text-white !border-white/35 !bg-white/10 hover:!bg-white/16">Track Shipment</a>
                </div>

                <div class="zny-reveal zny-reveal-delay-3 mt-8 grid gap-3 sm:grid-cols-3">
                    <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-sky-100">Visibility</p>
                        <p class="mt-1 text-sm font-semibold text-white">Milestone-level updates</p>
                    </div>
                    <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-sky-100">Reliability</p>
                        <p class="mt-1 text-sm font-semibold text-white">Proactive exception control</p>
                    </div>
                    <div class="rounded-2xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-sm">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-sky-100">Scale</p>
                        <p class="mt-1 text-sm font-semibold text-white">International network coverage</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 zny-reveal zny-reveal-delay-3">
                <article class="zny-soft-card overflow-hidden border-white/20 bg-white/12 p-4 text-white">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1500&q=80" alt="Warehouse logistics operations" class="h-56 w-full rounded-2xl object-cover" loading="lazy" referrerpolicy="no-referrer">
                    <div class="mt-4 flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-sky-100">Control Tower</p>
                            <p class="text-sm font-semibold">Unified planning across air, road, and ocean</p>
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
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-800">Core Services</p>
                <h2 class="mt-2 text-3xl font-black text-slate-900 md:text-4xl">Modal expertise, coordinated as one premium workflow.</h2>
            </div>
            <p class="max-w-xl text-sm text-slate-600">Each movement is engineered around speed, cost discipline, and predictable execution for enterprise supply chains.</p>
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
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Why Global Teams Choose ZNY</p>
            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                <article class="rounded-2xl border border-slate-200/80 bg-white/75 p-5">
                    <h3 class="text-base font-bold">Single operational layer</h3>
                    <p class="mt-2 text-sm text-slate-600">From booking through final delivery, milestones and risks stay inside one accountable command structure.</p>
                </article>
                <article class="rounded-2xl border border-slate-200/80 bg-white/75 p-5">
                    <h3 class="text-base font-bold">Executive-ready communication</h3>
                    <p class="mt-2 text-sm text-slate-600">Clarity for procurement, finance, and supply chain leaders who need confidence at every decision point.</p>
                </article>
                <article class="rounded-2xl border border-slate-200/80 bg-white/75 p-5 sm:col-span-2">
                    <h3 class="text-base font-bold">Performance-calibrated routing</h3>
                    <p class="mt-2 text-sm text-slate-600">We tune transport mix around your timing, budget, and reliability goals without compromising service quality.</p>
                </article>
            </div>
        </div>

        <aside class="zny-card overflow-hidden">
            <img src="https://images.unsplash.com/photo-1616432043562-3671ea2e5242?auto=format&fit=crop&w=1400&q=80" alt="Shipping containers at port terminal" class="h-60 w-full object-cover" loading="lazy" referrerpolicy="no-referrer">
            <div class="p-6">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-sky-700">Trusted Infrastructure</p>
                <p class="mt-2 text-sm text-slate-600">Strong partner ecosystem across airports, ports, and inland transfer points.</p>
            </div>
        </aside>
    </section>

    <section class="mt-16 rounded-[1.8rem] border border-slate-800 bg-gradient-to-r from-slate-950 via-[#102b5d] to-slate-900 p-8 text-white shadow-xl shadow-slate-900/35 md:p-10">
        <div class="grid items-center gap-6 lg:grid-cols-[1.2fr_.8fr]">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-300">Tracking Portal</p>
                <h3 class="mt-2 text-3xl font-black">{{ site_setting('tracking_cta_text') }}</h3>
                <p class="mt-3 max-w-2xl text-slate-200">Monitor current location, milestone timestamps, and operational notes in a secure visibility environment.</p>
            </div>
            <div class="flex lg:justify-end">
                <a href="/{{ app()->getLocale() }}/tracking" class="zny-primary-btn">Open Tracking Portal</a>
            </div>
        </div>
    </section>

    <section class="mt-16 grid gap-5 lg:grid-cols-2">
        <article class="zny-card p-7 md:p-8">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">WhatsApp Priority Desk</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900">Rapid support from logistics specialists.</h2>
            <p class="mt-3 text-slate-600">For urgent route questions, live shipment updates, and quote coordination, connect instantly with operations.</p>
            <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" class="mt-6 inline-flex items-center justify-center rounded-full bg-[#25D366] px-6 py-3 text-sm font-semibold text-white shadow-[0_20px_36px_rgba(20,90,50,.26)] transition hover:-translate-y-0.5 hover:bg-[#1ebe57]">Open WhatsApp</a>
        </article>

        <article class="zny-card overflow-hidden">
            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1400&q=80" alt="Logistics planning and operations analytics" class="h-48 w-full object-cover" loading="lazy" referrerpolicy="no-referrer">
            <div class="p-7">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Direct Contact</p>
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
