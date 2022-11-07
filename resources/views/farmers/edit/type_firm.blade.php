@if($farmer->type_firm >= 2)
    <div class="col-md-12 col-md-6_my "  >
        <label >ЕТ
            {!! Form::radio('type_firm', 2, false) !!}
        </label>&nbsp; | &nbsp;

        <label >ООД
            {!! Form::radio('type_firm', 3, false) !!}
        </label>&nbsp; | &nbsp;

        <label >ЕООД
            {!! Form::radio('type_firm', 4, false) !!}
        </label>&nbsp; | &nbsp;

        <label >АД
            {!! Form::radio('type_firm', 5, false) !!}
        </label>&nbsp; | &nbsp;

        <label >КООПЕРАЦИЯ
            {!! Form::radio('type_firm', 6, false) !!}
        </label>&nbsp; | &nbsp;

        <label >Друго
            {!! Form::radio('type_firm', 7, false) !!}
        </label>&nbsp;
    </div>
@endif

<div class="col-md-12 col-md-6_my "  >
@if($farmer->type_firm == 1)
    <?php
    if($farmer->sex == 1){
            $male = true;
            $female = false;
        }
        elseif($farmer->sex == 2){
            $male = false;
            $female = true;
        }
        else{
            $male = false;
            $female = false;
        }
    ?>
    <div id="farmer_wrap">
        {!! Form::label('name', ' Име на ЧЗС:', ['class'=>'my_labels']) !!}
        {!! Form::text('name', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>250 ]) !!}
        &nbsp;
        <label class="labels"><span>Мъж: </span>
            {!! Form::radio('gender', 'male', $male) !!}
        </label>&nbsp;&nbsp; |
        <label class="labels"><span>&nbsp;&nbsp;Жена: </span>
            {!! Form::radio('gender', 'female', $female) !!}
        </label >&nbsp;&nbsp;|
        {!! Form::label('pin', 'ЕГН №:', ['class'=>'labels']) !!}
        {!! Form::text('pin', null, ['class'=>'form-control form-control-my', 'maxlength'=>10, 'size'=>10, 'id'=>'pin_farmer' ]) !!}&nbsp;&nbsp;
    </div>
@else
    <div id="firm_wrap">
        {!! Form::label('name', ' Име на Фирма:', ['class'=>'my_labels']) !!}
        {!! Form::text('name', null, ['class'=>'form-control form-control-my', 'size'=>50, 'maxlength'=>250 ]) !!}
        &nbsp;
        {!! Form::label('bulstat', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ЕИК/Булстат №:', ['class'=>'my_labels', 'id'=>'label_bulstat']) !!}
        {!! Form::text('bulstat', null, ['class'=>'form-control form-control-my ', 'maxlength'=>13, 'size'=>10, 'id'=>'bulstat' ]) !!}

        <hr class="my_hr_in"/>

        <?php
        if($farmer->sex_owner == 1){
            $male_owner = true;
            $female_owner = false;
            $non_owner = false;
        }
        elseif($farmer->sex_owner == 2){
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
        {!! Form::label('owner', 'Управител:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', ['class'=>'labels']) !!}
        {!! Form::text('owner', null, ['class'=>'form-control form-control-my', 'maxlength'=>250, 'size'=>28 ]) !!}
        &nbsp;
        <label class="labels"><span>Мъж: </span>
            {!! Form::radio('gender_owner', 'male', $male_owner) !!}
        </label>&nbsp;|
        <label class="labels"><span>&nbsp;Жена: </span>
            {!! Form::radio('gender_owner', 'female', $female_owner) !!}
        </label>&nbsp;|
        {!! Form::label('pin_owner', 'ЕГН:', ['class'=>'labels']) !!}
        {!! Form::text('pin_owner', null, ['class'=>'form-control form-control-my', 'maxlength'=>10, 'size'=>7, 'id'=>'pin' ]) !!}&nbsp;&nbsp;

        <label class="labels"><span>&nbsp;Без ЕГН: </span>
            {!! Form::radio('gender_owner', 'n', $non_owner) !!}
        </label>
    </div>
@endif
</div>