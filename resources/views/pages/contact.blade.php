@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">{{ __('messages.contact_us') }}</h1>

    <form method="POST" action="/{{ app()->getLocale() }}/contact" class="grid md:grid-cols-2 gap-4 bg-white rounded-xl shadow p-6">
        @csrf
        <input name="name" class="rounded border px-3 py-2" placeholder="{{ __('messages.name') }}" required>
        <input name="email" type="email" class="rounded border px-3 py-2" placeholder="Email" required>
        <input name="phone" class="rounded border px-3 py-2 md:col-span-2" placeholder="Phone">
        <textarea name="message" class="rounded border px-3 py-2 md:col-span-2" rows="5" placeholder="{{ __('messages.message') }}" required></textarea>
        <button class="rounded bg-slate-900 px-4 py-2 text-white md:col-span-2">{{ __('messages.send') }}</button>
    </form>
@endsection
