<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuestBookRequest;
use App\Services\FileDatabaseService;
use App\Services\GuestBookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestBookController extends Controller
{
    public function index() {
        $rows = (new GuestBookService)->serve();
        
        return view('guestbook/index', compact('rows'));
    }

    public function store(GuestBookRequest $request) {
        $newRow = $request->validated();
        $rows = (new GuestBookService)->serve($newRow);
    
        return view('guestbook/index', compact('rows'));
    }

    public function edit() {
        return view('guestbook/edit');
    }

    public function update() {
        $validated = request()->validate(['guestbook' => 'required']);
        Storage::putFileAs('/public', $validated['guestbook'], 'messages.inc');
        
        return redirect() -> route('guestbook.index');
    }
}
