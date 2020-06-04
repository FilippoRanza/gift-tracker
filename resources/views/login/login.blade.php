@extends('base')


@section('title')
    login
@endsection


@section('body')

    @if (isset($login_error))
        @include('error', ['message' => 'Username or Password is INCORRECT!'])
    @endif
    <br>
    <br>
    <div class="container">
        <div class="form-group">
            <div class="card">
                <div class="card-body">
                    <h2 class="main_title">Gift Tracker</h2>
                    <form method="POST" action="{{ route('login:action') }}">
                        @csrf
                        <input type="text" required="required" name="name" placeholder="user name"  class="form-control" autofocus>
                        <br>
                        <input type="password" required="required" name="password"  class="form-control" placeholder="password">
                        <br>
                        <input type="submit" class="btn btn-primary">
                    </form>


                    
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <p class="card-text text-center">
                        Don't have an account? <a href="{{ route('register:page') }}">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
