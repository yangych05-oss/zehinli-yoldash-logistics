<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index(string $locale): View
    {
        return view('pages.tracking', [
            'locale' => $locale,
            'shipment' => null,
        ]);
    }

    public function search(Request $request, string $locale): View
    {
        $data = $request->validate([
            'tracking_code' => ['required', 'string', 'max:64'],
            'public_access_code' => ['required', 'string', 'max:64'],
        ]);

        $shipment = Shipment::query()
            ->where('tracking_code', $data['tracking_code'])
            ->where('public_access_code', $data['public_access_code'])
            ->with('events')
            ->first();

        return view('pages.tracking', compact('locale', 'shipment'));
    }

    public function public(): View
    {
        return view('pages.public-tracking', ['shipment' => null]);
    }

    public function publicSearch(Request $request): View
    {
        $data = $request->validate([
            'tracking_code' => ['required', 'string', 'max:64'],
            'public_access_code' => ['required', 'string', 'max:64'],
        ]);

        $shipment = Shipment::query()
            ->where('tracking_code', $data['tracking_code'])
            ->where('public_access_code', $data['public_access_code'])
            ->with('events')
            ->first();

        return view('pages.public-tracking', ['shipment' => $shipment]);
    }
}
