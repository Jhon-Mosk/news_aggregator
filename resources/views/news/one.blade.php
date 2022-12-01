@extends('layouts.app')

@section('title')
    @parent Новость
@endsection

@section('menu')
    @include('menu')
@endsection
@section('content')
    @if ($news)
        <div class="card">
            <img src="{{ $news->image ?? asset('/storage/img/default.jpg') }}" class="card-img-top" alt="news picture">
            <div class="card-body">
                <h2 class="card-title">{{ $news->title }}</h2>
                @if (!$news->isPrivate || Auth::user())
                    <p class="card-text">{{ $news->text }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ $news->link }}" target="blank">Ссылка на источник</a>
                        <div>Дата публикации: {{ $news->pubDate }}</div>
                    </div>
                @else
                    <p class="card-text">Зарегистрируйтесь для просмотра</p>
                @endif
            </div>
        </div>
    @else
        <h2>Такой новости нет</h2>
    @endif
@endsection
