@extends('..layouts.'.(empty(session('isAdmin')) ? 'main' : 'admin'))

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="content" style="height:80%">
    <section id="inner_header"><h3>Мой блог</h3></section>
	<img src="{{ asset('img/blog.jpg') }}" class="background" height="849" alt="">
    <a href="{{ route('blog.index') }}">
        <img src="{{ asset('img/back.png') }}" width="80" height="50">
    </a>
        <section id="blogpost" class="blogpost">
            @isset($model['image'])
            <img id="img" src="{{ url('/storage/img/blog/' . $model['image']) }}" alt="Post image">
            @endisset
            <h1><b id="title">{{ $model['title'] }}</b><i> от {{ $model['author'] }}</i></h1>
            <br>
            <p id="content"><?=str_replace("\r\n", '<br>', $model['content'])?></p>
            
            @if(session('login')==$model['author'] || !empty(session('isAdmin')))
            <div class="blogpost-buttons">
                <input type="button" onclick="redactStart()" value="Редактировать">
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
        
    <div id="comments">
        <h3 style="text-indent:50px; margin-top:30px">Комментарии:</h3> 
        @foreach ($comments as $comment)
        <div class="comment">
            <h3>{{ $comment->author }}</h3>
            <p>{{ $comment->content }}</p>
            <p class="blogpost-date">{{ $comment->created_at }}</p>
        </div>
        @endforeach
    </div>

    {{-- <div class="comment-input">
        <label for="comment_input">Сообщение:</label><br>
        <textarea id="comment_input" placeholder="Введите сообщение..."></textarea>
        <div class="blogpost-buttons">
            <input type="button" id="comment_action" value="Отправить">
            <input type="button" id="comment_cancel" value="Отмена">
        </div>
    </div> --}}

    @auth
        <div class="post-form-button" style='margin-top:10px'>
            <input type="button" value="Написать комментарий">
        </div>
    @endauth
    
</div>
@endsection

@section('extras')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/post.css') }}">
    <script src="{{ asset('js/ajax/comment.js') }}"></script>
    <script src="{{ asset('js/ajax/blog_redact.js') }}"></script>
@endsection