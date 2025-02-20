<?php
if(isset($operator) && !empty($operator)){
    //print_r($operator->registration_date);
   if($operator->registration_date == 0 && $operator->date_petition == 0){
        $date_petition = null;
        $update_date = null;
        $registration_date = null;
    }
    else {
        $date_petition = date('d.m.Y', $operator->date_petition);
        $update_date = date('d.m.Y', $operator->update_date);
        $registration_date = date('d.m.Y', $operator->registration_date);
    }

}
else{
    $date_petition = null;
    $update_date = null;
    $registration_date = null;
}

?>
{{--Номер и Дата на Заявлението--}}
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Номер и Дата на Заявлението за Вписване</legend>
                <div class="col-md-6 col-md-6_my" >
                    {!! Form::label('number_petition', 'Заявление №', ['class'=>'my_labels']) !!}
                    {!! Form::text('number_petition', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6, 'id'=>'number_petition' ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::label('date_petition', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_petition', $date_petition, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date_petition', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off' ]) !!}
                </div>
                <div class="col-md-6 col-md-6_my"  >
                    <span>Ако има актуализация</span>
                    {!! Form::label('update_date', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('update_date', $update_date, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'update_date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off' ]) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Дата на Регистрационния номер</legend>
                <div class="col-md-6 col-md-6_my" >
                    <span>Регистрационния номер се добавя автоматично</span>
                    {!! Form::label('registration_date', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('registration_date', $registration_date, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'registration_date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off' ]) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>

{{--ДРУГИ ДАННИ--}}
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">ДРУГИ ДАННИ</legend>
                <h4>Полетата са задължителни за да се попълни таблицата</h4>
                <hr class="my_hr_in"/>
                <div class="row">
                    <div class="col-md-4" >
                        {!! Form::label('activity', 'Дейност/и по чл. 65(1)', ['class'=>'my_labels']) !!}
                        <br>
                        {!! Form::text('activity', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}
                    </div>
                </div>
                <hr class="my_hr_in"/>
                <div class="row">
                    <div class="col-md-4" >
                        {!! Form::label('derivation', 'Произход на растенията', ['class'=>'my_labels']) !!}
                        <br>
                        {!! Form::text('derivation', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}
                    </div>
                    <div class="col-md-4" >
                        {!! Form::label('products', 'Естество (изписват се растенията)', ['class'=>'my_labels']) !!}
                        <br>
                        {!! Form::text('products', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}
                    </div>
                    <div class="col-md-4" >
                        {!! Form::label('purpose', 'Предназначение ', ['class'=>'my_labels']) !!}
                        <br>
                        {!! Form::text('purpose', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}
                    </div>
                </div>
                <hr class="my_hr_in"/>
                <div class="row">
                    <div class="col-md-8" >
                        {!! Form::label('room', 'Адрес на помещенията', ['class'=>'my_labels']) !!}
                        <br>
                        {!! Form::text('room', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}
                    </div>
                    <div class="col-md-4" >
                        {!! Form::label('action', 'Дейност/и по чл. 66(2) ', ['class'=>'my_labels']) !!}
                        <br>
                        {!! Form::text('action', null, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>20 ]) !!}
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>