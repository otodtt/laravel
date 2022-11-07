<?php
if(Input::has('areas_sort') || Input::has('years_sort') || Input::has('licence_sort') || Input::has('abc')){
    $sort_abc = Input::get('abc');
    $sort_areas = Input::get('areas_sort');
    $sort_years =  Input::get('years_sort');
    $sort_licence =  Input::get('licence_sort');
}
else{
    $sort_abc = $abc;
    if(isset($sort_areas) || isset($years_sort) || isset($licence_sort)){
        $sort_areas = $areas_sort;
        $sort_years = $years_sort;
        $sort_licence =  $licence_sort;
    }
    else{
        $sort_areas = Input::get('areas_sort');
        $sort_years =  Input::get('years_sort');
        $sort_licence =  Input::get('licence_sort');
    }
}
?>

{!! Form::label('areas_sort', 'В община:', ['class'=>'labels']) !!}
{!!Form::select('areas_sort',$districts, $sort_areas , ['id'=>'areas', 'class'=>'form-control form-control-my-search search_area'])!!}


@include('objects.forms.select_year')

<?php
if($sort_licence == null || $sort_licence == 0){
    $rz1 = false;
    $rz2 = false;
    $rz0 = true;
}
if($sort_licence == 1){
    $rz1 = true;
    $rz2 = false;
    $rz0 = false;
}
if($sort_licence == 2){
    $rz1 = false;
    $rz2 = true;
    $rz0 = false;
}
?>
<label><span>&nbsp;&nbsp;С Разрешително: </span>
    {!! Form::radio('licence_sort', 1, $rz1) !!}
</label>
<label><span>&nbsp;&nbsp;С Удостоверение: </span>
    {!! Form::radio('licence_sort', 2, $rz2) !!}
</label>
<label><span>&nbsp;&nbsp;Всички: </span>
    {!! Form::radio('licence_sort', 0, $rz0) !!}
</label>&nbsp;&nbsp;&nbsp;&nbsp;

{!!Form::hidden('_token', csrf_token() )!!}
{!!Form::hidden('abc', $sort_abc )!!}
{!! Form::submit('Сортирай!', ['class'=>'fa btn btn-success my_btn']) !!}