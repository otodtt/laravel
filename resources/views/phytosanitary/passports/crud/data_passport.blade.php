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
    {{--<div class="row">--}}
        {{--<div class="col-md-4" >--}}
            {{--<fieldset class="small_field"><legend class="small_legend">Номер и Дата на Заявлението</legend>--}}
                {{--<div class="col-md-12 col-md-6_my" >--}}
                    {{--{!! Form::label('number_petition', 'Заявление №', ['class'=>'my_labels']) !!}--}}
                    {{--{!! Form::text('number_petition', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}--}}
                    {{--&nbsp;&nbsp;&nbsp;&nbsp;--}}
                    {{--{!! Form::label('date_petition', 'Дата:', ['class'=>'my_labels']) !!}--}}
                    {{--{!! Form::text('date_petition', $date_petition, ['class'=>'form-control form-control-my date_certificate',--}}
                    {{--'id'=>'date_petition', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}--}}
                {{--</div>--}}
            {{--</fieldset>--}}
        {{--</div>--}}

        {{--<div class="col-md-8" >--}}
            {{--<fieldset class="small_field"><legend class="small_legend">Други данни на заявителя:</legend>--}}
                {{--<div class="col-md-6 col-md-6_my" >--}}
                    {{--{!! Form::label('is_farmer', 'Ако се знае ID на З Стопанин', ['class'=>'my_labels']) !!}--}}
                    {{--{!! Form::text('is_farmer', null, ['class'=>'form-control form-control-my', 'size'=>6, 'maxlength'=>10  ]) !!}--}}
                {{--</div>--}}
                {{--<div class="col-md-6 col-md-6_my" >--}}
                    {{--{!! Form::label('is_operator', 'Регистрационен № ако е ПО', ['class'=>'my_labels']) !!}--}}
                    {{--{!! Form::text('is_operator', null, ['class'=>'form-control form-control-my', 'size'=>6, 'maxlength'=>10 ]) !!}--}}
                {{--</div>--}}
            {{--</fieldset>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="row">
        <div class="col-md-4">
            <fieldset class="small_field"><legend class="small_legend">Количество</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::label('quantity', 'Коичество:', ['class'=>'my_labels']) !!}
                    {!! Form::text('quantity', null, ['class'=>'form-control form-control-my', 'size'=>6, 'maxlength'=>10, ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="bold">Избери Мярка!</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label >кг.
                        {!! Form::radio('quantity_type', 1, false, ['id'=>'kg']) !!}
                    </label>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;

                    <label >тона
                        {!! Form::radio('quantity_type', 2, false, ['id'=>'tone']) !!}
                    </label>
                    </label>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;

                    <label >бр.
                        {!! Form::radio('quantity_type', 3, false, ['id'=>'number']) !!}
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="col-md-4">
            <fieldset class="small_field"><legend class="small_legend">Ботанически вид</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::label('botanical', 'Б. вид:', ['class'=>'my_labels']) !!}
                    {!! Form::text('botanical', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>200, 'placeholder'=>'Домат семена/S.lycopersicum/' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-4">
            <fieldset class="small_field"><legend class="small_legend">Направление и Защитена зона кратко за таблицата</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::label('direction', 'Направ.:', ['class'=>'my_labels']) !!}
                    {!! Form::text('direction', null, ['class'=>'form-control form-control-my', 'size'=>20, 'maxlength'=>150, ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="bold">З. зона!</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label >НЕ
                        {!! Form::radio('protected', 0, false) !!}
                    </label>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;

                    <label >ДА
                        {!! Form::radio('protected', 1, false) !!}
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="col-md-12">
            <fieldset class="small_field"><legend class="small_legend">Предназначен за. Изписва се всичко!</legend>
                <div class="col-md-8 col-md-6_my" >
                    {!! Form::label('full_direction', 'Направ :', ['class'=>'my_labels']) !!}
                    {!! Form::text('full_direction', null, ['class'=>'form-control form-control-my', 'size'=>100, 'maxlength'=>150,
                     'placeholder'=>'ТАРА БИО ЕООД г. Панагюрище, ЕИК: 201464500']) !!}
                </div>
                <div class="col-md-4 col-md-6_my" >
                    <p>Попълва се всички данни необходими за Паспорта в полето "Предназначен за"</p>
                </div>
            </fieldset>
        </div>
    </div>
</div>