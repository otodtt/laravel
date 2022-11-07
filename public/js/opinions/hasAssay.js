/**
 * Created by DelT on 18.11.2016 г..
 */
function ClearChecked(){
    $('input[name=assay_no]').prop('checked', false);
    $('input[name=assay_more]').prop('checked', false);
    $('input[name=assay_prz]').prop('checked', false);
    $('input[name=assay_tor]').prop('checked', false);
    $('input[name=assay_metal]').prop('checked', false);
    $('input[name=assay_micro]').prop('checked', false);
    $('input[name=assay_other]').prop('checked', false);
    $('input[name=assay_error]').val(0);
}



$('input[name="assay_no"]').on('click', function(){
    if($('input[name=assay_no]:checked').val() == 0){
        $('input[name=assay_more]').prop('checked', false);
        $('input[name=assay_prz]').prop('checked', false);
        $('input[name=assay_tor]').prop('checked', false);
        $('input[name=assay_metal]').prop('checked', false);
        $('input[name=assay_micro]').prop('checked', false);
        $('input[name=assay_other]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
});
if ($("input[name='assay_no']").is(':checked')) {
    if($('input[name=assay_no]:checked').val() == 0){
        $('input[name=assay_more]').prop('checked', false);
        $('input[name=assay_prz]').prop('checked', false);
        $('input[name=assay_tor]').prop('checked', false);
        $('input[name=assay_metal]').prop('checked', false);
        $('input[name=assay_micro]').prop('checked', false);
        $('input[name=assay_other]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
}
///// 1
$('input[name="assay_more"]').on('click', function(){
    if($('input[name=assay_more]:checked').val() == 1){
        $('input[name=assay_no]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
});
if ($("input[name='assay_more']").is(':checked')) {
    if($('input[name=assay_more]:checked').val() == 1){
        $('input[name=assay_no]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
}
///// 2
$('input[name="assay_prz"]').on('click', function(){
    if($('input[name=assay_prz]:checked').val() == 1){
        $('input[name=assay_no]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
});
if ($("input[name='assay_prz']").is(':checked')) {
    if($('input[name=assay_prz]:checked').val() == 1){
        $('input[name=assay_no]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
}
///// 3
$('input[name="assay_tor"]').on('click', function(){
    if($('input[name=assay_tor]:checked').val() == 1){
        $('input[name=assay_no]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
});
if ($("input[name='assay_tor']").is(':checked')) {
    if($('input[name=assay_tor]:checked').val() == 1){
        $('input[name=assay_no]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
}
///// 4
$('input[name="assay_metal"]').on('click', function(){
    if($('input[name=assay_metal]:checked').val() == 1){
        $('input[name=assay_no]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
});
if ($("input[name='assay_metal']").is(':checked')) {
    if($('input[name=assay_metal]:checked').val() == 1){
        $('input[name=assay_no]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
}
///// 5
$('input[name="assay_micro"]').on('click', function(){
    if($('input[name=assay_micro]:checked').val() == 1){
        $('input[name=assay_no]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
});
$('input[name="assay_micro"]').on('click', function(){
    if($('input[name=assay_micro]:checked').val() == 1){
        $('input[name=assay_no]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
});
///// 6
$('input[name="assay_other"]').on('click', function(){
    if($('input[name=assay_other]:checked').val() == 1){
        $('input[name=assay_no]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
});
$('input[name="assay_other"]').on('click', function(){
    if($('input[name=assay_other]:checked').val() == 1){
        $('input[name=assay_no]').prop('checked', false);
        $('input[name=assay_error]').val(1);
    }
});
/////////////////////

//////////////////////////////////