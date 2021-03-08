
class SelectedNames {

    constructor(names) {
        this.names = {};
        this.count = names.length;
        var count = 0;
        for(const elem of names) {
            console.log(elem);
            this.names[elem] = {id: count++, used: true}
        }
    }

    initAutocomplete(list) {
        for(const [key, value] of Object.entries(this.names)) {
            var html = `<li><button class="dropdown-item" id="autocomplete-${value.id}" onclick="selectUser('${key}')" type="button">${key}</button></li>`;
            list.append(html);
        }
    }

    updateAutocomplete(names) {
        this.updateNames(names);
        this.removeEntriesFromList();
    }

    updateNames(names) {
        
        for(const [key, value] of Object.entries(this.names)) {
            value.used = false;
        }
        this.count = names.length;
        for(const elem of names) {
            this.names[elem].used = true;
        }
    }

    removeEntriesFromList() {
        for(const [key, value] of Object.entries(this.names)) {
            if(!value.used) {
                var elem_id = `#autocomplete-${value.id}`;
                $(elem_id).remove();
                delete this.names[key];
            }
        }
    }


}

var selected_names = null;

$('#guest-name').on('input', function() {
    var new_name = $('#guest-name').val();
    var list_id = $('#list-id').val();
    var post_data =  {
        'current' : new_name,
        'list_id': list_id,
        '_token': $('meta[name=csrf-token]').attr('content')
    };
    var url = $('meta[name=autocomplete-url]').attr('content');
    $.ajax({
        url: url,
        data: post_data,
        type: "post",
        dataType: "json",
    }).done(function (json) {
        var names = json['names'];
        var drop_down = $('#dropdown-menu');

        if(selected_names === null) {
            selected_names = new SelectedNames(names);
            selected_names.initAutocomplete(drop_down);
        } else {
            selected_names.updateAutocomplete(names);
        }
        console.log(selected_names.count);
        var hidden = selected_names.count == 0;
        console.log("Hidden", hidden);
        $("#dropdown-menu").attr("hidden", hidden);
        if(selected_names.count == 0) {
            selected_names = null;
        }

    });       
});

function selectUser(name) {
    $('#guest-name').val(name);
}

