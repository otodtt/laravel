<?php
///////////////////////////////////
if ($certificate->number <= 9) {
    $certificate_number = '000' . $certificate->number;
} elseif ($certificate->number <= 99) {
    $certificate_number = '00' . $certificate->number;
} elseif ($certificate->number <= 999) {
    $certificate_number = '0' . $certificate->number;
} else {
    $certificate_number = $certificate->number;
}
//////////////////////////////////
if ($certificate->limit_certificate == 1) {
    $valid = 'БЕЗСРОЧЕН';
} else {
    $date_now = time();
    if ($date_now > $certificate->to_date) {
        $valid = 'Изтекъл срок';
    } else {
        $valid = date('d.m.Y', $certificate->to_date).' г.';
    }
}
?>
<p class="bold">Сертификат издаден на:</p>
<hr class="my_hr_in"/>
<p >Сертификат с № : <span class="bold">{!! $certificate->index_cert !!} - {!! $certificate_number !!} / {!! date('d.m.Y', $certificate->date) !!} г.</span></p>
<p >Издаден на: <span class="bold">{!! $certificate->name !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;с ЕГН: <span class="bold">{!! $certificate->pin !!}</span></p>
<p >Адрес: <span class="bold">{!! $certificate->address !!}</span></p>
<p >Телефон: <span class="bold">{!! $certificate->phone !!}</span></p>
<p >Email: <span class="bold">{!! $certificate->email !!}</span></p>
<p >Сертификат валиден до: <span class="bold">{!! $valid !!}</span></p>