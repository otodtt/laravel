<div class="content">
    <br>

    <h3 class="middle_h3 bold">
        КОНСТАТИВЕН ПРОТОКОЛ
        @if($protocol->id_from_report > 0 && $protocol->number_report > 0)
            КЪМ ДОКЛАД ОТ ПРОВЕРКА
        @endif
    </h3>

    <h3 class="middle_h3 bold h4_bottom">№ {!! $protocol->number !!}</h3>
    @if($protocol->id_from_report > 0 && $protocol->number_report > 0)
        <h3 class="middle_h3 bold h4_bottom">
            Доклад от проверка № {!! $protocol->number_report !!}/{!! date('d.m.Y', $protocol->date_report) !!} г.
            <span >
                <a href="{{ URL::to('/доклад-аптека/'.$report[0]['id']) }}" class="fa fa-binoculars btn btn-info my_btn"> ВИЖ ДОКЛАДА</a>
            </span>
        </h3>
    @endif

    <h4>Днес: <span class="bold">{!! date('d.m.Y', $protocol->date_protocol) !!} год.</span></h4>
    <br/>
    <h4 class="">подписаният:</h4>
    @foreach($inspectors as $inspector)
        @if($inspector->id == $protocol->inspector)
        <p><span class="bold">{!! $inspector->all_name !!}</span><br/>
            на длъжност <span class="bold">{!! $report[0]['position_short'] !!}</span>
            в ОДБХ {!! $city->city !!} сл. карта № <span class="bold">{!! $inspector->karta !!}</span>
        </p>
        @endif
    @endforeach
    <br>
    <h4>с участието на:</h4>
    @if($report[0]['inspector_two'] > 0)
        @foreach($inspectors as $inspector)
            @if($inspector->id == $report[0]['inspector_two'])
                <p>1. <span class="bold">{!! $inspector->all_name !!}</span><br/>
                    на длъжност <span class="bold">{!! $report[0]['position_short_two'] !!}</span>
                    в ОДБХ {!! $city->city !!} сл. карта № <span class="bold">{!! $inspector->karta !!}</span>
                </p>
            @endif
        @endforeach
    @else
        <p>1.  ..............................</p>
    @endif

    @if($report[0]['inspector_three'] > 0)
        @foreach($inspectors as $inspector)
            @if($inspector->id == $report[0]['inspector_two'])
                <p>2. <span class="bold">{!! $inspector->all_name !!}</span><br/>
                    на длъжност <span class="bold">{!! $report[0]['position_short_three']!!}</span>
                    в ОДБХ {!! $city->city !!} сл. карта № <span class="bold">{!! $inspector->karta !!}</span>
                </p>
            @endif
        @endforeach
    @else
        <p>2.  ..............................</p>
    @endif
    @if(strlen($report[0]['inspector_another']) > 0)
        <p>3. <span class="bold">{!! $report[0]['inspector_another']!!}</span>
            от служба <span class="bold">{!! $report[0]['inspector_from']!!}</span>
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
    } elseif ($protocol->firm == 2) {
        $et = '';
        $ood = 'ООД';
    } elseif ($protocol->firm == 3) {
        $et = '';
        $ood = 'ЕООД';
    } elseif ($protocol->firm == 4) {
        $et = '';
        $ood = 'АД';
    } else {
        $et = '';
        $ood = '';
    }
    $area_firm = '';
    $district_firm = '';
    $district_object = '';
    foreach ($areas as $area) {
        if ($area->id == $firm->areas_id) {
            $area_firm = $area->areas_name;
        }
    }
    foreach ($districts_firm as $show) {
        if ($show->district_id == $firm->district_id) {
            $district_firm = $show->name;
        }
    }
    foreach ($districts_object as $show) {
        if($show->district_id == $protocol->district_object){
            $district_object = $show->name;
        }
        if($show->district_id == $object->district_object){
            $district_object_firm = $show->name;
        }
    }
    if($protocol->ot == 1){
        $type_object = 'ССА';
    }
    if($protocol->ot == 2){
        $type_object = 'СКЛАД';
    }
    if($protocol->ot == 3){
        $type_object = 'ЦЕХ';
    }

    if($protocol->city_village == 1){
        $city_village = 'гр. ';
    }
    elseif($protocol->city_village == 2){
        $city_village = 'с. ';
    }
    else{
        $city_village = 'гр./с. ';
    }
    ?>
    <span class="bold">Подробни данни на Фирмата:
        <span >
            <a href="{{ URL::to('/фирма/'.$firm->id) }}" class="fa fa-binoculars btn btn-info my_btn"> ВИЖ ТУК</a>
        </span>
    </span>
    <p>Физическо /Юридическо лице: <span class="bold">{!! $et !!} "{!! $protocol->name !!}" {!! $ood !!}</span></p>
    <p>ЕИК - <span class="bold">{!! $firm->bulstat !!}</span></p>
    <p>Адрес:<span class="bold"> {!! $firm->address !!}, общ. {!! $district_firm !!}, обл. {!! $area_firm !!}</span></p>
    <p>Представлявано от: <span class="bold"> {!! $firm->owner !!}</span> с ЕГН: <span class="bold"> {!! $firm->egn !!}</span></p>
    <br>
    <h4 style="display: inline-block">Проверен обект:</h4> <span class="bold">{!! $type_object !!} </span>
    <p>адрес: <span class="bold">{!! $object->address !!}, {!! $city_village.''.$protocol->place.', общ. '.$district_object_firm !!}</span></p>

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

    @if($protocol->id_from_report > 0 && $protocol->number_report > 0 )
        <div class="col-md-12 my_div">
            <div class="col-md-6 my_div">
                <hr/><p class="bold">Взетите проби от ПРЗ и Торове са описани в доклада.</p><hr/>
            </div>
        </div>
    @else
        <div class="col-md-12 my_div">
            <div class="col-md-6 my_div">
                @if($protocol->assay_prz == 1 || $protocol->assay_more == 1 )
                    <a class="assay_doc bold" id="assay_doc" href="{{ URL::to('/проби') }}">
                        <i class="fa fa-flask " aria-hidden="true"></i> Дневник за взети проби от ПРЗ - ВИЖ!
                    </a>
                    <hr/>
                    @if((isset($prz) && count($prz)>0 ) || (isset($more) && count($more)>0))
                        <p>Взети проби от <span class="bold">ПРЗ</span></p><hr/>
                        <table>
                            <tbody>
                            <?php $n = 1; ?>
                            @foreach($prz as $assay)
                                <tr>
                                    <td>
                                        {!! $n++.'. ' !!}Проба от: <span class="bold">{!! $assay->name !!} </span>  с активно в-во:  <span class="bold">{!! $assay->active_subs !!}</span>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($more as $assay_more)
                                <tr>
                                    <td>
                                        {!! $n++.'. ' !!}Проба за удължаване на срока от: <span class="bold">{!! $assay_more->name !!} </span>  с активно в-во:  <span class="bold">{!! $assay_more->active_subs !!}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <span class="red bold"><span class="fa fa-warning bold"> ВНИМАНИЕ!</span> Маркирано е, че има взета проба от ПРЗ, но не е добавна в Базата Данни.<br>
                            Радактирай Протокола и маркирай, че няма взета пробали или добави взетата проба сега!
                        </span>
                    @endif
                @else
                    <p class="bold">Няма взети проби от ПРЗ.</p><hr/>
                @endif
            </div>
            <div class="col-md-6 my_div">
                @if($protocol->assay_tor == 1)
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

        <div class="col-md-6 col-md-6_my " >
            <fieldset class="small_field example_field_left">
                <span class="bold">Ще добавите ли проба от ПРЗ?</span>&nbsp;&nbsp;
                <label class="assay_prz"><span>НЕ: </span>
                    {!! Form::radio('assay_prz', 0, true) !!}
                </label>&nbsp;&nbsp;|
                <label class="assay_prz"><span>&nbsp;&nbsp;ДА: </span>
                    {!! Form::radio('assay_prz', 1, false) !!}
                </label>
            </fieldset>
        </div>

        <div class="col-md-6 col-md-6_my ">
            <fieldset class="small_field example_field_right">
                <span class="bold">Ще добавите ли проба от ТОР?</span>&nbsp;&nbsp;
                <label class="assay_tor"><span>НЕ: </span>
                    {!! Form::radio('assay_tor', 0, true) !!}
                </label>&nbsp;&nbsp;|
                <label class="assay_tor"><span>&nbsp;&nbsp;ДА: </span>
                    {!! Form::radio('assay_tor', 1, false) !!}
                </label>
            </fieldset>
        </div>

        <div class="col-md-12 my_div hidden " id="prz_check">
            <hr class="middle_hr">
            {!! Form::open(['url'=>'assay-prz/add/'.$protocol->id , 'method'=>'POST', 'id'=>'form-prz']) !!}
                {!! Form::label('prz_name', 'Име на ПРЗ:', ['class'=>'my_labels']) !!}
                {!! Form::text('prz_name', null, ['size'=>15, 'maxlength'=>100 ]) !!}
                &nbsp;&nbsp;
                {!! Form::label('prz_av', 'А. В-во:', ['class'=>'my_labels']) !!}
                {!! Form::text('prz_av', null, ['size'=>15, 'maxlength'=>100 ]) !!}
                &nbsp; | &nbsp;
                <span class="bold">За удължаване срока на годност на ПРЗ:</span>&nbsp;&nbsp;
                <label class="more"><span class="green">НЕ: </span>
                    {!! Form::radio('more', 0, true) !!}
                </label>&nbsp;&nbsp;|
                <label class="more"><span class="red">&nbsp;&nbsp;ДА: </span>
                    {!! Form::radio('more', 1, false) !!}
                </label>
            &nbsp;
                {!! Form::submit('Добави Проба от ПРЗ!', ['class'=>'btn btn-danger', 'id'=>'submit-prz']) !!}
                <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token-prz">
                <input type="hidden" name="assay_prz" value="0" id="prz-hidden">
            {!! Form::close() !!}
        </div>

        <div class="col-md-12 my_div hidden tor_div" id="tor_check" >
        <hr class="middle_hr">
        {!! Form::open(['url'=>'assay-tor/add/'.$protocol->id  , 'method'=>'POST', 'id'=>'form-tor']) !!}
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
        &nbsp; | &nbsp;
            {!! Form::submit('Добави Проба от ТОР!', ['class'=>'btn btn-info', 'id'=>'submit-tor']) !!}
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token-tor">
            <input type="hidden" name="tor_hidden" value="1" id="tor-hidden">
        {!! Form::close() !!}
    </div>
    @endif
</div>

