$(document).ready(function(){
    $("#btn_archive").click(function(){
        $('.archive').addClass('hidden');
        $('.client').removeClass('hidden');
        $('.inspector').addClass('hidden');
    });

    $("#btn_client").click(function(){
        $('.client').addClass('hidden');
        $('.archive').removeClass('hidden');
        $('.inspector').removeClass('hidden');
    });
});
