@extends('layouts.quality')
@section('title')
    {{ 'Сертификат' }}
@endsection

@section('css')
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/qcertificates/show_opinion_next.css" )!!}
    {!!Html::style("css/qcertificates/body_table_next.css" )!!}

    @if($certificate->is_lock == 1)
        {!!Html::style("css/qcertificates/print.css", array('media' => 'print'))!!}
    @endif
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="info-wrap">
        <a href="{!! URL::to('/контрол/вносители/'.$certificate->importer_id.'/show')!!}" class="fa fa-user btn btn-success my_btn my_float"> Към Фирмата!</a>
        <a href="{!! URL::to('/контрол/сертификати-внос')!!}" class="fa fa-certificate btn btn-info my_btn my_float" style="margin-left: 5px"> Към сертификати внос!</a>
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
                        <p >Сертификат №: <span class="bold">{{$certificate->stamp_number }}/{{$certificate->import }}</span></p>
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
                                @if(Auth::user()->id == $certificate->added_by)
                                    <a href='/контрол/фактури-внос/{{$certificate->invoice_id}}/edit' class="fa fa-edit btn btn-success my_btn" style="float: right"> Edit</a>
                                @endif

                            </p>
                            <hr class="my_hr_in"/>
                            <p ><span class="bold" style="text-transform: none">{{$invoice[0]['number_invoice'] }}/{{ date('d.m.Y' ,$invoice[0]['date_invoice']) }}</span></p>
                            <hr class="my_hr_in"/>
                            <p >Сума: <span class="bold" style="text-transform: none">{{number_format($invoice[0]['sum'], 2, ',', ' ')}} лв.</span></p>
                        </div>
                    @else
                        <div class="col-md-2">
                            <p >Фактура: <span class="bold" style="text-transform: uppercase"></span></p>
                            <hr class="my_hr_in"/>
                            <p ><span class="bold red" style="text-transform: none">Поълни фактурта!</span></p>
                            <hr class="my_hr_in"/>
                            @if($certificate->sum != 0)
                                @if(Auth::user()->id == $certificate->added_by)
                                    <a href='/контрол/фактури-внос/{{$certificate->id}}' class="fa fa-plus-circle btn btn-danger my_btn"> Add</a>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            
            @if($certificate->is_lock == 0)
                <div class=" col-md-12 row-table-bottom " style="display: table" id="wrap_sum">
                    <div  class=" small_field_bottom print-button" >
                        <?php echo ($sum_type); ?>
                        {!! Form::open(['url'=>'import/add-sum/store/'.$certificate->id, 'method'=>'POST', 'autocomplete'=>'on']) !!}
                            @if($certificate->sum == 0)
                                @if($certificate->type_crops == 1)
                                    <p style="font-weight: normal"><span class="bold" style="text-transform: none;">ВНИМАНИЕ!!!</span>
                                        Общо килограмите в сертификата са - <span class="bold">{{$total_weight}}</span> кг. &nbsp;
                                        Предлагана сума за плащане -  
                                        @if ($sum_import == 0)
                                        <span class="bold">Килограмите са над 30000. Добави сумата </span>
                                        @else
                                            <span class="bold">{{$sum_import}}</span> лв.
                                        @endif
                                    </p>
                                @elseif ($certificate->type_crops == 2)
                                    <p style="font-weight: normal"><span class="bold" style="text-transform: none;">ВНИМАНИЕ!!! СТОКИТЕ СА ЗА ПРЕРАБОТКА</span> 
                                        Общо килограмите в сертификата са - <span class="bold">{{$total_weight}}</span> кг. &nbsp;
                                        
                                        @if ($sum_type == 0)
                                            <span class="bold">Килограмите са над 30000. Добави сумата!</span>
                                        @else
                                            Предлагана сума за плащане според килограмите-  
                                            <span class="bold">{{$sum_type}}</span> лв.
                                        @endif
                                    </p>
                                @else
                                    <p><span class="bold" style="text-transform: none;">ВНИМАНИЕ!!!</span> Провери данните! Вероятно има грешка!</p>
                                @endif
                            @else
                                @if($certificate->type_crops == 1)
                                    <p style="font-weight: normal"><span class="bold" style="text-transform: none;">ВНИМАНИЕ!!!</span> 
                                        Общо килограмите в сертификата са - <span class="bold">{{$total_weight}}</span> кг. &nbsp;
                                        Добавена е сума -  <span class="bold">{{ $certificate->sum}}</span> лв. 
                                        @if ($certificate->percent == 1)
                                            с добавени <span class="bold">42%</span> според чл. 56 т. 1
                                        @elseif($certificate->percent == 2)
                                            с добавени <span class="bold">86%</span> според чл. 56 т. 2
                                        @else
                                            без добавен процент.
                                        @endif
                                    </p>
                                @elseif ($certificate->type_crops == 2)
                                    <p style="font-weight: normal"><span class="bold" style="text-transform: none;">ВНИМАНИЕ!!! СТОКИТЕ СА ЗА ПРЕРАБОТКА</span> 
                                        Общо килограмите в сертификата са - <span class="bold">{{$total_weight}}</span> кг. &nbsp;
                                        Добавена е сума -  <span class="bold">{{ $certificate->sum}}</span> лв. 
                                        @if ($certificate->percent == 1)
                                            с добавени <span class="bold">42%</span> според чл. 56 т. 1
                                        @elseif($certificate->percent == 2)
                                            с добавени <span class="bold">86%</span> според чл. 56 т. 2
                                        @else
                                            без добавен процент.
                                        @endif
                                    </p>
                                @else
                                    <p><span class="bold" style="text-transform: none;">ВНИМАНИЕ!!!</span> Провери данните! Вероятно има грешка!</p>
                                @endif
                            @endif
                            <hr class="my_hr_in"/>
                            <div class="btn_add" style="text-align: left; display: inline-block; margin-top: 5px; width: 100%">
                                <?php 
                                if($certificate->type_crops == 1) {
                                    if($sum_import == 0) {
                                        $sum_for_pay = $certificate->base_sum;
                                        
                                    }
                                    else {
                                        $sum_for_pay = $sum_import;
                                    }
                                } 
                                elseif ($certificate->type_crops == 2) {
                                    if($sum_type == 0) {
                                        $sum_for_pay = $certificate->base_sum;
                                    }
                                    else {
                                        $sum_for_pay = $sum_type;
                                    }
                                }
                                else {
                                    $sum_for_pay = null;
                                }
                                
                                if($certificate->percent == 0){
                                    $percent0 = true;
                                    $percent1 = false;
                                    $percent2 = false;
                                }
                                elseif ($certificate->percent == 1) {
                                    $percent0 = false;
                                    $percent1 = true;
                                    $percent2 = false;
                                }
                                elseif ($certificate->percent == 2) {
                                    $percent0 = false;
                                    $percent1 = false;
                                    $percent2 = true;
                                }
                                else {
                                    $percent0 = true;
                                    $percent1 = false;
                                    $percent2 = false;
                                }
                                // print_r($sum_for_pay);
                                ?>
                                {!! Form::label('sumField', 'Предлагана сума за плащане:', ['class'=>'my_labels']) !!}
                                {!! Form::text('sum', $sum_for_pay, ['class'=>'hide_numberss form-control form-control-my', 'style'=>'width: 100px; display: inline-block', 'size'=>'3', 'maxlength'=>'10', 'id'=>'sumField']) !!}
                                &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                                {!! Form::label('percent0', 'Без добавн процент', ['class'=>'my_labels']) !!}
                                {!! Form::radio('percent', '0' , $percent0, ['id' => 'percent0', 'class'=>'radioBtnClass']) !!}
                                &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                                {!! Form::label('percent1', '42%', ['class'=>'my_labels']) !!}
                                {!! Form::radio('percent', '1' , $percent1, ['id' => 'percent1', 'class'=>'radioBtnClass']) !!}
                                &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                                {!! Form::label('percent2', '84%', ['class'=>'my_labels']) !!}
                                {!! Form::radio('percent', '2' , $percent2, ['id' => 'percent2', 'class'=>'radioBtnClass']) !!}
                                @if ($certificate->sum == 0)
                                    <button type="submit" class="btn-sm btn-info " id="add_sum_btn" style="margin-left: 50px">
                                        <i class="fa fa-dollar"></i> Добави сума!
                                    </button>
                                @else
                                    <button type="submit" class="btn-sm btn-success " id="add_sum_btn" style="margin-left: 50px">
                                        <i class="fa fa-dollar"></i> Редактирай сума!
                                    </button>
                                @endif
                                
                            </div>
                            <input type="hidden" name="type" value="{{$certificate->type_crops}}" id="type">
                            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-md-12 row-table-bottom " style="display: table" >

                    @if ((Auth::user()->id == $certificate->added_by) || (Auth::user()->admin == 2 || Auth::user()->dlaznost == 1 ) )
                        <div  class="archive small_field_bottom print-button" >
                            <p style="font-weight: normal"><span class="bold" style="text-transform: none;">ВНИМАНИЕ!!!</span> Само администратор или инспектора съставил Сертификата могат да го Редактират!</p>
                            <hr class="my_hr_in"/>
                            <div class="btn_add" style="text-align: left; display: inline-block; margin-top: 5px">
                                <a href="{!!URL::to('/контрол/сертификат-внос/'.$certificate->id.'/edit')!!}" class="fa fa-edit btn btn-primary">  Редактирай Данните</a>
                            </div>
                            <div class="btn_add" style="float: right; display: inline-block; margin-top: 5px">
                                <a href="{!!URL::to('/import/stock/'.$certificate->id.'/0/edit')!!}" class="fa fa-edit btn btn-danger">  Редактирай Стоките</a>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            <div class="col-md-12 row-table-bottom " style="display: table" >
                @if($certificate->is_lock == 0)
                    <div class="small_field_bottom" style="display: table-cell">
                        {!! Form::model($certificate, ['url'=>'lock-import-certificate/'.$certificate->id , 'method'=>'POST', 'id'=>'form']) !!}
                        <button type="submit" class="btn-sm btn-default " id="complexConfirm">
                            <i class="fa fa-print"></i> Подготви за печат!
                        </button>
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                        <input type="hidden" name="is_sum" value="{{$certificate->sum}}" id="is_sum">
                        <input type="hidden" name="is_invoice" value="{{$certificate->invoice_id}}" id="is_invoice">
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
                    @if(Auth::user()->admin == 2 || Auth::user()->dlaznost == 1 || Auth::user()->id == $certificate->added_by )
                        <div class="small_field_bottom" style="display: table-cell">
                            {!! Form::model($certificate, ['url'=>'unlock-import-certificate/'.$certificate->id , 'method'=>'POST', 'id'=>'form']) !!}
                            <button type="submit" class="btn-sm btn-success " id="unlockConfirm">
                                <i class="fa fa-unlock"></i> Отключи!
                            </button>
                            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                            {!! Form::close() !!}
                        </div>
                    @endif
                @endif
            </div>
            @if($certificate->is_lock != 0)
                <div class="col-md-12 row-table-bottom " >
                    <div  class="archive small_field_bottom print-button" >
                        <button id="btn_archive" class="btn-sm"><i class="fa fa-print"></i> Покажи и принтирай БЕЛЕЖКА</button>
                    </div>
                    <div  class="hidden client small_field_bottom print-button" style="display: table-cell">
                        <button id="btn_client" class="btn-sm" ><i class="fa fa-print"></i> Към Сертификата</button>
                    </div>
                </div>
            @endif
        </fieldset>
    </div>

    <div id="wrap_in" class="col-md-12 ">
        <div class="page" >
            <div class="col-md-12_my" id="flip_all">
                <div class="col-md-12_my" id="flip_in">
                   
                    {{-- Таблица 1 --}}
                    <table id="first_table">
                        <tbody>
                            <tr id="first-row" style="height: 1.3cm">
                                <td class="cell first-row-cell no-print"  rowspan="2">
                                    <p class="p_info no-print" style="margin-bottom: 12px">1. Търговец / Trader</p>
                                    <p class="p_content print" style="margin-bottom: 5px">{{$certificate->importer_name }}</p>
                                    <?php
                                        if($firm->is_bulgarian == 0) {
                                            $vin = 'BG:'.$certificate->importer_vin;
                                            
                                        }
                                        else {
                                            $vin = $certificate->importer_vin;
                                        }
                                    ?>
                                    <p class="p_content print" style="">{{$certificate->importer_address }} / {{ $vin }}</p>
                                </td>
                                <td colspan="2" class="no-print">
                                    <p class="p_info type line no-print" style="margin-bottom: 1px; font-weight: bold; margin-left: 50px">
                                        РЕПУБЛИКА БЪЛГАРИЯ/REPUBLIC OF BULGARIA<br>
                                        БЪЛГАРСКА АГЕНЦИЯ ПО БЕЗОПАСНОСТ НА ХРАНИТЕ/<br>
                                        BULGARIAN FOOD SAFETY AGENCY
                                    </p>
                                </td>
                            </tr>
                            <tr id="first-row_2" style="height: 4cm">
                                <td class="cell first-row-cell_2 cell-top no-print" >
                                    @if ($certificate->type_crops == 1)
                                        <p class="p_info type line no-print" style="margin-bottom: 1px; font-weight: bold; text-align: center">
                                            Сертификат за съответствие/Certificate of conformity<br>
                                            с пазарните стандарти на Европейския съюз,/with the European Union
                                            marketing standards
                                        </p>
                                    @endif
                                    @if ($certificate->type_crops == 2)
                                        <p class="p_info type line no-print" style="">
                                            Сертификат за съответствие с пазарните стандарти на Европейския съюз, приложими към пресни плодове и зеленчуци, предназначени за преработка, съгласно Регламент 543/2011
                                        </p>
                                    @endif
                                    <p class="p_info line no-print" style="">
                                        приложими към пресните плодове, зеленчуци и банани/applicable to fresh fruit and vegetables and bananas
                                    </p>
                                    <p class="p_content number_certificate no-print" style="font-weight: bold">
                                        №/No {{ $certificate->stamp_number }}/{{ $certificate->import }}
                                    </p>
                                    <p class="p_info line no-print" style="">
                                        (Настоящият сертификат е предназначен изключително за контролните органи)/(This certificate is exclusively for the use of inspection bodies)
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Таблица 2 --}}
                    <table id="second_table">
                        <tbody>
                            <tr>
                                <td class="cell second-row-cell cell-control authority no-print" style="" rowspan="2" id="second-row">
                                    <p class="p_info no-print" style="margin-bottom: 15px;">
                                        2. Опаковчик, посочен на опаковката (ако е  различен от търговеца)/ Packer identified on packaging (if other than trader)
                                    </p>
                                    <p class="p_content print" id="packers" style="font-size: 12px">
                                        @if( strlen($certificate->packer_address) > 0)
                                            {{$certificate->packer_name }}, {{ $certificate->packer_address }}
                                        @else
                                            {{$certificate->packer_name }} {{ $certificate->packer_address }}
                                        @endif

                                    </p>
                                </td>
                                <td class="cell second-row-cell_2 cell-control authority no-print" style="height: .7cm  !important" colspan="2">
                                    <p class="p_info" style="margin-bottom: 3px">
                                        <span class="no-print">3. Контролен орган/Inspection body</span><span class="bold print" style="float: right; margin-right: 20px">{{ mb_strcut ( $certificate->authority_bg, 10) }}/{{ substr($certificate->authority_en, 6) }}</span>
                                    </p>
                                </td>
                            </tr>
                            <tr >
                                <td class="cell second-row-cell_2 no-print" style="height: 2cm; width: 5.4cm; padding-top: 4px" >
                                    <p class="p_info no-print" style="margin-bottom: 3px">
                                        4. Място на инспекцията/ <span style="">страна на произход</span> (<sup>1</sup>)
                                        /Place of inspection/ <span style="">country of origin </span> (<sup>1</sup>)
                                    </p>
                                    <p class="p_content bold print" style="text-transform: none; margin-top: 8px">
                                        {{$certificate->from_country }}
                                    </p>
                                </td>
                                <td class="cell third-row-cell no-print" style="height: 2cm; width: auto; padding-top: 4px" >
                                    <p class="p_info no-print" style="margin-bottom: 24px; text-align: inherit">
                                        5. Регион или страна на местоназначение/ Region or country of destination
                                    </p>
                                    <div id="country_wrap" style="margin: 0; padding: 0;">
                                        <p class="p_content bold print" id="country_p" style="padding-left: 15px">
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
                                <td class="cell third-row-cell cell-rowspan no-print"  >
                                    <p class="p_info no-print" style="margin-bottom: 3px;">
                                        6. Идентификация на транспортните средства/ Identifier of means of transport
                                    </p>
                                    <p class="p_content transport print" style="margin-bottom: 3px; font-weight: bold">
                                        {{$certificate->transport }}
                                    </p>
                                </td>
                                <td class="cell third-row-cell_2 cell-controls no-print" style="padding-bottom: 0; padding-top: 3px">
                                    <p class="p_info no-print" id="p_seven" style="margin-bottom: 1px;">
                                        7.
                                    </p>
                                    @if ($certificate->what_7  == 1)
                                    <p id="p_internal_yes" class="p_content7"><i class="fa fa-check print" aria-hidden="true"></i> <span class="no-print" style="text-decoration: underline">вътрешен/internal</span></p>
                                    @else
                                    <p id="p_internal_no" class="p_content7"><i class="fa fa-square-o no-print" aria-hidden="true"></i> <span class="no-print">вътрешен/internal</span></p>
                                    @endif

                                    @if ($certificate->what_7  == 2)
                                    <p id="p_import_yes" class="p_content7"><i class="fa fa-check print" aria-hidden="true"></i> <span class="no-print" style="text-decoration: underline">внос/import</span></p>
                                    @else  
                                    <p id="p_import_no" class="p_content7"><i class="fa fa-square-o no-print" aria-hidden="true"></i> <span class="no-print">внос/import</span></p>
                                    @endif

                                    @if ($certificate->what_7  == 3)
                                    <p id="p_export_yes" class="p_content7"><i class="fa fa-check print" aria-hidden="true"></i> <span class="no-print" style="text-decoration: underline">износ/export</span></p>
                                    @else   
                                    <p id="p_export_no" class="p_content7"><i class="fa fa-square-o no-print" aria-hidden="true"></i> <span class="no-print">износ/export</span></p>
                                    @endif
                                    <p class="p_info no-print" style="margin-bottom: 1px; margin-top: 3px;">
                                        (В случая на банани, се отнася за проверки в мястото на местоназначението, когато е целесъобразно)
                                        /(For bananas, it refers to checks at destination where appropriate)
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Таблица 4 --}}
                    <table id="fourth_table" style="overflow:scroll;">
                        <tbody>
                            <tr >
                                {{-- Pole 8 --}}
                                <td class="cell fourth-row-cell_1 cell-rowspan no-print" style="padding-bottom: 0; overflow:auto; ">
                                    <p class="p_info no-print " style="margin-bottom: 3px; margin-left: 3px; margin-right: 3px; text-align: left; font-size: 12.5px">
                                        8. Опаковки (брой и вид)/ Packages (number and type)
                                    </p>
                                    <table id="table_pack" cellspacing="0" cellpadding="0" style="border: none">
                                        <tbody >
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
                                            <tr>
                                                <td  class="pack{{$k}}" style="border: none">
                                                    <p class="p_content bold pack print" style="text-transform: none; margin-left: 3px">{{ $pack }} {{$stock['number_packages']}}</p>
                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                {{-- Pole 9 --}}
                                <td class="cell fourth-row-cell_2 cell-control no-print" id="stocs_cell" style="padding-bottom: 0;">
                                    <p class="p_info stocs no-print" style="margin-bottom: 3px; font-size: 12.5px">
                                        9. Тип продукт (сорт, ако стандартът го посочва)/ Type of product (variety if the standard specifies)
                                    </p>
                                    <table id="table_crop" cellspacing="0" cellpadding="0" style="border: none">
                                        <tbody>
                                            @foreach ($stocks as $k => $stock)
                                            <?php
                                                if(!empty($stock['variety'])) {
                                                    $variety = '<br>('. $stock['variety'] .')';
                                                }
                                                else {
                                                    $variety = '';
                                                }
                                            ?>
                                            <tr>
                                                <td class="crop{{$k}}" style="border: none; padding-left: 5px">
                                                    <p class="p_content bold crop " >
                                                        <span>{{$stock['crops_name']}}</span>/
                                                        <span style="text-transform: none">{{$stock['crop_en']}}</span>
                                                        <span style="text-transform: none">{!! $variety !!}</span>
                                                    </p>
                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                {{-- Pole 10 --}}
                                <td class="cell fourth-row-cell_3 cell-rowspan no-print" >
                                    <p class="p_info no-print" style="margin-bottom: 3px;">
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
                                    <p class="p_content bold quality quality{{$k}}" style="text-transform: none; margin-left: 10px">{{ $class }}</p>
                                    @endforeach
                                </td>
                                {{-- Pole 11 --}}
                                <td class="cell fourth-row-cell_4 cell-control last-cell no-print" >
                                    <p class="p_info no-print" style="margin-bottom: 3px;">
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
                                <td class="fifth-row-cell no-print" >
                                    <p class="p_info "  style="margin-bottom: 8px; margin-top: 20px; font-size: 13px">
                                        <span class="no-print">12. Към момента на издаване на сертификата посочената по-горе пратка съответства на
                                        действащите пазарни стандарти на Европейския съюз/
                                        The consignment referred to above conforms, at the issue time, with the European Union 
                                        marketing standards in force,</span> <br>

                                    </p>
                                    <p class="bold print" style="line-height: 20px; margin-bottom: 10px">R (EC) 2023/2429</p>

                                    <div class="com-md-12" style="display: block; padding-top: 5px">
                                        <p class="" style="font-size: 12.5px;">
                                            <span style="" class="no-print">Предвиждано митническо учреждение/Customs office foresee</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <span class="bold print"> {{$certificate->customs_bg }} / {{$certificate->customs_en }}</span>
                                        </p>
                                    </div>
                                    <div class="com-md-12" style="display: block; padding-top: 5px">
                                        <p class="" style="font-size: 12.5px; display: block; width: 100%; margin-bottom: 11px">
                                            <span style="" class="no-print">Място и дата на издаване/Place and date of issue</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="bold">{{$certificate->place_bg }}</span>/
                                            <span class="bold print">{{$certificate->place_en }}/ {{date('d.m.Y', $certificate->date_issue)}}</span>
                                            <span style="margin-left: 5px" class="no-print"> Валиден до/Valid until: &nbsp;</span>
                                            <span class="bold print" style="float: right; text-align: right">{{$certificate->valid_until }}</span>

                                        </p>
                                    </div>
                                    <p class="fdd" style="font-size: 12.5px; margin-bottom: 10px; margin-top: 15px" id="p_bottom_set">
                                        <span class="no-print">Инспектор (име с главни букви)/Signatory (name in block letters):</span>
                                        <span class="bold print" style="text-transform: uppercase; float: right; padding-right: 50px">{{$certificate->inspector_bg }} / {{$certificate->inspector_en }} </span>
                                    </p>
                                    <p style="font-size: 11.5px;" id="signature" class="no-print">
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
                                <td class="sixth-row-cell cell-rowspan no-print" >
                                    @if ($certificate->type_crops == 2 )
                                        <p class="p_content print" style="text-transform: none; padding-left: 150px">
                                            Сертификатът се издава на основание R (ЕС) 2023/2429.
                                            @if ($certificate->invoice_date > 0)
                                                <span class="print" style="float: right; margin-right: 5px">Ф-ра <span class="bold">{{$certificate->invoice_number}} / {{ date("d.m.Y", $certificate->invoice_date) }} </span> </span>
                                            @endif
                                        </p>

                                        <p class="p_content " style="text-transform: none">
                                            {{$certificate->observations}}
                                        </p>
                                    @else
                                        <p class="p_content" style="text-transform: none; margin-bottom: 4px">
                                            <span class="no-print">13. Бележки/ Observations</span>  {{$certificate->observations}}
                                            @if ($certificate->invoice_date > 0)
                                                <span class="print" style="float: right; margin-right: 5px; margin-top: 8px; padding-top: 5px">Фактура/Invoice <span class="bold">{{$certificate->invoice_number}} / {{ date("d.m.Y", $certificate->invoice_date) }} </span></span>
                                            @endif

                                        </p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="no-print">
                                    <p class="seven-row-cell no-print" style="margin-top: 0 !important; padding: 0; font-size: 0.7em;">
                                        (1) При реекспорт на стоки се посочва произходът им в клетка 9/ Where the goods аrе being re-exported, indicate the origin In box 9.
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="wrap_in_note" class="col-md-12 hidden" >
        <div class="page" >
            <div class="col-md-12_my" id="flip_all_note">
                <div class="col-md-12_my" id="flip_in_note">
                    <div class="col-md-12_my" style="margin: 0 auto">
                        <h3 class="h3_note">Б Е Л Е Ж К А</h3>
                        <p class="top_p">за дейност/услуга, за която се плаща в ОДБХ - Хасково</p>
                        <p class="top_p">гр. Хасково бул. "Освобождение" 57 ИН 176986657 ИН по ЗДДС: BG 176986657</p>
                    </div>

                    {{-- Таблица 1 --}}
                    <table id="first_table_note" style="width:100%;">
                        <tbody>
                            <tr id="first-row_note" >
                                <td class="cell first-row-cell cell_note" style="height: 3cm; width: 6.5cm">
                                    <p class="p_info_note" style="margin-bottom: 3px">
                                        Основанието за плащане да се отбележи със знак<br>
                                        "X"
                                    </p>
                                </td>
                                <td class="cell first-row-cell cell-top cell_note" style="height: 3cm; width: 1.04cm">
                                    <p class="p_info_note" style="margin-bottom: 3px">
                                        Тарифа<br>"X"
                                    </p>
                                </td>
                                <td class="cell first-row-cell cell-top cell_note" style="height: 3cm; width: 2.8cm">
                                    <p class="p_info_note" style="margin-bottom: 3px">Ценоразпис</p>
                                </td>
                                <td class="cell first-row-cell last_cell cell_note last_cell_note" style="height: 3cm; width: 6cm">
                                <p class="p_content_note" style="margin-bottom: 8px">
                                    <span style="text-transform: uppercase;">{{$certificate->forwarder }}</span>
                                    <br>
                                    {{$certificate->forwarder_address }}
                                </p>
                                <p class="p_info_note p_bottom_note" style="margin-bottom: 3px">юридическо или физ. лице, булстат, адрес, МОЛ</p>
                            </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Таблица 2 --}}
                    <table class="table" id="second_table_note">
                        <thead>
                            <tr>
                                <th style="width: 5.4cm">Вид дейност/услуга</th>
                                <th style="width: 2.5cm">
                                    Основание за<br>
                                    плащане
                                </th>
                                <th style="width: 1.4cm; padding: 3px">
                                    Мярка -<br>
                                    бр,кг,тон
                                </th>
                                <th style="width: 1.4cm; padding: 3px">Количес<br>тво</th>
                                <th style="width: 1.4cm">
                                    Ед.<br>
                                    цена
                                </th>
                                <th style="width: 1.4cm">
                                    Стойно<br>ст
                                </th>
                                <th style="width: 1.6cm">
                                    ДДС<br>
                                    20%
                                </th>
                                <th style="width: 1.6cm; padding: 2px">
                                    Обща<br>
                                    стойност<br>
                                    <span style="font-size: 8px">(за плащане)</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <td style="text-align: left;">
                                    Сертификат по ККППЗ №<br>
                                    {{ substr($certificate->stamp_number, 2) }}/{{ $certificate->import }}
                                </td>
                                <td>
                                    @if ($certificate->type_crops == 1)
                                        <span>чл.54 т. 1</span>
                                    @elseif ($certificate->type_crops == 2)
                                        <span>чл.54 т. 2</span>
                                    @else
                                        <span>Error</span>
                                    @endif
                                    
                                </td>
                                <td><span>бр.</span></td>
                                <td><span>1</span></td>
                                <td>
                                    <span>{{ number_format($certificate->base_sum, 2, ',', '' ) }}</span>
                                </td>
                                <td>
                                    <span>{{ number_format($certificate->base_sum, 2, ',', '' ) }}</span>
                                </td>
                                <td><span>0,00</span></td>
                                <td>
                                    <span>{{ number_format($certificate->base_sum, 2, ',', '' ) }}</span>
                                </td>
                            </tr>
                            <tr class="empty_tr">
                                <td></td>
                                <td>
                                    <?php 
                                    if($certificate->percent == 1){
                                        $txt = 'чл.56 т.1';
                                        $br = 'бр.';
                                        $num = '1';
                                        $prcent = '42%';
                                        $sum_prcent = ($certificate->base_sum*42)/100;
                                    }
                                    elseif($certificate->percent == 2){
                                        $txt = 'чл.56 т.2';
                                        $br = 'бр.';
                                        $num = '1';
                                        $prcent = '84%';
                                        $sum_prcent = ($certificate->base_sum*84)/100;
                                    }
                                    else {
                                        $txt = '';
                                        $br = '';
                                        $num = '';
                                        $prcent = '';
                                        $sum_prcent = 0;
                                    }0
                                    ?>
                                    <span>{{ $txt}}</span>
                                </td>
                                <td>{{$br}}</td>
                                <td>{{$num}}</td>
                                <td>{{$prcent}}</td>
                                <td>
                                    @if($sum_prcent != 0)
                                        {{ number_format($sum_prcent, 2, ',', '') }}
                                    @endif
                                </td>
                                <td>
                                    @if($sum_prcent != 0)
                                    0,00
                                    @endif
                                </td>
                                <td>
                                    @if($sum_prcent != 0)
                                        {{ number_format($sum_prcent, 2, ',', '') }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="empty_tr">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="empty_tr">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="empty_tr">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="empty_tr">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="empty_tr">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><span class="bold">ВСИЧКО:</span></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <?php 
                                        if($certificate->type_crops == 1) {
                                            $sum_cert = $sum_import;
                                        }
                                        if($certificate->type_crops == 2) {
                                            $sum_cert = $sum_type;
                                        }
                                        $percent_sum = $sum_prcent;
                                        $total = $sum_cert + $percent_sum ;
                                        if($total = $certificate->sum ) {
                                            $total_sum = $total;
                                        }
                                        else {
                                            $total_sum = 0;
                                        }
                                        
                                    ?>
                                    @if ($total_sum != 0)
                                        <span class="bold">{{ number_format($total_sum, 2, ',', '' ) }}</span>
                                    @else
                                        <span class="bold">грешка</span>
                                    @endif
                                    
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <br>
                <p class="bottom_p" style="font-weight: bold;">За дейностите/услугите, заплащани по ценоразпис се дължи и 20% ДДС.</p>
                <p class="bottom_p" style="font-weight: bold;">
                    <span style="text-decoration: underline">За плащане по банков път:</span>
                    Получател - Областна дирекция по безопасност на храните -
                </p>
                <p class="bottom_p">
                    Банкова сметка:
                    <span class="bold">BG80 IORT 8048 3196 5280 00</span>;
                    Банков код:
                    <span class="bold">IORTBGSF</span>;
                    Банка:
                    <span class="bold">Инвестбанк АД</span>
                </p>
                <br>
                <p>
                    Изготвил: <span class="bold">{{$certificate->inspector_bg }}</span>
                    <span class="bold inspector_signature" >Подпис: . . . . . . . . . . . . . . . .</span>
                </p>
                <p class="inspector_info">
                    <span class="inspector_nfo">(име фамилия)</span>
                    <span class="bold inspector_signature" >(подпис)</span>
                </p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- ПЪРВОНАЧАЛНИТЕ НАСТРОЙКИ СА ЗАДАДЕНИ В  flipText.js --}}

    {!!Html::script("js/quality/flipText_next.js" )!!}

    <script>
        $(document).ready(function(){
            $("#btn_archive").click(function(){
                $('.archive').addClass('hidden');
                // $('#wrap_sum').addClass('hidden');
                $('.client').removeClass('hidden');
                $('#wrap_in').addClass('hidden');
                $('#wrap_in_note').removeClass('hidden');
            });

            $("#btn_client").click(function(){
                $('.client').addClass('hidden');
                $('.archive').removeClass('hidden');
                $('#wrap_in').removeClass('hidden');
                $('#wrap_in_note').addClass('hidden');
                // $('#wrap_sum').removeClass('hidden');
            });
        });

        $(document).ready(function(){
            // var sum = $("input[name='sum']").val();
            // var last_sum = $("input[name='last_sum']").val();

            // $("#sumField").on("input", function(){
            //     // Print entered value in a div box
            //     $("#sumField").text($(this).val());
            //     $("#percent0").attr('checked', 'checked');
            //     // $(".radioBtnClass").text($(this).val());
            //     var sum = $("input[name='sum']").val();
            //     // alert("The text has been changed.");
            // });
            // // $("#sumField").change(function(){
            // //     alert("The text has been changed.");
            // // });

            // console.log(sum);
            // $(".radioBtnClass") // select the radio by its id
            // .change(function(){ // bind a function to the change event
            //     if( $(this).is(":checked") ){ // check if the radio is checked
            //         var val = $(this).val(); // retrieve the value
            //         if(val == 0) {
            //             total_sum = sum;
            //         }
            //         if(val == 1) {
            //             total_sum = parseInt(sum) + (sum*42)/100;
            //         }
            //         if(val == 2) {
            //             total_sum = parseInt(sum) + (sum*84)/100;
            //         }
            //     }
                
            //     // var tal = parseInt(total_sum.val()) || 0;
            //     // if(isNaN (total_sum)) {
            //     //     total_sum = last_sum;
            //     // }
            //     console.log(isNaN (total_sum));
            //     $('#sumField').val(total_sum);
            // });
            
        });
    </script>
@endsection
