@push('head')
    <script src="{{ asset('js/components/pizza.js')}}"></script>
@endpush

@extends('layouts.app')

@section('content')
    <main-page-component></main-page-component>
@endsection
