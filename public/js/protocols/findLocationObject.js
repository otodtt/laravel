/**
 * Created by DelT on 17.9.2016 г..
 */
$(document).ready(function(){
    $("#localsObject").change(load_locals_bottom);
    $("#submit").click(GetClickBottom);
});

function load_locals_bottom(){
    $.ajax({
        type: "POST",
        url: "http://93.183.140.127/protocols/locations",
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        dataType:'json',
        data:{
            val1:$('#localsObject').val()
        }
    }).done(function(data){
        $('#places_ob').html(data[0]);
    });
}

function GetValueBottom() {
    var x = $('#list_name_ob').val();
    var z = $('#places_ob');
    var y = $('#localsObject').val();

    var val = $(z).find('option[value="' + x + '"]');

    var endval = val.attr('data_id1');
    $('#data_id1').attr("value", endval);

    var endval_ekatte = val.attr('data_ekatte1');
    $('#data_ekatte1').attr("value", endval_ekatte);

    var endval_tmv = val.attr('data_tmv1');
    $('#data_tmv1').attr("value", endval_tmv);

    var endval_pc = val.attr('data_pc1');
    $('#postal_code1').attr("value", endval_pc);

    var endval_oblast = val.attr('areas_id2');
    $('#areas_id2').attr("value", endval_oblast);

    var endval_obstina = val.attr('district_id2');
    $('#district_id2').attr("value", endval_obstina);

    if(y == endval_obstina){
        alert(endval_tmv+' '+x+', Пощенски код:'+endval_pc+' ЕКАТТЕ:'+endval_ekatte);
    }
    else{
        $('#error1').attr("value", 111);
        alert('Грешка! Избери населеното място от списъка!');
    }
}

function GetClickBottom() {
    var x = $('#list_name_ob').val();
    var z = $('#places_ob');
    var val = $(z).find('option[value="' + x + '"]');

    if($(z).find('option[value="' + x + '"]').length > 0 ){
        var endval = val.attr('data_id1');
        $('#data_id1').attr("value", endval);

        var endval_tmv = val.attr('data_tmv1');
        $('#data_tmv1').attr("value", endval_tmv);
    }
    else{
        $('#error1').attr("value", 111);
    }
}
