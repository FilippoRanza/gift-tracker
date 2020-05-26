@extends('private.user_base')

@section('body')
    <h2>{{ $list->name }} - {{ $data->owner }}</h2>
    <h4>Archived List</h4>
    <hr>

    <p>
        Purchase done by {{  $data->buyer }} {{ $data->date->diffForHumans() }}
    </p>
    
    <p>
        Object: {{ $data->name }} - € {{  $data->price / 100 }}
    </p>
    <p>Paricipants</p>
    <ul>
        @foreach ($data->guests as $guest)
            <li>{{ $guest }}</li>
        @endforeach
    </ul>

@endsection

