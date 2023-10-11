@extends('..layouts.'.(empty(session('isAdmin')) ? 'main' : 'admin'))

@section('content')
<div class="content">
    <section id="inner_header"><h3>Гостевая книга</h3></section>
	<img src="{{ asset("img/guest_book.jpg") }}" class="background" height="1070" alt="">
    <table style="margin: 50px 100px; font-size: 20px">
        <tr>
            <th>Дата</th>
            <th>ФИО</th>
            <th>E-mail</th>
            <th>Отзыв</th>
        </tr>
        @foreach ($rows as $row)
        <tr>
            <td>{{ $row['date'] }}</td>
            <td>{{ $row['fio'] }}</td>
            <td>{{ $row['email'] }}</td>
            <td>{{ $row['message'] }}</td>
        </tr>
        @endforeach
    </table>

    <form class="form" method="POST" action="{{ route('guestbook.store') }}">
        @csrf
        <h3 style="text-align:center;margin:0">Оставьте отзыв</h3><br>

        <label for="lastname"><b><br>Фамилия:</b></label>
        <input type="text" id="lastname" name="lastname" placeholder="Введите вашу фамилию..."
            @if(old('lastname')!=null) value="{{ old('lastname') }}" @endif
            @error('lastname') style="background:rgb(255,158,158)" @enderror>
        @error('lastname') 
            <p class="err-msg">{{ $message }}</p>
        @enderror
            
        <label for="firstname"><b><br>Имя:</b></label>
        <input type="text" id="firstname" name="firstname" placeholder="Введите ваше имя..."
            @if(old('firstname')!=null) value="{{ old('firstname') }}" @endif
            @error('firstname') style="background:rgb(255,158,158)" @enderror>
        @error('firstname') 
            <p class="err-msg">{{ $message }}</p>
        @enderror

        <label for="patronymic"><b><br>Отчество:</b></label>
        <input type="text" id="patronymic" name="patronymic" placeholder="Введите ваше отчество (если есть)..."
            @if(old('patronymic')!=null) value="{{ old('patronymic') }}" @endif
            @error('patronymic') style="background:rgb(255,158,158)" @enderror>
        @error('patronymic') 
            <p class="err-msg">{{ $message }}</p>
        @enderror
            
        <label for="email"><b><br>E-mail:</b></label>
        <input type="text" id="email" name="email" placeholder="Введите ваш e-mail..."
            @if(old('email') != null) value="{{ old('email') }}" @endif
            @error('email') style="background:rgb(255,158,158)" @enderror>
        @error('email') 
            <p class="err-msg">{{ $message }}</p>
        @enderror

        <label for="message"><b><br>Отзыв:</b></label>
        <textarea id="message" name="message" placeholder="Введите ваш отзыв..." 
            @error('message') style="background:rgb(255,158,158)" @enderror
            >@if(old('message') != null){{ old('message') }}@endif</textarea>
        @error('message') 
            <p class="err-msg">{{ $message }}</p>
        @enderror

        <script>
            $('#lastname, #firstname, #patronymic, #email, #message')
				.on('input', function(){ clearValidation($(this)) });
			
			function clearValidation(element) {
				if (element.attr('id') != 'gender') {
					element.removeAttr('style');
                }
				if (element.next().attr('class') == 'err-msg') {
					element.next().remove();
				}
			};

			function clearAllFields() {
				$('#lastname, #firstname, #patronymic, #email, #message').each(function() { clearValidation($(this)); });
                
                $('input[type=text]').removeAttr('value');
				$('textarea').text('');
			}
        </script>

        <div class="form_buttons">
            <input type="submit">
            <input type="reset" value="Очистить форму" onclick="clearAllFields()">
        </div>
    </form>
    
    @if(!empty(session('isAdmin')))
    <form class="post-form-button" action="{{ route('guestbook.edit') }}">
        <input type="submit" value="Загрузка гостевой книги">
    </form>
    @endif
</div>
@endsection
    
@section('extras')
    <link rel='stylesheet' type='text/css' href="{{ asset("css/table.css") }}">
@endsection