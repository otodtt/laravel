$(document).ready(function(){
    $("#check_name_firm").click(GetNameFirm);
});

function GetNameFirm(){
    $.ajax({
        type: "POST",
        url: "http://odbhrz.test/farmers/firms",
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        dataType:'json',
        data:{
            val1:$('#firm_name_search').val(),
        }

    }).done(function(data){
        $('#has').html(data[0]);
    });
}
