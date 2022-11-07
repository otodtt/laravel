<?php
if($farmer->type_firm == 1 || $farmer->type_firm  == 0){
    $et = '';
    $ood = '';
    $pin = 'ЕГН: ';
}
elseif($farmer->type_firm == 2 ){
    $et = 'ET "';
    $ood = '" ';
    $pin = 'ЕИК: ';
}
elseif($farmer->type_firm  == 3 ){
    $et = ' "';
    $ood = '" ООД';
    $pin = 'ЕИК: ';
}
elseif($farmer->type_firm  == 4 ){
    $et = ' "';
    $ood = '" ЕООД';
    $pin = 'ЕИК: ';
}
elseif($farmer->type_firm  == 5 ){
    $et = ' "';
    $ood = '" АД';
    $pin = 'ЕИК: ';
}
elseif($farmer->type_firm  == 6 ){
    $et = '';
    $ood = '';
    $pin = 'ЕИК: ';
}
else{
    $et = '';
    $ood = '';
    $pin = 'ЕГН/ЕИК: ';
}
$name = mb_convert_case($farmer->name, MB_CASE_UPPER, 'UTF-8' );
$all_name = $et.''.$name.''.$ood;

if($farmer->tvm == 1){
    $tvm = 'гр. ';
}
elseif($farmer->tvm == 2 ){
    $tvm = 'с. ';
}
else{
    $tvm = 'гр./с. ';
}
if(strlen($farmer->pin_owner) > 0){
    $pin_owner = 'с ЕГН: '.$farmer->pin_owner;
}
else{
    $pin_owner = '';
}
?>
@if($farmer->type_firm == 1 || $farmer->type_firm  == 0)
    <span >Име на ЧЗП: <span class="bold">{!! $all_name !!}</span> {!! $pin !!} <span class="bold">{!! $farmer->pin !!}</span></span>
@else
    <p >Име на Фирма: <span class="bold">{!! $all_name !!}</span> {!! $pin !!} <span class="bold">{!! $farmer->bulstat !!}</span>
    <span >С управител: <span class="bold">{!! $farmer->owner !!}</span> <span class="bold">{!! $pin_owner !!}</span></span></p>
@endif
