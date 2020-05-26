@extends('private.user_base')

@section('body')
<h2>My Gift Lists</h2>
    @if (isset($error))
        <div>
            <h1>ERROR</h1>
            <p>List {{ $error }} already exists!</p>
        </div>
    @endif
    <div>
        <h3>Make New List</h3>
        <form method="POST" action="{{ route('list:new') }}">
            @csrf
            <input type="text" placeholder="name" name="name">
            <label for="guest_only">Guest Only</label> 
            <input type="checkbox" id="guest_only" name="guest_only">
            <input type="submit">
        </form>
    </div>
    <hr>
    <div>
        <h3>Lists</h3>
        <ul>
            @foreach ($user_lists as $list)
                <li><a href="{{ route('list:manage', ['id' => $list->id]) }}">{{ $list->name }}</a>
                    <form method="POST" action="{{ route('list:delete') }}">
                        @csrf
                        <input type="hidden" value="{{ $list->id }}" name="list">
                        <input type="submit" value="Delete">
                    </form>
                </li>
            @endforeach
        </ul>
        <h3>Old Lists</h3>
        <ul>
            @foreach ($old_lists as $list)
                <li>
                    <a href="{{ route('list:old', ['id' => $list->id]) }}">
                        {{ $list->name }} 
                        @if ($list->duplicated)
                        - {{ $list->updated_at->diffForHumans() }}    
                        @endif
                        
                    </a>
                </li>

            @endforeach
        </ul>
    </div>

@endsection