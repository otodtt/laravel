<?php
if(!isset($report)){
    $permission1 = false;
    $permission2 = false;
    $permission3 = false;
    $permission_note= null;
}
else{
    if($report->permission == 0){
        $permission1 = false;
        $permission2 = false;
        $permission3 = false;
    }
    if($report->permission == 1){
        $permission1 = true;
        $permission2 = false;
        $permission3 = false;
    }
    if($report->permission == 2){
        $permission1 = false;
        $permission2 = true;
        $permission3 = false;
    }
    if($report->permission == 3){
        $permission1 = false;
        $permission2 = false;
        $permission3 = true;
    }
    $permission_note= $report->permission_note;
}
//  2. Първични счетоводни документи
if(!isset($report)){
    $relevant1 = false;
    $relevant2 = false;
    $relevant3 = false;
    $relevant_note= null;
}
else{
    if($report->relevant == 0){
        $relevant1 = false;
        $relevant2 = false;
        $relevant3 = false;
    }
    if($report->relevant == 1){
        $relevant1 = true;
        $relevant2 = false;
        $relevant3 = false;
    }
    if($report->relevant == 2){
        $relevant1 = false;
        $relevant2 = true;
        $relevant3 = false;
    }
    if($report->relevant == 3){
        $relevant1 = false;
        $relevant2 = false;
        $relevant3 = true;
    }
    $relevant_note= $report->relevant_note;
}
//  3. Сертификат за семена
if(!isset($report)){
    $concentration1 = false;
    $concentration2 = false;
    $concentration3 = false;
    $concentration_note= null;
}
else{
    if($report->concentration == 0){
        $concentration1 = false;
        $concentration2 = false;
        $concentration3 = false;
    }
    if($report->concentration == 1){
        $concentration1 = true;
        $concentration2 = false;
        $concentration3 = false;
    }
    if($report->concentration == 2){
        $concentration1 = false;
        $concentration2 = true;
        $concentration3 = false;
    }
    if($report->concentration == 3){
        $concentration1 = false;
        $concentration2 = false;
        $concentration3 = true;
    }
    $concentration_note= $report->concentration_note;
}
//  4. Сертификат по чл. 83 от ЗЗР
if(!isset($report)){
    $phenophase1 = false;
    $phenophase2 = false;
    $phenophase3 = false;
    $phenophase_note= null;
}
else{
    if($report->phenophase == 0){
        $phenophase1 = false;
        $phenophase2 = false;
        $phenophase3 = false;
    }
    if($report->phenophase == 1){
        $phenophase1 = true;
        $phenophase2 = false;
        $phenophase3 = false;
    }
    if($report->phenophase == 2){
        $phenophase1 = false;
        $phenophase2 = true;
        $phenophase3 = false;
    }
    if($report->phenophase == 3){
        $phenophase1 = false;
        $phenophase2 = false;
        $phenophase3 = true;
    }
    $phenophase_note= $report->phenophase_note;
}
//  5. Протокол/и от изпитване 
if(!isset($report)){
    $distances1 = false;
    $distances2 = false;
    $distances3 = false;
    $distances_note= null;
}
else{
    if($report->distances == 0){
        $distances1 = false;
        $distances2 = false;
        $distances3 = false;
    }
    if($report->distances == 1){
        $distances1 = true;
        $distances2 = false;
        $distances3 = false;
    }
    if($report->distances == 2){
        $distances1 = false;
        $distances2 = true;
        $distances3 = false;
    }
    if($report->distances == 3){
        $distances1 = false;
        $distances2 = false;
        $distances3 = true;
    }
    $distances_note= $report->distances_note;
}
//  6. Договор с фирма, вписана в
if(!isset($report)){
    $buildings1 = false;
    $buildings2 = false;
    $buildings3 = false;
    $buildings_note= null;
}
else{
    if($report->buildings == 0){
        $buildings1 = false;
        $buildings2 = false;
        $buildings3 = false;
    }
    if($report->buildings == 1){
        $buildings1 = true;
        $buildings2 = false;
        $buildings3 = false;
    }
    if($report->buildings == 2){
        $buildings1 = false;
        $buildings2 = true;
        $buildings3 = false;
    }
    if($report->buildings == 3){
        $buildings1 = false;
        $buildings2 = false;
        $buildings3 = true;
    }
    $buildings_note= $report->buildings_note;
}
//  7. Разрешение за прилагане на ПРЗ
if(!isset($report)){
    $watersheds1 = false;
    $watersheds2 = false;
    $watersheds3 = false;
    $watersheds_note= null;
}
else{
    if($report->watersheds == 0){
        $watersheds1 = false;
        $watersheds2 = false;
        $watersheds3 = false;
    }
    if($report->watersheds == 1){
        $watersheds1 = true;
        $watersheds2 = false;
        $watersheds3 = false;
    }
    if($report->watersheds == 2){
        $watersheds1 = false;
        $watersheds2 = true;
        $watersheds3 = false;
    }
    if($report->watersheds == 3){
        $watersheds1 = false;
        $watersheds2 = false;
        $watersheds3 = true;
    }
    $watersheds_note= $report->watersheds_note;
}
//  8. EPORD
if(!isset($report)){
    $irrigation1 = false;
    $irrigation2 = false;
    $irrigation3 = false;
    $irrigation_note= null;
}
else{
    if($report->irrigation == 0){
        $irrigation1 = false;
        $irrigation2 = false;
        $irrigation3 = false;
    }
    if($report->irrigation == 1){
        $irrigation1 = true;
        $irrigation2 = false;
        $irrigation3 = false;
    }
    if($report->irrigation == 2){
        $irrigation1 = false;
        $irrigation2 = true;
        $irrigation3 = false;
    }
    if($report->irrigation == 3){
        $irrigation1 = false;
        $irrigation2 = false;
        $irrigation3 = true;
    }
    $irrigation_note= $report->irrigation_note;
}
//  9. DOGOWOR ZA PRYSKANE
if(!isset($report)){
    $protected1 = false;
    $protected2 = false;
    $protected3 = false;
    $protected_note= null;
}
else{
    if($report->protected == 0){
        $protected1 = false;
        $protected2 = false;
        $protected3 = false;
    }
    if($report->protected == 1){
        $protected1 = true;
        $protected2 = false;
        $protected3 = false;
    }
    if($report->protected == 2){
        $protected1 = false;
        $protected2 = true;
        $protected3 = false;
    }
    if($report->protected == 3){
        $protected1 = false;
        $protected2 = false;
        $protected3 = true;
    }
    $protected_note= $report->protected_note;
}

