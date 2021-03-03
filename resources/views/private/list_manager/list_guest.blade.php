
    @if (!$list->poll)
        
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ __('list_guest.add-title') }}</h3>
                    <form  method="POST" class="input-group form-inline" action="{{ route('list:add_guest') }}">
                        @csrf
                        <input type="hidden" value="{{ $list->id }}" name="list">
                        <input type="text" id="guest-name" required="required" class="form-control" name="name" autofocus placeholder="{{ __('list_guest.input-name') }}">
                        <input type="submit" id="add-guest" class="btn btn-secondary mb-2 pl-2" value="{{ __('list_guest.submit') }}" >
                    </form>
                </div>
            </div>
          
        <br> 
    @endif
    
    
        <div class="card">
            <div class="card-body">
                <h4>{{ __('list_guest.current-title') }}</h4>
                <ul class="list-group">
                    @foreach ($guests as $guest)
                        <li class="list-group-item">
                            <div class="form-row">
                                <form method="POST" class="input-group " action="{{ route('list:remove_guest') }}">
                                    @csrf

                                    <input type="hidden" value="{{ $guest->id }}" name="guest">
                                    <input type="hidden" value="{{ $list->id }}" name="list">
                                    <div class="col">
                                        @if ($guest->profile_pic)
                                            <img src="{{ URL::to('/') }}/storage/{{ $guest->profile_pic }}" class="profile-pic">
                                        @endif
                                        <label for="delete"> {{ $guest->name }} </label>
                                    </div>
                                    <div class="col">
                                        @if ($list->poll)
                                            <input type="submit" id="delete" class="btn btn-danger " value="{{ __('list_guest.delete') }}" disabled>
                                        @else
                                            <input type="submit" id="delete" class="btn btn-danger " value="{{ __('list_guest.delete') }}">    
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
   

