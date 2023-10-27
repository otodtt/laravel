<?php
if(!isset($report)){
    $layout1 = false;
    $layout2 = false;
    $layout3 = false;
    $layout_note= null;
}
else{
    if($report->layout == 0){
        $layout1 = false;
        $layout2 = false;
        $layout3 = false;
    }
    if($report->layout == 1){
        $layout1 = true;
        $layout2 = false;
        $layout3 = false;
    }
    if($report->layout == 2){
        $layout1 = false;
        $layout2 = true;
        $layout3 = false;
    }
    if($report->layout == 3){
        $layout1 = false;
        $layout2 = false;
        $layout3 = true;
    }
    $layout_note= $report->layout_note;
}
//  2. Първични счетоводни документи
if(!isset($report)){
    $inhabited1 = false;
    $inhabited2 = false;
    $inhabited3 = false;
    $inhabited_note= null;
}
else{
    if($report->inhabited == 0){
        $inhabited1 = false;
        $inhabited2 = false;
        $inhabited3 = false;
    }
    if($report->inhabited == 1){
        $inhabited1 = true;
        $inhabited2 = false;
        $inhabited3 = false;
    }
    if($report->inhabited == 2){
        $inhabited1 = false;
        $inhabited2 = true;
        $inhabited3 = false;
    }
    if($report->inhabited == 3){
        $inhabited1 = false;
        $inhabited2 = false;
        $inhabited3 = true;
    }
    $inhabited_note= $report->inhabited_note;
}
//  3. Сертификат за семена
if(!isset($report)){
    $logbook1 = false;
    $logbook2 = false;
    $logbook3 = false;
    $logbook_note= null;
}
else{
    if($report->logbook == 0){
        $logbook1 = false;
        $logbook2 = false;
        $logbook3 = false;
    }
    if($report->logbook == 1){
        $logbook1 = true;
        $logbook2 = false;
        $logbook3 = false;
    }
    if($report->logbook == 2){
        $logbook1 = false;
        $logbook2 = true;
        $logbook3 = false;
    }
    if($report->logbook == 3){
        $logbook1 = false;
        $logbook2 = false;
        $logbook3 = true;
    }
    $logbook_note= $report->logbook_note;
}
//  4. Сертификат по чл. 83 от ЗЗР
if(!isset($report)){
    $publication1 = false;
    $publication2 = false;
    $publication3 = false;
    $publication_note= null;
}
else{
    if($report->publication == 0){
        $publication1 = false;
        $publication2 = false;
        $publication3 = false;
    }
    if($report->publication == 1){
        $publication1 = true;
        $publication2 = false;
        $publication3 = false;
    }
    if($report->publication == 2){
        $publication1 = false;
        $publication2 = true;
        $publication3 = false;
    }
    if($report->publication == 3){
        $publication1 = false;
        $publication2 = false;
        $publication3 = true;
    }
    $publication_note= $report->publication_note;
}
//  5. Протокол/и от изпитване 
if(!isset($report)){
    $training1 = false;
    $training2 = false;
    $training3 = false;
    $training_note= null;
}
else{
    if($report->training == 0){
        $training1 = false;
        $training2 = false;
        $training3 = false;
    }
    if($report->training == 1){
        $training1 = true;
        $training2 = false;
        $training3 = false;
    }
    if($report->training == 2){
        $training1 = false;
        $training2 = true;
        $training3 = false;
    }
    if($report->training == 3){
        $training1 = false;
        $training2 = false;
        $training3 = true;
    }
    $training_note= $report->training_note;
}
//  6. Договор с фирма, вписана в
if(!isset($report)){
    $protocol1 = false;
    $protocol2 = false;
    $protocol3 = false;
    $protocol_note= null;
}
else{
    if($report->protocol == 0){
        $protocol1 = false;
        $protocol2 = false;
        $protocol3 = false;
    }
    if($report->protocol == 1){
        $protocol1 = true;
        $protocol2 = false;
        $protocol3 = false;
    }
    if($report->protocol == 2){
        $protocol1 = false;
        $protocol2 = true;
        $protocol3 = false;
    }
    if($report->protocol == 3){
        $protocol1 = false;
        $protocol2 = false;
        $protocol3 = true;
    }
    $protocol_note= $report->protocol_note;
}
//  7. Разрешение за прилагане на ПРЗ
if(!isset($report)){
    $sign1 = false;
    $sign2 = false;
    $sign3 = false;
    $sign_note= null;
}
else{
    if($report->sign == 0){
        $sign1 = false;
        $sign2 = false;
        $sign3 = false;
    }
    if($report->sign == 1){
        $sign1 = true;
        $sign2 = false;
        $sign3 = false;
    }
    if($report->sign == 2){
        $sign1 = false;
        $sign2 = true;
        $sign3 = false;
    }
    if($report->sign == 3){
        $sign1 = false;
        $sign2 = false;
        $sign3 = true;
    }
    $sign_note= $report->sign_note;
}
//  8. EPORD
if(!isset($report)){
    $agronomist1 = false;
    $agronomist2 = false;
    $agronomist3 = false;
    $agronomist_note= null;
}
else{
    if($report->agronomist  == 0){
        $agronomist1 = false;
        $agronomist2 = false;
        $agronomist3 = false;
    }
    if($report->agronomist  == 1){
        $agronomist1 = true;
        $agronomist2 = false;
        $agronomist3 = false;
    }
    if($report->agronomist  == 2){
        $agronomist1 = false;
        $agronomist2 = true;
        $agronomist3 = false;
    }
    if($report->agronomist  == 3){
        $agronomist1 = false;
        $agronomist2 = false;
        $agronomist3 = true;
    }
    $agronomist_note= $report->agronomist_note;
}
//  9. DOGOWOR ZA PRYSKANE
if(!isset($report)){
    $documents1 = false;
    $documents2 = false;
    $documents3 = false;
    $documents_note= null;
}
else{
    if($report->documents == 0){
        $documents1 = false;
        $documents2 = false;
        $documents3 = false;
    }
    if($report->documents == 1){
        $documents1 = true;
        $documents2 = false;
        $documents3 = false;
    }
    if($report->documents == 2){
        $documents1 = false;
        $documents2 = true;
        $documents3 = false;
    }
    if($report->documents == 3){
        $documents1 = false;
        $documents2 = false;
        $documents3 = true;
    }
    $documents_note= $report->documents_note;
}

