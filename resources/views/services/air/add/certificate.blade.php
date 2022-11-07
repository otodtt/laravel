<?php
if(isset($permits) && !empty($permits)){
    if($permits->date_invoice == 0){
        $date_invoice = null;
    }
    else{
        $date_invoice = date('d.m.Y', $permits->date_invoice);
    }
}
else{
    $date_invoice = null;
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Данни на лицето дало предписанието</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::label('agronomist', 'Трите имена:', ['class'=>'my_labels']) !!}
                    {!! Form::text('agronomist', null, ['class'=>'form-control form-control-my', 'size'=>45, 'maxlength'=>500 ]) !!}
                    &nbsp;
                    {!! Form::label('certificate', 'Номер на сертификат:', ['class'=>'my_labels']) !!}
                    {!! Form::text('certificate', null, ['class'=>'form-control form-control-my',
                    'id'=>'certificate', 'size'=>45, 'maxlength'=>500 ]) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>
<hr class="my_hr"/>

<div class="row">
    <div class="col-md-6" >
        &nbsp;&nbsp;&nbsp;
        {!! Form::label('inspector', 'Кой е изготвил документите за Разрешителното:', ['class'=>'my_labels']) !!}
        {!! Form::select('inspector', $inspectors, null, ['id' =>'inspector',
                'class' =>'inspector form-control form-control_my_insp' ]) !!}
    </div>
    <div class="col-md-6">
        {!! Form::label('invoice', 'Фактура №', ['class'=>'my_labels']) !!}
        {!! Form::text('invoice', null, ['class'=>'form-control form-control-my', 'size'=>7, 'maxlength'=>15 ]) !!}
        &nbsp;&nbsp;&nbsp;&nbsp;
        {!! Form::label('date_invoice', 'Дата:', ['class'=>'my_labels']) !!}
        {!! Form::text('date_invoice', $date_invoice, ['class'=>'form-control form-control-my date_certificate',
        'id'=>'date_invoice', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
    </div>
</div>