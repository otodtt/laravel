//$(document).ready(function () {
//    var sum = 0;
//    $('tr').find('.sumRow').each(function () {
//        var sum_row = $(this).text();
//        if (!isNaN(sum_row) && sum_row.length !== 0) {
//            sum += parseFloat(sum_row);
//        }
//    });
//
//    $('.total-row').html(sum);
//});

$(document).ready(function () {
    //iterate through each row in the table
    $('tr').each(function () {
        //the value of sum needs to be reset for each row, so it has to be set inside the row loop
        var sum = 0;
        //find the combat elements in the current row and sum it
        $(this).find('.sumRow').each(function () {
            //a much shorter version to sum the values, using unary operator
            sum += +$(this).text() || 0;
        });
        //set the value of currents rows sum to the total-combat element in the current row
        $('.total', this).html(sum);
    })
});

