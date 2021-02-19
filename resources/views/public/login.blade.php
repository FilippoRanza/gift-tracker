@extends('base')


@section('title')
    login
@endsection



@section('navbar')
  @include('public.public_navbar')
@endsection


@section('body')

    @if (isset($login_error))
        @include('error', ['message' => 'Username or Password is INCORRECT!'])
    @endif
    <br>
    <br>
    <div class="container jumbotron-color">
        <div class="form-group">
            <div class="card">
                <div class="card-body">
                    <h2 class="main_title">Gift Tracker</h2>
                    <form method="POST" action="{{ route('login:action') }}">
                        @csrf
                        <input type="text" required="required" name="name" placeholder="Nome Utente"  class="form-control" autofocus>
                        <br>
                        <input type="password" required="required" name="password"  class="form-control" placeholder="Password">
                        <br>
                        <input type="submit" class="btn btn-primary">
                    </form>


                    
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <p class="card-text text-center">
                        Non hai ancora un account? <a href="{{ route('register:page') }}">Registrati</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
