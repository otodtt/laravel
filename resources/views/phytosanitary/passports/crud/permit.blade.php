<?php
if (isset($last_number[0]['number_permit'])){
    $last = $last_number[0]['number_permit'];
    $last_plus = $last_number[0]['number_permit']+1;
}  else {
    $last = '- няма такъв';
    $last_plus = 1;
}
?>
@if(!isset($permits))
    <div class="container-fluid" >
        <p class="bold "><span class="red"> Последно използван номер за Разрешително e {!! $last !!}.</span> Използвай {!! $last_plus !!} !</p>
        <div class="row">
            <div class="col-md-5" >
                <fieldset class="small_field"><legend class="small_legend">Номер и дата на Разрешително</legend>
                    <div class="col-md-6 col-md-6_my" >
                        {!! Form::label('number_permit', 'Разрешително №', ['class'=>'my_labels']) !!}
                        {!! Form::text('number_permit', $last_plus, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}
                    </div>
                    <div class="col-md-6" >
                        {!! Form::label('date_permit', 'Дата:', ['class'=>'my_labels']) !!}
                        {!! Form::text('date_permit', null, ['class'=>'form-control form-control-my date_certificate',
                        'id'=>'date_permit', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
                    </div>
                </fieldset>
            </div>
            <div class="col-md-7 ">
                <p class="description">
                    <br/>
                    <span class="fa fa-warning red" aria-hidden="true"> ВНИМАНИЕ! </span> Номера на Разрешителното е попълнен автоматично. Не променяй ако не е необходимо!
                </p>
            </div>
        </div>
    </div>
@else
    <p class="bold">Редактиране на Разрешително № {!! $permits->number_permit !!} от {!! date('d.m.Y', $permits->date_permit) !!} г.</p>
@endif


