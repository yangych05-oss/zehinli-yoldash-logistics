@extends('layouts.app')

@section('content')
    @php
        $siteSettings = array_merge(site_setting_defaults(), is_array($siteSettings ?? null) ? $siteSettings : []);
        $locale = app()->getLocale();
        $premiumPhotos = [
            'sea' => 'https://images.pexels.com/photos/262353/pexels-photo-262353.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=1100&w=1600',
            'warehouse' => 'https://images.pexels.com/photos/4481324/pexels-photo-4481324.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=1100&w=1600',
        ];
        $copy = [
            'en' => [
                'intro' => 'Client Operations Desk',
                'title' => 'Contact enterprise logistics support.',
                'text' => 'Our team provides fast operational response for new shipment requests, routing updates, and priority coordination.',
                'wa' => 'Open WhatsApp',
                'phone' => 'Phone', 'address' => 'Address', 'email' => 'Email', 'alternate' => 'Secondary email',
                'priority_title' => 'Priority WhatsApp channel',
                'priority_text' => 'Use our direct WhatsApp channel for instant shipment updates and urgent operations support.',
                'placeholder_email' => 'Email', 'placeholder_phone' => 'Phone',
                'form_title' => 'Send request to operations team',
            ],
            'ru' => [
                'intro' => 'Клиентский операционный центр',
                'title' => 'Свяжитесь с корпоративной логистической поддержкой.',
                'text' => 'Наша команда быстро реагирует на новые перевозки, обновления маршрутов и приоритетную координацию.',
                'wa' => 'Открыть WhatsApp',
                'phone' => 'Телефон', 'address' => 'Адрес', 'email' => 'Электронная почта', 'alternate' => 'Дополнительная почта',
                'priority_title' => 'Приоритетный канал WhatsApp',
                'priority_text' => 'Используйте прямой канал WhatsApp для мгновенных обновлений по грузу и приоритетной поддержки.',
                'placeholder_email' => 'Электронная почта', 'placeholder_phone' => 'Телефон',
                'form_title' => 'Отправить запрос операционной команде',
            ],
            'tm' => [
                'intro' => 'Müşderi operasion merkezi',
                'title' => 'Korporatiw logistika goldawy bilen habarlaşyň.',
                'text' => 'Toparymyz täze ýük sargytlary, ugur täzelenmeleri we ileri tutulýan utgaşdyrma üçin tiz jogap berýär.',
                'wa' => 'WhatsApp açmak',
                'phone' => 'Telefon', 'address' => 'Salgy', 'email' => 'E-poçta', 'alternate' => 'Goşmaça poçta',
                'priority_title' => 'WhatsApp ileri tutulýan kanal',
                'priority_text' => 'Ýük täzelikleri we gyssagly goldaw üçin göni WhatsApp kanalymyzy ulanyň.',
                'placeholder_email' => 'E-poçta', 'placeholder_phone' => 'Telefon',
                'form_title' => 'Operasion topara sorag ibermek',
            ],
        ];
        $content = $copy[$locale] ?? $copy['en'];
    @endphp

    <section class="relative overflow-hidden rounded-[2.2rem] border border-slate-800 bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 p-8 text-white shadow-[0_40px_95px_rgba(5,18,46,.44)] md:p-12">
        <img src="{{ $premiumPhotos['sea'] }}" alt="International cargo operations" class="absolute inset-0 h-full w-full object-cover opacity-20" loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-blue-950/85 to-slate-900/90"></div>
        <div class="relative z-10 max-w-3xl">
            <p class="zny-label text-sky-300">{{ $content['intro'] }}</p>
            <h1 class="mt-3 text-4xl font-black leading-tight md:text-5xl">{{ $content['title'] }}</h1>
            <p class="mt-4 text-slate-200 md:text-lg">{{ $content['text'] }}</p>
        </div>
    </section>

    <section class="grid items-start gap-8 lg:grid-cols-[1.15fr_.85fr]">
        <div>
            <div class="mb-6 grid gap-4 sm:grid-cols-2">
                <div class="zny-card p-5"><p class="mb-1 zny-label text-sky-700">{{ $content['phone'] }}</p><p class="text-lg font-bold text-slate-900">{{ site_setting('phone_primary') }}</p></div>
                <div class="zny-card p-5"><p class="mb-1 zny-label text-sky-700">{{ $content['address'] }}</p><p class="text-slate-700">{{ site_setting('address') }}</p></div>
                <div class="zny-card p-5"><p class="mb-1 zny-label text-sky-700">{{ $content['email'] }}</p><p class="text-slate-700">{{ site_setting('email_primary') }}</p></div>
                @if(site_setting('email_secondary'))
                    <div class="zny-card p-5"><p class="mb-1 zny-label text-sky-700">{{ $content['alternate'] }}</p><p class="text-slate-700">{{ site_setting('email_secondary') }}</p></div>
                @endif
            </div>

            <form method="POST" action="/{{ app()->getLocale() }}/contact" class="zny-card grid gap-4 p-6 md:grid-cols-2 md:p-8">
                @csrf
                <h2 class="md:col-span-2 text-2xl font-black text-slate-900">{{ $content['form_title'] }}</h2>
                <input name="name" class="zny-input" placeholder="{{ __('messages.name') }}" required>
                <input name="email" type="email" class="zny-input" placeholder="{{ $content['placeholder_email'] }}" required>
                <input name="phone" class="zny-input md:col-span-2" placeholder="{{ $content['placeholder_phone'] }}">
                <textarea name="message" rows="5" class="zny-input md:col-span-2" placeholder="{{ __('messages.message') }}" required></textarea>
                <button class="zny-primary-btn md:col-span-2">{{ __('messages.send') }}</button>
            </form>
        </div>

        <aside class="zny-card overflow-hidden lg:sticky lg:top-28">
            <img src="{{ $premiumPhotos['warehouse'] }}" alt="Logistics operations desk" class="h-52 w-full object-cover" loading="lazy">
            <div class="p-6 md:p-8">
                <h2 class="text-2xl font-black text-slate-900">{{ $content['priority_title'] }}</h2>
                <p class="mt-2 text-slate-600">{{ $content['priority_text'] }}</p>
                <div class="mt-5 rounded-2xl border border-emerald-200/80 bg-gradient-to-br from-emerald-50 via-white to-sky-50 p-5 shadow-[0_16px_35px_rgba(22,101,52,.12)]">
                    <div class="mx-auto max-w-[300px] rounded-2xl border border-white/80 bg-white/90 p-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-emerald-500 text-white shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6"><path d="M20.5 3.5A11.89 11.89 0 0 0 12.05 0C5.48 0 .14 5.35.14 11.94c0 2.1.55 4.15 1.6 5.96L0 24l6.3-1.66a11.86 11.86 0 0 0 5.73 1.46h.01c6.57 0 11.91-5.35 11.91-11.94 0-3.2-1.24-6.22-3.45-8.36Z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-700">WhatsApp</p>
                                <p class="mt-0.5 text-sm leading-relaxed text-slate-600">Always-on operations desk for urgent cargo support.</p>
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-3 gap-2">
                            <span class="h-6 rounded bg-emerald-700/90"></span>
                            <span class="h-6 rounded bg-emerald-500/85"></span>
                            <span class="h-6 rounded bg-emerald-700/90"></span>
                            <span class="h-6 rounded bg-emerald-500/85"></span>
                            <span class="h-6 rounded bg-emerald-800/95"></span>
                            <span class="h-6 rounded bg-emerald-500/85"></span>
                        </div>
                    </div>
                </div>
                <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex w-full items-center justify-center rounded-full border border-emerald-300 bg-gradient-to-r from-[#20bd5d] to-[#25D366] px-5 py-3 text-sm font-semibold text-white shadow-[0_16px_28px_rgba(20,90,50,.2)] transition hover:-translate-y-0.5">{{ $content['wa'] }}</a>
            </div>
        </aside>
    </section>
@endsection
