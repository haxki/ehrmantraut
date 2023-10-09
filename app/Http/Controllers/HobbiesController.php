<?php

namespace App\Http\Controllers;

use App\Models\HobbiesModel;

class HobbiesController extends Controller
{
    public function index() {
        return view('hobbies', ['hobbiesInfo' => HobbiesModel::getData()]);
    }
}
