<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Models\Test;
use App\Services\TestService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {
        return view('test/index');
    }
    
    public function store(TestRequest $request) {
        $data = $request->validated();

        $analyse = TestService::verify($data);
        
        $data['date'] = date('d.m.Y');
        Test::create($data);
        
        return redirect()
            -> route('main.index')
            -> with('alert', $analyse['message']);
    }

    public function table() {
        $models = Test::all();

        foreach ($models as &$model) {
            $model['truth'] = TestService::verify($model->attributesToArray())['results'];
        }
        return view('test/table', compact('models'));
    }
}
