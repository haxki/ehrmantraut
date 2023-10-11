<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuestBookRequest;
use App\Models\Spy;
use App\Services\GuestBookService;
use Illuminate\Support\Facades\Storage;

class GuestBookController extends Controller
{
    public function index() {
        Spy::process(request());
        $rows = (new GuestBookService)->serve();
        
        return view('guestbook/index', compact('rows'));
    }

    public function store(GuestBookRequest $request) {
        $newRow = $request->validated();
        Spy::process(request());
        $rows = (new GuestBookService)->serve($newRow);
    
        return view('guestbook/index', compact('rows'));
    }

    public function edit() {
        Spy::process(request());
        return view('guestbook/edit');
    }

    public function update() {
        $validated = request()->validate(['guestbook' => 'required']);
        Spy::process(request());
        Storage::putFileAs('/public', $validated['guestbook'], 'messages.inc');
        
        return redirect() -> route('guestbook.index');
    }
}
