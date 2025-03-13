<?php
if(!isset($reports)){
    $return_number = null;
    $return_date = null;
}
else{
    $return_number = $reports->number;
    $return_date = date('d.m.Y', $reports->date_report);
}
//echo ($return_number);
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Номер и Дата на Доклада</legend>
                <div class="col-md-4 col-md-6_my" >
                    {!! Form::label('number', 'Доклад №', ['class'=>'my_labels']) !!}
                    {!! Form::text('number', $return_number, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::label('date_report', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_report', $return_date, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date_report', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
                <div class="col-md-3 col-md-6_my"  >
                    <p class="description">Полетата са ЗАДЪЛЖИТЕЛНИ!</p>
                </div>
                <div class="col-md-4 col-md-6_my" >
                    <p class="error description">{{ $errors->first('number') }}</p>
                    <p class="error description">{{ $errors->first('date_protocol') }}</p>
                </div>
            </fieldset>
        </div>
    </div>
</div>

