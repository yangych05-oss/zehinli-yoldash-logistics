@extends('layouts.app')

@section('content')
    <section class="grid md:grid-cols-2 gap-10 items-start">
        <div>
            <h1 class="text-4xl font-bold mb-3">{{ __('messages.hero_title') }}</h1>
            <p class="text-slate-700 mb-3">{{ __('messages.hero_text') }}</p>
            <p class="text-slate-600 mb-6">{{ env('COMPANY_DOMAIN') }}</p>
            <a href="/{{ app()->getLocale() }}/tracking" class="inline-block rounded bg-slate-900 px-5 py-3 text-white">{{ __('messages.track_shipment') }}</a>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold mb-4">{{ __('messages.request_quote') }}</h2>
            <form method="POST" action="/{{ app()->getLocale() }}/quote-request" class="space-y-3">
                @csrf
                <input name="name" class="w-full rounded border px-3 py-2" placeholder="{{ __('messages.name') }}" required>
                <input name="company" class="w-full rounded border px-3 py-2" placeholder="{{ __('messages.company') }}">
                <input name="email" type="email" class="w-full rounded border px-3 py-2" placeholder="Email" required>
                <input name="phone" class="w-full rounded border px-3 py-2" placeholder="Phone" required>
                <input name="origin" class="w-full rounded border px-3 py-2" placeholder="Origin" required>
                <input name="destination" class="w-full rounded border px-3 py-2" placeholder="Destination" required>
                <textarea name="cargo_details" class="w-full rounded border px-3 py-2" placeholder="Cargo details" required></textarea>
                <button class="rounded bg-blue-600 px-4 py-2 text-white">{{ __('messages.send') }}</button>
            </form>
        </div>
    </section>

    <section class="mt-12 bg-white rounded-xl shadow p-6">
        <h2 class="text-2xl font-semibold mb-2">{{ __('messages.contact_us') }}</h2>
        <p class="text-slate-700 mb-4">
            {{ env('COMPANY_PHONE_PRIMARY') }} · {{ env('COMPANY_EMAIL') }} · {{ env('COMPANY_EMAIL_SECONDARY') }}
        </p>
        <form method="POST" action="/{{ app()->getLocale() }}/contact" class="grid md:grid-cols-2 gap-4">
            @csrf
            <input name="name" class="rounded border px-3 py-2" placeholder="{{ __('messages.name') }}" required>
            <input name="email" type="email" class="rounded border px-3 py-2" placeholder="Email" required>
            <input name="phone" class="rounded border px-3 py-2 md:col-span-2" placeholder="Phone">
            <textarea name="message" class="rounded border px-3 py-2 md:col-span-2" rows="4" placeholder="{{ __('messages.message') }}" required></textarea>
            <button class="rounded bg-slate-900 px-4 py-2 text-white md:col-span-2">{{ __('messages.send') }}</button>
        </form>
    </section>
@endsection
