<?php

namespace App\Http\Controllers;

use App\Models\Spy;

class AboutController extends Controller
{
    public function index() {
        Spy::process(request());
        return view('about');
    }
}
