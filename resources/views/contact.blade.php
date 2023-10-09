@extends('layouts.main')
@section('content')

<div class="content">
	<section id="inner_header"><h3>Контакт</h3></section>
	<img class="background" src="{{ asset("img/contact.jpg") }}" height="849" alt="">

	<form class="form" method="POST" action="{{ route('contact.store') }}">
		@csrf
		<h3 style="text-align: center">Отправьте мне сообщение</h3><br>

		<label for="fio">Ваше ФИО:</label>
		<input type="text" id="fio" name="fio" placeholder="Введите ваше ФИО..." 
			@if (old('fio')!=null) value="{{ old('fio') }}" @endif
			@error ('fio') style="background:rgb(255,158,158)" @enderror
		>
			@error('fio')
				<p class='err-msg'>{{ $message }}</p>
			@enderror
		<br> 


		<label for="phone">Ваш телефон:</label>
		<input type="text" id="phone" name="phone" placeholder="Введите ваш телефон..."
			@if (old('phone')!=null) value="{{ old('phone') }}" @endif
			@error ('phone') style="background:rgb(255,158,158)" @enderror
		>
			@error('phone')
				<p class='err-msg'>{{ $message }}</p>
			@enderror
		<br>
		

		<label for="birthdate">Дата вашего рождения:</label>
		<input type="text" id="birthdate" name="birthdate" placeholder="Выберите дату вашего рождения..." readonly
			@if (old('birthdate')!=null) value="{{ old('birthdate') }}" @endif
			@error ('birthdate') style="background:rgb(255,158,158)" @enderror
		>
			@error('birthdate')
				<p class='err-msg'>{{ $message }}</p>
			@enderror
		<br>
		

		<label for="gender">Ваш пол:</label>
		<fieldset id="gender" name="gender" style="border: none">
			<input type="radio" value="Мужчина" name="gender" id="gender_male" 
				@if (old('gender') == 'Мужчина') checked @endif>
			<label for="gender_male">Мужчина</label>

			<input type="radio" value="Женщина" name="gender" id="gender_female"
				@if (old('gender') == 'Женщина') checked @endif>
			<label for="gender_female">Женщина</label>
		</fieldset>
			@error('gender')
				<p class='err-msg'>{{ $message }}</p>
			@enderror
		<br>
		

		<label for="age">Ваш возраст:</label>
		<select id="age" name="age" @error('age') style="background:rgb(255,158,158)" @enderror>
			<? $options = ['', 'До 14', 'От 15 до 24', 'От 25 до 34', 'От 35 до 44', 'От 45 до 54', 'От 55'] ?>
			@foreach ($options as $option)
				<option @if(old('age') == $option) selected @endif>{{ $option }}</option>
			@endforeach
		</select>
			@error('age')
				<p class='err-msg'>{{ $message }}</p>
			@enderror
		<br>


		<label for="email">Ваш e-mail:</label>
		<input type="text" id="email" name="email" placeholder="Введите ваш e-mail..."
			@if (old('email')!=null) value="{{ old('email') }}" @endif
			@error ('email') style="background:rgb(255,158,158)" @enderror
		>
			@error('email')
				<p class='err-msg'>{{ $message }}</p>
			@enderror
		<br>
	

		<label for="message">Сообщение:</label>
		<textarea id="message" name="message" placeholder="Введите ваше сообщение..."'
			@error ('message') style="background:rgb(255,158,158)" @enderror
		>@if (old('message')!=null){{ old('message') }}@endif</textarea>
			@error('message')
				<p class='err-msg'>{{ $message }}</p>
			@enderror
		<br>

		<script>
			$('#fio, #email, #message, #phone')
				.on('input', function(){ clearValidation($(this)) });
			$('#age, #gender').on('change', function(){ clearValidation($(this)) });
			
			function clearValidation(element) {
				if (element.attr('id') != 'gender')
					element.removeAttr('style');
				switch (element.next().attr('class')) {
					case 'err-msg':
						element.next().remove();
						break;
					case 'popover':
						if (element.next().next().attr('class') == 'err-msg')
							element.next().next().remove();
				}
			};

			function clearAllFields() {
				$('#fio, #email, #message, #phone, #age, #gender').each(function() { 
					clearValidation($(this));

					$('input[type=text]').removeAttr('value');
					$('textarea').text('');
					$('input[checked]').removeAttr('checked');
					$('option[selected]').removeAttr('selected');
				});
			}
		</script>
		<div class="form_buttons">
			<input type="submit">
			<input type="reset" value="Очистить форму" onclick="clearAllFields()">
		</div>
	</form>
</div>

@endsection


@section('extras')
    <script src="{{ asset("js/calendar.js") }}"></script>
    <script src="{{ asset("js/popover.js") }}"></script>
    <link rel='stylesheet' type='text/css' href="{{ asset("css/calendar.css") }}">
@endsection