if(!isset($report)){
    $equipment1 = false;
    $equipment2 = false;
    $equipment3 = false;
    $equipment_note= null;
}
else{
    if($report->equipment == 0){
        $equipment1 = false;
        $equipment2 = false;
        $equipment3 = false;
    }
    if($report->equipment == 1){
        $equipment1 = true;
        $equipment2 = false;
        $equipment3 = false;
    }
    if($report->equipment == 2){
        $equipment1 = false;
        $equipment2 = true;
        $equipment3 = false;
    }
    if($report->equipment == 3){
        $equipment1 = false;
        $equipment2 = false;
        $equipment3 = true;
    }
    $equipment_note= $report->equipment_note;
}
//  2. Първични счетоводни документи
if(!isset($report)){
    $residential1 = false;
    $residential2 = false;
    $residential3 = false;
    $residential_note= null;
}
else{
    if($report->residential == 0){
        $residential1 = false;
        $residential2 = false;
        $residential3 = false;
    }
    if($report->residential == 1){
        $residential1 = true;
        $residential2 = false;
        $residential3 = false;
    }
    if($report->residential == 2){
        $residential1 = false;
        $residential2 = true;
        $residential3 = false;
    }
    if($report->residential == 3){
        $residential1 = false;
        $residential2 = false;
        $residential3 = true;
    }
    $residential_note= $report->residential_note;
}
//  3. Сертификат за семена
if(!isset($report)){
    $specialized1 = false;
    $specialized2 = false;
    $specialized3 = false;
    $specialized_note= null;
}
else{
    if($report->specialized == 0){
        $specialized1 = false;
        $specialized2 = false;
        $specialized3 = false;
    }
    if($report->specialized == 1){
        $specialized1 = true;
        $specialized2 = false;
        $specialized3 = false;
    }
    if($report->specialized == 2){
        $specialized1 = false;
        $specialized2 = true;
        $specialized3 = false;
    }
    if($report->specialized == 3){
        $specialized1 = false;
        $specialized2 = false;
        $specialized3 = true;
    }
    $specialized_note= $report->specialized_note;
}
//  4. Сертификат по чл. 83 от ЗЗР
if(!isset($report)){
    $technique1 = false;
    $technique2 = false;
    $technique3 = false;
    $technique_note= null;
}
else{
    if($report->technique == 0){
        $technique1 = false;
        $technique2 = false;
        $technique3 = false;
    }
    if($report->technique == 1){
        $technique1 = true;
        $technique2 = false;
        $technique3 = false;
    }
    if($report->technique == 2){
        $technique1 = false;
        $technique2 = true;
        $technique3 = false;
    }
    if($report->technique == 3){
        $technique1 = false;
        $technique2 = false;
        $technique3 = true;
    }
    $technique_note= $report->technique_note;
}
//  5. Протокол/и от изпитване
if(!isset($report)){
    $protective1 = false;
    $protective2 = false;
    $protective3 = false;
    $protective_note= null;
}
else{
    if($report->protective == 0){
        $protective1 = false;
        $protective2 = false;
        $protective3 = false;
    }
    if($report->protective == 1){
        $protective1 = true;
        $protective2 = false;
        $protective3 = false;
    }
    if($report->protective == 2){
        $protective1 = false;
        $protective2 = true;
        $protective3 = false;
    }
    if($report->protective == 3){
        $protective1 = false;
        $protective2 = false;
        $protective3 = true;
    }
    $protective_note= $report->protective_note;
}
//  6. Договор с фирма, вписана в
if(!isset($report)){
    $controls1 = false;
    $controls2 = false;
    $controls3 = false;
    $controls_note= null;
}
else{
    if($report->controls == 0){
        $controls1 = false;
        $controls2 = false;
        $controls3 = false;
    }
    if($report->controls == 1){
        $controls1 = true;
        $controls2 = false;
        $controls3 = false;
    }
    if($report->controls == 2){
        $controls1 = false;
        $controls2 = true;
        $controls3 = false;
    }
    if($report->controls == 3){
        $controls1 = false;
        $controls2 = false;
        $controls3 = true;
    }
    $controls_note= $report->controls_note;
}
//  7. Разрешение за прилагане на ПРЗ
if(!isset($report)){
    $access1 = false;
    $access2 = false;
    $access3 = false;
    $access_note= null;
}
else{
    if($report->access == 0){
        $access1 = false;
        $access2 = false;
        $access3 = false;
    }
    if($report->access == 1){
        $access1 = true;
        $access2 = false;
        $access3 = false;
    }
    if($report->access == 2){
        $access1 = false;
        $access2 = true;
        $access3 = false;
    }
    if($report->access == 3){
        $access1 = false;
        $access2 = false;
        $access3 = true;
    }
    $access_note= $report->access_note;
}
//  8. EPORD
if(!isset($report)){
    $disclosure1 = false;
    $disclosure2 = false;
    $disclosure3 = false;
    $disclosure_note= null;
}
else{
    if($report->disclosure == 0){
        $disclosure1 = false;
        $disclosure2 = false;
        $disclosure3 = false;
    }
    if($report->disclosure == 1){
        $disclosure1 = true;
        $disclosure2 = false;
        $disclosure3 = false;
    }
    if($report->disclosure == 2){
        $disclosure1 = false;
        $disclosure2 = true;
        $disclosure3 = false;
    }
    if($report->disclosure == 3){
        $disclosure1 = false;
        $disclosure2 = false;
        $disclosure3 = true;
    }
    $disclosure_note= $report->disclosure_note;
}
//  9. DOGOWOR ZA PRYSKANE
if(!isset($report)){
    $spraying1 = false;
    $spraying2 = false;
    $spraying3 = false;
    $spraying_note= null;
}
else{
    if($report->spraying == 0){
        $spraying1 = false;
        $spraying2 = false;
        $spraying3 = false;
    }
    if($report->spraying == 1){
        $spraying1 = true;
        $spraying2 = false;
        $spraying3 = false;
    }
    if($report->spraying == 2){
        $spraying1 = false;
        $spraying2 = true;
        $spraying3 = false;
    }
    if($report->spraying == 3){
        $spraying1 = false;
        $spraying2 = false;
        $spraying3 = true;
    }
    $spraying_note= $report->spraying_note;
}
$part = request()->segment(4);
?>
<div class="row" style="text-align: center; margin-bottom: 10px">
    <h3>Приложение с авиационна техника, Фумигация и Третиране на семена за посев</h3>
