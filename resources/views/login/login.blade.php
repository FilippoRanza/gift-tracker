@extends('base')


@section('title')
    login
@endsection


@section('body')

    @if (isset($login_error))
        <div class="alert alert-warning  alert-dismissible fade show" role="alert">
            <h3>Username or Password is INCORRECT!</h3>
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
