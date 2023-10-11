<?php

namespace App\Http\Controllers;

use App\Models\Spy;

class SpyController extends Controller
{
    public function index() {
        $entries = Spy::orderByDesc('created_at')->paginate(15);
        return view('spy', compact('entries'));
    }
}
