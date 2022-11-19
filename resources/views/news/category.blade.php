@extends('layouts.app')

@section('title')
    @parent Новости
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h1>{{ $category->name ?? 'Такой категории нет' }}</h1>
    <div class="list-group">
        @forelse ($news as $item)
            <a class="list-group-item list-group-item-action"
                href="{{ route('news.oneNews', [$category->slug, $item->slug]) }}">{{ $item->title }}</a>
        @empty
            <p>Нет новостей</p>
        @endforelse
    </div>
@endsection
