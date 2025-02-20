<?php
if(isset($search_return)){
    $search_ret = $search_return;
}
else{
    $search_ret = null;
}
if(isset($search_value_return)){
    $search_value_ret = $search_value_return;
}
else{
    $search_value_ret = null;
}
?>
{!! Form::label('search_value', ' Тъпси по № на Паспорт:', ['class'=>'labels']) !!}
{!! Form::text('search_value', $search_value_ret, ['class'=>'form-control-my search_value', 'size'=>50]) !!}
{!! Form::submit(' ТЪРСИ', array('class' => 'fa fa-search btn btn-primary my_btn')) !!}