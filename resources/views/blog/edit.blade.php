@extends('..layouts.'.(empty(session('isAdmin')) ? 'main' : 'admin'))

@section('content')
<div class="content" style="height:80%">
    <section id="inner_header"><h3>Мой блог</h3></section>
	<img src="{{ asset('img/blog.jpg') }}" class="background" height="849" alt="">
    <a href="{{ route('blog.index') }}">
        <img src="{{ asset('img/back.png') }}" width="80" height="50">
    </a>

    <form class="blogpost" enctype="multipart/form-data" method="POST" action="{{ route("blog.update", $model['id']) }}">
        @csrf
        <img src="{{ url('/storage/img/blog/' . $model['image']) }}">
        
        <label for="title">Заголовок:</label><br>
        <input type="text" id="title" name="title"
            value="{{ old('title') != null ? old('title') : $model['title']}}"
            @error('title') style="rgb(255,158,158)" @enderror>
        @error('title')
            <p class="err-msg">{{ $message }}</p>
        @enderror
        <br>

        <label for="content">Содержание:</label><br>
        <textarea id="content" name="content" @error('title') style="rgb(255,158,158)" @enderror
            >{{ old('content') != null ? old('content') : $model['content']}}</textarea>
        @error('content')
            <p class="err-msg">{{ $message }}</p>
        @enderror
        <br>

        <label for="image">Новое изображение (опционально):</label><br>
        <input type="file" id="image" name="image">
        @error('image')
            <p class="err-msg">{{ $message }}</p>
        @enderror
        <br>
        
        <input type="checkbox" id="delete_image" name="delete_image" 
            @if(old('delete_image') != null) checked @endif>
        <label for="delete_image">Удалить изображение</label>

        <p class="blogpost-date">{{ $model['created_at'] }}</p>
        <div class="blogpost-buttons">
            <input type="submit" value="Сохранить">
            <a href="{{ route("blog.show", $model['id']) }}">
                <input type="button" value="Отменить">
            </a>
        </div>
    </form>
</div>
@endsection

@section('extras')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/post.css') }}">
@endsection