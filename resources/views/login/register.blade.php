@extends('base')

@section('title', 'register')

@section('body')
    @includeWhen(isset($password_error), 'error', ['message' => "Password and Confirm Field don't match"])
    @if (isset($username_error))
        @include('error', ['message' => "$username_error has already been taken, try with a new one"])    
    @endif
    

    <br>    
    <br>
    <div class="container">
        <div class="form-group">
            <div class="card">
                <div class="card-body">
                    <h2 class="main_title">Gift Tracker</h2>
                    <form method="POST" action="{{ route('register:action') }}">
                        @csrf
                        <input type="text"  required="required" class="form-control" name="name" placeholder="user name">
                        <br>
                        <input type="email" required="required" name="email"  class="form-control input" placeholder="email">
                        <br>
                        @include('input_new_password')
                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <p class="card-text  text-center">
                        Have an account? <a href="{{ route('login') }}">Log in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>


@endsection