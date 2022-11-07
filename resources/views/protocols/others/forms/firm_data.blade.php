<?php
if(isset($protocols)){
    if(strlen($protocols->bulstat)>0){
        $bull_yes = true;
        $bull_no = false;
    }
    else{
        $bull_yes = false;
        $bull_no = true;
    }
    if($protocols->sex_owner == 1){
        $male = true;
        $female = false;
        $no = false;
    }
    if($protocols->sex_owner == 2){
        $male = false;
        $female = true;
        $no = false;
    }
    if($protocols->sex_owner == 0){
        $male = false;
        $female = false;
        $no = true;
    }
}
else{
    $bull_yes = false;
    $bull_no = false;

    $male = false;
    $female = false;
    $no = false;
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Данни на Фирмата</legend>
                <div class="col-md-8 col-md-6_my inspectors_divs border_divs" >
                    <label >ЕТ
                        {!! Form::radio('firm', 1, false) !!}
                    </label>&nbsp; | &nbsp;

                    <label >ООД
                        {!! Form::radio('firm', 2, false) !!}
                    </label>&nbsp; | &nbsp;

                    <label >ЕООД
                        {!! Form::radio('firm', 3, false) !!}
                    </label>&nbsp; | &nbsp;

                    <label >АД
                        {!! Form::radio('firm', 4, false) !!}
                    </label>&nbsp; | &nbsp;

                    <label >Друго
                        {!! Form::radio('firm', 5, false) !!}
                    </label>&nbsp;
                </div>
                <div class="col-md-4 col-md-6_my inspectors_divs">
                    <p class="description" >
                        &nbsp;&nbsp;&nbsp;<span class="bold">Задължително!</span> Избери една от следните възможности!<br>
                        &nbsp;&nbsp;&nbsp;С "Друго" може да бъде Кооперация и т.н.
                    </p>
                </div>

                <div id="firm_data" >
                    <div class="col-md-12 col-md-6_my inspectors_divs border_divs" >
                        <div class="col-md-8 col-md-6_my" >
                            <p class="description" >Изписва се само името на фирмата без ЕТ, ООД или ЕООД! Минимален брой символи - 4.<br/>
                                Ако е избрано <span class="bold">"Друго" или "КООПЕРАЦИЯ "</span> тогава се изписва със съкращението - ЗПК Надежда</p>
                            {!! Form::label('name', ' Име на Фирмата:', ['class'=>'my_labels']) !!}
                            {!! Form::text('name', null, ['class'=>'form-control form-control-my', 'size'=>40, 'maxlength'=>250 ]) !!}

                            {!! Form::label('bulstat', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ЕИК/Булстат:', ['class'=>'my_labels']) !!}
                            {!! Form::text('bulstat', null, ['class'=>'form-control form-control-my', 'maxlength'=>13, 'size'=>10 ]) !!}
                            &nbsp;
                            <label class="labels"><span>Да: </span>
                                {!! Form::radio('bulls', 1, $bull_yes) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="labels"><span>&nbsp;&nbsp;НЕ: </span>
                                {!! Form::radio('bulls', 0, $bull_no) !!}
                            </label>
                        </div>

                        <div class="col-md-4 col-md-6_my" >
                            <p class="description" >
                                &nbsp;&nbsp;&nbsp;<span class="red bold"><i class="fa fa-warning"></i> ВАЖНО!!!</span> Ако не се знае Булста на фирмата маркирай "НЕ"!
                            </p>
                        </div>
                    </div>

                    <div class="col-md-12 col-md-6_my inspectors_divs border_divs" >
                        <div class="col-md-8 col-md-6_my" >
                        {!! Form::label('owner', 'Представител:&nbsp;&nbsp;&nbsp; &nbsp; ', ['class'=>'labels']) !!}
                        {!! Form::text('owner', null, ['class'=>'form-control form-control-my', 'maxlength'=>250, 'size'=>30 ]) !!}
                        &nbsp;
                        <label class="labels"><span>Мъж: </span>
                            {!! Form::radio('gender_owner', 'male', $male) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="labels"><span>&nbsp;&nbsp;Жена: </span>
                            {!! Form::radio('gender_owner', 'female', $female) !!}
                        </label>&nbsp;&nbsp;|
                        {!! Form::label('pin_owner', 'ЕГН:', ['class'=>'labels']) !!}
                        {!! Form::text('pin_owner', null, ['class'=>'form-control form-control-my', 'maxlength'=>10, 'size'=>10, 'id'=>'pin' ]) !!}&nbsp;&nbsp;

                        <label class="labels"><span>&nbsp;&nbsp;Без ЕГН: </span>
                            {!! Form::radio('gender_owner', 'no', $no) !!}
                        </label>
                    </div>

                        <div class="col-md-4 col-md-6_my" >
                            <p class="description" >
                                &nbsp;&nbsp;&nbsp;<span class="red bold"><i class="fa fa-warning"></i> ВАЖНО!!!</span> Ако не се знае ЕГН-то, маркирай <span class="bold">"Без ЕГН"</span>!
                            </p>
                        </div>
                    </div>

                    <div class="col-md-12 col-md-6_my" >
                        @include('protocols.others.forms.locations')
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>

