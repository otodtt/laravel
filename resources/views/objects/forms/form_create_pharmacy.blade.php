<?php
if (isset($last_number[0]['number_licence'])){
    $last = $last_number[0]['number_licence'];
    $last_plus = $last_number[0]['number_licence']+1;
}  else {
    $last = '- няма такъв';
    $last_plus = 1;
}

if (isset($pharmacy->id) || isset($repository->id)  || isset($workshop->id)){
    $number_petition = '';
    $date_petition = '';
    $date_licence = '';
    $certificate = '';
    $date_certificate = '';
}  else {
    $number_petition = null;
    $date_petition = null;
    $date_licence = null;
    $certificate = null;
    $date_certificate = null;
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-5" >
            <fieldset class="small_field"><legend class="small_legend">Номер на заявление</legend>
                <div class="col-md-6 col-md-6_my" >
                    {!! Form::label('number_petition', 'Заявление №', ['class'=>'my_labels']) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold"> {{$index[0]['index_in']}} - </span>
                    {!! Form::text('number_petition', $number_petition, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
                    <span> {{$index[0]['in_second']}} </span>
                </div>
                <div class="col-md-6 " >
                    {!! Form::label('date_petition', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_petition', $date_petition, ['class'=>'form-control form-control-my',
                    'id'=>'date_petition', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-7 ">
            <p class="description">
                <br/>
                <span class="bold red">Важно!</span> Дата на Заявлението не може да е след дата на Удостоверението!
            </p>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

<div class="container-fluid" >
    <p class="bold "><span class="red"> Последно използван номер за Удостоверение e {!! $last !!}.</span>
        Използвай {!! $last_plus !!} !</p>
    <div class="row">
        <div class="col-md-5" >
            <fieldset class="small_field"><legend class="small_legend">Номер на Удостоверение</legend>
                <div class="col-md-6 col-md-6_my" >
                    {!! Form::label('number_licence', 'Удостоверение №', ['class'=>'my_labels']) !!}
                    <span class="bold"> {{$index[0]['area_id']}} - </span>
                    {!! Form::text('number_licence', $last_plus, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
                </div>
                <div class="col-md-6" >
                    {!! Form::label('date_licence', 'Дата:', ['class'=>'my_labels']) !!}
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

<div class="container-fluid" >
    <div class="row">
        <div class="col-md-9" >
            <fieldset class="small_field"><legend class="small_legend">Име и номер на СЕРТИФИКАТА на продавача</legend>
                <div class="col-md-6 col-md-6_my" >
                    {!! Form::label('seller', 'Трите имена:', ['class'=>'my_labels']) !!}
                    {!! Form::text('seller', null, ['class'=>'form-control form-control-my', 'size'=>35, 'maxlength'=>250 ]) !!}
                </div>
                <div class="col-md-6 my_float" >
                    {!! Form::label('certificate', 'Сертификат №:', ['class'=>'my_labels']) !!}
                    {!! Form::select('index_certificate', $only_id, null, ['id' =>'index_certificate',
                            'class' =>'index_certificate form-control form-control_my_id', ]) !!}
                    {!! Form::text('certificate', $certificate, ['class'=>'form-control form-control-my ', 'size'=>1, 'maxlength'=>5 ]) !!}
                    {!! Form::text('date_certificate', $date_certificate, ['class'=>'form-control form-control-my',
                            'id'=>'date_certificate', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-3 " >
            <br/>
            <p  >Полетата са задължителни!</p>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>

<div class="container-fluid" >
    <div class="row">
        <div class="col-md-5" >
            <fieldset class="small_field"><legend class="small_legend">Име на инспектора обработил документите</legend>
                {!! Form::label('inspector', 'Кой е обработил документите:', ['class'=>'my_labels']) !!}
                {!! Form::select('inspector', $inspectors, null, ['id' =>'id_user',
                        'class' =>'inspector form-control form-control_my_insp' ]) !!}
            </fieldset>
        </div>
        <div class="col-md-7 ">
            <br/>
            <p  >Задължително се избира инспектора обработил документите!</p>
        </div>
    </div>
</div>
<hr class="my_hr_in"/>
