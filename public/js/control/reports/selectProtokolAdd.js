/**
 * За ПРЗ
 */
$('input[name="assay_prz"]').on('click', function(){
    if($('input[name=assay_prz]:checked').val() == 0){
        $( "#prz_check" ).addClass( "hidden" );
        $('#prz-hidden').attr("value", 0);
    }
    else if($('input[name=assay_prz]:checked').val() == 1){
        $( "#prz_check" ).removeClass( "hidden" );
        $( "#tor_check" ).addClass( "hidden" );
        $('#prz-hidden').attr("value", 1);

        $('input[name=assay_tor]').attr('checked', false);
    }
});
if ($("input[name='assay_prz']").is(':checked')) {
    if($('input[name=assay_prz]:checked').val() == 0){
        $( "#prz_check" ).addClass( "hidden" );
        $('#prz-hidden').attr("value", 0);
    }
    else if($('input[name=assay_prz]:checked').val() == 1){
        $( "#prz_check" ).removeClass( "hidden" );
        $( "#tor_check" ).addClass( "hidden" );
        $('#prz-hidden').attr("value", 1);

        $('input[name=assay_tor]').attr('checked',  false);
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
        $( "#prz_check" ).addClass( "hidden" );
        $('input[name=assay_prz]').prop('checked', false);
    }
    else{
        $( "#tor_check" ).addClass( "hidden" );
        $( "#prz_check" ).addClass( "hidden" );
        $('input[name=assay_prz]').prop('checked', false);
    }
});
if ($("input[name='assay_tor']").is(':checked')) {
    if($('input[name=assay_tor]:checked').val() == 0){
        $( "#tor_check" ).addClass( "hidden" );
    }
    else if($('input[name=assay_tor]:checked').val() == 1){
        $( "#tor_check" ).removeClass( "hidden" );
        $( "#prz_check" ).addClass( "hidden" );
        $('input[name=assay_prz]').prop('checked', false);
    }
    else{
        $( "#tor_check" ).addClass( "hidden" );
        $( "#prz_check" ).addClass( "hidden" );
        $('input[name=assay_prz]').prop('checked', false);
    }
}
else {
    $( "#tor_check" ).addClass( "hidden" );
    $( "#prz_check" ).addClass( "hidden" );
}
