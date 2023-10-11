@extends('..layouts.'.(empty(session('isAdmin')) ? 'main' : 'admin'))

@section('content')
<div class="content">
	<section id="inner_header"><h3>Тест по дискретной математике</h3></section>
    <img src="{{ asset("img/mike_chill.jpg") }}" class="background" height="850" alt="">
    <a href="{{ route("test.index") }}">
        <img src="{{ asset("img/back.png") }}" width="80" height="50" alt="back">
    </a>
    <table style="margin: 50px 100px; font-size: 16px">
        <tr>
            <th>Дата</th>
            <th>ФИО</th>
            <th>Группа</th>
            <th>Вопрос 1</th>
            <th>Вопрос 2</th>
            <th>Вопрос 3</th>
        </tr>
        @foreach ($models as $model)
        <tr>
            <td>{{ $model['date'] }}</td>
            <td>{{ $model['fio'] }}</td>
            <td>{{ $model['group'] }}</td>
            <td style="background:{{ $model['truth']['question1'] ? 'rgb(158,255,158)' : 'rgb(255,158,158)' }}">{{ $model['question1'] }}</td>
            <td style="background:{{ $model['truth']['question2'] ? 'rgb(158,255,158)' : 'rgb(255,158,158)' }}">{{ $model['question2'] }}</td>
            <td style="background:{{ $model['truth']['question3'] ? 'rgb(158,255,158)' : 'rgb(255,158,158)' }}">{{ $model['question3'] }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection

@section('extras')
    <link rel='stylesheet' type='text/css' href="{{ asset("css/table.css") }}">
@endsection