@extends('private.user_base')


@section('body')
<h2>Settings</h2>
<hr>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Set Profile Picture</h4>    
            <div class="">
                <form method="POST" enctype="multipart/form-data" action="{{ route('settings:set-profile-pic') }}">
                    @csrf
                    <input type="file" accept="image/*" name="image"  onchange="load_file(event)">
                        <div class="text-center">
                            <img id="preview" class="img-preview">
                        </div>
                    <script>
                      function load_file(event) {
                        var output = document.getElementById('preview');
                        output.classList.add("rounded");
                        output.classList.add("img-thumbnail");
                        output.src = URL.createObjectURL(event.target.files[0]);
                      };
                    </script>
                    <input type="submit" class="btn btn-primary form-control">
                </form>
                <hr>
                <form method="POST" action="{{ route('settings:del-profile-pic') }}">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Remove Profile Picture">
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Reset Password</h4>    
        </div>
    </div>

</div>


@endsection