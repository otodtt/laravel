<?php
if (Input::has('start_year') || Input::has('end_year') || Input::has('for_sort') || Input::has('firm_sort')) {
    // $sort_abc = Input::get('abc');
    $start_years = Input::get('start_year');
    $end_years = Input::get('end_year');
    $sort_for_return = Input::get('for_sort');
    $sort_firm_return = Input::get('firm_sort');
} else {
    if (isset($years_start_sort) || isset($years_end_sort) || isset($sort_for)  || isset($sort_firm)) {
        $start_years = $years_start_sort;
        $end_years = $years_end_sort;
        $sort_for_return = $for_sort;
        $sort_firm_return = $sort_firm;
    } else {
        $start_years = 0;
        $end_years = 0;
        $sort_for_return = 0;
        $sort_firm_return = 0;
    }
}
if ((int) $start_years == 0) {
    $start_years = null;
}
if ((int) $end_years == 0) {
    $end_years = null;
}
?>
<div class="col-md-4">
    {!! Form::label('start_year', 'От дата: ', ['class' => 'labels']) !!}
    {!! Form::text('start_year', $start_years, [
        'class' => 'form-control form-control-my-search search_value',
        'size' => 10,
        'maxlength' => 10,
        'id' => 'start_year',
        'style' => 'height: 34px; width: 110px',
        'autocomplete' => 'off',
    ]) !!}
    &nbsp;&nbsp; | &nbsp;&nbsp;
    {!! Form::label('end_year', ' До дата: ', ['class' => 'labels']) !!}
    {!! Form::text('end_year', $end_years, [
        'class' => 'form-control form-control-my-search search_value',
        'size' => 30,
        'maxlength' => 10,
        'id' => 'end_year',
        'style' => 'height: 34px; width: 110px',
        'autocomplete' => 'off',
    ]) !!}
</div>
<div class="col-md-7">
    {!! Form::label('limit_sort', ' Сортирай:', ['class' => 'labels']) !!}


    <select name="firm_sort" id="search_firm" class="form-control form-control-my search_value"
        style="padding: 0 8px; width: 200px; display: inline-block;  margin-right: 30px;">
        <option value="0"> по фирма</option>
        @foreach ($firms as $k => $firm)
            <option value="{{ $k }}" {{ $sort_firm_return == $k ? 'selected' : '' }}>{{ strtoupper($firm) }}
            </option>
        @endforeach
    </select>

    <select name="for_sort" id="search_firm" class="form-control form-control-my search_value"
            style="padding: 0 8px; width: 200px; display: inline-block;  margin-right: 30px;">
        @foreach ($for_sort as $k => $for)
            <option value="{{ $k }}" {{ $sort_for_return == $k ? 'selected' : '' }}>{{ $for }}</option>
        @endforeach
    </select>
</div>
<input type="hidden" name="get_year" id="get_year" value="">
<div class="col-md-1" style="padding: 0; margin-top: 5px;">
    {!! Form::submit(' СОРТИРАЙ', ['class' => 'fa fa-search btn btn-primary my_btn ']) !!}
</div>
