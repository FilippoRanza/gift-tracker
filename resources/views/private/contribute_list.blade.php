@extends('private.user_base')

@section('title', 'Contribute List')


@section('body')
    @if ($active_list)
        <h1>{{ __('contribute_list.active-title') }}</h1>
        <hr>

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
                                    <li>{{ __('contribute_list.owner') }}: {{ $list->owner }} </li>
                                </ul>
                            </div>
                            <div class="col-sm-3">
                                <form method="POST" action="{{ route('list:unsubscribe') }}" >
                                    @csrf
                                    <input type="hidden" value="{{ $list->id }}" name="list"> 
                                    @if ($list->poll)
                                        <input type="submit" class="btn btn-warning form-control" value="{{ __('contribute_list.unsubscribe') }}" disabled>
                                    @else
                                        <input type="submit" class="btn btn-warning form-control" value="{{ __('contribute_list.unsubscribe') }}">    
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
        <h2>{{ __('contribute_list.archived-title') }}</h2>
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
                                    <li>{{ __('contribute_list.owner') }}: {{ $list->owner }} </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                
                </li>
            @endforeach
        </ul>
    @endif
@endsection
