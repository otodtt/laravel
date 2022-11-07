{!! Form::label('owner', 'Представител:', ['class'=>'labels']) !!}
{!! Form::text('owner', null, ['class'=>'form-control form-control-my', 'maxlength'=>250, 'size'=>30 ]) !!}
&nbsp;&nbsp;
<?php
if(isset($firm->sex) ){
    if($firm->sex == 1){
        $male = true;
        $female = false;
        $no = false;
    }
    if($firm->sex == 2){
        $male = false;
        $female = true;
        $no = false;
    }
    if($firm->sex == 0){
        $male = false;
        $female = false;
        $no = true;
    }
}
else{
    $male = false;
    $female = false;
    $no = false;
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
    $selected_pin = $firm->egn;
}
else{
    $selected_pin = null;
}
?>

{!! Form::label('pin', 'ЕГН:', ['class'=>'labels']) !!}
{!! Form::text('pin', $selected_pin, ['class'=>'form-control form-control-my', 'maxlength'=>10, 'size'=>10, 'id'=>'pin' ]) !!}

&nbsp;&nbsp; | &nbsp;&nbsp;
<label class="labels"><span>Без ЕГН: </span>
    {!! Form::radio('gender', 'no', $no) !!}
</label>