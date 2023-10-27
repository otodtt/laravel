<?php
if(isset($report) && !empty($report)){
    $starting_time =  $report->starting_time;
    $final_hour=  $report->final_hour;
}
else{
    $starting_time = null;
    $final_hour = null;
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Номер и Дата на Доклада</legend>
                <div class="col-md-7 col-md-6_my" >
                    {!! Form::label('number_report', 'Доклад №', ['class'=>'my_labels']) !!}
                    {!! Form::text('number_report', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::label('starting_time', 'Дата и начален час:', ['class'=>'my_labels']) !!}
                    {!! Form::text('starting_time', $starting_time, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'starting_time', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off' ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::label('final_hour', 'Дата и краен час:', ['class'=>'my_labels']) !!}
                    {!! Form::text('final_hour', $final_hour, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'final_hour', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off'  ]) !!}
                </div>
                <div class="col-md-3 col-md-6_my"  >
                    <p class="description">Полетата са ЗАДЪЛЖИТЕЛНИ!</p>
                </div>
                <div class="col-md-2 col-md-6_my" >
                    <p class="error description">{{ $errors->first('number') }}</p>
                    <p class="error description">{{ $errors->first('date_protocol') }}</p>
                </div>
                <input type="hidden" name="is_all" value="1" >
            </fieldset>
        </div>
    </div>
</div>

