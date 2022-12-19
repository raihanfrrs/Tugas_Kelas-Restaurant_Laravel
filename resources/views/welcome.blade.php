@extends('layouts.main')

@section('section')
    @auth
        @if (auth()->user()->level === 'administrator')
            @include('administrator.dashboard')
        @elseif (auth()->user()->level === 'cashier')
            @include('cashier.dashboard')
        @elseif (auth()->user()->level === 'kitchen')
            @include('kitchen.dashboard')
        @endif
    @endauth
@endsection