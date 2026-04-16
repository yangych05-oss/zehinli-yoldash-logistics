@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-2">{{ __('messages.track_shipment') }}</h1>
    <p class="text-slate-700 mb-4">Need help? {{ env('COMPANY_EMAIL') }} · {{ env('COMPANY_PHONE_PRIMARY') }}</p>

    <form method="POST" action="/{{ app()->getLocale() }}/tracking" class="grid md:grid-cols-2 gap-2 mb-6">
        @csrf
        <input name="tracking_code" class="rounded border px-3 py-2 w-full" placeholder="ZYL-2026-0001" required>
        <input name="public_access_code" class="rounded border px-3 py-2 w-full" placeholder="Access code" required>
        <button class="rounded bg-slate-900 px-4 py-2 text-white md:col-span-2">{{ __('messages.search') }}</button>
    </form>

    @if($shipment)
        <div class="bg-white rounded-xl shadow p-6 space-y-1">
            <p><strong>{{ __('messages.status') }}:</strong> {{ $shipment->status }}</p>
            <p><strong>{{ __('messages.origin') }}:</strong> {{ $shipment->origin }}</p>
            <p><strong>{{ __('messages.destination') }}:</strong> {{ $shipment->destination }}</p>
            <p><strong>{{ __('messages.current_location') }}:</strong> {{ $shipment->current_location }}</p>

            @if($shipment->events->count())
                <h2 class="font-semibold text-lg mt-4">Timeline</h2>
                <ul class="space-y-2">
                    @foreach($shipment->events as $event)
                        <li class="border rounded p-2">
                            <p class="font-medium">{{ $event->status }} @if($event->location)- {{ $event->location }}@endif</p>
                            <p class="text-sm text-slate-600">{{ $event->description }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif
@endsection
