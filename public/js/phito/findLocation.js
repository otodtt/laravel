
$(document).ready(function(){
    $("#areasID").change(load);
    $("#localsID").change(load_locals);
    $("#submit").click(GetClick);
});

function load(){
    $.ajax({
        type: "POST",
        url: "http://odbhrz.test//firms/locations",
        headers:{'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        data: "areasID="+$("#areasID").val(),
        dataType:'json'
    }).done(function(data){
        $('#localsID').html(data[0]);
        $('#hidden').attr('value', data[1]);
        $('#places').html(data[2]);
    });

}
function load_locals(){
    $.ajax({
        type: "POST",
        url: "http://odbhrz.test/firms/locations",
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        dataType:'json',
        data:{
            val1:$('#localsID').val(),
            val2:$('#hidden').val()
        }
    }).done(function(data){
        $('#places').html(data[0]);
    });
}

function GetValue() {
    var x = $('#list_name').val();
    var z = $('#places');
    var val = $(z).find('option[value="' + x + '"]');

    var endval = val.attr('data_id');
    $('#data_id').attr("value", endval);

    var endval_ekatte = val.attr('data_ekatte');
    $('#data_ekatte').attr("value", endval_ekatte);

    var endval_tmv = val.attr('data_tmv');
    $('#data_tmv').attr("value", endval_tmv);

    var endval_pc = val.attr('data_pc');
    $('#postal_code').attr("value", endval_pc);

    var endval_oblast = val.attr('areas_id');
    $('#areas_ids').attr("value", endval_oblast);

    var endval_obstina = val.attr('district_id');
    $('#district_ids').attr("value", endval_obstina);


    if($(z).find('option[value="' + x + '"]').length > 0 ){
        alert(endval_tmv+' '+x+', Пощенски код:'+endval_pc+' ЕКАТТЕ:'+endval_ekatte);
    }
    else{
        $('#error').attr("value", 111);
        alert('Грешка! Избери населеното място от списъка!');
    }
}

function GetClick() {
    var x = $('#list_name').val();
    var z = $('#places');
    var val = $(z).find('option[value="' + x + '"]');

    var endval = val.attr('data_id');
    $('#data_id').attr("value", endval);

    var endval_ekatte = val.attr('data_ekatte');
    $('#data_ekatte').attr("value", endval_ekatte);

    var endval_tmv = val.attr('data_tmv');
    $('#data_tmv').attr("value", endval_tmv);

    var endval_pc = val.attr('data_pc');
    $('#postal_code').attr("value", endval_pc);

    var endval_oblast = val.attr('areas_id');
    $('#areas_ids').attr("value", endval_oblast);

    var endval_obstina = val.attr('district_id');
    $('#district_ids').attr("value", endval_obstina);


    if($(z).find('option[value="' + x + '"]').length === 0 ){
        $('#error').attr("value", 111);
    }

    ///////
    var a = $('#is_submit').val();
    var b = $('#hidden').val();
    if(a == b){
        $('#localsID').attr("value", $('#district_id').val());
    }

}