//  ЗА КУЛТУРИТЕ КОГАТО СЕ МНОГО И ПОДРАВНЯВАНЕ С ДРУГИТЕ ПОЛЕТА
$(function() {
    //   КОГАТО СТРАНАТА Е НА ДВА РЕДА
    const height = document.querySelector('#country_wrap').offsetHeight
    console.log("height ->" + height);

    if (height > 18) {
        $('#country_p').css('fontSize', '11px');
    }
    //   КОГАТО ОПАКОВЧИКА Е НА ПОВЕЧЕ ОР $ РЕДА

    const div = document.querySelector('#second-row').offsetHeight
    if (div > 103) {
        const packers = document.getElementById("packers").style.fontSize
        const font = packers.slice(0, packers.length - 2);

        document.getElementById("packers").style.fontSize = font - 1 + 'px'
        document.getElementById("second-row").style.height = '103px'
    }

    //   ЗА ПОДРАВНЯВАНЕ НА КУЛТУРИТВ
    const cent = 0.02645833
    const first = document.querySelector('#first_table').offsetHeight
    const second = document.querySelector('#second_table').offsetHeight
    const third = document.querySelector('#third_table').offsetHeight
    const fourth = document.querySelector('#fourth_table').offsetHeight
    const fifth = document.querySelector('#fifth_table').offsetHeight
    const sixth = document.querySelector('#sixth_table').offsetHeight

    const sixth_cell = document.querySelector('.sixth-row-cell').offsetHeight
    const seven_cell = document.querySelector('.seven-row-cell').offsetHeight

    console.log((first + second + third + fourth + fifth + sixth_cell + seven_cell)  * cent);
    console.log("first ->" + first  * cent);
    console.log("second ->" + second  * cent);
    console.log("third ->" + third  * cent);
    console.log("fourth ->" + fourth  * cent);
    console.log("fifth ->" + fifth  * cent);
    console.log("sixth ->" + sixth  * cent);


    $('.quality0').css('margin-top', '65px');
    $('.weight0').css('margin-top', '50px');

    // ////  0  ///
    const pack0 = document.querySelector('.pack0').offsetHeight
    const crop0 = document.querySelector('.crop0').offsetHeight
    if ( pack0 >=  crop0 ) {
        $('.crop0').css('height', pack0 + 'px');
        $('.quality0').css('height', pack0 + 'px');
        $('.weight0').css('height', pack0 + 'px');
    } else {
        $('.pack0').css('height', crop0 + 'px');
        $('.quality0').css('height', crop0 + 'px');
        $('.weight0').css('height', crop0 + 'px');
    }

    // ////  1  ///
    if ( document.querySelector('.crop4') !== null ) {
        const pack1 = document.querySelector('.pack1').offsetHeight
        const crop1 = document.querySelector('.crop1').offsetHeight
        if (pack1 >= crop1) {
            $('.crop1').css('height', pack1 + 'px');
            $('.quality1').css('height', pack1 + 'px');
            $('.weight1').css('height', pack1 + 'px');
        } else {
            $('.pack1').css('height', crop1 + 'px');
            $('.quality1').css('height', crop1 + 'px');
            $('.weight1').css('height', crop1 + 'px');
        }
    }

    // ////  2  ///
    if ( document.querySelector('.crop2') !== null ) {
        const pack2 = document.querySelector('.pack2').offsetHeight
        const crop2 = document.querySelector('.crop2').offsetHeight
        if (pack2 >= crop2) {
            $('.crop2').css('height', pack2 + 'px');
            $('.quality2').css('height', pack2 + 'px');
            $('.weight2').css('height', pack2 + 'px');
        } else {
            $('.pack2').css('height', crop2 + 'px');
            $('.quality2').css('height', crop2 + 'px');
            $('.weight2').css('height', crop2 + 'px');
        }
    }

    // ////  3  ///
    if ( document.querySelector('.crop3') !== null ) {
        const pack3 = document.querySelector('.pack3').offsetHeight
        const crop3 = document.querySelector('.crop3').offsetHeight
        if (pack3 >= crop3) {
            $('.crop3').css('height', pack3 + 'px');
            $('.quality3').css('height', pack3 + 'px');
            $('.weight3').css('height', pack3 + 'px');
        } else {
            $('.pack3').css('height', crop3 + 'px');
            $('.quality3').css('height', crop3 + 'px');
            $('.weight3').css('height', crop3 + 'px');
        }
    }

    // ////  4  ///
    if ( document.querySelector('.crop4') !== null ) {
        const pack4 = document.querySelector('.pack4').offsetHeight
        const crop4 = document.querySelector('.crop4').offsetHeight
        if ( pack4 >=  crop4 ) {
            $('.crop4').css('height', pack4 + 'px');
            $('.quality4').css('height', pack4 + 'px');
            $('.weight4').css('height', pack4 + 'px');
        } else {
            $('.pack4').css('height', crop4 + 'px');
            $('.quality4').css('height', crop4 + 'px');
            $('.weight4').css('height', crop4 + 'px');
        }
    }

    // ////  5  ///
    if ( document.querySelector('.crop5') !== null ) {
        const pack5 = document.querySelector('.pack5').offsetHeight
        const crop5 = document.querySelector('.crop5').offsetHeight
        if ( pack5 >=  crop5 ) {
            $('.crop5').css('height', pack5 + 'px');
            $('.quality5').css('height', pack5 + 'px');
            $('.weight5').css('height', pack5 + 'px');
        } else {
            $('.pack5').css('height', crop5 + 'px');
            $('.quality5').css('height', crop5 + 'px');
            $('.weight5').css('height', crop5 + 'px');
        }
    }

    // ////  6  ///
    if ( document.querySelector('.crop6') !== null ) {
        const pack6 = document.querySelector('.pack6').offsetHeight
        const crop6 = document.querySelector('.crop6').offsetHeight
        if ( pack6 >=  crop6 ) {
            $('.crop6').css('height', pack6 + 'px');
            $('.quality6').css('height', pack6 + 'px');
            $('.weight6').css('height', pack6 + 'px');
        } else {
            $('.pack6').css('height', crop6 + 'px');
            $('.quality6').css('height', crop6 + 'px');
            $('.weight6').css('height', crop6 + 'px');
        }
    }

    // ////  7  ///
    if ( document.querySelector('.crop7') !== null ) {
        const pack7 = document.querySelector('.pack7').offsetHeight
        const crop7 = document.querySelector('.crop7').offsetHeight
        if ( pack7 >=  crop7 ) {
            $('.crop7').css('height', pack7 + 'px');
            $('.quality7').css('height', pack7 + 'px');
            $('.weight7').css('height', pack7 + 'px');
        } else {
            $('.pack7').css('height', crop7 + 'px');
            $('.quality7').css('height', crop7 + 'px');
            $('.weight7').css('height', crop7 + 'px');
        }
    }

    // ////  8  ///
    if ( document.querySelector('.crop8') !== null ) {
        const pack8 = document.querySelector('.pack8').offsetHeight
        const crop8 = document.querySelector('.crop8').offsetHeight
        if ( pack8 >=  crop8 ) {
            $('.crop8').css('height', pack8 + 'px');
            $('.quality8').css('height', pack8 + 'px');
            $('.weight8').css('height', pack8 + 'px');
        } else {
            $('.pack8').css('height', crop8 + 'px');
            $('.quality8').css('height', crop8 + 'px');
            $('.weight8').css('height', crop8 + 'px');
        }
    }
    // ////  9  ///
    if ( document.querySelector('.crop9') !== null ) {
        const pack9 = document.querySelector('.pack9').offsetHeight
        const crop9 = document.querySelector('.crop9').offsetHeight
        if ( pack9 >=  crop9 ) {
            $('.crop9').css('height', pack9 + 'px');
            $('.quality9').css('height', pack9 + 'px');
            $('.weight9').css('height', pack9 + 'px');
        } else {
            $('.pack9').css('height', crop9 + 'px');
            $('.quality9').css('height', crop9 + 'px');
            $('.weight9').css('height', crop9 + 'px');
        }
    }
})

