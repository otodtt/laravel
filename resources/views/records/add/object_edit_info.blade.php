<?php
if($protocol->type_firm == 1 || $protocol->type_firm  == 0){
    $et = '';
    $ood = '';
    $pin = 'ЕГН: ';
}
elseif($protocol->type_firm == 2 ){
    $et = 'ET "';
    $ood = '" ';
    $pin = 'ЕИК: ';
}
elseif($protocol->type_firm  == 3 ){
    $et = ' "';
    $ood = '" ООД';
    $pin = 'ЕИК: ';
}
elseif($protocol->type_firm  == 4 ){
    $et = ' "';
    $ood = '" ЕООД';
    $pin = 'ЕИК: ';
}
elseif($protocol->type_firm  == 5 ){
    $et = ' "';
    $ood = '" АД';
    $pin = 'ЕИК: ';
}
elseif($protocol->type_firm  == 6 ){
    $et = '';
    $ood = '';
    $pin = 'ЕИК: ';
}
else{
    $et = '';
    $ood = '';
    $pin = 'ЕГН/ЕИК: ';
}
$name = mb_convert_case($protocol->name, MB_CASE_UPPER, 'UTF-8' );
$all_name = $et.''.$name.''.$ood;

if($protocol->tvm == 1){
    $tvm = 'гр. ';
}
elseif($protocol->tvm == 2 ){
    $tvm = 'с. ';
}
else{
    $tvm = 'гр./с. ';
}
//////
foreach($districts as $key=>$district){
    if($key == $protocol->district_id){
        $district_farm = $district;
    }
}
///////
foreach($districts_farm as $key=>$district){
    if($key == $protocol->district_object){
        $district_object = $district;
    }
}
/////
foreach($regions as $key=>$region){
    if($key == $protocol->areas_id){
        $region_farm = $region;
    }
}
if(strlen($protocol->pin_owner) > 0){
    $pin_owner = 'с ЕГН: '.$protocol->pin_owner;
}
else{
    $pin_owner = '';
}
?>
@if($protocol->firm == 1 || $protocol->firm  == 0)
    <span >Име на ЧЗП: <span class="bold">{!! $all_name !!}</span> {!! $pin !!} <span class="bold">{!! $protocol->pin !!}</span></span>
    <p >С адрес: <span class="bold">{!! $protocol->address !!}</span>, <span class="bold">{!! $tvm !!} {!! $protocol->location !!},
                общ. {!! $district_farm !!}, обл. {!! $region_farm !!} </span></p>
@else
    <p >Име на Фирма: <span class="bold">{!! $all_name !!}</span> {!! $pin !!} <span class="bold">{!! $protocol->bulstat !!}</span>
        <span >С управител: <span class="bold">{!! $protocol->owner !!}</span> <span class="bold">{!! $pin_owner !!}</span></span></p>
    <p >С адрес: <span class="bold">{!! $protocol->address !!}</span>, <span class="bold">{!! $tvm !!} {!! $protocol->location !!},
                общ. {!! $district_farm !!}, обл. {!! $region_farm !!} </span></p>
@endif
