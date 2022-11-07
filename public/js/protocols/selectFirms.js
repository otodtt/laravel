/**
 * Created by DelT on 17.9.2016 г..
 */
$('input[name="firm"]').on('click', function(){
    if($('input[name=firm]:checked').val() == 1){
        $( "#person_data" ).removeClass( "hidden" );
        $( "#firm_data" ).addClass( "hidden" );
        $('input[name=gender_owner]').prop('checked', false);
        $('input[name=bulls]').prop('checked', false);
        $('input[name=owner]').val('');
        $('input[name=pin_owner]').val('');
        $('input[name=bulstat]').val('');
        $('input[name=name_firm]').val('');
    }
    else if($('input[name=firm]:checked').val() >= 2){
        $( "#person_data" ).addClass( "hidden" );
        $( "#firm_data" ).removeClass( "hidden" );
        $('input[name=gender]').prop('checked', false);
        $('input[name=name]').val('');
        $('input[name=pin]').val('');
    }
    else{
        $( "#person_data" ).addClass( "hidden" );
        $( "#firm_data" ).addClass( "hidden" );
    }
});

if ($("input[name='firm']").is(':checked')) {
    if($('input[name=firm]:checked').val() == 1){
        $( "#person_data" ).removeClass( "hidden" );
        $( "#firm_data" ).addClass( "hidden" );
    }
    else if($('input[name=firm]:checked').val() >= 2){
        $( "#person_data" ).addClass( "hidden" );
        $( "#firm_data" ).removeClass( "hidden" );
    }
    else{
        $( "#person_data" ).addClass( "hidden" );
        $( "#firm_data" ).addClass( "hidden" );
    }
}
else {
    $( "#person_data" ).addClass( "hidden" );
    $( "#firm_data" ).addClass( "hidden" );
}
