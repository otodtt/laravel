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
        $ood = '" АД';
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
    @if($protocol->type_check == 2)
        <p>Проверката е: <span class="bold"> НА ТЕРЕН</span></p>
    @elseif($protocol->type_check == 1)
        <p>Проверката е: <span class="bold"> ДОКУМЕНТАЛНА</span></p>
    @endif
    <p>Протокола е издаден във връзка {!! $type_check !!}<span class="bold">{!! $protocol->description !!}</span>
        @if($protocol->opinion_id > 0)
            &nbsp;&nbsp; <a class="fa fa-eye btn btn-success my_btn" href="{!!URL::to('/становище/'.$protocol->opinion_id)!!}" style="margin: 3px 0"> ВИЖ Становището</a>
        @endif
    </p><br/>
    @if($protocol->act > 0)
        <p class="bold red">Има издаден Акт за Административно нарушение.</p>
    @endif


    <div class="col-md-12 my_div">
        @if($protocol->assay_more == 0 && $protocol->assay_prz == 0 && $protocol->assay_tor == 0 && $protocol->assay_metal == 0
            && $protocol->assay_micro == 0  && $protocol->assay_other == 0)
            <p class="bold">Няма взети проби.</p>
        @else
            {{--Остатъци--}}
            @if($protocol->assay_more > 0)
                @if(strlen($protocol->assay_more_name) == 0)
                    <p class="bold red">Маркирано е, че има взета проба за Остатъци от ПРЗ но не е попълнена културата. Редактирай Протокола и добави културата</p>
                @else
                    <p class="bold">Взета е проба за Остатъци от ПРЗ от култура - {{ $protocol->assay_more_name }}</p>
                @endif
            @endif
            {{--Идентификация--}}
            @if($protocol->assay_prz > 0)
                @if(strlen($protocol->assay_prz_name) == 0)
                    <p class="bold red">Маркирано е, че има взета проба за Идентификация на ПРЗ но не е попълнена културата. Редактирай Протокола и добави културата</p>
                @else
                    <p class="bold">Взета е проба за Идентификация на ПРЗ от култура - {{ $protocol->assay_prz_name }}</p>
                @endif
            @endif
            {{--Нитрати--}}
            @if($protocol->assay_tor > 0)
                @if(strlen($protocol->assay_tor_name) == 0)
                    <p class="bold red">Маркирано е, че има взета проба за Нитрати но не е попълнена културата. Редактирай Протокола и добави културата</p>
                @else
                    <p class="bold">Взета е проба за Нитрати от култура - {{ $protocol->assay_tor_name }}</p>
                @endif
            @endif
            {{--Метали--}}
            @if($protocol->assay_metal > 0)
                @if(strlen($protocol->assay_metal_name) == 0)
                    <p class="bold red">Маркирано е, че има взета проба за Тежки метали но не е попълнена културата. Редактирай Протокола и добави културата</p>
                @else
                    <p class="bold">Взета е проба за Тежки метали от култура - {{ $protocol->assay_metal_name }}</p>
                @endif
            @endif
            {{--Замърсители--}}
            @if($protocol->assay_micro > 0)
                @if(strlen($protocol->assay_micro_name) == 0)
                    <p class="bold red">Маркирано е, че има взета проба за Микробиологични замърсители но не е попълнена културата. Редактирай Протокола и добави културата</p>
                @else
                    <p class="bold">Взета е проба за Микробиологични замърсители от култура - {{ $protocol->assay_micro_name }}</p>
                @endif
            @endif
            {{--Друго--}}
            @if($protocol->assay_other > 0)
                @if(strlen($protocol->assay_other_name) == 0)
                    <p class="bold red">Маркирано е, че има взета проба но не е попълнена културата. Редактирай Протокола и добави културата</p>
                @else
                    <p class="bold">Взета е проба от култура - {{ $protocol->assay_other_name }}</p>
                @endif
            @endif
        @endif
    </div>
</div>