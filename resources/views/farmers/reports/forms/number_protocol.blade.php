<?php
if(isset($protocol) && !empty($protocol)){
    $date_protocol = date('d.m.Y', $protocol->date_protocol);
}
else{
    $date_protocol = null;
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Номер и Дата на Протокола</legend>
                <div class="col-md-4 col-md-6_my" >
                    {!! Form::label('number_protocol', 'Протокол №', ['class'=>'my_labels']) !!}
                    {!! Form::text('number_protocol', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::label('date_protocol', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_protocol', $date_protocol, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
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

