{!! Form::label('owner', 'Представител:', ['class'=>'labels']) !!}
{!! Form::text('owner', null, ['class'=>'form-control form-control-my', 'maxlength'=>250, 'size'=>30 ]) !!}
&nbsp;&nbsp;
<?php
if(isset($firm->sex) ){
    if($firm->sex == 1){
        $male = true;
        $female = false;
    }
    else{
        $male = false;
        $female = true;
    }
}
else{
    $male = false;
    $female = false;
}
?>
<label class="labels"><span>Мъж: </span>
    {!! Form::radio('gender', 'male', $male) !!}
</label>&nbsp;&nbsp;|
<label class="labels"><span>&nbsp;&nbsp;Жена: </span>
    {!! Form::radio('gender', 'female', $female) !!}
</label>&nbsp;&nbsp;|
<?php
if(isset($firm->egn)){
    $selected = $firm->egn;
}
else{
    $selected = null;
}
?>

{!! Form::label('pin', 'ЕГН:', ['class'=>'labels']) !!}
{!! Form::text('pin', $selected, ['class'=>'form-control form-control-my', 'maxlength'=>10, 'size'=>10, 'id'=>'pin' ]) !!}