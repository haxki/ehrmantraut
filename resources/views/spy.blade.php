@extends('..layouts.'.(empty(session('isAdmin')) ? 'main' : 'admin'))

@section('content')
<div class="content">
    <section id="inner_header"><h3>Посетители</h3></section>
	<img src="{{ asset('img/mike.jpg') }}" class="background" height="849" alt="">
    <table style="margin: 50px 100px; font-size: 14px">
        <tr>
            <th>Страница</th>
            <th>Время посещения</th>
            <th>IP</th>
            <th>Хост</th>
            <th>Браузер</th>
        </tr>
        @foreach ($entries as $entry)
        <tr>
            <td>{{ $entry->path }}</td>
            <td>{{ $entry->created_at }}</td>
            <td>{{ $entry->ip }}</td>
            <td>{{ $entry->host }}</td>
            <td>{{ $entry->browser }}</td>
        </tr>
        @endforeach
    </table>

    <form method="GET">
        <div class="blog-pagination">
            <button type="submit" name="page" class="directive" value="{{
                $entries->currentPage() > 1 ? $entries->currentPage() - 1 : $entries->currentPage()
            }}">&leftarrow; Предыдущая</button>

            <?
                $pageCount = round($entries->total() / $entries->perPage());
                if ($pageCount == 0) $pageCount++;
            ?>
            @if ($pageCount <= 5)
                @for ($i = 0; $i < $pageCount; $i++)
                    <input type="submit" name="page" value="{{ $i+1 }}" @if($entries->currentPage() == $i+1) class="current" @endif>
                @endfor
            @else
                <input type="submit" name="page" value="1" @if($entries->currentPage() == 1) class="current" @endif>
                <input type="submit" name="page" value="2" @if($entries->currentPage() == 2) class="current" @endif>
                <input type="button" value="...">
                <input type="submit" name="page" value="{{ $pageCount / 2 + $pageCount % 2 }}"
                    @if($entries->currentPage() == $pageCount / 2 + $pageCount % 2) class="current" @endif>
                <input type="button" value="...">
                <input type='submit' name="page" value="{{ $pageCount-1 }}" @if($entries->currentPage() == $pageCount-1) class="current" @endif>
                <input type='submit' name="page" value="{{ $pageCount }}" @if($entries->currentPage() == $pageCount) class="current" @endif>
            @endif
            <button type="submit" name="page" class="directive" value="{{
                $pageCount != $entries->currentPage() ? $entries->currentPage() + 1 : $entries->currentPage()
            }}">Следующая &rightarrow;</button>
        </div>
    </form>
</div>
@endsection

@section('extras')
<link rel="stylesheet" type="text/css" href="{{ asset('css/blog.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/table.css') }}">
@endsection