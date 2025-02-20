<?php
if(Input::has('inspector_sort') || Input::has('abc')){
    $sort_abc = Input::get('abc');
    $sort_inspector_return =  Input::get('inspector_sort');
}
else{
    $sort_abc = $abc;
    if(isset($sort_inspector)){
        $sort_inspector_return =  $sort_inspector;
    }
    else{
        $sort_inspector_return =  0;
    }
}
?>
{!! Form::label('inspector_sort', ' Сортирай по:', ['class'=>'labels']) !!}
{!! Form::select('inspector_sort', $inspectors, $sort_inspector_return, ['class'=>'form-control inspector_sort']) !!}
&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
{!! Form::submit(' СОРТИРАЙ', array('class' => 'fa fa-search btn btn-primary my_btn ')) !!}
<input type="hidden" name="abc" value="{!! $sort_abc !!}">
<input type="hidden" name="year" value="{!! $year_now !!}">