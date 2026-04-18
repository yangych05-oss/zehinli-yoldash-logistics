@extends('layouts.app')

@section('content')
    <section class="rounded-[2rem] border border-slate-800 bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 p-8 text-white shadow-xl md:p-10">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-300">Shipment Visibility</p>
        <h1 class="mt-2 text-4xl font-black">{{ __('messages.track_shipment') }}</h1>
        <p class="mt-3 max-w-2xl text-slate-200">Enter tracking code and public access code to view real-time route status and latest operational milestones.</p>
    </section>

    <section class="mt-10 zny-card p-6 md:p-8">
        <p class="mb-4 text-slate-600">Need immediate support? {{ site_setting('email_primary') }} · {{ site_setting('phone_primary') }}</p>
        <form method="POST" action="/{{ app()->getLocale() }}/tracking" class="grid gap-3 md:grid-cols-2">
            @csrf
            <input name="tracking_code" class="w-full rounded-xl border border-slate-200 px-3 py-2.5" placeholder="ZYL-2026-0001" required>
            <input name="public_access_code" class="w-full rounded-xl border border-slate-200 px-3 py-2.5" placeholder="Access code" required>
            <button class="zny-primary-btn md:col-span-2">{{ __('messages.search') }}</button>
        </form>
    </section>

    @if($shipment)
        <section class="mt-8 zny-card p-6 md:p-8 space-y-4">
            <h2 class="text-2xl font-black">Shipment Summary</h2>
            <div class="grid gap-3 text-slate-700 sm:grid-cols-2">
                <p><strong>{{ __('messages.status') }}:</strong> {{ $shipment->status }}</p>
                <p><strong>{{ __('messages.current_location') }}:</strong> {{ $shipment->current_location }}</p>
                <p><strong>{{ __('messages.origin') }}:</strong> {{ $shipment->origin }}</p>
                <p><strong>{{ __('messages.destination') }}:</strong> {{ $shipment->destination }}</p>
            </div>

            @if($shipment->events->count())
                <h3 class="pt-2 text-lg font-bold">Timeline</h3>
                <ul class="space-y-3">
                    @foreach($shipment->events as $event)
                        <li class="rounded-xl border border-slate-200 bg-slate-50/90 p-4">
                            <p class="font-semibold text-slate-900">{{ $event->status }} @if($event->location)- {{ $event->location }}@endif</p>
                            <p class="text-sm text-slate-600">{{ $event->description }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    @endif
@endsection
