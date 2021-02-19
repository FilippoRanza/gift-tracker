@extends('private.user_base')


@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}"> 
<script src="{{ URL::to('/') }}/static/scripts/run_ajax.js"></script>

<h2>{{ __('settings.title') }}</h2>
<hr>
@includeWhen(isset($error), 'error', ['message' => __('settings.error-msg')])
<div class="container">
    <div class="card">
        
        <div class="card-body jumbotron-color">
            <h4 class="card-title">{{ __('settings.set-pic') }}</h4>  
            @include('private.picture_upload', ['set_pic_url' => 'settings:set-profile-pic', 'del_pic_url' => 'settings:del-profile-pic', 'has_pic' => $user->profile_pic, 'update_id' => 'profile-pic-navbar', 'target' => 'Profile'])
        </div>
    </div>
    <br>
    <div class="card">
        <div class="col-sm-1">
        </div>
        <div class="card-body jumbotron-color">
            <h4 class="card-title">{{ __('settings.reset-password') }}</h4>
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-6">
                    <form method="POST" action="{{ route('settings:reset') }}">
                        @csrf
                        <input class="form-control" required="required" type="password" placeholder="{{ __('settings.old-password') }}" name="old">
                        <br>
                        @include('input_new_password')
                        <input type="submit" class="btn btn-primary form-control" value="{{ __('settings.reset-password') }}">
                    </form>
                </div>    
            </div>
        </div>
    </div>

    <br>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.6/css/flag-icon.min.css" />
    <div class="card">
        <div class="col-sm-1">
        </div>
        <div class="card-body jumbotron-color">
            <h4 class="card-title">{{ __('settings.set-locale') }}</h4>
            <div class="col-sm-1">
            </div>
            <div class="col-sm-6">
                <form onchange="submit();" action="{{ route('locale:set') }}" method="POST">
                    @csrf
                    <div id="locale-selection"></div>   
                </form>
            </div>
        </div>
    </div>

</div>
<script>
    $.get("{{ route('locale:list') }}", function (json) {
        var curr = json['current'];
        if(!curr) {
            curr = json['default'];
            console.log(curr);
        }
        var avail = json['locales'];
        avail.forEach(element => {
            var checked = element == curr ? 'checked' : '';
            var html = `<div class="form-check"><input class="form-check-input" ${checked} name="locale" type="radio" value="${element}" id="radio-${element}"><label for="radio-${element}">${element}</label></div>`;
            $('#locale-selection').append(html);
        });
    });
</script>



@endsection