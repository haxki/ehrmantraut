<?php

namespace App\Http\Controllers;

use App\Models\Spy;

class HistoryController extends Controller
{
    public function index() {
        Spy::process(request());
        return view('history');
    }
}
