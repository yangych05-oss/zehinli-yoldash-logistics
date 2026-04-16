@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">{{ __('messages.nav_services') }}</h1>
    <ul class="list-disc pl-5 space-y-2 text-slate-700">
        <li>{{ __('messages.service_1') }}</li>
        <li>{{ __('messages.service_2') }}</li>
        <li>{{ __('messages.service_3') }}</li>
    </ul>
@endsection
