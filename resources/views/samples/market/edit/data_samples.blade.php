<?php
if($samples->tc_sample == 1){
    $tc_sample1 = true;
    $tc_sample2 = false;
}
elseif($samples->tc_sample == 2){
    $tc_sample1 = false;
    $tc_sample2 = true;
}
else{
    $tc_sample1 = false;
    $tc_sample2 = false;
}
//////
if($samples->type_formula == 1){
    $type_formula1 = true;
    $type_formula2 = false;
}
elseif($samples->type_formula == 2){
    $type_formula1 = false;
    $type_formula2 = true;
}
else{
    $type_formula1 = false;
    $type_formula2 = false;
}
//////
if($samples->type_volume == 'кг.'){
    $kg = true;
    $li = false;
}
elseif($samples->type_volume == 'л.'){
    $kg = false;
    $li = true;
}
else{
    $kg = false;
    $li = false;
}
//////
if($samples->type_pac == 'кг.'){
    $kg1 = true;
    $li1 = false;
    $mg = false;
    $ml = false;
}
elseif($samples->type_pac == 'л.'){
    $kg1 = false;
    $li1 = true;
    $mg = false;
    $ml = false;
}
elseif($samples->type_pac == 'мг.'){
    $kg1 = false;
    $li1 = false;
    $mg = true;
    $ml = false;
}
elseif($samples->type_pac == 'мл.'){
    $kg1 = false;
    $li1 = false;
    $mg = false;
    $ml = true;
}
else{
    $kg1 = false;
    $li1 = false;
    $mg = false;
    $ml = false;
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-7" >
            <fieldset class="small_field"><legend class="small_legend">Данни за Производител/Преопаковчик</legend>
                <div class="col-md-9 col-md-6_my" >
                    {!! Form::label('maker', 'Име на Производител/Преопаковчик:', ['class'=>'my_labels']) !!}
                    {!! Form::text('maker', $samples->maker, ['class'=>'form-control form-control-my', 'size'=>30, 'maxlength'=>100 ]) !!}
                </div>
                <div class="col-md-3 col-md-6_my"  >
                    <p class="description">Полето е задължително.</p>
                </div>
            </fieldset>
        </div>
        <div class="col-md-5" >
            <fieldset class="small_field"><legend class="small_legend">Пробата е необходима за установяване на съответствие с:</legend>
                <div class="col-md-12 col-md-6_my top_margin" >
                    <label class="tc_sample"><span>&nbsp;&nbsp;TC: </span>
                        {!! Form::radio('tc_sample', 1, $tc_sample1) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="tc_sample"><span>&nbsp;&nbsp;Сертификат на производителя: </span>
                        {!! Form::radio('tc_sample', 2, $tc_sample2) !!}
                    </label>
                </div>
            </fieldset>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Данни за пробата</legend>
                <div class="col-md-10 col-md-6_my" >
                    {!! Form::label('name', 'Име на ПРЗ:', ['class'=>'my_labels']) !!}
                    {!! Form::text('name', $samples->name, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>100 ]) !!}
                    &nbsp;&nbsp;

                    {!! Form::label('active_subs', 'С Активно в-во:', ['class'=>'my_labels']) !!}
                    {!! Form::text('active_subs', $samples->active_subs, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>100 ]) !!}
                    &nbsp;&nbsp;

                    {!! Form::label('type', 'Формулация:', ['class'=>'my_labels']) !!}
                    {!! Form::text('type', $samples->type, ['class'=>'form-control form-control-my','id'=>'type', 'size'=>1, 'maxlength'=>4,
                     'placeholder'=>'EK' ]) !!}
                    &nbsp;&nbsp;

                    <label class="type_formula"><span>Течен: </span>
                        {!! Form::radio('type_formula', 1, $type_formula1) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="type_formula"><span>&nbsp;&nbsp;Прхообразен/Гранулиран: </span>
                        {!! Form::radio('type_formula', 2, $type_formula2) !!}
                    </label>
                </div>
                <div class="col-md-2 col-md-6_my"  >
                    <p class="description">Полетата са задължителни.</p>
                </div>
            </fieldset>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7" >
            <fieldset class="small_field"><legend class="small_legend">Данни за Партидата</legend>
                <div class="col-md-12 col-md-6_my" >
                    <?php
                        if($samples->volume == 0){
                            $volume = '';
                        }
                        else{
                            $volume = $samples->volume;
                        }

                        if($samples->volume_pac == 0){
                            $volume_pac = '';
                        }
                        else{
                            $volume_pac = $samples->volume_pac;
                        }
                    ?>
                    {!! Form::label('lot_number', '№ на Партидата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('lot_number', $samples->lot_number, ['class'=>'form-control form-control-my', 'size'=>10, 'maxlength'=>100 ]) !!}

                    &nbsp;&nbsp;
                    {!! Form::label('volume', 'К-во на партидата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('volume', $volume, ['class'=>'form-control form-control-my','id'=>'type', 'size'=>3, 'maxlength'=>10 ]) !!}
                    &nbsp;&nbsp;

                    <label class="type_volume"><span>Килограма: </span>
                        {!! Form::radio('type_volume', 'кг.', $kg) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="type_volume"><span>&nbsp;&nbsp;Литра: </span>
                        {!! Form::radio('type_volume', 'л.', $li) !!}
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="col-md-5" >
            <fieldset class="small_field"><legend class="small_legend">Данни за Опаковката</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::label('volume_pac', 'Опаковка:', ['class'=>'my_labels']) !!}
                    {!! Form::text('volume_pac', $volume_pac, ['class'=>'form-control form-control-my','id'=>'type', 'size'=>2, 'maxlength'=>10 ]) !!}

                    &nbsp;&nbsp;
                    <label class="type_pac"><span>&nbsp;&nbsp; мг. </span>
                        {!! Form::radio('type_pac', 'мг.', $mg) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="type_pac"><span>&nbsp;&nbsp; мл. </span>
                        {!! Form::radio('type_pac', 'мл.', $ml) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="type_pac"><span>&nbsp;&nbsp; кг. </span>
                        {!! Form::radio('type_pac', 'кг.', $kg1) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="type_pac"><span>&nbsp;&nbsp; л. </span>
                        {!! Form::radio('type_pac', 'л.', $li1) !!}
                    </label>
                </div>
            </fieldset>
        </div>
    </div>
</div>

<hr class="my_hr"/>

<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Резултат от Пробата</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::textarea('results', $samples->results, ['class'=>'form-control form-control-my', 'cols'=>'100', 'rows'=>'1']) !!}
                </div>
            </fieldset>
        </div>
    </div>
</div>