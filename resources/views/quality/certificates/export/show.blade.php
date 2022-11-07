@extends('layouts.quality')
@section('title')
    {{ 'Сертификат' }}
@endsection

@section('css')
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/qcertificates/show_opinion.css" )!!}
    {!!Html::style("css/qcertificates/body_table.css" )!!}
    @if($certificate->is_lock == 1)
        {!!Html::style("css/qcertificates/print.css", array('media' => 'print'))!!}
    @endif
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="info-wrap">
        <a href="{!! URL::to('/контрол/търговци/'.$certificate->importer_id.'/show')!!}" class="fa fa-user btn btn-success my_btn my_float"> Към Фирмата!</a>
        <a href="{!! URL::to('/контрол/сертификати-износ')!!}" class="fa fa-certificate btn btn-info my_btn my_float" style="margin-left: 5px"> Към сертификати износ!</a>
        @if ($certificate->what_7 == 2)
            <h4 class="bold title_doc" >СЕРТИФИКАТ ЗА ВНОС</h4>
        @elseif ($certificate->what_7 == 3)
            <h4 class="bold title_doc" >СЕРТИФИКАТ ЗА ИЗНОС</h4>
        @else
            <h4 class="bold title_doc" >СЕРТИФИКАТ</h4>
        @endif
        
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
        <fieldset class="big_field ">
            <div class="row-height-my col-md-12" style="display: table">
                <div style="display: table-row">
                    <div class="small_field_right top_info" style="display: table-cell" >
                        <span class="span-firm-info"><i class="fa fa-user "></i> ДАННИ НА ТЪРГОВЕЦ И НОМЕР</span>
                    </div>
                    <div class="small_field_center top_info" style="display: table-cell" >
                        <span class="span-firm-info"><i class="fa fa-paper-plane "></i> ДАННИ НА ОПАКОВЧИК</span>
                    </div>
                    <div class="small_field_right top_info" style="display: table-cell" >
                        <span class="span-phar-info"><i class="fa fa-leaf "></i> ДАННИ НА СТОКИТЕ</span>
                    </div>
                </div>
                <div style="display: table-row">
                    <div class="small_field_left " style="display: table-cell">
                        <p >Сертификат №: <span class="bold">{{$certificate->stamp_number }}/{{$certificate->export }}</span></p>
                        <hr class="my_hr_in"/>
                        <p >Фирма: <span class="bold" style="text-transform: uppercase">{{$certificate->importer_name }}</span></p>
                        <p >ЕИК/VAT: <span class="bold">{{$certificate->importer_vin }}</span> </p>
                        <hr class="my_hr_in"/>
                        <p >Адрес: <span class="bold">{{$certificate->importer_address }}</span></p>
                        <hr class="my_hr_in"/>
                    </div>
                    <div class="small_field_center" style="display: table-cell">
                        <p>Опаковчик</p>
                        <hr class="my_hr_in"/>
                        <p >Фирма: <span class="bold" style="text-transform: uppercase">{{$certificate->packer_name }}</span></p>
                        <p >Адрес: <span class="bold">{{$certificate->packer_address }}</span></p>
                        <hr class="my_hr_in"/>
                    </div>
                    <div class="small_field_right" style="display: table-cell">
                        <p>Стоки</p>
                        <hr class="my_hr_in"/>
                        @foreach ($stocks as $stock)
                        <?php
                            if($stock['type_pack'] == 1 ) {
                                $pack = 'Каси/ Pl. cases';
                            }
                            elseif ($stock['type_pack'] == 2) {
                                $pack = 'Палети/ Cages';
                            }
                            elseif ($stock['type_pack'] == 3) {
                                $pack = 'Кашони/ C. boxes';
                            }
                            elseif ($stock['type_pack'] == 4) {
                                $pack = 'Торби/ Bags';
                            }
                            elseif ($stock['type_pack'] == 999) {
                                $pack = $stock['different'];
                            }
                            else {
                                $pack = '';
                            }
                            // \\\\
                            if (strlen($stock['variety']) > 0) {
                                $variety = '('.$stock['variety'].')';
                            }
                            else {
                                $variety = '';
                            }
                            // \\\\
                            if($stock['quality_class'] == 1) {
                                $class = 'I клас/I class';
                            }
                            elseif ($stock['quality_class'] == 2) {
                                $class = 'II клас/II class';
                            }
                            elseif ($stock['quality_class'] == 3) {
                                $class = 'OПС/GPS';
                            }
                            else {
                                $class = '';
                            }
                        ?>
                            <p style="font-size: 13px" class="bold">
                                <span style="display: inline-block; ">{{$pack}} - {{$stock['number_packages'] }}</span> | 
                                <span style="display: inline-block; ">
                                    {{$stock['crops_name'] }}/{{$stock['crop_en']}} <span style="font-weight: normal;">{{$variety}}</span> 
                                </span> | 
                                <span style="display: inline-block; ">
                                    {{$class}} - {{$stock['weight']}} kg
                                </span>
                            </p>
                            <hr class="my_hr_in"/>
                        @endforeach
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
                    <div class="col-md-4">
                        <p >Контролен орган: <span class="bold" style="text-transform: none">{{$certificate->authority_bg }}</span></p>
                        <hr class="my_hr_in"/>
                        <p >Митница: <span class="bold" style="text-transform: none">{{$certificate->customs_bg }}/{{$certificate->customs_en }}</span></p>
                        <hr class="my_hr_in"/>
                        <p >Място на издаване: <span class="bold">{{$certificate->place_bg }}/ {{$certificate->place_en }}</span></p>
                        <hr class="my_hr_in"/>
                    </div>
                    <div class="col-md-4">
                        <p >Подписващо лице : <span class="bold" style="text-transform: uppercase">{{$certificate->inspector_bg }}</span></p>
                        <hr class="my_hr_in"/>
                        <p >Дата на издаване: <span class="bold" style="text-transform: none">{{ date( 'd.m.Y', $certificate->date_issue) }}</span></p>
                        <hr class="my_hr_in"/>
                        <p >Валиден до : <span class="bold">{{$certificate->valid_until }}</span></p>
                        <hr class="my_hr_in"/>
                    </div>
                    <div class="col-md-2">
                        <p >5. Регион или страна: <span class="bold" style="text-transform: uppercase"></span></p>
                        <hr class="my_hr_in"/>
                        <p ><span class="bold" style="text-transform: none">{{$certificate->for_country_bg }}/{{$certificate->for_country_en }}</span></p>
                        <hr class="my_hr_in"/>
                    </div>
                    @if($certificate->invoice_id != 0)
                        <div class="col-md-2">
                            <p >
                                Фактура: <span class="bold" style="text-transform: uppercase"></span>
                                <a href='/контрол/фактури-износ/{{$certificate->invoice_id}}/edit' class="fa fa-edit btn btn-success my_btn" style="float: right"> Edit</a>
                            </p>
                            <hr class="my_hr_in"/>
                            <p ><span class="bold" style="text-transform: none">{{$invoice[0]['number_invoice'] }}/{{ date('d.m.Y' ,$invoice[0]['date_invoice']) }}</span></p>
                            <hr class="my_hr_in"/>
                            <p >Сума: <span class="bold" style="text-transform: none">{{$invoice[0]['sum']}} лв.</span></p>
                        </div>
                    @else
                        <div class="col-md-2">
                            <p >Фактура: <span class="bold" style="text-transform: uppercase"></span></p>
                            <hr class="my_hr_in"/>
                            <p ><span class="bold red" style="text-transform: none">Поълни фактурта!</span></p>
                            <hr class="my_hr_in"/>
                            <p >
                                <a href='/контрол/фактури-износ/{{$certificate->id}}' class="fa fa-plus-circle btn btn-danger my_btn"> Add</a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
            @if($certificate->is_lock == 0)
                <div class="col-md-12 row-table-bottom " style="display: table" >
                @if ((Auth::user()->id == $certificate->added_by) || (Auth::user()->admin == 2))
                    <div  class="archive small_field_bottom print-button" >
                        <p style="font-weight: normal"><span class="bold" style="text-transform: none;">ВНИМАНИЕ!!!</span> Само администратор или инспектора съставил Сертификата могат да го Редактират!</p>
                        <hr class="my_hr_in"/>
                        <div class="btn_add" style="text-align: left; display: inline-block; margin-top: 5px">
                            <a href="{!!URL::to('/контрол/сертификат-износ/'.$certificate->id.'/edit')!!}" class="fa fa-edit btn btn-primary">  Редактирай Данните</a>
                        </div>
                        <div class="btn_add" style="float: right; display: inline-block; margin-top: 5px">
                            <a href="{!!URL::to('/export/stock/'.$certificate->id.'/0/edit')!!}" class="fa fa-edit btn btn-danger">  Редактирай Стоките</a>
                        </div>
                    </div>
                @endif
            </div>
            @endif
            <div class="col-md-12 row-table-bottom " style="display: table" >
                @if($certificate->is_lock == 0)
                    <div class="small_field_bottom" style="display: table-cell">
                        {!! Form::model($certificate, ['url'=>'lock-export-certificate/'.$certificate->id , 'method'=>'POST', 'id'=>'form']) !!}
                        <button type="submit" class="btn-sm btn-default " id="complexConfirm">
                            <i class="fa fa-print"></i> Подготви за печат!
                        </button>
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                        {!! Form::close() !!}
                    </div>
                    <div class="small_field_bottom" style="display: table-cell">
                        <p ><span class="red bold"><i class="fa fa-warning"></i>
                            ВНИМАНИЕ!!</span> Ако данните са коректни, за да се отпечата Сертификата трябва да се натисне бутона "Подготви за печат!".<br/>
                            След което, няма да могат да се правят повече промени по Сертификата!!! </p>
                    </div>
                @else
                    <div class="small_field_bottom" style="display: table-cell">
                        <p class="bold">Сертификата е заключен и не може да се редактира повече.</p>
                    </div>
                    @if(Auth::user()->admin == 2 )
                        <div class="small_field_bottom" style="display: table-cell">
                            {!! Form::model($certificate, ['url'=>'unlock-export-certificate/'.$certificate->id , 'method'=>'POST', 'id'=>'form']) !!}
                            <button type="submit" class="btn-sm btn-success " id="unlockConfirm">
                                <i class="fa fa-unlock"></i> Откючи!
                            </button>
                            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                            {!! Form::close() !!}
                        </div>
                    @endif
                @endif
            </div>
        </fieldset>
    </div>

    <div id="wrap_in" class="col-md-12">
        <div class="page" >
            <div class="col-md-12_my" id="flip_all">
                <div class="col-md-12_my" id="flip_in">
                    <div class="col-md-12_my" style="margin: 0 auto">
                        <h3 class="h3_top">
                            СЕРТИФИКАТ ЗА СЪОТВЕТСТВИЕ С ПАЗАРНИТЕ СТАНДАРТИ НА ЕВРОПЕЙСКИЯ СЪЮЗ ЗА ПРЕСНИ ПЛОДОВЕ И ЗЕЛЕНЧУЦИ, ПОСОЧЕНИ В ЧЛЕНОВЕ 12, 13 И 14
                        </h3>
                        <h3 class="h3_bottom">
                            CERTIFICATE OF CONFORMITY WITH THE EUROPEAN UNION MARKETING STANDARDS FOR FRESH FRUIT AND VEGETABLES REFERRED TO IN ARTICLES 12, 13 AND 14
                        </h3>
                    </div>
                   
                    {{-- Таблица 1 --}}
                    <table id="first_table">
                        <tbody>
                            <tr id="first-row" >
                                <td class="cell first-row-cell" style="height: 5.2cm">
                                    <p class="p_info" style="margin-bottom: 3px">1. Търговец / Trader</p>
                                    <p class="p_content" style="margin-bottom: 8px">{{$certificate->importer_name }}</p>
                                    <?php
                                        if($firm->is_bulgarian == 0) {
                                            $vin = 'BG:'.$certificate->importer_vin;
                                            
                                        }
                                        else {
                                            $vin = $certificate->importer_vin;
                                        }
                                    ?>
                                    <p class="p_content" style="">{{$certificate->importer_address }} / {{ $vin }}</p>
                                </td>
                                <td class="cell first-row-cell cell-top" style="height: 5.2cm">
                                    @if ($certificate->type_crops == 1)
                                        <p class="p_info type line" style="margin-bottom: 2px">
                                            Сертификат за съответствие с пазарните стандарти на Европейския съюз, приложими към пресни плодове и зеленчуци, съгласно Регламент 543/2011
                                        </p>
                                    @endif
                                    @if ($certificate->type_crops == 2)
                                        <p class="p_info type line" style="margin-bottom: 2px">
                                            Сертификат за съответствие с пазарните стандарти на Европейския съюз, приложими към пресни плодове и зеленчуци, предназначени за преработка, съгласно Регламент 543/2011
                                        </p>
                                    @endif
                                    <p class="p_info line" style="margin-bottom: 3px">
                                        Certificate of conformity with the European Union marketing standards applicable to fresh fruit and vegetables, according Regulation 543/2011
                                    </p>
                                    <p class="p_content number_sert" style="">
                                        №/No {{ $certificate->stamp_number }}/{{ $certificate->export }}
                                    </p>
                                    <p class="p_info line" style="margin-bottom: 3px">
                                        (Настоящият сертификат е предназначен изключително за контролните органи)
                                    </p>
                                    <p class="p_info line" style="margin-bottom: 3px">
                                        (This certificate is exclusively for the use of inspectionbodies)
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Таблица 2 --}}
                    <table id="second_table">
                        <tbody>
                            <tr>
                                <td class="cell second-row-cell cell-control autority" style=" height: 3.6cm" rowspan="2">
                                    <p class="p_info" style="margin-bottom: 3px;">
                                        2. Опаковчик, посочен върху опаковката (ако е  различен от търговеца)/ Packer identified on packaging (if other than trader)
                                    </p>
                                    <p class="p_content" style="margin-top: 20px">
                                        @if ($certificate->packer_id != 888)
                                            @if( strlen($certificate->packer_address) > 0)
                                                {{$certificate->packer_name }}, {{ $certificate->packer_address }}
                                            @else
                                                {{$certificate->packer_name }} {{ $certificate->packer_address }}
                                            @endif

                                        @else
                                        <span>--------------</span>
                                        @endif


                                    </p>
                                    {{--<p class="p_content">--}}
                                        {{--{{$certificate->packer_address }}--}}
                                    {{--</p>--}}
                                </td>
                                <td class="cell second-row-cell cell-control autority" style="height: 1cm  !important" colspan="2">
                                    <p class="p_info" style="margin-bottom: 3px">
                                        3. Контролен орган / Inspection body
                                    </p>
                                    <p class="p_content bold"  style="line-height: 15px">
                                        {{$certificate->authority_bg }}
                                    </p>
                                    <p class="p_content bold" style="line-height: 15px">
                                        {{$certificate->authority_en }}
                                    </p>
                                </td>
                            </tr>
                            <tr >
                                <td class="cell third-row-cell" style="height: 2.2cm; width: 3.9cm" >
                                    <p class="p_info" style="margin-bottom: 3px">
                                        4. Място на инспекцията/ <span style="text-decoration: underline">страна на произход</span> (<sup>1</sup>)
                                    </p>
                                    <p class="p_info" style="margin-bottom: 3px">
                                        Place of inspection/ <span style="text-decoration: underline">country of origin </span> (<sup>1</sup>)
                                    </p>
                                    <p class="p_content bold" style="text-transform: none; margin-top: 8px">
                                        {{$certificate->from_country }}
                                    </p>
                                </td>
                                <td class="cell third-row-cell" style="height: 2.2cm; width: 3.8cm" >
                                    <p class="p_info" style="margin-bottom: 3px">
                                        5. Регион или страна на местоназначение/ Region or country of destination
                                    </p>
                                    <div id="country_wrapp">
                                        <p class="p_content bold" id="country_p" style="">
                                            {{$certificate->for_country_bg }}/ <span style="text-transform: none">{{$certificate->for_country_en }}</span>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Таблица 3 --}}
                    <table id="third_table">
                        <tbody>
                            <tr >
                                <td class="cell second-row-cell cell-rowspan"  >
                                    <p class="p_info" style="margin-bottom: 3px;">
                                        6. Идентификация на транспортните средства/ Identifier of means of transport BY TRUCK
                                    </p>
                                    <p class="p_content transport" style="margin-bottom: 3px">
                                        {{$certificate->transport }}
                                    </p>
                                </td>
                                <td class="cell second-row-cell cell-controlss" >
                                    <p class="p_info" id="p_seven" style="margin-bottom: 10px;">
                                        7.
                                    </p>
                                    @if ($certificate->what_7  == 1)
                                    <p id="p_internal_yes" class="p_content7"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span style="text-decoration: underline">вътрешен/internal</span></p>
                                    @else
                                    <p id="p_internal_no" class="p_content7"><i class="fa fa-square-o" aria-hidden="true"></i> <span>вътрешен/internal</span></p>
                                    @endif

                                    @if ($certificate->what_7  == 2)
                                    <p id="p_import_yes" class="p_content7"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span style="text-decoration: underline">внос/import</span></p>
                                    @else  
                                    <p id="p_import_no" class="p_content7"><i class="fa fa-square-o" aria-hidden="true"></i> <span >внос/import</span></p>  
                                    @endif

                                    @if ($certificate->what_7  == 3)
                                    <p id="p_export_yes" class="p_content7"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span style="text-decoration: underline">износ/export</span></p>
                                    @else   
                                    <p id="p_export_no" class="p_content7"><i class="fa fa-square-o" aria-hidden="true"></i> <span>износ/export</span></p> 
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Таблица 4 --}}
                    <table id="fourth_table">
                        <tbody>
                            <tr >
                                {{-- Pole 8 --}}
                                <td class="cell fourth-row-cell cell-rowspan" >
                                    <p class="p_info" style="margin-bottom: 3px; display:block">
                                        8. Опаковки (брой и вид)/ Packages (number and type)
                                    </p>
                                    @foreach ($stocks as $k => $stock)
                                    <?php
                                        if ($stock['type_pack'] == 1) {
                                            $pack = 'Каси/ Pl. cases';
                                        }
                                        elseif ($stock['type_pack'] == 2) {
                                            $pack = 'Палети/ Cages';
                                        }
                                        elseif ($stock['type_pack'] == 3) {
                                            $pack = 'Кашони/ C. boxes';
                                        }
                                        elseif ($stock['type_pack'] == 4) {
                                            $pack = 'Торби/ Bags';
                                        }
                                        elseif ($stock['type_pack'] == 999) {
                                            $pack = $stock['different'];
                                        }
                                        else {
                                            $pack = '';
                                        }
                                    ?>
                                    <p class="p_content bold pack pack{{$k}}" style="text-transform: none">{{ $pack }} {{$stock['number_packages']}}</p>
                                    @endforeach
                                </td>
                                {{-- Pole 9 --}}
                                <td class="cell fourth-row-cell cell-control" id="stocs_cell">
                                    <p class="p_info stocs" style="margin-bottom: 3px;">
                                        9. Тип продукт (сорт, ако стандартът го посочва)/ Type of product (variety if the standard specifies)
                                    </p>
                                    @foreach ($stocks as $k => $stock)
                                    <?php
                                        if(!empty($stock['variety'])) {
                                            $variety = '<br>('. $stock['variety'] .')';
                                        }
                                        else {
                                            $variety = '';
                                        }
                                    ?>
                                    <p class="p_content bold crop crop{{$k}}" >
                                        <span>{{$stock['crops_name']}}</span>/
                                        <span style="text-transform: none">{{$stock['crop_en']}}</span>
                                        <span style="text-transform: none">{!! $variety !!}</span>
                                    </p>
                                    @endforeach
                                </td>
                                {{-- Pole 10 --}}
                                <td class="cell fourth-row-cell cell-rowspan" >
                                    <p class="p_info " style="margin-bottom: 3px;">
                                        10. Клас на качество/ Quality class
                                    </p>
                                    @foreach ($stocks as $k => $stock)
                                    <?php
                                        if ($stock['quality_class'] == 1) {
                                            $class = 'I клас/I class';
                                        }
                                        elseif ($stock['quality_class'] == 2) {
                                            $class = 'II клас/II class';
                                        }
                                        elseif ($stock['quality_class'] == 3) {
                                            $class = 'OПС/GPS';
                                        }
                                        else {
                                            $class = '';
                                        }
                                    ?>
                                    <p class="p_content bold quality quality{{$k}}" style="text-transform: none">{{ $class }}</p>
                                    @endforeach
                                </td>
                                {{-- Pole 11 --}}
                                <td class="cell fourth-row-cell cell-control last-cell" >
                                    <p class="p_info" style="margin-bottom: 3px;">
                                        11. Общо нето тегло в kg/ Total net weight in kg
                                    </p>
                                    @foreach ($stocks as $k => $stock)
                                        <p class="p_content bold weight weight{{$k}}" >
                                            {{ number_format($stock['weight'], 0, ',', ' ') }} 
                                            <span style="text-transform: none">kg</span></p>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Таблица 5 --}}
                    <table id="fifth_table">
                        <tbody>
                            <tr >
                                <td class="cell fifth-row-cell cell-rowspan" >
                                    <p class="p_info" id="p_top_set" >
                                        12. Към момента на издаване на сертификата посочената по-горе пратка съответства на 
                                        действащите пазарни стандарти на Европейския съюз, съгласно Регламент 543/2011/
                                        The consignment referred to above conforms, at the issue time, with the European Union 
                                        marketing standards in force, according Regulation 543/2011
                                    </p>
                                    <div class="com-md-6" style="display: inline-block">
                                        <p class="" style="font-size: 11.5px;">
                                            <span style="width: 50%">Предвиждано митническо учреждение/ <span class="bold">{{$certificate->customs_bg }}</span></span>
                                        </p>
                                        <p class="" style="font-size: 11.5px;">
                                            <span style="width: 50%">Customs office foresee/ <span class="bold">{{$certificate->customs_en }}</span></span>
                                        </p>
                                    </div>
                                    <div class="com-md-6" style="display: inline-block">
                                        <p class="" style="font-size: 11.5px;">
                                            <span style="width: 50%; margin-left: 10px" >Място и дата на издаване/ <span class="bold">{{$certificate->place_bg }}/ {{date('d.m.Y', $certificate->date_issue)}}</span></span>
                                        </p>
                                        <p class="" style="font-size: 11.5px;">
                                            <span style="width: 50%; margin-left: 10px" >Place and date of issue/ <span class="bold">{{$certificate->place_en }}/ {{date('d.m.Y', $certificate->date_issue)}}</span></span>
                                        </p>
                                    </div>
                                    <p class="" style="font-size: 11.5px; margin-top: 5px">
                                        Валиден до (дата)/Valid until (date) <span style="" ><span class="bold">{{$certificate->valid_until }}</span></span>
                                    </p>
                                    <p style="font-size: 11.5px; " id="p_bottom_set">
                                        Подписващо лице (име с главни букви): <span class="bold" style="text-transform: uppercase">{{$certificate->inspector_bg }}</span>
                                    </p>
                                    <p style="font-size: 11.5px;">
                                        Signatory (name in block letters): <span class="bold" style="text-transform: uppercase">{{$certificate->inspector_en }}</span>
                                    </p>
                                    <p style="font-size: 11.5px;" id="signature">
                                        Подпис/Signature..................Печат на компетентния орган/Seal of the competent authority
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Таблица 6 --}}
                    <table id="sixth_table">
                        <tbody>
                            <tr >
                                <td class="cell sixth-row-cell cell-rowspan" >
                                    
                                    @if ($certificate->type_crops == 2 )
                                        <p class="p_content" style="text-transform: none">
                                            13. Забележки/ Observations: Сертификатът се издава на основание чл.4 т.7 от Регламент (ЕС) 543/2011 г. 
                                        </p>
                                        <p class="p_content" style="text-transform: none">
                                            {{$certificate->observations}}
                                        </p>
                                    @else
                                        <p class="p_content" style="text-transform: none">
                                            13. Забележки/ Observations  {{$certificate->observations}}
                                        </p>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="p_bottom">
                    (1) При реекспорт на стоки се посочва произходът им в клетка 9/ Where the goods аrе being re-exported, indicate the origin In box 9.
                </p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- ПЪРВОНАЧАЛНИТЕ НАСТРОЙКИ СА ЗАДАДЕНИ В  flipText.js --}}
    
    {{-- {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!} --}}
    {{-- {!!Html::script("js/date/in_date.js" )!!} --}}
    {{-- {!!Html::script("js/opinions/clientDocument.js" )!!} --}}
    {!!Html::script("js/quality/flipText.js" )!!}
    {{-- {!!Html::script("js/opinions/addressFlip.js" )!!} --}}

    <script>
    </script>
@endsection