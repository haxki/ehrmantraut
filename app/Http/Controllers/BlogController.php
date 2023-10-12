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
        $this->authorize('create', BlogPost::class);
        Spy::process(request());
        return view('blog/create');
    }
    public function store(BlogRequest $request) {
        $this->authorize('create', BlogPost::class);
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
        $model = BlogPost::find($id);
        $this->authorize('update', $model);
        Spy::process(request());
        return view('blog/edit', compact('model'));
    }
    public function update(BlogRequest $request, $id) {
        $this->authorize('update', BlogPost::find($id));
        $updateData = $request->validated();
        Spy::process($request);
        BlogService::update($updateData, $id);
        return redirect() -> route('blog.show', $id);
    }
    public function destroy($id) {
        $this->authorize('destroy', BlogPost::find($id));
        Spy::process(request());
        BlogService::delete($id);
        return redirect() -> route('blog.index');
    }
    public function file_upload() {
        $this->authorize('file_upload', BlogPost::class);
        Spy::process(request());
        return view('blog/file_upload');
    }
    public function file_upload_update() {
        $this->authorize('file_upload', BlogPost::class);
        $csv = request()->validate(['csv' => 'required'])['csv'];
        Spy::process(request());
        (new BlogCsvUploaderService($csv))->file_upload();
        return redirect()->route('blog.index');
    }
}
