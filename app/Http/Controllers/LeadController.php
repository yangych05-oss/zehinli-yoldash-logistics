<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Notifications\NewLeadNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class LeadController extends Controller
{
    public function store(Request $request, string $locale): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:25'],
            'origin' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'string', 'max:255'],
            'cargo_details' => ['required', 'string', 'max:5000'],
        ]);

        $lead = Lead::query()->create($data + ['locale' => $locale, 'status' => 'new']);

        Notification::route('mail', config('mail.from.address'))
            ->notify(new NewLeadNotification($lead));

        return back()->with('status', __('messages.quote_sent'));
    }
}
