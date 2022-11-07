<?php
if(isset($firm)){
    if($firm== 1){
        $fl = true;
        $et = false;
        $ood = false;
        $eod = false;
        $ad = false;
        $coo = false;
        $dr = false;
    }
    elseif($firm == 2){
        $fl = false;
        $et = true;
        $ood = false;
        $eod = false;
        $ad = false;
        $coo = false;
        $dr = false;
    }
    elseif($firm == 3){
        $fl = false;
        $et = false;
        $ood = true;
        $eod = false;
        $ad = false;
        $coo = false;
        $dr = false;
    }
    elseif($firm == 4){
        $fl = false;
        $et = false;
        $ood = false;
        $eod = true;
        $ad = false;
        $coo = false;
        $dr = false;
    }
    elseif($firm == 5){
        $fl = false;
        $et = false;
        $ood = false;
        $eod = false;
        $ad = true;
        $coo = false;
        $dr = false;
    }
    elseif($firm == 6){
        $fl = false;
        $et = false;
        $ood = false;
        $eod = false;
        $ad = false;
        $coo = true;
        $dr = false;
    }
    elseif($firm == 7){
        $fl = false;
        $et = false;
        $ood = false;
        $eod = false;
        $ad = false;
        $coo = false;
        $dr = true;
    }
    else{
        $fl = false;
        $et = false;
        $ood = false;
        $eod = false;
        $ad = false;
        $coo = false;
        $dr = false;
    }
}
else{
    $fl = false;
    $et = false;
    $ood = false;
    $eod = false;
    $ad = false;
    $coo = false;
    $dr = false;
}
if(isset($gender)){
    if(strlen($gender) == 4){
        $male = true;
        $female = false;
    }
    elseif(strlen($gender) == 6){
        $male = false;
        $female = true;
    }
    else{
        $male = false;
        $female = false;
    }
}
else{
    $male = false;
    $female = false;
}
?>
<div class="col-md-12 col-md-6_my" >
    @if($firm == 1)
        <div id="person_data" class="">
            <div class="col-md-8 col-md-6_my" >
                <label >ЧЗС
                    {!! Form::radio('type_firm', 1, true) !!}
                </label>&nbsp; | &nbsp;

                {!! Form::label('name', 'Име на ЧЗС: &nbsp;', ['class'=>'labels']) !!}
                {!! Form::text('name', $name, ['class'=>'form-control form-control-my', 'maxlength'=>250, 'size'=>28 ]) !!}
                &nbsp;
                <label class="labels"><span>Мъж: </span>
                    {!! Form::radio('gender', 'male', $male) !!}
                </label>&nbsp;&nbsp;|
                <label class="labels"><span>&nbsp;&nbsp;Жена: </span>
                    {!! Form::radio('gender', 'female', $female) !!}
                </label>&nbsp;&nbsp;|
                {!! Form::label('pin', 'ЕГН:', ['class'=>'labels']) !!}
                {!! Form::text('pin', $pin, ['class'=>'form-control form-control-my', 'maxlength'=>10, 'size'=>10, 'id'=>'pin' ]) !!}
            </div>
        </div>
    @else
        <div class="col-md-8 col-md-6_my inspectors_divs border_divs" >
            <label >ЕТ
                {!! Form::radio('type_firm', 2, $et) !!}
            </label>&nbsp; | &nbsp;

            <label >ООД
                {!! Form::radio('type_firm', 3, $ood) !!}
            </label>&nbsp; | &nbsp;

            <label >ЕООД
                {!! Form::radio('type_firm', 4, $eod) !!}
            </label>&nbsp; | &nbsp;

            <label >АД
                {!! Form::radio('type_firm', 5, $ad) !!}
            </label>&nbsp; | &nbsp;

            <label >КООПЕРАЦИЯ
                {!! Form::radio('type_firm', 6, $coo) !!}
            </label>&nbsp; | &nbsp;

            <label >Друго
                {!! Form::radio('type_firm', 7, $dr) !!}
            </label>&nbsp;
        </div>
        <div class="col-md-4 col-md-6_my inspectors_divs">
            <p class="description" >
                &nbsp;&nbsp;&nbsp;<span class="bold">Задължително!</span> Избери една от следните възможности!<br>
                &nbsp;&nbsp;&nbsp;С "Друго" може да бъде Община, друга служба и т.н.
            </p>
        </div>

        <div id="firm_data" class="">
            <div class="col-md-12 col-md-6_my inspectors_divs border_divs" >
                <div class="col-md-8 col-md-6_my" >
                    <p class="description" >Изписва се само името на фирмата без ЕТ, ООД или ЕООД! Минимален брой символи - 4.<br/>
                        Ако е избрано <span class="bold">"Друго" или "КООПЕРАЦИЯ "</span> тогава се изписва със съкращението - ЗПК Надежда</p>
                    {!! Form::label('name', ' Име на Фирмата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('name', $name_firm, ['class'=>'form-control form-control-my', 'size'=>40, 'maxlength'=>250 ]) !!}

                    {!! Form::label('bulstat', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ЕИК/Булстат:', ['class'=>'my_labels']) !!}
                    {!! Form::text('bulstat', $eik, ['class'=>'form-control form-control-my', 'maxlength'=>13, 'size'=>10 ]) !!}
                </div>
            </div>

            <div class="col-md-8 col-md-6_my" >
                {!! Form::label('owner', 'Представител:&nbsp;&nbsp;&nbsp; &nbsp; ', ['class'=>'labels']) !!}
                {!! Form::text('owner', null, ['class'=>'form-control form-control-my', 'maxlength'=>250, 'size'=>30 ]) !!}
                &nbsp;
                <label class="labels"><span>Мъж: </span>
                    {!! Form::radio('gender_owner', 'male', false) !!}
                </label>&nbsp;&nbsp;|
                <label class="labels"><span>&nbsp;&nbsp;Жена: </span>
                    {!! Form::radio('gender_owner', 'female', false) !!}
                </label>&nbsp;&nbsp;|
                {!! Form::label('pin_owner', 'ЕГН:', ['class'=>'labels']) !!}
                {!! Form::text('pin_owner', null, ['class'=>'form-control form-control-my', 'maxlength'=>10, 'size'=>10, 'id'=>'pin' ]) !!}&nbsp;&nbsp;

                <label class="labels"><span>&nbsp;&nbsp;Без ЕГН: </span>
                    {!! Form::radio('gender_owner', 'n', false) !!}
                </label>
            </div>
            <div class="col-md-4 col-md-6_my" >
                <p class="description" >
                    &nbsp;&nbsp;&nbsp;<span class="red bold"><i class="fa fa-warning"></i> ВАЖНО!!!</span> Ако не се знае ЕГН-то, маркирай <span class="bold">"Без ЕГН"</span>!
                </p>
            </div>
        </div>
    @endif
</div>