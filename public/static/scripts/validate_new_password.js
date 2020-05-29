
/*
    elements name are hard coded
    it seems ok in JS
*/

var pass_item = "password-field";
var bar_item = "progress";
var confirm_item = "confirm-field";

 
function password_strength(password){
    test = [
        (password.length >= 6),
        (password.search(/[A-Z]/) > -1),
        (password.search(/[a-z]/) > -1),
        (password.search(/[0-9]/) > -1),
        (password.search(/[_\(\)&%$£!]/) > -1)
    ];
    pass = test.reduce((acc, curr) => acc + curr);
    return pass;
}

function show_progress(strength) {
    console.log(strength);
    for(i = 1; i <= 5; i++) {
        var box = document.getElementById(`box-${i}`);        
    
        if(i > strength) {
            box.classList.remove('enable-block');
        } else {
            box.classList.add('enable-block');
        }
    }
}

function check_strength() {
    var pass = document.getElementById(pass_item);
    var strength = password_strength(pass.value);
    show_progress(strength);
} 

function check_password() {
    check_strength();
    compare_password();
}

function compare_password() {
    var pass = document.getElementById(pass_item);
    var confirm = document.getElementById(confirm_item);
    console.log('call');
    if(pass.value == confirm.value) {
        confirm.setCustomValidity("");
    } else if (confirm.value) {
        confirm.setCustomValidity("password don't match");
    }
}
