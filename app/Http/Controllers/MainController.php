<?php

namespace App\Http\Controllers;

use App\Models\Spy;

class MainController extends Controller
{
    public function index() {
        Spy::process(request());
        return view('main');
    }
}
