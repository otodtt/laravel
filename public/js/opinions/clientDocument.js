$(document).ready(function(){
    $("#btn_archive").click(function(){
        $('.archive').addClass('hidden');
        $('.client').removeClass('hidden');
        $('.inspector').addClass('hidden');
        $('#bottom').css('margin-top', '70px');
    });

    $("#btn_client").click(function(){
        $('.client').addClass('hidden');
        $('.archive').removeClass('hidden');
        $('.inspector').removeClass('hidden');
        $('#bottom').css('margin-top', '0');
    });
});
