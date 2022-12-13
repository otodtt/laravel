$(document).ready(function(){
    $("#check_name_farmer").click(GetNameFarmer);
    $("#check_name_farmer_protocol").click(GetNameFarmerQProtocol);
});

function GetNameFarmer(){
    $.ajax({
        type: "POST",
        url: "http://odbhrz.test/protocol/names",
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        dataType:'json',
        data:{
            val1:$('#name_farmer').val(),
        }

    }).done(function(data){
        $('#has').html(data[0]);
    });
}


function GetNameFarmerQProtocol(){
    $.ajax({
        type: "POST",
        url: "http://odbhrz.test/qprotocol/names",
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        dataType:'json',
        data:{
            val1:$('#name_farmer').val(),
        }

    }).done(function(data){
        $('#has').html(data[0]);
    });
}

