@extends('base')

@section('title')
  Home - {{ $user->name }}
@endsection

@section('navbar')
    @include('private.nav_bar')
@endsection


