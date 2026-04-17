@extends('layouts.app')

@section('content')
    <section class="grid lg:grid-cols-[1.1fr_.9fr] gap-8 items-start">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Contact ZNY LOGISTICS</p>
            <h1 class="text-4xl font-black mt-2 mb-4">Connect with our logistics specialists.</h1>
            <p class="text-slate-700 mb-6">For quote requests, partnership opportunities, or shipment support, reach out through the form or direct channels.</p>

            <div class="zny-card p-6 mb-6 space-y-2 text-slate-700">
                <p><strong>Phone:</strong> +99364 918998</p>
                <p><strong>Email:</strong> info@znylogistics.com</p>
                <p><strong>Alt Email:</strong> akja@znylogistics.com</p>
                <p><strong>Address:</strong> Rysgal BC, 917, Ashgabat, Turkmenistan</p>
            </div>

            <form method="POST" action="/{{ app()->getLocale() }}/contact" class="grid md:grid-cols-2 gap-4 zny-card p-6">
                @csrf
                <input name="name" class="rounded-xl border border-slate-200 px-3 py-2.5" placeholder="{{ __('messages.name') }}" required>
                <input name="email" type="email" class="rounded-xl border border-slate-200 px-3 py-2.5" placeholder="Email" required>
                <input name="phone" class="rounded-xl border border-slate-200 px-3 py-2.5 md:col-span-2" placeholder="Phone">
                <textarea name="message" class="rounded-xl border border-slate-200 px-3 py-2.5 md:col-span-2" rows="5" placeholder="{{ __('messages.message') }}" required></textarea>
                <button class="rounded-xl bg-slate-900 px-4 py-2.5 text-white md:col-span-2 font-semibold hover:bg-slate-700 transition">{{ __('messages.send') }}</button>
            </form>
        </div>

        <aside class="zny-card p-6 lg:sticky lg:top-28">
            <div class="text-center">
                <h2 class="text-2xl font-bold mb-2">Contact us instantly via WhatsApp</h2>
                <p class="text-slate-600 mb-5">Scan the QR code to start a direct chat with our support team anytime.</p>
                <img
                    src="/images/qr_clean.png"
                    alt="WhatsApp QR code for ZNY LOGISTICS"
                    class="rounded-2xl border border-slate-200 p-3 bg-white w-full max-w-[260px] mx-auto shadow-sm"
                >
                <p class="mt-4 text-sm text-slate-500">Fast response for freight, tracking, and quote requests.</p>
                <a
                    href="https://wa.me/99364918998"
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
