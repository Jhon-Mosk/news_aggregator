@extends('layouts.app')

@section('title')
    @parent Добавить новость
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Добавить новость</h1>
                </div>

                <div class="card-body">
                    <form class="needs-validation" method="POST" action="{{ route('admin.createNews') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="inputNewsTitle" class="col-md-4 col-form-label text-md-end">Заголовок</label>

                            <div class="col-md-6">
                                <input type="text" name="title" class="form-control" id="inputNewsTitle"
                                    value="{{ old('title') }}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNewsCategory" class="col-md-4 col-form-label text-md-end">Категория</label>

                            <div class="col-md-6">
                                <select name="category_id" class="form-select" id="inputNewsCategory" required>
                                    @forelse ($categories as $category)
                                        <option @if ($category['id'] == old('category_id')) selected @endif
                                            value="{{ $category['id'] }}">
                                            {{ $category['name'] }}</option>
                                    @empty
                                        <p>Категории осутствуют</p>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNewsText" class="col-md-4 col-form-label text-md-end">Текст</label>
                            <div class="col-md-6">
                                <textarea name="text" class="form-control" id="inputNewsText" rows="3" required>{{ old('text') }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputLoadImage" class="col-md-4 col-form-label text-md-end">Загрузить
                                изображение</label>
                            <div class="col-md-6">
                                <input type="file" accept="image/png, image/jpeg, image/webp" name="image"
                                    class="form-control" id="inputLoadImage" rows="3">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 form-check-label text-md-end" for="inputNewsIsPrivate">Приватная</label>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input @if (old('isPrivate')) checked @endif name="isPrivate"
                                        class="form-check-input" type="checkbox" role="switch" id="inputNewsIsPrivate"
                                        value="1">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Добавить
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
