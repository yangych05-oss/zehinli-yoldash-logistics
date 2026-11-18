@extends('layouts.app')

@section('content')
@php
    $locale = app()->getLocale();
    $copy = [
        'ru' => [
            'eyebrow' => 'Факты. Маршруты. Доверие.',
            'title' => 'Логистика, которую можно увидеть.',
            'intro' => 'Документальная фотогалерея ZNY LOGISTICS: реальные грузовые операции, портовая инфраструктура и международные деловые события.',
            'port_label' => 'Документальный проект',
            'port_title' => 'Порт Гамбурга',
            'port_text' => 'Реальные фото и видеокадры портовой инфраструктуры Гамбурга из архива компании.',
            'port_link' => 'Смотреть историю проекта',
            'work_label' => 'Грузовые операции',
            'work_title' => 'Наши проекты в кадре',
            'events_label' => 'Международные связи',
            'events_title' => 'Выставки и деловые встречи',
            'events_text' => 'Фотографии и видео отраслевых мероприятий из архива ZNY LOGISTICS.',
            'play' => 'Воспроизвести видео',
            'cta_title' => 'Обсудим вашу перевозку?',
            'cta_text' => 'Подберём схему работы с вашим грузом и маршрутом.',
            'cta' => 'Связаться с нами',
            'privacy' => 'Видео запускаются только по вашему выбору; автозапуск отключён.',
        ],
        'tm' => [
            'eyebrow' => 'Hakykat. Ugurlar. Ynam.',
            'title' => 'Görüp bolýan logistika.',
            'intro' => 'ZNY LOGISTICS kompaniýasynyň hakyky ýük işleri, port infrastrukturasy we halkara işewür çäreleri baradaky fotoarhiwi.',
            'port_label' => 'Hakyky taslama',
            'port_title' => 'Gamburg porty',
            'port_text' => 'Kompaniýanyň arhiwinden Gamburg portunyň hakyky suratlary we wideolary.',
            'port_link' => 'Taslamanyň taryhyny görmek',
            'work_label' => 'Ýük işleri',
            'work_title' => 'Taslamalarymyz suratlarda',
            'events_label' => 'Halkara gatnaşyklar',
            'events_title' => 'Sergiler we iş duşuşyklary',
            'events_text' => 'ZNY LOGISTICS arhiwinden pudaklaýyn çäreleriň suratlary we wideolary.',
            'play' => 'Wideony görkezmek',
            'cta_title' => 'Ýüküňizi maslahatlaşalyňmy?',
            'cta_text' => 'Ýüküňize we ugruňyza laýyk çözgüt saýlalyň.',
            'cta' => 'Habarlaşmak',
            'privacy' => 'Wideolar diňe siziň saýlawyňyz bilen açylýar; awtomatik görkezilmeýär.',
        ],
        'en' => [
            'eyebrow' => 'Evidence. Routes. Trust.',
            'title' => 'Logistics you can see.',
            'intro' => 'A documentary photo gallery from ZNY LOGISTICS: real cargo operations, port infrastructure, and international business events.',
            'port_label' => 'Documentary feature',
            'port_title' => 'Port of Hamburg',
            'port_text' => 'Authentic port infrastructure photos and video from the company archive.',
            'port_link' => 'Explore the Hamburg feature',
            'work_label' => 'Cargo operations',
            'work_title' => 'Our projects in focus',
            'events_label' => 'International connections',
            'events_title' => 'Exhibitions and business meetings',
            'events_text' => 'Original industry event photos and videos from the ZNY LOGISTICS archive.',
            'play' => 'Play documentary video',
            'cta_title' => 'Discuss your next shipment.',
            'cta_text' => 'We can help plan freight operations for your cargo and route.',
            'cta' => 'Contact our team',
            'privacy' => 'Videos play only when you choose. Automatic playback is disabled.',
        ],
    ];
    $t = $copy[$locale] ?? $copy['en'];
    $portfolio = config('zny_media.portfolio', []);
    $events = config('zny_media.events', []);
@endphp

