<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ZNY LOGISTICS') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-900">
<header class="bg-white shadow-sm">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="/{{ app()->getLocale() }}" class="font-bold text-lg">ZNY LOGISTICS</a>
        <nav class="space-x-4">
            <a href="/{{ app()->getLocale() }}" class="hover:underline">{{ __('messages.nav_home') }}</a>
            <a href="/{{ app()->getLocale() }}/about" class="hover:underline">{{ __('messages.nav_about') }}</a>
            <a href="/{{ app()->getLocale() }}/services" class="hover:underline">{{ __('messages.nav_services') }}</a>
            <a href="/{{ app()->getLocale() }}/tracking" class="hover:underline">{{ __('messages.nav_tracking') }}</a>
            <a href="/{{ app()->getLocale() }}/contact" class="hover:underline">{{ __('messages.nav_contact') }}</a>
        </nav>
    </div>
</header>

<main class="max-w-6xl mx-auto px-4 py-10">
    @if(session('status'))
        <div class="mb-6 rounded bg-green-100 p-4 text-green-800">{{ session('status') }}</div>
    @endif
    @yield('content')
</main>

<footer class="bg-slate-900 text-white mt-16">
    <div class="max-w-6xl mx-auto px-4 py-8 grid md:grid-cols-2 gap-3 text-sm">
        <div>
            <p class="font-semibold">{{ config('app.name') }}</p>
            <p>{{ env('COMPANY_ADDRESS') }}</p>
        </div>
        <div class="md:text-right">
            <p>{{ env('COMPANY_PHONE_PRIMARY') }}</p>
            <p>{{ env('COMPANY_EMAIL') }} | {{ env('COMPANY_EMAIL_SECONDARY', 'akja@znylogistics.com') }}</p>
        </div>
    </div>
</footer>
</body>
</html>
