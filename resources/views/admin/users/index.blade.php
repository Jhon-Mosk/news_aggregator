@extends('layouts.app')

@section('title')
    @parent Пользователи
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <h1>Существующие пользователи</h1>
    <div class="list-group">
        @forelse ($users as $user)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <h4 class="">
                    {{ $user->name }}
                    @if ($user->is_admin)
                        <sup class="text-info">Администратор</sup>
                    @endif
                </h4>

                <div class="d-flex">
                    <form action="{{ route('admin.users.update', $user) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn">
                            @if ($user->is_admin)
                                Разжаловать
                            @else
                                Назначить админом
                            @endif
                        </button>
                    </form>

                    <form action="{{ route('admin.users.destroy', $user) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Удалить</button>
                    </form>
                </div>

            </li>
        @empty
            <p>Нет пользователей</p>
        @endforelse
    </div>
@endsection
