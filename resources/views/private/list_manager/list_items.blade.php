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
                            <input  type="text" id="name"  required="required" class="form-control" name="name" id="name" placeholder="Name" autofocus>
                            <label class="col-form-label" for="price">Price</label>
                            <input type="number" id="price" min="0.01" required="required" class="form-control" step="0.01" id="price" name="price" placeholder="€">
                            <button class="btn btn-primary form-control" id="add-item"  type="submit">Add Item</button>        
                        </form>
                    </div>
                </div>    
            </div>  
        </div>
    </div>     
    <br>
@endif


<div class="container">
    @if ($list->ready && $list->poll)
        <div>
            <form method="POST" action="{{ route('purchase:automatic') }}">
                @csrf
                <input type="hidden" value="{{ $list->id }}" name="list">
                <input type="submit" class="btn btn-success" value="Make Automatic Purchase">
            </form>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Current Items</h5>
            <ul class="list-group">
                @foreach ($items as $item)
                    <li class="list-group-item">
                        <div class="card" style="border:0px">
                            <div class="card-body">
                                <h3 class="card-title">
                                    @if ($item->picture)
                                        <img src="{{ URL::to('/') }}/storage/{{ $item->picture }}" class="profile-pic">
                                    @endif
                                    {{ $item->name }}</h3>
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
                                            
                                            <form class="col" method="POST" action="{{ route('item-settings:index') }}" >
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="item">
                                                <input type="hidden" value="{{ $list->id }}" name="list">
                                                <input type="submit" class="btn btn-secondary form-control" value="Modify">
                                            </form>
                                            @if ($item->site)
                                                <div class="col">
                                                    <a class="btn btn-success form-control" href={{ $item->site }}>web</a>
                                                </div>
                                            @endif
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
