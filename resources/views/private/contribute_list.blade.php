@extends('private.user_base')

@section('title', 'Contribute List')


@section('body')
    @if ($active_list)
        <h2>My Active Contribute List</h2>
        <ul class="list-group">
            @foreach ($active_list as $list)
                <li class="list-group-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>
                                    <a href="{{ route('list:manage', ['id' => $list->id]) }}">
                                        {{ $list->name }}
                                    </a>
                                </h4>
                                <ul>
                                    <li>Owner: {{ $list->owner }} </li>
                                </ul>
                            </div>
                            <div class="col-sm-3">
                                <form method="POST" action="{{ route('list:unsubscribe') }}" >
                                    @csrf
                                    <input type="hidden" value="{{ $list->id }}" name="list"> 
                                    @if ($list->poll)
                                        <input type="submit" class="btn btn-warning form-control" value="Unsubscribe" disabled>
                                    @else
                                        <input type="submit" class="btn btn-warning form-control" value="Unsubscribe">    
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
    @if ($archived_list)    
        <h2>My Archived Contribute List</h2>
        <ul class="list-group">
            @foreach ($archived_list as $list)
                <li class="list-group-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>
                                    <a href="{{ route('list:old', ['id' => $list->id]) }}">
                                        {{ $list->name }}
                                    </a>
                                </h4>
                                <ul>
                                    <li>Owner: {{ $list->owner }} </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                
                </li>
            @endforeach
        </ul>
    @endif
@endsection
