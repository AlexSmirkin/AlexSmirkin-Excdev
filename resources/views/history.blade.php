@push('head')
    <script src="{{ asset('js/components/pizza.js')}}"></script>
@endpush

@extends('layouts.app')

@section('content')
    <history-page-component></history-page-component>
@endsection