<section class="relative isolate overflow-hidden rounded-[2.4rem] bg-[#06152f] text-white shadow-[0_38px_110px_rgba(4,16,41,.25)]">
    <img src="{{ asset('media/zny/hamburg-port-cover.webp') }}" alt="{{ $t['port_title'] }}" width="1600" height="900" fetchpriority="high" class="absolute inset-0 h-full w-full object-cover" />
    <div class="absolute inset-0 bg-gradient-to-r from-[#06152f]/95 via-[#06152f]/75 to-[#06152f]/30"></div>
    <div class="relative max-w-3xl px-7 py-20 sm:px-10 md:py-28">
        <p class="zny-label text-sky-200">{{ $t['eyebrow'] }}</p>
        <h1 class="mt-4 text-4xl font-black leading-tight md:text-6xl">{{ $t['title'] }}</h1>
        <p class="mt-5 max-w-2xl text-base leading-relaxed text-slate-200 md:text-lg">{{ $t['intro'] }}</p>
        <div class="mt-8 flex flex-wrap gap-3">
            <a class="zny-primary-btn" href="/{{ $locale }}/projects/hamburg">{{ $t['port_link'] }}</a>
            <a class="zny-secondary-btn !border-white/30 !text-white !bg-white/10" href="#cargo-portfolio">{{ $t['work_title'] }}</a>
        </div>
    </div>
</section>

<section class="grid gap-6 lg:grid-cols-[1.1fr_.9fr] lg:items-center" aria-label="{{ $t['port_title'] }}">
    <a href="/{{ $locale }}/projects/hamburg" class="group relative block overflow-hidden rounded-[2rem] shadow-2xl">
        <img src="{{ asset('media/zny/hamburg-port-story.webp') }}" alt="{{ $t['port_title'] }}" width="1600" height="900" loading="lazy" decoding="async" class="aspect-[16/9] w-full object-cover transition-transform duration-700 group-hover:scale-105">
        <span class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 px-7 pb-6 pt-16 text-white text-base font-semibold">{{ $t['port_link'] }}</span>
    </a>
    <div class="lg:px-7">
        <p class="zny-label text-sky-700">{{ $t['port_label'] }}</p>
        <h2 class="mt-3 text-3xl font-black text-slate-950 md:text-4xl">{{ $t['port_title'] }}</h2>
        <p class="mt-4 text-lg leading-relaxed text-slate-600">{{ $t['port_text'] }}</p>
        <a href="/{{ $locale }}/projects/hamburg" class="mt-6 inline-flex items-center gap-2 font-bold text-blue-700 hover:text-blue-900">{{ $t['port_link'] }} <span aria-hidden="true">→</span></a>
    </div>
</section>

<section id="cargo-portfolio" aria-labelledby="cargo-title" class="scroll-mt-28">
    <p class="zny-label text-sky-700">{{ $t['work_label'] }}</p>
    <h2 id="cargo-title" class="mt-2 text-3xl font-black text-slate-900 md:text-4xl">{{ $t['work_title'] }}</h2>
    <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($portfolio as $project)
            <article class="zny-card group overflow-hidden">
                <div class="overflow-hidden bg-slate-100">
                    <img src="{{ asset('media/zny/' . $project['image']) }}" alt="{{ $project['title'][$locale] }}" loading="lazy" decoding="async" width="740" height="1280" class="h-60 w-full object-cover transition-transform duration-700 group-hover:scale-105">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-black leading-snug text-slate-950">{{ $project['title'][$locale] }}</h3>
                    <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $project['description'][$locale] }}</p>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section id="events" class="scroll-mt-28" aria-labelledby="events-title">
    <p class="zny-label text-sky-700">{{ $t['events_label'] }}</p>
    <h2 id="events-title" class="mt-2 text-3xl font-black text-slate-900 md:text-4xl">{{ $t['events_title'] }}</h2>
    <p class="mt-3 max-w-3xl text-slate-600">{{ $t['events_text'] }}</p>
    <p class="mt-2 text-xs text-slate-500">{{ $t['privacy'] }}</p>
    <div class="mt-8 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
        @foreach($events as $event)
            <article class="zny-card overflow-hidden">
                <video controls preload="none" playsinline controlsList="nodownload" disablePictureInPicture
                       poster="{{ asset('media/zny/' . $event['poster']) }}"
                       aria-label="{{ $t['play'] }}: {{ $event['title'][$locale] }}"
                       class="aspect-video w-full bg-slate-950 object-contain">
                    <source src="{{ asset('media/zny/' . $event['video']) }}" type="video/mp4">
                    {{ $event['title'][$locale] }}
                </video>
                <div class="px-6 pb-6 pt-4">
                    <h3 class="text-lg font-bold leading-snug text-slate-900">{{ $event['title'][$locale] }}</h3>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="flex flex-col items-start justify-between gap-6 rounded-[2rem] bg-gradient-to-br from-[#08234f] to-[#06152f] p-8 text-white md:flex-row md:items-center md:p-11">
    <div>
        <h2 class="text-2xl font-black md:text-3xl">{{ $t['cta_title'] }}</h2>
        <p class="mt-2 text-slate-200">{{ $t['cta_text'] }}</p>
    </div>
    <a href="/{{ $locale }}/contact" class="zny-primary-btn">{{ $t['cta'] }}</a>
</section>
@endsection
