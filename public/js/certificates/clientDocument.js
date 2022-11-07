$(document).ready(function(){
    $("#btn_archive").click(function(){
        var flip_all = $( "#flip_all" );
        $('.archive').addClass('hidden');
        $('.client').removeClass('hidden');
        $('.inspector').addClass('hidden');
        //$( "#flip_all" ).removeClass( "frame_archive" ));
        flip_all.removeClass( "frame_archive" ).addClass( "frame_client" );
        //$( "#bg-image" ).removeClass( "hidden" );

        var div_margin = $('.div_margin');
        div_margin.css('margin-bottom', '50px');

        while (flip_all.height() < $('#flip_in').height()) {
            div_margin.css('margin-bottom', (parseInt(div_margin.css('margin-bottom')) - 1) + "px");
        }
    });

    $("#btn_client").click(function(){
        var flip_all = $( "#flip_all" );
        $('.client').addClass('hidden');
        $('.archive').removeClass('hidden');
        $('.inspector').removeClass('hidden');
        flip_all.addClass( "frame_archive" ).removeClass( "frame_client" );
        //$( "#flip_all" ).addClass( "frame_archive" );
        //$( "#bg-image" ).addClass( "hidden" );

        var div_margin = $('.div_margin');
        div_margin.css('margin-bottom', '50px');


        while (flip_all.height() < $('#flip_in').height()) {
            div_margin.css('margin-bottom', (parseInt(div_margin.css('margin-bottom')) - 1) + "px");
        }
    });
});
var new_width = $('#span_director').width();
$('#director_name').css({ "margin-left": new_width,});
