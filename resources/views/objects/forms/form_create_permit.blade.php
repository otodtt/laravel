<?php
if(isset($pharmacy->date_licence)){
    $date_licence = date('d.m.Y', $pharmacy->date_licence);
}
else{
    $date_licence = null;
}
?>
<hr class="my_hr_in"/>

<div class="container-fluid" >
    <div class="row">
        <div class="col-md-5" >
            <fieldset class="small_field"><legend class="small_legend">Номер на Разрешително</legend>
                <div class="col-md-6 col-md-6_my" >
                    <a id="myTooltip" title="Message"></a>
                    {!! Form::label('number_licence', 'Разрешително №', ['class'=>'my_labels control-label']) !!}
                    {!! Form::text('number_licence', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6,]) !!}
                </div>
                <div class="col-md-6" >
                    {!! Form::label('date_licence', 'Дата:', ['class'=>'my_labels ']) !!}
                    {!! Form::text('date_licence', $date_licence, ['class'=>'form-control form-control-my',
                    'id'=>'date_licence', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-7 ">
            <br/>
            <p class="description">Попълва се само номера, без индекса пред него! Индекса ще се полпълни автоматично.<br/>
                <span class="bold red">Пример!</span> Ако Удостоверението е "26 - 0001" изписва се само 1 или 0001 . Разрешителните нямат такъв индекс.
            </p>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

<div class="container-fluid" >
    <div class="row">
        <div class="col-md-9" >
            <fieldset class="small_field"><legend class="small_legend">Адрес на Аптеката</legend>
                <div class="col-md-6 col-md-6_my" >
                    @include('layouts.forms.towns')
                </div>
                <div class="col-md-6 my_float" >
                    {!! Form::label('address', 'Адрес на аптеката:', ['class'=>'my_labels']) !!}
                    {!! Form::text('address', null, ['class'=>'form-control form-control-my ', 'size'=>30, 'maxlength'=>250 ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-3 " >
            <p class="description" >Ако трябва да се добави населено място се обърнете към <span class="bold">Системния администратор!</span>
                <br/>Полетата са задължителни!</p>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>