@extends('private.user_base')


@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}"> 
<script src="{{ URL::to('/') }}/static/scripts/run_ajax.js"></script>

<h2>Settings</h2>
<hr>
@includeWhen(isset($error), 'error', ['message' => 'The old password is incorrect, check again'])
<div class="container">
    <div class="card">
        
        <div class="card-body">
            <h4 class="card-title">Set Profile Picture</h4>  
            @include('private.picture_upload', ['set_pic_url' => 'settings:set-profile-pic', 'del_pic_url' => 'settings:del-profile-pic', 'has_pic' => $user->profile_pic, 'update_id' => 'profile-pic-navbar', 'target' => 'Profile'])
        </div>
    </div>
    <br>
    <div class="card">
        <div class="col-sm-1">
        </div>
        <div class="card-body">
            <h4 class="card-title">Reset Password</h4>
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-6">
                    <form method="POST" action="{{ route('settings:reset') }}">
                        @csrf
                        <input class="form-control" required="required" type="password" placeholder="old password" name="old">
                        <br>
                        @include('input_new_password')
                        <input type="submit" class="btn btn-primary form-control" value="Reset Password">
                    </form>
                </div>    
            </div>
        </div>
    </div>

</div>




@endsection