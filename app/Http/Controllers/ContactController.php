<?php
    namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Spy;

    class ContactController extends Controller {
        public function index() {
            Spy::process(request());
            return view('contact');
        }

        public function store(ContactRequest $request) {
            $data = $request->validated();
            Spy::process($request);
            mail('gleb13x@mail.ru', 'Тип-топ тема', $data['message']);
            
            return redirect()
                -> route('main.index')
                -> with('alert', 'Вы отправили сообщение на почту!');
        }
    }
