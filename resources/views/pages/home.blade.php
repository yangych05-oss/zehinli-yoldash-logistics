@extends('layouts.app')

@section('content')
    <section class="zny-surface-glow rounded-3xl bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900 text-white p-8 md:p-12 overflow-hidden relative">
        <div class="absolute inset-0 z-0 opacity-50 zny-grid-overlay"></div>
        <div class="pointer-events-none absolute -top-24 -left-8 h-72 w-72 rounded-full bg-sky-400/20 blur-3xl animate-pulse"></div>
        <div class="pointer-events-none absolute -bottom-28 right-[-4rem] h-80 w-80 rounded-full bg-indigo-500/20 blur-3xl animate-pulse [animation-delay:600ms]"></div>
        <div class="pointer-events-none absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 16% 26%, rgba(255,255,255,.22) 1px, transparent 1px), radial-gradient(circle at 78% 68%, rgba(125,211,252,.32) 1px, transparent 1px); background-size: 130px 130px, 160px 160px;"></div>
        <div class="relative z-10 grid lg:grid-cols-[1.02fr_.98fr] gap-10 items-center">
            <div class="max-w-2xl">
                <p class="zny-reveal zny-reveal-delay-1 text-sky-300 font-semibold tracking-[0.24em] uppercase text-xs mb-5">Premium International Logistics</p>
                <h1 class="zny-reveal zny-reveal-delay-2 text-4xl md:text-5xl font-black leading-tight mb-5">
                    Reliable global freight execution for businesses that move fast.
                </h1>
                <p class="zny-reveal zny-reveal-delay-2 text-slate-200 text-lg mb-8 max-w-xl">
                    {{ $siteSettings['company_name'] }} orchestrates international cargo programs with transparent milestones, agile routing, and dependable delivery performance across multimodal lanes.
                </p>
                <div class="zny-reveal zny-reveal-delay-3 flex flex-wrap gap-3">
                    <a href="/{{ app()->getLocale() }}/contact" class="rounded-full bg-sky-400 px-6 py-3 text-sm font-semibold text-slate-950 hover:bg-sky-300 transition">Request a Quote</a>
                    <a href="/{{ app()->getLocale() }}/tracking" class="rounded-full border border-slate-400 px-6 py-3 text-sm font-semibold hover:border-sky-300 hover:text-sky-300 transition">Track Shipment</a>
                </div>
                <div class="zny-reveal zny-reveal-delay-3 mt-8 grid sm:grid-cols-3 gap-3 text-sm">
                    <div class="rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-slate-200">
                        <p class="text-[11px] uppercase tracking-[0.16em] text-sky-200">Reliability</p>
                        <p class="mt-1 font-semibold">Stable lane performance</p>
                    </div>
                    <div class="rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-slate-200">
                        <p class="text-[11px] uppercase tracking-[0.16em] text-sky-200">Speed</p>
                        <p class="mt-1 font-semibold">Rapid response operations</p>
                    </div>
                    <div class="rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-slate-200">
                        <p class="text-[11px] uppercase tracking-[0.16em] text-sky-200">Transparency</p>
                        <p class="mt-1 font-semibold">Live milestone visibility</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 zny-reveal zny-reveal-delay-2">
                <div class="rounded-2xl border border-white/15 bg-white/5 p-6 backdrop-blur">
                    <p class="text-xs uppercase tracking-[0.18em] text-sky-200 mb-2">Operations Control Tower</p>
                    <div class="rounded-xl min-h-[220px] border border-white/10 bg-gradient-to-br from-slate-700/30 via-blue-800/20 to-slate-900/40 p-5 flex flex-col justify-between">
                        <div class="flex items-center justify-between text-xs text-slate-300">
                            <span>Air · Road · Integrated Freight</span>
                            <span>24/7</span>
                        </div>
                        <div class="space-y-2">
                            <div class="h-2.5 rounded-full bg-white/15 overflow-hidden">
                                <div class="h-full w-4/5 bg-gradient-to-r from-sky-300 to-sky-500"></div>
                            </div>
                            <div class="h-2.5 rounded-full bg-white/15 overflow-hidden">
                                <div class="h-full w-2/3 bg-gradient-to-r from-indigo-300 to-sky-300"></div>
                            </div>
                        </div>
                        <p class="text-sm text-slate-200/95 max-w-sm">Premium network planning and proactive communication keep your cargo moving with predictable timelines.</p>
                    </div>
                </div>
                <div class="zny-card p-6 md:p-7 text-slate-900">
                    <h2 class="text-2xl font-bold mb-2">{{ __('messages.request_quote') }}</h2>
                    <p class="text-slate-600 mb-4">Share shipment details. Our team replies quickly with a tailored plan.</p>
                    <form method="POST" action="/{{ app()->getLocale() }}/quote-request" class="space-y-3">
                        @csrf
                        <input name="name" class="w-full rounded-xl border border-slate-200 px-3 py-2.5" placeholder="{{ __('messages.name') }}" required>
                        <input name="company" class="w-full rounded-xl border border-slate-200 px-3 py-2.5" placeholder="{{ __('messages.company') }}">
                        <input name="email" type="email" class="w-full rounded-xl border border-slate-200 px-3 py-2.5" placeholder="Email" required>
                        <input name="phone" class="w-full rounded-xl border border-slate-200 px-3 py-2.5" placeholder="Phone" required>
                        <div class="grid sm:grid-cols-2 gap-3">
                            <input name="origin" class="w-full rounded-xl border border-slate-200 px-3 py-2.5" placeholder="Origin" required>
                            <input name="destination" class="w-full rounded-xl border border-slate-200 px-3 py-2.5" placeholder="Destination" required>
                        </div>
                        <textarea name="cargo_details" class="w-full rounded-xl border border-slate-200 px-3 py-2.5" placeholder="Cargo details" required></textarea>
                        <button class="w-full rounded-xl bg-slate-900 px-4 py-2.5 text-white font-semibold hover:bg-blue-900 transition">{{ __('messages.send') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-14">
        <div class="flex items-end justify-between gap-4 mb-6">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">What We Offer</p>
                <h2 class="text-3xl font-black mt-2">Integrated Logistics Services</h2>
            </div>
        </div>
        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">
            @php
                $services = [
                    ['icon' => '✈️', 'title' => 'Air Freight', 'text' => 'Priority international and regional air cargo programs.', 'visual' => 'Airport ramp handling'],
                    ['icon' => '🚚', 'title' => 'Road Transport', 'text' => 'Reliable domestic and cross-border trucking operations.', 'visual' => 'Fleet-ready distribution lanes'],
                    ['icon' => '🏬', 'title' => 'Warehousing', 'text' => 'Secure storage, consolidation, and cross-docking support.', 'visual' => 'Modern palletized facilities'],
                    ['icon' => '📍', 'title' => 'Cargo Tracking', 'text' => 'Milestone visibility with proactive shipment updates.', 'visual' => 'Control tower tracking view'],
                    ['icon' => '🧾', 'title' => 'Customs Support', 'text' => 'Trade documentation and customs clearance guidance.', 'visual' => 'Compliant border processing'],
                    ['icon' => '🧩', 'title' => 'Integrated Logistics', 'text' => 'End-to-end orchestration for B2B supply chains.', 'visual' => 'Unified multimodal planning'],
                ];
            @endphp
            @foreach($services as $service)
                <article class="zny-card p-6 hover:-translate-y-1.5 hover:shadow-xl transition duration-300">
                    <div class="w-11 h-11 rounded-xl bg-sky-100 text-2xl grid place-items-center mb-4">{{ $service['icon'] }}</div>
                    <h3 class="text-xl font-bold mb-2">{{ $service['title'] }}</h3>
                    <p class="text-slate-600 mb-4">{{ $service['text'] }}</p>
                    <div class="rounded-lg border border-dashed border-slate-300 bg-slate-50 p-3 text-xs text-slate-500">Image placeholder: {{ $service['visual'] }}</div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mt-16">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700 mb-4">Why Choose Us</p>
        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-4">
            @php
                $highlights = [
                    ['icon' => '⚡', 'title' => 'Fast Execution', 'text' => 'Rapid coordination for urgent cargo and tight delivery windows.'],
                    ['icon' => '🌐', 'title' => 'International Expertise', 'text' => 'Experienced team in global freight regulations and routes.'],
                    ['icon' => '📞', 'title' => 'Single-Point Communication', 'text' => 'Dedicated support with clear updates from booking to delivery.'],
                    ['icon' => '📊', 'title' => 'Cost-Efficient Planning', 'text' => 'Smart routing to balance speed, reliability, and cost control.'],
                ];
            @endphp
            @foreach($highlights as $feature)
                <article class="zny-card p-6">
                    <div class="text-2xl mb-3">{{ $feature['icon'] }}</div>
                    <h3 class="text-lg font-bold mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-sm text-slate-600">{{ $feature['text'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mt-16 rounded-3xl bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 p-7 md:p-9 text-white border border-slate-800">
        <div class="grid lg:grid-cols-[1.2fr_.8fr] gap-6 items-center">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-300">Tracking CTA</p>
                <h3 class="text-3xl font-black mt-2">{{ $siteSettings['tracking_cta_text'] }}</h3>
                <p class="text-slate-200 mt-3">Use our secure tracking portal for checkpoint visibility, current location, and latest status in one view.</p>
            </div>
            <div class="flex lg:justify-end">
                <a href="/{{ app()->getLocale() }}/tracking" class="inline-flex items-center rounded-full bg-sky-400 px-6 py-3 text-sm font-bold text-slate-950 hover:bg-sky-300 transition">Open Tracking Portal</a>
            </div>
        </div>
    </section>

    <section class="mt-16 zny-card p-7 md:p-8">
        <div class="grid lg:grid-cols-[1fr_auto] gap-8 items-center">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Quick Contact</p>
                <h2 class="text-3xl font-black mt-2 mb-4">Contact us instantly via WhatsApp</h2>
                <p class="text-slate-600 mb-6">For quotes, route planning, and shipment updates, connect with our team directly through WhatsApp.</p>
                <a
                    href="{{ $whatsAppHref }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center justify-center rounded-xl bg-[#25D366] px-6 py-3 text-sm font-semibold text-white hover:bg-[#1ebe57] transition-colors shadow-sm"
                >
                    Open WhatsApp
                </a>
            </div>
            <div class="rounded-2xl border border-slate-200 p-4 bg-gradient-to-br from-white to-sky-50 text-center">
                <img src="{{ asset('images/qr_clean.png') }}" alt="WhatsApp QR code for quick contact" class="mx-auto rounded-xl bg-white p-3 max-w-[190px] shadow-sm">
                <p class="mt-3 text-xs text-slate-500">Scan to chat with {{ $siteSettings['company_name'] }}</p>
            </div>
        </div>
    </section>

    <section class="mt-16 zny-card p-7 md:p-8">
        <div class="grid lg:grid-cols-[1.2fr_.8fr] gap-8 items-center">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Contact</p>
                <h2 class="text-3xl font-black mt-2 mb-4">{{ $siteSettings['contact_cta_text'] }}</h2>
                <ul class="space-y-2 text-slate-700">
                    <li>📞 {{ $siteSettings['phone_primary'] }}</li>
                    <li>✉️ {{ $siteSettings['email_primary'] }}</li>
                    @if($siteSettings['email_secondary'])
                        <li>✉️ {{ $siteSettings['email_secondary'] }}</li>
                    @endif
                    <li>📍 {{ $siteSettings['address'] }}</li>
                </ul>
                <a href="/{{ app()->getLocale() }}/contact" class="inline-block mt-5 rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-900 transition">Go to Contact Form</a>
            </div>
            <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-6 text-slate-500 text-sm">
                <p class="font-semibold text-slate-700 mb-2">Replaceable Visual Zone</p>
                <p>This block is reserved for a future premium office/fleet photo, keeping layout and performance stable.</p>
            </div>
        </div>
    </section>
@endsection
