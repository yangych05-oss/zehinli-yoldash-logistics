@extends('layouts.app')

@section('content')
    <section class="rounded-3xl bg-gradient-to-r from-slate-950 to-blue-950 text-white p-8 md:p-10 mb-8">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-300">Contact {{ $siteSettings['company_name'] }}</p>
        <h1 class="text-4xl font-black mt-2 mb-3">Talk to our international freight team.</h1>
        <p class="text-slate-200 max-w-2xl">For quote requests, routing support, and shipment follow-up, contact us through the form or WhatsApp channel.</p>
    </section>

    <section class="grid lg:grid-cols-[1.1fr_.9fr] gap-8 items-start">
        <div>
            <div class="grid sm:grid-cols-2 gap-4 mb-6">
                <div class="zny-card p-5">
                    <p class="text-xs uppercase tracking-[0.2em] text-sky-700 font-semibold mb-1">Phone</p>
                    <p class="font-bold text-lg">{{ $siteSettings['phone_primary'] }}</p>
                </div>
                <div class="zny-card p-5">
                    <p class="text-xs uppercase tracking-[0.2em] text-sky-700 font-semibold mb-1">Address</p>
                    <p class="text-slate-700">{{ $siteSettings['address'] }}</p>
                </div>
                <div class="zny-card p-5">
                    <p class="text-xs uppercase tracking-[0.2em] text-sky-700 font-semibold mb-1">Email</p>
                    <p class="text-slate-700">{{ $siteSettings['email_primary'] }}</p>
                </div>
                @if($siteSettings['email_secondary'])
                    <div class="zny-card p-5">
                        <p class="text-xs uppercase tracking-[0.2em] text-sky-700 font-semibold mb-1">Alternate</p>
                        <p class="text-slate-700">{{ $siteSettings['email_secondary'] }}</p>
                    </div>
                @endif
            </div>

            <form method="POST" action="/{{ app()->getLocale() }}/contact" class="grid md:grid-cols-2 gap-4 zny-card p-6">
                @csrf
                <input name="name" class="rounded-xl border border-slate-200 px-3 py-2.5" placeholder="{{ __('messages.name') }}" required>
                <input name="email" type="email" class="rounded-xl border border-slate-200 px-3 py-2.5" placeholder="Email" required>
                <input name="phone" class="rounded-xl border border-slate-200 px-3 py-2.5 md:col-span-2" placeholder="Phone">
                <textarea name="message" class="rounded-xl border border-slate-200 px-3 py-2.5 md:col-span-2" rows="5" placeholder="{{ __('messages.message') }}" required></textarea>
                <button class="rounded-xl bg-slate-900 px-4 py-2.5 text-white md:col-span-2 font-semibold hover:bg-blue-900 transition">{{ __('messages.send') }}</button>
            </form>
        </div>

        <aside class="zny-card p-6 lg:sticky lg:top-28">
            <div class="text-center">
                <h2 class="text-2xl font-bold mb-2">Contact us instantly via WhatsApp</h2>
                <p class="text-slate-600 mb-5">Scan the QR to open chat instantly with our logistics support desk.</p>
                <div class="rounded-2xl border border-slate-200 p-3 bg-gradient-to-br from-white to-sky-50">
                    <img
                        src="{{ asset('images/qr_clean.png') }}"
                        alt="WhatsApp QR code for {{ $siteSettings['company_name'] }}"
                        class="rounded-xl border border-slate-200 p-3 bg-white w-full max-w-[260px] mx-auto shadow-sm"
                    >
                </div>
                <p class="mt-4 text-sm text-slate-500">Fast responses for freight, tracking, and quote requests.</p>
                <a
                    href="{{ whatsapp_link() }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="mt-5 inline-flex items-center justify-center rounded-xl px-5 py-2.5 text-sm font-semibold text-white bg-[#25D366] hover:bg-[#1ebe57] transition-colors shadow-sm"
                >
                    Open WhatsApp
                </a>
            </div>
        </aside>
    </section>
@endsection
