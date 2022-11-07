/**
 * Created by DelT on 24.11.2016 г..
 */
/**
 * Остатъци от ПРЗ
 */
$('input[name="assay_more"]').on('click', function(){
    if($('input[name=assay_more]:checked').val() == 0){
        $( "#prz_check" ).addClass( "hidden" );
    }
    else if($('input[name=assay_more]:checked').val() == 1){
        $( "#more_check" ).removeClass( "hidden" );
    }
    else{
        $( "#more_check" ).addClass( "hidden" );
    }
});
if ($("input[name='assay_more']").is(':checked')) {
    if($('input[name=assay_more]:checked').val() == 0){
        $( "#more_check" ).addClass( "hidden" );
    }
    else if($('input[name=assay_more]:checked').val() == 1){
        $( "#more_check" ).removeClass( "hidden" );
    }
    else{
        $( "#more_check" ).addClass( "hidden" );
    }
}
else {
    $( "#more_check" ).addClass( "hidden" );
}

/**
 * Идентификация на ПРЗ
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
 * Нитрати
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
        //$( "#firm_data" ).addClass( "hidden" );
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

/**
 * Тежки метали
 */
$('input[name="assay_metal"]').on('click', function(){
    if($('input[name=assay_metal]:checked').val() == 0){
        $( "#metal_check" ).addClass( "hidden" );
    }
    else if($('input[name=assay_metal]:checked').val() == 1){
        $( "#metal_check" ).removeClass( "hidden" );
    }
    else{
        $( "#metal_check" ).addClass( "hidden" );
    }
});
if ($("input[name='assay_metal']").is(':checked')) {
    if($('input[name=assay_metal]:checked').val() == 0){
        $( "#metal_check" ).addClass( "hidden" );
    }
    else if($('input[name=assay_metal]:checked').val() == 1){
        $( "#metal_check" ).removeClass( "hidden" );
    }
    else{
        $( "#metal_check" ).addClass( "hidden" );
    }
}
else {
    $( "#metal_check" ).addClass( "hidden" );
}

/**
 * Микроб. замърсители
 */
$('input[name="assay_micro"]').on('click', function(){
    if($('input[name=assay_micro]:checked').val() == 0){
        $( "#micro_check" ).addClass( "hidden" );
    }
    else if($('input[name=assay_micro]:checked').val() == 1){
        $( "#micro_check" ).removeClass( "hidden" );
    }
    else{
        $( "#micro_check" ).addClass( "hidden" );
    }
});
if ($("input[name='assay_micro']").is(':checked')) {
    if($('input[name=assay_micro]:checked').val() == 0){
        $( "#micro_check" ).addClass( "hidden" );
    }
    else if($('input[name=assay_micro]:checked').val() == 1){
        $( "#micro_check" ).removeClass( "hidden" );
    }
    else{
        $( "#micro_check" ).addClass( "hidden" );
    }
}
else {
    $( "#micro_check" ).addClass( "hidden" );
}

/**
 * Други
 */
$('input[name="assay_other"]').on('click', function(){
    if($('input[name=assay_other]:checked').val() == 0){
        $( "#other_check" ).addClass( "hidden" );
    }
    else if($('input[name=assay_other]:checked').val() == 1){
        $( "#other_check" ).removeClass( "hidden" );
    }
    else{
        $( "#other_check" ).addClass( "hidden" );
    }
});
if ($("input[name='assay_other']").is(':checked')) {
    if($('input[name=assay_other]:checked').val() == 0){
        $( "#other_check" ).addClass( "hidden" );
    }
    else if($('input[name=assay_other]:checked').val() == 1){
        $( "#other_check" ).removeClass( "hidden" );
    }
    else{
        $( "#other_check" ).addClass( "hidden" );
    }
}
else {
    $( "#other_check" ).addClass( "hidden" );
}