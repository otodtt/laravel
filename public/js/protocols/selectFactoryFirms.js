$(document).ready(function(){
    $("#select_factory").change(function(){
        if(this.value > 0){
            $.ajax({
                type: "POST",
                url: "http://93.183.140.127/factory/factory",
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
                dataType:'json',
                data:{
                    id:$('#select_factory').val()
                }
            }).done(function(data){
                $('#firm_select').html(data[0]);
            });
        }
        else{
            $('#firm_select').html(
                '<h3>ПЪРВО ИЗБЕРИ ФИРМА ПРОИЗВОДИТЕЛ!</h3>' +
                '<input type="hidden" value="0" name="id_factory" id="id_factory">'
            );
        }
    });
});
