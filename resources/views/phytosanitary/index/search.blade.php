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
{!! Form::label('search_value', ' Тъпси по № на Регистрация:', ['class'=>'labels']) !!}
{{--{!! Form::select('search', array(0 =>'', 1=>'№ на Регистрация', 2=>'ЕГН'), $search_ret, ['class'=>'form-control-my class_search']) !!}--}}
{!! Form::text('search_value', $search_value_ret, ['class'=>'form-control-my search_value', 'size'=>30]) !!}
{!! Form::submit(' ТЪРСИ', array('class' => 'fa fa-search btn btn-primary my_btn')) !!}