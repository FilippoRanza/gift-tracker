@extends('private.user_base')


@section('body')
<link rel="stylesheet"
 href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.7/cropper.min.css" 
 integrity="sha256-9iqCwke6hMRwyDUjlyNZGSdx8qdTJ3wDvGyUXgSbjLM=" 
 crossorigin="anonymous" />

 <script 
 src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.7/cropper.min.js"
 integrity="sha256-p97rePKMNdYElfBI0h7nQ4t9EHGWTXFortV0HPWubEY="
 crossorigin="anonymous"></script>

<script src="{{ URL::to('/') }}/static/scripts/profile_pic_util.js"></script>

<h2>Settings</h2>
<hr>
@includeWhen(isset($error), 'error', ['message' => 'The old password is incorrect, check again'])
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Set Profile Picture</h4>    
            <div class="input-group">
                <form id="image-form" method="POST" enctype="multipart/form-data" action="{{ route('settings:set-profile-pic') }}">
                    @csrf
                    <span id="image-preview">

                    </span>
                    <br>
                    <span id="image-select-container">
                        <input id="image-select" type="file" accept="image/*"   onchange="toogle_image_selector(event)">
                    </span>
                    <input type="hidden" id="upload-data" name="image">
                    <input type="button" onclick="post();" value="Set Profile Picture" class="btn btn-primary form-control">
                </form>

                <div class="modal" id="image-selector" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <span id="preview-container">
                                    <img id="preview" class="img-preview">
                                </span>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" onclick="remove_image();" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" onclick="get_cropped_image();">Save changes</button>
                        </div>
                      </div>
                    </div>
                </div>
                <script>
                    $("#image-selector").on('hidden.bs.modal', function(event) {
                        var preview = document.getElementById('preview-container');
                        preview.innerHTML = prev;
                    });
                </script>
            </div>
            @if ($user->profile_pic)
            <hr>
            <form method="POST" action="{{ route('settings:del-profile-pic') }}">
                @csrf
                <input type="submit" class="btn btn-danger" value="Remove Profile Picture">
            </form>
        @endif
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Reset Password</h4>
            <div class="input-group">
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


@endsection