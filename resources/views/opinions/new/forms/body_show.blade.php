<?php
if($opinion->type_firm == 1 || $opinion->type_firm  == 0){
    $et = '';
    $ood = '';
    $pin = 'ЕГН: ';
}
elseif($opinion->type_firm == 2 ){
    $et = 'ET "';
    $ood = '" ';
    $pin = 'ЕИК: ';
}
elseif($opinion->type_firm  == 3 ){
    $et = ' "';
    $ood = '" ООД';
    $pin = 'ЕИК: ';
}
elseif($opinion->type_firm  == 4 ){
    $et = ' "';
    $ood = '" ЕООД';
    $pin = 'ЕИК: ';
}
elseif($opinion->type_firm  == 5 ){
    $et = ' "';
    $ood = '" АД';
    $pin = 'ЕИК: ';
}
elseif($opinion->type_firm  == 6 ){
    $et = '';
    $ood = '';
    $pin = 'ЕИК: ';
}
else{
    $et = '';
    $ood = '';
    $pin = 'ЕГН/ЕИК: ';
}

if($opinion->tvm == 1){
    $tvm = 'гр. ';
}
elseif($opinion->tvm == 2 ){
    $tvm = 'с. ';
}
else{
    $tvm = 'гр./с. ';
}
?>

<fieldset><legend>ДАННИ ЗА СТАНОВИЩЕТО</legend>
    <a href="{{ URL::to('/стопанин/'.$opinion->farmer_id) }}" class="fa fa-user btn btn-warning my_btn"> Данни на Земеделския Стопанин</a>
    <hr/>
    <p>Становище с изходящ номер: <span class="bold">{!! $opinion->index_opinion.' - '.$opinion->number_opinion !!} / {!! date('d.m.Y', $opinion->date_opinion) !!} г.</span></p>
    <p>По мярка: <span class="bold">{!! $opinion->opinion !!}</span></p>
    <p>Издаден на: <span class="bold">{!! $et.$opinion->name.$ood !!}</span> с {!! $pin !!} - <span class="bold">{!! $opinion->pin !!}</span></p>
    <p>Адрес на бенефициента: <span class="bold">{!! $opinion->address !!}; &nbsp;{!! $tvm.$opinion->location !!}</span></p>
    <p>Стопанството се намира в община: <span class="bold">{!! $opinion->district_name !!}</span></p>
    <hr/>
    @if(($opinion->number_protocol == 0 || $opinion->date_protocol == 0) || $opinion->double_protocol >= 4)
        <p>Няма издаден Констативен протокол за Становището</p>
    @else
        <span>Издаен е КП с Номер: <span class="bold">{!! $opinion->number_protocol !!}/{!! date('d.m.Y', $opinion->date_protocol) !!} г.</span></span>
        <span><a class="fa fa-eye btn btn-primary my_btn" href="{!! URL::to('/протокол-зс/'.$opinion->id.'/'.$opinion->number_protocol)!!}" style="margin: 3px 0"> ВИЖ Протокола</a></span>
    @endif
    <hr/>
    <p>Документите са обработени от: <span class="bold">{!! $opinion->position_short !!} {!! $opinion->inspector_name !!}</span></p>
</fieldset>