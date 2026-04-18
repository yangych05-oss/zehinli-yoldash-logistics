@extends('layouts.app')

@section('content')
    <section class="rounded-[2rem] border border-slate-800 bg-gradient-to-br from-slate-950 via-[#071a3f] to-[#0f2e67] p-8 text-white shadow-xl md:p-10">
        <p class="zny-label text-sky-200">{{ __('messages.nav_services') }}</p>
        <h1 class="mt-2 text-4xl font-black">Enterprise transport capabilities, coordinated as one system.</h1>
        <p class="mt-4 max-w-2xl text-slate-200">Air, road, ocean, and warehousing services designed for international supply chains that require control, speed, and consistency.</p>
    </section>

    <section class="mt-12 grid gap-5 md:grid-cols-3">
        <article class="zny-card overflow-hidden">
            <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1000&q=80" alt="Cargo aircraft logistics" class="h-44 w-full object-cover" loading="lazy" referrerpolicy="no-referrer">
            <div class="p-6">
                <p class="zny-label text-sky-700">Air network</p>
                <p class="mt-2 font-semibold text-slate-900">{{ __('messages.service_1') }}</p>
                <p class="mt-2 text-sm text-slate-600">Priority uplift and controlled transit management for urgent shipments.</p>
            </div>
        </article>
        <article class="zny-card overflow-hidden">
            <img src="https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=1000&q=80" alt="Freight truck logistics" class="h-44 w-full object-cover" loading="lazy" referrerpolicy="no-referrer">
            <div class="p-6">
                <p class="zny-label text-sky-700">Road network</p>
                <p class="mt-2 font-semibold text-slate-900">{{ __('messages.service_2') }}</p>
                <p class="mt-2 text-sm text-slate-600">Cross-border linehaul with secure handling and dependable schedule integrity.</p>
            </div>
        </article>
        <article class="zny-card overflow-hidden">
            <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=1000&q=80" alt="Container ship logistics" class="h-44 w-full object-cover" loading="lazy" referrerpolicy="no-referrer">
            <div class="p-6">
                <p class="zny-label text-sky-700">Ocean network</p>
                <p class="mt-2 font-semibold text-slate-900">{{ __('messages.service_3') }}</p>
                <p class="mt-2 text-sm text-slate-600">Containerized maritime solutions across major trade corridors.</p>
            </div>
        </article>
    </section>

    <section class="mt-12 zny-card p-6 md:p-8">
        <h2 class="text-3xl font-black mb-2">{{ __('messages.request_quote') }}</h2>
        <p class="mb-5 text-slate-600">Share your shipment profile and receive a structured routing proposal from our team.</p>
        <form method="POST" action="/{{ app()->getLocale() }}/quote-request" class="grid md:grid-cols-2 gap-4">
            @csrf
            <input name="name" class="zny-input" placeholder="{{ __('messages.name') }}" required>
            <input name="company" class="zny-input" placeholder="{{ __('messages.company') }}">
            <input name="email" type="email" class="zny-input" placeholder="Email" required>
            <input name="phone" class="zny-input" placeholder="Phone" required>
            <input name="origin" class="zny-input" placeholder="Origin" required>
            <input name="destination" class="zny-input" placeholder="Destination" required>
            <textarea name="cargo_details" class="zny-input md:col-span-2" placeholder="Cargo details" required></textarea>
            <button class="zny-primary-btn md:col-span-2">{{ __('messages.send') }}</button>
        </form>
    </section>
@endsection
