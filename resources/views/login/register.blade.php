@extends('base')

@section('title', 'register')

@section('body')

    @if (isset($password_error))
        <h3>Password and Confirm Field don't match</h3>
    @endif

    @if (isset($username_error))
        <h3>{{ $username_error }} has already been taken, try with a new one</h3>
    @endif


    <form method="POST" action="{{ route('register:action') }}">
        @csrf
        <input type="text" name="name" placeholder="user name">
        <br>
        <input type="email" name="email" placeholder="email">
        <br>
        <input type="password" name="password" placeholder="password">
        <br>
        <input type="password" name="confirm" placeholder="confirm password">
        <br>
        <input type="submit">
    </form>
@endsection