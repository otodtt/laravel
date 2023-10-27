<?php
if(!isset($protocols)){
    $activity1 = false;
    $activity2 = false;
    $activity3 = false;
    $activity_note= null;
}
else{
    if($protocols->activity == 0){
        $activity1 = false;
        $activity2 = false;
        $activity3 = false;
    }
    if($protocols->activity == 1){
        $activity1 = true;
        $activity2 = false;
        $activity3 = false;
    }
    if($protocols->activity == 2){
        $activity1 = false;
        $activity2 = true;
        $activity3 = false;
    }
    if($protocols->activity == 3){
        $activity1 = false;
        $activity2 = false;
        $activity3 = true;
    }
    $activity_note= $protocols->activity_note;
}
//  2. Сертификат по чл. 83
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
//  3. DNEWNIK DOSTAWKI
if(!isset($protocols)){
    $delivery1 = false;
    $delivery2 = false;
    $delivery3 = false;
    $delivery_note= null;
}
else{
    if($protocols->delivery == 0){
        $delivery1 = false;
        $delivery2 = false;
        $delivery3 = false;
    }
    if($protocols->delivery == 1){
        $delivery1 = true;
        $delivery2 = false;
        $delivery3 = false;
    }
    if($protocols->activity == 2){
        $delivery1 = false;
        $delivery2 = true;
        $delivery3 = false;
    }
    if($protocols->delivery == 3){
        $delivery1 = false;
        $delivery2 = false;
        $delivery3 = true;
    }
    $delivery_note= $protocols->delivery_note;
}
//  4. DNEWNIK PRODAZBI
if(!isset($protocols)){
    $sales1 = false;
    $sales2 = false;
    $sales3 = false;
    $sales_note= null;
}
else{
    if($protocols->sales == 0){
        $sales1 = false;
        $sales2 = false;
        $sales3 = false;
    }
    if($protocols->sales == 1){
        $sales1 = true;
        $sales2 = false;
        $sales3 = false;
    }
    if($protocols->sales == 2){
        $sales1 = false;
        $sales2 = true;
        $sales3 = false;
    }
    if($protocols->sales == 3){
        $sales1 = false;
        $sales2 = false;
        $sales3 = true;
    }
    $sales_note= $protocols->sales_note;
}
//  5. NERAZRESENI
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
//  6. PARVA GRUPA
if(!isset($protocols)){
    $first1 = false;
    $first2 = false;
    $first3 = false;
    $first_note= null;
}
else{
    if($protocols->first == 0){
        $first1 = false;
        $first2 = false;
        $first3 = false;
    }
    if($protocols->first == 1){
        $first1 = true;
        $first2 = false;
        $first3 = false;
    }
    if($protocols->first == 2){
        $first1 = false;
        $first2 = true;
        $first3 = false;
    }
    if($protocols->first == 3){
        $first1 = false;
        $first2 = false;
        $first3 = true;
    }
    $first_note= $protocols->first_note;
}
//  7. NEPRAWOMERNO
if(!isset($protocols)){
    $improperly1 = false;
    $improperly2 = false;
    $improperly3 = false;
    $improperly_note= null;
}
else{
    if($protocols->improperly == 0){
        $improperly1 = false;
        $improperly2 = false;
        $improperly3 = false;
    }
    if($protocols->improperly == 1){
        $improperly1 = true;
        $improperly2 = false;
        $improperly3 = false;
    }
    if($protocols->improperly == 2){
        $improperly1 = false;
        $improperly2 = true;
        $improperly3 = false;
    }
    if($protocols->improperly == 3){
        $improperly1 = false;
        $improperly2 = false;
        $improperly3 = true;
    }
    $improperly_note= $protocols->improperly_note;
}
//  8. Preopakowani
if(!isset($protocols)){
    $repackaged1 = false;
    $repackaged2 = false;
    $repackaged3 = false;
    $repackaged_note= null;
}
else{
    if($protocols->repackaged == 0){
        $repackaged1 = false;
        $repackaged2 = false;
        $repackaged3 = false;
    }
    if($protocols->repackaged == 1){
        $repackaged1 = true;
        $repackaged2 = false;
        $repackaged3 = false;
    }
    if($protocols->repackaged == 2){
        $repackaged1 = false;
        $repackaged2 = true;
        $repackaged3 = false;
    }
    if($protocols->repackaged == 3){
        $repackaged1 = false;
        $repackaged2 = false;
        $repackaged3 = true;
    }
    $repackaged_note= $protocols->repackaged_note;
}
//  9. IZTEKYL SROK
if(!isset($protocols)){
    $expired1 = false;
    $expired2 = false;
    $expired3 = false;
    $expired_note= null;
}
else{
    if($protocols->expired == 0){
        $expired1 = false;
        $expired2 = false;
        $expired3 = false;
    }
    if($protocols->expired == 1){
        $expired1 = true;
        $expired2 = false;
        $expired3 = false;
    }
    if($protocols->expired == 2){
        $expired1 = false;
        $expired2 = true;
        $expired3 = false;
    }
    if($protocols->expired == 3){
        $expired1 = false;
        $expired2 = false;
        $expired3 = true;
    }
    $expired_note= $protocols->expired_note;
}
//  10. ETIKET
if(!isset($protocols)){
    $compliance1 = false;
    $compliance2 = false;
    $compliance3 = false;
    $compliance_note= null;
}
else{
    if($protocols->compliance == 0){
        $compliance1 = false;
        $compliance2 = false;
        $compliance3 = false;
    }
    if($protocols->compliance == 1){
        $compliance1 = true;
        $compliance2 = false;
        $compliance3 = false;
    }
    if($protocols->compliance == 2){
        $compliance1 = false;
        $compliance2 = true;
        $compliance3 = false;
    }
    if($protocols->compliance == 3){
        $compliance1 = false;
        $compliance2 = false;
        $compliance3 = true;
    }
    $compliance_note= $protocols->compliance_note;
}
//  11. Листовка
if(!isset($protocols)){
    $leaflet1 = false;
    $leaflet2 = false;
    $leaflet3 = false;
    $leaflet_note= null;
}
else{
    if($protocols->leaflet == 0){
        $leaflet1 = false;
        $leaflet2 = false;
        $leaflet3 = false;
    }
    if($protocols->leaflet == 1){
        $leaflet1 = true;
        $leaflet2 = false;
        $leaflet3 = false;
    }
    if($protocols->leaflet == 2){
        $leaflet1 = false;
        $leaflet2 = true;
        $leaflet3 = false;
    }
    if($protocols->leaflet == 3){
        $leaflet1 = false;
        $leaflet2 = false;
        $leaflet3 = true;
    }
    $leaflet_note= $protocols->leaflet_note;
}
// 12. ПРЗ в опаковка по-голяма
if(!isset($protocols)){
    $larger1 = false;
    $larger2 = false;
    $larger3 = false;
    $larger_note= null;
}
else{
    if($protocols->larger == 0){
        $larger1 = false;
        $larger2 = false;
        $larger3 = false;
    }
    if($protocols->larger == 1){
        $larger1 = true;
        $larger2 = false;
        $larger3 = false;
    }
    if($protocols->larger == 2){
        $larger1 = false;
        $larger2 = true;
        $larger3 = false;
    }
    if($protocols->larger == 3){
        $larger1 = false;
        $larger2 = false;
        $larger3 = true;
    }
    $larger_note= $protocols->larger_note;
}
// 13. Подреждане по предназначение
if(!isset($protocols)){
    $purpose1 = false;
    $purpose2 = false;
    $purpose3 = false;
    $purpose_note= null;
}
else{
    if($protocols->purpose == 0){
        $purpose1 = false;
        $purpose2 = false;
        $purpose3 = false;
    }
    if($protocols->purpose == 1){
        $purpose1 = true;
        $purpose2 = false;
        $purpose3 = false;
    }
    if($protocols->purpose == 2){
        $purpose1 = false;
        $purpose2 = true;
        $purpose3 = false;
    }
    if($protocols->purpose == 3){
        $purpose1 = false;
        $purpose2 = false;
        $purpose3 = true;
    }
    $purpose_note= $protocols->purpose_note;
}
// 14. Съхранение на ПРЗ
if(!isset($protocols)){
    $storage1 = false;
    $storage2 = false;
    $storage3 = false;
    $storage_note= null;
}
else{
    if($protocols->storage == 0){
        $storage1 = false;
        $storage2 = false;
        $storage3 = false;
    }
    if($protocols->storage == 1){
        $storage1 = true;
        $storage2 = false;
        $storage3 = false;
    }
    if($protocols->storage == 2){
        $storage1 = false;
        $storage2 = true;
        $storage3 = false;
    }
    if($protocols->storage == 3){
        $storage1 = false;
        $storage2 = false;
        $storage3 = true;
    }
    $storage_note= $protocols->storage_note;
}
// 15. Складово помещение в ССА
if(!isset($protocols)){
    $warehouse1 = false;
    $warehouse2 = false;
    $warehouse3 = false;
    $warehouse_note= null;
}
else{
    if($protocols->warehouse == 0){
        $warehouse1 = false;
        $warehouse2 = false;
        $warehouse3 = false;
    }
    if($protocols->warehouse == 1){
        $warehouse1 = true;
        $warehouse2 = false;
        $warehouse3 = false;
    }
    if($protocols->warehouse == 2){
        $warehouse1 = false;
        $warehouse2 = true;
        $warehouse3 = false;
    }
    if($protocols->warehouse == 3){
        $warehouse1 = false;
        $warehouse2 = false;
        $warehouse3 = true;
    }
    $warehouse_note= $protocols->warehouse_note;
}
// 15.1 да е отделено от търговската част
if(!isset($protocols)){
    $separated1 = false;
    $separated2 = false;
    $separated3 = false;
    $separated_note= null;
}
else{
    if($protocols->separated == 0){
        $separated1 = false;
        $separated2 = false;
        $separated3 = false;
    }
    if($protocols->separated == 1){
        $separated1 = true;
        $separated2 = false;
        $separated3 = false;
    }
    if($protocols->separated == 2){
        $separated1 = false;
        $separated2 = true;
        $separated3 = false;
    }
    if($protocols->separated == 3){
        $separated1 = false;
        $separated2 = false;
        $separated3 = true;
    }
    $separated_note= $protocols->separated_note;
}
// 15.2 да е осигурен контролиран и
if(!isset($protocols)){
    $access1 = false;
    $access2 = false;
    $access3 = false;
    $access_note= null;
}
else{
    if($protocols->access == 0){
        $access1 = false;
        $access2 = false;
        $access3 = false;
    }
    if($protocols->access == 1){
        $access1 = true;
        $access2 = false;
        $access3 = false;
    }
    if($protocols->access == 2){
        $access1 = false;
        $access2 = true;
        $access3 = false;
    }
    if($protocols->access == 3){
        $access1 = false;
        $access2 = false;
        $access3 = true;
    }
    $access_note= $protocols->access_note;
}
// 15.3 да има подови настилки,
if(!isset($protocols)){
    $flooring1 = false;
    $flooring2 = false;
    $flooring3 = false;
    $flooring_note= null;
}
else{
    if($protocols->flooring == 0){
        $flooring1 = false;
        $flooring2 = false;
        $flooring3 = false;
    }
    if($protocols->flooring == 1){
        $flooring1 = true;
        $flooring2 = false;
        $flooring3 = false;
    }
    if($protocols->flooring == 2){
        $flooring1 = false;
        $flooring2 = true;
        $flooring3 = false;
    }
    if($protocols->flooring == 3){
        $flooring1 = false;
        $flooring2 = false;
        $flooring3 = true;
    }
    $flooring_note= $protocols->flooring_note;
}
// 15.4 стените, таваните и вратите
if(!isset($protocols)){
    $combustible1 = false;
    $combustible2 = false;
    $combustible3 = false;
    $combustible_note= null;
}
else{
    if($protocols->combustible == 0){
        $combustible1 = false;
        $combustible2 = false;
        $combustible3 = false;
    }
    if($protocols->combustible == 1){
        $combustible1 = true;
        $combustible2 = false;
        $combustible3 = false;
    }
    if($protocols->combustible == 2){
        $combustible1 = false;
        $combustible2 = true;
        $combustible3 = false;
    }
    if($protocols->combustible == 3){
        $combustible1 = false;
        $combustible2 = false;
        $combustible3 = true;
    }
    $combustible_note= $protocols->combustible_note;
}
// 16. Договор за предаване
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
?>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12" style="margin-top: 10px">
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
                            {{--Удостоверение за дейността--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">1. Удостоверение за дейността:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-4 col-md-6_my" >
                                <label class="act"><span>Съответствие : </span>
                                    {!! Form::radio('activity', 1, $activity1) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                    {!! Form::radio('activity', 2, $activity2) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                    {!! Form::radio('activity', 3, $activity3) !!}
                                </label>
                            </div>
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('activity_note', $activity_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 1:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                            {{--СЕРТИФИКАТ--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">2. Сертификат по чл. 83 на лицето:</span>&nbsp;&nbsp;
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
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('certificate_note', $certificate_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 2:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                            {{--Дневник на ДОСТАВКИ--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">3. Дневник на доставките:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-4 col-md-6_my" >
                                <label class="act"><span>Съответствие : </span>
                                    {!! Form::radio('delivery', 1, $delivery1) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                    {!! Form::radio('delivery', 2, $delivery2) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                    {!! Form::radio('delivery', 3, $delivery3) !!}
                                </label>
                            </div>
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('delivery_note', $delivery_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 3:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                            {{--Дневник на ДОСТАВКИ--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">4. Дневник на продажбите:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-4 col-md-6_my" >
                                <label class="act"><span>Съответствие : </span>
                                    {!! Form::radio('sales', 1, $sales1) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                    {!! Form::radio('sales', 2, $sales2) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                    {!! Form::radio('sales', 3, $sales3) !!}
                                </label>
                            </div>
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('sales_note', $sales_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 4:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                        </fieldset>
                        <fieldset class="mini_field"><legend class="small_legend">ПРЗ в търговската част</legend>
                            {{--Неразрешени ПРЗ--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">5. Неразрешени ПРЗ:</span>&nbsp;&nbsp;
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
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('unauthorized_note', $unauthorized_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 5:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                            {{--ПРЗ от първа професионална категория--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">6. ПРЗ от първа професионална категория:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-4 col-md-6_my" >
                                <label class="act"><span>Съответствие : </span>
                                    {!! Form::radio('first', 1, $first1) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                    {!! Form::radio('first', 2, $first2) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                    {!! Form::radio('first', 3, $first3) !!}
                                </label>
                            </div>
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('first_note', $first_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 6:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                            {{--Неправомерно преопаковани--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">7. Неправомерно преопаковани:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-4 col-md-6_my" >
                                <label class="act"><span>Съответствие : </span>
                                    {!! Form::radio('improperly', 1, $improperly1) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                    {!! Form::radio('improperly', 2, $improperly2) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                    {!! Form::radio('improperly', 3, $improperly3) !!}
                                </label>
                            </div>
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('improperly_note', $improperly_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 7:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                            {{--Преопаковане на ПРЗ в аптеката--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">8. Преопаковане на ПРЗ в аптеката:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-4 col-md-6_my" >
                                <label class="act"><span>Съответствие : </span>
                                    {!! Form::radio('repackaged', 1, $repackaged1) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                    {!! Form::radio('repackaged', 2, $repackaged2) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                    {!! Form::radio('repackaged', 3, $repackaged3) !!}
                                </label>
                            </div>
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('repackaged_note', $repackaged_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 8:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                            {{--ПРЗ с изтекъл срок на годност--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">9. ПРЗ с изтекъл срок на годност:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-4 col-md-6_my" >
                                <label class="act"><span>Съответствие : </span>
                                    {!! Form::radio('expired', 1, $expired1) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                    {!! Form::radio('expired', 2, $expired2) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                    {!! Form::radio('expired', 3, $expired3) !!}
                                </label>
                            </div>
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('expired_note', $expired_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 9:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                            {{--Съответствие на етикета--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">10. Съответствие на етикета:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-4 col-md-6_my" >
                                <label class="act"><span>Съответствие : </span>
                                    {!! Form::radio('compliance', 1, $compliance1) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                    {!! Form::radio('compliance', 2, $compliance2) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                    {!! Form::radio('compliance', 3, $compliance3) !!}
                                </label>
                            </div>
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('compliance_note', $compliance_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 10:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                            {{-- листовка трайно закрепена за опаковката--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">11. Листовка трайно закрепена за опаковката:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-4 col-md-6_my" >
                                <label class="act"><span>Съответствие : </span>
                                    {!! Form::radio('leaflet', 1, $leaflet1) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                    {!! Form::radio('leaflet', 2, $leaflet2) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                    {!! Form::radio('leaflet', 3, $leaflet3) !!}
                                </label>
                            </div>
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('leaflet_note', $leaflet_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 11:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                            {{-- ПРЗ в опаковка по-голяма от 1 л/кг--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">12. ПРЗ в опаковка по-голяма от 1 л/кг:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-4 col-md-6_my" >
                                <label class="act"><span>Съответствие : </span>
                                    {!! Form::radio('larger', 1, $larger1) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                    {!! Form::radio('larger', 2, $larger2) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                    {!! Form::radio('larger', 3, $larger3) !!}
                                </label>
                            </div>
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('larger_note', $larger_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 12:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                            {{-- Подреждане по предназначение--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">13. Подреждане по предназначение:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-4 col-md-6_my" >
                                <label class="act"><span>Съответствие : </span>
                                    {!! Form::radio('purpose', 1, $purpose1) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                    {!! Form::radio('purpose', 2, $purpose2) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                    {!! Form::radio('purpose', 3, $purpose3) !!}
                                </label>
                            </div>
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('purpose_note', $purpose_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 13:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                            {{-- Съхранение на ПРЗ--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">14. Съхранение на ПРЗ:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-4 col-md-6_my" >
                                <label class="act"><span>Съответствие : </span>
                                    {!! Form::radio('storage', 1, $storage1) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                    {!! Form::radio('storage', 2, $storage2) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                    {!! Form::radio('storage', 3, $storage3) !!}
                                </label>
                            </div>
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('storage_note', $storage_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 14:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                            {{-- Складово помещение в ССА--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">15. Складово помещение в ССА:</span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-4 col-md-6_my" >
                                <label class="act"><span>Съответствие : </span>
                                    {!! Form::radio('warehouse', 1, $warehouse1) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                    {!! Form::radio('warehouse', 2, $warehouse2) !!}
                                </label>&nbsp;&nbsp;|
                                <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                    {!! Form::radio('warehouse',3, $warehouse3) !!}
                                </label>
                            </div>
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('warehouse_note', $warehouse_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 15:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                        </fieldset>
                        <fieldset class="mini_field"><legend class="small_legend">15. Складово помещение в ССА</legend>
                            <div class="row">
                            {{--Удостоверение за дейността--}}
                                <div class="col-md-3 col-md-6_my" style="padding: 0 10px 5px 30px;">
                                    <span class="bold">15.1 да е отделено от търговската част на обекта и да е с вместимост до 5 тона ....:</span>&nbsp;&nbsp;
                                </div>
                                <div class="col-md-4 col-md-6_my" style="padding-left: 8px;">
                                    <label class="act"><span>Съответствие : </span>
                                        {!! Form::radio('separated', 1, $separated1) !!}
                                    </label>&nbsp;&nbsp;|
                                    <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                        {!! Form::radio('separated', 2, $separated2) !!}
                                    </label>&nbsp;&nbsp;|
                                    <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                        {!! Form::radio('separated', 3, $separated3) !!}
                                    </label>
                                </div>
                                <div class="col-md-5 col-md-6_my" >
                                    <label class="note">
                                        {!! Form::text('separated_note', $separated_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 15.1:' ]) !!}
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                {{--ДОСТЪП--}}
                                <div class="col-md-3 col-md-6_my" style="padding: 0 10px 5px 30px;">
                                    <span class="bold">15.2 да е осигурен контролиран и ограничен досъп, както и защита от неоторизиран достъп:</span>&nbsp;&nbsp;
                                </div>
                                <div class="col-md-4 col-md-6_my" style="padding-left: 8px;">
                                    <label class="act"><span>Съответствие : </span>
                                        {!! Form::radio('access', 1, $access1) !!}
                                    </label>&nbsp;&nbsp;|
                                    <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                        {!! Form::radio('access', 2, $access2) !!}
                                    </label>&nbsp;&nbsp;|
                                    <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                        {!! Form::radio('access', 3, $access3) !!}
                                    </label>
                                </div>
                                <div class="col-md-5 col-md-6_my" >
                                    <label class="note">
                                        {!! Form::text('access_note', $access_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 15.2:' ]) !!}
                                    </label>
                                </div>
                            </div>
                            {{--<hr class="my_hr"/>--}}
                            <div class="row">
                            {{--подови настилки--}}
                                <div class="col-md-3 col-md-6_my" style="padding: 0 10px 5px 30px;" >
                                    <span class="bold">15.3 да има подови настилки, непропускливи за течности, химически устойчиви ...:</span>&nbsp;&nbsp;
                                </div>
                                <div class="col-md-4 col-md-6_my" style="padding-left: 8px;">
                                    <label class="act"><span>Съответствие : </span>
                                        {!! Form::radio('flooring', 1, $flooring1) !!}
                                    </label>&nbsp;&nbsp;|
                                    <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                        {!! Form::radio('flooring', 2, $flooring2) !!}
                                    </label>&nbsp;&nbsp;|
                                    <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                        {!! Form::radio('flooring', 3, $flooring3) !!}
                                    </label>
                                </div>
                                <div class="col-md-5 col-md-6_my" >
                                    <label class="note">
                                        {!! Form::text('flooring_note', $flooring_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 15.3:' ]) !!}
                                    </label>
                                </div>
                            </div>
                            {{--<hr class="my_hr"/>--}}
                            <div class="row">
                            {{--стените, таваните и вратите--}}
                                <div class="col-md-3 col-md-6_cmy" style="padding: 0 10px 5px 30px;">
                                    <span class="bold">15.4 стените, таваните и вратите да са изградени от негорими материали:</span>&nbsp;&nbsp;
                                </div>
                                <div class="col-md-4 col-md-6_my" style="padding-left: 8px;">
                                    <label class="act"><span>Съответствие : </span>
                                        {!! Form::radio('combustible', 1, $combustible1) !!}
                                    </label>&nbsp;&nbsp;|
                                    <label class="act"><span>&nbsp;&nbsp;Несъответствие : </span>
                                        {!! Form::radio('combustible', 2, $combustible2) !!}
                                    </label>&nbsp;&nbsp;|
                                    <label class="act"><span>&nbsp;&nbsp;Непроверено : </span>
                                        {!! Form::radio('combustible', 3, $combustible3) !!}
                                    </label>
                                </div>
                                <div class="col-md-5 col-md-6_my" >
                                    <label class="note">
                                        {!! Form::text('combustible_note', $combustible_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 15.4:' ]) !!}
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="mini_field"><legend class="small_legend">Договор</legend>
                            {{-- Договор за предаване--}}
                            <div class="col-md-3 col-md-6_my" >
                                <span class="bold">16. Договор за предаване на негодни ПРЗ:</span>&nbsp;&nbsp;
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
                            <div class="col-md-5 col-md-6_my" >
                                <label class="note">
                                    {!! Form::text('contract_note', $contract_note, ['size'=>50, 'maxlength'=>500, 'placeholder'=>'Забележка 16:' ]) !!}
                                </label>
                            </div>
                            <hr class="my_hr"/>
                        </fieldset>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>