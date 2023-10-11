<?php

namespace App\Http\Controllers;

use App\Models\PhotoModel;
use App\Models\Spy;

class PhotoController extends Controller
{
    public function index() {
        Spy::process(request());
        return view('photo', ['photosInfo' => PhotoModel::getData()]);
    }
}
