<?php
if (Input::has('initial_year') || Input::has('final_year') || Input::has('crop_sort') ) {
    $initial_year = Input::get('initial_year');
    $final_year = Input::get('final_year');
    $sort_crop_return = Input::get('crop_sort');
} else {
    if (isset($years_start_sort) || isset($years_end_sort) || isset($sort_crop) ) {
        $initial_year = $years_start_sort;
        $final_year = $years_end_sort;
        $sort_crop_return = $sort_crop;
    } else {
        $initial_year = 0;
        $final_year = 0;
        $sort_crop_return = 0;
    }
}
if ((int)$initial_year == 0) {
    $initial_year = null;
}
if ((int) $final_year == 0) {
    $final_year = null;
}
?>
<div class="col-md-6" style="padding: 0;">
    {!! Form::label('initial_year', 'От дата: ', ['class' => 'labels']) !!}
    {!! Form::text('initial_year', $initial_year, [
        'class' => 'form-control form-control-my-search search_value',
        'size' => 10,
        'maxlength' => 10,
        'id' => 'start_year',
        'style' => 'height: 34px; width: 100px',
        'autocomplete' => 'off',
    ]) !!}
    &nbsp;&nbsp; | &nbsp;&nbsp;
    {!! Form::label('final_year', ' До дата: ', ['class' => 'labels']) !!}
    {!! Form::text('final_year', $final_year, [
        'class' => 'form-control form-control-my-search search_value',
        'size' => 30,
        'maxlength' => 10,
        'id' => 'end_year',
        'style' => 'height: 34px; width: 100px',
        'autocomplete' => 'off',
    ]) !!}
</div>
<div class="col-md-4"  style="padding: 0;">
    {{--{!! Form::label('crop_sort', ' Сортирай:', ['class' => 'labels']) !!}--}}
    <select name="crop_sort" id="crop_sort" class="localsID form-control"
        style="display: inline-block; width: 150px; margin-right: 30px;">
        <option value="0">по стока</option>
        @foreach ($lists as $k => $li)
            <option value="{{ $k }}" {{ $sort_crop_return == $k ? 'selected' : '' }}> {{ $li }}
            </option>
        @endforeach
    </select>

</div>
<div class="col-md-2" style="padding: 0; margin-top: 5px;">
    {!! Form::submit(' СОРТИРАЙ', ['class' => 'fa fa-search btn btn-primary my_btn ']) !!}
</div>
