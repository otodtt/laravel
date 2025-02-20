<?php
if(Input::has('start_year') || Input::has('end_year') || Input::has('deletion') ){
    $start_years = Input::get('start_year');
    $end_years =  Input::get('end_year');
    $deletion_return =  Input::get('deletion');
}
else{
    if(isset($years_start_sort) || isset($years_end_sort) || isset($deletion_sort) ){
        $start_years = $years_start_sort;
        $end_years = $years_end_sort;
        $deletion_return =  $deletion_sort;
    }
    else{
        $start_years = 0;
        $end_years =  0;
        $deletion_return =  0;
    }
}
if((int)$start_years == 0){
    $start_years = null;
}
if((int)$end_years == 0){
    $end_years = null;
}
?>
<div  class="col-md-6">
    {!! Form::label('start_year', 'От дата: ', ['class'=>'labels']) !!}
    {!! Form::text('start_year', $start_years, ['class'=>'form-control form-control-my-search search_value', 'size'=>30, 'maxlength'=>10,'id'=>'start_year']) !!}
    &nbsp;&nbsp; | &nbsp;&nbsp;
    {!! Form::label('end_year', ' До дата: ', ['class'=>'labels']) !!}
    {!! Form::text('end_year', $end_years, ['class'=>'form-control form-control-my-search search_value', 'size'=>30, 'maxlength'=>10, 'id'=>'end_year']) !!}
</div>
<div class="col-md-6">
    {!! Form::select('deletion', array(0 =>'Избери!', 1=>'С Регистрация', 2=>'Заличена Регистрация', 3=>'Без Рег. Номер', 4=>'Не завършени'),
                           $deletion_return, ['class'=>'form-control limit_sort_class', 'id'=>'deletion']) !!}
    {!! Form::submit(' СОРТИРАЙ', array('class' => 'fa fa-search btn btn-primary my_btn ')) !!}
    {{--<input type="hidden" name="abc" value="{!! $sort_abc !!}">--}}
</div>