@extends('layouts.app')

@section('content')
    @php
        $siteSettings = array_merge(
            site_setting_defaults(),
            is_array($siteSettings ?? null) ? $siteSettings : []
        );
    @endphp

    <section class="rounded-[2rem] border border-slate-800 bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 p-8 text-white shadow-xl md:p-10">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-300">Contact {{ $siteSettings['company_name'] ?? 'ZNY LOGISTICS' }}</p>
        <h1 class="mt-2 text-4xl font-black">Talk directly with our international freight specialists.</h1>
        <p class="mt-3 max-w-2xl text-slate-200">Request pricing, routing support, or shipment updates through a premium support experience.</p>
    </section>

    <section class="mt-10 grid items-start gap-8 lg:grid-cols-[1.1fr_.9fr]">
        <div>
            <div class="mb-6 grid gap-4 sm:grid-cols-2">
                <div class="zny-card p-5">
                    <p class="text-xs uppercase tracking-[0.2em] text-sky-700 font-semibold mb-1">Phone</p>
                    <p class="text-lg font-bold">{{ site_setting('phone_primary') }}</p>
                </div>
                <div class="zny-card p-5">
                    <p class="text-xs uppercase tracking-[0.2em] text-sky-700 font-semibold mb-1">Address</p>
                    <p class="text-slate-700">{{ site_setting('address') }}</p>
                </div>
                <div class="zny-card p-5">
                    <p class="text-xs uppercase tracking-[0.2em] text-sky-700 font-semibold mb-1">Email</p>
                    <p class="text-slate-700">{{ site_setting('email_primary') }}</p>
                </div>
                @if(site_setting('email_secondary'))
                    <div class="zny-card p-5">
                        <p class="text-xs uppercase tracking-[0.2em] text-sky-700 font-semibold mb-1">Alternate</p>
                        <p class="text-slate-700">{{ site_setting('email_secondary') }}</p>
                    </div>
                @endif
            </div>

            <form method="POST" action="/{{ app()->getLocale() }}/contact" class="zny-card grid gap-4 p-6 md:grid-cols-2">
                @csrf
                <input name="name" class="zny-input" placeholder="{{ __('messages.name') }}" required>
                <input name="email" type="email" class="zny-input" placeholder="Email" required>
                <input name="phone" class="zny-input md:col-span-2" placeholder="Phone">
                <textarea name="message" rows="5" class="zny-input md:col-span-2" placeholder="{{ __('messages.message') }}" required></textarea>
                <button class="zny-primary-btn md:col-span-2">{{ __('messages.send') }}</button>
            </form>
        </div>

        <aside class="zny-card overflow-hidden lg:sticky lg:top-28">
            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1200&q=80" alt="Logistics team planning operations" class="h-44 w-full object-cover" loading="lazy" referrerpolicy="no-referrer">
            <div class="p-6 text-center">
                <h2 class="text-2xl font-black mb-2">WhatsApp Priority Line</h2>
                <p class="text-slate-600 mb-5">Scan the QR code to open direct chat with our logistics support desk.</p>
                <div class="rounded-2xl border border-slate-200 p-3 bg-gradient-to-br from-white to-sky-50">
                    <img src="{{ asset('images/qr_clean.png') }}" alt="WhatsApp QR code for {{ $siteSettings['company_name'] ?? 'ZNY LOGISTICS' }}" class="rounded-xl border border-slate-200 p-3 bg-white w-full max-w-[260px] mx-auto shadow-sm">
                </div>
                <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex items-center justify-center rounded-full bg-[#25D366] px-5 py-2.5 text-sm font-semibold text-white shadow-[0_16px_28px_rgba(20,90,50,.2)] transition hover:-translate-y-0.5 hover:bg-[#1ebe57]">Open WhatsApp</a>
            </div>
        </aside>
    </section>
@endsection
