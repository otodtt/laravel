@extends('layouts.quality')
@section('title')
    {{ 'Идентификация' }}
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
        <a href="{!! URL::to('/контрол/вносители/'.$certificate->importer_id.'/show')!!}" class="fa fa-user btn btn-success my_btn my_float"> Към Фирмата!</a>
        <a href="{!! URL::to('/контрол/идентификация')!!}" class="fa fa-certificate btn btn-info my_btn my_float" style="margin-left: 5px"> Към сертификати внос!</a>
        @if ($certificate->what_7 == 2)
            <h4 class="bold title_doc" >СЕРТИФИКАТ ЗА ВНОС</h4>
        @elseif ($certificate->what_7 == 3)
            <h4 class="bold title_doc" >СЕРТИФИКАТ ЗА ИЗНОС</h4>
        @elseif ($certificate->what_7 == 4)
            <h4 class="bold title_doc" >ПРОВЕРКА И ИДЕНТИФИКАЦИЯ</h4>
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
                        <p >Сертификат №: <span class="bold">{{$certificate->stamp_number }}/{{$certificate->id }}</span></p>
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
                    <?php //echo $certificate->sum ?>
                    @if($certificate->invoice_id != 0)
                        <div class="col-md-2">
                            <p >
                                Фактура: <span class="bold" style="text-transform: uppercase"></span>
                                <a href='/контрол/фактури-идентификация/{{$certificate->invoice_id}}/edit' class="fa fa-edit btn btn-success my_btn" style="float: right"> Edit</a>
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
                            @if($certificate->invoice_id == 0)
                                <p >
                                    <a href='/контрол/фактури-идентификация/{{$certificate->id}}' class="fa fa-plus-circle btn btn-danger my_btn"> Add</a>
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            
            @if($certificate->is_lock == 0)
                <div class=" col-md-12 row-table-bottom " style="display: table" id="wrap_sum">
                    <div  class=" small_field_bottom print-button" >
                        {!! Form::open(['url'=>'identification/add-sum/store/'.$certificate->id, 'method'=>'POST', 'autocomplete'=>'on']) !!}
                            <p style="font-weight: normal"><span class="bold" style="text-transform: none; color: red">ВНИМАНИЕ!!!</span>
                                Провери дали данните са коректни и тогава натисни бутона - <span class="bold">"ПОДГОТВИ БЕЛЕЖКА"</span>
                            </p>
                            <hr class="my_hr_in"/>
                            <p style="font-weight: normal; display: inline-block;">
                                СПЕДИТОР - <span class="bold">{{$certificate->forwarder}}</span> и
                                Идентификация на транспортните средства - <span class="bold">{{$certificate->transport}}</span>.
                            </p>

                            <div class="btn_add" style="text-align: left; display: inline-block; margin-top: 5px; width: 100%">
                                <?php

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
                                ?>
                                {!! Form::label('sum', 'Сума за плащане:', ['class'=>'my_labels']) !!}
                                <span>20 лв.</span>
                                &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                                {!! Form::label('percent0', 'Без добавн процент', ['class'=>'my_labels']) !!}
                                {!! Form::radio('percent', '0' , $percent0, ['id' => 'percent0', 'class'=>'radioBtnClass']) !!}
                                &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                                {!! Form::label('percent1', '42%', ['class'=>'my_labels']) !!}
                                {!! Form::radio('percent', '1' , $percent1, ['id' => 'percent1', 'class'=>'radioBtnClass']) !!}
                                &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                                {!! Form::label('percent2', '84%', ['class'=>'my_labels']) !!}
                                {!! Form::radio('percent', '2' , $percent2, ['id' => 'percent2', 'class'=>'radioBtnClass']) !!}
                                <button type="submit" class="btn-sm btn-info " id="add_sum_btn" style="margin-left: 50px; margin-top: 5px">
                                    <i class="fa fa-dollar"></i> ПОДГОТВИ БЕЛЕЖКА!
                                </button>
                            </div>
                            <input type="hidden" name="sum" value="{{$sum_import}}" id="sum">
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
                                <a href="{!!URL::to('/контрол/идентификация/'.$certificate->id.'/edit')!!}" class="fa fa-edit btn btn-primary">  Редактирай Данните</a>
                            </div>
                            <div class="btn_add" style="float: right; display: inline-block; margin-top: 5px">
                                <a href="{!!URL::to('/identification/stock/'.$certificate->id.'/0/edit')!!}" class="fa fa-edit btn btn-danger">  Редактирай Стоките</a>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            <div class="col-md-12 row-table-bottom " style="display: table" >
                @if($certificate->is_lock == 0)
                    <div class="small_field_bottom" style="display: table-cell">
                        {!! Form::model($certificate, ['url'=>'lock-identification/'.$certificate->id , 'method'=>'POST', 'id'=>'form']) !!}
                        <button type="submit" class="btn-sm btn-default " id="complexConfirm"  >
                            <i class="fa fa-print"></i> Подготви за печат!
                        </button>
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                        <input type="hidden" name="is_sum" value="{{$certificate->sum}}" id="is_sum">
                        {!! Form::close() !!}
                    </div>
                    <div class="small_field_bottom" style="display: table-cell">
                        <p ><span class="red bold"><i class="fa fa-warning"></i>
                            ВНИМАНИЕ!!</span> Ако данните са коректни, за да се отпечата Бележката трябва да се натисне бутона "Подготви за печат!".<br/>
                            След което, няма да могат да се правят повече промени по Бележката!!! </p>
                    </div>
                @else
                    <div class="small_field_bottom" style="display: table-cell">
                        <p class="bold">Проверката е заключена и не може да се редактира повече.</p>
                    </div>
                    @if(Auth::user()->admin == 2 || Auth::user()->dlaznost == 1 || Auth::user()->id == $certificate->added_by )
                        <div class="small_field_bottom" style="display: table-cell">
                            {!! Form::model($certificate, ['url'=>'unlock-identification/'.$certificate->id , 'method'=>'POST', 'id'=>'form']) !!}
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



    <div id="wrap_in_note" class="col-md-12">
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
                                    <br>
                                    {{$certificate->transport }}
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
                                    Проверка по ККППЗ №<br>
                                    {{ substr($certificate->stamp_number, 2) }}/{{ $certificate->id }}
                                </td>
                                <td>
                                    <span>чл. 54 т. 1 .1</span>
                                </td>
                                <td><span>бр.</span></td>
                                <td><span>1</span></td>
                                <td>
                                    <span>{{ number_format($certificate->checking, 2, ',', '' ) }}</span>
                                </td>
                                <td>
                                    <span>{{ number_format($certificate->checking, 2, ',', '' ) }}</span>
                                </td>
                                <td><span>0,00</span></td>
                                <td>
                                    <span>{{ number_format($certificate->checking, 2, ',', '' ) }}</span>
                                </td>
                            </tr>
                            <tr class="empty_tr">
                                <td></td>
                                <td>
                                    <span>чл. 54 т. 1 .2</span>
                                </td>
                                <td>бр.</td>
                                <td>1</td>
                                <td>{{ number_format($certificate->identification, 2, ',', '') }}</td>
                                <td>
                                    {{ number_format($certificate->identification, 2, ',', '') }}
                                </td>
                                <td>
                                    0,00
                                </td>
                                <td>
                                    {{ number_format($certificate->identification, 2, ',', '') }}
                                </td>
                            </tr>
                            <tr class="empty_tr">
                                <td></td>
                                <td>
                                    <?php
                                    if($certificate->percent == 1){
                                    $txt = 'чл. 56 т. 1';
                                    $br = 'бр.';
                                    $num = '1';
                                    $prcent = '42%';
                                    $sum_prcent = ($certificate->base_sum*42)/100;
                                    }
                                    elseif($certificate->percent == 2){
                                    $txt = 'чл. 56 т. 2';
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
                                    <span class="bold">{{ number_format($certificate->sum, 2, ',', '' ) }}</span>
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
                    <span class="bold">BG83 CECB 979031I7 5800 00</span>;
                    Банков код:
                    <span class="bold">CECBBGSF</span>;
                    Банка:
                    <span class="bold">ЦКБ АД</span>
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
    
    {{-- {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!} --}}
    {{-- {!!Html::script("js/date/in_date.js" )!!} --}}
    {{-- {!!Html::script("js/opinions/clientDocument.js" )!!} --}}
    {!!Html::script("js/quality/flipText.js" )!!}
    {{-- {!!Html::script("js/opinions/addressFlip.js" )!!} --}}

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
