<div class="content">
    <br>

    <h3 class="middle_h3 bold">КОНСТАТИВЕН ПРОТОКОЛ</h3>

    <h3 class="middle_h3 bold h4_bottom">№ {!! $protocol->number_protocol !!}</h3>
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
    if($protocol->firm == 1){
        $et = 'ЧЗС ';
        $ood = '';
    } elseif ($protocol->firm == 2) {
        $et = 'ET "';
        $ood = '" ';
    } elseif ($protocol->firm == 3) {
        $et = ' "';
        $ood = '" ООД';
    } elseif ($protocol->firm == 4) {
        $et = ' "';
        $ood = '" ЕООД';
    } elseif ($protocol->firm == 5) {
        $et = ' "';
        $ood = 'АД';
    } else {
        $et = '';
        $ood = '';
    }
    $area_firm = '';
    $district_firm = '';
    $district_object = '';
    foreach ($areas as $area) {
        if ($area->id == $farmer->areas_id) {
            $area_firm = $area->areas_name;
        }
    }
    foreach ($districts_firm as $show) {
        if ($show->district_id == $farmer->district_id) {
            $district_firm = $show->name;
        }
    }
    foreach ($districts_object as $show) {
        if($show->district_id == $protocol->district_object){
            $district_object = $show->name;
        }
    }
    if($protocol->opinions > 0 && $protocol->check_type == 0){
        $type_check = 'с издаване на становище по мярка ';
    }
    elseif($protocol->opinions == 0 && $protocol->check_type == 1){
        $type_check = 'с ';
    }
    elseif($protocol->opinions == 0 && $protocol->check_type == 2){
        $type_check = 'със съвместна проверка с ДФЗ по ';
    }
    elseif($protocol->opinions == 0 && $protocol->check_type == 3){
        $type_check = 'с плащания по ';
    }
    else{
        $type_check = 'ИМА ГРЕШКА ВИЖ ДАННИТЕ!';
    }

    if($protocol->tvm == 1){
        $city_village = 'гр. ';
    }
    elseif($protocol->tvm == 2){
        $city_village = 'с. ';
    }
    else{
        $city_village = 'гр./с. ';
    }
    ?>
    <span class="bold">Подробни данни на Земеделския Стопанин:
        <span >
            <a href="{{ URL::to('/стопанин/'.$farmer->id) }}" class="fa fa-binoculars btn btn-info my_btn"> ВИЖ ТУК</a>
        </span>
    </span>
    @if($farmer->type_firm == 1)
        <p>Физическо /Юридическо лице: <span class="bold">{!! $et.$protocol->name !!}</span></p>
        <p>ЕГН/ЕИК - <span class="bold">{!! $farmer->pin !!}</span></p>
        <p>Адрес:<span class="bold"> {!! $farmer->address !!}, общ. {!! $district_firm !!}, обл. {!! $area_firm !!}</span></p>
        <p>Представлявано от: <span class="bold"> {!! $farmer->name !!}</span></p>
    @else
        <p>Физическо /Юридическо лице: <span class="bold">{!! $et !!}{!! $protocol->name !!}{!! $ood !!}</span></p>
        <p>ЕИК - <span class="bold">{!! $farmer->bulstat !!}</span></p>
        <p>Адрес:<span class="bold"> {!! $farmer->address !!}, общ. {!! $district_firm !!}, обл. {!! $area_firm !!}</span></p>
        <p>Представлявано от: <span class="bold"> {!! $farmer->owner !!}</span> с ЕГН: <span class="bold"> {!! $farmer->pin_owner !!}</span></p>
    @endif

    <br>
    <h4 style="display: inline-block">Проверен обект:</h4>
    <p>Стопанството се намира в община <span class="bold"> {!! $district_object !!}</span> - Населено място/а в <span class="bold">{!! $protocol->location_farm !!}</span></p>

    <br/>
    <h4>При проверката установихме следните факти и обстоятелства:</h4>
    <p>Констатация: <span class="bold">{!! $protocol->ascertainment !!}</span></p>
    <p>Конфискувани: <span class="bold">{!! $protocol->taken !!}</span></p>
    <p>Нареждане: <span class="bold">{!! $protocol->order_protocol !!}</span></p>
    <br/>
    <h4>Други данни:</h4>
    @if($protocol->type_check == 0)
        <p>Проверката е: <span class="bold"> НА ТЕРЕН</span></p>
    @elseif($protocol->type_check == 1)
        <p>Проверката е: <span class="bold"> ДОКУМЕНТАЛНА</span></p>
    @endif
    <p>Протокола е издаден във връзка {!! $type_check !!}<span class="bold">{!! $protocol->description !!}</span>.</p><br/>

    @if($protocol->assay > 1)
        <p>Има взети проби.</p>
    @endif
</div>