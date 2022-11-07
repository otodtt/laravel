// $(function() {
//     $('#address').css('font-size', '1em');

//     while ($('#address').height() > $('#fitin').height()) {
//         $('#address').css('font-size', (parseInt($('#address').css('font-size')) - 0.1) + "px");
//     }
// })
// $(function() {
//     $('#fitin_bottom div').css('font-size', '1em');

//     while ($('#fitin_bottom div').height() > $('#fitin_bottom').height()) {
//         $('#fitin_bottom div').css('font-size', (parseInt($('#fitin_bottom div').css('font-size')) - 0.1) + "px");
//     }
// })

$(function() {
    $('#country_wrapp').css('margin-top', '25px');

    const height = document.querySelector('#country_p').offsetHeight
    // console.log(height)
    if (height > 18) {
        $('#country_wrapp').css('margin-top', '8px');
    }
    if (height > 35) {
        $('#country_wrapp').css('margin-top', '3px');
    }
})

$(function() {
    $('.pack0').css('margin-top', '20px');
    $('.crop0').css('margin-top', '6px');
    $('.quality0').css('margin-top', '20px');
    $('.weight0').css('margin-top', '20px');

    // ////  0  ///
    const crop0 = document.querySelector('.crop0').offsetHeight
    const quality0 = document.querySelector('.quality0').offsetHeight
    if ( quality0 * 2 ==  crop0 ) {
        $('.pack0').css('margin-bottom', '17px');
        $('.quality0').css('margin-bottom', '17px');
        $('.weight0').css('margin-bottom', '17px');
    }
    if ( quality0 * 3 ==  crop0 ) {
        $('.pack0').css('margin-bottom', '34px');
        $('.quality0').css('margin-bottom', '34px');
        $('.weight0').css('margin-bottom', '34px');
    }
    // ////  1  ///
    if ( document.querySelector('.crop1') !== null ) {
        const crop1 = document.querySelector('.crop1').offsetHeight
        const quality1 = document.querySelector('.quality1').offsetHeight
        if ( quality1 * 2 ==  crop1 ) {
            $('.pack1').css('margin-bottom', quality0 + 'px');
            $('.quality1').css('margin-bottom', quality0 +'px');
            $('.weight1').css('margin-bottom', quality0 +'px');
        }
        if ( quality1 * 3 ==  crop1 ) {
            $('.pack1').css('margin-bottom', quality0 * 2 +'px');
            $('.quality1').css('margin-bottom', quality0 * 2 +'px');
            $('.weight1').css('margin-bottom', quality0 * 2 +'px');
        }
}

    // ////  2  ///
    if ( document.querySelector('.crop2') !== null ) {
        const crop2 = document.querySelector('.crop2').offsetHeight
        const quality2 = document.querySelector('.quality2').offsetHeight
        if ( quality2 * 2 ==  crop2 ) {
            $('.pack2').css('margin-bottom', '17px');
            $('.quality2').css('margin-bottom', '17px');
            $('.weight2').css('margin-bottom', '17px');
        }
        if ( quality2 * 3 ==  crop2 ) {
            $('.pack2').css('margin-bottom', '34px');
            $('.quality2').css('margin-bottom', '34px');
            $('.weight2').css('margin-bottom', '34px');
        }
    }

    // ////  3  ///
    if ( document.querySelector('.crop3') !== null ) {
        const crop3 = document.querySelector('.crop3').offsetHeight
        const quality3 = document.querySelector('.quality3').offsetHeight
        if ( quality3 * 2 ==  crop3 ) {
            $('.pack3').css('margin-bottom', '17px');
            $('.quality3').css('margin-bottom', '17px');
            $('.weight3').css('margin-bottom', '17px');
        }
        if ( quality3 * 3 ==  crop3 ) {
            $('.pack3').css('margin-bottom', '34px');
            $('.quality3').css('margin-bottom', '34px');
            $('.weight3').css('margin-bottom', '34px');
        }
    }

    // ////  4  ///
    if ( document.querySelector('.crop4') !== null ) {
        const crop4 = document.querySelector('.crop4').offsetHeight
        const quality4 = document.querySelector('.quality4').offsetHeight
        if ( quality4 * 2 ==  crop4 ) {
            $('.pack4').css('margin-bottom', '17px');
            $('.quality4').css('margin-bottom', '17px');
            $('.weight4').css('margin-bottom', '17px');
        }
        if ( quality4 * 4 ==  crop4 ) {
            $('.pack4').css('margin-bottom', '34px');
            $('.quality4').css('margin-bottom', '34px');
            $('.weight4').css('margin-bottom', '34px');
        }
    }
    // ////  5  ///
    if ( document.querySelector('.crop5') !== null ) {
        const crop5 = document.querySelector('.crop5').offsetHeight
        const quality5 = document.querySelector('.quality5').offsetHeight
        if ( quality5 * 2 ==  crop5 ) {
            $('.pack5').css('margin-bottom', '17px');
            $('.quality5').css('margin-bottom', '17px');
            $('.weight5').css('margin-bottom', '17px');
        }
        if ( quality5 * 5 ==  crop5 ) {
            $('.pack5').css('margin-bottom', '34px');
            $('.quality5').css('margin-bottom', '34px');
            $('.weight5').css('margin-bottom', '34px');
        }
    }

    // ////  6  ///
    if ( document.querySelector('.crop6') !== null ) {
        const crop6 = document.querySelector('.crop6').offsetHeight
        const quality6 = document.querySelector('.quality6').offsetHeight
        if ( quality6 * 2 ==  crop6 ) {
            $('.pack6').css('margin-bottom', '17px');
            $('.quality6').css('margin-bottom', '17px');
            $('.weight6').css('margin-bottom', '17px');
        }
        if ( quality6 * 6 ==  crop6 ) {
            $('.pack6').css('margin-bottom', '34px');
            $('.quality6').css('margin-bottom', '34px');
            $('.weight6').css('margin-bottom', '34px');
        }
}

    // ////  7  ///
    if ( document.querySelector('.crop7') !== null ) {
        const crop7 = document.querySelector('.crop7').offsetHeight
        const quality7 = document.querySelector('.quality7').offsetHeight
        if ( quality7 * 2 ==  crop7 ) {
            $('.pack7').css('margin-bottom', '17px');
            $('.quality7').css('margin-bottom', '17px');
            $('.weight7').css('margin-bottom', '17px');
        }
        if ( quality7 * 7 ==  crop7 ) {
            $('.pack7').css('margin-bottom', '34px');
            $('.quality7').css('margin-bottom', '34px');
            $('.weight7').css('margin-bottom', '34px');
        }
    }

    // ////  8  ///
    if ( document.querySelector('.crop8') !== null ) {
        const crop8 = document.querySelector('.crop8').offsetHeight
        const quality8 = document.querySelector('.quality8').offsetHeight
        if ( quality8 * 2 ==  crop8 ) {
            $('.pack8').css('margin-bottom', '17px');
            $('.quality8').css('margin-bottom', '17px');
            $('.weight8').css('margin-bottom', '17px');
        }
        if ( quality8 * 8 ==  crop8 ) {
            $('.pack8').css('margin-bottom', '34px');
            $('.quality8').css('margin-bottom', '34px');
            $('.weight8').css('margin-bottom', '34px');
        }
    }
    // ////  9  ///
    if ( document.querySelector('.crop9') !== null ) {
        const crop9 = document.querySelector('.crop9').offsetHeight
        const quality9 = document.querySelector('.quality9').offsetHeight
        if ( quality9 * 2 ==  crop9 ) {
            $('.pack9').css('margin-bottom', '17px');
            $('.quality9').css('margin-bottom', '17px');
            $('.weight9').css('margin-bottom', '17px');
        }
        if ( quality9 * 9 ==  crop9 ) {
            $('.pack9').css('margin-bottom', '34px');
            $('.quality9').css('margin-bottom', '34px');
            $('.weight9').css('margin-bottom', '34px');
        }
    }

})
