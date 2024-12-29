
$(function() {
    $('.pack0').css('margin-top', '10px');
    $('.crop0').css('margin-top', '5px');
    $('.quality0').css('margin-top', '20px');
    $('.weight0').css('margin-top', '20px');
    console.log("Hello world!");
    // ////  0  ///
    const crop0 = document.querySelector('.crop0').offsetHeight
    const quality0 = document.querySelector('.quality0').offsetHeight

    if ( quality0 * 2 ==  crop0 ) {
        $('.pack0').css('margin-bottom', quality0 + 'px');
        $('.quality0').css('margin-bottom', quality0 + 'px');
        $('.weight0').css('margin-bottom', quality0 + 'px');
    }
    if ( quality0 * 3 ==  crop0 ) {
        $('.pack0').css('margin-bottom', quality0 * 2 +'px');
        $('.quality0').css('margin-bottom', quality0 * 2 +'px');
        $('.weight0').css('margin-bottom', quality0 * 2 +'px');
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
            $('.pack2').css('margin-bottom', quality0 + 'px');
            $('.quality2').css('margin-bottom', quality0 + 'px');
            $('.weight2').css('margin-bottom', quality0 + 'px');
        }
        if ( quality2 * 3 ==  crop2 ) {
            $('.pack2').css('margin-bottom', quality0 * 2 +'px');
            $('.quality2').css('margin-bottom', quality0 * 2 +'px');
            $('.weight2').css('margin-bottom', quality0 * 2 +'px');
        }
    }

    // ////  3  ///
    if ( document.querySelector('.crop3') !== null ) {
        const crop3 = document.querySelector('.crop3').offsetHeight
        const quality3 = document.querySelector('.quality3').offsetHeight
        if ( quality3 * 2 ==  crop3 ) {
            $('.pack3').css('margin-bottom', quality0 + 'px');
            $('.quality3').css('margin-bottom', quality0 + 'px');
            $('.weight3').css('margin-bottom', quality0 + 'px');
        }
        if ( quality3 * 3 ==  crop3 ) {
            $('.pack3').css('margin-bottom', quality0 * 2 +'px');
            $('.quality3').css('margin-bottom', quality0 * 2 +'px');
            $('.weight3').css('margin-bottom', quality0 * 2 +'px');
        }
    }

    // ////  4  ///
    if ( document.querySelector('.crop4') !== null ) {
        const crop4 = document.querySelector('.crop4').offsetHeight
        const quality4 = document.querySelector('.quality4').offsetHeight
        if ( quality4 * 2 ==  crop4 ) {
            $('.pack4').css('margin-bottom', quality0 + 'px');
            $('.quality4').css('margin-bottom', quality0 + 'px');
            $('.weight4').css('margin-bottom', quality0 + 'px');
        }
        if ( quality4 * 3 ==  crop4 ) {
            $('.pack4').css('margin-bottom', quality0 * 2 +'px');
            $('.quality4').css('margin-bottom', quality0 * 2 +'px');
            $('.weight4').css('margin-bottom', quality0 * 2 +'px');
        }
    }
    // console.log(document.querySelector('.crop5')  )
    // ////  5  ///
    if ( document.querySelector('.crop5') !== null ) {
        const crop5 = document.querySelector('.crop5').offsetHeight
        const quality5 = document.querySelector('.quality5').offsetHeight
        if ( quality5 * 2 ==  crop5 ) {
            $('.pack5').css('margin-bottom', quality0 + 'px');
            $('.quality5').css('margin-bottom', quality0 + 'px');
            $('.weight5').css('margin-bottom', quality0 + 'px');
        }
        if ( quality5 * 3 ==  crop5 ) {
            $('.pack5').css('margin-bottom', quality0 * 2 +'px');
            $('.quality5').css('margin-bottom', quality0 * 2 +'px');
            $('.weight5').css('margin-bottom', quality0 * 2 +'px');
        }
    }

    // ////  6  ///
    if ( document.querySelector('.crop6') !== null ) {
        const crop6 = document.querySelector('.crop6').offsetHeight
        const quality6 = document.querySelector('.quality6').offsetHeight
        if ( quality6 * 2 ==  crop6 ) {
            $('.pack6').css('margin-bottom', quality0 + 'px');
            $('.quality6').css('margin-bottom', quality0 + 'px');
            $('.weight6').css('margin-bottom', quality0 + 'px');
        }
        if ( quality6 * 3 ==  crop6 ) {
            $('.pack6').css('margin-bottom', quality0 * 2 +'px');
            $('.quality6').css('margin-bottom', quality0 * 2 +'px');
            $('.weight6').css('margin-bottom', quality0 * 2 +'px');
        }
    }

    // ////  7  ///
    if ( document.querySelector('.crop7') !== null ) {
        const crop7 = document.querySelector('.crop7').offsetHeight
        const quality7 = document.querySelector('.quality7').offsetHeight
        if ( quality7 * 2 ==  crop7 ) {
            $('.pack7').css('margin-bottom', quality0 + 'px');
            $('.quality7').css('margin-bottom', quality0 + 'px');
            $('.weight7').css('margin-bottom', quality0 + 'px');
        }
        if ( quality7 * 3 ==  crop7 ) {
            $('.pack7').css('margin-bottom', quality0 * 2 +'px');
            $('.quality7').css('margin-bottom', quality0 * 2 +'px');
            $('.weight7').css('margin-bottom', quality0 * 2 +'px');
        }
    }

    // ////  8  ///
    if ( document.querySelector('.crop8') !== null ) {
        const crop8 = document.querySelector('.crop8').offsetHeight
        const quality8 = document.querySelector('.quality8').offsetHeight
        if ( quality8 * 2 ==  crop8 ) {
            $('.pack8').css('margin-bottom', quality0 + 'px');
            $('.quality8').css('margin-bottom', quality0 + 'px');
            $('.weight8').css('margin-bottom', quality0 + 'px');
        }
        if ( quality8 * 3 ==  crop8 ) {
            $('.pack8').css('margin-bottom', quality0 * 2 +'px');
            $('.quality8').css('margin-bottom', quality0 * 2 +'px');
            $('.weight8').css('margin-bottom', quality0 * 2 +'px');
        }
    }
    // ////  9  ///
    if ( document.querySelector('.crop9') !== null ) {
        const crop9 = document.querySelector('.crop9').offsetHeight
        const quality9 = document.querySelector('.quality9').offsetHeight
        if ( quality9 * 2 ==  crop9 ) {
            $('.pack9').css('margin-bottom', quality0 + 'px');
            $('.quality9').css('margin-bottom', quality0 + 'px');
            $('.weight9').css('margin-bottom', quality0 + 'px');
        }
        if ( quality9 * 3 ==  crop9 ) {
            $('.pack9').css('margin-bottom', quality0 * 2 +'px');
            $('.quality9').css('margin-bottom', quality0 * 2 +'px');
            $('.weight9').css('margin-bottom', quality0 * 2 +'px');
        }
    }
})

