$(function () {

    $('[data-toggle="tooltip"]').tooltip();

    $(".alert").fadeTo(2000, 500).slideUp(500, function () {
        $(".alert").slideUp(500);
    });

    //select2
    $('.select2').select2();
});

// Alert Message Using Ajax
function alertMessage(selector, message_status, message_data) {
    message = "<div class='alert alert-sm alert-" + message_status + " alert-ajax'>"
        + "<button type='button' class='close' data-dismiss='alert'>×</button>"
        + message_data + " </div>";
    $(selector).html(message);
    $(".alert").fadeTo(2000, 500).slideUp(500, function () {
        $(".alert").slideUp(500);
    });
}

function display_ct6() {
    var x = new Date()
    var ampm = x.getHours() >= 12 ? ' PM' : ' AM';
    hours = x.getHours() % 12;
    hours = hours ? hours : 12;
    var x1 = x.getMonth() + 1 + "-" + x.getDate() + "-" + x.getFullYear();
    x1 = "Date:" + x1 + " |   Time:" + hours + ":" + x.getMinutes() + ":" + x.getSeconds() + ":" + ampm;
    document.getElementById('ct6').innerHTML = x1;
    display_c6();
}
function display_c6() {
    var refresh = 1000; // Refresh rate in milli seconds
    mytime = setTimeout('display_ct6()', refresh)
}
display_c6()
