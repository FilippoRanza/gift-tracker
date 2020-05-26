@extends('base')


@section('title')
    login
@endsection


@section('body')

    @if (isset($login_error))
        <h3>Username or Password is INCORRECT!</h3>
    @endif

    <form method="POST" action="{{ route('login:action') }}">
        @csrf
        <input type="text" name="name" placeholder="user name" autofocus>
        <br>
        <input type="password" name="password" placeholder="password">
        <br>
        <input type="submit">
    </form>
    <a href="{{ route('register:page') }}">Register</a>
@endsection
