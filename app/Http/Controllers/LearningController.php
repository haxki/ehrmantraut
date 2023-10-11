<?php

namespace App\Http\Controllers;

use App\Models\Spy;

class LearningController extends Controller
{
    public function index() {
        Spy::process(request());
        return view('learning');
    }
}
