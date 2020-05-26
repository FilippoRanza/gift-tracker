@extends('private.user_base')

@section('body')
    <h1>{{ $user->name }}</h1>
    <hr>
    <ul>
        <li><a href="{{ route('list:show') }}">My Lists</a></li>
        <li><a href="{{ route('list:guest') }}">Contribute List</a></li>
        <li><a href="{{ route('purchase:list') }}">My Purchases</a></li>
        <li><a href="{{ route('debt:list') }}">My Debts</a></li>
    </ul>

@endsection