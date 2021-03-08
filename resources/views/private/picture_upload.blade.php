<span>
    <link rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.7/cropper.min.css" 
     integrity="sha256-9iqCwke6hMRwyDUjlyNZGSdx8qdTJ3wDvGyUXgSbjLM=" 
     crossorigin="anonymous" />
                
    <script 
     src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.7/cropper.min.js"
     integrity="sha256-p97rePKMNdYElfBI0h7nQ4t9EHGWTXFortV0HPWubEY="
     crossorigin="anonymous"></script>
                
    <script src="{{ URL::to('/') }}/static/scripts/profile_pic_util.js"></script>
    <style>
        .custom-file-input ~ .custom-file-label::after {
            content: "{{ __('picture_upload.select_label')}}";
        }
    </style>

    <div class="row">
        <div class="col-sm-6 offset-sm-2">
            <form id="image-form">
                @csrf
                <span id="old-picture" class="preview-pic">
                    @if ($has_pic)
                    <img class="preview-pic img-thumbnail rounded" src="{{ URL::to('/') }}/storage/{{ $has_pic }}">
                    @endif
                </span>
                
                <span  id="image-preview"></span>
                <br>
                <span id="image-select-container">
                    <div class="custom-file" id="image-select">
                        <input id="image-select" class="custom-file-input"  type="file" accept="image/*" onchange="toogle_image_selector(event)" aria-describedby="fileHelp">
                        <label class="custom-file-label" for="image-select">{{ __('picture_upload.browse') }}</label>
                    </div>
                    
                </span>
                @if (isset($id))
                    <input type="hidden" id="hidden-id" name="id" value="{{ $id }}">
                @endif
                <input type="hidden" id="upload-data" name="image">
                <br>
                <br>
                <input type="submit"  value="{{ __('picture_upload.select', ['target' => $target]) }}" class="btn form-control btn-secondary">
            </form>
        </div>
    </div> 
    <div 
        @if (!$has_pic)
            hidden
        @endif
        id="delete-div"
    >
        <hr>
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-6">
                <form id="delete-picture">
                    @csrf

                    @if (isset($id))
                        <input type="hidden" id="hidden-id" name="id" value="{{ $id }}">
                    @endif
                    <input type="submit" class="btn btn-danger form-control" value="{{ __('picture_upload.remove', ['target' => $target]) }}">
                </form>    
            </div>
        </div>
    </div> 


    <div class="modal" id="image-selector" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('picture_upload.adjust') }}</h5>
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
              <button type="button" class="btn btn-secondary" onclick="remove_image();" data-dismiss="modal">{{ __('picture_upload.close') }}</button>
              <button type="button" class="btn btn-secondary" onclick="get_cropped_image();">{{ __('picture_upload.save') }}</button>
            </div>
          </div>
        </div>
    </div>
    <script>
        $("#image-selector").on('hidden.bs.modal', function(event) {
            var preview = document.getElementById('preview-container');
            preview.innerHTML = prev;
        });
        @if(isset($update_id))
        var update = "#{{ $update_id }}";
        @else
        var update = undefined;
        @endif

        $('#image-form').on('submit', function() {
            
            if (setup_post()){
                run_ajax("{{ route($set_pic_url) }}", "#image-form", function(json) {
                   if(json['update']) {
                       $('#delete-div').removeAttr('hidden');
                       $('#delete-div').show();
                       if(update !== undefined) {
                            $(update).attr('src', `{{ URL::to('/') }}/storage/${json['picture']}`);
                       }
                   }
                });
            }
            return false;
        });

        $('#delete-div').on('submit', function() {
            run_ajax("{{ route($del_pic_url) }}", "#delete-div", function(json) {
                if(json['update']) {
                    $('#delete-div').hide();
                }
            })
            return false;
        });


    </script> 
</span>