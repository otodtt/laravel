$(document).ready(function(){
    $("#localsID").change(load_locals);
    $("#submit").click(GetClick);
});

function load_locals(){
    $.ajax({
        type: "POST",
        url: "http://93.183.140.127/pharmacies/locations",
        headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
        dataType:'json',
        data:{
            val1:$('#localsID').val()
        }
    }).done(function(data){
        $('#places').html(data[0]);
    });
}

function GetValue() {
    var x = $('#list_name').val();
    var z = $('#places');
    var y = $('#localsID').val();

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
    $('#areas_id').attr("value", endval_oblast);

    var endval_obstina = val.attr('district_id');
    $('#district_id').attr("value", endval_obstina);

    if(y == endval_obstina){
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

    if($(z).find('option[value="' + x + '"]').length > 0 ){
        var endval = val.attr('data_id');
        $('#data_id').attr("value", endval);

        var endval_tmv = val.attr('data_tmv');
        $('#data_tmv').attr("value", endval_tmv);
    }
    else{
        $('#error').attr("value", 111);
    }
}