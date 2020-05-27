

function set_current(tab, link) {
    console.log("set cookie");
    var url = window.location.pathname;
    Cookies.set(url.concat('prev-tab'), tab, {sameSite: 'strict', path: url});
    Cookies.set(url.concat('prev-link'), link, {sameSite: 'strict', path: url});
}

function activate(tab, link) {
    var tab = document.getElementById(tab);
    tab.classList.add('active');

    var link = document.getElementById(link);
    link.classList.add('active');
}

function reset_previous(def_tab, def_link) {
    var url = window.location.pathname;
    var prev_tab = Cookies.get(url.concat('prev-tab'));
    var prev_link = Cookies.get(url.concat('prev-link'));
    if(prev_tab !== undefined && prev_link !== undefined) {
        activate(prev_tab, prev_link);
    } else {
        activate(def_tab, def_link);
    }
    console.log('call');
}



