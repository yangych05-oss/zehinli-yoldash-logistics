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
            <h2 class="text-2xl font-bold mb-2">Scan & Visit</h2>
            <p class="text-slate-600 mb-4">Use this QR code to open our domain instantly.</p>
            <img
                src="https://api.qrserver.com/v1/create-qr-code/?size=280x280&data=https://znylogistic.com"
                alt="QR code linking to znylogistic.com"
                class="rounded-xl border border-slate-200 p-2 bg-white w-full max-w-[280px] mx-auto"
            >
            <p class="mt-4 text-center text-sm text-slate-500">https://znylogistic.com</p>
        </aside>
    </section>
@endsection
