@push('head')
    <script src="{{ asset('js/components/pizza.js')}}"></script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Main page') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <span>Баланс: {{ $balance }}</span>
                        {{ var_dump($lastOperations) }}

                        <table border="1">
                            <caption></caption>
                            @foreach($lastOperations as $result)
                                <tr>
                                    @foreach($result as $value)
                                        <th>{{ $value }}</th>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>

                            <br>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h1>Лог активности</h1>
                                        <example-component></example-component>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
