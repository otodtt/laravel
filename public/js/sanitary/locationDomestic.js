$(document).ready(function(){
    $("#check_farmer_certificate").click(GetPinFarmerCertificate);
    $("#check_name_farmer_certificate").click(GetNameFarmerCertificate);
    $("#check_name_firm_certificate").click(GetNameFirmCertificate);
});

function GetPinFarmerCertificate(){
    $.ajax({
        type: "POST",
        url: "http://93.183.140.127/certificate/pin",
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        dataType:'json',
        data:{
            val1:$('#pin_farmer').val(),
        }

    }).done(function(data){
        $('#has').html(data[0]);
    });
}
function GetNameFarmerCertificate(){
    $.ajax({
        type: "POST",
        url: "http://93.183.140.127/certificate/names",
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        dataType:'json',
        data:{
            val1:$('#name_farmer').val(),
        }

    }).done(function(data){
        $('#has').html(data[0]);
    });
}
function GetNameFirmCertificate(){
    $.ajax({
        type: "POST",
        url: "http://93.183.140.127/certificate/firms",
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        dataType:'json',
        data:{
            val1:$('#firm_name_search').val(),
        }

    }).done(function(data){
        $('#has').html(data[0]);
    });
}