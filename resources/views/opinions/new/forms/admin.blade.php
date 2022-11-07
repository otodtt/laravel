<?php
    $date_opinion = date('d.m.Y', $opinion->date_opinion);
?>
@if((int)$opinion->number_opinion == 0 && (int)$opinion->date_opinion == 0 && strlen($opinion->index_opinion) == 0)
    <p>Не е въведен Изходящ номер и дата на Становището.</p>
@else
    {!! Form::label('number_opinion', 'Изходящ номер на Становище', ['class'=>'my_labels']) !!}
    {!! Form::text('number_opinion', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6 ]) !!}

    {!! Form::label('date_opinion', 'Дата на изходящия номер:', ['class'=>'my_labels']) !!}
    {!! Form::text('date_opinion', $date_opinion, ['class'=>'form-control form-control-my',
    'id'=>'date_opinion', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг' ]) !!}
    <input type="hidden" name="admin" value="1">
@endif