// 10. CLEANINGD
if(!isset($report)){
    $cleaning1 = false;
    $cleaning2 = false;
    $cleaning3 = false;
    $cleaning_note= null;
}
else{
    if($report->cleaning == 0){
        $cleaning1 = false;
        $cleaning2 = false;
        $cleaning3 = false;
    }
    if($report->cleaning == 1){
        $cleaning1 = true;
        $cleaning2 = false;
        $cleaning3 = false;
    }
    if($report->cleaning == 2){
        $cleaning1 = false;
        $cleaning2 = true;
        $cleaning3 = false;
    }
    if($report->cleaning == 3){
        $cleaning1 = false;
        $cleaning2 = false;
        $cleaning3 = true;
    }
    $cleaning_note= $report->cleaning_note;
}

//  3. Сертификат за семена
if(!isset($report)){
    $evidence1 = false;
    $evidence2 = false;
    $evidence3 = false;
    $evidence_note= null;
}
else{
    if($report->evidence == 0){
        $evidence1 = false;
        $evidence2 = false;
        $evidence3 = false;
    }
    if($report->evidence == 1){
        $evidence1 = true;
        $evidence2 = false;
        $evidence3 = false;
    }
    if($report->evidence == 2){
        $evidence1 = false;
        $evidence2 = true;
        $evidence3 = false;
    }
    if($report->evidence == 3){
        $evidence1 = false;
        $evidence2 = false;
        $evidence3 = true;
    }
    $evidence_note= $report->evidence_note;
}
$part = request()->segment(4);
?>
<div class="row" style="text-align: center; margin-bottom: 10px">
    <h3>Приложение на ПРЗ</h3>
