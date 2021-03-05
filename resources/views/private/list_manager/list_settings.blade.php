
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ __('list_settings.title') }}</h3>
            <div class="form-group">
                <div class="form-row">
                    <form method="POST" class="input-group" action="{{ route('list:guest_only') }}">
                        @csrf
                        <input type="hidden" value="{{ $list->id }}" name="list">
                        <div class="col">
                            <label class="col-form-label" for="guest-only">{{ __('list_settings.guest-only') }}</label>
                        </div>
                        <div class="col">
                            @if ($guest_only_handle)
                                <input type="checkbox"  id="guest-only" onchange="this.form.submit()" checked data-toggle="toggle">
                            @else    
                                <input type="checkbox"  id="guest-only" onchange="this.form.submit()" data-toggle="toggle">
                            @endif
                        </div>
                        
                    </form>                
                    <br>
                    <p class="small text-secondary">{{ __("list_description.guest-only-description") }}<br>{{ __("list_settings.mode-use-message") }}</p>
                           
                    
                    <form method="POST" class="input-group" action="{{ route('vote:toggle_mode') }}">
                        @csrf
                        <input type="hidden" value="{{ $list->id }}" name="list">
                        <div class="col">
                            <label class="col-form-label" for="toggle-vote">{{ __('list_settings.poll') }}</label>
                        </div>
                        <div class="col">
                            @if ($list->poll)
                                <input type="checkbox" id="toggle-vote" onchange="this.form.submit()" checked data-toggle="toggle">
                            @else    
                                <input type="checkbox" id="toggle-vote" onchange="this.form.submit()" data-toggle="toggle">
                            @endif
                        </div>
                       
                    </form>
                    <br>
                    <p class="small text-secondary">{{ __("list_description.poll-mode-description") }}<br>{{ __("list_settings.mode-use-message") }}</p>

                    @if ($list->poll)
                        
                            <form class="input-group" action="{{ route('vote:clear') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $list->id }}" name="list">
                                <div class="col">
                                    <input type="submit" class="btn btn-warning" value="{{ __('list_settings.clear-votes') }}">
                                </div>
                            </form>
                 
                    @endif  
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                {{ __('list_settings.recipient') }}
            </h4>
            <p class="small text-secondary">Se questa lista è per un regalo, qui puoi impostare il nome della persona a cui fare il regalo</p>
            <div class="input-group">
                <div class="form-inline">
                    <form method="POST"  action="{{ route('list:recipient') }}">
                        @csrf
                        <input type="hidden" value="{{ $list->id }}" name="list">    
                        <input type="text" id="set-recipient" required="required" class="form-control" placeholder="Nome" value="{{ $recipient }}" name="recipient">
                    
                        @if ($recipient)
                            <button class="btn btn-secondary " id="add-recipient" >{{ __('list_settings.update') }}</button> 
                        @else
                            <button class="btn btn-secondary " id="add-recipient">{{ __('list_settings.set') }}</button> 
                        @endif
                    </form>
                    @if($recipient)
                        <form method="POST"  action="{{ route('list:recipient_delete') }}">
                            @csrf
                            <input type="hidden" value="{{ $list->id }}" name="list">
                            
                                <button class="btn btn-danger ">{{ __('list_settings.delete') }}</button>
                            
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
