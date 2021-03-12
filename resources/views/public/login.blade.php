@extends('base')


@section('title', __('login.tab-name'))



@section('navbar')
  @include('public.public_navbar')
@endsection


@section('body')
    @if (isset($username_error))
        @include('error', ['message' =>  __("error_msg.login_username_error", ['username_error' => $username_error]) ])    
    @endif
    @if (isset($password_error))
        @include('error', ['message' =>  __("error_msg.login_password_error")])
    @endif

    <br>
    <br>
    <div class="container">
        <div class="form-group">
            <div class="card">
                <div class="card-body jumbotron-color">
                    <h2 class="main_title">Gift Tracker</h2>
                    <br>
                    <form method="POST" action="{{ route('login:action') }}">
                        @csrf
                        <input type="text" required="required" name="name" placeholder="{{ __('login.username') }}"  class="form-control" autofocus>
                        <br>
                        <input type="password" required="required" name="password"  class="form-control" placeholder="Password">
                        <br>
                        <input type="submit" class="btn btn-secondary text-center" value="{{ __('login.login') }}">
                    </form>


                    
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body jumbotron-color">
                    <p class="card-text text-center">
                    {{ __('login.register_tip') }} <a href="{{ route('register:page') }}">{{ __('login.register') }}</a>
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


