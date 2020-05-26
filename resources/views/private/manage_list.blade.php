@extends('private.user_base')


@section('body')
    <h3>{{ $list->name }} - {{ $user->name }}</h3>

    <div>
        @if (isset($item_err))
            <h2>ERROR</h2>
            <h4>The Item {{ $item_err }} has already been inserted into the list {{ $list->name }}</h4>
        @endif
        @if (isset($guest_only_handle))
            <div>
                <form method="POST" action="{{ route('list:guest_only') }}">
                    @csrf
                    @if ($guest_only_handle)
                        <input type="hidden" value="{{ $list->id }}" name="list">
                        <input type="submit" value="Guest Only: On">
                    @else    
                        <input type="hidden" value="{{ $list->id }}" name="list">
                        <input type="submit" value="Guest Only: Off">
                    @endif
                </form>
            </div>
            <div>
                <form method="POST" action="{{ route('vote:toggle_mode') }}">
                    @csrf
                    <input type="hidden" value="{{ $list->id }}" name="list">
                    @if ($list->poll)
                        <input type="submit" value="Poll: On">
                    @else
                        <input type="submit" value="Poll: Off"> 
                    @endif
                </form>
            </div>
            <div>
                <form method="POST" action="{{ route('list:recipient') }}">
                    @csrf
                    <input type="hidden" value="{{ $list->id }}" name="list">
                    <input type="text" value="{{ $recipient }}" name="recipient">
                    @if ($recipient)
                        <input type="submit" value="Update">                        
                    @else
                        <input type="submit" value="Set">
                    @endif
                </form>
                @if($recipient)
                    <form method="POST" action="{{ route('list:recipient_delete') }}">
                        @csrf
                        <input type="hidden" value="{{ $list->id }}" name="list">
                        <input type="submit" value="Delete">
                    </form>
                @endif
                @if ($list->poll)
                    <div>
                        <form action="{{ route('vote:clear') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $list->id }}" name="list">
                            <input type="submit" value="Clear Votes">
                        </form>
                    </div>
                @endif
            </div>
        @endif
        @if (!$list->poll)
            <div>
                <h4>Add new Item</h4>
                <form method="POST" action="{{ route('list:add_item') }}">
                    @csrf
                    <input type="hidden" value="{{ $list->id }}" name="list">
                    <input type="text"  name="name" placeholder="Name" autofocus>
                    <input type="number" step="0.01" name="price" placeholder="€">
                    <input type="submit">
                </form>
            </div>    
        @endif
        
        <h5>Current Items</h5>
        <ul>
        
            @foreach ($items as $item)
                <li>{{ $item->name }} - € {{ $item->price / 100 }}
                    @if ($list->poll)
                        <form method="POST" action="{{ route('vote:vote') }}">
                            @csrf
                            <input type="hidden" value="{{ $item->id }}" name="item">
                            <input type="hidden" value="{{ $list->id }}" name="list">
                            @if ($voted)
                                <input type="submit" value="Vote" disabled>    
                            @else
                                <input type="submit" value="Vote">
                            @endif
                            
                        </form>
                    @else
                        <form method="POST" action="{{ route('purchase:make') }}">
                            @csrf
                            <input type="hidden" value="{{ $item->id }}" name="item">
                            <input type="hidden" value="{{ $list->id }}" name="list">
                            @if ($guest_only)
                                <input type="submit" value="Select" disabled>
                            @else
                                <input type="submit" value="Select">
                            @endif
                        </form>
                                            
                        <form method="POST" action="{{ route('list:remove_item') }}">
                            @csrf
                            <input type="hidden" value="{{ $item->id }}" name="item">
                            <input type="hidden" value="{{ $list->id }}" name="list">
                            <input type="submit" value="Delete">
                        </form>
                    @endif


                    
                
                </li>
            @endforeach
        </ul>
    </div>
    @if ($list->ready && $list->poll)
        <div>
            <form method="POST" action="{{ route('purchase:automatic') }}">
                @csrf
                <input type="hidden" value="{{ $list->id }}" name="list">
                <input type="submit" value="Make Automatic Purchase">
            </form>
        </div>
    @endif

    <div>
        <div>
            @if (isset($user_err))
                <h3>Error</h3>
                <p>User {{ $user_err }} is not present</p>
            @elseif(isset($guest_err))
                <h3>Error</h3>
                <p>User {{ $guest_err }} has already been added to {{ $list->name }}</p>
            @endif
            
        </div>

        @if (!$list->poll)
            <div>
                <h4>Add new Guest</h4>
                <form method="POST" action="{{ route('list:add_guest') }}">
                    @csrf
                    <input type="hidden" value="{{ $list->id }}" name="list">
                    <input type="text"  name="name" placeholder="Name">
                    <input type="submit">
                </form>
            </div>    
        @endif
        
        <h5>Current Guests</h5>
        <ul>
            @foreach ($guests as $guest)
                <li>{{ $guest->name }}
                    <form method="POST" action="{{ route('list:remove_guest') }}">
                        @csrf
                        <input type="hidden" value="{{ $guest->id }}" name="guest">
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
    </div>


@endsection

