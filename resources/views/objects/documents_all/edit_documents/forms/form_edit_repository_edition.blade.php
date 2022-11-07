<?php
if (isset($repository->date_certificate)) {
    if ($repository->date_petition == 0) {
        $date_certificate = '';
    } else {
        $date_certificate = $repository->date_certificate;
    }
} else {
    $date_certificate = null;
}

$date_petition = date('d.m.Y', $repository->date_change);
$date_edition = date('d.m.Y', $repository->date_edition);

if (isset($repository->date_licence)) {
    $date_licence = date('d.m.Y', $repository->date_licence);
} else {
    $date_licence = null;
}

$number_petition = $repository->number_change;

if (isset($repository->certificate) && ($repository->certificate !== 0)) {
    $certificate = $repository->certificate;
} else {
    $certificate = '';
}
$raz_ud = 'Разрешително';

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <fieldset class="small_field">
                <?php
                if ($repository->number_licence <= 9 && $repository->raz_udost == 2) {
                    $number_view = '00' . $repository->number_licence;
                } elseif ($repository->number_licence <= 99 && $repository->raz_udost == 2) {
                    $number_view = '0' . $repository->number_licence;
                } else {
                    $number_view = $repository->number_licence;
                }
                ?>
                <legend class="small_legend">Номер на {{ $raz_ud }}</legend>
                    <span class="bold">{!! $raz_ud !!} № {{$repository->index_licence}} - {{$number_view}}
                        / {{date('d.m.Y',$repository->date_licence)}} г.</span>
            </fieldset>
        </div>
    </div>
</div>
<hr class="my_hr_in"/>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <fieldset class="small_field">
                <legend class="small_legend">Дата на Издание</legend>
                <div class="col-md-12 col-md-6_my">
                    {!! Form::label('date_edition', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_edition', $date_edition, ['class'=>'form-control form-control-my',
                    'id'=>'date_edition', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-7 ">
            <p class="description"><br/>Не променяй као не е необходимо!<br/>
                Номера на Изданието не може да се редактира</p>
        </div>
    </div>
</div>
<hr class="my_hr_in"/>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <fieldset class="small_field">
                <legend class="small_legend">Номер на заявление за Промяна</legend>
                <div class="col-md-6 col-md-6_my">
                    {!! Form::label('number_change', 'Заявление №', ['class'=>'my_labels']) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold"> {{$index[0]['index_in']}} - </span>
                    {!! Form::text('number_change', $number_petition, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
                    <span> {{$index[0]['in_second']}} </span>
                </div>
                <div class="col-md-6 ">
                    {!! Form::label('date_change', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_change', $date_petition, ['class'=>'form-control form-control-my',
                    'id'=>'date_petition', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-7 ">
            <p class="description"><br/> Номер и Дата на Заявлението за промяна в обстоятелствата са задължителни!</p>
        </div>
    </div>
</div>
<hr class="my_hr_in"/>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <fieldset class="small_field">
                <legend class="small_legend">Адрес на Аптеката</legend>
                <div class="col-md-6 col-md-6_my">
                    @include('layouts.forms.towns')
                </div>
                <div class="col-md-6 my_float">
                    {!! Form::label('address', 'Адрес на аптеката:', ['class'=>'my_labels']) !!}
                    {!! Form::text('address', null, ['class'=>'form-control form-control-my ', 'size'=>30, 'maxlength'=>250 ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-3 ">
            <p class="description">Ако трябва да се добави населено място се обърнете към <span class="bold">Системния администратор!</span>
                <br/>Полетата са задължителни!</p>
        </div>
    </div>
</div>
@if($repository->raz_udost == 2)
    <hr class="my_hr_in"/>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <fieldset class="small_field">
                    <legend class="small_legend">Име и номер на СЕРТИФИКАТА на продавача</legend>
                    <div class="col-md-6 col-md-6_my">
                        {!! Form::label('seller', 'Трите имена:', ['class'=>'my_labels']) !!}
                        {!! Form::text('seller', null, ['class'=>'form-control form-control-my', 'size'=>35, 'maxlength'=>250 ]) !!}
                    </div>
                    <div class="col-md-6 my_float">
                        {!! Form::label('certificate', 'Сертификат №:', ['class'=>'my_labels']) !!}
                        {!! Form::select('index_certificate', $only_id, null, ['id' =>'index_certificate',
                                'class' =>'index_certificate form-control form-control_my_id', ]) !!}
                        {!! Form::text('certificate', $certificate, ['class'=>'form-control form-control-my ', 'size'=>1, 'maxlength'=>5 ]) !!}
                        {!! Form::text('date_certificate', $date_certificate, ['class'=>'form-control form-control-my',
                                'id'=>'date_certificate', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                    </div>
                </fieldset>
            </div>
            <div class="col-md-3 ">
                <br/>

                <p>Полетата са задължителни!</p>
            </div>
        </div>
    </div>

    <hr class="my_hr_in"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <fieldset class="small_field">
                    <legend class="small_legend">Име на инспектора обработил документите</legend>
                    {!! Form::label('user_change', 'Кой е обработил документите:', ['class'=>'my_labels']) !!}
                    {!! Form::select('user_change', $inspectors, $repository->id_user_change, ['id' =>'id_user',
                            'class' =>'user_change form-control form-control_my_insp' ]) !!}
                </fieldset>
            </div>
            <div class="col-md-7 "><br/>

                <p class="description">Задължително се избира инспектора обработил документите!</p>
            </div>
        </div>
    </div>
    <hr class="my_hr_in"/>
@endif
<hr class="my_hr_in"/>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <fieldset class="small_field">
                <legend class="small_legend">Прекратяване на срока на {!! $raz_ud !!}</legend>
                {!! Form::label('active', 'Прекратяване:', ['class'=>'labels']) !!}
                &nbsp;<label>НЕ
                    {!! Form::radio('active', 0, true) !!}
                </label>&nbsp; | &nbsp;

                &nbsp;<label>ДА
                    {!! Form::radio('active', 1, false) !!}
                </label>
            </fieldset>
        </div>
        <div class="col-md-7 "><br/>

            <p class="description">Маркирай с ДА ако срока на Разрешително/Удостоверение е прекратен със Заявление
                за Промяна в обстоятелствата!</p>
        </div>
    </div>
</div>
<hr class="my_hr_in"/>