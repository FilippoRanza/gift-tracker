@extends('private.user_base')

@section('body')
    <h1>{{ $user->name }}</h1>
    <hr>
    <ul>
        <li>
            <h5><a href="{{ route('list:show') }}">{{ __('nav_bar.user-list') }} </a> </h5>
            <p> {{ __('info.list-info')  }} </p>
        </li>
        <li>
            <h5><a href="{{ route('list:guest') }}">{{ __('nav_bar.contribute-list') }} </a> </h5>
            <p> {{ __('info.contribute-info')  }} </p>
        </li>
        <li>
            <h5><a href="{{ route('purchase:list') }}">{{ __('nav_bar.user-purchase') }} </a> </h5>
            <p> {{ __('info.purchase-info')  }} </p>
        </li>
        <li>
            <h5><a href="{{ route('debt:list') }}">{{ __('nav_bar.user-debt') }} </a> </h5>
            <p> {{ __('info.debt-info')  }} </p>
        </li>
        <li>
            <h5><a href="{{ route('settings:index') }}">{{ __('nav_bar.user-settings') }} </a> </h5>
            <p> {{ __('info.settings')  }} </p>
        </li>
    </ul>

@endsection