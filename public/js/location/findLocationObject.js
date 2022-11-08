$(document).ready(function(){
    $("#areasIDObject").change(load_object);
    $("#localsIDObject").change(load_locals_object);
    $("#submit").click(GetClickObject);
});

function load_object(){
    $.ajax({
        type: "POST",
        url: "http://odbhrz.test/others/locations",
        headers:{'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        data: "areasIDObject="+$("#areasIDObject").val(),
        dataType:'json'

    }).done(function(data){
        $('#localsIDObject').html(data[0]);
        $('#hidden2').attr('value', data[1]);
        $('#places_object').html(data[2]);
    });
}
function load_locals_object(){
    $.ajax({
        type: "POST",
        url: "http://odbhrz.test/others/locations",
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        dataType:'json',
        data:{
            val1:$('#localsIDObject').val(),
            val2:$('#hidden2').val()
        }
    }).done(function(data){
        $('#places_object').html(data[0]);
    });
}

function GetValueObject() {
    var x = $('#list_name_object').val();
    var z = $('#places_object');
    var val = $(z).find('option[value="' + x + '"]');

    //var endval = val.attr('data_id2');
    //$('#data_id2').attr("value", endval);

    var tmv = val.attr('tmv');
    $('#tmv').attr("value", tmv);

    //var endval_oblast = val.attr('areas_id2');
    //$('#areas_id2').attr("value", endval_oblast);
    //
    var endval_obstina = val.attr('district_id2');
    $('#district_id2').attr("value", endval_obstina);


    if($(z).find('option[value="' + x + '"]').length > 0 ){
        alert(tmv+' '+x+' OK');
    }
    else{
        $('#error2').attr("value", 111);
        alert('Грешка! Избери населеното място от списъка!');
    }
}

function GetClickObject() {
    var x = $('#list_name_object').val();
    var z = $('#places_object');
    var val = $(z).find('option[value="' + x + '"]');

    //var endval = val.attr('data_id2');
    //$('#data_id2').attr("value", endval);

    var tmv = val.attr('tmv');
    $('#tmv').attr("value", tmv);

    //var endval_oblast = val.attr('areas_id2');
    //$('#areas_id2').attr("value", endval_oblast);
    //
    var endval_obstina = val.attr('district_id2');
    $('#district_id2').attr("value", endval_obstina);


    if($(z).find('option[value="' + x + '"]').length === 0 ){
        $('#error2').attr("value", 111);
    }

    ///////
    var a = $('#is_submit2').val();
    var b = $('#hidden2').val();
    if(a == b){
        $('#localsIDObject').attr("value", $('#district_id2').val());
    }

}
