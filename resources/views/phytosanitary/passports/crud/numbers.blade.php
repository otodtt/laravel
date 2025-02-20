<?php
if(isset($permits) && !empty($permits)){
    $date_petition = date('d.m.Y', $permits->date_petition);
    $start_date = date('d.m.Y', $permits->start_date);
    $end_date = date('d.m.Y', $permits->end_date);
}
else{
    $date_petition = null;
    $start_date = null;
    $end_date = null;
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-6" >
            <fieldset class="small_field"><legend class="small_legend">Номер и Дата на Заявлението</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::label('number_petition', 'Заявление №', ['class'=>'my_labels']) !!}
                    {!! Form::text('number_petition', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::label('date_petition', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_petition', $date_petition, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date_petition', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>

        <div class="col-md-6" >
            <fieldset class="small_field"><legend class="small_legend">Период на провеждане на пръскането:</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::label('start_date', 'От Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('start_date', $start_date, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'start_date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::label('end_date', 'До Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('end_date', $end_date, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'end_date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>