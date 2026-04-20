@extends('layouts.app')

@section('content')
    @php
        $locale = app()->getLocale();
        $copy = [
            'en' => [
                'eyebrow' => 'Service Portfolio',
                'title' => 'Enterprise logistics services coordinated as one high-performance system.',
                'text' => 'From urgent air cargo to multimodal route design, every service is aligned to give your operations speed, control, and predictable delivery outcomes.',
                'cards' => [
                    ['label' => 'Air network', 'title' => 'Air Freight', 'text' => 'Priority uplift, carrier coordination, and strict transit control for time-sensitive cargo.', 'image' => asset('images/premium/cargo-aircraft-premium.svg'), 'alt' => 'Cargo aircraft logistics'],
                    ['label' => 'Road network', 'title' => 'Road Freight', 'text' => 'Reliable regional and cross-border linehaul with secure handling standards.', 'image' => asset('images/premium/freight-truck-premium.svg'), 'alt' => 'Freight truck logistics'],
                    ['label' => 'Ocean network', 'title' => 'Ocean Freight', 'text' => 'Containerized maritime solutions across major trade corridors with clear milestones.', 'image' => asset('images/premium/cargo-port-premium.svg'), 'alt' => 'Container port logistics'],
                ],
                'quote_title' => 'Request structured routing proposal',
                'quote_text' => 'Share your shipment profile and receive a practical service recommendation from our operations team.',
                'email' => 'Email', 'phone' => 'Phone', 'origin' => 'Origin', 'destination' => 'Destination', 'cargo' => 'Cargo details',
            ],
            'ru' => [
                'eyebrow' => 'Портфель услуг',
                'title' => 'Логистические услуги корпоративного уровня, объединённые в высокоэффективную систему.',
                'text' => 'От срочных авиаперевозок до мультимодального проектирования маршрута — каждый сервис даёт вашему бизнесу скорость, контроль и прогнозируемый результат.',
                'cards' => [
                    ['label' => 'Авиационная сеть', 'title' => 'Авиаперевозки', 'text' => 'Приоритетная отправка, координация с перевозчиками и строгий контроль транзита.', 'image' => asset('images/premium/cargo-aircraft-premium.svg'), 'alt' => 'Авиалогистика'],
                    ['label' => 'Автодорожная сеть', 'title' => 'Автоперевозки', 'text' => 'Надёжные региональные и международные перевозки с безопасной обработкой груза.', 'image' => asset('images/premium/freight-truck-premium.svg'), 'alt' => 'Автологистика'],
                    ['label' => 'Морская сеть', 'title' => 'Морские перевозки', 'text' => 'Контейнерные решения по ключевым торговым коридорам с прозрачными этапами.', 'image' => asset('images/premium/cargo-port-premium.svg'), 'alt' => 'Морская логистика'],
                ],
                'quote_title' => 'Запросить структурированное предложение по маршруту',
                'quote_text' => 'Опишите параметры груза и получите практическую сервисную рекомендацию от нашей операционной команды.',
                'email' => 'Электронная почта', 'phone' => 'Телефон', 'origin' => 'Пункт отправления', 'destination' => 'Пункт назначения', 'cargo' => 'Описание груза',
            ],
            'tm' => [
                'eyebrow' => 'Hyzmat portfeli',
                'title' => 'Korporatiw derejedäki logistika hyzmatlary ýokary öndürijilikli bitewi ulgamda birleşdirildi.',
                'text' => 'Tiz howa daşamasyndan multimodal ugur taslamasyna çenli her hyzmat işiňize tizlik, gözegçilik we çaklanylýan netijäni berýär.',
                'cards' => [
                    ['label' => 'Howa ulgamy', 'title' => 'Howa daşamasy', 'text' => 'Tiz ýükler üçin ileri tutulýan ugradyş, daşaýjy utgaşdyrylyşy we berk tranzit gözegçiligi.', 'image' => asset('images/premium/cargo-aircraft-premium.svg'), 'alt' => 'Howa logistika'],
                    ['label' => 'Awtoulag ulgamy', 'title' => 'Awtoulag daşamasy', 'text' => 'Howpsuz hyzmat standarty bilen sebit we serhetara ygtybarly ulag.', 'image' => asset('images/premium/freight-truck-premium.svg'), 'alt' => 'Awtoulag logistika'],
                    ['label' => 'Deňiz ulgamy', 'title' => 'Deňiz daşamasy', 'text' => 'Esasy söwda geçelgelerinde açyk tapgyrlar bilen konteýner çözgütleri.', 'image' => asset('images/premium/cargo-port-premium.svg'), 'alt' => 'Deňiz logistika'],
                ],
                'quote_title' => 'Gurluşly ugur teklibini soramak',
                'quote_text' => 'Ýük maglumatlaryňyzy paýlaşyň we operasion toparymyzdan amaly hyzmat teklibini alyň.',
                'email' => 'E-poçta', 'phone' => 'Telefon', 'origin' => 'Başlangyç nokat', 'destination' => 'Barjak nokat', 'cargo' => 'Ýük beýany',
            ],
        ];
        $content = $copy[$locale] ?? $copy['en'];
    @endphp

    <section class="rounded-[2.2rem] border border-slate-800 bg-gradient-to-br from-slate-950 via-[#071a3f] to-[#0f2e67] p-8 text-white shadow-[0_40px_95px_rgba(5,18,46,.44)] md:p-12">
        <p class="zny-label text-sky-200">{{ $content['eyebrow'] }}</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight md:text-5xl">{{ $content['title'] }}</h1>
        <p class="mt-4 max-w-3xl text-slate-200 md:text-lg">{{ $content['text'] }}</p>
    </section>

    <section class="grid gap-5 md:grid-cols-3">
        @foreach($content['cards'] as $card)
            <article class="zny-card overflow-hidden">
                <img src="{{ $card['image'] }}" alt="{{ $card['alt'] }}" class="h-48 w-full object-cover contrast-[1.05] saturate-[1.07]" loading="lazy">
                <div class="p-6 md:p-7">
                    <p class="zny-label text-sky-700">{{ $card['label'] }}</p>
                    <p class="mt-2 text-xl font-bold text-slate-900">{{ $card['title'] }}</p>
                    <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $card['text'] }}</p>
                </div>
            </article>
        @endforeach
    </section>

    <section class="zny-card p-7 md:p-10">
        <h2 class="text-3xl font-black text-slate-900">{{ $content['quote_title'] }}</h2>
        <p class="mt-3 max-w-3xl text-slate-600">{{ $content['quote_text'] }}</p>
        <form method="POST" action="/{{ app()->getLocale() }}/quote-request" class="mt-7 grid gap-4 md:grid-cols-2">
            @csrf
            <input name="name" class="zny-input" placeholder="{{ __('messages.name') }}" required>
            <input name="company" class="zny-input" placeholder="{{ __('messages.company') }}">
            <input name="email" type="email" class="zny-input" placeholder="{{ $content['email'] }}" required>
            <input name="phone" class="zny-input" placeholder="{{ $content['phone'] }}" required>
            <input name="origin" class="zny-input" placeholder="{{ $content['origin'] }}" required>
            <input name="destination" class="zny-input" placeholder="{{ $content['destination'] }}" required>
            <textarea name="cargo_details" class="zny-input md:col-span-2" placeholder="{{ $content['cargo'] }}" required></textarea>
            <button class="zny-primary-btn md:col-span-2">{{ __('messages.send') }}</button>
        </form>
    </section>
@endsection
