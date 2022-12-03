@extends('layouts.app')

@section('title')
    @parent Источники новостей
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <a class="btn btn-outline-primary create-news-btn " href="{{ route('admin.news_sources.create') }}">Добавить источник</a>
    <a class="btn btn-outline-primary create-news-btn " href="{{ route('admin.news.parser') }}">Добавить в очередь на
        выполнение</a>
    <a class="btn btn-outline-primary create-news-btn " href="{{ route('admin.news.parse') }}">Запустить парсинг</a>
    <h1>Источники новостей</h1>
    <ul class="list-group">
        @forelse ($sources as $source)
            <li class="list-group-item">
                <h3>{{ $source->link }}</h3>
                <form action="{{ route('admin.news_sources.destroy', $source) }}" method="post">
                    <a class="btn" href="{{ route('admin.news_sources.edit', $source) }}">Редактировать</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn">Удалить</button>
                </form>
            </li>
        @empty
            <p>Нет источников</p>
        @endforelse
    </ul>
@endsection
