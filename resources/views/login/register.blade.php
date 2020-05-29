@extends('base')

@section('title', 'register')

@section('body')

    @if (isset($password_error))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h3>Password and Confirm Field don't match</h3>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    @endif

    @if (isset($username_error))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h3>{{ $username_error }} has already been taken, try with a new one</h3>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
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
                        <input type="text" required="required" class="form-control" name="name" placeholder="user name">
                        <br>
                        <input type="email" required="required" name="email"  class="form-control" placeholder="email">
                        <br>
                        <input type="password" required="required" name="password" class="form-control" placeholder="password">
                        <br>
                        <input type="password" required="required" name="confirm" class="form-control"  placeholder="confirm password">
                        <br>
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