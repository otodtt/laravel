<?php
if ($object->type_firm == 1) {
    $et = 'ET';
} else {
    $et = '';
}
if ($object->type_firm == 2) {
    $ood = 'ООД';
} elseif ($object->type_firm == 3) {
    $ood = 'ЕООД';
} elseif ($object->type_firm == 4) {
    $ood = 'АД';
} else {
    $ood = '';
}
////
if($type == 1){
    $type_object = 'АПТЕКА';
}
if($type == 2){
    $type_object = 'СКЛАД';
}
if($type == 3){
    $type_object = 'ЦЕХ';
}
//////
if ($object->type_location == 1) {
    $grad_selo = 'гр.';
} elseif ($object->type_location == 2) {
    $grad_selo = 'с.';
} else {
    $grad_selo = 'гр. / с.';
}

?>
<p>ФИРМА: <span class="bold">{!! $et !!} "{!! $object->name !!}" {!! $ood !!}</span> -
{!! $type_object !!} В: <span class="bold">{!! $grad_selo !!} {!! $object->location !!}, с адрес: {!! $object->address !!}</span>
</p>
