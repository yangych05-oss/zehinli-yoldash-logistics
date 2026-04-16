@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">{{ __('messages.track_shipment') }}</h1>
    <form method="POST" action="/{{ app()->getLocale() }}/tracking" class="flex gap-2 mb-6">
        @csrf
        <input name="tracking_number" class="rounded border px-3 py-2 w-full" placeholder="ZYL-2026-0001" required>
        <button class="rounded bg-slate-900 px-4 py-2 text-white">{{ __('messages.search') }}</button>
    </form>

    @if($shipment)
        <div class="bg-white rounded-xl shadow p-6">
            <p><strong>{{ __('messages.status') }}:</strong> {{ $shipment->status }}</p>
            <p><strong>{{ __('messages.origin') }}:</strong> {{ $shipment->origin }}</p>
            <p><strong>{{ __('messages.destination') }}:</strong> {{ $shipment->destination }}</p>
            <p><strong>{{ __('messages.current_location') }}:</strong> {{ $shipment->current_location }}</p>
        </div>
    @endif
@endsection
