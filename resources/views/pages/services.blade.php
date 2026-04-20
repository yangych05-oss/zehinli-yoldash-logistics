@extends('layouts.app')

@section('content')
    @php
        $locale = app()->getLocale();
        $copy = [
            'en' => [
                'eyebrow' => __('messages.nav_services'),
                'title' => 'Enterprise transport capabilities, coordinated as one system.',
                'text' => 'Air, road, ocean, and warehousing services designed for international supply chains that require control, speed, and consistency.',
                'cards' => [
                    ['label' => 'Air network', 'title' => __('messages.service_1'), 'text' => 'Priority uplift and controlled transit management for urgent shipments.', 'image' => asset('images/premium/cargo-aircraft-premium.svg'), 'alt' => 'Cargo aircraft logistics'],
                    ['label' => 'Road network', 'title' => __('messages.service_2'), 'text' => 'Cross-border linehaul with secure handling and dependable schedule integrity.', 'image' => asset('images/premium/freight-truck-premium.svg'), 'alt' => 'Freight truck logistics'],
                    ['label' => 'Ocean network', 'title' => __('messages.service_3'), 'text' => 'Containerized maritime solutions across major trade corridors.', 'image' => asset('images/premium/cargo-port-premium.svg'), 'alt' => 'Container ship logistics'],
                ],
                'quote_text' => 'Share your shipment profile and receive a structured routing proposal from our team.',
                'email' => 'Email',
                'phone' => 'Phone',
                'origin' => 'Origin',
                'destination' => 'Destination',
                'cargo' => 'Cargo details',
            ],
            'ru' => [
                'eyebrow' => __('messages.nav_services'),
                'title' => 'Транспортные возможности корпоративного уровня, объединённые в единую систему.',
                'text' => 'Авиа, авто, морские и складские решения для международных цепочек поставок, где важны контроль, скорость и стабильность.',
                'cards' => [
                    ['label' => 'Авиационная сеть', 'title' => __('messages.service_1'), 'text' => 'Приоритетная отправка и контролируемый транзит для срочных грузов.', 'image' => asset('images/premium/cargo-aircraft-premium.svg'), 'alt' => 'Авиалогистика'],
                    ['label' => 'Автодорожная сеть', 'title' => __('messages.service_2'), 'text' => 'Международные автоперевозки с безопасной обработкой и соблюдением графика.', 'image' => asset('images/premium/freight-truck-premium.svg'), 'alt' => 'Автоперевозки'],
                    ['label' => 'Морская сеть', 'title' => __('messages.service_3'), 'text' => 'Контейнерные морские решения по ключевым торговым коридорам.', 'image' => asset('images/premium/cargo-port-premium.svg'), 'alt' => 'Морская логистика'],
                ],
                'quote_text' => 'Опишите параметры груза и получите структурированное логистическое предложение от нашей команды.',
                'email' => 'Электронная почта',
                'phone' => 'Телефон',
                'origin' => 'Откуда',
                'destination' => 'Куда',
                'cargo' => 'Описание груза',
            ],
            'tm' => [
                'eyebrow' => __('messages.nav_services'),
                'title' => 'Korporatiw derejedäki ulag mümkinçilikleri bitewi ulgama utgaşdyryldy.',
                'text' => 'Gözegçilik, tizlik we yzygiderlilik talap edýän halkara üpjünçilik zynjyrlary üçin howa, awtoulag, deňiz we ammar hyzmatlary.',
                'cards' => [
                    ['label' => 'Howa ulgamy', 'title' => __('messages.service_1'), 'text' => 'Tiz ýükler üçin ileri tutulýan ugradyş we gözegçilikli tranzit dolandyryşy.', 'image' => asset('images/premium/cargo-aircraft-premium.svg'), 'alt' => 'Howa logistika'],
                    ['label' => 'Awtoulag ulgamy', 'title' => __('messages.service_2'), 'text' => 'Serhetara ugurlarda howpsuz hyzmat we meýilnama tertibini saklamak.', 'image' => asset('images/premium/freight-truck-premium.svg'), 'alt' => 'Awtoulag logistika'],
                    ['label' => 'Deňiz ulgamy', 'title' => __('messages.service_3'), 'text' => 'Esasy söwda geçelgelerinde konteýnerleşdirilen deňiz çözgütleri.', 'image' => asset('images/premium/cargo-port-premium.svg'), 'alt' => 'Deňiz logistika'],
                ],
                'quote_text' => 'Ýük profiliňizi paýlaşyň we toparymyzdan gurluşly ugur teklibini alyň.',
                'email' => 'E-poçta',
                'phone' => 'Telefon',
                'origin' => 'Başlangyç nokat',
                'destination' => 'Barjak nokat',
                'cargo' => 'Ýük beýany',
            ],
        ];

        $content = $copy[$locale] ?? $copy['en'];
    @endphp

    <section class="rounded-[2rem] border border-slate-800 bg-gradient-to-br from-slate-950 via-[#071a3f] to-[#0f2e67] p-8 text-white shadow-xl md:p-11">
        <p class="zny-label text-sky-200">{{ $content['eyebrow'] }}</p>
        <h1 class="mt-3 max-w-4xl text-4xl font-black leading-tight md:text-5xl">{{ $content['title'] }}</h1>
        <p class="mt-4 max-w-3xl text-slate-200 md:text-lg">{{ $content['text'] }}</p>
    </section>

    <section class="mt-12 grid gap-5 md:grid-cols-3">
        @foreach($content['cards'] as $card)
            <article class="zny-card overflow-hidden">
                <img src="{{ $card['image'] }}" alt="{{ $card['alt'] }}" class="h-48 w-full object-cover" loading="lazy">
                <div class="p-6">
                    <p class="zny-label text-sky-700">{{ $card['label'] }}</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $card['title'] }}</p>
                    <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $card['text'] }}</p>
                </div>
            </article>
        @endforeach
    </section>

    <section class="mt-12 zny-card p-6 md:p-9">
        <h2 class="mb-3 text-3xl font-black">{{ __('messages.request_quote') }}</h2>
        <p class="mb-6 max-w-3xl text-slate-600">{{ $content['quote_text'] }}</p>
        <form method="POST" action="/{{ app()->getLocale() }}/quote-request" class="grid gap-4 md:grid-cols-2">
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
