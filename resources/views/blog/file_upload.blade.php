@extends('..layouts.'.(empty(session('isAdmin')) ? 'main' : 'admin'))

@section('content')
<div class="content">
    <section id="inner_header"><h3>Мой блог</h3></section>
	<img src="{{ asset('img/blog.jpg') }}" class="background" height="849" alt="">
    <a href="{{ route('blog.index') }}">
        <img src="{{ asset('img/back.png') }}" width="80" height="50" alt="back">
    </a>
    <form class="form" method="POST" action="{{ route('blog.file_upload_update') }}" enctype="multipart/form-data">
        @csrf
        <h3>Загрузка постов из файла</h3><br>

        <label for="csv">Файл:</label>
        <input type="file" id="csv" name="csv" accept=".csv">
        @error('csv')
            <p class="err-msg">{{ $message }}</p>
        @enderror
        <br>

        <script>
            $('#csv').on('change', function(){ clearValidation($(this)) });
			function clearValidation(element) {
				if (element.next().attr('class') == 'err-msg') {
					element.next().remove();
				}
			};
			function clearAllFields() {
				$('#csv').each(function() { clearValidation($(this)); });
                $('input[type=file]').removeAttr('value');
            }
        </script>

        <div class="form_buttons">
            <input type="submit">
            <input type="reset" onclick="clearAllFields()">
        </div>
    </form>
</div>
@endsection