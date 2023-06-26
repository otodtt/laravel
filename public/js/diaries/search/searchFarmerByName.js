$(document).ready(function(){
    $("#check_name_farmer").click(GetNameFarmer);
});

function GetNameFarmer(){
    $.ajax({
        type: "POST",
        url: "http://93.183.140.127/diary/names",
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        dataType:'json',
        data:{
            val1:$('#name_farmer').val()
        }

    }).done(function(data){
        $('#has').html(data[0]);
    });
}
