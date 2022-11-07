<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php
            if ($firm->type_firm == 1) {
                $et = 'ET';
            } else {
                $et = '';
            }
            if ($firm->type_firm == 2) {
                $ood = 'ООД';
            } elseif ($firm->type_firm == 3) {
                $ood = 'ЕООД';
            } elseif ($firm->type_firm == 4) {
                $ood = 'АД';
            } else {
                $ood = '';
            }
            ?>
            <span>Фирма <span class="bold">{!! $et !!} "{{$firm->name}}" {!! $ood !!}</span>&nbsp;&nbsp;
                     с ЕИК/БУЛСТАТ - <span class="bold">{{$firm->bulstat}}</span></span>
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
                    {!! Form::text('date_edition', date('d.m.Y', time()), ['class'=>'form-control form-control-my',
                    'id'=>'date_edition', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-3 ">
            <p class="description">Задължително се попълва датата на Издание!<br/>
                Не може да е преди датата на Заявлението!<br/>
                Номер на Издание ще се попълни автоматично.</p>
        </div>
        <div class="col-md-4">
        <span class="errors">
            @if ($errors->has('date_edition'))
                {{ $errors->first('date_edition') }}
            @endif
        </span>
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
                    {!! Form::text('number_change', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
                    <span> {{$index[0]['in_second']}} </span>
                </div>
                <div class="col-md-6 ">
                    {!! Form::label('date_change', 'Дата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_change', null, ['class'=>'form-control form-control-my',
                    'id'=>'date_petition', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-3 ">
            <p class="description"><br/> Номер и Дата на Заявлението за промяна в обстоятелствата са задължителни!
            </p>
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('number_change'))
                    {{ $errors->first('number_change') }}<br/>
                @endif
                @if ($errors->has('date_change'))
                    {{ $errors->first('date_change') }}<br/>
                @endif
            </span>
        </div>
    </div>
</div>
<hr class="my_hr_in"/>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <fieldset class="small_field">
                <legend class="small_legend">Къде е регистрирана фирмата</legend>
                @include('layouts.forms.locations')
            </fieldset>
        </div>
        <div class="col-md-4">
        <span class="errors">
            @if ($errors->has('error'))
                {{ $errors->first('error') }}<br/>
            @endif
            @if ($errors->has('list_name'))
                {{ $errors->first('list_name') }}<br/>
            @endif
        </span>
        </div>
    </div>
</div>
<hr class="my_hr_in"/>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <fieldset class="small_field">
                <legend class="small_legend">Адрес на фирмата</legend>
                {!! Form::label('address', 'Адрес на Фирмата:', ['class'=>'my_labels']) !!}
                {!! Form::text('address', null, ['class'=>'form-control form-control-my', 'size'=>40, 'maxlength'=>250 ]) !!}
            </fieldset>
        </div>
        <div class="col-md-3" style="padding-top: 25px">
            <p class="description">Адреса е задължителен!</p>
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('address'))
                    {{ $errors->first('address') }}<br/>
                @endif
            </span>
        </div>
    </div>
</div>

<hr class="my_hr_in"/>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <fieldset class="small_field">
                <legend class="small_legend">Представител (Управител) на фирмата</legend>
                @include('layouts.forms.pin')
            </fieldset>
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('owner'))
                    {{ $errors->first('owner') }}<br/>
                @endif
                @if ($errors->has('gender'))
                    {{ $errors->first('gender') }}<br/>
                @endif
                @if ($errors->has('pin'))
                    {{ $errors->first('pin') }}<br/>
                @endif
            </span>
        </div>
    </div>
</div>
<hr class="my_hr_in"/>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <fieldset class="small_field">
                <legend class="small_legend">Други данни</legend>
                @include('layouts.forms.phone')
            </fieldset>
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('phone'))
                    {{ $errors->first('phone') }}<br/>
                @endif
                @if ($errors->has('mobil'))
                    {{ $errors->first('mobil') }}<br/>
                @endif
                @if ($errors->has('email'))
                    {{ $errors->first('email') }}<br/>
                @endif
            </span>
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
                {!! Form::select('user_change', $inspectors, null, ['id' =>'id_user',
                        'class' =>'user_change form-control form-control_my_insp' ]) !!}
            </fieldset>
        </div>
        <div class="col-md-3 " style="padding-top: 25px">
            <p class="description">Избери инспектора обработил документите!</p>
        </div>
        <div class="col-md-4">
            <span class="errors">
                @if ($errors->has('user_change'))
                    {{ $errors->first('user_change') }}
                @endif
            </span>
        </div>
    </div>
</div>
<hr class="my_hr_in"/>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <fieldset class="small_field">
                <legend class="small_legend">Прекратяване на срока на всички обекти</legend>
                {!! Form::label('active', 'Прекратяване:', ['class'=>'labels']) !!}
                &nbsp;<label>НЕ
                    {!! Form::radio('active', 0, true) !!}
                </label>&nbsp; | &nbsp;

                &nbsp;<label>ДА
                    {!! Form::radio('active', 1, false) !!}
                </label>
            </fieldset>
        </div>
        <div class="col-md-7 ">
            <span class="errors">
                @if ($errors->has('active'))
                    {{ $errors->first('active') }}<br/>
                @endif
            </span>

            <p class="description " style="padding-top: 15px">Маркирай с ДА ако срока на Разрешително/Удостоверение е
                прекратен със Заявление
                за Промяна в обстоятелствата!<br/>
                <span class="bold red">В случая ще се прекратят всички Разрешителни или Удостоверения регистрирани на тази фирма!</span>
            </p>
        </div>
    </div>
</div>
<hr class="my_hr_in"/>