<div class="content">
    <?php
    if ($report->firm == 1) {
        $et = 'ET';
        $ood = '';
    } elseif ($report->firm == 2) {
        $et = '';
        $ood = 'ООД';
    } elseif ($report->firm == 3) {
        $et = '';
        $ood = 'ЕООД';
    } elseif ($report->firm == 4) {
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
        if($show->district_id == $object->district_object){
            $district_object = $show->name;
        }
    }
    if($report->ot == 1){
        $type_object = 'ССА';
    }
    if($report->ot == 2){
        $type_object = 'СКЛАД';
    }
    if($report->ot == 3){
        $type_object = 'ЦЕХ';
    }

    if($object->type_location == 1){
        $city_village = 'гр. ';
    }
    elseif($object->type_location == 2){
        $city_village = 'с. ';
    }
    else{
        $city_village = 'гр./с. ';
    }
    ?>
        <br>
        <table class="second_table" id="second_table">
            <thead>
                <tr>
                    <td colspan="2" rowspan="2" class="my_top"><img class="img_logo" src="../img/logo_2.png">Доклад № {!! $report->number !!}</td>
                    <td colspan="3" rowspan="2" class="my_top">Проверка на селскостопанска аптека</td>
                    <td class="my_top">Код: ПРЗТК-ССА</td>
                </tr>
                <tr>
                    <td class="my_top">Верия: 02</td>
                </tr>
                <tr>
                    <td class="my_middle top_position">
                        <p class="bold">БАБХ</p>
                        <p class="bold">ОДБХ</p>
                        <p class="bold">Адрес</p>
                        <br>
                        <p class="bold">Тел:</p>
                        <p class="bold">E-mail</p>
                    </td>
                    <td class="second_column my_middle top_position">
                        <br>
                        <p><span class="bold">{!! $city->odbh_city !!}</span></p>
                        <p><span class="bold">{!! $city->address !!}</span></p>
                        <br>
                        <p><span class="bold">{!! $city->phone !!}</span></p>
                        <p><span class="bold">{!! $city->mail !!}</span></p>
                    </td>
                    <td colspan="3" class="third_column top_position my_middle">
                        <p>Наименование на фирмата:</p>
                        <p><span class="bold">{!! $et !!} "{!! $report->name !!}" {!! $ood !!}</span></p>
                        <br>
                        <p>Адрес:</p>
                        <?php
                            if($firm->type_location == 1) {
                                $tvm = 'гр. ';
                            }
                            elseif($firm->type_location == 2) {
                                $tvm = 'c. ';
                            }
                            else {
                                $tvm = '';
                            }
                        ?>
                        <p><span class="bold"> {!! $firm->address !!}, {{$tvm}}{!! $firm->location !!}, общ. {!! $district_firm !!}, обл. {!! $area_firm !!}</span></p>
                    </td>
                    <td class="fourth_column my_middle">
                        <p>Име на инспектора: <span class="bold">{!! $report->inspector_name !!}</span></p>
                        <p>Длъжност: <span class="bold">{!! $report->position_short !!}</span></p>
                        <p>Място на инспекцията:<br>
                            <span class="bold">{!! $object->address !!}, {!! $city_village.''.$object->location.', общ. '.$district_object !!}</span>
                        </p>
                        <p>Дата: <span class="bold">{!! date('d.m.Y', $report->date_report) !!} год.</span></p>
                        <p>Начален час:........ Краен час:........ </p>
                        <p>Присъстваки лица:  <span class="bold">{!! $report->position_short_two !!} {!! $report->inspector_two_name !!}</span></p>
                        @if(strlen($report->inspector_three_name) != 0 && strlen($report->position_short_three)!= 0)
                            <p>Присъстваки лица:  <span class="bold">{!! $report->position_short_three !!} {!! $report->inspector_three_name !!}</span></p>
                        @endif
                        @if(strlen($report->inspector_another) != 0 && strlen($report->inspector_from)!= 0)
                            <p>Присъстваки лица:  <span class="bold">{!! $report->inspector_another !!} - {!! $report->inspector_from !!} </span></p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" class="first_column my_bottom">Контролна<br> точка</td>
                    <td rowspan="2" class="second_column my_bottom">Елементи за проверка</td>
                    <td colspan="2" class="five_columns my_bottom">Констатация</td>
                    <td rowspan="2" class="six_columns my_bottom">Непроверено</td>
                    <td rowspan="2" class="fourth_column my_bottom">Забележка</td>
                </tr>
                <tr>
                    <td class="bold" style="text-align: center">Съответствие</td>
                    <td  class="bold"  style="text-align: center">Несъответствие</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="4">Обща част</td>
                    <td>1. Удостоверение за дейността</td>
                    <td>
                        @if($report->activity == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->activity == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->activity == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->activity_note}}</td>
                </tr>
                <tr>
                    {{--<td>A</td>--}}
                    <td>2. Сертификат по чл. 83 на лицето което осъществява продажбата</td>
                    <td>
                        @if($report->certificate == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->certificate == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->certificate == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->certificate_note}}</td>
                </tr>
                <tr>
                    {{--<td>A</td>--}}
                    <td>3. Дневник на доставките</td>
                    <td>
                        @if($report->delivery == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->delivery == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->delivery == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->delivery_note}}</td>
                </tr>
                <tr>
                    <td>4. Дневник на продажбите</td>
                    <td>
                        @if($report->sales == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->sales == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->sales == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->sales_note}}</td>
                </tr>
                {{--ТЪРГОВСКАТА ЧАСТ--}}
                <tr>
                    <td rowspan="11">ПРЗ в <br>търговската<br> част</td>
                    <td>5. Неразрешени ПРЗ</td>
                    <td>
                        @if($report->unauthorized == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->unauthorized == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->unauthorized == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->unauthorized_note}}</td>
                </tr>
                <tr>
                    <td>6. ПРЗ от първа професионална категория</td>
                    <td>
                        @if($report->first == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->first == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->first == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->first_note}}</td>
                </tr>
                <tr>
                    <td>7. Неправомерно преопаковани</td>
                    <td>
                        @if($report->improperly == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->improperly == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->improperly == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->improperly_note}}</td>
                </tr>
                <tr>
                    <td>8. Преопаковане на ПРЗ в аптеката</td>
                    <td>
                        @if($report->repackaged == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->repackaged == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->repackaged == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->repackaged_note}}</td>
                </tr>
                <tr>
                    <td>9. ПРЗ с изтекъл срок на годност</td>
                    <td>
                        @if($report->expired == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->expired == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->expired == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->expired_note}}</td>
                </tr>
                <tr>
                    <td>10. Съответствие на етикет</td>
                    <td>
                        @if($report->compliance == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->compliance == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->compliance == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->compliance_note}}</td>
                </tr>
                <tr>
                    <td>11. Листовка трайно закрепена за опаковката</td>
                    <td>
                        @if($report->leaflet == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->leaflet == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->leaflet == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->leaflet_note}}</td>
                </tr>
                <tr>
                    <td>12. ПРЗ в опаковка по-голяма от 1 л/кг</td>
                    <td>
                        @if($report->larger == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->larger == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->larger == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->larger_note}}</td>
                </tr>
                <tr>
                    <td>13. Подреждане по предназначение</td>
                    <td>
                        @if($report->purpose == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->purpose == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->purpose == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->purpose_note}}</td>
                </tr>
                <tr>
                    <td>14. Съхранение на ПРЗ</td>
                    <td>
                        @if($report->storage == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->storage == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->storage == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->storage_note}}</td>
                </tr>
                <tr>
                    <td>15. Складово помещение в ССА</td>
                    <td>
                        @if($report->warehouse == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->warehouse == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->warehouse == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->warehouse_note}}</td>
                </tr>
                {{--СКЛАДА--}}
                <tr>
                    <td rowspan="4">складовото помещение</td>
                    <td>15.1 да е отделено от търговската част на обекта и да е с вместимост до 5 тона ...</td>
                    <td>
                        @if($report->separated == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->separated == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->separated == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->separated_note}}</td>
                </tr>
                <tr>
                    <td>15.2 да е осигурен контролиран и ограничен досъп, както и защита от неоторизиран достъп</td>
                    <td>
                        @if($report->access == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->access == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->access == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->access_note}}</td>
                </tr>
                <tr>
                    <td>15.3 да има подови настилки, непропускливи за течности, химически устойчиви ...</td>
                    <td>
                        @if($report->flooring == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->flooring == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->flooring == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->flooring_note}}</td>
                </tr>
                <tr>
                    <td>15.4 стените, таваните и вратите да са изградени от негорими материали</td>
                    <td>
                        @if($report->combustible == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->combustible == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->combustible == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->combustible_note}}</td>
                </tr>
                {{--СКЛАДА--}}
                <tr>
                    <td></td>
                    <td>16. Договор за предаване на негодни ПРЗ</td>
                    <td>
                        @if($report->contract == 1)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->contract == 2)
                            <span>X</span>
                        @endif
                    </td>
                    <td>
                        @if($report->contract == 3)
                            <span>X</span>
                        @endif
                    </td>
                    <td>{{$report->contract_note}}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Вземане на проби:</td>
                    <td colspan="3" style="text-align: center; padding: 0; margin: 0">&#9675 Да &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &#9675 Не</td>
                    <td style="border-bottom: none">Подпис на</td>
                </tr>
                <tr>

                    <td colspan="2" rowspan="3">
                        <p>ПРЗ:
                            @foreach($analyses as $k=>$analyse)
                                @if($analyse['type_assay'] == 1)
                                    <span class="bold">{{$analyse['name']}}</span>&nbsp;&nbsp;&nbsp;
                                @endif
                            @endforeach
                        </p>
                        <br>
                        <p>Торове:
                            @foreach($analyses as $k=>$analyse)
                                @if($analyse['type_assay'] == 2)
                                    <span class="bold">{{$analyse['name']}}</span>
                                @endif
                            @endforeach
                        </p>

                        {{--<p>Торове: <span class="bold">{{$report->tor_name}}</span></p>--}}
                    </td>
                    <td colspan="3" rowspan="3" class="top_position">Цел на изпитването:</td>
                    <td style="border-top: none">инспекторите:</td>
                </tr>
                <tr>
                    <td>Дата на приключване на проверката:  <span class="bold">{!! date('d.m.Y', $report->date_report) !!} год.</span></td>
                </tr>
                <tr>
                    <td>Име и подпис на инспектираното лице:</td>
                </tr>
            </tfoot>
        </table>

        <br>

        <div class="col-md-12 my_div">
            <div class="col-md-6 my_div">
                @if($report->assay_prz == 1 || $report->assay_more == 1 )
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
                        <?php print_r(count($prz)) ?>
                    @else
                        <?php print_r(count($prz)) ?>
                        <span class="red bold"><span class="fa fa-warning bold"> ВНИМАНИЕ!</span> Маркирано е, че има взета проба от ПРЗ, но не е добавна в Базата Данни.<br>
                            Радактирай Протокола и маркирай, че няма взета пробали или добави взетата проба сега!
                        </span>
                    @endif
                @else
                    <p class="bold">Няма взети проби от ПРЗ.</p><hr/>
                @endif
            </div>
            <div class="col-md-6 my_div">
                @if($report->assay_tor == 1)
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
            {!! Form::open(['url'=>'report/assay-prz/add/'.$report->id , 'method'=>'POST', 'id'=>'form-prz']) !!}
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
        {!! Form::open(['url'=>'report/assay-tor/add/'.$report->id  , 'method'=>'POST', 'id'=>'form-tor']) !!}
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

        <br>
        @if($report->protocol != 0 && $report->is_protocol == 1)
            <div class="col-md-12"  style="margin-top: 50px">
            <h3 class="middle_h3 bold">КОНСТАТИВЕН ПРОТОКОЛ</h3>

            <h3 class="middle_h3 bold h4_bottom">№ {!! $report->number !!}</h3>
            <h4>Днес: <span class="bold">{!! date('d.m.Y', $report->date_report) !!} год.</span></h4>
            <br/>
            <h4 class="">подписаният:</h4>
            @foreach($inspectors as $inspector)
                @if($inspector->id == $report->inspector)
                    <p><span class="bold">{!! $inspector->all_name !!}</span><br/>
                        на длъжност <span class="bold">{!! $report->position !!}</span>
                        в ОДБХ {!! $city->city !!} сл. карта № <span class="bold">{!! $inspector->karta !!}</span>
                    </p>
                @endif
            @endforeach
            <br>
            <h4>с участието на:</h4>
            @if($report->inspector_two > 0)
                @foreach($inspectors as $inspector)
                    @if($inspector->id == $report->inspector_two)
                        <p>1. <span class="bold">{!! $inspector->all_name !!}</span><br/>
                            на длъжност <span class="bold">{!! $report->position_two !!}</span>
                            в ОДБХ {!! $city->city !!} сл. карта № <span class="bold">{!! $inspector->karta !!}</span>
                        </p>
                    @endif
                @endforeach
            @else
                <p>1.  ..............................</p>
            @endif

            @if($report->inspector_three > 0)
                @foreach($inspectors as $inspector)
                    @if($inspector->id == $report->inspector_three)
                        <p>2. <span class="bold">{!! $inspector->all_name !!}</span><br/>
                            на длъжност <span class="bold">{!! $report->position_three !!}</span>
                            в ОДБХ {!! $city->city !!} сл. карта № <span class="bold">{!! $inspector->karta !!}</span>
                        </p>
                    @endif
                @endforeach
            @else
                <p>2.  ..............................</p>
            @endif
            @if(strlen($report->inspector_another) > 0)
                <p>3. <span class="bold">{!! $report->inspector_another !!}</span>
                    от служба <span class="bold">{!! $report->inspector_from !!}</span>
                </p>
            @else
                <p>3.  ..............................</p>
            @endif
            <br/>
            <h4>Проверихме обекта на:</h4>

            <span class="bold">Подробни данни на Фирмата:
                <span >
                    <a href="{{ URL::to('/фирма/'.$firm->id) }}" class="fa fa-binoculars btn btn-info my_btn"> ВИЖ ТУК</a>
                </span>
            </span>
            <p>Физическо /Юридическо лице: <span class="bold">{!! $et !!} "{!! $report->name !!}" {!! $ood !!}</span></p>
            <p>ЕИК - <span class="bold">{!! $firm->bulstat !!}</span></p>
            <p>Адрес:<span class="bold"> {!! $firm->address !!}, общ. {!! $district_firm !!}, обл. {!! $area_firm !!}</span></p>
            <p>Представлявано от: <span class="bold"> {!! $firm->owner !!}</span> с ЕГН: <span class="bold"> {!! $firm->egn !!}</span></p>
            <br>
            <h4 style="display: inline-block">Проверен обект:</h4> <span class="bold">{!! $type_object !!} </span>
            <p>адрес: <span class="bold">{!! $report->address !!}, {!! $city_village.''.$report->place.', общ. '.$district_object !!}</span></p>

            <br/>
            <h4>При проверката установихме следните факти и обстоятелства:</h4>
            <p>Констатация: <span class="bold">{!! $report->ascertainment !!}</span></p>
            <p>Конфискувани: <span class="bold">{!! $report->taken !!}</span></p>
            <p>Нареждане: <span class="bold">{!! $report->order_protocol !!}</span></p>
            <br/>
            <h4>Други данни:</h4>
            @if($report->type_check == 1)
                <p>Проверката е: <span class="bold"> В ОБЕКТА</span></p><br/>
            @elseif($report->type_check == 2)
                <p>Проверката е: <span class="bold"> ДОКУМЕНТАЛНА</span></p><br/>
            @endif
        @endif
    </div>
</div>

