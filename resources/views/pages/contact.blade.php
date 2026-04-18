@extends('layouts.app')

@section('content')
    @php
        $siteSettings = array_merge(site_setting_defaults(), is_array($siteSettings ?? null) ? $siteSettings : []);
        $locale = app()->getLocale();
        $copy = [
            'en' => [
                'intro' => 'Contact our team',
                'title' => 'Talk to a logistics specialist.',
                'text' => 'Share your shipment requirement and our team will respond with clear next steps, routing guidance, and operational support.',
                'wa' => 'Open WhatsApp',
                'phone' => 'Phone',
                'address' => 'Address',
                'email' => 'Email',
                'alternate' => 'Alternate',
                'priority_title' => 'WhatsApp Priority Line',
                'priority_text' => 'Scan the QR code for immediate contact with our operations desk.',
            ],
            'ru' => [
                'intro' => 'Связаться с командой',
                'title' => 'Обсудите задачу с логистическим специалистом.',
                'text' => 'Опишите ваш грузовой запрос, и наша команда вернётся с понятными следующими шагами, вариантами маршрута и операционной поддержкой.',
                'wa' => 'Открыть WhatsApp',
                'phone' => 'Телефон',
                'address' => 'Адрес',
                'email' => 'Email',
                'alternate' => 'Дополнительно',
                'priority_title' => 'Приоритетная линия WhatsApp',
                'priority_text' => 'Сканируйте QR-код для быстрого контакта с операционной командой.',
            ],
            'tm' => [
                'intro' => 'Topar bilen habarlaşyň',
                'title' => 'Logistika hünärmeni bilen gürleşiň.',
                'text' => 'Ýük islegiňizi iberiň, toparymyz size indiki ädimler, ugur boýunça maslahat we amaly goldaw bilen jogap berer.',
                'wa' => 'WhatsApp açmak',
                'phone' => 'Telefon',
                'address' => 'Salgy',
                'email' => 'Email',
                'alternate' => 'Goşmaça',
                'priority_title' => 'WhatsApp ileri tutulýan aragatnaşyk',
                'priority_text' => 'Operasion topar bilen tiz habarlaşmak üçin QR kody skanirläň.',
            ],
        ];
        $content = $copy[$locale] ?? $copy['en'];
    @endphp

    <section class="relative overflow-hidden rounded-[2rem] border border-slate-800 bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 p-8 text-white shadow-xl md:p-10">
        <img src="{{ asset('images/premium/cargo-port-premium.svg') }}" alt="International cargo operations" class="absolute inset-0 h-full w-full object-cover opacity-20" loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-blue-950/85 to-slate-900/90"></div>
        <div class="relative z-10">
            <p class="zny-label text-sky-300">{{ $content['intro'] }}</p>
            <h1 class="mt-2 text-4xl font-black">{{ $content['title'] }}</h1>
            <p class="mt-3 max-w-2xl text-slate-200">{{ $content['text'] }}</p>
        </div>
    </section>

    <section class="mt-10 grid items-start gap-8 lg:grid-cols-[1.1fr_.9fr]">
        <div>
            <div class="mb-6 grid gap-4 sm:grid-cols-2">
                <div class="zny-card p-5">
                    <p class="mb-1 zny-label text-sky-700">{{ $content['phone'] }}</p>
                    <p class="text-lg font-bold">{{ site_setting('phone_primary') }}</p>
                </div>
                <div class="zny-card p-5">
                    <p class="mb-1 zny-label text-sky-700">{{ $content['address'] }}</p>
                    <p class="text-slate-700">{{ site_setting('address') }}</p>
                </div>
                <div class="zny-card p-5">
                    <p class="mb-1 zny-label text-sky-700">{{ $content['email'] }}</p>
                    <p class="text-slate-700">{{ site_setting('email_primary') }}</p>
                </div>
                @if(site_setting('email_secondary'))
                    <div class="zny-card p-5">
                        <p class="mb-1 zny-label text-sky-700">{{ $content['alternate'] }}</p>
                        <p class="text-slate-700">{{ site_setting('email_secondary') }}</p>
                    </div>
                @endif
            </div>

            <form method="POST" action="/{{ app()->getLocale() }}/contact" class="zny-card grid gap-4 p-6 md:grid-cols-2">
                @csrf
                <input name="name" class="zny-input" placeholder="{{ __('messages.name') }}" required>
                <input name="email" type="email" class="zny-input" placeholder="Email" required>
                <input name="phone" class="zny-input md:col-span-2" placeholder="Phone">
                <textarea name="message" rows="5" class="zny-input md:col-span-2" placeholder="{{ __('messages.message') }}" required></textarea>
                <button class="zny-primary-btn md:col-span-2">{{ __('messages.send') }}</button>
            </form>
        </div>

        <aside class="zny-card overflow-hidden lg:sticky lg:top-28">
            <img src="{{ asset('images/premium/warehouse-operations-premium.svg') }}" alt="Logistics operations desk" class="h-44 w-full object-cover" loading="lazy">
            <div class="p-6 text-center">
                <h2 class="mb-2 text-2xl font-black">{{ $content['priority_title'] }}</h2>
                <p class="mb-5 text-slate-600">{{ $content['priority_text'] }}</p>
                <div class="rounded-2xl border border-slate-200 bg-gradient-to-br from-white to-sky-50 p-3">
                    <img src="{{ asset('images/qr_clean.png') }}" alt="WhatsApp QR code for {{ $siteSettings['company_name'] ?? 'ZNY LOGISTICS' }}" class="mx-auto w-full max-w-[260px] rounded-xl border border-slate-200 bg-white p-3 shadow-sm">
                </div>
                <a href="{{ whatsapp_link() }}" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex items-center justify-center rounded-full bg-[#25D366] px-5 py-2.5 text-sm font-semibold text-white shadow-[0_16px_28px_rgba(20,90,50,.2)] transition hover:-translate-y-0.5 hover:bg-[#1ebe57]">{{ $content['wa'] }}</a>
            </div>
        </aside>
    </section>
@endsection
