@extends('layouts.app')

@section('title')
    @if (!$source->id)
        @parent Добавить источник
    @else
        @parent Изменить источник
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
                        @if (!$source->id)
                            Добавить источник
                        @else
                            Изменить источник
                        @endif
                    </h1>
                </div>
                <div class="card-body">
                    <form class="needs-validation" method="POST"
                        action="@if (!$source->id) {{ route('admin.news_sources.store') }} @else {{ route('admin.news_sources.update', $source) }} @endif"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($source->id)
                            @method('PUT')
                        @endif
                        <div class="row mb-3">
                            <label for="inputNewsTitle" class="col-md-4 col-form-label text-md-end">Источник</label>
                            <div class="col-md-6">
                                <input type="text" name="link"
                                    class="form-control @error('link') is-invalid @enderror" id="inputNewsTitle"
                                    value="{{ old('link') ?? $source->link }}" required autofocus>
                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @if ($source->id)
                                        {{ __('Изменить') }}
                                    @else
                                        {{ __('Добавить') }}
                                    @endif
                                    источник
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
