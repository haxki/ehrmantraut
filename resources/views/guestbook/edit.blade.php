@extends('..layouts.main')
@section('content')

<div class="content">
    <section id="inner_header"><h3>Гостевая книга</h3></section>
	<img src="{{ asset('img/guest_book.jpg') }}" class="background" height="849" alt="">
    <a href="{{ route('guestbook.index') }}">
        <img src="{{ asset("img/back.png") }}" width="90" height="50" alt="back">
    </a>

    <form class="form" method="POST" action="{{ route('guestbook.update') }}"
        enctype="multipart/form-data" style="min-height:150px">

        @csrf
        <h3 style="text-align:center; margin:0">Загрузка гостевой книги</h3><br>
        <label for="guestbook">Файл:</label>
        <input id="guestbook" type="file" name="guestbook" accept=".inc">
        @error('guestbook')<p class='err-msg'>{{ $message }}</p>@enderror

        <div class="form_buttons">
            <input type="submit">
            <input type="reset">
        </div>
    </form>

</div>

@endsection