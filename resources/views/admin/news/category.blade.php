@extends('layouts.app')

@section('title')
    @parent Новости
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <h1>{{ $category->name ?? 'Такой категории нет' }}</h1>
    <div class="list-group">
        @forelse ($news as $item)
            <ul class="list-group">
                <li class="list-group-item">
                    <a class="list-group-item list-group-item-action"
                        href="{{ route('admin.news.oneNews', [$category->slug, $item->slug]) }}">
                        {{ $item->title }}
                    </a>
                    <form action="{{ route('admin.news.destroy', $item) }}" method="post">
                        <a class="btn" href="{{ route('admin.news.edit', $item) }}">Редактировать</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Удалить</button>
                    </form>
                </li>
            </ul>
        @empty
            <p>Нет новостей</p>
        @endforelse

        <div class="mt-5">
            {{ $news->links() }}
        </div>
    </div>
@endsection
