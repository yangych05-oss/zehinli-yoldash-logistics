@extends('layouts.app')

@section('content')
    <section class="zny-shell rounded-3xl bg-slate-950 text-white p-8 md:p-12 overflow-hidden">
        <div class="relative z-10 grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <p class="text-sky-300 font-semibold tracking-[0.2em] uppercase text-xs mb-4">Premium International Logistics</p>
                <h1 class="text-4xl md:text-5xl font-black leading-tight mb-5">
                    Seamless cargo flows for modern B2B supply chains.
                </h1>
                <p class="text-slate-200 text-lg mb-8 max-w-xl">
                    ZNY LOGISTICS combines air freight, road transport, warehousing and customs support in one integrated, data-driven service model.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="/{{ app()->getLocale() }}/tracking" class="rounded-full bg-sky-500 px-6 py-3 text-sm font-semibold text-slate-950 hover:bg-sky-400 transition">Track Shipment</a>
                    <a href="/{{ app()->getLocale() }}/contact" class="rounded-full border border-slate-500 px-6 py-3 text-sm font-semibold hover:border-sky-300 hover:text-sky-300 transition">Request Consultation</a>
                </div>
                <div class="mt-8 flex flex-wrap gap-6 text-sm text-slate-300">
                    <span>🌍 Global Reach</span>
                    <span>⏱ Time-Critical Deliveries</span>
                    <span>🔒 Transparent Tracking</span>
                </div>
            </div>

            <div class="zny-card p-6 md:p-8 text-slate-900">
                <h2 class="text-2xl font-bold mb-2">{{ __('messages.request_quote') }}</h2>
                <p class="text-slate-600 mb-4">Share your shipment details and our team will respond promptly.</p>
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
                    <button class="w-full rounded-xl bg-slate-900 px-4 py-2.5 text-white font-semibold hover:bg-slate-700 transition">{{ __('messages.send') }}</button>
                </form>
            </div>
        </div>
    </section>

    <section class="mt-14">
        <div class="flex items-end justify-between gap-4 mb-6">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">What We Offer</p>
                <h2 class="text-3xl font-black mt-2">Comprehensive Logistics Services</h2>
            </div>
        </div>
        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">
            @php
                $services = [
                    ['icon' => '✈️', 'title' => 'Air Freight', 'text' => 'Priority international and regional air cargo operations.'],
                    ['icon' => '🚚', 'title' => 'Road Transport', 'text' => 'Reliable cross-border and domestic trucking capacity.'],
                    ['icon' => '🏬', 'title' => 'Warehousing', 'text' => 'Secure storage, consolidation and distribution support.'],
                    ['icon' => '📍', 'title' => 'Cargo Tracking', 'text' => 'Milestone visibility and shipment status transparency.'],
                    ['icon' => '🧾', 'title' => 'Customs Support', 'text' => 'Clearance guidance and trade documentation management.'],
                    ['icon' => '🧩', 'title' => 'Integrated Logistics', 'text' => 'End-to-end orchestration built for B2B operations.'],
                ];
            @endphp
            @foreach($services as $service)
                <article class="zny-card p-6 hover:-translate-y-1 transition duration-300">
                    <div class="w-11 h-11 rounded-xl bg-sky-100 text-2xl grid place-items-center mb-4">{{ $service['icon'] }}</div>
                    <h3 class="text-xl font-bold mb-2">{{ $service['title'] }}</h3>
                    <p class="text-slate-600">{{ $service['text'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mt-16 grid lg:grid-cols-2 gap-6">
        <div class="zny-card p-7">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Why Choose Us</p>
            <h2 class="text-3xl font-black mt-2 mb-4">Trusted by businesses moving critical cargo.</h2>
            <ul class="space-y-3 text-slate-700">
                <li>✔ Agile response for urgent operational needs.</li>
                <li>✔ Experienced team in international freight regulations.</li>
                <li>✔ Single-point communication with proactive updates.</li>
                <li>✔ Tailored routing for cost-efficiency and speed.</li>
            </ul>
        </div>

        <div class="rounded-2xl bg-gradient-to-br from-slate-900 to-blue-900 p-7 text-white">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-300">Tracking CTA</p>
            <h3 class="text-2xl font-black mt-2">Need a live shipment update?</h3>
            <p class="text-slate-200 mt-3">Use our secure tracking portal for real-time location and status checkpoints.</p>
            <a href="/{{ app()->getLocale() }}/tracking" class="inline-block mt-6 rounded-full bg-sky-400 px-6 py-3 text-sm font-bold text-slate-950 hover:bg-sky-300 transition">Open Tracking Portal</a>
        </div>
    </section>

    <section class="mt-16 zny-card p-7 md:p-8">
        <div class="max-w-2xl mx-auto text-center">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Quick Contact</p>
            <h2 class="text-3xl font-black mt-2 mb-4">Reach our team in one scan.</h2>
            <p class="text-slate-600 mb-6">Use WhatsApp for instant support on pricing, shipment updates, and routing inquiries.</p>
            <img
                src="/images/qr_clean.png"
                alt="WhatsApp QR code for quick contact"
                class="mx-auto rounded-2xl border border-slate-200 p-3 bg-white max-w-[220px] shadow-sm"
            >
            <a
                href="https://wa.me/99364918998"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex mt-6 items-center justify-center rounded-xl bg-[#25D366] px-6 py-3 text-sm font-semibold text-white hover:bg-[#1ebe57] transition-colors shadow-sm"
            >
                Open WhatsApp
            </a>
        </div>
    </section>

    <section class="mt-16 zny-card p-7 md:p-8">
        <div class="grid lg:grid-cols-[1.3fr_.7fr] gap-8 items-center">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Contact</p>
                <h2 class="text-3xl font-black mt-2 mb-4">Let's optimize your supply chain.</h2>
                <p class="text-slate-700 mb-4">Call +99364 918998 or email info@znylogistics.com / akja@znylogistics.com</p>
                <p class="text-slate-600">Rysgal BC, 917, Ashgabat, Turkmenistan</p>
                <a href="/{{ app()->getLocale() }}/contact" class="inline-block mt-5 rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-700 transition">Go to Contact Form</a>
            </div>
            <div class="text-center">
                <img
                    src="/images/qr_clean.png"
                    alt="QR code for ZNY LOGISTICS WhatsApp"
                    class="mx-auto rounded-2xl border border-slate-200 p-3 bg-white max-w-[220px] shadow-sm"
                >
                <p class="mt-3 text-sm text-slate-600">Scan to connect with <span class="font-semibold">ZNY LOGISTICS</span></p>
            </div>
        </div>
    </section>
@endsection
