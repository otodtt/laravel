

/**
 * За Тора
 */
$('input[name="protocol"]').on('click', function(){
    if($('input[name=protocol]:checked').val() == 0){
        $( "#protocol_check" ).addClass( "hidden" );
    }
    else if($('input[name=protocol]:checked').val() == 1){
        $( "#protocol_check" ).removeClass( "hidden" );
        //$( "#prz_check" ).addClass( "hidden" );
        //$('input[name=assay_prz]').prop('checked', false);
    }
    else{
        $( "#protocol_check" ).addClass( "hidden" );
        //$( "#prz_check" ).addClass( "hidden" );
        //$('input[name=assay_prz]').prop('checked', false);
    }
});
if ($("input[name='protocol']").is(':checked')) {
    if($('input[name=protocol]:checked').val() == 0){
        $( "#tor_check" ).addClass( "hidden" );
    }
    else if($('input[name=protocol]:checked').val() == 1){
        $( "#protocol_check" ).removeClass( "hidden" );
        //$( "#prz_check" ).addClass( "hidden" );
        //$('input[name=protocol]').prop('checked', false);
    }
    else{
        $( "#protocol_check" ).addClass( "hidden" );
        //$( "#prz_check" ).addClass( "hidden" );
        //$('input[name=protocol]').prop('checked', false);
    }
}
else {
    $( "#tor_check" ).addClass( "hidden" );
    $( "#prz_check" ).addClass( "hidden" );
}
