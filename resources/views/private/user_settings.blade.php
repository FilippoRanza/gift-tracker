@extends('private.user_base')


@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}"> 
<script src="{{ URL::to('/') }}/static/scripts/run_ajax.js"></script>

<h1>{{ __('settings.title') }}</h1>
<hr>
@includeWhen(isset($error), 'error', ['message' => __('settings.error-msg')])
@includeWhen(isset($success), 'private.password-change-success', ['message' => __('settings.success-password')])
<div class="container ">
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
        <div class="card-body  jumbotron-color">
            <h4 class="card-title">{{ __('settings.reset-password') }}</h4>
            <div class="row">
                <div class="col-sm-6 offset-sm-2">
                    <form method="POST" action="{{ route('settings:reset') }}">
                        @csrf
                        <input class="form-control" required="required" type="password" placeholder="{{ __('settings.old-password') }}" name="old">
                        <br>
                        @include('input_new_password')
                        <input type="submit" class="btn btn-secondary form-control" value="{{ __('settings.reset-password') }}">
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
            <div class="col-sm-6 offset-sm-2">
                <form onchange="submit();" action="{{ route('locale:set') }}" method="POST">
                    @csrf
                    <div id="locale-selection"></div>   
                </form>
            </div>
        </div>
    </div>

</div>

<script> 
    add_locale("{{ route('locale:list') }}", '#locale-selection');
</script>



@endsection