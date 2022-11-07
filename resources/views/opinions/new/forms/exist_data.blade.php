<?php
if($farmer->tvm == 1){
    $tvm = 'гр. ';
}
elseif($farmer->tvm == 2){
    $tvm = 'с. ';
}
else{
    $tvm = 'гр./с. ';
}
////
if($farmer->type_firm == 2){
    $et = 'ET "';
    $ood = '"';
}
elseif($farmer->type_firm == 3){
    $et = '"';
    $ood = '" ООД';
}
elseif($farmer->type_firm == 4){
    $et = '"';
    $ood = '" ЕООД';
}
elseif($farmer->type_firm == 5){
    $et = '"';
    $ood = '" АД';
}
else{
    $et = '';
    $ood = '';
}
/////
if($farmer->sex_owner == 1 ){
    $male_owner = true;
    $female_owner = false;
    $non_owner = false;
}
elseif($farmer->sex_owner == 2 ){
    $male_owner = false;
    $female_owner = true;
    $non_owner = false;
}
else{
    $male_owner = false;
    $female_owner = false;
    $non_owner = true;
}
?>
<div class="col-md-12 col-md-6_my" >
    @if($farmer->type_firm == 1)
        <p class="bold">
            <span class="red"><i class="fa fa-warning"></i> Внимание! Провери внимателно данните!</span>
            Ако има грешка, първо редактирай данните на Земеделския стопанин и тогава добави Становището!
            <a href="{!!URL::to('/стопанин/'.$farmer->id )!!}" class="fa fa-edit btn btn-danger my_btn"> Редактирай тук!</a>
        </p>
        <hr class="my_hr"/>
        <p style="font-size: 1.2em" >ЧЗС: <span class="bold">{!! $farmer->name !!}</span> с ЕГН: <span class="bold">{!! $farmer->pin !!}</span></p>
    @else
        <div class="col-md-7 col-md-6_my" >
            <p style="font-size: 1.2em" >ФИРМА: <span class="bold">{!! $et.$farmer->name.$ood !!}</span> с БУЛСТАТ: <span class="bold">{!! $farmer->pin !!}</span></p>
            <hr class="hr_in"/>
            {!! Form::label('owner', 'Управител:&nbsp;', ['class'=>'labels']) !!}
            {!! Form::text('owner', $farmer->owner, ['class'=>'form-control form-control-my', 'maxlength'=>250, 'size'=>28 ]) !!}
            &nbsp;
            <label class="labels"><span>Мъж: </span>
                {!! Form::radio('gender_owner', 'male', $male_owner) !!}
            </label>&nbsp;|
            <label class="labels"><span>&nbsp;Жена: </span>
                {!! Form::radio('gender_owner', 'female', $female_owner) !!}
            </label>&nbsp;|
            {!! Form::label('pin_owner', 'ЕГН:', ['class'=>'labels']) !!}
            {!! Form::text('pin_owner', $farmer->pin_owner, ['class'=>'form-control form-control-my', 'maxlength'=>10, 'size'=>6, 'id'=>'pin' ]) !!}&nbsp;&nbsp;

            <label class="labels"><span>&nbsp;Без ЕГН: </span>
                {!! Form::radio('gender_owner', 'n', $non_owner) !!}
            </label>
        </div>
        <div class="col-md-5 " >
            <p class="bold">
                <span class="red"><i class="fa fa-warning"></i> Внимание! Провери внимателно данните!</span><br/>
                Ако има грешка, първо редактирай данните на Земеделския стопанин и тогава добави Становището!
                <a href="{!!URL::to('/стопанин/'.$farmer->id )!!}" class="fa fa-edit btn btn-danger my_btn">
                    Редактирай тук!
                </a>
            </p>
        </div>
    @endif
</div>