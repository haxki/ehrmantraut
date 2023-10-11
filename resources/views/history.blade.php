@extends('layouts.'.(empty(session('isAdmin')) ? 'main' : 'admin'))

@section('content')
	<div class="content">
		<section id="inner_header"><h3>История просмотра</h3></section>
		<img class="background" src="{{ asset("img/history.jpg") }}" height="849" alt="">
		<div style="margin-top: 100px"><h2>История текущего сеанса</h2></div>
		<div><h2>История за всё время</h2></div>
	</div>
@endsection

@section('extras')
	<link rel='stylesheet' type='text/css' href="{{ asset("css/history.css") }}">
@endsection