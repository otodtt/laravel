<?php
if(!isset($protocols)){
    $return_one = true;
    $return_two = false;
}
else{
    if($protocols->type_check == 1){
        $return_one = true;
        $return_two = false;
    }
    if($protocols->type_check == 2){
        $return_one = false;
        $return_two = true;
    }
}
?>

<span class="bold">ВИД НА ПРОВЕРКАТА:</span>&nbsp;&nbsp;
<label class="type_check"><span>НА ТЕРЕН: </span>
    {!! Form::radio('type_check', 1, $return_one) !!}
</label>&nbsp;&nbsp;|
<label class="type_check"><span>&nbsp;&nbsp;ДОКУМЕНТАЛНА: </span>
    {!! Form::radio('type_check', 2, $return_two) !!}
</label>