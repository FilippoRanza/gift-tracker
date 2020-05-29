
function password_strength(password){
    test = [
        (password.length >= 6),
        (password.search(/[A-Z]/) > -1),
        (password.search(/[a-z]/) > -1),
        (password.search(/[0-9]/) > -1),
        (password.search(/[_\(\)&%$£!]/) > -1)
    ];
    pass = test.reduce((acc, curr) => acc + curr);
    return (pass / test.length) * 100;
}

function check_strength(pass_item, bar_item) {
    var pass = document.getElementById(pass_item);
    var strength = password_strength(pass.value);
    var bar = document.getElementById(bar_item);
    bar.setAttribute('style', `width: ${strength}%`);
} 

function check_password(pass_item, bar_item, confirm_item) {
    check_strength(pass_item, bar_item);
    compare_password(pass_item, confirm_item);
}

function compare_password(pass_item, confirm_item) {
    var pass = document.getElementById(pass_item);
    var confirm = document.getElementById(confirm_item);
    console.log('call');
    if(pass.value == confirm.value) {
        confirm.setCustomValidity("");
    } else if (confirm.value) {
        confirm.setCustomValidity("password don't match");
    }
}
