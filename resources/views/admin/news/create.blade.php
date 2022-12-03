@extends('layouts.app')

@section('title')
    @if (!$news->id)
        @parent Добавить новость
    @else
        @parent Изменить новость
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
                    @if (!$news->id)
                        <h1>Добавить новость</h1>
                    @else
                        <h1>Изменить новость</h1>
                    @endif

                </div>

                <div class="card-body">
                    <form class="needs-validation" method="POST"
                        action="@if (!$news->id) {{ route('admin.news.store') }} @else {{ route('admin.news.update', $news) }} @endif"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($news->id)
                            @method('PUT')
                        @endif
                        <div class="row mb-3">
                            <label for="inputNewsTitle" class="col-md-4 col-form-label text-md-end">Заголовок</label>

                            <div class="col-md-6">
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror" id="inputNewsTitle"
                                    value="{{ old('title') ?? $news->title }}" required autofocus />
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNewsCategory" class="col-md-4 col-form-label text-md-end">Категория</label>
                            <div class="col-md-6">
                                <select name="category_id" class="form-select" id="inputNewsCategory" required>
                                    @forelse ($categories as $category)
                                        <option @if ($category->id == old('category_id') || $category->id == $news->category_id) selected @endif
                                            value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @empty
                                        <p>Категории осутствуют</p>
                                    @endforelse
                                    @if ($errors->has('category_id'))
                                        <div class="form-text text-danger">
                                            @foreach ($errors->get('category_id') as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNewsText" class="col-md-4 col-form-label text-md-end">Текст</label>
                            <div class="col-md-6">
                                <textarea name="text" class="form-control @error('text') is-invalid @enderror" id="inputNewsText" rows="3"
                                    required>{!! old('text') ?? $news->text !!}</textarea>
                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputLoadImage" class="col-md-4 col-form-label text-md-end">Загрузить
                                изображение</label>
                            <div class="col-md-6">
                                <input type="file" accept="image/png, image/jpeg, image/webp" name="image"
                                    class="form-control @error('image') is-invalid @enderror" id="inputLoadImage"
                                    rows="3" />
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 form-check-label text-md-end" for="inputNewsIsPrivate">Приватная</label>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input @if (old('isPrivate') || $news->isPrivate) checked @endif name="isPrivate"
                                        class="form-check-input" type="checkbox" role="switch" id="inputNewsIsPrivate"
                                        value="1" />
                                    @if ($errors->has('isPrivate'))
                                        <div class="form-text text-danger">
                                            @foreach ($errors->get('isPrivate') as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @if ($news->id)
                                        {{ __('Изменить') }}
                                    @else
                                        {{ __('Добавить') }}
                                    @endif
                                    новость
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
