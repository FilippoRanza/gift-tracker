
function remove_head(name) {
    var index = name.indexOf(' ');
    var end = name.length;
    return name.substring(index + 1, end);
}


function add_locale(url, tag_id, callback=null) {
    
    console.log('call');
    $.get(url, function (json) {
        var curr = json['current'];
        if(!curr) {
            curr = json['default'];
            console.log(curr);
        }
        var avail = json['locales'];
        var name_long = json['locales-long'];
        
        avail.forEach(element => {
            var checked = element == curr ? 'checked' : '';
            var name = name_long[element];
            if((element == curr) && callback) {
                var locale_flag = remove_head(name);
                callback(locale_flag);
            }
            var html = `<div class="form-check"><input class="form-check-input" ${checked} name="locale" type="radio" value="${element}" id="radio-${element}"><label for="radio-${element}">${name}</label></div>`;
            $(tag_id).append(html);
        });
    });
}
