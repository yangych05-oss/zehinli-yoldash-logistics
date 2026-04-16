<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request, string $locale): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:25'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::query()->create($data + ['locale' => $locale]);

        Mail::raw("New contact message from {$data['name']} ({$data['email']})", function ($message): void {
            $message->to(config('mail.from.address'))
                ->subject('New contact form submission');
        });

        return back()->with('status', __('messages.contact_sent'));
    }
}
