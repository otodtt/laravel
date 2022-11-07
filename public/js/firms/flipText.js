$(function() {
    $('#fitin div').css('font-size', '1em');

    while ($('#fitin div').height() > $('#fitin').height()) {
        $('#fitin div').css('font-size', (parseInt($('#fitin div').css('font-size')) - 0.1) + "px");
    }
})
$(function() {
    $('#fitin_bottom div').css('font-size', '1em');

    while ($('#fitin_bottom div').height() > $('#fitin_bottom').height()) {
        $('#fitin_bottom div').css('font-size', (parseInt($('#fitin_bottom div').css('font-size')) - 0.1) + "px");
    }
})

$(function() {
    $('.div_margin').css('margin-bottom', '40px');

    while ($('#flip_all').height() < $('#flip_in').height()) {
        $('.div_margin').css('margin-bottom', (parseInt($('.div_margin').css('margin-bottom')) - 1) + "px");
    }
})