// ДОБАВЕНИ ПОВЕЧЕ ОТ ТРИ РЕДА
$(function() {
    const first = document.querySelector('#first_table').offsetHeight
    const second = document.querySelector('#second_table').offsetHeight
    const third = document.querySelector('#third_table').offsetHeight
    const fourth = document.querySelector('#fourth_table').offsetHeight
    const fifth = document.querySelector('#fifth_table').offsetHeight
    const sixth = document.querySelector('#sixth_table').offsetHeight

    // console.log( fourth * 0.0264583333 + '---' + fourth)

    $('#p_top_set').css('margin-bottom', '35px');
    $('#p_bottom_set').css('margin-top', '30px');
    $('#signature').css('margin-top', '15px');
    
    // ЧЕТИРИ 
    if (fourth > 110) {
        $('#fifth_table').css('height', 'auto');
        $('#stocs_cell').css('padding-bottom', '1px');
        $('#p_top_set').css('margin-bottom', '33px');
        $('#p_bottom_set').css('margin-top', '29px');
        $('#signature').css('margin-top', '14px');
    }
    // ПЕТ
    if (fourth >= 123) {
        $('#p_top_set').css('margin-bottom', '25px');
        $('#p_bottom_set').css('margin-top', '23px');
    }
        // ШЕСТ
        if (fourth >= 140) {
        $('#sixth_table').css('height', '1.74cm');
    }
    // СЕДЕМ
        if (fourth >= 157) {
        $('#third_table').css('height', '2.8cm');
        $('#p_top_set').css('margin-bottom', '19px');
        $('#p_bottom_set').css('margin-top', '19px');
    }
    // ОСЕМ
        if (fourth >= 173) {
        $('#third_table').css('height', '2.35cm');
    }
    //  ДЕВЕТ
    if (fourth >= 191) {
        $('#p_top_set').css('margin-bottom', '14px');
        $('#p_bottom_set').css('margin-top', '14px');
        $('#signature').css('margin-top', '8px');
    }
    //  ДЕСЕТ
    if (fourth >= 208) {
        $('#p_seven').css('margin-bottom', '0');
        $('#p_top_set').css('margin-bottom', '7px');
        $('#p_bottom_set').css('margin-top', '7px');
        $('#signature').css('margin-top', '4px');
        $('#sixth_table').css('height', '1.3cm');
    }
    //  ЕДИНАДЕСЕТ
    if (fourth >= 225) {
        $('.p_bottom').css('margin-top', '7px');
        $('.h3_bottom').css('margin-bottom', '0.8cm');
    }
    //  ДВАНАДЕСЕТ
    if (fourth >= 243) {
        $('.h3_bottom').css('margin-bottom', '0.5cm');
    }
})

// ЗА ПРЕРАБОТКА
$(function() {
    const height = document.querySelector('#first_table').offsetHeight * 0.0264583333;
    if (height > 5.3) {
        $('.number_sert').css('margin-top', '13px');
        $('.number_sert').css('padding-bottom', '13px');
    }
})

//   КОГАТО СТРАНАТА Е НА ДВА РЕДА
$(function() {
    $('#country_wrapp').css('margin-top', '25px');

    const height = document.querySelector('#country_p').offsetHeight
    
    if (height > 18) {
        $('#country_wrapp').css('margin-top', '8px');
    }
    if (height > 35) {
        $('#country_wrapp').css('margin-top', '3px');
    }
})







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


