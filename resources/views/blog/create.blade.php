@extends('..layouts.'.(empty(session('isAdmin')) ? 'main' : 'admin'))

@section('content')
<div class="content">
    <section id="inner_header"><h3>Мой блог</h3></section>
	<img src="{{ asset('img/blog.jpg') }}" class="background" height="849" alt="">
    <a href="{{ route('blog.index') }}">
        <img src="{{ asset('img/back.png') }}" width="80" height="50" alt="back">
    </a>
    
    <form class="form" method="POST" action="{{ route('blog.index') }}" enctype="multipart/form-data">
        @csrf
        <h3>Новый пост</h3><br>

        <label for="title">Заголовок:</label>
        <input type="text" id="title" name="title"
            @error('title') style="background:rgb(255,158,158)"@enderror
            @if(old('title')){{ old('title') }}@endif>
        @error('title')
            <p class="err-msg">{{ $message }}</p>
        @enderror
        <br>

        <label for="content">Содержание:</label>
        <textarea id="content" name="content"
            @error('content') style="background:rgb(255,158,158)"@enderror
            >@if(old('content')){{ old('content') }}@endif</textarea>
        @error('content')
            <p class="err-msg">{{ $message }}</p>
        @enderror
        <br>

        <label for="image">Изображение</label>
        <input type="file" id="image" name="image"
            @if(old('image') != null) value="{{ old('image') }}" @endif>
        @error('image')
            <p class="err-msg">{{ $message }}</p>
        @enderror
        <br>

        <script>
            $('#title, #content').on('input', function(){ clearValidation($(this)) });
			$('#image').on('change', function(){ clearValidation($(this)) });
			
			function clearValidation(element) {
			    element.removeAttr('style');
				if (element.next().attr('class') == 'err-msg') {
					element.next().remove();
				}
			};

			function clearAllFields() {
				$('#title, #content, #image').each(function() { clearValidation($(this)); });
                $('input[type=text], input[type=file]').removeAttr('value');
                $('textarea').text('');
			}
        </script>

        <div class="form_buttons">
            <input type="submit">
            <input type="reset" onclick="clearAllFields()">
        </div>
    </form>

    @if (session()->has('isAdmin'))
    <form class="post-form-button" action="{{ route('blog.file_upload') }}">
        <input type="submit" value="Загрузка файлом">
    </form>
    @endif
</div>
@endsection