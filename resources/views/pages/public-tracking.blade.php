<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Public Tracking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100">
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-4">Public Shipment Tracking</h1>
    <form method="POST" action="{{ route('tracking.public.search') }}" class="grid md:grid-cols-2 gap-2 mb-6 bg-white p-4 rounded shadow">
        @csrf
        <input name="tracking_code" class="rounded border px-3 py-2" placeholder="Tracking code" required>
        <input name="public_access_code" class="rounded border px-3 py-2" placeholder="Access code" required>
        <button class="rounded bg-slate-900 px-4 py-2 text-white md:col-span-2">Search</button>
    </form>

    @if($shipment)
        <div class="bg-white rounded shadow p-4 space-y-2">
            <p><strong>Tracking:</strong> {{ $shipment->tracking_code }}</p>
            <p><strong>Status:</strong> {{ $shipment->status }}</p>
            <p><strong>Route:</strong> {{ $shipment->origin }} → {{ $shipment->destination }}</p>
            <p><strong>Current location:</strong> {{ $shipment->current_location }}</p>
        </div>
    @endif
</div>
</body>
</html>
