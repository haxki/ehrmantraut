<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="{{ asset("js/jquery-3.6.2.js") }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/style.css") }}">
	<title>Мой сайт</title>
</head>
<body>
    <header>
        <h1>Мой сайт<h1>
        <div>
            <div>{{ session('login') . " (" . session('fio') . ")" }}</div>
            <a href="{{ route('auth.logout') }}">Выйти</a>
        </div>
    </header>
    <main>
        <nav><ul>
            <li><a href="{{ route('blog.index') }}">Мой блог</a></li>
            <li><a href="{{ route('guestbook.index') }}">Гостевая книга</a></li>
            <li><a href="{{ route('spy.index') }}">Посетители</a></li>
        </ul></nav>

        @yield('content')
        
    </main>

    @if (session('alert'))
	    <script>alert("{{session('alert')}}")</script>
    @endif

    <script src="{{ asset("js/menu_items_handler.js") }}"></script>
    <script src="{{ asset("js/time.js") }}"></script>
    
    @hasSection('extras')
        @yield('extras')
    @endif

</body>
</html>