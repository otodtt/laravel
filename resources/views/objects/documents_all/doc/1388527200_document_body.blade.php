<div class="number_doc_all col-md-12 div_margin">
    <div class="col-md-12 row_top">
        @if($object->active == 0)
            <h3 class="bold" id="number_doc">У Д О С Т О В Е Р Е Н И Е</h3>
        @else
            <h3 class="bold red" id="number_doc">У Д О С Т О В Е Р Е Н И Е - ПРЕКРАТЕН СРОК</h3>
        @endif
    </div>
    <div class="col-md-12">
        <p id="date_doc">№ {!! $number_licence !!}</p>
    </div>
    <div class="col-md-12 row_bottom">
        <p id="town_doc">{!! $logo[0]['city'] !!} / {!! date('d.m.Y', $object->date_licence) !!}
            <span cla="lowercase">г.</span></p>
    </div>
</div>

<div class="col-md-12 div_margin">
    <p id="petition">Въз основа на Заявление с вх. №
        {!! $object->index_petition !!} - {!! $object->number_petition !!} / {!! date('d.m.Y', $object->date_petition) !!} г.
        и на основание чл. 94, ал. 1 от Закона
        за защита на растенията</p>
</div>

<div class="col-md-12 center uppercase div_margin">
    @if($object->active == 0)
        <h4 class="publish"><span class="bold">И З Д А В А М:</span></h4>
    @else
        <h4 class="publish"><span class="bold red">ПРЕКРАТЕН СРОК</span></h4>
    @endif
</div>

<div class="col-md-12 uppercase div_margin">
    <div class="col-md-12">
        @if($object_type == 3)
            <p ><span class="bold">УДОСТОВЕРЕНИЕ ЗА ПРЕОПАКОВАНЕ НА ПРОДУКТИ ЗА РАСТИТЕЛНА ЗАЩИТА НА</span></p>
        @else
            <p ><span class="bold">УДОСТОВЕРЕНИЕ ЗА ТЪРГОВИЯ С ПРОДУКТИ ЗА РАСТИТЕЛНА ЗАЩИТА НА</span></p>
        @endif
    </div>
    <div>
        <p ><span class="bold">{{$et}} "{{$firm->name}}" {{$ood}}</span></p>
    </div>
</div>

<div class="col-md-12 uppercase div_margin">
    <div class="owner">
        <span >ПРЕДСТАВЛЯВАН(О) ОТ {{$firm->owner}}</span>
    </div>
    <div class="egn">
        <span >ЕГН: {{$firm->egn}}</span>
    </div>
</div>

<div class="col-md-12 uppercase div_margin">
    <div >
        <p >СЪС СЕДАЛИЩЕ И АДРЕС НА УПРАВЛЕНИЕ В {{$grad_selo}} {{$firm->location}},</p>
    </div>
    <div >
        <p >{{$firm->address}}</p>
    </div>
    <div >
        <p >С ЕИК / БУЛСТАТ {{$firm->bulstat}}</p>
    </div>
</div>

<div class="col-md-12 uppercase div_margin">
    <div >
        @if($object_type == 3)
            <p ><span class="bold">В ОБЕКТ ЗА ПРЕОПАКОВАНЕ НА ПРОДУКТИ ЗА РАСТИТЕЛНА ЗАЩИТА:</span></p>
        @else
            <p ><span class="bold">В ОБЕКТ ЗА ТЪРГОВИЯ С ПРОДУКТИ ЗА РАСТИТЕЛНА ЗАЩИТА:</span></p>
        @endif
    </div>
    <div >
        <p >{{$town_object}} {{$object->location}}, ОБЩ. {{$districts_name_object}}, ОБЛ. {{$area_name[0]['area']}}</p>
    </div>
    <div >
        <p >{{$object->address}}</p>
    </div>
</div>

<div class="col-md-12 uppercase div_margin">
    <div >
        @if($object_type == 3)
            <p ><span class="bold">ЛИЦЕ, ОТГОВОРНО ЗА ДЕЙНОСТТА В ОБЕКТА ЗА ПРЕОПАКОВАНЕ: </span></p>
        @else
            <p ><span class="bold">ЛИЦЕ ЗА ТЪРГОВИЯ С ПРОДУКТИ ЗА РАСТИТЕЛНА ЗАЩИТА:</span></p>
        @endif
    </div>
    <div >
        @if($object_type == 1)
            <p >В ССА: {{$object->seller}}</p>
        @elseif($object_type == 2)
            <p >В СКЛАД: {{$object->seller}}</p>
        @elseif($object_type == 3)
            <p >В ЦЕХ: {{$object->seller}}</p>
        @endif
    </div>
    <div >
        <p >СЕРТИФИКАТ № {{$object->index_certificate}} - {{$certificate_number}} /
            {{ $object->date_certificate }} <span id="lowercase">г.</span></p>
    </div>
</div>


<div class="col-md-12 uppercase div_margin">
    <p ><span class="bold">УДОСТОВЕРЕНИЕТО ВАЖИ ДО: {{ date('d.m.Y', $object->end_date)}}
            <span class="lowercase">г.</span></span></p>
</div>

<div class="col-md-12 uppercase div_margin">
    <p >УДОСТОВЕРЕНИЕТО Е ВПИСАНО В РЕГИСТЪРА ПО ЧЛ. 6 АЛ. 1, Т. 4 ОТ ЗЗР</p>
</div>

<div class="col-md-12 uppercase" id="bottom">
    <div class="col-md-12">
        <p class="bold inspector">ИЗГОТВИЛ: {{$object->inspector_name}}:.............................. </p>
    </div>
    <div class="col-md-12">
        <p class="bold">{{$director[0]['type_dir']}} ДИРЕКТОР НА ОДБХ:..............................</p>
    </div>
    <div class="col-md-12" >
        <p class="bold director">/ {{$director[0]['degree']}} {{$director[0]['name']}} {{$director[0]['family']}} /</p>
    </div>
</div>
