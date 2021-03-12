@extends('private.user_base')
@section('title', 'Gift Tracker')
@section('body')
    <h1>{{ __('info.welcome') }}{{ $user->name }}</h1>
    <hr>
    <p class="small text-secondary">{{ __('info.info') }}</p>

     <div class="container">
       <div class="card">
            <div class="card-body">
                <h3 class="card-title"><a href="{{ route('list:show') }}">{{ __('nav_bar.user-list') }} </a></h3>
                <p class="small text-secondary"> {{ __('info.list-info')  }} </p>
            </div>
        </div>        

        <div class="card">
            <div class="card-body">
                <h3 class="card-title"><a href="{{ route('list:guest') }}">{{ __('nav_bar.contribute-list') }} </a></h3>
                <p class="small text-secondary"> {{ __('info.contribute-info')  }} </p>
            </div>
        </div>    

        <div class="card">
            <div class="card-body">
                <h3 class="card-title"><a href="{{ route('purchase:list') }}">{{ __('nav_bar.user-purchase') }} </a></h3>
                <p class="small text-secondary"> {{ __('info.purchase-info')  }} </p>
            </div>
        </div>    

        <div class="card">
            <div class="card-body">
                <h3 class="card-title"><a href="{{ route('debt:list') }}">{{ __('nav_bar.user-debt') }} </a></h3>
                <p class="small text-secondary"> {{ __('info.debt-info')  }} </p>
            </div>
        </div>    

        <div class="card">
            <div class="card-body">
                <h3 class="card-title"><a href="{{ route('settings:index') }}">{{ __('nav_bar.user-settings') }} </a></h3>
                <p class="small text-secondary"> {{ __('info.settings')  }} </p>
            </div>
        </div>  

    </div> 

@endsection
