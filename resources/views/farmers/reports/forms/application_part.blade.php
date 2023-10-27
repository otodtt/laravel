<?php
if(!isset($protocols)){
    $diary1 = false;
    $diary2 = false;
    $diary3 = false;
    $diary_note= null;
}
else{
    if($protocols->diary == 0){
        $diary1 = false;
        $diary2 = false;
        $diary3 = false;
    }
    if($protocols->diary == 1){
        $diary1 = true;
        $diary2 = false;
        $diary3 = false;
    }
    if($protocols->diary == 2){
        $diary1 = false;
        $diary2 = true;
        $diary3 = false;
    }
    if($protocols->diary == 3){
        $diary1 = false;
        $diary2 = false;
        $diary3 = true;
    }
    $diary_note= $protocols->diary_note;
}
//  2. Първични счетоводни документи
if(!isset($protocols)){
    $primary1 = false;
    $primary2 = false;
    $primary3 = false;
    $primary_note= null;
}
else{
    if($protocols->primary == 0){
        $primary1 = false;
        $primary2 = false;
        $primary3 = false;
    }
    if($protocols->primary == 1){
        $primary1 = true;
        $primary2 = false;
        $primary3 = false;
    }
    if($protocols->primary == 2){
        $primary1 = false;
        $primary2 = true;
        $primary3 = false;
    }
    if($protocols->primary == 3){
        $primary1 = false;
        $primary2 = false;
        $primary3 = true;
    }
    $primary_note= $protocols->primary_note;
}
//  3. Сертификат за семена
if(!isset($protocols)){
    $seeds1 = false;
    $seeds2 = false;
    $seeds3 = false;
    $seeds_note= null;
}
else{
    if($protocols->seeds == 0){
        $seeds1 = false;
        $seeds2 = false;
        $seeds3 = false;
    }
    if($protocols->seeds == 1){
        $seeds1 = true;
        $seeds2 = false;
        $seeds3 = false;
    }
    if($protocols->seeds == 2){
        $seeds1 = false;
        $seeds2 = true;
        $seeds3 = false;
    }
    if($protocols->seeds == 3){
        $seeds1 = false;
        $seeds2 = false;
        $seeds3 = true;
    }
    $seeds_note= $protocols->seeds_note;
}
//  4. Сертификат по чл. 83 от ЗЗР
if(!isset($protocols)){
    $certificate1 = false;
    $certificate2 = false;
    $certificate3 = false;
    $certificate_note= null;
}
else{
    if($protocols->certificate == 0){
        $certificate1 = false;
        $certificate2 = false;
        $certificate3 = false;
    }
    if($protocols->certificate == 1){
        $certificate1 = true;
        $certificate2 = false;
        $certificate3 = false;
    }
    if($protocols->certificate == 2){
        $certificate1 = false;
        $certificate2 = true;
        $certificate3 = false;
    }
    if($protocols->certificate == 3){
        $certificate1 = false;
        $certificate2 = false;
        $certificate3 = true;
    }
    $certificate_note= $protocols->certificate_note;
}
//  5. Протокол/и от изпитване 
if(!isset($protocols)){
    $testing1 = false;
    $testing2 = false;
    $testing3 = false;
    $testing_note= null;
}
else{
    if($protocols->testing == 0){
        $testing1 = false;
        $testing2 = false;
        $testing3 = false;
    }
    if($protocols->testing == 1){
        $testing1 = true;
        $testing2 = false;
        $testing3 = false;
    }
    if($protocols->testing == 2){
        $testing1 = false;
        $testing2 = true;
        $testing3 = false;
    }
    if($protocols->testing == 3){
        $testing1 = false;
        $testing2 = false;
        $testing3 = true;
    }
    $testing_note= $protocols->testing_note;
}
//  6. Договор с фирма, вписана в
if(!isset($protocols)){
    $contract1 = false;
    $contract2 = false;
    $contract3 = false;
    $contract_note= null;
}
else{
    if($protocols->contract == 0){
        $contract1 = false;
        $contract2 = false;
        $contract3 = false;
    }
    if($protocols->contract == 1){
        $contract1 = true;
        $contract2 = false;
        $contract3 = false;
    }
    if($protocols->contract == 2){
        $contract1 = false;
        $contract2 = true;
        $contract3 = false;
    }
    if($protocols->contract == 3){
        $contract1 = false;
        $contract2 = false;
        $contract3 = true;
    }
    $contract_note= $protocols->contract_note;
}
//  7. Разрешение за прилагане на ПРЗ
if(!isset($protocols)){
    $permit1 = false;
    $permit2 = false;
    $permit3 = false;
    $permit_note= null;
}
else{
    if($protocols->permit == 0){
        $permit1 = false;
        $permit2 = false;
        $permit3 = false;
    }
    if($protocols->permit == 1){
        $permit1 = true;
        $permit2 = false;
        $permit3 = false;
    }
    if($protocols->permit == 2){
        $permit1 = false;
        $permit2 = true;
        $permit3 = false;
    }
    if($protocols->permit == 3){
        $permit1 = false;
        $permit2 = false;
        $permit3 = true;
    }
    $permit_note= $protocols->permit_note;
}
//  8. EPORD
if(!isset($protocols)){
    $disclosure1 = false;
    $disclosure2 = false;
    $disclosure3 = false;
    $disclosure_note= null;
}
else{
    if($protocols->disclosure == 0){
        $disclosure1 = false;
        $disclosure2 = false;
        $disclosure3 = false;
    }
    if($protocols->disclosure == 1){
        $disclosure1 = true;
        $disclosure2 = false;
        $disclosure3 = false;
    }
    if($protocols->disclosure == 2){
        $disclosure1 = false;
        $disclosure2 = true;
        $disclosure3 = false;
    }
    if($protocols->disclosure == 3){
        $disclosure1 = false;
        $disclosure2 = false;
        $disclosure3 = true;
    }
    $disclosure_note= $protocols->disclosure_note;
}
//  9. DOGOWOR ZA PRYSKANE
if(!isset($protocols)){
    $spraying1 = false;
    $spraying2 = false;
    $spraying3 = false;
    $spraying_note= null;
}
else{
    if($protocols->spraying == 0){
        $spraying1 = false;
        $spraying2 = false;
        $spraying3 = false;
    }
    if($protocols->spraying == 1){
        $spraying1 = true;
        $spraying2 = false;
        $spraying3 = false;
    }
    if($protocols->spraying == 2){
        $spraying1 = false;
        $spraying2 = true;
        $spraying3 = false;
    }
    if($protocols->spraying == 3){
        $spraying1 = false;
        $spraying2 = false;
        $spraying3 = true;
    }
    $spraying_note= $protocols->spraying_note;
}

