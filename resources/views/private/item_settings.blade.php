@extends('private.user_base')

@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}"> 
<script>
    function run_ajax(url, form, callback = undefined) {
        
        var data = $(form).serializeArray();
        var post_data = {'_token': $('meta[name=csrf-token]').attr('content')};
        var key;
        for(key in data) {
            var obj = data[key];
            post_data[obj['name']] = obj['value'];   
        }
        $.ajax({
            url: url,
            data: post_data,
            type: "post",
            dataType: "json",
        }).done(function (json) {
            console.log('ajax success');
            if(callback !== undefined) {
                callback(json);
            }
        });      
    }

</script>

    <h3>Item Settings</h3>
    <hr>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Item Info</h4>
                    <form>
                    
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="form-inline">
                                <input type="hidden" value="{{ $item->id }}" name="item">
                                <input type="hidden" value="{{ $list->id }}" name="list">
                                <input class="form-control input" type="text" id="name" name="name" value="{{ $item->name }}">
                                <input type="submit" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                    <hr>
                    <form id="price-form">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <div class="form-inline">
                                <input type="hidden" value="{{ $item->id }}" name="item">
                                <input class="form-control input" type="number" min="0.01" step="0.01" id="price" name="price" value="{{ $item->price / 100 }}">
                                <input type="submit" value="update price" class="btn btn-primary" >
                            </div> 
                        </div>
                    </form>

                    <hr>
                    <div class="form-group col-xs-6">
                        <form id="url-form">
                            <div class="">
                                <label for="url">URL</label>
                                <div class="form-inline">
                                    <input type="hidden" value="{{ $item->id }}" name="item">
                                    <input class="form-control input" type="url" id="url-field" name="url" value="{{ $item->site }}">
                                    <input type="submit" class="btn btn-primary">
                                </div>                        
                            </div>
                        </form>
                        <form 
                            @if (strlen($item->site) == 0)
                                hidden
                            @endif
                        id="remove-url-form" class="form-inline">
                            <input type="hidden" value="{{ $item->id }}" name="item">
                            <input type="submit" class="btn btn-danger">
                        </form>
                    </div>

            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Item Image</h4>
                @include('private.picture_upload', ['set_pic_url' => 'settings:set-profile-pic', 'del_pic_url' => 'settings:del-profile-pic', 'has_pic' => $item->picture  ])
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Delete</h4>
                <div class="form-inline">
                    <form method="POST" class="col" action="{{ route('list:remove_item') }}">
                        @csrf
                        <input type="hidden" value="{{ $item->id }}" name="item">
                        <input type="hidden" value="{{ $list->id }}" name="list">
                        <input type="submit" class="btn btn-danger form-control" value="Delete">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        
        $('#price-form').on('submit', function() {
            run_ajax('{{ route('item-settings:update-price') }}', '#price-form');
            return false;
        });
  
        $('#url-form').on('submit', function() {
            run_ajax('{{ route('item-settings:update-url') }}', '#url-form', function(json) {
                if(json['url']) {
                    $('#remove-url-form').removeAttr('hidden');
                    $('#remove-url-form').show();
                }
            });
            return false;
        });

        $('#remove-url-form').on('submit', function() {
            run_ajax('{{ route('item-settings:del-url') }}', '#remove-url-form', function (json) {
                
                if(!json['url']) {
                    $('#remove-url-form').hide();
                    $('#url-field').val('');
                }
            });
            return false;
        });


    </script>

@endsection