</div>
<fieldset class="small_field">
    <div class="col-md-12 act_wraps">
        <div class="col-md-12 col-md-6_my inspectors_divsd" >
            <button type="button" id="check_all_air" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i> Маркирай всички със Съответствие!
            </button>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <button type="button" id="check_none_air" class="btn btn-primary">
                <i class="fa fa-check" aria-hidden="true"></i> Маркирай всички с Непроверено!
            </button>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <button type="button" id="unchecked_air" class="btn btn-danger">
                <i class="fa fa-eraser" aria-hidden="true"></i> Изчисти!
            </button>
        </div>
    </div>
</fieldset>
<fieldset class="small_field"><legend class="small_legend">Елементи за проверка</legend>
    <div class="col-md-12 act_wrap" style="border-bottom: none">
        <div class="col-md-12 col-md-6_my inspectors_divs" >
            <fieldset class="mini_field"><legend class="small_legend">Приложение с авиационна техника</legend>
                {{--1Дневник за проведените--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">23. Скица на разположение на площите, подлежащи на третиране:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('layout', 1, $layout1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('layout', 2, $layout2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('layout', 3, $layout3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('layout_note', $layout_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 23:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--2Първични счетоводни документи--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">24. Спазване на отстояния от населеното място:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('inhabited', 1, $inhabited1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('inhabited', 2, $inhabited2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('inhabited', 3, $inhabited3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('inhabited_note', $inhabited_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 24:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--3Сертификат за семена и посадъчен--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">25. Бордови дневник на пилота:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('logbook', 1, $logbook1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('logbook', 2, $logbook2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('logbook', 3, $logbook3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('logbook_note', $logbook_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 25:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--4Сертификат по чл. 83 от ЗЗР--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">26. Доказателство за оповествяване в ЕПОРД:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('publication', 1, $publication1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('publication', 2, $publication2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('publication', 3, $publication3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('publication_note', $publication_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 26:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
            </fieldset>

            <fieldset class="mini_field"><legend class="small_legend">Фумигация</legend>
                {{--5Протокол/и от изпитване за остатъци--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">27. Документ за завършено обучене по фумигация:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('training', 1, $training1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('training', 2, $training2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('training', 3, $training3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('training_note', $training_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 27:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--6Договор с фирма, вписана в--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">28. Протокол от извършена дейност по фумигация:</span>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('protocol', 1, $protocol1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('protocol', 2, $protocol2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('protocol', 3, $protocol3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('protocol_note', $protocol_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 28:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--7 Разрешение за прилагане на ПРЗ--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">29. Обозначителна табела за забрана за достъп до обекта:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('sign', 1, $sign1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('sign', 2, $sign2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('sign', 3, $sign3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('sign_note', $sign_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 29:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--8Оповестяване на растителнозащитните дейности в ЕПОРД--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">30. Договор с агроном, който контролира фумигацията:</span>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('agronomist', 1, $agronomist1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('agronomist', 2, $agronomist2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('agronomist', 3, $agronomist3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('agronomist_note', $agronomist_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 30:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--9Договор за извършване на услугата пръскане--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">31. Налични документи при извършване на фумигация в земеделското стопанство:</span>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('documents', 1, $documents1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('documents', 2, $documents2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('documents', 3, $documents3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('documents_note', $documents_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 31:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
            </fieldset>

            <fieldset class="mini_field"><legend class="small_legend">Третиране на семена за посев</legend>
                {{--1Дневник за проведените--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">32. Извършва се със специализирана техника:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('equipment', 1, $equipment1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('equipment', 2, $equipment2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('equipment', 3, $equipment3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('equipment_note', $equipment_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 32:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--2Първични счетоводни документи--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">33. Отстояние от жилищни сгради:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('residential', 1, $residential1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('residential', 2, $residential2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('residential', 3, $residential3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('residential_note', $residential_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 33:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--3Сертификат за семена и посадъчен--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">&nbsp;&nbsp;&nbsp;&nbsp;33.1 500 м на специализирани обекти:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('specialized', 1, $specialized1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('specialized', 2, $specialized2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('specialized', 3, $specialized3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('specialized_note', $specialized_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 33.1:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--4Сертификат по чл. 83 от ЗЗР--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">&nbsp;&nbsp;&nbsp;&nbsp;33.2 100 м на техника за мобилно третиране:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('technique', 1, $technique1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('technique', 2, $technique2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('technique', 3, $technique3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('technique_note', $technique_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 33.2:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--5Протокол/и от изпитване за остатъци--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">34. Използване на защитно облекло:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('protective', 1, $protective1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('protective', 2, $protective2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('protective', 3, $protective3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('protective_note', $protective_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 34:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--6Договор с фирма, вписана в--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">35. Договор с агроном, който контролира процеса на обеззаразяване на семена:</span>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('controls', 1, $controls1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('controls', 2, $controls2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('controls', 3, $controls3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('controls_note', $controls_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 35:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--7 Разрешение за прилагане на ПРЗ--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">36. Склад с ограничен достъп за съхранение на чували с третирани семена:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('access', 1, $access1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('access', 2, $access2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('access', 3, $access3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('access_note', $access_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 36:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>

            </fieldset>
        </div>
    </div>

</fieldset>
