@extends('private.user_base')

@section('title', 'Contribute List')


@section('body')
    <h2>My Active Contribute List</h2>
    <ul>
        @foreach ($active_list as $list)
            <li><a href="{{ route('list:manage', ['id' => $list->id]) }}">
                {{ $list->name }}</a> - {{ $list->owner }} 
                <form method="POST" action="{{ route('list:unsubscribe') }}" >
                    @csrf
                    <input type="hidden" value="{{ $list->id }}" name="list"> 
                    @if ($list->poll)
                        <input type="submit" value="Delete" disabled>
                    @else
                        <input type="submit" value="Delete">    
                    @endif
                </form>
            </li>
        @endforeach
    </ul>

    <h2>My Archived Contribute List</h2>
    <ul>
        @foreach ($archived_list as $list)
            <li><a href="{{ route('list:old', ['id' => $list->id]) }}">
                {{ $list->name }}</a> - {{ $list->owner }} 
            </li>
        @endforeach
    </ul>

@endsection
