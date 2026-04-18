@extends('layouts.app')

@section('content')
    <section class="rounded-3xl bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 text-white p-8 md:p-10 mb-8 border border-slate-800">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-300">Shipment Visibility</p>
        <h1 class="text-4xl font-black mt-2 mb-3">{{ __('messages.track_shipment') }}</h1>
        <p class="text-slate-200 max-w-2xl">Enter your tracking code and public access code for real-time location, status updates, and delivery milestones.</p>
    </section>

    <section class="zny-card p-6 md:p-8 mb-7">
        <p class="text-slate-600 mb-4">Need help now? {{ $siteSettings['email_primary'] }} · {{ $siteSettings['phone_primary'] }}</p>
        <form method="POST" action="/{{ app()->getLocale() }}/tracking" class="grid md:grid-cols-2 gap-3">
            @csrf
            <input name="tracking_code" class="rounded-xl border border-slate-200 px-3 py-2.5 w-full" placeholder="ZYL-2026-0001" required>
            <input name="public_access_code" class="rounded-xl border border-slate-200 px-3 py-2.5 w-full" placeholder="Access code" required>
            <button class="rounded-xl bg-slate-900 px-4 py-2.5 text-white md:col-span-2 font-semibold hover:bg-blue-900 transition">{{ __('messages.search') }}</button>
        </form>
    </section>

    @if($shipment)
        <section class="zny-card p-6 md:p-8 space-y-3">
            <h2 class="text-2xl font-black mb-2">Shipment Summary</h2>
            <div class="grid sm:grid-cols-2 gap-3 text-slate-700">
                <p><strong>{{ __('messages.status') }}:</strong> {{ $shipment->status }}</p>
                <p><strong>{{ __('messages.current_location') }}:</strong> {{ $shipment->current_location }}</p>
                <p><strong>{{ __('messages.origin') }}:</strong> {{ $shipment->origin }}</p>
                <p><strong>{{ __('messages.destination') }}:</strong> {{ $shipment->destination }}</p>
            </div>

            @if($shipment->events->count())
                <h3 class="font-bold text-lg mt-5">Timeline</h3>
                <ul class="space-y-3">
                    @foreach($shipment->events as $event)
                        <li class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                            <p class="font-semibold text-slate-900">{{ $event->status }} @if($event->location)- {{ $event->location }}@endif</p>
                            <p class="text-sm text-slate-600">{{ $event->description }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    @endif
@endsection
