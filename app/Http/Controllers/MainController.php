<?php

namespace App\Http\Controllers;

use App\Models\Spy;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index() {
        Spy::process(request());
        return view('main');
    }
}
