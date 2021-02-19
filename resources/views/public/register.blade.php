@extends('base')

@section('title', 'register')


@section('navbar')
  @include('public.public_navbar')
@endsection


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
                <div class="card-body jumbotron-color">
                    <h2 class="main_title">Gift Tracker</h2>
                    <form method="POST" action="{{ route('register:action') }}">
                        @csrf
                        <input type="text"  required="required" class="form-control" name="name" placeholder="Nome Utente">
                        <br>
                        <input type="email" required="required" name="email"  class="form-control input" placeholder="Email">
                        <br>
                        @include('input_new_password')
                        <input type="submit" class="btn btn-secondary" value="Registrati">
                    </form>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body jumbotron-color">
                    <p class="card-text  text-center">
                        Hai già un account? <a href="{{ route('login') }}">Accedi</a>
                    </p>
                </div>
            </div>
        </div>
    </div>


@endsection