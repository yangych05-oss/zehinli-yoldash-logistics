@extends('layouts.app')

@section('content')
    @php
        $locale = app()->getLocale();
        $copy = [
            'en' => [
                'eyebrow' => 'About ZNY LOGISTICS',
                'title' => 'International logistics built on precision, trust, and accountability.',
                'mission_title' => 'Mission',
                'mission_text' => 'Deliver consistent global freight execution with clear communication and resilient planning.',
                'approach_title' => 'Approach',
                'approach_text' => 'Combine route expertise, operational discipline, and responsive service in one workflow.',
                'commitment_title' => 'Commitment',
                'commitment_text' => 'Protect delivery performance through milestone control and proactive exception management.',
            ],
            'ru' => [
                'eyebrow' => 'О компании ZNY LOGISTICS',
                'title' => 'Международная логистика, построенная на точности, доверии и ответственности.',
                'mission_title' => 'Миссия',
                'mission_text' => 'Обеспечивать стабильное выполнение международных перевозок с понятной коммуникацией и устойчивым планированием.',
                'approach_title' => 'Подход',
                'approach_text' => 'Объединять экспертизу маршрутов, операционную дисциплину и быструю поддержку в едином процессе.',
                'commitment_title' => 'Обязательства',
                'commitment_text' => 'Поддерживать результат доставки через контроль этапов и проактивное управление отклонениями.',
            ],
            'tm' => [
                'eyebrow' => 'ZNY LOGISTICS barada',
                'title' => 'Takyklyk, ynam we jogapkärçilik esasynda gurlan halkara logistika.',
                'mission_title' => 'Missiýa',
                'mission_text' => 'Açyk aragatnaşyk we durnukly meýilnamalaşdyrma bilen yzygiderli halkara daşamalary ýerine ýetirmek.',
                'approach_title' => 'Çemeleşme',
                'approach_text' => 'Ugur tejribesini, operasion tertibi we tiz hyzmaty bir bitewi akyma birleşdirmek.',
                'commitment_title' => 'Borçnama',
                'commitment_text' => 'Tapgyrlaýyn gözegçilik we öňünden dolandyryş arkaly eltmegiň netijeliligini goramak.',
            ],
        ];
        $content = $copy[$locale] ?? $copy['en'];
    @endphp

    <section class="relative overflow-hidden rounded-[2rem] border border-slate-800 bg-gradient-to-br from-slate-950 via-[#071a3f] to-[#123874] p-8 text-white shadow-xl md:p-11">
        <img src="{{ asset('images/premium/cargo-port-premium.svg') }}" alt="International logistics operations" class="absolute inset-0 h-full w-full object-cover opacity-20" loading="lazy">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_14%_18%,rgba(86,188,255,.25),transparent_38%),linear-gradient(126deg,rgba(2,11,28,.82),rgba(7,25,61,.76)_48%,rgba(12,40,90,.9))]"></div>
        <div class="relative z-10 grid gap-8 lg:grid-cols-[1.12fr_.88fr] lg:items-center">
            <div>
                <p class="zny-label text-sky-200">{{ $content['eyebrow'] }}</p>
                <h1 class="mt-3 text-4xl font-black leading-tight md:text-5xl">{{ $content['title'] }}</h1>
                <p class="mt-4 max-w-2xl text-slate-200 md:text-lg">{{ __('messages.about_text') }}</p>
            </div>
            <img src="{{ asset('images/premium/warehouse-operations-premium.svg') }}" alt="Warehouse and freight operations" class="h-64 w-full rounded-2xl border border-white/15 object-cover shadow-[0_18px_40px_rgba(5,16,40,.45)]" loading="lazy">
        </div>
    </section>

    <section class="mt-12 grid gap-5 md:grid-cols-3">
        <article class="zny-card p-7">
            <p class="zny-label text-sky-700">{{ $content['mission_title'] }}</p>
            <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $content['mission_text'] }}</p>
        </article>
        <article class="zny-card p-7">
            <p class="zny-label text-sky-700">{{ $content['approach_title'] }}</p>
            <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $content['approach_text'] }}</p>
        </article>
        <article class="zny-card p-7">
            <p class="zny-label text-sky-700">{{ $content['commitment_title'] }}</p>
            <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $content['commitment_text'] }}</p>
        </article>
    </section>
@endsection
