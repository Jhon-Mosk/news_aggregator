@extends('layouts.app')

@section('title')
    @parent Категории новостей
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h1>Категории новостей</h1>
    <div class="list-group">
        @forelse ($categories as $item)
            <a class="list-group-item list-group-item-action"
                href="{{ route('news.categoryNews', $item->slug) }}">{{ $item->name }}</a>
        @empty
            <p>Нет новостей</p>
        @endforelse
    </div>
@endsection
