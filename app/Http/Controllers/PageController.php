<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(string $locale): View
    {
        return view('pages.home', compact('locale'));
    }

    public function about(string $locale): View
    {
        return view('pages.about', compact('locale'));
    }

    public function services(string $locale): View
    {
        return view('pages.services', compact('locale'));
    }
}
