@extends('layouts.app')

@section('content')
@php
    $locale = app()->getLocale();
    $copy = [
        'ru' => [
            'eyebrow' => 'Документальные материалы • Порт Гамбурга',
            'title' => 'Порт Гамбурга: реальные кадры международной логистики',
            'intro' => 'Фотографии и видео из архива ZNY LOGISTICS, снятые в порту Гамбурга. Здесь мы показываем реальную портовую инфраструктуру и рабочую среду международных грузоперевозок.',
            'note' => 'Документальная съёмка. Подробности конкретных перевозок, договоров и грузополучателей не публикуются.',
            'video' => 'Смотрите видео порта Гамбурга',
            'gallery' => 'Фотогалерея',
            'back' => 'Все проекты и события',
            'cta' => 'Обсудить перевозку',
        ],
        'tm' => [
            'eyebrow' => 'Hakyky materiallar • Gamburg porty',
            'title' => 'Gamburg porty: halkara logistikasynyň hakyky pursatlary',
            'intro' => 'ZNY LOGISTICS kompaniýasynyň Gamburg portunda düşürilen foto we wideo arhiwi. Bu ýerde port infrastrukturasyny we halkara ýük daşamalarynyň hakyky gurşawyny görkezýäris.',
            'note' => 'Hakyky ýazgylar. Aýratyn ýük daşamalaryň, şertnamalaryň we müşderileriň maglumatlary açyk görkezilmeýär.',
            'video' => 'Gamburg portunyň wideolaryny görüň',
            'gallery' => 'Fotoarhiw',
            'back' => 'Ähli taslamalar we çäreler',
            'cta' => 'Ýük daşamasy barada maslahatlaşmak',
        ],
        'en' => [
            'eyebrow' => 'Documentary archive • Port of Hamburg',
            'title' => 'Port of Hamburg: real footage of international logistics',
            'intro' => 'Authentic photos and video recorded at the Port of Hamburg, from the ZNY LOGISTICS archive. A documentary look at the infrastructure and working environment of international freight.',
            'note' => 'Original documentary footage. Individual shipment, contract, and customer details are not disclosed here.',
            'video' => 'Watch the Hamburg port documentary',
            'gallery' => 'Photo gallery',
            'back' => 'All projects and events',
            'cta' => 'Discuss freight requirements',
        ],
    ];
    $t = $copy[$locale] ?? $copy['en'];
@endphp

<nav aria-label="{{ $t['back'] }}" class="mb-6">
    <a class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:text-blue-900" href="/{{ $locale }}/projects">
        <span aria-hidden="true">←</span> {{ $t['back'] }}
    </a>
</nav>

<article class="space-y-9">
    <header class="relative isolate overflow-hidden rounded-[2.2rem] bg-[#06152f] text-white">
        <img src="{{ asset('media/zny/hamburg-port-cover.webp') }}" alt="{{ $t['title'] }}" fetchpriority="high" width="1600" height="900" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-[#06152f]/95 via-[#06152f]/80 to-[#06152f]/45"></div>
        <div class="relative max-w-4xl px-7 py-20 md:px-14 md:py-28">
            <p class="zny-label text-sky-200">{{ $t['eyebrow'] }}</p>
            <h1 class="mt-4 text-4xl font-black leading-tight md:text-6xl">{{ $t['title'] }}</h1>
            <p class="mt-5 text-base leading-relaxed text-slate-200 md:text-lg">{{ $t['intro'] }}</p>
        </div>
    </header>

    <section aria-labelledby="hamburg-documentary" class="grid gap-7 lg:grid-cols-[1.4fr_.6fr] lg:items-center">
        <div class="overflow-hidden rounded-[1.8rem] border border-slate-200 bg-slate-950 shadow-xl">
            <video controls playsinline preload="none" controlsList="nodownload"
                   poster="{{ asset('media/zny/hamburg-port-visit-poster.webp') }}"
                   aria-label="{{ $t['video'] }}"
                   class="aspect-video w-full object-contain">
                <source src="{{ asset('media/zny/hamburg-port-mobile.mp4') }}" type="video/mp4">
                {{ $t['video'] }}
            </video>
        </div>
        <div>
            <h2 id="hamburg-documentary" class="text-3xl font-black text-slate-950">{{ $t['video'] }}</h2>
            <p class="mt-4 leading-relaxed text-slate-600">{{ $t['intro'] }}</p>
            <p class="mt-4 rounded-xl border border-slate-200 bg-slate-50 p-4 text-sm leading-relaxed text-slate-500">{{ $t['note'] }}</p>
        </div>
    </section>

    <section aria-labelledby="hamburg-gallery">
        <h2 id="hamburg-gallery" class="text-3xl font-black text-slate-950">{{ $t['gallery'] }}</h2>
        <div class="mt-6 grid gap-5 md:grid-cols-2">
            <img src="{{ asset('media/zny/hamburg-port-story.webp') }}" alt="{{ $t['title'] }}" width="1600" height="900" loading="lazy" decoding="async" class="aspect-video w-full rounded-[1.4rem] object-cover shadow-lg">
            <img src="{{ asset('media/zny/hamburg-port-cover.webp') }}" alt="{{ $t['title'] }}" width="1600" height="900" loading="lazy" decoding="async" class="aspect-video w-full rounded-[1.4rem] object-cover shadow-lg">
        </div>
    </section>

    <div class="flex flex-wrap items-center justify-between gap-4 border-t border-slate-200 pt-7">
        <a href="/{{ $locale }}/projects" class="font-semibold text-blue-700 hover:text-blue-900"><span aria-hidden="true">←</span> {{ $t['back'] }}</a>
        <a href="/{{ $locale }}/contact" class="zny-primary-btn">{{ $t['cta'] }}</a>
    </div>
</article>
@endsection
