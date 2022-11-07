
// 15
function run15() {
    var different = document.getElementsByClassName('type_pack15')[0].value;
    if (different == 1) {
        $( ".different_row15" ).removeClass( "hidden" );
        $( ".hide_number15" ).addClass( "hidden" );
    }
    else {
        $( ".different_row15" ).addClass( "hidden" );
        $( ".hide_number15" ).removeClass( "hidden" );
    }
}
