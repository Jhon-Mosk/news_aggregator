@extends('layouts.app')

@section('title')
    @parent Админка
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h2>Ajax test</h2>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <button data-id="1" class="send">Send request</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let buttons = document.querySelectorAll('.send');
        buttons.forEach(element => {
            element.addEventListener('click', () => {
                let id = element.getAttribute('data-id');
                (
                    async () => {
                        const response = await fetch('/admin/ajax', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json;charset=utf-8',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        });

                        const answer = await response.json();
                        console.log('answer :>> ', answer);
                    }
                )();
            })
        });
    </script>
@endsection
