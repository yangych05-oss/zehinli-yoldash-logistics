@extends('layouts.app')

@section('content')
    @php
        $siteSettings = array_merge(site_setting_defaults(), is_array($siteSettings ?? null) ? $siteSettings : []);
        $locale = app()->getLocale();
        $copy = [
            'en' => [
                'intro' => 'Client Operations Desk',
                'title' => 'Contact enterprise logistics support.',
                'text' => 'Our team provides fast operational response for new shipment requests, routing updates, and priority coordination.',
                'wa' => 'Open WhatsApp',
                'phone' => 'Phone', 'address' => 'Address', 'email' => 'Email', 'alternate' => 'Secondary email',
                'priority_title' => 'Priority WhatsApp channel',
                'priority_text' => 'Scan the secure QR code to connect with our operations desk immediately.',
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
                'priority_text' => 'Сканируйте защищённый QR-код, чтобы сразу связаться с операционной командой.',
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
                'priority_text' => 'Operasion topar bilen derrew baglanyşmak üçin goragly QR kody skanirläň.',
                'placeholder_email' => 'E-poçta', 'placeholder_phone' => 'Telefon',
                'form_title' => 'Operasion topara sorag ibermek',
            ],
        ];
        $content = $copy[$locale] ?? $copy['en'];
    @endphp

    <section class="relative overflow-hidden rounded-[2.2rem] border border-slate-800 bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 p-8 text-white shadow-[0_40px_95px_rgba(5,18,46,.44)] md:p-12">
        <img src="{{ asset('images/premium/cargo-port-premium.svg') }}" alt="International cargo operations" class="absolute inset-0 h-full w-full object-cover opacity-20" loading="lazy">
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
            <img src="{{ asset('images/premium/warehouse-operations-premium.svg') }}" alt="Logistics operations desk" class="h-52 w-full object-cover" loading="lazy">
            <div class="p-6 md:p-8">
                <h2 class="text-2xl font-black text-slate-900">{{ $content['priority_title'] }}</h2>
                <p class="mt-2 text-slate-600">{{ $content['priority_text'] }}</p>
                <div class="mt-5 rounded-2xl border border-slate-200 bg-gradient-to-br from-white to-sky-50 p-3">
                    <img src="{{ asset('images/qr_clean.png') }}" alt="WhatsApp QR code for {{ $siteSettings['company_name'] ?? 'ZNY LOGISTICS' }}" class="mx-auto w-full max-w-[260px] rounded-xl border border-slate-200 bg-white p-3 shadow-sm">
                </div>
                <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex items-center justify-center rounded-full border border-emerald-300 bg-gradient-to-r from-[#20bd5d] to-[#25D366] px-5 py-2.5 text-sm font-semibold text-white shadow-[0_16px_28px_rgba(20,90,50,.2)] transition hover:-translate-y-0.5">{{ $content['wa'] }}</a>
            </div>
        </aside>
    </section>
@endsection
