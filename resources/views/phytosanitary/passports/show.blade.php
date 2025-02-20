@extends('layouts.phyto')
@section('title')
    {{ 'ОПЕРАТОР Информация' }}
@endsection

@section('css')
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/qcertificates/show_opinion.css" )!!}
{{--    {!!Html::style("css/qcertificates/body_table.css" )!!}--}}
    {!!Html::style("css/certificates/index_certificates.css" )!!}

    <style>
        #registration_order {
             width: 15%;
             display: inline-block;
         }
        #date_order {
            width: 15%;
            display: inline-block;
        }
        #deletion{
            width: 15%;
            display: inline-block;
        }
        #deletion_date {
            width: 15%;
            display: inline-block;
        }
    </style>
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="info-wrap">
        {{--@if ($operator->type_firm == 0 && $operator->trader_id > 0 && $operator->farmer_id == 0)--}}
            {{--<a href="{!! URL::to('/контрол/търговци/'.$operator->trader_id.'/show')!!}" class="fa fa-user btn btn-success my_btn my_float"> Към Фирмата Търговец!</a>--}}
        {{--@else--}}
            <a href="{!! URL::to('/стопанин/'.$operator->farmer_id)!!}" class="fa fa-user btn btn-success my_btn my_float"> Към Земеделеца!</a>
        {{--@endif--}}

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
        <fieldset class="big_field" style="padding-bottom: 10px">
            <div class="row-height-my col-md-12" style="display: table">
                <div style="display: table-row">
                    <div class="small_field_right top_info" style="display: table-cell" >
                        <span class="span-firm-info"><i class="fa fa-user "></i> ДАННИ НА ТЪРГОВЕЦА ИЛИ ЗЕМЕДЕЛСКИЯ ПРОИЗВОДИТЕЛ</span>
                    </div>
                    <div class="small_field_center top_info" style="display: table-cell" >
                        <span class="span-firm-info"><i class="fa fa-edit "></i> РЕДАКТИРАНЕ, АКТУАЛИЗАЦИЯ НАДАННИ ЗА ЗАЯВЛЕНИЕТО</span>
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
                                $for = 'Фирма ЗС:';
                                $vin = 'ЕИК/Булстат:';
                            }
                            elseif($operator->type_firm == 3) {
                                $front = '';
                                $after = 'ООД';
                                $for = 'Фирма ЗС:';
                                $vin = 'ЕИК/Булстат:';
                            }
                            elseif($operator->type_firm == 4) {
                                $front = '';
                                $after = 'ЕООД';
                                $for = 'Фирма ЗС:';
                                $vin = 'ЕИК/Булстат:';
                            }
                            elseif($operator->type_firm == 5) {
                                $front = '';
                                $after = 'АД';
                                $for = 'Фирма ЗС:';
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
                                <hr class="my_hr_in"/>
                                <p >Адрес: <span class="bold">{{$operator->address }}</span></p>
                                <hr class="my_hr_in"/>
                                <p >ЕИК/Булстат: <span class="bold">{{$operator->pin }}</span> </p>
                                <hr class="my_hr_in"/>
                                <p >GSM: <span class="bold">{{$farmer['mobil'] }}</span> </p>
                        @elseif($operator->farmer_id == 0 && $operator->trader_id > 0)
                            <p >Търговец: <span class="bold" style="text-transform: uppercase">{{$operator->name_operator}} </span></p>
                            <p >ЕИК/Булстат: <span class="bold">{{$operator->pin }}</span> </p>
                            <hr class="my_hr_in"/>
                            <p >Адрес: <span class="bold">{{$operator->address }}</span></p>
                        @endif
                        <hr class="my_hr_in"/>
                    </div>
                    <div class="small_field_center" style="display: table-cell">
                        @if($operator->is_lock == 0)
                            @if ($operator->farmer_id > 0 && $operator->trader_id == 0 )
                                <p style="padding: 3px 0 5px 0" >
                                    <span class="bold" style="color: red">ВНИМАНИЕ!</span> Ако е необходимо да се редактират данните на
                                    ЗС отиди в регистъра и ги редактирай там!
                                    <a style="float: right" href="{!! URL::to('/стопанин/'.$operator->farmer_id)!!}" class="fa fa-user btn btn-success my_btn my_float"> Към Земеделеца!</a>
                                </p>
                                <hr class="my_hr_in"/>
                                <p style="padding: 3px 0 5px 0" >
                                    <span class="bold" style="color: red">ВНИМАНИЕ!</span> Ако е необходимо да се редактират данните на Заявлението!
                                    <a style="float: right" href="{!! URL::to('/фито/оператор/edit/'.$operator->id)!!}" class="fa fa-edit btn btn-danger my_btn my_float">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Редактирай!</a>
                                </p>
                            @elseif($operator->farmer_id == 0 && $operator->trader_id > 0)
                                <p style="padding: 3px 0 5px 0" >
                                    <span class="bold" style="color: red">ВНИМАНИЕ!</span> Ако е необходимо да се редактират данните на
                                    ТЪРГОВЕЦА отиди в регистъра и ги редактирай там!
                                    <a style="float: right" href="{!! URL::to('/фито/търговец/покажи/'.$operator->trader_id)!!}" class="fa fa-user btn btn-info my_btn my_float"> Към Търговеца!</a>
                                </p>
                                <hr class="my_hr_in"/>
                                <p style="padding: 3px 0 5px 0" >
                                    <span class="bold" style="color: red">ВНИМАНИЕ!</span> Ако е необходимо да се редактират данните на Заявлението!
                                    <a style="float: right" href="{!! URL::to('/фито/търговец/reg_edit/'.$operator->id)!!}" class="fa fa-edit btn btn-danger my_btn my_float">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Редактирай!</a>
                                </p>
                            @endif


                            <hr class="my_hr_in"/>
                        @else
                            <p style="padding: 3px 0 5px 0" >
                                <span class="bold" style="color: red">ВНИМАНИЕ</span> Веднъж добавен Регистрационния номер, Оператора не може повече да се редактира!
                            </p>
                            {{--<hr class="my_hr_in"/>--}}
                            <hr class="my_hr_in"/>
                            <p style="padding: 3px 0 5px 0" >
                                Ако е необходимо да се редактира все пак нещо натисни бутона "ОТКЛЮЧИ"!
                            </p>
                            <hr class="my_hr_in"/>
                        @endif
                        <hr class="my_hr_in"/>
                        <p style="padding-top: 10px">Ако има подадено заявление за Актуализация на данни, натисни БУТОНА ЗА АКТУАЛИЗАЦИЯ по-долу!</p>
                    </div>
                </div>
                <div class="small_field_center" style="display: table-cell">
                    <p style="margin-bottom: 10px">НОМЕР И ДАТА НА ЗАЯВЛЕНИЕТО: <span class="bold" style="text-transform: none">{{$operator->number_petition }}/{{ date('d.m.Y', $operator->date_petition)  }}</span></p>
                    <hr class="my_hr_in"/>
                    <hr class="my_hr_in"/>
                    @if($operator->registration_number != 0)
                        <p >РЕГИСТРАЦИОНЕН НОМЕР И ДАТА: <span class="bold" style="text-transform: none">{{$operator->registration_number }}/{{ date('d.m.Y', $operator->registration_date)  }}</span></p>
                        <hr class="my_hr_in"/>
                        @if($operator->registration_order == 0 && $operator->date_order == 0)
                            <p >НОМЕР И ДАТА НА ЗАПОВЕДТА: <span class="bold" style="text-transform: none">Няма. Стари записи</span></p>
                        @else
                            <p >НОМЕР И ДАТА НА ЗАПОВЕДТА: <span class="bold" style="text-transform: none">{{$operator->registration_order }}/{{ date('d.m.Y', $operator->date_order)  }}</span></p>
                        @endif
                    @else
                        <p style="color: red"> ВСЕ ОЩЕ НЕ Е ВЪВЕДЕН РЕГИСТРАЦИОННИЯ НОМЕР И ДАТАТА</p>
                        <hr class="my_hr_in"/>
                        <p style="color: red"> ВСЕ ОЩЕ НЕ Е ВЪВЕДЕНА ЗАПОВЕДТТА ЗА РЕГИСТРАЦИЯ</p>
                    @endif
                    <hr class="my_hr_in"/>
                    <?php echo($operator->accepted_name); ?>
                    <p >Инспектор приел документите: <span class="bold" style="text-transform: none">{{$operator->accepted_name }}</span></p>
                    <hr class="my_hr_in"/>
                </div>
                <div class="small_field_center" style="display: table-cell">
                    <div class="row">
                        @if($operator->is_lock == 0)
                            <div class="col-md-10">
                                <p style="">Ако актуализацията касе данните на ЗС или Търговец редактирай в регистъра, след което тук</p>
                            </div>
                            <div class="col-md-2">
                                <p>
                                    <a style="margin-left: 5px" href="{!! URL::to('/фито/оператор/edit_data/'.$operator->id)!!}" class="fa fa-edit btn btn-info my_btn">&nbsp;&nbsp;&nbsp;&nbsp;  ТУК!</a>
                                </p>
                            </div>
                        @else
                            <div class="col-md-10">
                                <p style="font-weight: bold">ОТКЛЮЧИ ако е необходима актуализацията!</p>
                            </div>
                        @endif
                    </div>
                    <hr class="my_hr_in"/>
                    <hr class="my_hr_in"/>
                    @if($operator->registration_number != 0)
                        @if($operator->is_lock == 1)
                            <p style="font-weight: bold">АКО Е НЕОБХОДИМО ДА СЕ РЕДАКТИРА НОМЕРА И ДАТАТА НА ЗАПОВЕДТА НАТИСНИ БУТОНА "Отключи"</p>
                            <hr class="my_hr_in"/>
                        @else
                            <p style="font-weight: bold">АКО Е НЕОБХОДИМО ДА СЕ РЕДАКТИРА НОМЕРА И ДАТАТА НА ЗАПОВЕДТА</p>
                            <hr class="my_hr_in"/>
                            <?php
                                if($operator->date_order > 0) {
                                    $date = date('d.m.Y', $operator->date_order);
                                } else {
                                    $date = null;
                                }
                            ?>
                            {!! Form::model($operator, ['url'=>'фито/оператор/заповед/update/'.$operator->id, 'method'=>'POST', 'autocomplete'=>'on']) !!}
                            <div class="col-md-12 " style="display: inline-block; border-bottom: 2px solid white; padding-bottom: 5px; padding-top: 5px">
                                {!! Form::label('registration_order', 'Заповед №', ['class'=>'my_labels']) !!}
                                {!! Form::text('registration_order', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6, 'id'=>'registration_order' ]) !!}
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                {!! Form::label('date_order', 'Дата:', ['class'=>'my_labels']) !!}
                                {!! Form::text('date_order', $date, ['class'=>'form-control form-control-my date_certificate',
                                'id'=>'date_order', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off' ]) !!}

                                {!! Form::submit('Редактирай!', ['class'=>'btn btn-sm btn-danger', 'id'=>'submit']) !!}
                            </div>
                            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                            {!! Form::close() !!}
                        @endif
                    @else
                        <p style="font-weight: bold">ДОБАВИ НОМЕР И ДАТА НА ЗАПОВЕДТА. РЕГИСТРАЦИОННИЯ НОМЕР И ДАТАТА МУ ЩЕ СЕ ДОБАВЯТ АВТОМАТИЧНО</p>
                        {!! Form::open(['url'=>'фито/оператор/заповед/store/'.$operator->id, 'method'=>'POST', 'autocomplete'=>'on']) !!}
                        <div class="col-md-12 " style="display: inline-block; border-bottom: 2px solid white; padding-bottom: 5px; padding-top: 5px">
                            {!! Form::label('registration_order', 'Заповед №', ['class'=>'my_labels']) !!}
                            {!! Form::text('registration_order', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6, 'id'=>'registration_order' ]) !!}
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            {!! Form::label('date_order', 'Дата:', ['class'=>'my_labels']) !!}
                            {!! Form::text('date_order', null, ['class'=>'form-control form-control-my date_certificate',
                            'id'=>'date_order', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off' ]) !!}

                            {!! Form::submit('Добави!', ['class'=>'btn btn-sm btn-info', 'id'=>'submit']) !!}
                        </div>
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
            <div class="row-height-my col-md-12" style="display: table;">
                <div  class="small_field_center" style="display: table-cell; width: 50%; text-align: center; margin-right: 2px">
                    <div class="col-md-6" >
                        <div  class="archive print-button" >
                            <button id="btn_archive" class="btn-sm"><i class="fa fa-print"></i> Покажи УДОСТОВЕРЕНИЕ ЗА РЕГИСТРАЦИЯ</button>
                        </div>
                        <div  class="hidden client print-button" style="display: inline-block">
                            <button id="btn_client" class="btn-sm" ><i class="fa fa-print"></i> Към Заявлението</button>
                        </div>
                    </div>
                    <div class="col-md-6">
{{--                        @if((Auth::user()->id == $operator->added_by && $operator->is_lock == 1) || (Auth::user()->admin == 2 && $operator->is_lock == 1) )--}}
                        @if((Auth::user()->fsk == 1 && $operator->is_lock == 1) || (Auth::user()->admin == 2 && $operator->is_lock == 1) )
                            <div class="print-button" style="display: inline-block; text-align: center">
                                {!! Form::model($operator, ['url'=>'unlock-operator/'.$operator->id , 'method'=>'POST', 'id'=>'form']) !!}
                                <button type="submit" class="btn-sm btn-danger " id="unlockConfirm">
                                    <i class="fa fa-unlock"></i> Отключи!
                                </button>
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                                {!! Form::close() !!}
                            </div>
                        @endif
{{--                        @if((Auth::user()->id == $operator->added_by && $operator->is_lock != 1) || (Auth::user()->admin == 2 && $operator->is_lock != 1) )--}}
                        @if((Auth::user()->fsk == 1 && $operator->is_lock != 1) || (Auth::user()->admin == 2 && $operator->is_lock != 1) )
                            <div class="print-button" style="display: inline-block; text-align: center">
                                {!! Form::model($operator, ['url'=>'lock-operator/'.$operator->id , 'method'=>'POST', 'id'=>'form']) !!}
                                <button type="submit" class="btn-sm btn-success " id="unlockConfirm">
                                    <i class="fa fa-lock"></i> Заключи!
                                </button>
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                                {!! Form::close() !!}
                            </div>
                        @endif
                    </div>
                </div>
                <div  class="small_field_center" style="display: table-cell; width: auto">
                    @if((Auth::user()->id == $operator->added_by && $operator->is_lock == 1) || Auth::user()->admin == 2 && $operator->is_lock == 1)
                        <p style="font-weight: bold">АКО Е НЕОБХОДИМО ДА СЕ РЕДАКТИРА НОМЕРА И ДАТАТА НА ЗАПОВЕДТА ЗА ЗАЛИЧАВАНЕ НАТИСНИ БУТОНА "Отключи"</p>
                    @else
                        @if($operator->deletion >0 && $operator->deletion_date)
                            <p style="font-weight: bold">РЕДАКТИРАЙ АКО Е НЕОБХОДИМО</p>
                            {!! Form::model($operator, ['url'=>'фито/оператор/заповед/destroy/'.$operator->id, 'method'=>'POST', 'autocomplete'=>'on']) !!}
                            <div class="col-md-12 " style="display: inline-block; border-bottom: 2px solid white; padding-bottom: 5px; padding-top: 5px">
                                <?php
                                    if($operator->deletion > 0 && $operator->deletion_date > 0){
                                        $deletion_date= date('d.m.Y', $operator->deletion_date);
                                    }
                                    else{
                                        $deletion_date = null;
                                    }
                                ?>
                                {!! Form::label('deletion', 'Заповед №', ['class'=>'my_labels']) !!}
                                {!! Form::text('deletion', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6, 'id'=>'deletion' ]) !!}
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                {!! Form::label('deletion_date', 'Дата:', ['class'=>'my_labels']) !!}
                                {!! Form::text('deletion_date', $deletion_date, ['class'=>'form-control form-control-my date_certificate',
                                'id'=>'deletion_date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off', '' ]) !!}

                                {!! Form::submit('РЕДАКТИРАЙ ЗАЛИЧИ!', ['class'=>'btn btn-sm btn-danger', 'id'=>'submit']) !!}
                            </div>
                            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                            {!! Form::close() !!}
                        @else
                            <p style="font-weight: bold">ДОБАВИ НОМЕР И ДАТА НА ЗАПОВЕДТА ЗА ЗАЛИЧАВАНЕ</p>
                            {!! Form::open(['url'=>'фито/оператор/заповед/destroy/'.$operator->id, 'method'=>'POST', 'autocomplete'=>'on']) !!}
                            <div class="col-md-12 " style="display: inline-block; border-bottom: 2px solid white; padding-bottom: 5px; padding-top: 5px">
                                {!! Form::label('deletion', 'Заповед №', ['class'=>'my_labels']) !!}
                                {!! Form::text('deletion', null, ['class'=>'form-control form-control-my', 'size'=>2, 'maxlength'=>6, 'id'=>'deletion' ]) !!}
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                {!! Form::label('deletion_date', 'Дата:', ['class'=>'my_labels']) !!}
                                {!! Form::text('deletion_date', null, ['class'=>'form-control form-control-my date_certificate',
                                'id'=>'deletion_date', 'size'=>15, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг', 'autocomplete'=>'off', '' ]) !!}

                                {!! Form::submit('ЗАЛИЧИ!', ['class'=>'btn btn-sm btn-default', 'id'=>'submit']) !!}
                            </div>
                            <input  type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                            {!! Form::close() !!}
                        @endif
                    @endif
                </div>
            </div>
        </fieldset>
    </div>

    <div id="wrap_in" class="col-md-12 ">
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

                                    ?>
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
                                    @if($operator->update_number > 0 && $operator->update_date > 0)
                                        <i class="fa fa-check-square-o" aria-hidden="true" style="font-size: 30px; margin-left: 10px"></i>
                                        Актуализация на данни
                                    @else
                                        <i class="fa fa-square-o" aria-hidden="true" style="font-size: 30px; margin-left: 10px"></i>
                                        Актуализация на данни
                                    @endif
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
                                        <?php
                                            if($operator->id >= 1 && $operator->id <= 9){
                                                $nulls = '000';
                                            }
                                            elseif($operator->id >= 10 && $operator->id <= 90){
                                                $nulls = '00';
                                            }
                                            elseif($operator->id >= 100 ){
                                                $nulls = '0';
                                            }
                                            else {
                                                $nulls = '';
                                            }
                                        ?>
                                        <p style="padding-bottom: 20px; font-weight: bold">
                                            {{$operator_index[0]['operator_index_bg']}}-{{$nulls.$operator->registration_number }}
                                            /{{date('d.m.Y', $operator->registration_date)}} г.
                                        </p>
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

    <div id="wrap_in_note" class="col-md-12 hidden">
        <div class="page" >
            <div class="col-md-12_my" id="flip_all_note">
                <div class="col-md-12_my" id="flip_in_note">
                    <div class="col-md-12_my" style="margin-left: 2cm; border: 1px solid black; height: 16cm">
                        <div style="margin: 0 auto;">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <p class="p-info" style="font-size: 12px">
                                    Приложение № 4 към Заповед № РД 11-1601/09.07.2020 г.<br>
                                    на изпълнителния директор на БАБХ
                                </p>
                            </div>
                            <div class="row" style="width: 90%;  margin: 0 auto;">
                                <div class="col-md-12" style="margin: 0 auto; margin-top: 50px">
                                    <div class="page_logo" style="margin-top: 20px">
                                        <div class="only_certificate" style="">
                                            <div class="" style="; display: inline-block;  height: 90px; float: left">
                                                <img src="{!! URL::to('/img/logo_3.png')!!}" alt="logo" style="height: 90px; margin-right: 15px"/>
                                            </div >
                                            <div  style="display: inline-block; height: 90px; margin: 0 auto; padding: 15px 0 0 0; ; font-size: 16px " >
                                                <p style="font-family: 'Times New Roman'; font-size: 1em; margin-left: 30px" id="" class="bold">Министерство на земеделието и храните</p>
                                                <p style="font-family: 'Times New Roman'; font-size: 1em; margin-left: 30px" id="" class="bold">Българска агенция по безопасност на храните</p>
                                                <p style="font-family: 'Times New Roman'; font-size: 1em; margin-left: 30px; " id="" class="bold">Областна дирекция по безопасност на храните - Гр. {{ $index[0]['odbh_city'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div  class="row" style="width: 100%;  margin: 0 auto; margin-top: 50px">
                                <div style="text-align: center; font-size: 16px">
                                    <p style="font-weight: bold;">УДОСТОВЕРЕНИЕ ЗА РЕГИСТРАЦИЯ </p>
                                    <p style="font-weight: bold">в Официалния регистър на професионалните оператори,</p>
                                    <p style="font-weight: bold">извършващи дейност/и с растения, растителни продукти и други обекти</p>
                                        <?php
                                            if($operator->registration_number > 0) {
                                                if($operator->id >= 1 && $operator->id <= 9){
                                                    $nulls = '000';
                                                }
                                                elseif($operator->id >= 10 && $operator->id <= 90){
                                                    $nulls = '00';
                                                }
                                                elseif($operator->id >= 100 ){
                                                    $nulls = '0';
                                                }
                                                else {
                                                    $nulls = '';
                                                }
                                                $reg_number_all = $nulls.$operator->registration_number ;

                                                $stri = (string)$reg_number_all;
                                                $d = $stri[0];
                                                $c = $stri[1];
                                                $b = $stri[2];
                                                $a = $stri[3];
                                            } else {
                                                $d = '';
                                                $c = '';
                                                $b = '';
                                                $a = '';
                                            }

                                            if($operator->type_firm == 0) {
                                                $front = '';
                                                $after = '';
                                            }
                                            elseif($operator->type_firm == 1) {
                                                $front = '';
                                                $after = '';
                                            }
                                            elseif($operator->type_firm == 2) {
                                                $front = 'ЕТ ';
                                                $after = '';
                                            }
                                            elseif($operator->type_firm == 3) {
                                                $front = '';
                                                $after = ' ООД';
                                            }
                                            elseif($operator->type_firm == 4) {
                                                $front = '';
                                                $after = ' ЕООД';
                                            }
                                            elseif($operator->type_firm == 5) {
                                                $front = '';
                                                $after = ' АД';
                                            }
                                            elseif($operator->type_firm == 6) {
                                                $front = '';
                                                $after = '';
                                            }
                                            else {
                                                $front = '';
                                                $after = '';
                                            }
                                        ?>
                                    <table style="margin: 0 auto; margin-top: 20px">
                                        <tbody>
                                            <tr>
                                                <td style="border: 1px solid black; width: 1cm; height: .8cm; font-weight: bold ">
                                                    <span style="margin-right: 5px">№</span>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle">
                                                    <span style="margin-right: 5px; font-weight: bold">{{$operator_index[0]['operator_index_not']}}</span>
                                                </td>
                                                <td style="width: 1cm; font-weight: bold">{{$d}}</td>
                                                <td style="width: 1cm; font-weight: bold">{{$c}}</td>
                                                <td style="width: 1cm; font-weight: bold">{{$b}}</td>
                                                <td style="width: 1cm; font-weight: bold">{{$a}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div  class="row" style="width: 100%;  margin: 0 auto; margin-top: 25px">
                                <div style="width: 100%; text-align: center">
                                    @if($operator->farmer_id > 0 && $operator->trader_id == 0)
                                        @if($operator->type_firm == 0 || $operator->type_firm == 1)
                                            <p style="font-weight: bold; font-size: 16px">Издава се на: <span>{{$operator->name_operator}} - {{$operator->tvm.' '.$operator->city}}</span></p>
                                        @else
                                            <p style="font-weight: bold; font-size: 16px">Издава се на: <span style="font-weight: bold">{{$front}}"{{$operator->name_operator}}"{{$after}} - {{$operator->tvm.' '.$operator->city}}</span></p>
                                        @endif
                                    @elseif($operator->farmer_id == 0 && $operator->trader_id > 0)
                                        <p style="font-weight: bold; font-size: 16px">Издава се на: <span>{{$operator->name_operator}} - {{$trader->city}}</span></p>
                                    @endif
                                    <p style="font-size: 12px">(АД, ЕООД, ООД, ЕТ, Физическо лице, др.)</p>
                                </div>
                            </div>
                            <div  class="row" style="width: 100%;  margin: 0 auto; margin-top: 25px; padding-left: 10px">
                                <div class="col-md-6">
                                    <p style="font-weight: bold">Дата: {{date('d.m.Y', $operator->registration_date)}} г.</p>
                                </div>
                                <div class="col-md-6">
                                    <p style="font-weight: bold">Директор: ..................................</p>
                                    <p style="font-size: 12px">(подпис, печат)</p>
                                </div>
                            </div>
                            <div  class="row" style="width: 100%;  margin: 0 auto; margin-top: 25px; padding-left: 10px">
                                <div class="col-md-12">
                                    <p style="font-weight: bold">
                                        Удостоверението за регистрация се предоставя на официалните власти при осъществяване на фитосанитарен контрол.
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/sanitary/date_issue.js" )!!}

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
    </script>

@endsection