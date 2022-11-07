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
        $et = 'Ф.Л./ЧЗП ';
        $ood = '';
        $eik = $protocol->pin;
        $owner = $protocol->name;
    }
    elseif ($protocol->firm == 2) {
        $et = 'ET';
        $ood = '';
        $eik = $protocol->bulstat;
        $owner = $protocol->owner;
    }
    elseif ($protocol->firm == 3) {
        $et = '';
        $ood = 'ООД';
        $eik = $protocol->bulstat;
        $owner = $protocol->owner;
    }
    elseif ($protocol->firm == 4) {
        $et = '';
        $ood = 'ЕООД';
        $eik = $protocol->bulstat;
        $owner = $protocol->owner;
    }
    elseif ($protocol->firm == 5) {
        $et = '';
        $ood = 'АД';
        $eik = $protocol->bulstat;
        $owner = $protocol->owner;
    }
    else {
        $et = '';
        $ood = '';
        $eik = $protocol->bulstat;
        $owner = $protocol->owner;
    }
    $area_firm = '';
    $district_firm = '';
    $district_object = '';
    foreach ($areas as $area) {
        if ($area->id == $protocol->id_region) {
            $area_firm = $area->areas_name;
        }
    }
    foreach ($districts_firm as $show) {
        if ($show->district_id == $protocol->district) {
            $district_firm = $show->name;
        }
    }
    foreach ($districts_object as $show) {
        if($show->district_id == $protocol->district_object){
            $district_object = $show->name;
        }
    }


    if($protocol->ot == 100){
        $type_object = 'Нерегламентиран обект';
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
    if(strlen($protocol->pin)>0 && strlen($protocol->pin_owner) == 0){
        $pin = $protocol->pin;
    }
    elseif(strlen($protocol->pin)== 0 && strlen($protocol->pin_owner) > 0){
        $pin = $protocol->pin_owner;
    }
    elseif(strlen($protocol->pin) == 0 && strlen($protocol->pin_owner) == 0){
        $pin = '';
    }
    else{
        $pin = '';
    }
    ?>
    <span class="bold">Подробни данни на Фирмата:
    </span>
    <p>Физическо /Юридическо лице: <span class="bold">{!! $et !!} "{!! $protocol->name !!}" {!! $ood !!}</span></p>
    <p>ЕИК - <span class="bold">{!! $eik !!}</span></p>
    <p>Адрес:<span class="bold"> {!! $protocol->address !!}, общ. {!! $district_firm !!}, обл. {!! $area_firm !!}</span></p>
    <p>Представлявано от: <span class="bold"> {!! $owner !!}</span> с ЕГН: <span class="bold"> {!! $pin !!}</span></p>
    <br>
    <h4 style="display: inline-block">Проверен обект:</h4> <span class="bold">{!! $type_object !!} </span>
    <p>адрес: <span class="bold">{!! $protocol->address_object !!}, {!! $city_village_object.''.$protocol->location_object.', общ. '.$district_object !!}</span></p>

    <br/>
    <h4>При проверката установихме следните факти и обстоятелства:</h4>
    <p>Констатация: <span class="bold">{!! $protocol->ascertainment !!}</span></p>
    <p>Конфискувани: <span class="bold">{!! $protocol->taken !!}</span></p>
    <p>Нареждане: <span class="bold">{!! $protocol->order_protocol !!}</span></p>
    <br/>
    <h4>Други данни:</h4>
    @if($protocol->type_check == 1)
        <p>Проверката е: <span class="bold"> В ОБЕКТА</span></p><br/>
    @elseif($protocol->type_check == 2)
        <p>Проверката е: <span class="bold"> ДОКУМЕНТАЛНА</span></p><br/>
    @endif

    <div class="col-md-12 my_div">
        <div class="col-md-12 my_div">
            @if($protocol->assay == 1)
                <a class="assay_doc bold" id="assay_doc" href="{{ URL::to('/проби-тор') }}">
                    <i class="fa fa-flask " aria-hidden="true"></i> Дневник за взети проби от ТОР - ВИЖ!
                </a>
                <hr/>
                @if(count($tor)>0)
                    <p>Взети проби от <span class="bold">ТОР</span></p><hr/>
                    <table>
                        <tbody>
                        <?php $n = 1; ?>
                        @foreach($tor as $assay)
                            @if($assay->eo == 1)
                                <tr>
                                    <td>
                                        {!! $n++.'. ' !!}
                                        Проба от: <span class="bold">{!! $assay->name !!} </span>
                                        съдържа:  <span class="bold">{!! $assay->active_subs !!}</span>
                                        с маркровка ЕО тор
                                    </td>
                                </tr>
                            @endif
                            @if($assay->eo == 0)
                                <tr>
                                    <td>
                                        {!! $n++.'. ' !!}
                                        Проба от: <span class="bold">{!! $assay->name !!} </span>
                                        съдържа:  <span class="bold">{!! $assay->active_subs !!}</span>
                                        без маркровка ЕО тор
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="red bold"><span class="fa fa-warning bold"> ВНИМАНИЕ!</span> Маркирано е, че има взета проба от ТОР, но не е добавна в Базата Данни.<br>
                        Радактирай Протокола и маркирай, че няма взета пробали или добави взетата проба сега!
                    </p>
                @endif
            @else
                <p class="bold">Няма взети проби от торове.</p><hr/>
            @endif
        </div>
    </div>
    <br/>
    <div class="col-md-12 my_div my_alert">
        <div class="alert alert-info my_alert" role="alert">
            <p class=""><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
                <span class="bold ">1. Ако с този протокол има взети повече проби от ПРЗ или Тор, ги добавете тук.</span><br/>
                <span class="bold ">2. Ако при създаването на Протокола не са добавени взетите проби, можете да ги добавите тук.</span><br/>
                <span class="bold ">3. Ако е сгрешен Протокола и няма взети проби с този номер, а са добавени към този Протокол, изпълнете следните стъпки!<br/>
                    - 1. Редактирайте този Протокол и маркирайте, че няма взети проби;<br/>
                    - 2. Отидете на Протокола с който са взети пробите и го редактирайте, като маркирате, че има взета проба;<br/>
                    - 3. Отидете на страница "Дневник на взетите проби" и там редактирайте пробата като коригирате данните
                    за коректния Протокол;<br/>
                    - 4. <span class="bold red">Внимание!</span> Ако все още не е създаден запис за Протокола от който са взети пробите,
                    създайте го като маркирате, че НЯМА ВЗЕТА ПРОБА. След което изпълнете стъпки 1, 2 и 3.
                </span>
            </p>
        </div>
    </div>


    <div class="col-md-12 my_div">
        <hr class="middle_hr">
        {!! Form::open(['url'=>'assay-tor-none/add/'.$protocol->id  , 'method'=>'POST', 'id'=>'form-tor']) !!}
            {!! Form::label('tor_name', 'Име на ТОР:', ['class'=>'my_labels']) !!}
            {!! Form::text('tor_name', null, ['size'=>15, 'maxlength'=>100 ]) !!}
            &nbsp;
            {!! Form::label('tor_av', 'С-е:', ['class'=>'my_labels']) !!}
            {!! Form::text('tor_av', null, ['size'=>15, 'maxlength'=>100 ]) !!}

            <label class="eo_tor"><span>&nbsp;ЕО&nbsp; НЕ: </span>
                {!! Form::radio('eo_tor', 0, false) !!}
            </label>
            <label class="eo_tor"><span>&nbsp;&nbsp;ДА: </span>
                {!! Form::radio('eo_tor', 1, false) !!}
            </label>
            &nbsp;&nbsp; | &nbsp;&nbsp;
            {!! Form::submit('Добави Проба от ТОР!', ['class'=>'btn btn-danger', 'id'=>'submit-tor']) !!}
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token-tor">
            <input type="hidden" name="tor_hidden" value="1" id="tor-hidden">
        {!! Form::close() !!}
    </div>
</div>

