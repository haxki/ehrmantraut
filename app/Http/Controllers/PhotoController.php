<?php

namespace App\Http\Controllers;

use App\Models\PhotoModel;

class PhotoController extends Controller
{
    public function index() {
        return view('photo', ['photosInfo' => PhotoModel::getData()]);
    }
}
