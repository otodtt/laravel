<?php
if(isset($firm)){
    if($firm == 1){
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
////
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
////
if(isset($name)){
    $name_return = $name;
}
else{
    $name_return = null;
}
////
if(isset($name_firm)){
    $firm_return = $name_firm;
}
else{
    $firm_return = null;
}
////
if(isset($eik)){
    $eik_return = $eik;
}
else{
    $eik_return = null;
}
////
if(isset($pin)){
    $pin_return = $pin;
}
else{
    $pin_return = null;
}
?>
<div class="col-md-8 col-md-6_my inspectors_divs border_divs" >
    <label >ЧЗС
        {!! Form::radio('firm_search', 1, $fl) !!}
    </label>&nbsp; | &nbsp;

    <label >ЕТ
        {!! Form::radio('firm_search', 2, $et) !!}
    </label>&nbsp; | &nbsp;

    <label >ООД
        {!! Form::radio('firm_search', 3, $ood) !!}
    </label>&nbsp; | &nbsp;

    <label >ЕООД
        {!! Form::radio('firm_search', 4, $eod) !!}
    </label>&nbsp; | &nbsp;

    <label >АД
        {!! Form::radio('firm_search', 5, $ad) !!}
    </label>&nbsp; | &nbsp;

    <label >КООПЕРАЦИЯ
        {!! Form::radio('firm_search', 6, $coo) !!}
    </label>&nbsp; | &nbsp;

    <label >Друго
        {!! Form::radio('firm_search', 7, $dr) !!}
    </label>&nbsp;
</div>
<div class="col-md-4 col-md-6_my inspectors_divs">
    <p class="description" >
        &nbsp;&nbsp;&nbsp;<span class="bold">Задължително!</span> Избери една от следните възможности!
    </p>
</div>

<div class="col-md-12 col-md-6_my " >
    <div class="col-md-8 col-md-6_my" style="float: left" >
        <p class="description" >Изписва се само името на фирмата без ЕТ, ООД или ЕООД! Минимален брой символи - 4.<br/>
            Ако е избрано <span class="bold">"Друго" или "КООПЕРАЦИЯ "</span> тогава се изписва със съкращението - ЗПК Надежда</p>
    </div>

    <div class="col-md-4 col-md-6_my "  style="float: right" >
        <p class="description" >ЗАДЪЛЖИТЕЛНО попълнете коректно данните!<br/>
            1. Ако има съвпадение, уверете се, че това е търсения ЗС и натисни "ДОБАВИ ПРОТОКОЛ ЗА ТОЗИ ЗС!".<br/>
            2. Ако няма намерен резултат, но ЕГН-то в вярно натисни "ДОБАВИ ПРОТОКОЛ"
        </p>
    </div>

    <div class="col-md-8 col-md-6_my " style="float: left" >
        <div class="col-md-12 col-md-6_my hidden" id="eik_div">
            {!! Form::label('firm_name_search', ' Име на Фирма:', ['class'=>'my_labels']) !!}
            {!! Form::text('firm_name_search', $firm_return, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>250 ]) !!}
            &nbsp;
            {!! Form::label('eik_search', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ЕИК/Булстат:', ['class'=>'my_labels', 'id'=>'label_bulstat']) !!}
            {!! Form::text('eik_search', $eik_return, ['class'=>'form-control form-control-my ', 'maxlength'=>13, 'size'=>10, 'id'=>'bulstat' ]) !!}
        </div>
        <div class="col-md-12 col-md-6_my hidden" id="pin_div">
            {!! Form::label('name_farmer', ' Име на ЧЗС:', ['class'=>'my_labels']) !!}
            {!! Form::text('name_farmer', $name_return, ['class'=>'form-control form-control-my', 'size'=>47, 'maxlength'=>250 ]) !!}
            &nbsp;
            <label class="labels"><span>Мъж: </span>
                {!! Form::radio('gender_farmer', 'male', $male) !!}
            </label>&nbsp;&nbsp; |
            <label class="labels"><span>&nbsp;&nbsp;Жена: </span>
                {!! Form::radio('gender_farmer', 'female', $female) !!}
            </label >&nbsp;&nbsp;|
            {!! Form::label('pin_farmer', 'ЕГН:', ['class'=>'labels']) !!}
            {!! Form::text('pin_farmer', $pin_return, ['class'=>'form-control form-control-my', 'maxlength'=>10, 'size'=>10, 'id'=>'pin_farmer' ]) !!}&nbsp;&nbsp;
        </div>
    </div>
</div>