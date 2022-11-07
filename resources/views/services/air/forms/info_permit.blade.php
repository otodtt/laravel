<?php
if ($permit->number_permit <= 9) {
    $number = '00' . $permit->number_permit;
}
elseif ($permit->number_permit <= 99) {
    $number = '0' . $permit->number_permit;
}
else {
    $number = $permit->number_permit;
}
?>
<p class="" >Населено място и местности които се третират:</p>
<p ><span class="bold">{!! $permit->ground !!}</span></p>
<hr class="my_hr_in"/>
<p >Култура/декари: <span class="bold">{!! $permit->cultivation !!} - {!! $permit->acres !!} дка.</span></p>
<p >Вредител/ ПИВ: <span class="bold">{!! $permit->pest !!}</span></p>
<hr class="my_hr_in"/>
<p >Вид и име на ПРЗ: <span class="bold">{!! $permit->prz !!}</span></p>
<p >Доза на дка: <span class="bold">{!! $permit->dose !!}</span></p>
<p >Карантинен срок на ПРЗ: <span class="bold">{!! $permit->quarantine !!}</span></p>