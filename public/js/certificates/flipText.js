$(document).ready(function() {
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
        $('.fit_in_low').css({ "height": '25px',});
        while ($('.fit_p').height() > $('.fit_in_low').height()) {
            $('.fit_p').css('font-size', (parseInt($('.fit_p').css('font-size')) - 0.1) + "px");
        }
    })
});