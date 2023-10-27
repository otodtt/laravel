<?php
if(!isset($report)){
    $rotation1 = false;
    $rotation2 = false;
    $rotation3 = false;
    $rotation_note= null;
}
else{
    if($report->rotation == 0){
        $rotation1 = false;
        $rotation2 = false;
        $rotation3 = false;
    }
    if($report->rotation == 1){
        $rotation1 = true;
        $rotation2 = false;
        $rotation3 = false;
    }
    if($report->rotation == 2){
        $rotation1 = false;
        $rotation2 = true;
        $rotation3 = false;
    }
    if($report->rotation == 3){
        $rotation1 = false;
        $rotation2 = false;
        $rotation3 = true;
    }
    $rotation_note= $report->rotation_note;
}
//  2. Първични счетоводни документи
if(!isset($report)){
    $appropriate1 = false;
    $appropriate2 = false;
    $appropriate3 = false;
    $appropriate_note= null;
}
else{
    if($report->appropriate == 0){
        $appropriate1 = false;
        $appropriate2 = false;
        $appropriate3 = false;
    }
    if($report->appropriate == 1){
        $appropriate1 = true;
        $appropriate2 = false;
        $appropriate3 = false;
    }
    if($report->appropriate == 2){
        $appropriate1 = false;
        $appropriate2 = true;
        $appropriate3 = false;
    }
    if($report->appropriate == 3){
        $appropriate1 = false;
        $appropriate2 = false;
        $appropriate3 = true;
    }
    $appropriate_note= $report->appropriate_note;
}
//  3. Сертификат за семена
if(!isset($report)){
    $standard1 = false;
    $standard2 = false;
    $standard3 = false;
    $standard_note= null;
}
else{
    if($report->standard == 0){
        $standard1 = false;
        $standard2 = false;
        $standard3 = false;
    }
    if($report->standard == 1){
        $standard1 = true;
        $standard2 = false;
        $standard3 = false;
    }
    if($report->standard == 2){
        $standard1 = false;
        $standard2 = true;
        $standard3 = false;
    }
    if($report->standard == 3){
        $standard1 = false;
        $standard2 = false;
        $standard3 = true;
    }
    $standard_note= $report->standard_note;
}
//  4. Сертификат по чл. 83 от ЗЗР
if(!isset($report)){
    $balanced1 = false;
    $balanced2 = false;
    $balanced3 = false;
    $balanced_note= null;
}
else{
    if($report->balanced == 0){
        $balanced1 = false;
        $balanced2 = false;
        $balanced3 = false;
    }
    if($report->balanced == 1){
        $balanced1 = true;
        $balanced2 = false;
        $balanced3 = false;
    }
    if($report->balanced == 2){
        $balanced1 = false;
        $balanced2 = true;
        $balanced3 = false;
    }
    if($report->balanced == 3){
        $balanced1 = false;
        $balanced2 = false;
        $balanced3 = true;
    }
    $balanced_note= $report->balanced_note;
}
//  5. Протокол/и от изпитване 
if(!isset($report)){
    $sanitary1 = false;
    $sanitary2 = false;
    $sanitary3 = false;
    $sanitary_note= null;
}
else{
    if($report->sanitary == 0){
        $sanitary1 = false;
        $sanitary2 = false;
        $sanitary3 = false;
    }
    if($report->sanitary == 1){
        $sanitary1 = true;
        $sanitary2 = false;
        $sanitary3 = false;
    }
    if($report->sanitary == 2){
        $sanitary1 = false;
        $sanitary2 = true;
        $sanitary3 = false;
    }
    if($report->sanitary == 3){
        $sanitary1 = false;
        $sanitary2 = false;
        $sanitary3 = true;
    }
    $sanitary_note= $report->sanitary_note;
}
//  6. Договор с фирма, вписана в
if(!isset($report)){
    $cultivated1 = false;
    $cultivated2 = false;
    $cultivated3 = false;
    $cultivated_note= null;
}
else{
    if($report->cultivated == 0){
        $cultivated1 = false;
        $cultivated2 = false;
        $cultivated3 = false;
    }
    if($report->cultivated == 1){
        $cultivated1 = true;
        $cultivated2 = false;
        $cultivated3 = false;
    }
    if($report->cultivated == 2){
        $cultivated1 = false;
        $cultivated2 = true;
        $cultivated3 = false;
    }
    if($report->cultivated == 3){
        $cultivated1 = false;
        $cultivated2 = false;
        $cultivated3 = true;
    }
    $cultivated_note= $report->cultivated_note;
}
//  7. Разрешение за прилагане на ПРЗ
if(!isset($report)){
    $observations1 = false;
    $observations2 = false;
    $observations3 = false;
    $observations_note= null;
}
else{
    if($report->observations == 0){
        $observations1 = false;
        $observations2 = false;
        $observations3 = false;
    }
    if($report->observations == 1){
        $observations1 = true;
        $observations2 = false;
        $observations3 = false;
    }
    if($report->observations == 2){
        $observations1 = false;
        $observations2 = true;
        $observations3 = false;
    }
    if($report->observations == 3){
        $observations1 = false;
        $observations2 = false;
        $observations3 = true;
    }
    $observations_note= $report->observations_note;
}
//  8. EPORD
if(!isset($report)){
    $depending1 = false;
    $depending2 = false;
    $depending3 = false;
    $depending_note= null;
}
else{
    if($report->depending == 0){
        $depending1 = false;
        $depending2 = false;
        $depending3 = false;
    }
    if($report->depending == 1){
        $depending1 = true;
        $depending2 = false;
        $depending3 = false;
    }
    if($report->depending == 2){
        $depending1 = false;
        $depending2 = true;
        $depending3 = false;
    }
    if($report->depending == 3){
        $depending1 = false;
        $depending2 = false;
        $depending3 = true;
    }
    $depending_note= $report->depending_note;
}
//  9. DOGOWOR ZA PRYSKANE
if(!isset($report)){
    $chemical1 = false;
    $chemical2 = false;
    $chemical3 = false;
    $chemical_note= null;
}
else{
    if($report->chemical == 0){
        $chemical1 = false;
        $chemical2 = false;
        $chemical3 = false;
    }
    if($report->chemical == 1){
        $chemical1 = true;
        $chemical2 = false;
        $chemical3 = false;
    }
    if($report->chemical == 2){
        $chemical1 = false;
        $chemical2 = true;
        $chemical3 = false;
    }
    if($report->chemical == 3){
        $chemical1 = false;
        $chemical2 = false;
        $chemical3 = true;
    }
    $chemical_note= $report->chemical_note;
}
if(!isset($report)){
    $selective1 = false;
    $selective2 = false;
    $selective3 = false;
    $selective_note= null;
}
else{
    if($report->selective == 0){
        $selective1 = false;
        $selective2 = false;
        $selective3 = false;
    }
    if($report->selective == 1){
        $selective1 = true;
        $selective2 = false;
        $selective3 = false;
    }
    if($report->selective == 2){
        $selective1 = false;
        $selective2 = true;
        $selective3 = false;
    }
    if($report->selective == 3){
        $selective1 = false;
        $selective2 = false;
        $selective3 = true;
    }
    $selective_note= $report->selective_note;
}
//  2. Първични счетоводни документи
if(!isset($report)){
    $limiting1 = false;
    $limiting2 = false;
    $limiting3 = false;
    $limiting_note= null;
}
else{
    if($report->limiting == 0){
        $limiting1 = false;
        $limiting2 = false;
        $limiting3 = false;
    }
    if($report->limiting == 1){
        $limiting1 = true;
        $limiting2 = false;
        $limiting3 = false;
    }
    if($report->limiting == 2){
        $limiting1 = false;
        $limiting2 = true;
        $limiting3 = false;
    }
    if($report->limiting == 3){
        $limiting1 = false;
        $limiting2 = false;
        $limiting3 = true;
    }
    $limiting_note= $report->limiting_note;
}
//  3. Сертификат за семена
if(!isset($report)){
    $mechanism1 = false;
    $mechanism2 = false;
    $mechanism3 = false;
    $mechanism_note= null;
}
else{
    if($report->mechanism == 0){
        $mechanism1 = false;
        $mechanism2 = false;
        $mechanism3 = false;
    }
    if($report->mechanism == 1){
        $mechanism1 = true;
        $mechanism2 = false;
        $mechanism3 = false;
    }
    if($report->mechanism == 2){
        $mechanism1 = false;
        $mechanism2 = true;
        $mechanism3 = false;
    }
    if($report->mechanism == 3){
        $mechanism1 = false;
        $mechanism2 = false;
        $mechanism3 = true;
    }
    $mechanism_note= $report->mechanism_note;
}
//  4. Сертификат по чл. 83 от ЗЗР
if(!isset($report)){
    $effectiveness1 = false;
    $effectiveness2 = false;
    $effectiveness3 = false;
    $effectiveness_note= null;
}
else{
    if($report->effectiveness == 0){
        $effectiveness1 = false;
        $effectiveness2 = false;
        $effectiveness3 = false;
    }
    if($report->effectiveness == 1){
        $effectiveness1 = true;
        $effectiveness2 = false;
        $effectiveness3 = false;
    }
    if($report->effectiveness == 2){
        $effectiveness1 = false;
        $effectiveness2 = true;
        $effectiveness3 = false;
    }
    if($report->effectiveness == 3){
        $effectiveness1 = false;
        $effectiveness2 = false;
        $effectiveness3 = true;
    }
    $effectiveness_note= $report->effectiveness_note;
}
?>
<div class="row" style="text-align: center; margin-bottom: 10px">
    <h3>Спазване на общите принципи на интегрирано управление на вредителите</h3>
