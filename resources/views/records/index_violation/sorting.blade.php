<?php
if(Input::has('start_year') || Input::has('end_year') || Input::has('ot_object') || Input::has('inspector_sort') || Input::has('abc')){
    $sort_abc = Input::get('abc');
    $start_years = Input::get('start_year');
    $end_years =  Input::get('end_year');
    $sort_object_return =  Input::get('ot_object');
    $sort_inspector_return =  Input::get('inspector_sort');
}
else{
    $sort_abc = $abc;
    if(isset($years_start_sort) || isset($years_end_sort) || isset($sort_object) || isset($sort_inspector)){
        $start_years = $years_start_sort;
        $end_years = $years_end_sort;
        $sort_object_return =  $sort_object;
        $sort_inspector_return =  $sort_inspector;
    }
    else{
        $start_years = 0;
        $end_years =  0;
        $sort_object_return =  0;
        $sort_inspector_return =  0;
    }
}
if((int)$start_years == 0){
    $start_years = null;
}
if((int)$end_years == 0){
    $end_years = null;
}
$select_violation = array(''=>'избери', 1 => 'С нарушение', 2 => 'С предписание', 3 => 'С издаден АКТ')
?>
{!!Form::hidden('abc', $sort_abc )!!}
{!!Form::hidden('start_year', $start_years )!!}
{!!Form::hidden('end_year', $end_years )!!}

{!! Form::label('ot_object', ' Сортирай:', ['class'=>'labels']) !!}
{!! Form::select('ot_object', $select_violation , $sort_object_return,
['id' => 'ot_object', 'class'=>'form-control form-control-my-search ot_object_sort ']) !!}

{!! Form::label('inspector_sort', ' Инспектор :', ['class'=>'labels']) !!}
{!! Form::select('inspector_sort', $inspectors, $sort_inspector_return, ['class'=>'form-control form-control-my-search inspector_sort ']) !!}


&nbsp;&nbsp;&nbsp;&nbsp;
{!!Form::hidden('_token', csrf_token() )!!}
{!! Form::submit('Сортирай!', ['class'=>'fa btn btn-success my_btn']) !!}