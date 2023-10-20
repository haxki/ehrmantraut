<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('meta')
        <script src="{{ asset("js/jquery-3.6.2.js") }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset("css/style.css") }}">
        <title>Мой сайт</title>
    </head>
    <body>
        <header>
            <h1>Мой сайт<h1>
                @if (session('authorized') == true)
                <div>
                    <div><b id="login">{{ session('login') }}</b>{{ " (" . session('fio') . ")" }}</div>
                    <a href="{{ route('auth.logout') }}">Выйти</a>
                </div>
                @else
                <a href="{{ route('auth.login') }}">Вход</a>
                <a href="{{ route('auth.registration') }}">Регистрация</a>
                @endif
            </header>
            @if(session('something'))
            <p class="task3">Любимый персонаж: {{ session('something') }}</p>
            @endif
            <main>
                <nav><ul>
                    <li><a href="{{ route('main.index') }}">Главная</a></li>
                    <li><a href="{{ route('about.index') }}">Обо мне</a></li>	
                    <li><a href="{{ route('hobbies.index') }}">Мои интересы</a></li>
                    <li><a href="{{ route('blog.index') }}">Мой блог</a></li>
                    <li><a href="{{ route('learning.index') }}">Учеба</a></li>
                    <li><a href="{{ route('photo.index') }}">Фотоальбом</a></li>
                    <li><a href="{{ route('contact.index') }}">Контакт</a></li>
                    <li><a href="{{ route('test.index') }}">Тест по дискретной математике</a></li>
                    <li><a href="{{ route('history.index') }}">История просмотра</a></li>
                    <li><a href="{{ route('guestbook.index') }}">Гостевая книга</a></li>
                </ul></nav>

                @yield('content')
                
            </main>
    
            @if (session('alert'))
                <script>alert("{{session('alert')}}")</script>
            @endif
                
            <script src="{{ asset("js/menu_items_handler.js") }}"></script>
            <script src="{{ asset("js/time.js") }}"></script>
            <script src="{{ asset("js/history.js") }}"></script>

            @yield('extras')
            
    </body>
</html>