@extends('..layouts.main')
@section('content')

<div class="content">
	<section id="inner_header"><h3>Тест по дискретной математике</h3></section>
	<img class="background" src="{{ asset("img/exam.jpg") }}" height="849" alt="">
	<form class="form" method="POST" action="{{ route('test.store') }}">
		@csrf
		<label for="fio"><b><br>Ваше ФИО:</b></label>
		<input type="text" id="fio" name="fio" placeholder="Введите ваше ФИО..." 
			@if (old('fio') != null) value='{{ old('fio') }}'@endif 
			@error('fio') style="background:rgb(255,158,158)" @enderror
		>
		@error('fio')
			<p class='err-msg'>{{ $message }}</p>
		@enderror

		<label for="group"><b><br>Ваша группа:</b></label>
		<select id="group" name="group"
			@if (old('group') != null) value={{ old('group') }}@endif
			@error('group') style="background:rgb(255,158,158)" @enderror 
		>
		<?
			$options = [
				'1 курс' => ['ИС/б-22-1-о', 'ИС/б-22-2-о', 'ИС/б-22-3-о', 'ПИ/б-22-1-о'],
				'2 курс' => ['ИС/б-21-1-о', 'ИС/б-21-2-о', 'ИС/б-21-3-о', 'ПИ/б-21-1-о'],
				'3 курс' => ['ИС/б-20-1-о', 'ИС/б-20-2-о', 'ПИ/б-20-1-о'],
				'4 курс' => ['ИС/б-19-1-о', 'ПИ/б-19-1-о']
			];
		?>
		<option></option>
		@foreach ($options as $optgroup_label => $optgroup_options)
			<optgroup label='{{ $optgroup_label }}'>
			@foreach ($optgroup_options as $option)
				<option @if (old('group') == $option) selected @endif>{{ $option }}</option>
			@endforeach
			</optgroup>
		@endforeach
		</select>
		@error('group')
			<p class="err-msg">{{ $message }}</p>
		@enderror


		<label for="question1"><b><br>Множество – это...</b></label>
		<fieldset id="question1" style="border:none">
			<input type="radio" value="набор каких-либо элементов" name="question1" id="answer11"
				@if (old('question1') == 'набор каких-либо элементов') {{' checked'}} @endif>
			<label for="answer11">набор каких-либо элементов</label><br>
			
			<input type="radio" value="перечень одинаковых элементов" name="question1" id="answer12"
				@if (old('question1') == 'перечень одинаковых элементов') {{' checked'}} @endif>
			<label for="answer12">перечень одинаковых элементов</label><br>
			
			<input type="radio" value="совокупность элементов, обладающих некоторым признаком, свойством" name="question1" id="answer13"
				@if (old('question1') == 'совокупность элементов, обладающих некоторым признаком, свойством') {{' checked'}} @endif>
			<label for="answer13">совокупность элементов, обладающих некоторым признаком, свойством</label><br>
    		
			<input type="radio" value="совокупность чисел" name="question1" id="answer14"
				@if (old('question1') == 'совокупность чисел') {{' checked'}} @endif>
			<label for="answer14">совокупность чисел</label><br>
		</fieldset>
		@error('question1')
			<p class="err-msg">{{ $message }}</p>
		@enderror


		<label for="question2"><b><br>Что из этого относится к дискретной математике?</b></label>
		<select id="question2" name="question2"
			@error('question2') style="background:rgb(255,158,158)" @enderror>
			<option></option>
			<? $options = ['Дефрагментация', 'Интеграл', 'Оксюморон', 'Импликация', 'Фотосинтез'] ?>
			@foreach ($options as $option)
				<option @if (old('question2') == $option) selected @endif>{{ $option }}</option>
			@endforeach
		</select>
		@error('question2')
			<p class='err-msg'>{{ $message }}</p>
		@enderror


		<label for="question3"><b><br>Что это за операция?<br>&and;<br></b></label>
		<textarea id="question3" name="question3" placeholder="Введите ваш ответ..."
			@error('question3') style="background:rgb(255,158,158)" @enderror
		>@if(old('question3')!=null){{ old('question3') }}@endif</textarea>
		@error('question3')
			<p class='err-msg'>{{ $message }}</p>
		@enderror
		
		<script>
			$('#fio, #question3')
				.on('input', function(){ clearValidation($(this)) });
			$('#group, #question1, #question2')
				.on('change', function(){ clearValidation($(this)) });

			function clearValidation(element) {
				if (element.attr('id') != 'question1')
					element.removeAttr('style');
				if (element.next().attr('class') == 'err-msg')
					element.next().remove();
			};
			
			function clearAllFields() {
				$('#fio, #group, [id^=question]').each(function() { clearValidation($(this)); });
				
				$('input[type=text]').removeAttr('value');
				$('textarea').text('');
				$('input[checked]').removeAttr('checked');
				$('option[selected]').removeAttr('selected');
			}
		</script>

		<div class="form_buttons">
			<input type="submit" value="Проверить">
			<input type="reset" value="Очистить форму" onclick="clearAllFields()">
		</div>
	</form>

	<form class="post-form-button" action="{{ route('test.table') }}">
        <input type="submit" value="Все ответы">
    </form>
</div>

@endsection


@section('extras')
	<link rel='stylesheet' type='text/css' href="{{ asset("css/test.css") }}">
@endsection