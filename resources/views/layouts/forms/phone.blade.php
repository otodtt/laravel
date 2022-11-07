{!! Form::label('phone', 'Телефон:', ['class'=>'labels']) !!}
{!! Form::text('phone', null, ['class'=>'form-control form-control-my', 'maxlength'=>15, 'size'=>10, 'id'=>'phone', 'placeholder'=>'000/ 00 000' ]) !!}

{!! Form::label('mobil', 'Мобилен:', ['class'=>'labels']) !!}
{!! Form::text('mobil', null, ['class'=>'form-control form-control-my', 'maxlength'=>15, 'size'=>10, 'id'=>'mobil', 'placeholder'=>'0888/000 000' ]) !!}

{!! Form::label('email', 'Email:', ['class'=>'labels']) !!}
{!! Form::text('email', null, ['class'=>'form-control form-control-my', 'maxlength'=>50, 'size'=>30, 'id'=>'email' ]) !!}