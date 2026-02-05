<?php

namespace App\Http\Controllers;
class AccueilController extends Controller
{
    public function home()
    {
        return view('public_view.pages.home');
    }

    public function about()
    {
        return view('public_view.pages.about');
    }

    public function contact()
    {
        return view('public_view.pages.contact');
    }
}
