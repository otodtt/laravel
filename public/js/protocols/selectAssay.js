/**
 * За ПРЗ
 */
$('input[name="assay_prz"]').on('click', function(){
    if($('input[name=assay_prz]:checked').val() == 0){
        $( "#prz_check" ).addClass( "hidden" );
    }
    else if($('input[name=assay_prz]:checked').val() == 1){
        $( "#prz_check" ).removeClass( "hidden" );
    }
    else{
        $( "#prz_check" ).addClass( "hidden" );
    }
});
if ($("input[name='assay_prz']").is(':checked')) {
    if($('input[name=assay_prz]:checked').val() == 0){
        $( "#prz_check" ).addClass( "hidden" );
        //$( "#firm_data" ).addClass( "hidden" );
    }
    else if($('input[name=assay_prz]:checked').val() == 1){
        $( "#prz_check" ).removeClass( "hidden" );
    }
    else{
        $( "#prz_check" ).addClass( "hidden" );
    }
}
else {
    $( "#prz_check" ).addClass( "hidden" );
}


/**
 * За Тора
 */
$('input[name="assay_tor"]').on('click', function(){
    if($('input[name=assay_tor]:checked').val() == 0){
        $( "#tor_check" ).addClass( "hidden" );
    }
    else if($('input[name=assay_tor]:checked').val() == 1){
        $( "#tor_check" ).removeClass( "hidden" );
    }
    else{
        $( "#tor_check" ).addClass( "hidden" );
    }
});
if ($("input[name='assay_tor']").is(':checked')) {
    if($('input[name=assay_tor]:checked').val() == 0){
        $( "#tor_check" ).addClass( "hidden" );
    }
    else if($('input[name=assay_tor]:checked').val() == 1){
        $( "#tor_check" ).removeClass( "hidden" );
    }
    else{
        $( "#tor_check" ).addClass( "hidden" );
    }
}
else {
    $( "#tor_check" ).addClass( "hidden" );
}