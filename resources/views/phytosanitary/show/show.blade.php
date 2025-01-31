@extends('layouts.phyto')
@section('title')
    {{ 'ОПЕРАТОР Информация' }}
@endsection

@section('css')
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/qcertificates/show_opinion.css" )!!}
    {!!Html::style("css/qcertificates/body_table.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="info-wrap">
        @if ($operator->type_firm == 0 && $operator->trader_id > 0 && $operator->farmer_id == 0)
            <a href="{!! URL::to('/контрол/търговци/'.$operator->trader_id.'/show')!!}" class="fa fa-user btn btn-success my_btn my_float"> Към Фирмата Търговец!</a>
        @else
            <a href="{!! URL::to('/стопанин/'.$operator->farmer_id)!!}" class="fa fa-user btn btn-success my_btn my_float"> Към Земеделеца!</a>
        @endif

        <a href="{!! URL::to('/фито/регистър-оператори')!!}" class="fa fa-certificate btn btn-info my_btn my_float" style="margin-left: 5px"> Към регистъра!</a>

            <h4 class="bold title_doc" >ДАННИ НА ОПЕРАТОРА</h4>

        <hr class="my_hr"/>
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error  }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <fieldset class="big_field" style="padding-bottom: 100px">
            <div class="row-height-my col-md-12" style="display: table">
                <div style="display: table-row">
                    <div class="small_field_right top_info" style="display: table-cell" >
                        <span class="span-firm-info"><i class="fa fa-user "></i> ДАННИ НА ТЪРГОВЕЦА ИЛИ ЗЕМЕДЕЛСКИЯ ПРОИЗВОДИТЕЛ</span>
                    </div>
                    <div class="small_field_center top_info" style="display: table-cell" >
                        <span class="span-firm-info"><i class="fa fa-paper-plane "></i> ДАННИ ЗА ЗАЯВЛЕНИЕТО И НА ЛИЦАТА ЗА КОНТАКТ</span>
                    </div>

                </div>
                <div style="display: table-row">
                    <div class="small_field_left " style="display: table-cell">
                        @if ($operator->farmer_id > 0 && $operator->trader_id == 0 )
                            <?php
                            if($operator->type_firm == 0) {
                                $front = '';
                                $after = '';
                                $for = '';
                                $vin = '';
                            }
                            elseif($operator->type_firm == 1) {
                                $front = '';
                                $after = '';
                                $for = 'ЗС:';
                                $vin = 'ЕГН:';
                            }
                            elseif($operator->type_firm == 2) {
                                $front = 'ЕТ';
                                $after = '';
                                $for = 'Фирма:';
                                $vin = 'ЕИК/Булстат:';
                            }
                            elseif($operator->type_firm == 3) {
                                $front = '';
                                $after = 'ООД';
                                $for = 'Фирма:';
                                $vin = 'ЕИК/Булстат:';
                            }
                            elseif($operator->type_firm == 4) {
                                $front = '';
                                $after = 'ЕООД';
                                $for = 'Фирма:';
                                $vin = 'ЕИК/Булстат:';
                            }
                            elseif($operator->type_firm == 5) {
                                $front = '';
                                $after = 'АД';
                                $for = 'Фирма:';
                                $vin = 'ЕИК/Булстат:';
                            }
                            elseif($operator->type_firm == 6) {
                                $front = '';
                                $after = '';
                                $for = '';
                                $vin = 'ЕИК/Булстат:';
                            }
                            else {
                                $front = '';
                                $after = '';
                                $for = '';
                                $vin = '';
                            }
                            ?>
                                <p >{{$for }} <span class="bold" style="text-transform: uppercase">{{$front}} {{$operator->name_operator }} {{$after}}</span></p>
                                {{--<p >{{$vin}} <span class="bold">{{$operator->trader_vin }}</span> </p>--}}
                                <hr class="my_hr_in"/>
                                <p >Адрес: <span class="bold">{{$operator->address }}</span></p>
                                <hr class="my_hr_in"/>
                                <p >ЕИК/Булстат: <span class="bold">{{$operator->pin }}</span> </p>
                                <hr class="my_hr_in"/>
                                <p >GSM: <span class="bold">{{$farmer['mobil'] }}</span> </p>
                        @else
                            <p >Търговец: <span class="bold" style="text-transform: uppercase">{{$trader->trader_name }} </span></p>
                            <p >ЕИК/Булстат: <span class="bold">{{$trader->trader_vin }}</span> </p>
                            <hr class="my_hr_in"/>
                            <p >Адрес: <span class="bold">{{$trader->trader_address }}</span></p>
                        @endif
                        <hr class="my_hr_in"/>
                    </div>
                    <div class="small_field_center" style="display: table-cell">
                        <p >НОМЕР И ДАТА НА ЗАЯВЛЕНИЕТО: <span class="bold" style="text-transform: none">{{$operator->number_petition }}/{{ date('d.m.Y', $operator->date_petition)  }}</span></p>
                        <hr class="my_hr_in"/>
                        <hr class="my_hr_in"/>
                        <p >Фирма/ЗС 1: <span class="bold" style="text-transform: none">{{$operator->contact }}</span></p>
                        <hr class="my_hr_in"/>
                        <p >Адрес: <span class="bold" style="text-transform: none">{{$operator->contact_city }}; {{$operator->contact_address }}</span></p>
                        <hr class="my_hr_in"/>
                        <p >Телефон за Контакти: <span class="bold" style="text-transform: none">{{$operator->contact_phone }}</span></p>
                        <hr class="my_hr_in"/>

                    </div>
                </div>
                <hr class="my_hr_in"/>

                <div class="col-md-12 row-table-bottom " style="display: table">
                    <div style="display: table-row">
                        <div class="small_field_bottom top_info" style="display: table-cell" >
                            <span class=""><i class="fa fa-database "></i> ДРУГИ ДАННИ</span>
                        </div>
                    </div>
                </div>

            </div>
        </fieldset>
    </div>

    <div id="wrap_in" class="col-md-12">
        <div class="page" style="height: auto">
            <div class="col-md-12_my" id="flip_all">
                <div class="col-md-12_my" id="flip_in">
                    <table id="first_table">
                        <tbody>
                            <tr id="first-row"  rowspan="2">
                                <td class="cell " style="height: 3.2cm; width: 20% !important;" rowspan="2">
                                    <p class=" bold" style="margin-bottom: 3px">Bх. № {{$operator->number_petition}}</p>
                                    <p class=" bold" style="margin-bottom: 3px">Дата: {{date('d.m.Y', $operator->date_petition) }}</p>
                                    <?php
                                    if($farmer->type_firm == 0) {
                                        $front = '';
                                        $after = '';
                                        $vin = '';
                                    }
                                    elseif($farmer->type_firm == 1) {
                                        $front = 'ЗС:';
                                        $after = '';
                                        $vin = 'ЕГН:';
                                    }
                                    elseif($farmer->type_firm == 2) {
                                        $front = 'ЕТ';
                                        $after = '';
                                        $vin = 'BG:';
                                    }
                                    elseif($farmer->type_firm == 3) {
                                        $front = '';
                                        $after = 'ООД';
                                        $vin = 'BG:';
                                    }
                                    elseif($farmer->type_firm == 4) {
                                        $front = '';
                                        $after = 'ЕООД';
                                        $vin = 'BG:';
                                    }
                                    elseif($farmer->type_firm == 5) {
                                        $front = '';
                                        $after = 'АД';
                                        $vin = 'BG:';
                                    }
                                    elseif($farmer->type_firm == 6) {
                                        $front = '';
                                        $after = '';
                                        $vin = 'BG:';
                                    }
                                    else {
                                        $front = '';
                                        $after = '';
                                        $vin = '';
                                    }
                                    //if($type_firm == 0) {
                                      //  $vin = 'BG:';
                                    //}
                                    ?>
                                    {{--<p class="p_content" style="margin-bottom: 8px">{{$front}} {{$operator->trader_name }} {{$after}}</p>--}}

                                    {{--<p class="p_content" style="">{{$operator->trader_address }} / {{$vin}} {{ $operator->trader_vin }}</p>--}}
                                </td>
                                <td class="cell first-row-cell cell-top" style="height: 2.2cm; background-color: #d6d6d5 ">
                                    <p class="p_info line" style="margin-bottom: 20px;  text-align: center; font-size: 20px">ЗАЯВЛЕНИЕ</p>
                                    <p class="p_info line" style="margin-bottom: 3px;  text-align: center; font-size: 20px">
                                        за регистрация в Официален регистър на професионалните оператори
                                    </p>
                                </td>
                            </tr>
                             <tr>
                                 <td style="text-align: center">
                                     <p>ДО ДИРЕКТОРА НА ОБЛАСТНА ДИРЕКЦИЯ ПО БЕЗОПАСНОСТ НА ХРАНИТЕ</p>
                                     <p>Гр. {{ $index[0]['odbh_city'] }}</p>
                                 </td>
                             </tr>


                        </tbody>
                    </table>

                    <table style="width: 100%">
                        <tbody>
                            <tr><td colspan="2" style="height: 10px; background-color: #d6d6d5"></td></tr>
                            <tr>
                                <td style="height: 50px">
                                    <i class="fa fa-check-square-o" aria-hidden="true" style="font-size: 30px; margin-left: 10px"></i>
                                    Вписване в регистър
                                </td>
                                <td>
                                    <i class="fa fa-square-o" aria-hidden="true" style="font-size: 30px; margin-left: 10px"></i>
                                    Актуализация на данни
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"  style="height: 50px">
                                    <i class="fa fa-square-o" aria-hidden="true" style="font-size: 30px; margin-left: 10px"></i>
                                    Декларация за липса на промяна във вписаните в регистъра обстоятелства и данни от
                                    предходната година
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Таблица 2 --}}
                    <table id="second_table" style="width: 100%">
                        <tbody>
                            <tr>
                                <td colspan="2" style="vertical-align: middle; height: 35px; background-color:  #d6d6d5">
                                    <p class="bold" style="vertical-align: middle">I. Данни за юридическото или физическо лице:</p>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">
                                    Наименование /Име и фамилия:
                                    <p class="bold">{{$operator->name_operator}}</p>
                                </td>
                                <td>ЕИК / ПИК: <span class="bold">{{$operator->pin}}</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <p>
                                        Земеделски производител №
                                        @if($operator->farmer_id > 0 && $operator->trader_id == 0)
                                            <span class="bold">ДА ЗС</span>
                                        @elseif($operator->farmer_id == 0 && $operator->trader_id > 0)
                                            <span class="bold">Търговец</span>
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            <tr >
                                <td class="cell third-row-cell" style="height: 20px" colspan="2">
                                    <p class="" style="margin-bottom: 3px">
                                        <span style="" class="">Адрес:</span>
                                        <span style="" class="bold">{{$operator->address}}</span>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>Град/село: {{$operator->city}}</td>
                                <td>Пощенски код:</td>
                            </tr>
                            <tr>
                                <td>Община: {{$operator->municipality}}</td>
                                <td>Област:  {{$operator->area}}</td>
                            </tr>
                            <tr>
                                <td>
                                    Тел./факс:
                                    @if($operator->farmer_id > 0 && $operator->trader_id == 0)
                                        <span class="bold">{{$farmer->mobil}}</span>
                                    @elseif($operator->farmer_id == 0 && $operator->trader_id > 0)
                                        <span class="bold"></span>
                                    @endif
                                </td>
                                <td><p>Имейл адрес:</p></td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Таблица 3 --}}
                    <table id="third_table" style="width: 100%">
                        <tbody>
                            <tr >
                                <td colspan="2" style="vertical-align: middle; height: 35px; background-color:  #d6d6d5">
                                    <p class="bold" style="vertical-align: middle">II. Данни за местата на провеждане на дейността (описание на обектите, вкл. адрес)</p>
                                </td>
                            </tr>
                            <tr style=" ">
                                <td class="" style="width: 15%" >
                                    <p class="" style="">№</p>
                                </td>
                                <td class="" style="width: auto"></td>
                            </tr>
                            <tr>
                                <td class="" style="width: 15%" >
                                    <p class="" style="">1.</p>
                                </td>
                                <td class="" style="width: auto">{{$operator->description_objects_one}}</td>
                            </tr>
                            <tr>
                                <td class="" style="width: 15%" >
                                    <p class="" style="">2.</p>
                                </td>
                                <td class="" style="width: auto">{{$operator->description_objects_two}}</td>
                            </tr>
                            <tr >
                                <td colspan="2" style="vertical-align: middle; height: 35px; background-color:  #d6d6d5">
                                    <p class="bold" style="vertical-align: middle">IIА. Данни за местата на провеждане на дейност на територията на друга ОДБХ / друга държава членка (описание на обектите, данни за контакт, вкл. адрес)</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="" style="width: 15%" >
                                    <p class="" style="">3.</p>
                                </td>
                                <td class="" style="width: auto">{{$operator->description_places_one}}</td>
                            </tr>
                            <tr>
                                <td class="" style="width: 15%" >
                                    <p class="" style="">4.</p>
                                </td>
                                <td class="" style="width: auto">{{$operator->description_places_two}}</td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Таблица 4 --}}
                    <table id="fourth_table" style="width: 100%">
                        <tbody>
                            {{--<tr >--}}
                            <tr >
                                <td colspan="4" style="vertical-align: middle; height: 35px; background-color:  #d6d6d5">
                                    <p class="bold" style="vertical-align: middle">III. Вид на дейността</p>
                                </td>
                            </tr>
                            <tr style=" ">
                                <td class="" style="width: 25%; padding: 5px" >
                                    @if($operator->production == 0)
                                        <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                    @else
                                        <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                    @endif
                                        1. производство
                                </td>
                                <td class="" style="width: 25%; padding: 5px">
                                    @if($operator->processing == 0)
                                        <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                    @else
                                        <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                    @endif
                                        2. преработка
                                </td>
                                <td class="" style="width: 25%; padding: 5px">
                                    @if($operator->import == 0)
                                        <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                    @else
                                        <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                    @endif
                                        3. внос
                                </td>
                                <td class="" style="width: auto; padding: 5px">
                                    @if($operator->export == 0)
                                        <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                    @else
                                        <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                    @endif
                                        4. износ
                                </td>
                            </tr>
                            <tr style=" ">
                                <td class="" style="width: 25%; padding: 5px" >
                                    @if($operator->trade == 0)
                                        <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                    @else
                                        <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                    @endif
                                        5. търговия
                                </td>
                                <td class="" style="width: 25%; padding: 5px">
                                    @if($operator->storage == 0)
                                        <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                    @else
                                        <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                    @endif
                                        6. складиране
                                </td>
                                <td class="" style="width: 25%; padding: 5px" colspan="2">
                                    @if($operator->treatment == 0)
                                        <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                    @else
                                        <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                    @endif
                                        7. третиране, маркиране и поправка на дървен опаковъчен материал,  дървесина и други обекти
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                    8. други (изброяват се)
                                    {{$operator->others}}
                                </td>
                            </tr>
                    </table>
                    <table style="width: 100%">
                        <tbody>
                            <tr >
                                <td colspan="" style="vertical-align: middle; height: 35px; background-color:  #d6d6d5">
                                    <p class="" style="vertical-align: middle">
                                        <span class="bold">IV.  Наименование на растенията, растителните продукти и другите обекти, предмет на дейност</span><br/>
                                        (при необходимост, към заявлението се прилага подробен опис)
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 30px">
                                    <p>{{$operator->plants}}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width: 100%">
                        <tbody>
                            <tr >
                                <td colspan="4" style="vertical-align: middle; height: 35px; background-color:  #d6d6d5">
                                    <p class="bold" style="vertical-align: middle">V.  Произход на растенията, растителните продукти и другите обекти</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 25px; width: 15%; padding-left: 3px">
                                    @if($operator->europa == 0)
                                        <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                    @else
                                        <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                    @endif
                                        ЕС
                                </td>
                                <td style="height: 25px; width: 15%; padding-left: 3px">
                                    @if($operator->bulgaria == 0)
                                        <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                    @else
                                        <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                    @endif
                                        България
                                </td>
                                <td style="height: 25px; width: 15%; padding-left: 3px">
                                    @if($operator->own == 0)
                                        <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                    @else
                                        <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                    @endif
                                     собствен
                                </td>
                                <td style="height: 25px; width: auto; padding-left: 3px">
                                    @if(strlen($operator->origin_from) == 0)
                                        <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                    @else
                                        <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                    @endif
                                        внос
                                    <span class="bold">{{$operator->origin_from}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Таблица 5 --}}
                    <table id="fifth_table_new" style="width: 100%">
                        <tbody>
                            <tr >
                                <td colspan="4" style="vertical-align: middle; height: 35px; background-color:  #d6d6d5; padding-left: 3px">
                                    <p class="bold" style="vertical-align: middle">VI. ЗАЯВЯВАНЕ за РАЗРЕШЕНИЕ за издаване на растителни паспорти </p>
                                    <div>
                                        @if($operator->passports == 0)
                                            <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                        @else
                                            <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                        @endif
                                        <span class="bold">НЕ</span>
                                    </div>
                                    <div>
                                        @if($operator->passports == 1)
                                            <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                        @else
                                            <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                        @endif
                                        <span class="bold">ДА</span>
                                        (прилага се подробен опис на растенията, за които се иска разрешение за издаване на растителен паспорт – посочват се до вид, по възможност)
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 30px">
                                <td style="padding-left: 3px">
                                    <p class="bold">{{$operator->passports_list}}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Таблица 5 --}}
                    <table id="fifth_table_new" style="width: 100%">
                        <tbody>
                            <tr >
                                <td colspan="4" style="vertical-align: middle; height: 35px; background-color:  #d6d6d5; padding-left: 3px">
                                    <p class="bold" style="vertical-align: middle">VII. ЗАЯВЯВАНЕ за РАЗРЕШЕНИЕ за поставяне на маркировка върху дървен опаковъчен материал, дървесина или други обекти и за поправка на дървен опаковъчен материал</p>
                                    <div>
                                        @if($operator->marking == 0)
                                            <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                        @else
                                            <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                        @endif
                                        <span class="bold">НЕ</span>
                                    </div>
                                    <div>
                                        @if($operator->marking == 1)
                                            <i class="fa fa-check-square-o" aria-hidden="true" ></i>
                                        @else
                                            <i class="fa fa-square-o" aria-hidden="true" style=""></i>
                                        @endif
                                        <span class="bold">ДА</span>
                                            ДА (прилагат се технически спецификации на съоръжението/ята и оборудването за извършване на дейността/ите)
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 30px">
                                <td style="padding-left: 3px">
                                    <p class="bold">{{$operator->marking_list}}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Таблица 6 --}}
                    <table id="sixth_table">
                        <tbody>
                            <tr >
                                <td colspan="2" style="vertical-align: middle; height: 35px; background-color:  #d6d6d5; padding-left: 3px">
                                    <p class="bold" style="vertical-align: middle">
                                        VIII.  ДАННИ НА ЛИЦАТА ЗА КОНТАКТ  (спедиторски фирми, технически изпълнители, преки производители, вносители, други)
                                    </p>
                                </td>
                            </tr>
                            <tr >
                                <td class="cell" style="width: 50%">
                                    Име и фамилия:
                                    <span class="bold">{{$operator->contact}}</span>
                                </td>
                                <td class="cell" style="width: auto">
                                    Адрес: <span class="bold">{{$operator->contact_address}}</span>
                                </td>
                            </tr>
                            <tr >
                                <td class="cell" style="width: 50%">
                                    Телефон:
                                    <span class="bold">{{$operator->contact_phone}}</span>
                                </td>
                                <td class="cell" style="width: auto">
                                    Село/Град/: <span class="bold">{{$operator->contact_city}}</span>
                                </td>
                            </tr>
                            <tr >
                                <td class="cell" style="width: 50%; text-align: center">
                                    <span class="bold">{{$operator->place}} / {{$operator->date_place}}</span><br/>
                                    (място и дата на подаване)
                                </td>
                                <td class="cell" style="width: auto; text-align: center">
                                    (подпис  на заявителя)
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Таблица 6 --}}
                    <table id="last_table" style="margin-top: 25px; width: 100%">
                        <tbody>
                            <tr >
                                <td colspan="3" style="vertical-align: middle; height: 35px; background-color:  #d6d6d5; padding-left: 3px">
                                    <p class="bold" style="vertical-align: middle">
                                        IX. СЪОТВЕТСТВИЯ по чл. 66 от Регламент (ЕС) 2016/2031 и чл. … от ЗЗР
                                    </p>
                                </td>
                            </tr>
                            <tr >
                                <td class="cell" style="width: 40%">
                                    Представени документи: отбелязва се с «ДА»/«НЕ»
                                </td>
                                <td class="cell" style="width: 10%;  text-align: center">
                                    ДА/НЕ <span class="bold"></span>
                                </td>
                                <td class="cell" style="width: auto">
                                    Допълнителни бележки
                                </td>
                            </tr>
                            <tr >
                                <td class="cell" style="width: 40%">
                                    1. Регистрация като ЗП
                                </td>
                                <td class="cell" style="width: 10%; text-align: center">
                                    @if($operator->registration == 1)
                                        ДА
                                    @else
                                        НЕ
                                    @endif
                                </td>
                                <td class="cell" style="width: auto">
                                    <span class="bold">{{$operator->registration_note}}</span>
                                </td>
                            </tr>
                            <tr >
                                <td class="cell" style="width: 40%">
                                    2. Схема с разположение на предприятието/площите
                                </td>
                                <td class="cell" style="width: 10%; text-align: center">
                                    @if($operator->disposition == 1)
                                        ДА
                                    @else
                                        НЕ
                                    @endif
                                </td>
                                <td class="cell" style="width: auto">
                                    <span class="bold">{{$operator->disposition_note}}</span>
                                </td>
                            </tr>
                            <tr >
                                <td class="cell" style="width: 40%">
                                    3. Документ за право на собственост/ползване на предприятието/площите
                                </td>
                                <td class="cell" style="width: 10%; text-align: center">
                                    @if($operator->property == 1)
                                        ДА
                                    @else
                                        НЕ
                                    @endif
                                </td>
                                <td class="cell" style="width: auto">
                                    <span class="bold">{{$operator->property_note}}</span>
                                </td>
                            </tr>
                            <tr >
                                <td class="cell" style="width: 40%">
                                    4. Документи за произход на растенията, растителните продукти и други обекти
                                </td>
                                <td class="cell" style="width: 10%; text-align: center">
                                    @if($operator->plants_origin == 1)
                                        ДА
                                    @else
                                        НЕ
                                    @endif
                                </td>
                                <td class="cell" style="width: auto">
                                    <span class="bold">{{$operator->plants_note}}</span>
                                </td>
                            </tr>
                            <tr >
                                <td class="cell" style="width: 40%">
                                    5. Други
                                </td>

                                <td class="cell" style="width: auto" colspan="2">
                                    <span class="bold">{{$operator->others_note}}</span>
                                </td>
                            </tr>
                            <tr >
                                <td class="cell" style="width: auto; height: 50px" colspan="3">
                                    Приел: <span class="bold">{{$operator->accepted_name}}</span>
                                </td>
                            </tr>
                            <tr >
                                <td colspan="3" style="vertical-align: middle; height: 35px; background-color:  #d6d6d5; padding-left: 3px">
                                    <p class="bold" style="vertical-align: middle">
                                        X. СТАНОВИЩЕ НА ИНСПЕКТОРА
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%; height: 80px; vertical-align: top; padding: 5px 0 0 5px" >
                                    <span class="bold">Свободен текст: </span>
                                    {{$operator->free_text}}
                                </td>
                                <td style="width: auto; vertical-align: top; padding: 5px 0 0 5px" colspan="2">
                                    Проверил:
                                    <span class="bold">{{$operator->checked_name}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%; height: 80px; ; vertical-align: top; padding: 5px 0 0 5px" >
                                    <p style="padding-bottom: 20px">Регистрационен  № на заявителя:</p>
                                    @if($operator->registration_number == 0)
                                        <p style="padding-bottom: 20px" class="bold">Регистрациония  № на заявителя все още не добавен</p>
                                    @else
                                        <p style="padding-bottom: 20px">{{$operator->registration_number}} </p>
                                    @endif
                                </td>
                                <td style="width: auto; padding: 5px 0 0 5px" colspan="2">
                                    Подпис:............
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    {{--<div  style="height: 150px; background-color: #0a0a0a">AAA</div>--}}
@endsection