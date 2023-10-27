<?php
if(!isset($protocols)){
    $original1 = false;
    $original2 = false;
    $original3 = false;
    $original_note= null;
}
else{
    if($protocols->original == 0){
        $original1 = false;
        $original2 = false;
        $original3 = false;
    }
    if($protocols->original == 1){
        $original1 = true;
        $original2 = false;
        $original3 = false;
    }
    if($protocols->original == 2){
        $original1 = false;
        $original2 = true;
        $original3 = false;
    }
    if($protocols->original == 3){
        $original1 = false;
        $original2 = false;
        $original3 = true;
    }
    $original_note= $protocols->original_note;
}
//  2. Първични счетоводни документи
if(!isset($protocols)){
    $unauthorized1 = false;
    $unauthorized2 = false;
    $unauthorized3 = false;
    $unauthorized_note= null;
}
else{
    if($protocols->unauthorized == 0){
        $unauthorized1 = false;
        $unauthorized2 = false;
        $unauthorized3 = false;
    }
    if($protocols->unauthorized == 1){
        $unauthorized1 = true;
        $unauthorized2 = false;
        $unauthorized3 = false;
    }
    if($protocols->unauthorized == 2){
        $unauthorized1 = false;
        $unauthorized2 = true;
        $unauthorized3 = false;
    }
    if($protocols->unauthorized == 3){
        $unauthorized1 = false;
        $unauthorized2 = false;
        $unauthorized3 = true;
    }
    $unauthorized_note= $protocols->unauthorized_note;
}
//  3. Сертификат за семена
if(!isset($protocols)){
    $expiry1 = false;
    $expiry2 = false;
    $expiry3 = false;
    $expiry_note= null;
}
else{
    if($protocols->expiry == 0){
        $expiry1 = false;
        $expiry2 = false;
        $expiry3 = false;
    }
    if($protocols->expiry == 1){
        $expiry1 = true;
        $expiry2 = false;
        $expiry3 = false;
    }
    if($protocols->expiry == 2){
        $expiry1 = false;
        $expiry2 = true;
        $expiry3 = false;
    }
    if($protocols->expiry == 3){
        $expiry1 = false;
        $expiry2 = false;
        $expiry3 = true;
    }
    $expiry_note= $protocols->expiry_note;
}
//  4. Сертификат по чл. 83 от ЗЗР
if(!isset($protocols)){
    $allocation1 = false;
    $allocation2 = false;
    $allocation3 = false;
    $allocation_note= null;
}
else{
    if($protocols->allocation == 0){
        $allocation1 = false;
        $allocation2 = false;
        $allocation3 = false;
    }
    if($protocols->allocation == 1){
        $allocation1 = true;
        $allocation2 = false;
        $allocation3 = false;
    }
    if($protocols->allocation == 2){
        $allocation1 = false;
        $allocation2 = true;
        $allocation3 = false;
    }
    if($protocols->allocation == 3){
        $allocation1 = false;
        $allocation2 = false;
        $allocation3 = true;
    }
    $allocation_note= $protocols->allocation_note;
}
//  5. Протокол/и от изпитване 
if(!isset($protocols)){
    $metal1 = false;
    $metal2 = false;
    $metal3 = false;
    $metal_note= null;
}
else{
    if($protocols->metal == 0){
        $metal1 = false;
        $metal2 = false;
        $metal3 = false;
    }
    if($protocols->metal == 1){
        $metal1 = true;
        $metal2 = false;
        $metal3 = false;
    }
    if($protocols->metal == 2){
        $metal1 = false;
        $metal2 = true;
        $metal3 = false;
    }
    if($protocols->metal == 3){
        $metal1 = false;
        $metal2 = false;
        $metal3 = true;
    }
    $metal_note= $protocols->metal_note;
}
//  6. Договор с фирма, вписана в
if(!isset($protocols)){
    $empty1 = false;
    $empty2 = false;
    $empty3 = false;
    $empty_note= null;
}
else{
    if($protocols->empty == 0){
        $empty1 = false;
        $empty2 = false;
        $empty3 = false;
    }
    if($protocols->empty == 1){
        $empty1 = true;
        $empty2 = false;
        $empty3 = false;
    }
    if($protocols->empty == 2){
        $empty1 = false;
        $empty2 = true;
        $empty3 = false;
    }
    if($protocols->empty == 3){
        $empty1 = false;
        $empty2 = false;
        $empty3 = true;
    }
    $empty_note= $protocols->empty_note;
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
            <button type="button" id="check_all_storage" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i> Маркирай всички със Съответствие!
            </button>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <button type="button" id="check_none_storage" class="btn btn-primary">
                <i class="fa fa-check" aria-hidden="true"></i> Маркирай всички с Непроверено!
            </button>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <button type="button" id="unchecked_storage" class="btn btn-danger">
                <i class="fa fa-eraser" aria-hidden="true"></i> Изчисти!
            </button>
        </div>
    </div>
</fieldset>
<fieldset class="small_field"><legend class="small_legend">Елементи за проверка</legend>
    <div class="col-md-12 act_wrap" style="border-bottom: none">
        <div class="col-md-12 col-md-6_my inspectors_divs" >
            <fieldset class="mini_field"><legend class="small_legend">Склад за съхранение на ПРЗ</legend>
                {{--1Дневник за проведените--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">10. ПРЗ в оргинални опаковки с етикет на български език:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('original', 1, $original1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('original', 2, $original2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('original', 3, $original3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('original_note', $original_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 10:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--2Първични счетоводни документи--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">1. Неразрешени ПРЗ:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('unauthorized', 1, $unauthorized1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('unauthorized', 2, $unauthorized2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('unauthorized', 3, $unauthorized3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('unauthorized_note', $unauthorized_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 11:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--3Сертификат за семена и посадъчен--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">12. Срок на годност на ПРЗ:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('expiry', 1, $expiry1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('expiry', 2, $expiry2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('expiry', 3, $expiry3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('expiry_note', $expiry_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 12:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--4Сертификат по чл. 83 от ЗЗР--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">13. Разпределение на ПРЗ по функции:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('allocation', 1, $allocation1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('allocation', 2, $allocation2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('allocation', 3, $allocation3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('allocation_note', $allocation_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 13:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--5Протокол/и от изпитване за остатъци--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">
                            14. ПРЗ І-ва категория - в метален шкаф:</span>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('metal', 1, $metal1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('metal', 2, $metal2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('metal', 3, $metal3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('metal_note', $metal_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 14:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>
                {{--6Договор с фирма, вписана в--}}
                <div class="row" style="margin-left: 0; margin-right: 0">
                    <div class="col-md-4 col-md-6_my" >
                        <span class="bold">
                           15. Обособено място за временно съхранение на празните опаковки от ПРЗ и на ПРЗ с изтекъл срок на годност:</span>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="act"><span>Съответствие : </span>
                            {!! Form::radio('empty', 1, $empty1) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                            {!! Form::radio('empty', 2, $empty2) !!}
                        </label>&nbsp;&nbsp;|
                        <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                            {!! Form::radio('empty', 3, $empty3) !!}
                        </label>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <label class="note">
                            {!! Form::text('empty_note', $empty_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 15:' ]) !!}
                        </label>
                    </div>
                    <hr class="my_hr"/>
                </div>

            </fieldset>
        </div>
    </div>

</fieldset>
