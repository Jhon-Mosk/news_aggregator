@extends('layouts.app')

@section('title')
    @parent Админка
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <h1>Админка</h1>
@endsection
