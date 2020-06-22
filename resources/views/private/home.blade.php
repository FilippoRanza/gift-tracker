@extends('private.user_base')

@section('body')
    <h1>{{ $user->name }}</h1>
    <hr>
    <ul>
        <li><a href="{{ route('list:show') }}">{{ __('nav_bar.user-list') }}</a></li>
        <li><a href="{{ route('list:guest') }}">{{ __('nav_bar.contribute-list') }}</a></li>
        <li><a href="{{ route('purchase:list') }}">{{ __('nav_bar.user-purchase') }}</a></li>
        <li><a href="{{ route('debt:list') }}">{{ __('nav_bar.user-debt') }}</a></li>
        <li><a href="{{ route('settings:index') }}">{{ __('nav_bar.user-settings') }}</a></li>
    </ul>

@endsection