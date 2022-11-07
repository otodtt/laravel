$(function() {
    var p_address = $( "#p_address" ).height();

    if(p_address > 30){
        $( "#address_1" ).addClass( "hidden" );
        $( "#address_2" ).removeClass( "hidden" );

    }
})

$(function() {
    var p_address2 = $( "#p_address2" ).height();

    if(p_address2 > 60){
        $( "#address_1" ).addClass( "hidden" );
        $( "#address_2" ).addClass( "hidden" );
        $( "#address_3" ).removeClass( "hidden" );
    }
})