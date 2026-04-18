<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Public Tracking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100" style="font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: linear-gradient(180deg,#f6f9ff,#eef4ff 55%,#f6f9ff)">
<div class="max-w-4xl mx-auto py-12 px-4">
    <section class="rounded-3xl border border-slate-800 bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 p-8 text-white mb-8 shadow-xl">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-300">Secure Access</p>
        <h1 class="text-4xl font-black mt-2">Public Shipment Tracking</h1>
        <p class="mt-3 text-slate-200">Use shipment credentials to verify route status and latest location checkpoints.</p>
    </section>

    <form method="POST" action="{{ route('tracking.public.search') }}" class="grid md:grid-cols-2 gap-3 mb-8 bg-white/95 p-6 rounded-2xl border border-slate-200 shadow-lg">
        @csrf
        <input name="tracking_code" class="w-full rounded-xl border border-slate-200 px-3 py-2.5 focus:outline-none focus:ring-4 focus:ring-sky-100 focus:border-sky-400" placeholder="Tracking code" required>
        <input name="public_access_code" class="w-full rounded-xl border border-slate-200 px-3 py-2.5 focus:outline-none focus:ring-4 focus:ring-sky-100 focus:border-sky-400" placeholder="Access code" required>
        <button class="md:col-span-2 rounded-full bg-slate-900 px-4 py-2.5 font-semibold text-white hover:bg-blue-900 transition">Search</button>
    </form>

    @if($shipment)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-lg p-6 space-y-2">
            <p><strong>Tracking:</strong> {{ $shipment->tracking_code }}</p>
            <p><strong>Status:</strong> {{ $shipment->status }}</p>
            <p><strong>Route:</strong> {{ $shipment->origin }} → {{ $shipment->destination }}</p>
            <p><strong>Current location:</strong> {{ $shipment->current_location }}</p>
        </div>
    @endif
</div>
</body>
</html>
