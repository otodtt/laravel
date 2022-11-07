$(document).ready(function() {
    $( "#number_sample" ).change(function() {
        $( "#change_no" ).addClass( "hidden" );
        $( "#change_yes" ).removeClass( "hidden" );
    });

    $( "#date_number" ).change(function() {
        $( "#change_no" ).addClass( "hidden" );
        $( "#change_yes" ).removeClass( "hidden" );
    });
} );

