<?php
if ($object->firm == 1) {
    $et = 'ET';
} else {
    $et = '';
}
if ($object->firm == 2) {
    $ood = 'ООД';
} elseif ($object->firm == 3) {
    $ood = 'ЕООД';
} elseif ($object->firm == 4) {
    $ood = 'АД';
} else {
    $ood = '';
}
////
if($object->ot == 1){
    $type_object = 'АПТЕКА';
}
if($object->ot == 2){
    $type_object = 'СКЛАД';
}
if($object->ot == 3){
    $type_object = 'ЦЕХ';
}
//////
if ($object->city_village == 1) {
    $grad_selo = 'гр.';
} elseif ($object->city_village == 2) {
    $grad_selo = 'с.';
} else {
    $grad_selo = 'гр. / с.';
}

?>
<p><span class="bold">{!! $et !!} "{!! $object->name !!}" {!! $ood !!}</span> -
    {!! $type_object !!} В: <span class="bold">{!! $grad_selo !!} {!! $object->place !!}, с адрес: {!! $object->address !!}</span>
</p>
