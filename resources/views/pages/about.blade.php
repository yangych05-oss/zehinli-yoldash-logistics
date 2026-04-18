@extends('layouts.app')

@section('content')
    <section class="relative overflow-hidden rounded-[2rem] border border-slate-800 bg-gradient-to-br from-slate-950 via-[#071a3f] to-[#123874] p-8 text-white shadow-xl md:p-10">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 18% 20%, rgba(255,255,255,.25) 1px, transparent 1px); background-size: 130px 130px;"></div>
        <div class="relative z-10 grid gap-8 lg:grid-cols-[1.05fr_.95fr] lg:items-center">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-200">About ZNY LOGISTICS</p>
                <h1 class="mt-3 text-4xl font-black leading-tight">A modern logistics partner built for reliability, precision, and speed.</h1>
                <p class="mt-4 max-w-2xl text-slate-200">{{ __('messages.about_text') }}</p>
            </div>
            <img src="https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=1400&q=80" alt="Modern logistics warehouse and container operations" class="h-64 w-full rounded-2xl object-cover" loading="lazy" referrerpolicy="no-referrer">
        </div>
    </section>

    <section class="mt-12 grid gap-5 md:grid-cols-3">
        <article class="zny-card p-6">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Mission</p>
            <p class="mt-3 text-sm text-slate-600">Deliver dependable international logistics execution that keeps supply chains predictable and resilient.</p>
        </article>
        <article class="zny-card p-6">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Approach</p>
            <p class="mt-3 text-sm text-slate-600">Blend technology, route expertise, and hands-on support into one transparent operating model.</p>
        </article>
        <article class="zny-card p-6">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Commitment</p>
            <p class="mt-3 text-sm text-slate-600">Protect service quality with proactive communication and disciplined milestone management.</p>
        </article>
    </section>
@endsection
