<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="{{ asset("js/jquery-3.6.2.js") }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/style.css") }}">
	<title>Мой сайт</title>
</head>
    <form class="form" method="POST" action="{{ route('auth.registration') }}">
        @csrf
        <h3 style="text-align:center">Регистрация</h3>
        <label for="login">Логин:</label>
        <input id="login" name="login" type="text" placeholder="Введите логин..."
            @if(old('login')!=null) value="{{ old('login') }}" @endif>
        @error('login')
            <p class="err-msg">{{ $message }}</p>
        @enderror
        <br>

        <label for="password">Пароль:</label>
        <input id="password" name="password" type="password" placeholder="Введите пароль..."
            @if(old('password')!=null) value="{{ old('password') }}" @endif>
        @error('password')
            <p class="err-msg">{{ $message }}</p>
        @enderror
        <br>

        <label for="fio">ФИО:</label>
        <input id="fio" name="fio" type="text" placeholder="Введите ФИО..."
            @if(old('fio')!=null) value="{{ old('fio') }}" @endif>
        @error('fio')
            <p class="err-msg">{{ $message }}</p>
        @enderror
        <br>

        <label for="email">E-mail:</label>
        <input id="email" name="email" type="text" placeholder="Введите e-mail..."
            @if(old('email')!=null) value="{{ old('email') }}" @endif>
        @error('email')
            <p class="err-msg">{{ $message }}</p>
        @enderror

        <div class="form_buttons">
            <input type="submit" value="Регистрация">
            <a href="{{ url()->previous() }}" style="width:45%">
                <input type="button" value="Отмена" style="height:2em; width:100%">
            </a>
        </div>
    </form>
</html>