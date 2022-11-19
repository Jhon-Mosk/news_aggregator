@extends('layouts.app')

@section('title')
    @if (!$category->id)
        @parent Добавить категорию
    @else
        @parent Изменить категорию
    @endif
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>
                        @if (!$category->id)
                            Добавить категорию
                        @else
                            Изменить категорию
                        @endif
                    </h1>
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST"
                        action="@if (!$category->id) {{ route('admin.categories.store') }} @else {{ route('admin.categories.update', $category) }} @endif"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($category->id)
                            @method('PUT')
                        @endif
                        <div class="row mb-3">
                            <label for="inputNewsTitle" class="col-md-4 col-form-label text-md-end">Категория</label>

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" id="inputNewsTitle"
                                    value="{{ old('name') ?? $category->name }}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @if ($category->id)
                                        {{ __('Изменить') }}
                                    @else
                                        {{ __('Добавить') }}
                                    @endif
                                    категорию
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
