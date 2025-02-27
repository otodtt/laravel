<?php
if(isset($firm)){
    if($firm == 1){
        $firm1 = true;
        $firm2 = false;
        $firm3 = false;
        $firm4 = false;
        $firm5 = false;
        $firm6 = false;
        $firm7 = false;
    }
    elseif($firm == 2){
        $firm1 = false;
        $firm2 = true;
        $firm3 = false;
        $firm4 = false;
        $firm5 = false;
        $firm6 = false;
        $firm7 = false;
    }
    elseif($firm == 3){
        $firm1 = false;
        $firm2 = false;
        $firm3 = true;
        $firm4 = false;
        $firm5 = false;
        $firm6 = false;
        $firm7 = false;
    }
    elseif($firm == 4){
        $firm1 = false;
        $firm2 = false;
        $firm3 = false;
        $firm4 = true;
        $firm5 = false;
        $firm6 = false;
        $firm7 = false;
    }
    elseif($firm == 5){
        $firm1 = false;
        $firm2 = false;
        $firm3 = false;
        $firm4 = false;
        $firm5 = true;
        $firm6 = false;
        $firm7 = false;
    }
    elseif($firm == 6){
        $firm1 = false;
        $firm2 = false;
        $firm3 = false;
        $firm4 = false;
        $firm5 = false;
        $firm6 = true;
        $firm7 = false;
    }
    elseif($firm == 7){
        $firm1 = false;
        $firm2 = false;
        $firm3 = false;
        $firm4 = false;
        $firm5 = false;
        $firm6 = false;
        $firm7 = true;
    }
    else{
        $firm1 = false;
        $firm2 = false;
        $firm3 = false;
        $firm4 = false;
        $firm5 = false;
        $firm6 = false;
        $firm7 = false;
    }
    if(strlen($gender) == 4){
        $male = true;
        $female = false;
    }
    elseif(strlen($gender) == 6){
        $male = false;
        $female = true;
    }
    else{
        $male = false;
        $female = false;
    }
}
?>
{{--<div class="container-fluid" >--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-12" >--}}
            {{--<fieldset class="small_field"><legend class="small_legend">Данни на Фирмата/Лицето</legend>--}}
                @if($firm > 1 )
                    <div class="col-md-8 col-md-6_my inspectors_divs border_divs" >
                        <label >ЕТ
                            {!! Form::radio('firm', 2, $firm2) !!}
                        </label>&nbsp; | &nbsp;

                        <label >ООД
                            {!! Form::radio('firm', 3, $firm3) !!}
                        </label>&nbsp; | &nbsp;

                        <label >ЕООД
                            {!! Form::radio('firm', 4, $firm4) !!}
                        </label>&nbsp; | &nbsp;

                        <label >АД
                            {!! Form::radio('firm', 5, $firm5) !!}
                        </label>&nbsp; | &nbsp;

                        <label >КООПЕРАЦИЯ
                            {!! Form::radio('firm', 6, $firm6) !!}
                        </label>&nbsp; | &nbsp;

                        <label >Друго
                            {!! Form::radio('firm', 7, $firm7) !!}
                        </label>&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my inspectors_divs">
                        <p class="description" >
                            &nbsp;&nbsp;&nbsp;<span class="bold">Задължително!</span> Избери една от следните възможности!<br>
                        </p>
                    </div>
                    <div id="firm_data" class="">
                        <div class="col-md-12 col-md-6_my inspectors_divs border_divs" >
                            <div class="col-md-8 col-md-6_my" >
                                <p class="description" >Изписва се само името на фирмата без ЕТ, ООД или ЕООД! Минимален брой символи - 4.<br/>
                                    Ако е избрано <span class="bold">"Друго" или "КООПЕРАЦИЯ "</span> тогава се изписва със съкращението - ЗПК Надежда</p>
                                {!! Form::label('name_firm', ' Име на Фирмата:', ['class'=>'my_labels']) !!}
                                {!! Form::text('name_firm', $name_firm, ['class'=>'form-control form-control-my', 'size'=>40, 'maxlength'=>250 ]) !!}

                                {!! Form::label('bulstat', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ЕИК/Булстат:', ['class'=>'my_labels']) !!}
                                {!! Form::text('bulstat', $eik, ['class'=>'form-control form-control-my', 'maxlength'=>13, 'size'=>10 ]) !!}
                            </div>

                        </div>

                        <div class="col-md-8 col-md-6_my" >
                            {!! Form::label('owner', 'Представител:&nbsp;&nbsp;&nbsp; &nbsp; ', ['class'=>'labels']) !!}
                            {!! Form::text('owner', null, ['class'=>'form-control form-control-my', 'maxlength'=>250, 'size'=>20 ]) !!}
                            &nbsp;
                            <label class="labels"><span>Мъж: </span>
                                {!! Form::radio('gender_owner', 'male', false) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="labels"><span>&nbsp;&nbsp;Жена: </span>
                                {!! Form::radio('gender_owner', 'female', false) !!}
                            </label>&nbsp;&nbsp;|
                            {!! Form::label('pin_owner', 'ЕГН:', ['class'=>'labels']) !!}
                            {!! Form::text('pin_owner', null, ['class'=>'form-control form-control-my', 'maxlength'=>10, 'size'=>7, 'id'=>'pin_owner' ]) !!}&nbsp;&nbsp;

                            <label class="labels"><span>&nbsp;&nbsp;Без ЕГН: </span>
                                {!! Form::radio('gender_owner', 'n', false) !!}
                            </label>
                        </div>

                        <div class="col-md-4 col-md-6_my" >
                        <p class="description" >
                            &nbsp;&nbsp;&nbsp;<span class="red bold"><i class="fa fa-warning"></i> ВАЖНО!!!</span> Ако не се знае ЕГН-то, маркирай <span class="bold">"Без ЕГН"</span>!
                        </p>
                    </div>
                    </div>
                @endif
                @if($firm == 1)
                    <div id="person_data" class="">
                        <div class="col-md-12 col-md-6_my" >
                            <label >ЧЗС
                                {!! Form::radio('firm', 1, $firm1) !!}
                            </label>&nbsp; | &nbsp;
                            {!! Form::label('name', 'Име на ФЛ/ЧЗП: &nbsp;', ['class'=>'labels']) !!}
                            {!! Form::text('name', $name, ['class'=>'form-control form-control-my', 'maxlength'=>250, 'size'=>28, 'autocomplete'=>'on'  ]) !!}
                            &nbsp;
                            {{--<hr style="margin-bottom: 5px; margin-top: 5px">--}}
                            <label class="labels"><span>Мъж: </span>
                                {!! Form::radio('gender', 'male', $male) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="labels"><span>&nbsp;&nbsp;Жена: </span>
                                {!! Form::radio('gender', 'female', $female) !!}
                            </label>&nbsp;&nbsp;|
                            {!! Form::label('pin', 'ЕГН:', ['class'=>'labels']) !!}
                            {!! Form::text('pin', $pin, ['class'=>'form-control form-control-my', 'maxlength'=>10, 'size'=>10, 'id'=>'pin' ]) !!}&nbsp;&nbsp;
                        </div>
                    </div>
                @endif
            {{--</fieldset>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}