function run_ajax(url, form, callback = undefined) {
    var tick_name = 'div-tick';
    console.log(tick_name);
    var tick_div = document.getElementById(tick_name);
    console.log(tick_div);
    if(tick_div !== null) {
        return;
    }
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
        $(form).find('.form-inline').append(`<div class="ml-3" id=${tick_name}>✔️</div>`);
    });      
}