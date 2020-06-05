@extends('private.user_base')

@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}"> 
<script>
    function update_price(url, form) {
        
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
            console.log('price update');
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
                    <script>
                        $('#price-form').on('submit', function() {
                            update_price('{{ route('item-settings:update-price') }}', '#price-form');
                            return false;
                        });
                    </script>
                    <hr>
                    <form>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <div class="form-inline">
                                <input type="hidden" value="{{ $item->id }}" name="item">
                                <input type="hidden" value="{{ $list->id }}" name="list">
                                <input class="form-control input" type="url" id="url" name="name" value="{{ $item->site }}">
                                <input type="submit" class="btn btn-primary">
                            </div>                        
                        </div>
                    </form>
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


@endsection