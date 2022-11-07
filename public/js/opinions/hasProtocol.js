/**
 * Created by DelT on 23.10.2016 г..
 */
$('input[name="has_protocol"]').on('click', function(){
    if($('input[name=has_protocol]:checked').val() == 1){
        $( "#protocol_show" ).removeClass( "hidden" );
        $( "#hr_last" ).removeClass( "hidden" );
    }
    else if($('input[name=has_protocol]:checked').val() == 2){
        $( "#protocol_show" ).addClass( "hidden" );
        $( "#hr_last" ).addClass( "hidden" );

        $("#inspectors_protocol").val(0);
        $('input[name=number_protocol]').val('');
        $('input[name=date_protocol]').val('');
    }
    else{
        $( "#protocol_show" ).addClass( "hidden" );
        $( "#hr_last" ).addClass( "hidden" );
    }
});

if ($("input[name='has_protocol']").is(':checked')) {
    if($('input[name=has_protocol]:checked').val() == 1){
        $( "#protocol_show" ).removeClass( "hidden" );
        $( "#hr_last" ).removeClass( "hidden" );
    }
    else if($('input[name=has_protocol]:checked').val() == 2){
        $( "#protocol_show" ).addClass( "hidden" );
        $( "#hr_last" ).addClass( "hidden" );

        $("#inspectors_protocol").val(0);
        $('input[name=number_protocol]').val('');
        $('input[name=date_protocol]').val('');
    }
    else{
        $( "#protocol_show" ).addClass( "hidden" );
        $( "#hr_last" ).addClass( "hidden" );
    }
}
else {
    $( "#protocol_show" ).addClass( "hidden" );
    $( "#hr_last" ).addClass( "hidden" );
}