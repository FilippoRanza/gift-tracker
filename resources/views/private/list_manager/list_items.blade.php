@if (!$list->poll)
    
        <div class="card">
            <div class="input-group">
                <div class="card-body">
                    
                    <h3 class="card-title">{{ __('list_items.add-title') }}</h3>
                    <p class="small text-secondary">{{ __('list_items.info') }}</p>
                    <div class="form-group col">
                        <form  method="POST" action="{{ route('list:add_item') }}">
                            @csrf
                            <input type="hidden" value="{{ $list->id }}" name="list">
                            <label class="col-form-label" for="name">{{ __('list_items.name') }}</label>
                            <input  type="text" id="name"  required="required" class="form-control" name="name" id="name" placeholder="{{ __('list_items.name') }}" autofocus>
                            <label class="col-form-label" for="price">{{ __('list_items.price') }}</label>
                            <input type="number" id="price" min="0.01" required="required" class="form-control" step="0.01" id="price" name="price" placeholder="€">
                            <br>
                            <button class="btn btn-secondary" id="add-item"  type="submit">{{ __('list_items.add-item') }}</button>        
                        </form>
                    </div>
                </div>    
            </div>  
        </div>
        
    <br>
@endif



    @if ($list->ready && $list->poll)
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('purchase:automatic') }}">
                    @csrf
                    <input type="hidden" value="{{ $list->id }}" name="list">
                    <input type="submit" class="btn btn-success" value="{{ __('list_items.automatic', ['name' => $win_name]) }}">
                </form>
            </div>
        </div>
        <br>
    @endif
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('list_items.current-title') }}</h4>
            <p class="small text-secondary">{{ __('list_items.purchase_info') }}</p>
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
                                <h6 class="card-title">{{ __('list_items.price') }} € {{ $item->price / 100 }}</h6>
                                <div class="input-group">
                                    @if ($list->poll)
                                        <form method="POST" class="form-row" action="{{ route('vote:vote') }}">
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="item">
                                            <input type="hidden" value="{{ $list->id }}" name="list">
                                            @if ($voted)
                                                <input type="submit" class="btn btn-success " value="{{ __('list_items.vote') }}" disabled>    
                                            @else
                                                <input type="submit" class="btn btn-success " value="{{ __('list_items.vote') }}">
                                            @endif
                                        
                                        </form>
                                    @else
                                        <div  class="form-row">
                                            <form method="POST" class="col" action="{{ route('purchase:make') }}">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="item">
                                                <input type="hidden" value="{{ $list->id }}" name="list">
                                                @if ($guest_only)
                                                    <input type="submit" class="btn btn-success " value="{{ __('list_items.select') }}" disabled>
                                                @else
                                                    <input type="submit" class="btn btn-success " value="{{ __('list_items.select') }}">
                                                @endif
                                            </form>
                                            
                                            <form class="col" method="POST" action="{{ route('item-settings:index') }}" >
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="item">
                                                <input type="hidden" value="{{ $list->id }}" name="list">
                                                <input type="submit" class="btn btn-secondary" value="{{ __('list_items.modify') }}">
                                            </form>
                                            @if ($item->site)
                                                <div class="col">
                                                    <a class="btn btn-success form-control" href={{ $item->site }}>{{ __('list_items.web') }}</a>
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

