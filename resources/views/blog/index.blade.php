@extends('..layouts.main')
@section('content')

<div class="content">
    <section id="inner_header"><h3>Мой блог</h3></section>
	<img src="{{ asset('img/blog.jpg') }}" class="background" height="849" alt="">

    <? $perPage = isset($_GET['perPage']) ? $_GET['perPage'] : $posts->perPage() ?>

    <section class="blog">
        @for ($i = 0; $i < round(count($posts) / 2); $i++)
            <div class="blog-row">
            @for ($j = 0; $j < 2 && (($i+1)*2-count($posts)!=1 || $j==0); $j++)
                <? $post = $posts[$i*2 + $j] ?>
                <a class="blog-cell" href="{{ route('blog.show', $post['id']) }}">
                    @if (isset($post['image'])) 
                        <img src="{{ url('/storage/img/blog/' . $post['image']) }}">
                    @endif
                    <h3>{{ $post['title'] }}</h3>
                    <p>{{ $post['content'] }}</p>
                    <p class="blog-cell-date">{{ 
                        $post['created_at'] . ($post['updated_at']!=$post['created_at'] ? ' (redacted at ' . $post['updated_at'] . ')' : '')
                    }}</p>
                </a>
            @endfor
            </div>
        @endfor

        <form method="GET">
            <label for="perPage">Количество постов на странице:</label>
            <select id="perPage" name="perPage">
                @for ($i = 0; $i < 10; $i++)
                    <option @if($posts->perPage() == $i+1) selected @endif>{{ $i+1 }}</option>
                @endfor
            </select>
            <br>

            <div class="blog-pagination">
                <button type="submit" name="page" class="directive" value="{{
                    $posts->currentPage() > 1 ? $posts->currentPage() - 1 : $posts->currentPage()
                }}">&leftarrow; Предыдущая</button>

                <? $pageCount = round($posts->total() / $posts->perPage()) ?>
                @if ($pageCount <= 5)
                    @for ($i = 0; $i < $pageCount; $i++)
                        <input type="submit" name="page" value="{{ $i+1 }}" @if($posts->currentPage() == $i+1) class="current" @endif>
                    @endfor
                @else
                    <input type="submit" name="page" value="1" @if($posts->currentPage() == 1) class="current" @endif>
                    <input type="submit" name="page" value="2" @if($posts->currentPage() == 2) class="current" @endif>
                    <input type="button" value="...">
                    <input type="submit" name="page" value="{{ $pageCount / 2 + $pageCount % 2 }}"
                        @if($posts->currentPage() == $pageCount / 2 + $pageCount % 2) class="current" @endif>
                    <input type="button" value="...">
                    <input type='submit' name="page" value="{{ $pageCount-1 }}" @if($posts->currentPage() == $pageCount-1) class="current" @endif>
                    <input type='submit' name="page" value="{{ $pageCount }}" @if($posts->currentPage() == $pageCount) class="current" @endif>
                @endif
                <button type="submit" name="page" class="directive" value="{{
                    $pageCount != $posts->currentPage() ? $posts->currentPage() + 1 : $posts->currentPage()
                }}">Следующая &rightarrow;</button>
            </div>
        </form>

    </section>

    <form class="post-form-button" action="{{ route('blog.create') }}">
        <input type="submit" value="Добавить пост">
    </form>
</div>

@endsection

@section('extras')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/blog.css') }}">
@endsection