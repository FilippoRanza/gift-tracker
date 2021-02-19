@extends('base')

@section('title', 'register')


@section('navbar')
  @include('public.public_navbar')
@endsection


@section('body')
    @includeWhen(isset($password_error), 'error', ['message' => "Il campo `password` ed il campo `conferma password` sono diversi: devono corrispondere"])
    @if (isset($username_error))
        @include('error', ['message' => "Il nome utente: `$username_error` è già stato registrato. Sceglierne uno differente"])    
    @endif
    
    @if (isset($email_error))
        @include('error', ['message' => "L'indirizzo : `$email_error` è già registrato. Utilizzare un altro indirizzo"])    
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
                        Hai già un account? <a href="{{ route('login:page') }}">Accedi</a>
    
                    </p>
                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-body jumbotron-color">
                    <p class="card-text  text-center">
                        Non sai cosa fare? <a href="{{ route('login') }}">Torna alla Home</a>
                    </p>
                </div>
            </div>
        </div>
    </div>


@endsection