<?php
if(isset($farmer)){
    $district_object = $farmer->district_object;
    $object_name = $farmer->location_farm;
}
else{
    $district_object = null;
    $object_name = null;
}
?>
<p class="description">В полето <span class="bold">"Населено място\места:"</span> опишете селото в което се намира стопанството. Ако са повече, по ваша преценка до 250 символа.</p>
{!! Form::label('district_object', 'Общината където се намира стопанството:', ['class'=>'my_labels']) !!}
{!! Form::select('district_object', $districts_list, $district_object, ['id' =>'district_object', 'class' =>'inspector form-control form-control_my_opinion' ]) !!}

{!! Form::label('object_name', 'Населено място\места:', ['class'=>'labels']) !!}
{!! Form::text('object_name', $object_name, ['class'=>'form-control form-control-my', 'maxlength'=>50, 'size'=>70, 'id'=>'object_name' ]) !!}
