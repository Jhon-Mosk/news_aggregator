@extends('layouts.app')

@section('title')
    @parent Категории новостей
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary create-news-btn ">Добавить категорию</a>
    <h1>Категории новостей</h1>
    <div class="list-group">
        @forelse ($categories as $item)
            <li class="list-group-item">
                {{ $item->name }}
                <form action="{{ route('admin.categories.destroy', $item) }}" method="post">
                    <a class="btn" href="{{ route('admin.categories.edit', $item) }}">Редактировать</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn">Удалить</button>
                </form>
            </li>
        @empty
            <p>Нет категорий</p>
        @endforelse
    </div>
@endsection
