<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Models\Spy;
use App\Models\Test;
use App\Services\TestService;

class TestController extends Controller
{
    public function index() {
        Spy::process(request());
        return view('test/index');
    }
    
    public function store(TestRequest $request) {
        $data = $request->validated();
        Spy::process($request);

        $analyse = TestService::verify($data);
        
        $data['date'] = date('d.m.Y');
        Test::create($data);
        
        return redirect()
            -> route('main.index')
            -> with('alert', $analyse['message']);
    }

    public function table() {
        Spy::process(request());
        $models = Test::all();

        foreach ($models as &$model) {
            $model['truth'] = TestService::verify($model->attributesToArray())['results'];
        }
        return view('test/table', compact('models'));
    }
}
