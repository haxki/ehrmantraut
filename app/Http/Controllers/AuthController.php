<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\Spy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login_form() {
        Spy::process(request());
        return view('auth/login');
    }

    public function login(LoginRequest $request) {
        $data = $request->validated();
        Spy::process($request);
        $user = User::where('login', '=', $data['login'])->first();
        if ($user==null || $user['password'] != hash('md5', $data['password'])) {
            return redirect()
            -> route('auth.login')
            -> withErrors(['password' => 'Логин или пароль введен неправильно.']);
        }
        Auth::login($user);
        session()->start();
        $user->update(['session_id' => session()->getId()]);
        session()->put([
            'authorized' => true,
            'login' => $user['login'],
            'fio' => $user['fio'],
        ]);
        if ($user['role'] == 'admin') {
            session()->put(['isAdmin' => true]);
        }

        return redirect()->route('main.index');
    }

    public function logout() {
        Spy::process(request());
        Auth::logout();
        session()->forget('authorized');
        session()->forget('login');
        session()->forget('fio');
        if (session('isAdmin') != null) {
            session()->forget('isAdmin');
        }
        $user = User::where('login', '=', session('login'))->first();
        if (isset($user['session_id']) && $user['session_id'] != '') {
            session()->getHandler()->destroy($user['session_id']);
            $user->update(['session_id' => '']);
        }
        return redirect()->route('main.index');
    }

    public function registration_form() {
        Spy::process(request());
        return view('auth/registration');
    }

    public function registration(RegistrationRequest $request) {
        $data = $request->validated();
        Spy::process($request);
        $data['role'] = 'user';
        $data['password'] = hash('md5', $data['password']);
        $data['created_at'] = $data['updated_at'] = date('Y-m-d H:i:s');
        Auth::login(User::where('login', '=', $data['login'])->first());
        session()->start();
        $data['session_id'] = session()->getId();
        session()->put([
            'authorized' => true,
            'login' => $data['login'],
            'fio' => $data['fio'],
        ]);
        User::insert($data); 

        return redirect()->route('main.index');
    }
}
