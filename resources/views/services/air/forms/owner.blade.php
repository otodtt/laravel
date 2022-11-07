<?php
///////////////////////////////////
if ($permit->number_permit <= 9) {
    $permit_number = '00' . $permit->number_permit;
} elseif ($permit->number_permit <= 99) {
    $permit_number = '0' . $permit->number_permit;
} else {
    $permit_number = $permit->number_permit;
}
///// Вид на Фирмата
if ($permit->type_firm == 1) {
    $et = '';
    $ood = '';
}
elseif ($permit->type_firm == 2) {
    $et = 'ЕТ "';
    $ood = '"';
}
elseif ($permit->type_firm == 3) {
    $et = '"';
    $ood = '" ООД';
}
elseif ($permit->type_firm == 4) {
    $et = '"';
    $ood = '" ЕООД';
}
elseif ($permit->type_firm == 5) {
    $et = '"';
    $ood = '" АД';
}
else {
    $et = '';
    $ood = '';
}
if($permit->type_location == 1){
    $tvm = 'гр. ';
}
elseif($permit->type_location == 2){
    $tvm = 'с. ';
}
else{
    $tvm = 'гр./с. ';
}
?>
@if($permit->farmer_id != 0)
    <span class="bold">Разрешително издадено на:</span>
    <a style="float: right" href="{!!URL::to('/стопанин/'.$permit->farmer_id )!!}" class="btn btn-success my_btn right">
        <i class="fa fa-user"></i> Подробни данни на ЗС
    </a>
@else
    <p class="bold">Разрешително издадено на:</p>
@endif

<hr class="my_hr_in"/>
<p >
    Разрешително № : <span class="bold">{!! $permit_number !!} / {!! date('d.m.Y', $permit->date_permit) !!} г.</span>
    &nbsp; | &nbsp;Валидно от : <span class="bold">{!! date('d.m.Y', $permit->start_date) !!} г.</span> дo: <span class="bold">{!! date('d.m.Y', $permit->end_date) !!} г.</span>
</p>
<p >Издадено на: <span class="bold">{!! $et.$permit->name.$ood !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;с ЕИК/Булстат: <span class="bold">{!! $permit->urn !!}</span></p>
<p >Регистрирана в: <span class="bold">{!! $tvm.$permit->location !!}, общ. {!! $district_name !!}, обл. {!! $area_name !!}</span></p>
<p >С адрес: <span class="bold">{!! $permit->address !!}</span></p>
<hr class="my_hr_in"/>
<p >Телефон: <span class="bold">{!! $permit->phone !!}</span>, Email: <span class="bold">{!! $permit->mail !!}</span></p>
<hr class="my_hr_in"/>
<p class="">Представляван(о) от - <span class="bold">{!! $permit->owner !!}</span> с ЕГН: <span class="bold">{!! $permit->pin_owner !!}</span> </p>
<hr class="my_hr_in"/>
<p class="">Предписание от: <span class="bold">{!! $permit->agronomist !!}</span> - Сертификат № <span class="bold">{!! $permit->certificate !!}</span> </p>