/**
 * Created by DelT on 21.10.2016 г..
 */
$('input[name="firm_search"]').on('click', function(){
    if($('input[name=firm_search]:checked').val() == 1){
        $( "#pin_div" ).removeClass( "hidden" );
        $( "#eik_div" ).addClass( "hidden" );
        $('input[name=eik_search]').val('');
        $('input[name=firm_name_search]').val('');
    }
    else if($('input[name=firm_search]:checked').val() >= 2){
        $( "#pin_div" ).addClass( "hidden" );
        $( "#eik_div" ).removeClass( "hidden" );
        $('input[name=gender_farmer]').prop('checked', false);
        $('input[name=pin_farmer]').val('');
        $('input[name=name_farmer]').val('');
    }
    else{
        $( "#pin_div" ).addClass( "hidden" );
        $( "#eik_div" ).addClass( "hidden" );
    }
});

if ($("input[name='firm_search']").is(':checked')) {
    if($('input[name=firm_search]:checked').val() == 1){
        $( "#pin_div" ).removeClass( "hidden" );
        $( "#eik_div" ).addClass( "hidden" );
        $('input[name=eik_search]').val('');
        $('input[name=firm_name_search]').val('');

    }
    else if($('input[name=firm_search]:checked').val() >= 2){
        $( "#pin_div" ).addClass( "hidden" );
        $( "#eik_div" ).removeClass( "hidden" );
        $('input[name=gender_farmer]').prop('checked', false);
        $('input[name=pin_farmer]').val('');
        $('input[name=name_farmer]').val('');
    }
    else{
        $( "#pin_div" ).addClass( "hidden" );
        $( "#eik_div" ).addClass( "hidden" );
    }
}