</div>
<fieldset class="small_field">
    <div class="col-md-12 act_wraps">
        <div class="col-md-12 col-md-6_my inspectors_divsd" >
            <button type="button" id="check_all_pest" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i> Маркирай всички със Съответствие!
            </button>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <button type="button" id="check_none_pest" class="btn btn-primary">
                <i class="fa fa-check" aria-hidden="true"></i> Маркирай всички с Непроверено!
            </button>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <button type="button" id="unchecked_pest" class="btn btn-danger">
                <i class="fa fa-eraser" aria-hidden="true"></i> Изчисти!
            </button>
        </div>
    </div>
</fieldset>
<fieldset class="small_field"><legend class="small_legend">Елементи за проверка</legend>
    <div class="col-md-12 act_wrap" style="border-bottom: none">
        <div class="col-md-12 col-md-6_my inspectors_divs" >
            <fieldset class="mini_field"><legend class="small_legend">Спазване на общите принципи на интегрирано управление на вредителите</legend>
                {{--1Дневник за проведените--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">37. Сеитбообръщение:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('rotation', 1, $rotation1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('rotation', 2, $rotation2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('rotation', 3, $rotation3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('rotation_note', $rotation_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 37:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--2Първични счетоводни документи--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">38. Провеждане на подходящи агротехнически мероприятия:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('appropriate', 1, $appropriate1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('appropriate', 2, $appropriate2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('appropriate', 3, $appropriate3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('appropriate_note', $appropriate_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 38:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--3Сертификат за семена и посадъчен--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">39. Използване на стандартни/сертифицирани семена и посадъчен материал:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('standard', 1, $standard1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('standard', 2, $standard2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('standard', 3, $standard3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('standard_note', $standard_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 39:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--4Сертификат по чл. 83 от ЗЗР--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">40. Прилагане на балансирано торене:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('balanced', 1, $balanced1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('balanced', 2, $balanced2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('balanced', 3, $balanced3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('balanced_note', $balanced_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 40:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--5Протокол/и от изпитване за остатъци--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">41. Прилагане на санитарни мерки - редовно почистване на машините и на оборудването:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('sanitary', 1, $sanitary1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('sanitary', 2, $sanitary2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('sanitary', 3, $sanitary3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('sanitary_note', $sanitary_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 41:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--6Договор с фирма, вписана в--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">42. Прилагане на подходящи растителнозащитни мерки в или извън обработваемите площи за опазване на полезните видове:</span>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('cultivated', 1, $cultivated1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('cultivated', 2, $cultivated2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('cultivated', 3, $cultivated3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('cultivated_note', $cultivated_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 42:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--7 Разрешение за прилагане на ПРЗ--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">43. Извършване на наблюдения за наличие на вредители:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('observations', 1, $observations1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('observations', 2, $observations2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('observations', 3, $observations3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('observations_note', $observations_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 43:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--8Оповестяване на растителнозащитните дейности в ЕПОРД--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">44. Приложени мерки за растителна защита в зависимост от ПИВ:</span>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('depending', 1, $depending1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('depending', 2, $depending2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('depending', 3, $depending3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('depending_note', $depending_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 44:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--9Договор за извършване на услугата пръскане--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">45. Употреба на нехимични методи:</span>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('chemical', 1, $chemical1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('chemical', 2, $chemical2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('chemical', 3, $chemical3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('chemical_note', $chemical_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 45:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--1Дневник за проведените--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">46. Прилагане на селективни ПРЗ:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('selective', 1, $selective1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('selective', 2, $selective2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('selective', 3, $selective3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('selective_note', $selective_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 46:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--2Първични счетоводни документи--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">47. Ограничаване употребата на пестициди до необходимата степен, чрез прилагане на ПРЗ в по-ниски дози, намален брой третирания или частично третиране:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('limiting', 1, $limiting1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('limiting', 2, $limiting2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('limiting', 3, $limiting3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('limiting_note', $limiting_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 47:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--3Сертификат за семена и посадъчен--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">48. Прилагане на ПРЗ с различен механизъм на действие:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('mechanism', 1, $mechanism1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('mechanism', 2, $mechanism2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('mechanism', 3, $mechanism3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('mechanism_note', $mechanism_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 48:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--4Сертификат по чл. 83 от ЗЗР--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">49. Проверка ефективността на приложените мерки за РЗ:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('effectiveness', 1, $effectiveness1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('effectiveness', 2, $effectiveness2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                            {!! Form::radio('effectiveness', 3, $effectiveness3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('effectiveness_note', $effectiveness_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 49:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
            </fieldset>
        </div>
    </div>

</fieldset>
