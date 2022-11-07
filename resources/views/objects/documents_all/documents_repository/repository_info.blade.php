<?php
/////////////////////////////
if ($repository->number_licence <= 9) {
    $number_view = '00' . $repository->number_licence;
} elseif ($repository->number_licence <= 99) {
    $number_view = '0' . $repository->number_licence;
} else {
    $number_view = $repository->number_licence;
}

$number_licence = $repository->index_licence . '-' . $number_view . ' / ' . date('d.m.Y', $repository->date_licence) . ' г.';

///////////////////////////////////
if ($repository->certificate <= 9) {
    $certificate_number = '000' . $repository->certificate;
} elseif ($repository->certificate <= 99) {
    $certificate_number = '00' . $repository->certificate;
} elseif ($repository->certificate <= 999) {
    $certificate_number = '0' . $repository->certificate;
} else {
    $certificate_number = $repository->certificate;
}
//////////////////////////////////

if ($repository->type_location == 1) {
    $grad_selo = 'гр.';
} elseif ($repository->type_location == 2) {
    $grad_selo = 'с.';
} else {
    $grad_selo = 'гр. / с.';
}
///////////////////////////////////////
if ($repository->edition == 0) {
    $edition_show = 'Няма промяна в обстоятелствата';
}
else{
    $edition_show = $repository->edition.' от '. date('d.m.Y', $repository->date_edition).'г.';
}
?>

@if($repository->edition == 0)
    <p>Удостоверение № <span class="bold">{!! $number_licence !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
        Валидно до: <span class="bold"> {!! date('d.m.Y', $repository->end_date) !!}г.</span>
    </p>
    <hr class="my_hr_in"/>
    <p id="">Няма промяна в обстоятелствата.</p>
@else
    @if(isset($edition) && $edition > 0)
        <p id="p_doc">Удостоверение № <span class="bold">{!! $number_licence !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
            Валидно до: <span class="bold"> {!! date('d.m.Y', $repository->end_date) !!}г.</span>
        </p>
        <hr class="my_hr_in"/>
        <p id="p_edition">Издание: <span class="bold">№ {!! $edition !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
            Заявление № <span class="bold">{!! $index[0]['index_in'] !!} - {!! $repository->number_change !!} / {!! date('d.m.Y', $repository->date_change) !!} г. </span>
        </p>
    @else
        <p id="p_doc">Удостоверение № <span class="bold">{!! $number_licence !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
            Валидно до: <span class="bold"> {!! date('d.m.Y', $repository->end_date) !!}г.</span>
        </p>
        <hr class="my_hr_in"/>
        <p id="p_edition">Издание: <span class="bold">№ {!! $edition_show !!}</span>&nbsp;&nbsp; - &nbsp;&nbsp;
            Заявление № <span class="bold">{!! $index[0]['index_in'] !!} - {!! $repository->number_change !!} / {!! date('d.m.Y', $repository->date_change) !!} г. </span>
        </p>
    @endif
@endif

<hr class="my_hr_in"/>
<p>{{$grad_selo}} <span class="bold">{{$repository->location}}</span>; общ. <span class="bold">{{$districts_name_object}}</span></p>
<p>Адрес: <span class="bold">{{$repository->address}}</span></p>

<hr class="my_hr_in"/>
<p>Лицето което има сертификат: <span class="bold">{{$repository->seller}}</span></p>
<p>Сертификат №: <span class="bold">{{$repository->index_certificate}} - {{$certificate_number}} /
    {{ $repository->date_certificate }} г.</span>
</p>