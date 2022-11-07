<?php
if(isset($farmer)){
    $phone = $farmer->phone;
    $mobil = $farmer->mobil;
    $email = $farmer->email;
}
else{
    $phone = null;
    $mobil = null;
    $email = null;
}
?>
{!! Form::label('phone', 'Телефон:', ['class'=>'labels']) !!}
{!! Form::text('phone', $phone, ['class'=>'form-control form-control-my', 'maxlength'=>15, 'size'=>10, 'id'=>'phone', 'placeholder'=>'000/ 00 000' ]) !!}

{!! Form::label('mobil', 'Мобилен:', ['class'=>'labels']) !!}
{!! Form::text('mobil', $mobil, ['class'=>'form-control form-control-my', 'maxlength'=>15, 'size'=>10, 'id'=>'mobil', 'placeholder'=>'0888/000 000' ]) !!}

{!! Form::label('email', 'Email:', ['class'=>'labels']) !!}
{!! Form::text('email', $email, ['class'=>'form-control form-control-my', 'maxlength'=>50, 'size'=>30, 'id'=>'email' ]) !!}
