@extends('private.user_base')

@section('body')
    <h1>Benvenuto: {{ $user->name }}</h1>
    <hr>
    <p class="small text-secondary">Questa è la home di Gift Traker. Da qui puoi avere accesso e controllare tutto quello che ti serve per i tuoi acquisti</p>

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
