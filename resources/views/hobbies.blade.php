@extends('layouts.main')
@section('content')
	<div class="content">
		<section id="inner_header"><h3>Мои интересы</h3></section>
		<img src="{{ asset("img/mike_hobbies.jpg") }}" class="background" height="1100" alt="">
		<section class="hobbies">
			
			@foreach($hobbiesInfo as $i => $data)
			<div>
				<img src="{{ asset($data['img_src']) }}" alt="{{ $data['img_alt'] }}" title="{{ $data['img_title'] }}">
				<h1 id="{{ $data['header_id'] }}">{{ $data['header_content'] }}</h1>
				<p>{{ $data['description'] }}</p>
			</div>
			@endforeach
			
		</section>
	</div>
@endsection