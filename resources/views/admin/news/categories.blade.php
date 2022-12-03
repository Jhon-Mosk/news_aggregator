@extends('layouts.app')

@section('title')
    @parent Категории новостей
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <a href="{{ route('admin.news.create') }}" class="btn btn-outline-primary create-news-btn ">Добавить новость</a>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary create-news-btn">Редактировать
        категории</a>
    <a href="{{ route('admin.news_sources.index') }}" class="btn btn-outline-primary create-news-btn">Источники новостей</a>
    <h1>Категории новостей</h1>
    <div class="list-group">
        @forelse ($categories as $item)
            <a class="list-group-item list-group-item-action"
                href="{{ route('admin.news.categoryNews', $item->slug) }}">{{ $item->name }}</a>
        @empty
            <p>Нет новостей</p>
        @endforelse
    </div>
@endsection
