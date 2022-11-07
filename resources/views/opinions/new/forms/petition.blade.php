<?php
if(isset($opinion)){
    $date_petition = date('d.m.Y', $opinion->date_petition);
    $date_invoice = date('d.m.Y', $opinion->invoice_date);
}
else{
    $date_petition = null;
    $date_invoice = null;
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-6" >
            <fieldset class="small_field"><legend class="small_legend">Номер и дата на заявление</legend>
                <div class="col-md-6 col-md-6_my" >
                    {!! Form::label('number_petition', 'Заявление №', ['class'=>'my_labels']) !!}
                    {!! Form::text('number_petition', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
                </div>
                <div class="col-md-6 " >
                    {!! Form::label('date_petition', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_petition', $date_petition, ['class'=>'form-control form-control-my',
                    'id'=>'date_petition', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-6" >
            <fieldset class="small_field"><legend class="small_legend">Номер и дата на фактура</legend>
                <div class="col-md-6 col-md-6_my" >
                    {!! Form::label('invoice', 'Фактура №', ['class'=>'my_labels']) !!}
                    {!! Form::text('invoice', null, ['class'=>'form-control form-control-my', 'size'=>10, 'maxlength'=>15 ]) !!}
                </div>
                <div class="col-md-6 " >
                    {!! Form::label('invoice_date', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('invoice_date', $date_invoice, ['class'=>'form-control form-control-my',
                    'id'=>'date_invoice', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>