@extends('base')

@section('title')
  Home - {{ $user->name }}
@endsection

@section('foot')
  <a href="{{ route('logout') }}">logout</a>  
@endsection