<div class="number_doc_all col-md-12 div_margin">
    <div class="col-md-12 row_top">
        <h3 class="bold" id="number_doc">Р А З Р Е Ш Е Н И Е</h3>
    </div>
    <div class="col-md-12">
        <p id="date_doc">№ {!! $permit->number_permit !!}</p>
    </div>
    <div class="col-md-12 row_bottom">
        <p id="town_doc">{!! $logo[0]['city'] !!} / {!! date('d.m.Y', $permit->date_permit) !!} <span class="lowercase">г.</span></p>
    </div>
</div>
<div class="col-md-12 div_margin" style="text-align: center">
    <p style="text-align: center" id="petition">НА ОСНОВАНИЕ ЗАЯВЛЕНИЕ №
        <span class="bold">{!! $permit->index_petition !!} - {!! $permit->number_petition !!} / {!! date('d.m.Y', $permit->date_petition) !!} Г.</span>
        ПО ЧЛ. 110, АЛ. 4 И ДЕКЛАРАЦИЯ ПО ЧЛ. 110, АЛ. 2, Т. 4 ОТ ЗАКОНА ЗА ЗАЩИТА НА РАСТЕНИЯТА
    </p>
</div>

<div class="col-md-12 center uppercase div_margin">
    <h4 class="publish"><span class="bold">РАЗРЕШАВАМ</span></h4>
</div>

<div class="col-md-12 uppercase div_margin">
    <div class="col-md-12" style="padding: 0">
        <p >НА <span class="bold">{{ $et }} {{ $permit->name }} {{ $ood }}</span></p>
        <p style="font-size: 0.9em; font-style: italic; text-transform: lowercase;">(земеделски производител/юридическото лице или ЕТ)</p>
    </div>

    <div class="col-md-9" style="margin-top: 10px; padding: 0">
        <p >ПРЕДСТАВЛЯВАН(О) ОТ <span class="bold">{{ $permit->owner }}</span></p>
    </div>
    <div class="col-md-3 " style="margin-top: 10px">
        <p>ЕГН: <strong>{{ $permit->pin_owner }}</strong></p>
    </div>

    <div class="col-md-12" style="margin-top: 10px">
        <p >СЪС СЕДАЛИЩЕ И АДРЕС НА УПРАВЛЕНИЕ В: <span class="bold">{{ $tvm }} {{ $permit->location }}, ОБЩ. {{ $district_name  }}</span>, </p>
    </div>
    <div class="col-md-12 " style="margin-top: 10px">
        <p><strong>{{ $permit->address }}</strong></p>
    </div>
    <div class="col-md-12 " style="margin-top: 10px">
        <p>ВПИСАН(О) В ТЪРГОВСКИЯ РЕГИСТЪР НА АГЕНЦИЯ ПО ВПИСВАНИЯТА С ЕИК <strong>{{ $permit->urn }}</strong></p>
    </div>
</div>

<div class="col-md-12 uppercase div_margin">
    <p class="bold">ПРИЛАГАНЕ НА ПРОДУКТИ ЗА РАСТИТЕЛНА ЗАЩИТА ЧРЕЗ ВЪЗДУШНО ПРЪСКАНЕ </p>
</div>
<div class="col-md-12  div_margin" style="text-align: justify">
    <p class="bold">■ Площта, която ще се третира е на територията на ОДБХ  {!! $logo[0]['city'] !!} в землището на
    {{ $permit->ground }}</p>
    <p class="bold">■  Култура, която ще се третира и фенофаза на културата - {{ $permit->cultivation }}</p>
    <p class="bold">■  Размер на площта (дка) - {{ $permit->acres }}</p>
    <p class="bold">■  Третирането ще се извърши със:  {{ $permit->prz }}</p>

    <p class="bold">■  Разрешението е валидно за периода от {{ date('d.m.Y', $permit->start_date) }} до {{ date('d.m.Y', $permit->end_date) }} г. </p>
    <p class="bold">■ Срок за уведомяване на собствениците на пчелни семейства, разположени в землището на кметството по
        местонахождение на площите, които ще бъдат третирани, както и собствениците на пчелни семейства, разположени в
        граничещите землища, за датата и часа, в който ще се извършва всяко прилагане на продукти за растителна защита
        чрез въздушно пръскане:  {{ date('d.m.Y', $permit->start_date -172800) }} г.</p>
</div>
<div class="col-md-12  div_margin" style="text-align: justify; font-style: italic">
    <p class="bold" >Информацията е публикувана на интернет страницата на ОДБХ {!! $logo[0]['city'] !!}.</p>
</div>


@if($permit->date_petition < 1478728800)
    <div class="col-md-12_my uppercase" id="bottom">
        <div class="col-md-12_my" style="margin-bottom: 10px;">
            <p class="bold inspector" style="font-size: 1.15em">ИЗГОТВИЛ: .............................. </p>
            <p class="bold inspector" style="font-size: 1.15em; margin-left: 100px">/{!! $permit->position_short.' '.$permit->inspector_name !!}/ </p>
        </div>
        <div class="col-md-12_my">
            <p class="bold" style="font-size: 1.15em">{{$director[0]['type_dir']}} ДИРЕКТОР НА ОДБХ:..............................</p>
        </div>
        <div class="col-md-12_my" >
            <p class="bold director" style="font-size: 1.15em; margin-left: 160px">/ {{$director[0]['degree']}} {{$director[0]['name']}} {{$director[0]['family']}} /</p>
        </div>
    </div>
@else
    <div class="col-md-12_my div_margin " id="bottom">
        <div class="col-md-12_my" style="margin-bottom: 10px;">
            <p class="bold inspector" style="font-size: 1.15em">ИЗГОТВИЛ: .............................. </p>
            <p class="bold inspector" style="font-size: 1.15em; margin-left: 100px">/{!! $permit->position_short.' '.$permit->inspector_name !!}/ </p>
        </div>
        <div class="col-md-12_my">
            <p class="bold" style="font-size: 1.15em">{{$director[0]['type_dir']}} ДИРЕКТОР НА ОДБХ:..............................</p>
        </div>
        <div class="col-md-12_my" >
            <p class="bold director" style="font-size: 1.15em; margin-left: 160px">/ {{$director[0]['degree']}} {{$director[0]['name']}} {{$director[0]['family']}} /</p>
        </div>
    </div>
    <div class="col-md-12_my uppercase" id="bottom" style="text-align: center; " >
        <p style="font-size: 0.9em; font-weight: bold">
            <i class="fa fa-envelope-o"></i>
            &nbsp; {!! $logo[0]['city'] !!},  п.к. {!! $logo[0]['postal_code'] !!},  {!! $logo[0]['address'] !!};<br/>
        </p>
        @if($logo[0]['fax'] == 0)
            <p style="font-size: 0.9em; font-weight: bold"><i class="fa fa-phone"></i> +359(0){!! $logo[0]['phone'] !!}; {!! $logo[0]['mail'] !!}</p>
        @else
            <p style="font-size: 0.9em; font-weight: bold"><i class="fa fa-phone my_fa"></i> / <i class="fa fa-fax"></i> : +359(0){!! $logo[0]['fax'] !!},
                <i class="fa fa-phone my_fa"></i> +359(0){!! $logo[0]['phone'] !!}; {!! $logo[0]['mail'] !!}</p>
        @endif
    </div>
@endif