<?php
/////////////////////////////
if ($workshop->number_licence <= 9) {
    $number_view = '00' . $workshop->number_licence;
} elseif ($workshop->number_licence <= 99) {
    $number_view = '0' . $workshop->number_licence;
} else {
    $number_view = $workshop->number_licence;
}

$number_licence = $workshop->index_licence . '-' . $number_view . ' / ' . date('d.m.Y', $workshop->date_licence) . ' г.';

///////////////////////////////////
if ($workshop->certificate <= 9) {
    $certificate_number = '000' . $workshop->certificate;
} elseif ($workshop->certificate <= 99) {
    $certificate_number = '00' . $workshop->certificate;
} elseif ($workshop->certificate <= 999) {
    $certificate_number = '0' . $workshop->certificate;
} else {
    $certificate_number = $workshop->certificate;
}
//////////////////////////////////

if ($workshop->type_location == 1) {
    $grad_selo = 'гр.';
} elseif ($workshop->type_location == 2) {
    $grad_selo = 'с.';
} else {
    $grad_selo = 'гр. / с.';
}
///////////////////////////////////////
if ($workshop->edition == 0) {
    $edition_show = 'Няма промяна в обстоятелствата';
}
else{
    $edition_show = $workshop->edition.' от '. date('d.m.Y', $workshop->date_edition).'г.';
}
?>

@if($workshop->edition == 0)
    <p>Удостоверение № <span class="bold">{!! $number_licence !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
        Валидно до: <span class="bold"> {!! date('d.m.Y', $workshop->end_date) !!}г.</span>
    </p>
    <hr class="my_hr_in"/>
    <p id="">Няма промяна в обстоятелствата.</p>
@else
    @if(isset($edition) && $edition > 0)
        <p id="p_doc">Удостоверение № <span class="bold">{!! $number_licence !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
            Валидно до: <span class="bold"> {!! date('d.m.Y', $workshop->end_date) !!}г.</span>
        </p>
        <hr class="my_hr_in"/>
        <p id="p_edition">Издание: <span class="bold">№ {!! $edition !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
            Заявление № <span class="bold">{!! $index[0]['index_in'] !!} - {!! $workshop->number_change !!} / {!! date('d.m.Y', $workshop->date_change) !!} г. </span>
        </p>
    @else
        <p id="p_doc">Удостоверение № <span class="bold">{!! $number_licence !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
            Валидно до: <span class="bold"> {!! date('d.m.Y', $workshop->end_date) !!}г.</span>
        </p>
        <hr class="my_hr_in"/>
        <p id="p_edition">Издание: <span class="bold">№ {!! $edition_show !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
            Заявление № <span class="bold">{!! $index[0]['index_in'] !!} - {!! $workshop->number_change !!} / {!! date('d.m.Y', $workshop->date_change) !!} г. </span>
        </p>
    @endif
@endif

<hr class="my_hr_in"/>
<p>{{$grad_selo}} <span class="bold">{{$workshop->location}}</span>; общ. <span class="bold">{{$districts_name_object}}</span></p>
<p>Адрес: <span class="bold">{{$workshop->address}}</span></p>

<hr class="my_hr_in"/>
<p>Лицето което има сертификат: <span class="bold">{{$workshop->seller}}</span></p>
<p>Сертификат №: <span class="bold">{{$workshop->index_certificate}} - {{$certificate_number}} /
    {{ $workshop->date_certificate }} г.</span>
</p>