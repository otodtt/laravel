@extends('layouts.quality')
@section('title')
    {{ 'Констативен протокол' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
    {!!Html::style("css/qcertificates/show_opinion.css" )!!}
    {!!Html::style("css/qprotocols/body_protocol.css" )!!}

    {!!Html::style("css/qprotocols/print.css", array('media' => 'print'))!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
        <h4 class="bold layout-title">КОНСТАТИВЕН ПРОТОКОЛ</h4>
    </div>
    <hr id="hide1" />
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        {{--<span class="fa  btn btn-default my_btn"><i class="fa fa-file-powerpoint-o " aria-hidden="true"></i>  Констативни протоколи</span>--}}
        <a href="{!! URL::to('/контрол/протоколи')!!}" class="fa fa-check-square btn btn-info my_btn"> Констативни протоколи</a>
        <a href="{!! URL::to('/контрол/формуляри')!!}" class="fa fa-check-square btn btn-info my_btn"> Формуляри за съответствие</a>
    </div>
    <div class="btn_add_firm">
        <a href="{!!URL::to('/контрол/протоколи/търси-търговец')!!}" class="fa fa-arrow-circle-right btn btn-default my_btn">
            Добави НОВ Протокол</a>
        <a href="{!!URL::to('/контрол/протоколи/нерегламентиран')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn">
            Добави Протокол на нерегламентиран</a>
    </div>
    <hr id="hide2"/>
    <div class="btn_add_edit">
        @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
            <a href="{!!URL::to('/контрол/протоколи/фермер/edit/'.$protocol->id)!!}" class="fa fa-edit btn btn-danger my_btn">Редактирай Протокола</a>
        @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
            <a href="{!!URL::to('/контрол/протоколи/търговец/edit/'.$protocol->id)!!}" class="fa fa-edit btn btn-danger my_btn">Редактирай Протокола</a>
        @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0 && $protocol->unregulated_id > 0)
            <a href="{!!URL::to('/контрол/протоколи/нерегламентиран/edit/'.$protocol->id)!!}" class="fa fa-edit btn btn-danger my_btn">Редактирай Протокола</a>
        @endif

    </div>

    <div class="info-wrap" style="margin-top: 30px">
        <h4 class="bold title_doc" style="text-align: center; margin: 0 0 20px 0">
            КОНСТАТИВЕН ПРОТОКОЛ <br>
            № {{$protocol->number_protocol }} / {{date('d.m.Y', $protocol->date_protocol) }}
        </h4>

        <hr class="my_hr"/>
        <fieldset class="big_field ">
            <div class="row-height-my col-md-12" style="display: table">
                <div style="display: table-row">
                    <div class="small_field_right top_info" style="display: table-cell" >
                        @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
                            <span class="span-firm green_info"><i class="fa fa-user "></i> ДАННИ НА ЗЕМЕДЕЛСКИ СТОПАНИН</span>
                        @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
                            <span class="firm_info"><i class="fa fa-user "></i> ДАННИ НА ТЪРГОВЕЦ</span>
                        @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0 && $protocol->unregulated_id > 0)
                            <span class="span-firm-danger red"><i class="fa fa-user "></i> ДАННИ НА НЕРЕГЛАМЕНТИРАН ТЪРГОВЕЦ</span>
                        @endif
                    </div>
                    <div class="small_field_right top_info" style="display: table-cell" >
                        <span class="span-phar-info"><i class="fa fa-leaf "></i> ДАННИ НА СТОКИТЕ</span>
                    </div>
                </div>
                <div style="display: table-row">
                    <div class="small_field_left " style="display: table-cell">
                        @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
                            <a href="{!!URL::to('/стопанин/'.$protocol->farmer_id)!!}" class="fa fa-arrow-circle-right btn btn-success my_btn">
                                Към Земеделския Стопанин</a>
                        @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
                            <a href="{!!URL::to('/контрол/търговци/'.$protocol->trader_id.'/show')!!}" class="fa fa-arrow-circle-right btn btn-success my_btn">
                                Към Фирмата Търговец</a>
                        @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0 && $protocol->unregulated_id > 0)
                        @endif

                        <hr class="my_hr_in"/>
                        <p >Фирма/ЗС:
                            @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->farmer_name }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->trader_name }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0 && $protocol->unregulated_id > 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->unregulated_name }}</span>
                            @endif
                        </p>
                        <hr class="my_hr_in"/>
                        <p >Адрес:
                            @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
                                <span class="bold" >{{$protocol->farmer_address}}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
                                <span class="bold">{{$protocol->trader_address }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0 && $protocol->unregulated_id > 0)
                                <span class="bold" >{{$protocol->unregulated_address }}</span>
                            @endif
                            {{--<span class="bold">{{$certificate->importer_address }}</span>--}}
                        </p>
                        <hr class="my_hr_in"/>
                        <p >ЕИК/ЕГН:
                            @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->farmer_vin }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->trader_vin }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0 && $protocol->unregulated_id > 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->unregulated_vin }}</span>
                            @endif
                            {{--<span class="bold">{{$certificate->importer_vin }}</span> --}}
                        </p>
                        <hr class="my_hr_in"/>
                        <p >Телефон:
                            @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->farmer_phone }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->trader_phone }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0 && $protocol->unregulated_id > 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->unregulated_phone }}</span>
                            @endif
                        </p>
                        <hr class="my_hr_in"/>
                        <p >Представител:<span class="bold" style="text-transform: uppercase">{{$protocol->name_trader }}</span></p>
                    </div>
                    <div class="small_field_right" style="display: table-cell">
                        <?php
                        if($protocol->type_package == 1 ) {
                            $pack = 'Каси/ Pl. cases';
                        }
                        elseif ($protocol->type_package == 2) {
                            $pack = 'Палети/ Cages';
                        }
                        elseif ($protocol->type_package == 3) {
                            $pack = 'Кашони/ C. boxes';
                        }
                        elseif ($protocol->type_package == 4) {
                            $pack = 'Торби/ Bags';
                        }
                        elseif ($protocol->type_package == 999) {
                            $pack = $protocol->different ;
                        }
                        else {
                            $pack = '';
                        }
                        // \\\\
                        if($protocol->quality_class == 1) {
                            $class = 'I клас/I class';
                        }
                        elseif ($protocol->quality_class == 2) {
                            $class = 'II клас/II class';
                        }
                        elseif ($protocol->quality_class == 3) {
                            $class = 'OПС/GPS';
                        }
                        else {
                            $class = '';
                        }
                        // \\\\
                        if($protocol->quality_naw == 1) {
                            $class_now = 'I клас/I class';
                        }
                        elseif ($protocol->quality_naw == 2) {
                            $class_now = 'II клас/II class';
                        }
                        elseif ($protocol->quality_naw == 3) {
                            $class_now = 'OПС/GPS';
                        }
                        else {
                            $class_now = '';
                        }
                        ?>
                        <p style="font-size: 13px" >
                           Стока: <span class="bold" style="display: inline-block; ">{{$protocol->crops_name }}</span>
                        </p>
                        <hr class="my_hr_in"/>
                        <p style="font-size: 13px">
                            Произход: <span  class="bold" style="display: inline-block; ">{{$protocol->origin }}</span>
                        </p>
                        <hr class="my_hr_in"/>
                        <p style="font-size: 13px">
                            Означен клас на качество: <span  class="bold" style="display: inline-block; ">{{ $class }}</span>
                        </p>
                        <hr class="my_hr_in"/>
                        <p style="font-size: 13px">
                            Клас на качество в момента: <span  class="bold" style="display: inline-block; ">{{$class_now}}</span>
                        </p>
                        <hr class="my_hr_in"/>
                        <p style="font-size: 13px">
                            Брой и вид на опаковките:
                            <span  class="bold" style="display: inline-block; ">
                                {{$protocol->number }} - {{$pack}}
                            </span>
                        </p>
                        <hr class="my_hr_in"/>
                        <p style="font-size: 13px">
                            Други белези: <span  class="bold" style="display: inline-block; ">{{$protocol->variety}}</span>
                        </p>
                        <hr class="my_hr_in"/>
                        <p style="font-size: 13px">
                            Придружаващи документи: <span  class="bold" style="display: inline-block; ">{{$protocol->documents}}</span>
                        </p>
                        <hr class="my_hr_in"/>
                    </div>
                </div>
            </div>
            <hr class="my_hr_in"/>

            <div class="col-md-12 row-table-bottom " style="display: table">
                <div style="display: table-row">
                    <div class="small_field_bottom top_info" style="display: table-cell" >
                        <span class=""><i class="fa fa-database "></i> ДРУГИ ДАННИ</span>
                    </div>
                </div>
                <div class="small_field_bottom" style="display: table-cell">
                    <div class="col-md-6">
                        <p >Контролен орган: <span class="bold" style="text-transform: none">{{$index[0]['authority_bg'] }}</span></p>
                        <hr class="my_hr_in"/>
                        <p >Място на издаване: <span class="bold">гр./с. {{$protocol->place }}</span></p>
                        <hr class="my_hr_in"/>
                    </div>
                    <div class="col-md-6">
                        <p >Инспектор: <span class="bold" style="text-transform: uppercase">{{$protocol->inspector_name }}</span></p>
                        <hr class="my_hr_in"/>
                        <p >Дата на издаване: <span class="bold" style="text-transform: none">{{ date( 'd.m.Y', $protocol->date_protocol) }}</span></p>
                        <hr class="my_hr_in"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 row-table-bottom " style="display: table">
                <div class="small_field_bottom" style="display: table-cell">
                    <div class="col-md-12">
                        <p >Действия на търговеца в определен от него срок съгласно предписанията на инспектора:</p>
                        <hr class="my_hr_in"/>
                        <p ><span class="bold">{{$protocol->actions }}</span></p>
                    </div>
                </div>
            </div>

        </fieldset>
    </div>

    <div id="wrap_in" class="col-md-12 ">
        <div class="page" >
            <div class="col-md-12_my" id="flip_all">
                <div class="col-md-12_my" id="flip_in">
                    <div class="col-md-12_my" style="margin: 0 auto; padding: 0">
                        <p >Контролен орган: <span class="bold" style="text-transform: none">{{$index[0]['authority_bg'] }}</span></p>
                        <p >
                            Получател:
                            @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->farmer_name }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->trader_name }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0 && $protocol->unregulated_id > 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->unregulated_name }}</span>
                            @endif
                            с Адрес:
                            @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
                                <span class="bold" >{{$protocol->farmer_address}}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
                                <span class="bold">{{$protocol->trader_address }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0 && $protocol->unregulated_id > 0)
                                <span class="bold" >{{$protocol->unregulated_address }}</span>
                            @endif
                            ; ЕИК/ЕГН:
                            @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->farmer_vin }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->trader_vin }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0 && $protocol->unregulated_id > 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->unregulated_vin }}</span>
                            @endif
                            ; Телефон:
                            @if($protocol->farmer_id > 0 && $protocol->trader_id == 0 && $protocol->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->farmer_phone }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id > 0 && $protocol->unregulated_id == 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->trader_phone }}</span>
                            @elseif($protocol->farmer_id == 0 && $protocol->trader_id == 0 && $protocol->unregulated_id > 0)
                                <span class="bold" style="text-transform: uppercase">{{$protocol->unregulated_phone }}</span>
                            @endif
                        </p>
                        <div class="row" style="margin: 30px 0 20px 0">
                            <h5 class="bold title_doc_show" style="text-align: center; margin: 0">
                                КОНСТАТИВЕН ПРОТОКОЛ № {{$protocol->number_protocol }}
                            </h5>
                            <p>
                                Протоколът се издава на основание чл. 21, ал. 2 от Наредба ................... за изискванията
                                за качаство и контрола за съответствие на пресни плодове и зеленчуци(ДВ, бр. ..........)
                            </p>
                        </div>
                    </div>
                    <div class="row" style="margin: 30px 0 20px 0">
                        <div class="col-md-6">
                            <ol style="padding: 0">
                                <li>Вид на стоката <span class="bold" style="display: inline-block; float: right">{{$protocol->crops_name }}</span></li>
                                <li>Страна на произход<span class="bold" style="display: inline-block; float: right">{{$protocol->origin }}</span></li>
                                <li>Клас на качество <span class="bold" style="display: inline-block; float: right">{{ $class }}</span> </li>
                                <li>Клас на качество в <br> момента на контрола <span class="bold" style="display: inline-block; float: right ">{{$class_now}}</span></li>
                                <li>Тегло бруто/нето(кг)<span class="bold" style="display: inline-block; float: right">{{$protocol->tara }}</span></li>
                                <li>Брой и вид на опаковките<span class="bold" style="display: inline-block; float: right">{{$protocol->number }} - {{$pack}}</span></li>
                            </ol>
                        </div>
                        <div class="col-md-6" style="padding: 0">
                            <p >
                                Други белези идентификационни белези (сорт, пазмер, тегло)
                            </p>
                            @if(strlen($protocol->variety) == 0)
                                <p>
                                    .........................................................<br>
                                    .........................................................
                                </p>
                            @else
                                <p><span  class="bold" style="display: inline-block; ">{{$protocol->variety}}</span></p>
                            @endif
                            {{--<p><span  class="bold" style="display: inline-block; ">{{$protocol->variety}}</span></p>--}}
                            <p >
                                Придружаващи стоката документи
                            </p>
                            @if(strlen($protocol->documents) == 0)
                                <p>
                                    .........................................................<br>
                                    .........................................................
                                </p>
                            @else
                                <p><span  class="bold" style="display: inline-block; ">{{$protocol->documents}}</span></p>
                            @endif
                        </div>
                    </div>

                    <div class="row" style="margin: 30px 0 20px 0">
                        <div class="col-md-12" style="padding: 0">
                            <p>
                                При проведения контрол за съответствие бе установено, че взетата от партидата проба
                                показва следните отклонения от изискванията за качество:
                            </p>
                            <table id="quality">
                                <tbody>
                                    <tr>
                                        <td class="number">01</td>
                                        <td class="desc">
                                            Маркировка:
                                            @if($protocol->marking != 0)
                                                <span class="percent">{{$protocol->marking}} %</span>
                                            @else
                                                <span class="percent_not">.... %</span>
                                            @endif
                                        </td>
                                        <td class="number">05</td>
                                        <td class="desc">
                                            Чистота:
                                            @if($protocol->cleanliness != 0)
                                                <span class="percent">{{$protocol->cleanliness}} %</span>
                                            @else
                                                <span class="percent_not">.... %</span>
                                            @endif
                                        </td>
                                        <td class="number">08</td>
                                        <td class="desc">
                                            Оцветяване:
                                            @if($protocol->coloring != 0)
                                                <span class="percent">{{$protocol->coloring}} %</span>
                                            @else
                                                <span class="percent_not">.... %</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="number">02</td>
                                        <td class="desc">
                                            Размери:
                                            @if($protocol->dimensions != 0)
                                                <span class="percent">{{$protocol->dimensions}} %</span>
                                            @else
                                                <span class="percent_not">.... %</span>
                                            @endif
                                        </td>
                                        <td class="number">06</td>
                                        <td class="desc">
                                            Външен вид:
                                            @if($protocol->appearance != 0)
                                                <span class="percent">{{$protocol->appearance}} %</span>
                                            @else
                                                <span class="percent_not">.... %</span>
                                            @endif
                                        </td>
                                        <td class="number">09</td>
                                        <td class="desc">
                                            Зрялост:
                                            @if($protocol->maturity != 0)
                                                <span class="percent">{{$protocol->maturity}} %</span>
                                            @else
                                                <span class="percent_not">.... %</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="number">03</td>
                                        <td class="desc">
                                            Петна и повреди:
                                            @if($protocol->damage != 0)
                                                <span class="percent">{{$protocol->damage}} %</span>
                                            @else
                                                <span class="percent_not">.... %</span>
                                            @endif
                                        </td>
                                        <td class="number">07</td>
                                        <td class="desc">
                                            Форма:
                                            @if($protocol->shape != 0)
                                                <span class="percent">{{$protocol->shape}} %</span>
                                            @else
                                                <span class="percent_not">.... %</span>
                                            @endif
                                        </td>
                                        <td class="number">10</td>
                                        <td class="desc">
                                            Физиологични <br>дефекти:
                                            @if($protocol->defects != 0)
                                                <span class="percent">{{$protocol->defects}} %</span>
                                            @else
                                                <span class="percent_not">.... %</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="number">04</td>
                                        <td class="desc" colspan="5">
                                            Повреди от болести и загнивания
                                            @if($protocol->defects != 0)
                                                <span class="percent_last">{{$protocol->diseases}} %</span>
                                            @else
                                                <span class="percent_not_last">.... %</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row" style="margin: 30px 0 20px 0">
                        <div class="col-md-12" style="padding: 0">
                            <p>
                                Поради това партидата не съответства на изискванията за качество на ......................................
                                ................................. и е негодна за:
                            </p>
                            <table id="quality">
                                <tbody>
                                <tr>
                                    <td class="number">1</td>
                                    <td class="desc_second">
                                        @if($protocol->matches == 1)
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            <span class="underline bold">Внос</span>
                                        @else
                                            <i class="fa fa-circle-o" aria-hidden="true"></i>
                                            <span class="underline_not">Внос</span>
                                        @endif
                                    </td>
                                    <td class="number">2</td>
                                    <td class="desc_second">
                                        @if($protocol->matches == 2)
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            <span class="underline bold">Износ</span>
                                        @else
                                            <i class="fa fa-circle-o" aria-hidden="true"></i>
                                            <span class="underline_not">Износ</span>
                                        @endif
                                    </td>
                                    <td class="number">3</td>
                                    <td class="desc_second">
                                        @if($protocol->matches == 3)
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            <span class="underline bold">продажба на едро</span>
                                        @else
                                            <i class="fa fa-circle-o" aria-hidden="true"></i>
                                            <span class="underline_not">продажба на едро </span>
                                        @endif
                                    </td>
                                    <td class="number">3</td>
                                    <td class="desc_second">
                                        @if($protocol->matches == 4)
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            <span class="underline bold">продажба на дребно</span>
                                        @else
                                            <i class="fa fa-circle-o" aria-hidden="true"></i>
                                            <span class="underline_not">продажба на дребно </span>
                                        @endif
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row" style="margin: 30px 0 20px 0">
                        <div class="col-md-12" style="padding: 0">
                            <p>Предписания на инспектора за:</p>
                            <table id="quality">
                                <tbody>
                                    <tr>
                                        <td class="number">01</td>
                                        <td class="desc">
                                            Окачествяване и маркиране
                                            @if($protocol->mark != 0)
                                                <span class="percent">ДА</span>
                                            @else
                                                <span class="percent_not">....</span>
                                            @endif
                                        </td>
                                        <td class="number">04</td>
                                        <td class="desc">
                                            Препакетиране
                                            @if($protocol->repackaging != 0)
                                                <span class="percent">ДА</span>
                                            @else
                                                <span class="percent_not">....</span>
                                            @endif
                                        </td>
                                        <td class="number">06</td>
                                        <td class="desc">
                                            Преработка
                                            @if($protocol->processing != 0)
                                                <span class="percent">ДА</span>
                                            @else
                                                <span class="percent_not">....</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="number">02</td>
                                        <td class="desc">
                                            Маркиране в по-долен клас
                                            @if($protocol->low != 0)
                                                <span class="percent">ДА</span>
                                            @else
                                                <span class="percent_not">....</span>
                                            @endif
                                        </td>
                                        <td class="number">05</td>
                                        <td class="desc">
                                            Преетикетиране
                                            @if($protocol->relabeling != 0)
                                                <span class="percent">ДА</span>
                                            @else
                                                <span class="percent_not">....</span>
                                            @endif
                                        </td>
                                        <td class="number">07</td>
                                        <td class="desc">
                                            Фураж
                                            @if($protocol->fodder != 0)
                                                <span class="percent">ДА</span>
                                            @else
                                                <span class="percent_not">....</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="number">03</td>
                                        <td class="desc">
                                            Пресортиране
                                            @if($protocol->resort != 0)
                                                <span class="percent">ДА</span>
                                            @else
                                                <span class="percent_not">....</span>
                                            @endif
                                        </td>
                                        <td class="number"></td>
                                        <td class="desc"></td>
                                        <td class="number">08</td>
                                        <td class="desc">
                                            Унищожаване
                                            @if($protocol->destruction != 0)
                                                <span class="percent">ДА</span>
                                            @else
                                                <span class="percent_not">....</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row" style="margin: 30px 0 20px 0">
                        <div class="col-md-12" style="padding: 0">
                            <p>Действия на търговеца в определен от него срок съгласно предписанията на инспектора:</p>
                            <p ><span class="bold">{{$protocol->actions }}</span></p>
                        </div>
                    </div>

                    <div class="row" style="margin: 30px 0 20px 0">
                        <div class="col-md-12" style="padding: 0">
                            <p>Трите имена на търговеца или на негов представител <span class="bold">{{ $protocol->name_trader }}</span> <span class="right">Подпис</span></p>
                        </div>
                    </div>
                    <div class="row" style="margin: 30px 0 20px 0">
                        {{--<p >Място и дата на издаване<span style="margin-left:90px">Инспектор</span>--}}
                            {{--<span style="float: right">--}}
                                {{--Подпис--}}
                                    {{--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
                                {{--Печат--}}
                            {{--</span>--}}
                        {{--</p>--}}
                        {{--<p >--}}
                            {{--<span class="bold">гр./с {{ $protocol->place }} / {{ date('d.m.Y', $protocol->date_protocol) }}</span>--}}
                            {{--<span id="position" class="bold" style="margin-left: 80px">{{ $protocol->inspector_name }}</span>--}}
                        {{--</p>--}}

                        <div class="col-lg" id="col5" style="padding: 0; width: 41.66666667%; display: inline-block">
                            <p >Място и дата на издаване</p>
                            <p ><span class="bold">гр./с {{ $protocol->place }} / {{ date('d.m.Y', $protocol->date_protocol) }}</span></p>
                        </div>
                        <div class="col-lg" id="col4" style="padding: 0; width: 33.33333333%; display: inline-block">
                            <p >Инспектор</p>
                            <p ><span class="bold">{{ $protocol->inspector_name }}</span></p>
                        </div>
                        <div class="col-lg" id="col3" style="padding: 0; display: inline-block">
                            <p >Подпис <span class="stamp">Печат</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    {{--{!!Html::script("js/table/jquery-1.11.3.min.js" )!!}--}}
    {{--{!!Html::script("js/table/jquery.dataTables.js" )!!}--}}
    {{--{!!Html::script("js/quality/QcertificatesTable.js" )!!}--}}

{{--    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}--}}
{{--    {!!Html::script("js/date/in_date.js" )!!}--}}
@endsection
