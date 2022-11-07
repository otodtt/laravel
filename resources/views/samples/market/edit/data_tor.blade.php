<?php
if($samples->eo == 0){
    $no = true;
    $yes = false;
}
elseif($samples->eo == 1){
    $no = false;
    $yes = true;
}
else{
    $tc_sample1 = false;
    $tc_sample2 = false;
}
//////
if($samples->state == 1){
    $state1 = true;
    $state2 = false;
}
elseif($samples->state == 2){
    $state1 = false;
    $state2 = true;
}
else{
    $state1 = false;
    $state2 = false;
}
//////
if($samples->volume_lot == 'кг.'){
    $kg = true;
    $li = false;
    $ton = false;
}
elseif($samples->volume_lot == 'т.'){
    $kg = false;
    $li = false;
    $ton = true;
}
elseif($samples->volume_lot == 'л.'){
    $kg = false;
    $li = true;
    $ton = false;
}
else{
    $kg = false;
    $li = false;
    $ton = false;
}
///////
if($samples->volume == 0){
    $volume = '';
}
else{
    $volume = $samples->volume;
}
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-9" >
            <fieldset class="small_field"><legend class="small_legend">Данни за Производител/Преопаковчик</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::label('maker', 'Производител:', ['class'=>'my_labels']) !!}
                    {!! Form::text('maker', $samples->maker, ['class'=>'form-control form-control-my', 'size'=>30, 'maxlength'=>100 ]) !!}
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {!! Form::label('packaged', 'Опакован от:', ['class'=>'my_labels']) !!}
                    {!! Form::text('packaged', $samples->packaged, ['class'=>'form-control form-control-my', 'size'=>30, 'maxlength'=>100 ]) !!}
                </div>
            </fieldset>
        </div>
        <div class="col-md-3" >
            <fieldset class="small_field"><legend class="small_legend"> Наличие на маркировка "ЕО ТОР": </legend>
                <div class="col-md-12 col-md-6_my top_margin" >
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="tc_sample"><span>&nbsp;&nbsp;НЕ: </span>
                        {!! Form::radio('eo', 0, $no) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="tc_sample"><span>&nbsp;&nbsp;ДА: </span>
                        {!! Form::radio('eo', 1, $yes) !!}
                    </label>
                </div>
            </fieldset>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Данни за пробата</legend>
                <div class="col-md-10 col-md-6_my" >
                    {!! Form::label('name', 'Име на ТОР:', ['class'=>'my_labels']) !!}
                    {!! Form::text('name', $samples->name, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>100 ]) !!}
                    &nbsp;&nbsp;

                    {!! Form::label('active_subs', 'Съдържание на хранителни в-ва:', ['class'=>'my_labels']) !!}
                    {!! Form::text('active_subs', $samples->active_subs, ['class'=>'form-control form-control-my', 'size'=>15, 'maxlength'=>100 ]) !!}
                    &nbsp;&nbsp;
                    &nbsp;&nbsp;

                    <label class="state"><span>Насипен: </span>
                        {!! Form::radio('state', 1, $state1) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="state"><span>&nbsp;&nbsp;Опакован: </span>
                        {!! Form::radio('state', 2, $state2) !!}
                    </label>
                </div>
                <div class="col-md-2 col-md-6_my"  >
                    <p class="description">Полетата са задължителни.</p>
                </div>
            </fieldset>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" >
            <fieldset class="small_field"><legend class="small_legend">Данни за Партидата</legend>
                <div class="col-md-12 col-md-6_my" >
                    {!! Form::label('lot_number', ' № на Партидата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('lot_number', $samples->lot_number, ['class'=>'form-control form-control-my', 'size'=>10, 'maxlength'=>100 ]) !!}
                    &nbsp;
                    {!! Form::label('date_lot', ' Дата на производство:', ['class'=>'my_labels']) !!}
                    {!! Form::text('date_lot', $samples->date_lot, ['class'=>'form-control form-control-my date_certificate',
                    'id'=>'date_number', 'size'=>15, 'maxlength'=>10 ]) !!}
                    &nbsp;
                    {!! Form::label('volume', ' К-во на партидата:', ['class'=>'my_labels']) !!}
                    {!! Form::text('volume', $volume, ['class'=>'form-control form-control-my','id'=>'type', 'size'=>3, 'maxlength'=>10 ]) !!}
                &nbsp;&nbsp;  &nbsp;
                    <label class="volume_lot"><span> Килограма: </span>
                        {!! Form::radio('volume_lot', 'кг.', $kg) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="volume_lot"><span> Тона: </span>
                        {!! Form::radio('volume_lot', 'т.', $ton) !!}
                    </label>&nbsp;&nbsp;|
                    <label class="volume_lot"><span>&nbsp;&nbsp;Литра: </span>
                        {!! Form::radio('volume_lot', 'л.', $li) !!}
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