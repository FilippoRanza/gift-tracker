@extends('base')

@section('title', '__('login.tab-register-name')')


@section('navbar')
  @include('public.public_navbar')
@endsection


@section('body')
    @includeWhen(isset($password_error), 'error', ['message' =>  __("error_msg.register_password_match_error") ])
    @if (isset($username_error))
        @include('error', ['message' =>  __("error_msg.register_username_error", ['username_error' => $username_error]) ])    
    @endif
    
    @if (isset($email_error))
        @include('error', ['message' =>  __("error_msg.register_email_error", ['email_error' => $email_error]) ])    
    @endif


    <br>    
    <br>
    <div class="container">
        <div class="form-group">
            <div class="card">
                <div class="card-body jumbotron-color">
                    <h2 class="main_title">Gift Tracker</h2>
                    <br>
                    <form method="POST" action="{{ route('register:action') }}">
                        @csrf
                        <input type="text"  required="required" class="form-control" name="name" placeholder="{{ __('login.username') }}">
                        <br>
                        <input type="email" required="required" name="email"  class="form-control input" placeholder="Email">
                        <br>
                        @include('input_new_password')
                        <input type="submit" class="btn btn-secondary" value="{{ __('login.register') }}">
                    </form>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body jumbotron-color">
                    <p class="card-text  text-center">
                    {{ __('login.login_tip') }} <a href="{{ route('login:page') }}">{{ __('login.login') }}</a>
    
                    </p>
                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-body jumbotron-color">
                    <p class="card-text  text-center">
                    {{ __('login.info') }} <a href="{{ route('login') }}">{{ __('login.go_home') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>


@endsection