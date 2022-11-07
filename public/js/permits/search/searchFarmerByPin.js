$(document).ready(function(){
    $("#check_farmer").click(GetPinFarmer);
});

function GetPinFarmer(){
    $.ajax({
        type: "POST",
        url: "http://odbh/permit/pin",
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        dataType:'json',
        data:{
            val1:$('#pin_farmer').val(),
        }

    }).done(function(data){
        $('#has').html(data[0]);
    });
}