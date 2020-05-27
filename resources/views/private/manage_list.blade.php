@extends('private.user_base')


@section('body')
    <h3>{{ $list->name }} - {{ $user->name }}</h3>

    @if (isset($item_err))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h2>ERROR</h2>
        <h4>The Item {{ $item_err }} has already been inserted into the list {{ $list->name }}</h4>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <div>
        @if (isset($user_err))
            <h3>Error</h3>
            <p>User {{ $user_err }} is not present</p>
        @elseif(isset($guest_err))
            <h3>Error</h3>
            <p>User {{ $guest_err }} has already been added to {{ $list->name }}</p>
        @endif
        
    </div>

    <ul class="nav nav-tabs" role="tablist" >
        <li class="nav-item"><a class="nav-link" id="item-link" onclick="set_current('item', 'item-link');" data-toggle="tab" href="#item">List's Items</a></li>
        <li class="nav-item"><a class="nav-link" id="guest-link" onclick="set_current('guest', 'guest-link');" data-toggle="tab" href="#guest">List's Guests</a></li>

        @if (isset($guest_only_handle))
            <li class="nav-item"><a class="nav-link" id="settings-link" onclick="set_current('settings', 'settings-link');" data-toggle="tab"  href="#settings">Settings</a></li>    
        @endif
    </ul>
    <br>

    <div class="container md-3">
    <div class="tab-content">
        <div class="tab-pane fade show" id="item" role="tabpanel" aria-labelledby="item-tab">
            @if (!$list->poll)
                <div class="container">
                    <div class="card">
                        <div class="input-group">
                            <div class="card-body">
                                <h4 class="card-title">Add new Item</h4>
                                <div class="form-group col">
                                    <form  method="POST" action="{{ route('list:add_item') }}">
                                        @csrf
                                        <input type="hidden" value="{{ $list->id }}" name="list">
                                        <label class="col-form-label" for="name">Name</label>
                                        <input type="text"  class="form-control" name="name" id="name" placeholder="Name" autofocus>
                                        <label class="col-form-label" for="price">Price</label>
                                        <input type="number" class="form-control" step="0.01" id="price" name="price" placeholder="€">
                                        <button class="btn btn-primary form-control" type="submit">Add Item</button>        
                                    </form>
                                </div>
                            </div>    
                        </div>  
                    </div>
                </div>     
                <br>
            @endif
            
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Current Items</h5>
                        <ul class="list-group">
                            @foreach ($items as $item)
                                <li class="list-group-item">
                                    <div class="card" style="border:0px">
                                        <div class="card-body">
                                            <h3 class="card-title">{{ $item->name }}</h3>
                                            <h6 class="card-title">Price € {{ $item->price / 100 }}</h6>
                                            <div class="input-group">
                                                @if ($list->poll)
                                                    <form method="POST" class="form-row" action="{{ route('vote:vote') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $item->id }}" name="item">
                                                        <input type="hidden" value="{{ $list->id }}" name="list">
                                                        @if ($voted)
                                                            <input type="submit" class="btn btn-success form-control" value="Vote" disabled>    
                                                        @else
                                                            <input type="submit" class="btn btn-success form-control" value="Vote">
                                                        @endif
                                                    
                                                    </form>
                                                @else
                                                    <div  class="form-row">
                                                        <form method="POST" class="col" action="{{ route('purchase:make') }}">
                                                            @csrf
                                                            <input type="hidden" value="{{ $item->id }}" name="item">
                                                            <input type="hidden" value="{{ $list->id }}" name="list">
                                                            @if ($guest_only)
                                                                <input type="submit" class="btn btn-primary form-control" value="Select" disabled>
                                                            @else
                                                                <input type="submit" class="btn btn-primary form-control" value="Select">
                                                            @endif
                                                        </form>
                                                    
                                                        <form method="POST" class="col" action="{{ route('list:remove_item') }}">
                                                            @csrf
                                                            <input type="hidden" value="{{ $item->id }}" name="item">
                                                            <input type="hidden" value="{{ $list->id }}" name="list">
                                                            <input type="submit" class="btn btn-danger form-control" value="Delete">
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
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
        </div>
        <div class="tab-pane fade show" id="guest" role="tabpanel" aria-labelledby="guest-tab">
            <div class="container mb-3">
                @if (!$list->poll)
                    <div class="container mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add new Guest</h4>
                                <form method="POST" class="input-group form-inline" action="{{ route('list:add_guest') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $list->id }}" name="list">
                                    <input type="text" class="form-control" name="name" autofocus placeholder="Name">
                                    <input type="submit" class="btn btn-primary mb-2" class="form-control">
                                </form>
                            </div>
                        </div>
                    </div>   
                    <br> 
                @endif
                
                <div class="container mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Current Guests</h5>
                            <ul class="list-group">
                                @foreach ($guests as $guest)
                                    <li class="list-group-item">
                                        <div class="form-row">
                                            <form method="POST" class="input-group " action="{{ route('list:remove_guest') }}">
                                                @csrf

                                                <input type="hidden" value="{{ $guest->id }}" name="guest">
                                                <input type="hidden" value="{{ $list->id }}" name="list">
                                                <div class="col">
                                                    <label for="delete"> {{ $guest->name }} </label>
                                                </div>
                                                <div class="col">
                                                    @if ($list->poll)
                                                        <input type="submit" id="delete" class="btn btn-danger " value="Delete" disabled>
                                                    @else
                                                        <input type="submit" id="delete" class="btn btn-danger " value="Delete">    
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        <div class="tab-pane fade show" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            <div>
                <form method="POST" action="{{ route('list:guest_only') }}">
                    @csrf
                    <input type="hidden" value="{{ $list->id }}" name="list">
                    @if ($guest_only_handle)
                        <input type="checkbox" onchange="this.form.submit()" checked data-toggle="toggle">
                    @else    
                        <input type="checkbox" onchange="this.form.submit()" data-toggle="toggle">
                    @endif
                </form>
            </div>
            <div>
                <form method="POST" action="{{ route('vote:toggle_mode') }}">
                    @csrf
                    <input type="hidden" value="{{ $list->id }}" name="list">
                    @if ($list->poll)
                        <input type="checkbox" onchange="this.form.submit()" checked data-toggle="toggle">
                    @else    
                        <input type="checkbox" onchange="this.form.submit()" data-toggle="toggle">
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
        </div>
    </div>
</div>
    <script>
        $(document).ready(function() {
            reset_previous('item', 'item-link');
        });
    </script>
@endsection

