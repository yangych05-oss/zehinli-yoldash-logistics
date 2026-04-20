@extends('layouts.app')

@section('content')
    @php
        $locale = app()->getLocale();
        $premiumPhotos = [
            'sea' => 'https://images.pexels.com/photos/262353/pexels-photo-262353.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=1100&w=1600',
            'warehouse' => 'https://images.pexels.com/photos/4481324/pexels-photo-4481324.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=1100&w=1600',
        ];
        $copy = [
            'en' => [
                'eyebrow' => 'About ZNY LOGISTICS',
                'title' => 'A logistics partner built for governance, precision, and long-term trust.',
                'intro' => 'We support international cargo programs with structured execution, transparent communication, and accountable delivery standards.',
                'pillars' => [
                    ['title' => 'Mission', 'text' => 'Deliver predictable freight outcomes through coordinated planning and disciplined operations.'],
                    ['title' => 'Approach', 'text' => 'Unify route expertise, service agility, and risk controls in one execution framework.'],
                    ['title' => 'Commitment', 'text' => 'Protect client timelines with proactive issue management and clear milestone ownership.'],
                ],
            ],
            'ru' => [
                'eyebrow' => 'О компании ZNY LOGISTICS',
                'title' => 'Логистический партнёр для контроля, точности и долгосрочного доверия.',
                'intro' => 'Мы поддерживаем международные грузовые программы через структурированное исполнение, прозрачную коммуникацию и ответственность за результат.',
                'pillars' => [
                    ['title' => 'Миссия', 'text' => 'Обеспечивать прогнозируемый результат перевозок за счёт координированного планирования и операционной дисциплины.'],
                    ['title' => 'Подход', 'text' => 'Объединять экспертизу маршрутов, гибкость сервиса и контроль рисков в единой модели исполнения.'],
                    ['title' => 'Обязательства', 'text' => 'Защищать сроки клиентов через проактивное управление отклонениями и контроль этапов.'],
                ],
            ],
            'tm' => [
                'eyebrow' => 'ZNY LOGISTICS barada',
                'title' => 'Gözegçilik, takyklyk we uzak möhletli ynam üçin döredilen logistika hyzmatdaş.',
                'intro' => 'Biz halkara ýük programmalaryny gurluşly ýerine ýetiriliş, açyk aragatnaşyk we netijä jogapkär çemeleşme arkaly dolandyrýarys.',
                'pillars' => [
                    ['title' => 'Missiýa', 'text' => 'Utgaşdyrylan meýilnama we operasion tertip arkaly çaklanylýan daşama netijesini üpjün etmek.'],
                    ['title' => 'Çemeleşme', 'text' => 'Ugur tejribesini, hyzmat çeýeligini we töwekgelçilik gözegçiligini bir ýerine ýetiriliş modelinde birleşdirmek.'],
                    ['title' => 'Borçnama', 'text' => 'Gyssagly ýagdaýlary öňünden dolandyryp, tapgyrlaýyn jogapkärçilik bilen müşderi möhletlerini goramak.'],
                ],
            ],
        ];
        $content = $copy[$locale] ?? $copy['en'];
    @endphp

    <section class="relative overflow-hidden rounded-[2.2rem] border border-slate-800 bg-gradient-to-br from-slate-950 via-[#071a3f] to-[#123874] p-8 text-white shadow-[0_40px_95px_rgba(5,18,46,.44)] md:p-12">
        <img src="{{ $premiumPhotos['sea'] }}" alt="International logistics operations" class="absolute inset-0 h-full w-full object-cover contrast-[1.08] saturate-[1.1] opacity-24" loading="lazy">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_14%_18%,rgba(86,188,255,.25),transparent_38%),linear-gradient(126deg,rgba(2,11,28,.82),rgba(7,25,61,.76)_48%,rgba(12,40,90,.9))]"></div>
        <div class="relative z-10 grid gap-9 lg:grid-cols-[1.1fr_.9fr] lg:items-center">
            <div>
                <p class="zny-label text-sky-200">{{ $content['eyebrow'] }}</p>
                <h1 class="mt-3 text-4xl font-black leading-tight md:text-5xl">{{ $content['title'] }}</h1>
                <p class="mt-5 max-w-2xl text-slate-200 md:text-lg">{{ $content['intro'] }}</p>
            </div>
            <img src="{{ $premiumPhotos['warehouse'] }}" alt="Warehouse and freight operations" class="h-64 w-full rounded-2xl border border-white/15 object-cover contrast-[1.04] saturate-[1.06] shadow-[0_18px_40px_rgba(5,16,40,.45)]" loading="lazy">
        </div>
    </section>

    <section class="grid gap-5 md:grid-cols-3">
        @foreach($content['pillars'] as $pillar)
            <article class="zny-card p-7 md:p-8">
                <p class="zny-label text-sky-700">{{ $pillar['title'] }}</p>
                <p class="mt-4 text-sm leading-relaxed text-slate-600">{{ $pillar['text'] }}</p>
            </article>
        @endforeach
    </section>
@endsection