</div>
<fieldset class="small_field">
    <div class="col-md-12 act_wraps">
        <div class="col-md-12 col-md-6_my inspectors_divsd" >
            <button type="button" id="check_all_app" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i> Маркирай всички със Съответствие!
            </button>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <button type="button" id="check_none_app" class="btn btn-primary">
                <i class="fa fa-check" aria-hidden="true"></i> Маркирай всички с Непроверено!
            </button>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <button type="button" id="unchecked_app" class="btn btn-danger">
                <i class="fa fa-eraser" aria-hidden="true"></i> Изчисти!
            </button>
        </div>
    </div>
</fieldset>
<fieldset class="small_field"><legend class="small_legend">Елементи за проверка</legend>
    <div class="col-md-12 act_wrap" style="border-bottom: none">
        <div class="col-md-12 col-md-6_my inspectors_divs" >
            <fieldset class="mini_field"><legend class="small_legend">Приложение на ПРЗ</legend>
                {!! Form::open(['url'=>'доклад-зс/fourth/'.$farmer->id.'/'.$report->id , 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}
                {{--@else--}}
                    {{--{!! Form::model($report, ['url'=>'доклад-зс/fourth/'.$farmer->id.'/'.$report->id  , 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}--}}
                {{--@endif--}}
                    {{--1Дневник за проведените--}}
                    <div class="row" style="margin-left: 0; margin-right: 0">
                        <div class="col-md-4 col-md-6_my" >
                            <span class="bold">16. Разрешение за употреба на ПРЗ:</span>&nbsp;&nbsp;
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="act"><span>Съответствие : </span>
                                {!! Form::radio('permission', 1, $permission1) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                {!! Form::radio('permission', 2, $permission2) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                                {!! Form::radio('permission', 3, $permission3) !!}
                            </label>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="note">
                                {!! Form::text('permission_note', $permission_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 16:' ]) !!}
                            </label>
                        </div>
                        <hr class="my_hr"/>
                    </div>
                    {{--2Първични счетоводни документи--}}
                    <div class="row" style="margin-left: 0; margin-right: 0">
                        <div class="col-md-4 col-md-6_my" >
                            <span class="bold">17. Разрешение за съответната култура и вредител:</span>&nbsp;&nbsp;
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="act"><span>Съответствие : </span>
                                {!! Form::radio('relevant', 1, $relevant1) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                {!! Form::radio('relevant', 2, $relevant2) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                                {!! Form::radio('relevant', 3, $relevant3) !!}
                            </label>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="note">
                                {!! Form::text('relevant_note', $relevant_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 17:' ]) !!}
                            </label>
                        </div>
                        <hr class="my_hr"/>
                    </div>
                    {{--3Сертификат за семена и посадъчен--}}
                    <div class="row" style="margin-left: 0; margin-right: 0">
                        <div class="col-md-4 col-md-6_my" >
                            <span class="bold">18. Доза/концентрация на ПРЗ:</span>&nbsp;&nbsp;
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="act"><span>Съответствие : </span>
                                {!! Form::radio('concentration', 1, $concentration1) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                {!! Form::radio('concentration', 2, $concentration2) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                                {!! Form::radio('concentration', 3, $concentration3) !!}
                            </label>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="note">
                                {!! Form::text('concentration_note', $concentration_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 18:' ]) !!}
                            </label>
                        </div>
                        <hr class="my_hr"/>
                    </div>
                    {{--4Сертификат по чл. 83 от ЗЗР--}}
                    <div class="row" style="margin-left: 0; margin-right: 0">
                        <div class="col-md-4 col-md-6_my" >
                            <span class="bold">19. Фенофаза на културата:</span>&nbsp;&nbsp;
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="act"><span>Съответствие : </span>
                                {!! Form::radio('phenophase', 1, $phenophase1) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                {!! Form::radio('phenophase', 2, $phenophase2) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                                {!! Form::radio('phenophase', 3, $phenophase3) !!}
                            </label>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="note">
                                {!! Form::text('phenophase_note', $phenophase_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 19:' ]) !!}
                            </label>
                        </div>
                        <hr class="my_hr"/>
                    </div>
                    {{--5Протокол/и от изпитване за остатъци--}}
                    <div class="row" style="margin-left: 0; margin-right: 0">
                        <div class="col-md-4 col-md-6_my" >
                            <span class="bold">
                                20. Отстояния при приготвяне на работния разтвор:</span>&nbsp;&nbsp;
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="act"><span>Съответствие : </span>
                                {!! Form::radio('distances', 1, $distances1) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                {!! Form::radio('distances', 2, $distances2) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                                {!! Form::radio('distances', 3, $distances3) !!}
                            </label>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="note">
                                {!! Form::text('distances_note', $distances_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 20:' ]) !!}
                            </label>
                        </div>
                        <hr class="my_hr"/>
                    </div>
                    {{--6Договор с фирма, вписана в--}}
                    <div class="row" style="margin-left: 0; margin-right: 0">
                        <div class="col-md-4 col-md-6_my" >
                            <span class="bold">&nbsp;&nbsp;&nbsp;&nbsp;20.1 100 м от административни и жилищни сгради и пчелини:</span>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="act"><span>Съответствие : </span>
                                {!! Form::radio('buildings', 1, $buildings1) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                {!! Form::radio('buildings', 2, $buildings2) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                                {!! Form::radio('buildings', 3, $buildings3) !!}
                            </label>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="note">
                                {!! Form::text('buildings_note', $buildings_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 20.1:' ]) !!}
                            </label>
                        </div>
                        <hr class="my_hr"/>
                    </div>
                    {{--7 Разрешение за прилагане на ПРЗ--}}
                    <div class="row" style="margin-left: 0; margin-right: 0">
                        <div class="col-md-4 col-md-6_my" >
                            <span class="bold">&nbsp;&nbsp;&nbsp;&nbsp;20.2 200 м от повърхностни водни обекти, водоизточници и вододайни зони:</span>&nbsp;&nbsp;
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="act"><span>Съответствие : </span>
                                {!! Form::radio('watersheds', 1, $watersheds1) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                {!! Form::radio('watersheds', 2, $watersheds2) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                                {!! Form::radio('watersheds', 3, $watersheds3) !!}
                            </label>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="note">
                                {!! Form::text('watersheds_note', $watersheds_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 20.2:' ]) !!}
                            </label>
                        </div>
                        <hr class="my_hr"/>
                    </div>
                    {{--8Оповестяване на растителнозащитните дейности в ЕПОРД--}}
                    <div class="row" style="margin-left: 0; margin-right: 0">
                        <div class="col-md-4 col-md-6_my" >
                            <span class="bold">&nbsp;&nbsp;&nbsp;&nbsp;20.3 25 м от напоителни канали:</span>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="act"><span>Съответствие : </span>
                                {!! Form::radio('irrigation', 1, $irrigation1) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                {!! Form::radio('irrigation', 2, $irrigation2) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                                {!! Form::radio('irrigation', 3, $irrigation3) !!}
                            </label>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="note">
                                {!! Form::text('irrigation_note', $irrigation_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 20.3:' ]) !!}
                            </label>
                        </div>
                        <hr class="my_hr"/>
                    </div>
                    {{--9Договор за извършване на услугата пръскане--}}
                    <div class="row" style="margin-left: 0; margin-right: 0">
                        <div class="col-md-4 col-md-6_my" >
                            <span class="bold">
                                &nbsp;&nbsp;&nbsp;&nbsp;20.4 100 м от защитени територии по смисъла на Закона за защитените територии, и защитени
                                зони по смисъла на Закона за биологичното разнообразие:
                            </span>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="act"><span>Съответствие : </span>
                                {!! Form::radio('protected', 1, $protected1) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                {!! Form::radio('protected', 2, $protected2) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                                {!! Form::radio('protected', 3, $protected3) !!}
                            </label>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="note">
                                {!! Form::text('protected_note', $protected_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 20.4:' ]) !!}
                            </label>
                        </div>
                        <hr class="my_hr"/>
                    </div>
                    {{--9Договор за извършване на услугата пръскане--}}
                    <div class="row" style="margin-left: 0; margin-right: 0">
                        <div class="col-md-4 col-md-6_my" >
                            <span class="bold">
                                21. Обособено място за почистване на техниката и оборудването за прилагане на ПРЗ :
                            </span>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="act"><span>Съответствие : </span>
                                {!! Form::radio('cleaning', 1, $cleaning1) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                {!! Form::radio('cleaning', 2, $cleaning2) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                                {!! Form::radio('cleaning', 3, $cleaning3) !!}
                            </label>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="note">
                                {!! Form::text('cleaning_note', $cleaning_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 21:' ]) !!}
                            </label>
                        </div>
                        <hr class="my_hr"/>
                    </div>
                    {{--22 Сертификат за семена и посадъчен--}}
                    <div class="row" style="margin-left: 0; margin-right: 0">
                        <div class="col-md-4 col-md-6_my" >
                            <span class="bold">22. Доказателство за оповестяване на растителнозащитните дейности в ЕПОРД:</span>&nbsp;&nbsp;
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="act"><span>Съответствие : </span>
                                {!! Form::radio('evidence', 1, $evidence1) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                {!! Form::radio('evidence', 2, $evidence2) !!}
                            </label>&nbsp;&nbsp;|
                            <label class="act"><span>&nbsp;&nbsp;Неприложимо : </span>
                                {!! Form::radio('evidence', 3, $evidence3) !!}
                            </label>
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            <label class="note">
                                {!! Form::text('evidence_note', $evidence_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 22:' ]) !!}
                            </label>
                        </div>
                        <hr class="my_hr"/>
                    </div>
            </fieldset>
        </div>
    </div>
    <input type="hidden" name="is_all" value="4" >
    <div class="row">
        @if( $part == 4 && $report->fourth == 1 )
            <div class="col-md-4" style="text-align: center">
                <br>
                <a href="{{ '/доклад-добави/'.$farmer->id.'/'.$report->id.'/3' }}" class="fa fa-arrow-left btn btn-info my_btn-success" id="first">
                    НАЗАД
                </a>
            </div>
            <div class="col-md-4" style="text-align: center">
                <p>Редактирай само ако необходимо. В противен случай - натисни бутона "НАПРЕД"</p>
                {!! Form::submit('Редактирай ако е необходимо!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
            <div>
                <div class="col-md-4" style="text-align: center">
                    <br>
                    <a href="{{ '/доклад-добави/'.$farmer->id.'/'.$report->id.'/5' }}" class=" btn btn-success my_btn-success" id="first">
                        НАПРЕД <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        @else
            <div class="col-md-4" style="text-align: center">
                <a href="{{ '/доклад-добави/'.$farmer->id.'/'.$report->id.'/3' }}" class="fa fa-arrow-left btn btn-info my_btn-success" id="first">
                    НАЗАД
                </a>
            </div>
            <div class="col-md-4" style="text-align: center">
                {!! Form::submit('Добави и продължи!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
        @endif
    </div>
    {!! Form::close() !!}
</fieldset>
