@extends('layouts.app')

@section('title')
    @parent Новость
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    @if ($news)
        <div class="card">
            <img src="{{ $news->image ?? asset('/storage/img/default.jpg') }}" class="card-img-top" alt="news picture">
            <div class="card-body">
                <h2 class="card-title">{{ $news->title }}</h2>
                @if (!$news->isPrivate)
                    <p class="card-text">{{ $news->text }}</p>
                @else
                    <p class="card-text">Зарегистрируйтесь для просмотра</p>
                @endif
            </div>
            <form action="{{ route('admin.news.destroy', $news) }}" method="post">
                <a class="btn btn-outline-primary" href="{{ route('admin.news.edit', $news) }}">Редактировать</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-primary">Удалить</button>
            </form>
        </div>
    @else
        <h2>Такой новости нет</h2>
    @endif
@endsection
