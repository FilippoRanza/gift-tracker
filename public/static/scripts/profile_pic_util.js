
var crop = undefined;
var prev = undefined;
function load_file(event) {
    var preview = document.getElementById('preview');
    preview.classList.add("rounded");
    preview.classList.add("img-thumbnail");
    preview.src = URL.createObjectURL(event.target.files[0]);
}


function toogle_image_selector(event) {
    var preview = document.getElementById('preview');
    
    preview.classList.add("rounded");
    preview.classList.add("img-thumbnail");
    preview.src = URL.createObjectURL(event.target.files[0]);
    crop = new  Cropper(preview, {aspectRatio: 1/1});

    $('#image-selector').modal('show');

    var preview = document.getElementById('preview-container');
    prev = preview.innerHTML;
}

function get_cropped_image() {
    var canvas = crop.getCroppedCanvas();
    canvas.classList.add('img-thumbnail');
    canvas.classList.add('preview-pic');
    var preview = document.getElementById('image-preview');
    if(preview.hasChildNodes()) {
        preview.removeChild(preview.childNodes[0]);
    }
    $('#old-picture').hide();
    preview.appendChild(canvas); 

    $('#image-selector').modal('hide');
    var preview = document.getElementById('preview-container');
    preview.innerHTML = prev;
}

function remove_image() {
    var preview = document.getElementById('preview-container');
    preview.innerHTML = prev;

    var container = document.getElementById('image-select-container');
    var txt = container.innerHTML;
    container.innerHTML = txt;

    console.log('remove');
}

function setup_post() {
    var preview = document.getElementById('image-preview');
    if(preview.hasChildNodes()) {
        var canvas = preview.childNodes[0];
        var data = canvas.toDataURL('image/png');
        var input  = document.getElementById('upload-data');
        input.value = data;
        stat = true;
    } else {
        stat = false;
    }
    return stat;
}




