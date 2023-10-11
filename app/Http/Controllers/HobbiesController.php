<?php

namespace App\Http\Controllers;

use App\Models\HobbiesModel;
use App\Models\Spy;

class HobbiesController extends Controller
{
    public function index() {
        Spy::process(request());
        return view('hobbies', ['hobbiesInfo' => HobbiesModel::getData()]);
    }
}
