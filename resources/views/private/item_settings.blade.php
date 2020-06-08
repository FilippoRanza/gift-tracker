@extends('private.user_base')

@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}"> 
<script src="{{ URL::to('/') }}/static/scripts/run_ajax.js"></script>

    <h3>Item Info</h3>
    <h6><a class="btn btn-link" href="{{ route('list:manage', ['id' => $list->id]) }}">Back to {{ $list->name }}</a></h6>
    <hr>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Item Info</h4>
                    <form id="rename-form">
                    
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="form-inline">
                                <input type="hidden" value="{{ $item->id }}" name="item">
                                <input type="hidden" value="{{ $list->id }}" name="list">
                                <input class="form-control input" type="text" id="name-field" name="name" value="{{ $item->name }}">
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
                @include('private.picture_upload', ['set_pic_url' => 'item-settings:set-pic', 'del_pic_url' => 'item-settings:del-pic', 'has_pic' => $item->picture, 'id' => $item->id])
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
    

<div id="name-error" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Rename Error</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>It is not possible to rename "{{ $item->name }}" to "<span id="new-name"></span>", an item with this name already exists!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
</div>

<script>

    $('#rename-form').on('submit', function() {
        var new_name = $('#name-field').val();
        if(new_name != "{{ $item->name }}") {
            run_ajax("{{ route('item-settings:rename') }}", '#rename-form', function(json) {
                if(!json['rename']) {
                    $('#new-name').html(new_name);
                    $('#name-error').modal('show');
                    $('#name-field').val(json['name']);
                }
            });
        }
        return false;
    });

    
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