?>
<fieldset class="small_field">
    <div class="col-md-12 act_wraps">
        <div class="col-md-12 col-md-6_my inspectors_divsd" >
            <button type="button" id="check_all" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i> Маркирай всички със Съответствие!
            </button>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <button type="button" id="check_none" class="btn btn-primary">
                <i class="fa fa-check" aria-hidden="true"></i> Маркирай всички с Непроверено!
            </button>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <button type="button" id="unchecked" class="btn btn-danger">
                <i class="fa fa-eraser" aria-hidden="true"></i> Изчисти!
            </button>
        </div>
    </div>
</fieldset>
<fieldset class="small_field"><legend class="small_legend">Елементи за проверка</legend>
    <div class="col-md-12 act_wrap" style="border-bottom: none">
        <div class="col-md-12 col-md-6_my inspectors_divs" >
            <fieldset class="mini_field"><legend class="small_legend">Обща част</legend>
                {{--1Дневник за проведените--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">1. Дневник за проведените растителназащитни мероприятия и торене по образец:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('diary', 1, $diary1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('diary', 2, $diary2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('diary', 3, $diary3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('diary_note', $diary_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 1:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--2Първични счетоводни документи--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">2. Първични счетоводни документи на закупените ПРЗ:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('primary', 1, $primary1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('primary', 2, $primary2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('primary', 3, $primary3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('primary_note', $primary_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 2:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--3Сертификат за семена и посадъчен--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">3. Сертификат за семена и посадъчен материал:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('seeds', 1, $seeds1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('seeds', 2, $seeds2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('seeds', 3, $seeds3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('seeds_note', $seeds_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 3:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--4Сертификат по чл. 83 от ЗЗР--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">4. Сертификат по чл. 83 от ЗЗР:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('certificate', 1, $certificate1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('certificate', 2, $certificate2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('certificate', 3, $certificate3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('certificate_note', $certificate_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 4:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--5Протокол/и от изпитване за остатъци--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">
                            5. Протокол/и от изпитване за остатъци
                            от пестициди на растителна проба,
                            взета за самоконтрола:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('testing', 1, $testing1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('testing', 2, $testing2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('testing', 3, $testing3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('testing_note', $testing_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 5:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--6Договор с фирма, вписана в--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">
                            6. Договор с фирма, вписана в регистъра
                            на лицата, притежаващи
                            документи за извършване на дейности с
                            опасни отпадъци на ИАОС:</span>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('contract', 1, $contract1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('contract', 2, $contract2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('contract', 3, $contract3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('contract_note', $contract_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 6:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--7 Разрешение за прилагане на ПРЗ--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">7. Разрешение за прилагане на ПРЗ чрез въздушно третиране:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('permit', 1, $permit1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('permit', 2, $permit2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('permit', 3, $permit3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('permit_note', $permit_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 7:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--8Оповестяване на растителнозащитните дейности в ЕПОРД--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">
                            8. Оповестяване на растителнозащитните дейности в ЕПОРД:</span>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('disclosure', 1, $disclosure1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('disclosure', 2, $disclosure2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('disclosure', 3, $disclosure3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('disclosure_note', $disclosure_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 8:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--9Договор за извършване на услугата пръскане--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">
                            9. Договор за извършване на услугата пръскане с ПРЗ на земеделски култури:</span>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('spraying', 1, $spraying1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('spraying', 2, $spraying2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('spraying', 3, $spraying3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('spraying_note', $spraying_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 9:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
            </fieldset>
        </div>
    </div>

</fieldset>
