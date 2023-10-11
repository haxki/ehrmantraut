<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\BlogPost;
use App\Models\Spy;
use App\Services\BlogCsvUploaderService;
use App\Services\BlogService;
class BlogController extends Controller
{
    public function index() {
        Spy::process(request());
        $posts = BlogPost::orderByDesc('created_at')
            -> paginate(isset($_GET['perPage']) ? $_GET['perPage'] : 4);
        return view('blog/index', compact('posts'));
    }
    public function create() {
        Spy::process(request());
        return view('blog/create');
    }
    public function store(BlogRequest $request) {
        $newPost = $request->validated();
        Spy::process($request);
        BlogService::create($newPost);
        return redirect()->route('blog.index');
    }
    public function show($id) {
        Spy::process(request());
        $model = BlogPost::find($id);
        return view('blog/show', compact('model'));
    }
    public function edit($id) {
        Spy::process(request());
        $model = BlogPost::find($id);
        return view('blog/edit', compact('model'));
    }
    public function update(BlogRequest $request, $id) {
        $updateData = $request->validated();
        Spy::process($request);
        BlogService::update($updateData, $id);
        return redirect() -> route('blog.show', $id);
    }
    public function destroy($id) {
        Spy::process(request());
        BlogService::delete($id);
        return redirect() -> route('blog.index');
    }
    public function file_upload() {
        Spy::process(request());
        return view('blog/file_upload');
    }
    public function file_upload_update() {
        $csv = request()->validate(['csv' => 'required'])['csv'];
        Spy::process(request());
        (new BlogCsvUploaderService($csv))->file_upload();
        return redirect()->route('blog.index');
    }
}
