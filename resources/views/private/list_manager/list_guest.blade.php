
    @if (!$list->poll)
        
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ __('list_guest.add-title') }} ffff</h3>
                    <form  method="POST" class="input-group form-inline" action="{{ route('list:add_guest') }}">
                        @csrf
                        <input type="hidden" id="list-id" value="{{ $list->id }}" name="list">
                        <input type="text" autocomplete="off" id="guest-name" required="required" class="autocomplete form-control" data-toggle="dropdown"  name="name" autofocus placeholder="{{ __('list_guest.input-name') }}">
                        <ul class="dropdown-menu" id="dropdown-menu" role="menu">
                        </ul>
                        <input type="submit" id="add-guest" class="btn btn-secondary mb-2 pl-2" value="{{ __('list_guest.submit') }}" >
                    </form>
                </div>
            </div>
          
        <br> 
    @endif
    
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
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
   

<script>
    $('#guest-name').on('input', function() {
            $('#dropdown-menu').empty();
            var new_name = $('#guest-name').val();
            var list_id = $('#list-id').val();
            var post_data =  {
                'current' : new_name,
                'list_id': list_id,
                '_token': $('meta[name=csrf-token]').attr('content')
            };
            console.log(post_data);
            var url = "{{ route('list:list-users') }}";
            $.ajax({
                url: url,
                data: post_data,
                type: "post",
                dataType: "json",
            }).done(function (json) {
                var names = json['names'];
                var drop_down = $('#dropdown-menu');
                names.forEach(function(elem) {
                    drop_down.append(`<li><button class="dropdown-item" onclick="selectUser('${elem}')" type="button">${elem}</button></li>`)
                });
            });       
    });
    function selectUser(name) {
        $('#guest-name').val(name);
    }


</script>