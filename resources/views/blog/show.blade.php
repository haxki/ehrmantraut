@extends('..layouts.'.(empty(session('isAdmin')) ? 'main' : 'admin'))

@section('content')
<div class="content" style="height:80%">
    <section id="inner_header"><h3>Мой блог</h3></section>
	<img src="{{ asset('img/blog.jpg') }}" class="background" height="849" alt="">
    <a href="{{ route('blog.index') }}">
        <img src="{{ asset('img/back.png') }}" width="80" height="50">
    </a>

    <section class="blogpost">
        @isset($model['image'])
            <img src="{{ url('/storage/img/blog/' . $model['image']) }}" alt="Post image">
        @endisset
        <h1>{{ $model['title'] }}<i> от {{ $model['author'] }}</i></h1>
        <br>
        <p><?=str_replace("\r\n", '<br>', $model['content'])?></p>

        @if(session('login')==$model['author'] || !empty(session('isAdmin')))
        <div class="blogpost-buttons">
            <form method="GET" action="{{ route("blog.edit", $model['id']) }}">
                <input type="submit" value="Редактировать">
            </form>
            <form method="POST" action="{{ route("blog.destroy", $model['id']) }}">
                @csrf
                @method('delete')
                <input type="submit" value="Удалить">
            </form>
        </div>
        @endif

        <p class="blogpost-date">{{
            $model['created_at'] . ($model['updated_at']!=$model['created_at'] ? ' (redacted at ' . $model['updated_at'] . ')' : '')
        }}</p>
    </section>
</div>
@endsection

@section('extras')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/post.css') }}">
@endsection