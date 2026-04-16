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
            'tracking_number' => ['required', 'string', 'max:64'],
        ]);

        $shipment = Shipment::query()
            ->where('tracking_number', $data['tracking_number'])
            ->first();

        return view('pages.tracking', compact('locale', 'shipment'));
    }
}
