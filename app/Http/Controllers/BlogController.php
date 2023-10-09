<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\BlogPost;
use App\Services\BlogCsvUploaderService;
use App\Services\BlogService;
class BlogController extends Controller
{
    public function index() {
        $posts = BlogPost::orderByDesc('created_at')
            -> paginate(isset($_GET['perPage']) ? $_GET['perPage'] : 4);
        return view('blog/index', compact('posts'));
    }
    public function create() {
        return view('blog/create');
    }
    public function store(BlogRequest $request) {
        $newPost = $request->validated();
        BlogService::create($newPost);
        return redirect()->route('blog.index');
    }
    public function show($id) {
        $model = BlogPost::find($id);
        return view('blog/show', compact('model'));
    }
    public function edit($id) {
        $model = BlogPost::find($id);
        return view('blog/edit', compact('model'));
    }
    public function update(BlogRequest $request, $id) {
        $updateData = $request->validated();
        BlogService::update($updateData, $id);
        return redirect() -> route('blog.show', $id);
    }
    public function destroy($id) {
        BlogService::delete($id);
        return redirect() -> route('blog.index');
    }
    public function file_upload() {
        return view('blog/file_upload');
    }
    public function file_upload_update() {
        $csv = request()->validate(['csv' => 'required'])['csv'];
        (new BlogCsvUploaderService($csv))->file_upload();
        return redirect()->route('blog.index');
    }
}
