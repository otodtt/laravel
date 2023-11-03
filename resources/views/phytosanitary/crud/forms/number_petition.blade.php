<?php
if(isset($protocol) && !empty($protocol)){
    $date_petition = date('d.m.Y', $protocol->date_petition);
}
else{
    $date_petition = null;
}
?>
{{--Номер и Дата на Заявлението--}}
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Номер и Дата на Заявлението за Вписване</legend>
                <div class="col-md-4 col-md-6_my" >
                    {!! Form::label('number_petition', 'Заявление №', ['class'=>'my_labels']) !!}
                    {!! Form::text('number_petition', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6, 'id'=>'number_petition' ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::label('date_petition', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_petition', $date_petition, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date_petition', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off' ]) !!}
                </div>
                <div class="col-md-3 col-md-6_my"  >
                    <p class="description" autocomplete="off">Полетата са ЗАДЪЛЖИТЕЛНИ!</p>
                </div>
                <div class="col-md-4 col-md-6_my" >
                    <p class="error description">{{ $errors->first('number_petition') }}</p>
                    <p class="error description">{{ $errors->first('date_petition') }}</p>
                </div>
            </fieldset>
        </div>
    </div>
</div>