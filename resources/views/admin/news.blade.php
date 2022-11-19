@extends('layouts.app')

@section('title')
    @parent Новости
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <h1>Новости</h1>
    <div class="list-group">
        @forelse ($categories as $item)
            <a class="list-group-item list-group-item-action"
                href="{{ route('news.categoryNews', $item->slug) }}">{{ $item->name }}</a>
        @empty
            <p>Нет новостей</p>
        @endforelse
    </div>
@endsection
