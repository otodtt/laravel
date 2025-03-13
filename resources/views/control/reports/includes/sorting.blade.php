<?php
if(Input::has('start_year') || Input::has('end_year') || Input::has('ot_object') || Input::has('areas_sort')
        || Input::has('inspector_sort') || Input::has('abc') || Input::has('assay_sort')){
    $sort_abc = Input::get('abc');
    $start_years = Input::get('start_year');
    $end_years =  Input::get('end_year');
    $sort_object_return =  Input::get('ot_object');
    $sort_areas_return =  Input::get('areas_sort');
    $sort_inspector_return =  Input::get('inspector_sort');
    $sort_assay_return =  Input::get('assay_sort');
}
else{
    $sort_abc = $abc;
    if(isset($years_start_sort) || isset($years_end_sort) || isset($sort_object) || isset($sort_areas)
            || isset($sort_inspector) || isset($sort_assay)){
        $start_years = $years_start_sort;
        $end_years = $years_end_sort;
        $sort_object_return =  $sort_object;
        $sort_areas_return =  $sort_areas;
        $sort_inspector_return =  $sort_inspector;
        $sort_assay_return =  $sort_assay;
    }
    else{
        $start_years = 0;
        $end_years =  0;
        $sort_object_return =  0;
        $sort_areas_return =  0;
        $sort_inspector_return =  0;
        $sort_assay_return =  0;
    }
}
if((int)$start_years == 0){
    $start_years = null;
}
if((int)$end_years == 0){
    $end_years = null;
}
?>
{!!Form::hidden('abc', $sort_abc )!!}
{!!Form::hidden('start_year', $start_years )!!}
{!!Form::hidden('end_year', $end_years )!!}

{!! Form::label('ot_object', ' Обект:', ['class'=>'labels']) !!}
{!! Form::select('ot_object', array(0 => 'Избери обект', 1 => 'Аптеки', 2 => 'Складове', 3 => 'Цехове'), $sort_object_return,
['id' => 'ot_object', 'class'=>'form-control form-control-my-search ot_object_sort ']) !!}

{!! Form::label('areas_sort', 'В община:', ['class'=>'labels']) !!}
{!!Form::select('areas_sort',$areas, $sort_areas_return, ['id'=>'areas_sort', 'class'=>'form-control form-control-my-search area_sort ' ])!!}

{!! Form::label('inspector_sort', ' Инспектор :', ['class'=>'labels']) !!}
{!! Form::select('inspector_sort', $inspectors, $sort_inspector_return, ['class'=>'form-control form-control-my-search inspector_sort ']) !!}


<?php
if($sort_assay_return == null || $sort_assay_return == 0){
    $rz1 = false;
    $rz2 = false;
    $rz3 = false;
    $rz0 = true;
}
if($sort_assay_return == 1){
    $rz1 = true;
    $rz2 = false;
    $rz3 = false;
    $rz0 = false;
}
if($sort_assay_return == 2){
    $rz1 = false;
    $rz2 = true;
    $rz3 = false;
    $rz0 = false;
}
if($sort_assay_return == 3){
    $rz1 = false;
    $rz2 = false;
    $rz3 = true;
    $rz0 = false;
}
?>
<label><span>&nbsp;&nbsp;Проба ПРЗ: </span>
    {!! Form::radio('assay_sort', 1, $rz1) !!}
</label>
<label><span>&nbsp;&nbsp;Проба ТОР: </span>
    {!! Form::radio('assay_sort', 2, $rz2) !!}
</label>
<label><span>&nbsp;&nbsp;С Нарушение: </span>
    {!! Form::radio('assay_sort', 3, $rz3) !!}
</label>
<label><span>&nbsp;&nbsp;Всички: </span>
    {!! Form::radio('assay_sort', 0, $rz0) !!}
</label>&nbsp;&nbsp;&nbsp;&nbsp;

{!!Form::hidden('_token', csrf_token() )!!}
{!! Form::submit('Сортирай!', ['class'=>'fa btn btn-success my_btn']) !!}