<div class="col-md-12 col-md-6_my "  >
    <p class="description">В полето <span class="bold">"Населено място\места:"</span> опишете селото в което се намира стопанството. Ако са повече, по ваша преценка до 250 символа.</p>
    {!! Form::label('district_object', 'Общината където се намира стопанството:', ['class'=>'my_labels']) !!}
    {!! Form::select('district_object', $districts_farm, null, ['id' =>'district_object', 'class' =>'inspector form-control form-control_my_opinion' ]) !!}

    {!! Form::label('location_farm', 'Населено място\места:', ['class'=>'labels']) !!}
    {!! Form::text('location_farm', null, ['class'=>'form-control form-control-my', 'maxlength'=>250, 'size'=>75, 'id'=>'object_name' ]) !!}
</div>