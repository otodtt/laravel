<?php
if(isset($passport) && !empty($passport)){
    $date_petition = date('d.m.Y', $passport->date_petition);
}
else{
    $date_petition = null;
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-4" >
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

        <div class="col-md-8" >
            <fieldset class="small_field"><legend class="small_legend">Други данни на заявителя:</legend>
                <div class="col-md-6 col-md-6_my" >
                    {!! Form::label('is_farmer', 'Ако се знае ID на З Стопанин', ['class'=>'my_labels']) !!}
                    {!! Form::text('is_farmer', null, ['class'=>'form-control form-control-my', 'size'=>6, 'maxlength'=>10  ]) !!}
                </div>
                <div class="col-md-6 col-md-6_my" >
                    {!! Form::label('is_operator', 'Регистрационен № ако е ПО', ['class'=>'my_labels']) !!}
                    {!! Form::text('is_operator', null, ['class'=>'form-control form-control-my', 'size'=>6, 'maxlength'=>10 ]) !!}
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <fieldset class="small_field"><legend class="small_legend">Името на ЗС или Фирмата</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::label('manufacturer', 'Име:', ['class'=>'my_labels']) !!}
                    {!! Form::text('manufacturer', null, ['class'=>'form-control form-control-my', 'size'=>35, 'maxlength'=>150, 'placeholder'=>'Име' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-3">
            <fieldset class="small_field"><legend class="small_legend">Изписва се само града</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::label('city', 'Град:', ['class'=>'my_labels']) !!}
                    {!! Form::text('city', null, ['class'=>'form-control form-control-my', 'size'=>20, 'maxlength'=>150, 'placeholder'=>'гр. Хасково/с. Малево' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-3">
            <fieldset class="small_field"><legend class="small_legend">Изписва се адреса ако се знае</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::label('address', 'Адрес:', ['class'=>'my_labels']) !!}
                    {!! Form::text('address', null, ['class'=>'form-control form-control-my', 'size'=>35, 'maxlength'=>200, 'placeholder'=>'бул. "Освобождение" № 57 ' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-2">
            <fieldset class="small_field"><legend class="small_legend">ЕГН/ ЕИК Булстат ако се знаят</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::label('pin', 'ЕГН/ЕИК:', ['class'=>'my_labels']) !!}
                    {!! Form::text('pin', null, ['class'=>'form-control form-control-my', 'size'=>10, 'maxlength'=>10, ]) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>