// ДОБАВЕНИ ПОВЕЧЕ ОТ ТРИ РЕДА
$(function() {
    //const first = document.querySelector('#first_table').offsetHeight
    //const second = document.querySelector('#second_table').offsetHeight
    //const third = document.querySelector('#third_table').offsetHeight
    //const fourth = document.querySelector('#fourth_table').offsetHeight
    //const fifth = document.querySelector('#fifth_table').offsetHeight
    //const sixth = document.querySelector('#sixth_table').offsetHeight

    // console.log( fourth * 0.0264583333 + '---' + fourth)

    //$('#p_top_set').css('margin-bottom', '35px');
    //$('#p_bottom_set').css('margin-top', '30px');
    //$('#signature').css('margin-top', '15px');
    
    //// ЧЕТИРИ
    //if (fourth > 110) {
    //    $('#fifth_table').css('height', 'auto');
    //    $('#stocs_cell').css('padding-bottom', '1px');
    //    $('#p_top_set').css('margin-bottom', '33px');
    //    $('#p_bottom_set').css('margin-top', '29px');
    //    $('#signature').css('margin-top', '14px');
    //}
    //// ПЕТ
    //if (fourth >= 123) {
    //    $('#p_top_set').css('margin-bottom', '25px');
    //    $('#p_bottom_set').css('margin-top', '23px');
    //}
    //    // ШЕСТ
    //    if (fourth >= 140) {
    //    $('#sixth_table').css('height', '1.74cm');
    //}
    //// СЕДЕМ
    //    if (fourth >= 157) {
    //    $('#third_table').css('height', '2.8cm');
    //    $('#p_top_set').css('margin-bottom', '19px');
    //    $('#p_bottom_set').css('margin-top', '19px');
    //}
    //// ОСЕМ
    //    if (fourth >= 173) {
    //    $('#third_table').css('height', '2.35cm');
    //}
    ////  ДЕВЕТ
    //if (fourth >= 191) {
    //    $('#p_top_set').css('margin-bottom', '14px');
    //    $('#p_bottom_set').css('margin-top', '14px');
    //    $('#signature').css('margin-top', '8px');
    //}
    ////  ДЕСЕТ
    //if (fourth >= 208) {
    //    $('#p_seven').css('margin-bottom', '0');
    //    $('#p_top_set').css('margin-bottom', '7px');
    //    $('#p_bottom_set').css('margin-top', '7px');
    //    $('#signature').css('margin-top', '4px');
    //    $('#sixth_table').css('height', '1.3cm');
    //}
    ////  ЕДИНАДЕСЕТ
    //if (fourth >= 225) {
    //    $('.p_bottom').css('margin-top', '7px');
    //    $('.h3_bottom').css('margin-bottom', '0.8cm');
    //}
    ////  ДВАНАДЕСЕТ
    //if (fourth >= 243) {
    //    $('.h3_bottom').css('margin-bottom', '0.5cm');
    //}
})

//// ЗА ПРЕРАБОТКА
//$(function() {
//    const height = document.querySelector('#first_table').offsetHeight * 0.0264583333;
//    if (height > 5.3) {
//        $('.number_sert').css('margin-top', '13px');
//        $('.number_sert').css('padding-bottom', '13px');
//    }
//})
//
//   КОГАТО СТРАНАТА Е НА ДВА РЕДА
//$(function() {
//    const height = document.querySelector('#country_wrap').offsetHeight
//    console.log("height ->" + height);
//
//    if (height > 18) {
//        $('#country_p').css('fontSize', '11px');
//    }
//})







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


