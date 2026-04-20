@extends('layouts.app')

@section('content')
    @php
        $locale = app()->getLocale();
        $copy = [
            'en' => [
                'eyebrow' => 'International Freight Solutions',
                'title' => 'Track Shipment',
                'text' => 'Access your shipment timeline with secure credentials and clear operational visibility.',
                'code' => 'Tracking code',
                'access' => 'Access code',
                'summary' => 'Shipment Summary',
                'timeline' => 'Timeline',
                'support' => 'Support line',
            ],
            'ru' => [
                'eyebrow' => 'Международные грузовые решения',
                'title' => 'Отследить груз',
                'text' => 'Проверьте маршрут и этапы перевозки по защищённым данным доступа.',
                'code' => 'Трекинг-код',
                'access' => 'Код доступа',
                'summary' => 'Сводка по грузу',
                'timeline' => 'Хронология',
                'support' => 'Линия поддержки',
            ],
            'tm' => [
                'eyebrow' => 'Halkara ýük çözgütleri',
                'title' => 'Ýüki yzarlamak',
                'text' => 'Ýükiň ýagdaýyny we tapgyrlaryny ygtybarly giriş maglumatlary bilen görüň.',
                'code' => 'Yzarlaýyş kody',
                'access' => 'Giriş kody',
                'summary' => 'Ýük maglumaty',
                'timeline' => 'Waka setiri',
                'support' => 'Goldaw liniýasy',
            ],
        ];
        $content = $copy[$locale] ?? $copy['en'];
    @endphp

    <section class="relative overflow-hidden rounded-[2rem] border border-slate-800 bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 p-8 text-white shadow-xl md:p-11">
        <img src="{{ asset('images/premium/cargo-aircraft-premium.svg') }}" alt="Air freight route planning" class="absolute inset-0 h-full w-full object-cover opacity-20" loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-blue-950/85 to-slate-900/90"></div>
        <div class="relative z-10">
            <p class="zny-label text-sky-300">{{ $content['eyebrow'] }}</p>
            <h1 class="mt-2 text-4xl font-black md:text-5xl">{{ $content['title'] }}</h1>
            <p class="mt-4 max-w-2xl text-slate-200 md:text-lg">{{ $content['text'] }}</p>
        </div>
    </section>

    <section class="mt-12 grid gap-6 lg:grid-cols-[1.3fr_.7fr]">
        <div class="zny-card p-7 md:p-9">
            <p class="mb-5 text-slate-600">{{ $content['support'] }}: {{ site_setting('email_primary') }} · {{ site_setting('phone_primary') }}</p>
            <form method="POST" action="/{{ app()->getLocale() }}/tracking" class="grid gap-3 md:grid-cols-2">
                @csrf
                <input name="tracking_code" class="zny-input" placeholder="{{ $content['code'] }}" required>
                <input name="public_access_code" class="zny-input" placeholder="{{ $content['access'] }}" required>
                <button class="zny-primary-btn md:col-span-2">{{ __('messages.search') }}</button>
            </form>
        </div>

        <aside class="zny-card overflow-hidden">
            <img src="{{ asset('images/premium/freight-truck-premium.svg') }}" alt="Road transport operations" class="h-full min-h-[240px] w-full object-cover" loading="lazy">
        </aside>
    </section>

    @if($shipment)
        <section class="mt-8 space-y-4 zny-card p-6 md:p-8">
            <h2 class="text-2xl font-black">{{ $content['summary'] }}</h2>
            <div class="grid gap-3 text-slate-700 sm:grid-cols-2">
                <p><strong>{{ __('messages.status') }}:</strong> {{ $shipment->status }}</p>
                <p><strong>{{ __('messages.current_location') }}:</strong> {{ $shipment->current_location }}</p>
                <p><strong>{{ __('messages.origin') }}:</strong> {{ $shipment->origin }}</p>
                <p><strong>{{ __('messages.destination') }}:</strong> {{ $shipment->destination }}</p>
            </div>

            @if($shipment->events->count())
                <h3 class="pt-2 text-lg font-bold">{{ $content['timeline'] }}</h3>
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
