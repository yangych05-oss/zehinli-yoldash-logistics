@extends('layouts.app')

@section('content')
    @php
        $locale = app()->getLocale();
        $copy = [
            'en' => [
                'hero_eyebrow' => 'International Freight Infrastructure',
                'hero_title' => 'Premium logistics execution for global trade corridors.',
                'hero_text' => 'ZNY LOGISTICS coordinates air, road, and multimodal cargo with disciplined operations, transparent milestones, and accountable delivery performance.',
                'hero_primary' => 'Track Shipment',
                'hero_secondary' => 'Request Consultation',
                'trust_kpis' => [
                    ['label' => 'Operational model', 'value' => '24/7 Coordinated'],
                    ['label' => 'Coverage', 'value' => 'International Routes'],
                    ['label' => 'Service standard', 'value' => 'Enterprise-grade'],
                ],
                'services_intro' => 'Core capabilities',
                'services_title' => 'Integrated services for mission-critical cargo programs.',
                'services' => [
                    ['title' => 'Air Freight', 'text' => 'Priority-lane handling and tight transit control for urgent cargo.', 'image' => asset('images/premium/cargo-aircraft-premium.svg'), 'alt' => 'Cargo aircraft'],
                    ['title' => 'Road Freight', 'text' => 'Cross-border surface delivery with stable routing and milestone reporting.', 'image' => asset('images/premium/freight-truck-premium.svg'), 'alt' => 'Freight truck'],
                    ['title' => 'Port & Terminal Coordination', 'text' => 'Reliable handover management across customs, terminals, and carriers.', 'image' => asset('images/premium/cargo-port-premium.svg'), 'alt' => 'Cargo port'],
                    ['title' => 'Warehouse & Consolidation', 'text' => 'Secure staging, controlled handling, and efficient dispatch preparation.', 'image' => asset('images/premium/warehouse-operations-premium.svg'), 'alt' => 'Warehouse operations'],
                ],
                'value_intro' => 'Why enterprise teams choose us',
                'value_title' => 'Predictable logistics outcomes through disciplined execution.',
                'value_points' => [
                    'Single accountable coordination from booking to delivery.',
                    'Transparent shipment visibility with proactive status communication.',
                    'Operational resilience for urgent timelines and complex lanes.',
                ],
            ],
            'ru' => [
                'hero_eyebrow' => 'Международная грузовая инфраструктура',
                'hero_title' => 'Премиальное исполнение логистики для глобальных торговых направлений.',
                'hero_text' => 'ZNY LOGISTICS координирует авиационные, автомобильные и мультимодальные перевозки с операционной дисциплиной, прозрачными этапами и ответственностью за результат.',
                'hero_primary' => 'Отследить груз',
                'hero_secondary' => 'Запросить консультацию',
                'trust_kpis' => [
                    ['label' => 'Операционная модель', 'value' => 'Координация 24/7'],
                    ['label' => 'Покрытие', 'value' => 'Международные маршруты'],
                    ['label' => 'Стандарт сервиса', 'value' => 'Корпоративный уровень'],
                ],
                'services_intro' => 'Ключевые возможности',
                'services_title' => 'Интегрированные услуги для критически важных грузовых программ.',
                'services' => [
                    ['title' => 'Авиаперевозки', 'text' => 'Приоритетная обработка и строгий контроль транзита для срочных грузов.', 'image' => asset('images/premium/cargo-aircraft-premium.svg'), 'alt' => 'Грузовой самолёт'],
                    ['title' => 'Автоперевозки', 'text' => 'Стабильная международная доставка по суше с отчётностью по этапам.', 'image' => asset('images/premium/freight-truck-premium.svg'), 'alt' => 'Грузовой автомобиль'],
                    ['title' => 'Координация портов и терминалов', 'text' => 'Надёжное управление передачей груза между таможней, терминалами и перевозчиками.', 'image' => asset('images/premium/cargo-port-premium.svg'), 'alt' => 'Грузовой порт'],
                    ['title' => 'Склад и консолидация', 'text' => 'Безопасное хранение, контролируемая обработка и точная подготовка к отгрузке.', 'image' => asset('images/premium/warehouse-operations-premium.svg'), 'alt' => 'Складские операции'],
                ],
                'value_intro' => 'Почему нас выбирает бизнес',
                'value_title' => 'Прогнозируемый результат за счёт дисциплины исполнения.',
                'value_points' => [
                    'Единая ответственная координация от заявки до финальной доставки.',
                    'Прозрачная видимость груза и проактивная коммуникация по статусам.',
                    'Операционная устойчивость для сложных маршрутов и сжатых сроков.',
                ],
            ],
            'tm' => [
                'hero_eyebrow' => 'Halkara ýük infrastrukturasy',
                'hero_title' => 'Global söwda ugurlary üçin premium logistika ýerine ýetirilişi.',
                'hero_text' => 'ZNY LOGISTICS howa, awtoulag we multimodal daşamalary operasion tertip, açyk tapgyrlar we netijä jogapkär çemeleşme bilen utgaşdyrýar.',
                'hero_primary' => 'Ýüki yzarlamak',
                'hero_secondary' => 'Maslahat soramak',
                'trust_kpis' => [
                    ['label' => 'Operasion model', 'value' => '24/7 utgaşdyryş'],
                    ['label' => 'Giňişlik', 'value' => 'Halkara ugurlar'],
                    ['label' => 'Hyzmat derejesi', 'value' => 'Korporatiw standart'],
                ],
                'services_intro' => 'Esasy mümkinçilikler',
                'services_title' => 'Möhüm ýük programmalary üçin bitewi hyzmatlar.',
                'services' => [
                    ['title' => 'Howa daşamasy', 'text' => 'Tiz ýükler üçin ileri tutulýan hyzmat we berk tranzit gözegçiligi.', 'image' => asset('images/premium/cargo-aircraft-premium.svg'), 'alt' => 'Ýük uçary'],
                    ['title' => 'Awtoulag daşamasy', 'text' => 'Serhetara ugralarda yzygiderli ýerüsti eltme we tapgyrlaýyn hasabat.', 'image' => asset('images/premium/freight-truck-premium.svg'), 'alt' => 'Ýük awtoulagy'],
                    ['title' => 'Port we terminal utgaşdyrylyşy', 'text' => 'Gümrük, terminal we daşaýjy arasynda ygtybarly tabşyryş dolandyryşy.', 'image' => asset('images/premium/cargo-port-premium.svg'), 'alt' => 'Ýük porty'],
                    ['title' => 'Ammar we konsolidasiýa', 'text' => 'Howpsuz saklama, gözegçilikli hyzmat we takyk ugradyş taýýarlygy.', 'image' => asset('images/premium/warehouse-operations-premium.svg'), 'alt' => 'Ammar işleri'],
                ],
                'value_intro' => 'Näme üçin iri müşderiler bizi saýlaýar',
                'value_title' => 'Tertipli ýerine ýetiriliş bilen çaklanylýan logistika netijesi.',
                'value_points' => [
                    'Sargytdan tabşyryga çenli ýeke-täk jogapkär utgaşdyryş.',
                    'Ýük boýunça açyk görünijilik we öňünden ýagdaý täzeligi.',
                    'Gysga möhletli we çylşyrymly ugurlar üçin operasion durnuklylyk.',
                ],
            ],
        ];
        $content = $copy[$locale] ?? $copy['en'];
    @endphp

    <section class="relative overflow-hidden rounded-[2.35rem] border border-slate-900/75 bg-[#031634] p-8 text-white shadow-[0_45px_110px_rgba(3,15,38,.56)] md:p-12 lg:p-14">
        <img src="{{ asset('images/premium/hero-logistics.svg') }}" alt="Global logistics network" class="absolute inset-0 h-full w-full object-cover opacity-35" loading="eager">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_12%_22%,rgba(85,192,255,.28),transparent_38%),linear-gradient(122deg,rgba(2,11,28,.88),rgba(7,32,79,.76)_46%,rgba(4,15,40,.95))]"></div>
        <div class="relative z-10 grid gap-10 lg:grid-cols-[1.15fr_.85fr] lg:items-end">
            <div class="max-w-3xl">
                <p class="zny-label inline-flex rounded-full border border-white/25 bg-white/10 px-3 py-2 text-sky-100">{{ $content['hero_eyebrow'] }}</p>
                <h1 class="mt-6 text-[2.25rem] font-black leading-[1.02] md:text-[3.6rem]">{{ $content['hero_title'] }}</h1>
                <p class="mt-5 max-w-2xl text-base text-slate-200 md:text-lg">{{ $content['hero_text'] }}</p>
                <div class="mt-9 flex flex-wrap gap-3">
                    <a href="/{{ app()->getLocale() }}/tracking" class="zny-primary-btn">{{ $content['hero_primary'] }}</a>
                    <a href="/{{ app()->getLocale() }}/contact" class="zny-secondary-btn !text-white !border-white/35 !bg-white/8 hover:!bg-white/16">{{ $content['hero_secondary'] }}</a>
                </div>
            </div>
            <div class="grid gap-3">
                @foreach($content['trust_kpis'] as $kpi)
                    <div class="rounded-2xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm">
                        <p class="text-xs uppercase tracking-[0.18em] text-sky-100/90">{{ $kpi['label'] }}</p>
                        <p class="mt-1 text-xl font-bold text-white">{{ $kpi['value'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section>
        <p class="zny-label text-sky-800">{{ $content['services_intro'] }}</p>
        <h2 class="mt-2 max-w-4xl text-3xl font-black text-slate-900 md:text-4xl">{{ $content['services_title'] }}</h2>
        <div class="mt-9 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            @foreach($content['services'] as $service)
                <article class="group zny-card overflow-hidden transition duration-300 hover:-translate-y-1.5">
                    <img src="{{ $service['image'] }}" alt="{{ $service['alt'] }}" class="h-44 w-full object-cover transition duration-700 group-hover:scale-[1.03]" loading="lazy">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-900">{{ $service['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $service['text'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="grid gap-5 lg:grid-cols-[1.2fr_.8fr]">
        <article class="zny-card p-7 md:p-10">
            <p class="zny-label text-sky-700">{{ $content['value_intro'] }}</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900 md:text-[2.05rem]">{{ $content['value_title'] }}</h2>
            <ul class="mt-6 space-y-3 text-slate-700">
                @foreach($content['value_points'] as $point)
                    <li class="rounded-2xl border border-slate-200/90 bg-white/85 px-4 py-3">{{ $point }}</li>
                @endforeach
            </ul>
        </article>
        <aside class="zny-card overflow-hidden">
            <img src="{{ asset('images/premium/warehouse-operations-premium.svg') }}" alt="Warehouse logistics operations" class="h-full min-h-[290px] w-full object-cover" loading="lazy">
        </aside>
    </section>
@endsection
