<div class="content">
    <br>

    <h3 class="middle_h3 bold">КОНСТАТИВЕН ПРОТОКОЛ</h3>

    <h3 class="middle_h3 bold h4_bottom">№ {!! $protocol->number !!}</h3>
    <h4>Днес: <span class="bold">{!! date('d.m.Y', $protocol->date_protocol) !!} год.</span></h4>
    <br/>
    <h4 class="">подписаният:</h4>
    @foreach($inspectors as $inspector)
        @if($inspector->id == $protocol->inspector)
        <p><span class="bold">{!! $inspector->all_name !!}</span><br/>
            на длъжност <span class="bold">{!! $protocol->position !!}</span>
            в ОДБХ {!! $city->city !!} сл. карта № <span class="bold">{!! $inspector->karta !!}</span>
        </p>
        @endif
    @endforeach
    <br>
    <h4>с участието на:</h4>
    @if($protocol->inspector_two > 0)
        @foreach($inspectors as $inspector)
            @if($inspector->id == $protocol->inspector_two)
                <p>1. <span class="bold">{!! $inspector->all_name !!}</span><br/>
                    на длъжност <span class="bold">{!! $protocol->position_two !!}</span>
                    в ОДБХ {!! $city->city !!} сл. карта № <span class="bold">{!! $inspector->karta !!}</span>
                </p>
            @endif
        @endforeach
    @else
        <p>1.  ..............................</p>
    @endif

    @if($protocol->inspector_three > 0)
        @foreach($inspectors as $inspector)
            @if($inspector->id == $protocol->inspector_three)
                <p>2. <span class="bold">{!! $inspector->all_name !!}</span><br/>
                    на длъжност <span class="bold">{!! $protocol->position_three !!}</span>
                    в ОДБХ {!! $city->city !!} сл. карта № <span class="bold">{!! $inspector->karta !!}</span>
                </p>
            @endif
        @endforeach
    @else
        <p>2.  ..............................</p>
    @endif
    @if(strlen($protocol->inspector_another) > 0)
        <p>3. <span class="bold">{!! $protocol->inspector_another !!}</span>
            от служба <span class="bold">{!! $protocol->inspector_from !!}</span>
        </p>
    @else
        <p>3.  ..............................</p>
    @endif
    <br/>
    <h4>Проверихме обекта на:</h4>
    <?php

    if ($protocol->firm == 1) {
        $et = 'ET';
        $ood = '';
    }
    elseif ($protocol->firm == 2) {
        $et = '';
        $ood = 'ООД';
    }
    elseif ($protocol->firm == 3) {
        $et = '';
        $ood = 'ЕООД';
    }
    elseif ($protocol->firm == 4) {
        $et = '';
        $ood = 'АД';
    }
    else {
        $et = '';
        $ood = '';
    }
    $area_firm = '';
    $district_firm = '';
    $district_object = '';
    ///// За Фирмата
    foreach ($areas_firm as $area) {
        if ($area->id == $protocol->areas_id) {
            $area_firm = $area->areas_name;
        }
    }
    foreach ($districts_firm as $show) {
        if ($show->district_id == $protocol->district_id) {
            $district_firm = $show->name;
        }
    }
    /////// За обекта
    foreach ($areas_firm as $area) {
        if($area->id == $protocol->area_object){
            $area_object = $area->areas_name;
        }
    }
    foreach ($districts_object as $show) {
        if ($show->district_id == $protocol->district_object) {
            $district_object = $show->name;
        }
    }

    if($protocol->ot == 1){
        $type_object = 'С.С. АПТЕКА';
    }
    elseif($protocol->ot == 2){
        $type_object = 'СКЛАД ЗА ТЪРГОВИЯ НА ЕДРО С ПРЗ';
    }
    elseif($protocol->ot == 3){
        $type_object = 'ЦЕХ ЗА ПРЕОПАКОВАНЕ НА ПРЗ';
    }
    else{
        $type_object = '';
    }

    if($protocol->city_village == 1){
        $city_village = 'гр. ';
    }
    if($protocol->city_village == 2){
        $city_village = 'с. ';
    }
    if($protocol->city_village == 0){
        $city_village = 'гр./с.';
    }
    ////////////////
    if($protocol->cv_object == 1){
        $city_village_object = 'гр. ';
    }
    if($protocol->cv_object == 2){
        $city_village_object = 'с. ';
    }
    if($protocol->cv_object == 0){
        $city_village_object = 'гр./с.';
    }
    ?>
    <span class="bold">Подробни данни на Фирмата:
    </span>
    <p>Физическо /Юридическо лице: <span class="bold">{!! $et !!} "{!! $protocol->name !!}" {!! $ood !!}</span></p>
    <p>ЕИК - <span class="bold">{!! $protocol->bulstat !!}</span></p>
    <p>Адрес:<span class="bold"> {!! $protocol->address !!}, {!! $city_village.''.$protocol->location !!}, общ. {!! $district_firm !!}, обл. {!! $area_firm !!}</span></p>
    <p>Представлявано от: <span class="bold"> {!! $protocol->owner !!}</span> с ЕГН: <span class="bold"> {!! $protocol->pin_owner !!}</span></p>
    <br>
    <h4 style="display: inline-block">Проверен обект:</h4> <span class="bold">{!! $type_object !!} </span>
    <p>адрес: <span class="bold">{!! $protocol->address_object !!}, {!! $city_village_object.''.$protocol->location_object.', общ. '.$district_object.' обл. '.$area_object !!}</span></p>

    <br/>
    <h4>При проверката установихме следните факти и обстоятелства:</h4>
    <p>Констатация: <span class="bold">{!! $protocol->ascertainment !!}</span></p>
    <p>Конфискувани: <span class="bold">{!! $protocol->taken !!}</span></p>
    <p>Нареждане: <span class="bold">{!! $protocol->order_protocol !!}</span></p>
    <br/>
    <h4>Други данни:</h4>
    <p>Проверката е: <span class="bold"> В ОБЕКТА</span></p>
</div>

