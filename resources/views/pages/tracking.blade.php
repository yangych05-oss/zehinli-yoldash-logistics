@extends('layouts.app')

@section('content')
    @php
        $locale = app()->getLocale();
        $copy = [
            'en' => [
                'eyebrow' => 'Shipment Intelligence',
                'title' => 'Track shipment status with secure enterprise access.',
                'text' => 'Use your tracking credentials to view shipment progress, operating milestones, and support contacts in one place.',
                'code' => 'Tracking code',
                'access' => 'Access code',
                'summary' => 'Shipment summary',
                'timeline' => 'Movement timeline',
                'support_title' => 'Operations support',
                'support_text' => 'Need help with credentials or shipment status?',
            ],
            'ru' => [
                'eyebrow' => 'Интеллектуальный контроль перевозки',
                'title' => 'Отслеживайте груз по защищённому корпоративному доступу.',
                'text' => 'Используйте ваши коды доступа, чтобы видеть ход перевозки, ключевые этапы и контакты поддержки в одном окне.',
                'code' => 'Трекинг-код',
                'access' => 'Код доступа',
                'summary' => 'Сводка по грузу',
                'timeline' => 'Хронология движения',
                'support_title' => 'Операционная поддержка',
                'support_text' => 'Нужна помощь с доступом или статусом груза?',
            ],
            'tm' => [
                'eyebrow' => 'Ýük hereketine gözegçilik',
                'title' => 'Ýüki korporatiw derejedäki ygtybarly giriş arkaly yzarlaň.',
                'text' => 'Giriş kodlaryňyz bilen daşamanyň ýagdaýyny, möhüm tapgyrlaryny we goldaw maglumatlaryny bir ýerde görüň.',
                'code' => 'Yzarlaýyş kody',
                'access' => 'Giriş kody',
                'summary' => 'Ýük gysgaça maglumaty',
                'timeline' => 'Hereket wagty setiri',
                'support_title' => 'Operasion goldaw',
                'support_text' => 'Giriş ýa-da ýük ýagdaýy boýunça kömek gerekmi?',
            ],
        ];
        $content = $copy[$locale] ?? $copy['en'];
    @endphp

    <section class="relative overflow-hidden rounded-[2.2rem] border border-slate-800 bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 p-8 text-white shadow-[0_40px_95px_rgba(5,18,46,.44)] md:p-12">
        <img src="{{ asset('images/premium/cargo-aircraft-premium.svg') }}" alt="Air freight route planning" class="absolute inset-0 h-full w-full object-cover contrast-[1.08] saturate-[1.1] opacity-24" loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-blue-950/85 to-slate-900/90"></div>
        <div class="relative z-10 max-w-3xl">
            <p class="zny-label text-sky-300">{{ $content['eyebrow'] }}</p>
            <h1 class="mt-2 text-4xl font-black leading-tight md:text-5xl">{{ $content['title'] }}</h1>
            <p class="mt-4 text-slate-200 md:text-lg">{{ $content['text'] }}</p>
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-[1.25fr_.75fr]">
        <div class="zny-card p-7 md:p-10">
            <p class="zny-label text-sky-700">{{ $content['support_title'] }}</p>
            <p class="mt-2 text-slate-600">{{ $content['support_text'] }}</p>
            <p class="mt-1 text-sm text-slate-500">{{ site_setting('email_primary') }} · {{ site_setting('phone_primary') }}</p>
            <form method="POST" action="/{{ app()->getLocale() }}/tracking" class="mt-7 grid gap-3 md:grid-cols-2">
                @csrf
                <input name="tracking_code" class="zny-input" placeholder="{{ $content['code'] }}" required>
                <input name="public_access_code" class="zny-input" placeholder="{{ $content['access'] }}" required>
                <button class="zny-primary-btn md:col-span-2">{{ __('messages.search') }}</button>
            </form>
        </div>

        <aside class="zny-card overflow-hidden">
            <img src="{{ asset('images/premium/freight-truck-premium.svg') }}" alt="Road transport operations" class="h-full min-h-[270px] w-full object-cover contrast-[1.05] saturate-[1.08]" loading="lazy">
        </aside>
    </section>

    @if($shipment)
        <section class="space-y-4 zny-card p-6 md:p-8">
            <h2 class="text-2xl font-black text-slate-900">{{ $content['summary'] }}</h2>
            <div class="grid gap-3 text-slate-700 sm:grid-cols-2">
                <p><strong>{{ __('messages.status') }}:</strong> {{ $shipment->status }}</p>
                <p><strong>{{ __('messages.current_location') }}:</strong> {{ $shipment->current_location }}</p>
                <p><strong>{{ __('messages.origin') }}:</strong> {{ $shipment->origin }}</p>
                <p><strong>{{ __('messages.destination') }}:</strong> {{ $shipment->destination }}</p>
            </div>

            @if($shipment->events->count())
                <h3 class="pt-2 text-lg font-bold text-slate-900">{{ $content['timeline'] }}</h3>
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
