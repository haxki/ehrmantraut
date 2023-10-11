@extends('layouts.'.(empty(session('isAdmin')) ? 'main' : 'admin'))

@section('content')
<div class="content">
	<section id="inner_header"><h3>Главная</h3></section>
	<img src="{{ asset("img/mike_main.jpg") }}" class="background" height="849" alt="">
	<section id="inner_content">
	    <div class="photo">
			<img src="{{ asset("img/mike_main.jpg") }}" alt="">
		</div>
		<div class="description">
			<h1>
                Этот сайт посвящен<br><b>Майку Эрмантрауту<br>a.k.a. <i>"Kid named finger"</i>
                </b><br>из <i>Альбукерке, Нью-Мексико</i>.
            </h1>
		</div>
	</section>
</div>
@endsection
