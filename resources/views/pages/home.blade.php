@extends('layouts.app')

@section('content')
    @php
        $locale = app()->getLocale();
        $copy = [
            'en' => [
                'hero_eyebrow' => 'International Freight Solutions',
                'hero_title' => 'Precision logistics for time-critical international cargo.',
                'hero_text' => 'ZNY LOGISTICS delivers air, road, and multimodal freight with clear coordination, disciplined execution, and dependable timelines across international routes.',
                'hero_primary' => 'Track Shipment',
                'hero_secondary' => 'Speak with Our Team',
                'services_intro' => 'Integrated logistics capabilities',
                'services_title' => 'Built for reliable cross-border cargo movement.',
                'services' => [
                    ['title' => 'Air Freight', 'text' => 'Fast, controlled shipment handling for urgent and high-value cargo.', 'image' => asset('images/premium/cargo-aircraft-premium.svg'), 'alt' => 'Cargo aircraft'],
                    ['title' => 'Road Transport', 'text' => 'Flexible overland delivery with dependable routing and status visibility.', 'image' => asset('images/premium/freight-truck-premium.svg'), 'alt' => 'Freight truck'],
                    ['title' => 'Cargo Coordination', 'text' => 'Clear communication, shipment oversight, and operational follow-through at every step.', 'image' => asset('images/premium/cargo-port-premium.svg'), 'alt' => 'Cargo containers and seaport'],
                    ['title' => 'Warehousing Support', 'text' => 'Practical storage and consolidation support for smoother cargo flow.', 'image' => asset('images/premium/warehouse-operations-premium.svg'), 'alt' => 'Warehouse operations'],
                ],
                'trust_intro' => 'Why clients choose ZNY LOGISTICS',
                'trust_title' => 'Trusted execution, clear communication, stronger control.',
                'trust_points' => [
                    'Responsive coordination across every shipment stage',
                    'Practical international logistics support with reliable follow-through',
                    'Clear updates, transparent handling, and business-focused service',
                ],
                'contact_intro' => 'Contact our team',
                'contact_title' => 'Talk to a logistics specialist.',
                'contact_text' => 'Share your shipment requirement and our team will respond with clear next steps, routing guidance, and operational support.',
            ],
            'ru' => [
                'hero_eyebrow' => 'Международные грузовые решения',
                'hero_title' => 'Точная логистика для международных грузов с чувствительными сроками.',
                'hero_text' => 'ZNY LOGISTICS организует авиационные, автомобильные и мультимодальные перевозки с чёткой координацией, дисциплиной исполнения и надёжными сроками.',
                'hero_primary' => 'Отследить груз',
                'hero_secondary' => 'Связаться с командой',
                'services_intro' => 'Интегрированные логистические возможности',
                'services_title' => 'Решения для надёжного международного движения грузов.',
                'services' => [
                    ['title' => 'Авиаперевозки', 'text' => 'Быстрая и контролируемая обработка срочных и ценных грузов.', 'image' => asset('images/premium/cargo-aircraft-premium.svg'), 'alt' => 'Грузовой самолёт'],
                    ['title' => 'Автоперевозки', 'text' => 'Гибкая наземная доставка с надёжным маршрутом и прозрачным статусом.', 'image' => asset('images/premium/freight-truck-premium.svg'), 'alt' => 'Грузовой автомобиль'],
                    ['title' => 'Координация грузов', 'text' => 'Чёткая коммуникация, контроль перевозки и сопровождение на каждом этапе.', 'image' => asset('images/premium/cargo-port-premium.svg'), 'alt' => 'Контейнерный порт'],
                    ['title' => 'Складская поддержка', 'text' => 'Практичные решения по хранению и консолидации для более стабильного грузопотока.', 'image' => asset('images/premium/warehouse-operations-premium.svg'), 'alt' => 'Складские операции'],
                ],
                'trust_intro' => 'Почему выбирают ZNY LOGISTICS',
                'trust_title' => 'Надёжное исполнение, понятная коммуникация, больший контроль.',
                'trust_points' => [
                    'Оперативная координация на каждом этапе перевозки',
                    'Практическая международная логистика с надёжным сопровождением',
                    'Понятные обновления, прозрачная обработка и деловой подход',
                ],
                'contact_intro' => 'Связаться с командой',
                'contact_title' => 'Обсудите задачу с логистическим специалистом.',
                'contact_text' => 'Опишите ваш грузовой запрос, и наша команда вернётся с понятными следующими шагами, вариантами маршрута и операционной поддержкой.',
            ],
            'tm' => [
                'hero_eyebrow' => 'Halkara ýük çözgütleri',
                'hero_title' => 'Wagty möhüm bolan halkara ýükler üçin takyk logistika.',
                'hero_text' => 'ZNY LOGISTICS howa, awtoulag we multimodal daşamalary anyk utgaşdyrma, tertipli ýerine ýetiriş we ygtybarly möhletler bilen amala aşyrýar.',
                'hero_primary' => 'Ýüki yzarlamak',
                'hero_secondary' => 'Topar bilen habarlaşmak',
                'services_intro' => 'Bitewi logistika mümkinçilikleri',
                'services_title' => 'Serhetara ýük hereketi üçin ygtybarly çözgütler.',
                'services' => [
                    ['title' => 'Howa ýük daşamasy', 'text' => 'Tiz we gymmatly ýükler üçin çalt hem gözegçilikli hyzmat.', 'image' => asset('images/premium/cargo-aircraft-premium.svg'), 'alt' => 'Ýük uçary'],
                    ['title' => 'Awtoulag daşamasy', 'text' => 'Ygtybarly ugur we açyk ýagdaý bilen çeýe ýerüsti daşama.', 'image' => asset('images/premium/freight-truck-premium.svg'), 'alt' => 'Ýük awtoulagy'],
                    ['title' => 'Ýük utgaşdyrylyşy', 'text' => 'Her tapgyrda düşnükli aragatnaşyk, gözegçilik we ýerine ýetiriliş.', 'image' => asset('images/premium/cargo-port-premium.svg'), 'alt' => 'Konteýner porty'],
                    ['title' => 'Ammar goldawy', 'text' => 'Ýük akymyny ýeňilleşdirmek üçin amaly saklama we konsolidasiýa goldawy.', 'image' => asset('images/premium/warehouse-operations-premium.svg'), 'alt' => 'Ammar işleri'],
                ],
                'trust_intro' => 'Näme üçin ZNY LOGISTICS saýlanýar',
                'trust_title' => 'Ygtybarly ýerine ýetiriş, açyk aragatnaşyk, güýçli gözegçilik.',
                'trust_points' => [
                    'Daşamanyň her tapgyrynda çalt utgaşdyrma',
                    'Ygtybarly ýerine ýetiriliş bilen halkara logistika goldawy',
                    'Düşnükli täzelendirmeler, açyk hyzmat we işewür çemeleşme',
                ],
                'contact_intro' => 'Topar bilen habarlaşyň',
                'contact_title' => 'Logistika hünärmeni bilen gürleşiň.',
                'contact_text' => 'Ýük islegiňizi iberiň, toparymyz size indiki ädimler, ugur boýunça maslahat we amaly goldaw bilen jogap berer.',
            ],
        ];

        $content = $copy[$locale] ?? $copy['en'];
    @endphp

    <section class="relative overflow-hidden rounded-[2.25rem] border border-slate-900/75 bg-[#031634] p-8 text-white shadow-[0_40px_95px_rgba(3,15,38,.58)] md:p-12">
        <img src="{{ asset('images/premium/hero-logistics.svg') }}" alt="Global logistics network" class="absolute inset-0 h-full w-full object-cover opacity-30" loading="eager">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_12%_22%,rgba(85,192,255,.28),transparent_38%),linear-gradient(122deg,rgba(2,11,28,.88),rgba(7,32,79,.76)_46%,rgba(4,15,40,.95))]"></div>

        <div class="relative z-10 max-w-3xl">
            <p class="zny-label inline-flex rounded-full border border-white/25 bg-white/10 px-3 py-2 text-sky-100">{{ $content['hero_eyebrow'] }}</p>
            <h1 class="mt-6 text-[2.1rem] font-black leading-[1.03] md:text-[3.35rem]">{{ $content['hero_title'] }}</h1>
            <p class="mt-5 max-w-2xl text-base text-slate-200 md:text-lg">{{ $content['hero_text'] }}</p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="/{{ app()->getLocale() }}/tracking" class="zny-primary-btn">{{ $content['hero_primary'] }}</a>
                <a href="/{{ app()->getLocale() }}/contact" class="zny-secondary-btn !text-white !border-white/35 !bg-white/8 hover:!bg-white/16">{{ $content['hero_secondary'] }}</a>
            </div>
        </div>
    </section>

    <section class="mt-20">
        <p class="zny-label text-sky-800">{{ $content['services_intro'] }}</p>
        <h2 class="mt-2 text-3xl font-black text-slate-900 md:text-4xl">{{ $content['services_title'] }}</h2>

        <div class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            @foreach($content['services'] as $service)
                <article class="group zny-card overflow-hidden transition duration-300 hover:-translate-y-1.5 hover:shadow-[0_30px_56px_rgba(7,26,58,0.14)]">
                    <img src="{{ $service['image'] }}" alt="{{ $service['alt'] }}" class="h-44 w-full object-cover transition duration-700 group-hover:scale-[1.03]" loading="lazy">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-900">{{ $service['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $service['text'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mt-16 grid gap-5 lg:grid-cols-[1.25fr_.75fr]">
        <article class="zny-card p-7 md:p-8">
            <p class="zny-label text-sky-700">{{ $content['trust_intro'] }}</p>
            <h2 class="mt-2 text-3xl font-black text-slate-900">{{ $content['trust_title'] }}</h2>
            <ul class="mt-6 space-y-3 text-slate-700">
                @foreach($content['trust_points'] as $point)
                    <li class="rounded-2xl border border-slate-200/90 bg-white/80 px-4 py-3">{{ $point }}</li>
                @endforeach
            </ul>
        </article>

        <aside class="zny-card overflow-hidden">
            <img src="{{ asset('images/premium/warehouse-operations-premium.svg') }}" alt="Warehouse logistics operations" class="h-full min-h-[260px] w-full object-cover" loading="lazy">
        </aside>
    </section>

    <section class="mt-16 zny-card p-8 md:p-10">
        <p class="zny-label text-sky-700">{{ $content['contact_intro'] }}</p>
        <h3 class="mt-2 text-3xl font-black text-slate-900">{{ $content['contact_title'] }}</h3>
        <p class="mt-3 max-w-3xl text-slate-600">{{ $content['contact_text'] }}</p>
        <div class="mt-7 flex flex-wrap gap-3">
            <a href="/{{ app()->getLocale() }}/contact" class="zny-primary-btn">{{ $content['hero_secondary'] }}</a>
            <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" class="zny-secondary-btn">WhatsApp</a>
        </div>
    </section>
@endsection
