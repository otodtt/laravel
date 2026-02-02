<?php
if(isset($sort_years)){
    $sort_years_ret = $sort_years;
}
else{
    $sort_years_ret = null;
}
if (isset($sort_object) || isset($sort_type)){
    $sort_object_ret = $sort_object;
    $sort_type_ret = $sort_type;
}  else {
    $sort_object_ret = null;
    $sort_type_ret = null;
}
?>

{!! Form::label('years_sort', ' Направи справка за:', ['class'=>'labels']) !!}
{!! Form::select('years_sort', $years, $sort_years_ret, ['class'=>'form-control form-control-my-search inspector_sort ']) !!}
<span class="bold"> година!</span>&nbsp;
{!!Form::hidden('id_object', $sort_object_ret )!!}
{!!Form::hidden('type', $sort_type_ret )!!}

{!!Form::hidden('_token', csrf_token() )!!}
{!! Form::submit('Сортирай по година!', ['class'=>'fa btn btn-success my_btn']) !!}