<?php
/////////////////////////////
if ($pharmacy->number_licence <= 9) {
    $number_view = '00' . $pharmacy->number_licence;
} elseif ($pharmacy->number_licence <= 99) {
    $number_view = '0' . $pharmacy->number_licence;
} else {
    $number_view = $pharmacy->number_licence;
}

$number_licence = $pharmacy->index_licence . '-' . $number_view . ' / ' . date('d.m.Y', $pharmacy->date_licence) . ' г.';

///////////////////////////////////
if ($pharmacy->certificate <= 9) {
    $certificate_number = '000' . $pharmacy->certificate;
} elseif ($pharmacy->certificate <= 99) {
    $certificate_number = '00' . $pharmacy->certificate;
} elseif ($pharmacy->certificate <= 999) {
    $certificate_number = '0' . $pharmacy->certificate;
} else {
    $certificate_number = $pharmacy->certificate;
}
//////////////////////////////////

if ($pharmacy->type_location == 1) {
    $grad_selo = 'гр.';
} elseif ($pharmacy->type_location == 2) {
    $grad_selo = 'с.';
} else {
    $grad_selo = 'гр. / с.';
}

if ($pharmacy->edition == 0) {
    $edition_show = 'Няма промяна в обстоятелствата';
}
else{
    $edition_show = $pharmacy->edition.' от '. date('d.m.Y', $pharmacy->date_edition).'г.';
}
?>

@if($pharmacy->edition == 0)
    <p>Удостоверение № <span class="bold">{!! $number_licence !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
        Валидно до: <span class="bold"> {!! date('d.m.Y', $pharmacy->end_date) !!}г.</span>
    </p>
    <hr class="my_hr_in"/>
    <p id="">Няма промяна в обстоятелствата.</p>
@else
    @if(isset($edition) && $edition > 0)
        <p id="p_doc">Удостоверение № <span class="bold">{!! $number_licence !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
            Валидно до: <span class="bold"> {!! date('d.m.Y', $pharmacy->end_date) !!}г.</span>
        </p>
        <hr class="my_hr_in"/>
        <p id="p_edition">Издание: <span class="bold">№ {!! $edition !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
            Заявление № <span class="bold">{!! $index[0]['index_in'] !!} - {!! $pharmacy->number_change !!} / {!! date('d.m.Y', $pharmacy->date_change) !!} г. </span>
        </p>
    @else
        <p id="p_doc">Удостоверение № <span class="bold">{!! $number_licence !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
            Валидно до: <span class="bold"> {!! date('d.m.Y', $pharmacy->end_date) !!}г.</span>
        </p>
        <hr class="my_hr_in"/>
        <p id="p_edition">Издание: <span class="bold">№ {!! $edition_show !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
            Заявление № <span class="bold">{!! $index[0]['index_in'] !!} - {!! $pharmacy->number_change !!} / {!! date('d.m.Y', $pharmacy->date_change) !!} г. </span>
        </p>
    @endif
@endif

<hr class="my_hr_in"/>
<p>{{$grad_selo}} <span class="bold">{{$pharmacy->location}}</span>; общ. <span class="bold">{{$districts_name_object}}</span></p>
<p>Адрес: <span class="bold">{{$pharmacy->address}}</span></p>

<hr class="my_hr_in"/>
<p>Лицето което има сертификат: <span class="bold">{{$pharmacy->seller}}</span></p>
<p>Сертификат №: <span class="bold">{{$pharmacy->index_certificate}} - {{$certificate_number}} /
    {{ $pharmacy->date_certificate }} г.</span>
</p>