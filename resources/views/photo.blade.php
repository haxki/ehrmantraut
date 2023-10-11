@extends('layouts.'.(empty(session('isAdmin')) ? 'main' : 'admin'))

@section('content')
	<section id="inner_header"><h3>Фотоальбом</h3></section>
	<img src="{{ asset("img/mike.jpg") }}" class="background" height="909" alt="">
	<section class="content">
		<h1 style="margin: 30px 100px; font-size: 30px">Здесь несколько моих школьных фотографий</h1>
		<div class="gallery">
			@foreach($photosInfo as $i => $data)
				<div>
					<img src="{{ asset("img/bb/".$data['img']) }}" title="{{ $data['title'] }}" alt='Фото не найдено'>
					<p>{{ $data['title'] }}</p>
				</div>
			@endforeach
		</div>
	</section>
@endsection

@section('extras')
	<script src="{{ asset("js/photo_grid.js") }}"></script>
@endsection