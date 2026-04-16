@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">{{ __('messages.nav_services') }}</h1>
    <ul class="list-disc pl-5 space-y-2 text-slate-700 mb-8">
        <li>{{ __('messages.service_1') }}</li>
        <li>{{ __('messages.service_2') }}</li>
        <li>{{ __('messages.service_3') }}</li>
    </ul>

    <section class="bg-white rounded-xl shadow p-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('messages.request_quote') }}</h2>
        <form method="POST" action="/{{ app()->getLocale() }}/quote-request" class="grid md:grid-cols-2 gap-4">
            @csrf
            <input name="name" class="rounded border px-3 py-2" placeholder="{{ __('messages.name') }}" required>
            <input name="company" class="rounded border px-3 py-2" placeholder="{{ __('messages.company') }}">
            <input name="email" type="email" class="rounded border px-3 py-2" placeholder="Email" required>
            <input name="phone" class="rounded border px-3 py-2" placeholder="Phone" required>
            <input name="origin" class="rounded border px-3 py-2" placeholder="Origin" required>
            <input name="destination" class="rounded border px-3 py-2" placeholder="Destination" required>
            <textarea name="cargo_details" class="rounded border px-3 py-2 md:col-span-2" placeholder="Cargo details" required></textarea>
            <button class="rounded bg-blue-600 px-4 py-2 text-white md:col-span-2">{{ __('messages.send') }}</button>
        </form>
    </section>
@endsection
