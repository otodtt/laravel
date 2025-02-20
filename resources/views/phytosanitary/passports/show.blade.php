@extends('layouts.phyto')
@section('title')
    {{ 'ПАСПОРТ Информация' }}
@endsection

@section('css')
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/qcertificates/show_opinion.css" )!!}
    {!!Html::style("css/certificates/index_certificates.css" )!!}

    {!!Html::style("css/qcertificates/print.css", array('media' => 'print'))!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="info-wrap">
        @if ($passport->is_farmer > 0 )
            <a href="{!! URL::to('/стопанин/'.$passport->is_farmer)!!}" class="fa fa-user btn btn-success my_btn my_float"> Към Земеделеца!</a>
        @endif

        <a href="{!! URL::to('/фито/паспорти')!!}" class="fa fa-certificate btn btn-info my_btn my_float" style="margin-left: 5px"> Към регистъра!</a>

            <h4 class="bold title_doc" >ДАННИ НА ПАСПОРТА</h4>

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
                        <span class="span-firm-info"><i class="fa fa-address-card "></i> ПОСОЧЕНО ЛИ Е ID НА ЗЕМЕДЕЛЕЦА</span>
                    </div>
                    <div class="small_field_center top_info" style="display: table-cell" >
                        <span class="span-firm-info"><i class="fa fa-edit "></i> ВПИСАН ЛИ Е В РЕГИСТЪРА НА П ОПЕРАТОРИ</span>
                    </div>
                </div>
            </div>
            <div style="display: table-row">
                <div class="small_field_left " style="display: table-cell">
                    <p ><span class="bold" style="text-transform: uppercase">{{$passport->manufacturer }}</span></p>
                    <hr class="my_hr_in"/>
                    <p >Град: <span class="bold">{{$passport->city }}</span></p>
                    <hr class="my_hr_in"/>
                    <p >Адрес: <span class="bold">{{$passport->address }}</span></p>
                    <hr class="my_hr_in"/>
                    <p >ЕИК/Булстат: <span class="bold">{{$passport->pin }}</span> </p>
                    <hr class="my_hr_in"/>
                    @if($passport->is_farmer > 0 )
                        <p class="bold" style="margin-bottom: 7px">
                            Посочен е номер на Земеделския Стопанин в регистъра!
                            <a style="float: right" href="{!! URL::to('/стопанин/'.$passport->is_farmer)!!}" class="fa fa-user btn btn-success my_btn my_float"> Към Земеделеца!</a>
                        </p>
                    @else
                        <p class="bold" >Не е посочен номера на Земеделския Стопанин в регистъра!</p>
                    @endif
                    <hr class="my_hr_in"/>
                </div>
                <div class="small_field_center" style="display: table-cell">
                    @if($passport->is_lock == 0)
                        @if ($passport->is_farmer > 0  )
                            <div class="row">
                                <div class="col-md-12" style="padding: 3px 15px 5px 15px">
                                    <p style="padding: 3px 5px" >
                                        <span class="bold" style="color: red">ВНИМАНИЕ!</span> Ако посоченият номер не отговаря на ЗС, редактирай тук или го задай като нула (0)!
                                    </p>
                                    <hr class="my_hr_in"/>
                                </div>
                                <div class="col-md-12" style="padding: 3px 0 5px 20px">
                                    {!! Form::model($passport, ['url'=>'passport/farmer_id_edit/'.$passport->id , 'method'=>'POST', 'id'=>'form']) !!}
                                        {!! Form::label('is_farmer', 'ID на ЗС', ['class'=>'my_labels']) !!}
                                        {!! Form::text('is_farmer', null, ['class'=>'form-control form-control-my', 'size'=>3, 'maxlength'=>10, 'style'=>'width: 100px; display: inline-block;' ]) !!}
                                        <button type="submit" class="btn-sm btn-danger " id="edit_id">
                                            <i class="fa fa-edit"></i> РЕДАКТИРАЙ ЗС ID!
                                        </button>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @elseif($passport->is_farmer == 0)
                            <div class="row">
                                <div class="col-md-12" style="padding: 3px 15px 5px 15px">
                                    <p style="padding: 3px 5px" >
                                        <span class="bold" style="color: red">ВНИМАНИЕ!</span> Ако ЗС го има в Регистра и не е посочено неговото ID,  можеш да го зададеш тук!
                                    </p>
                                    <hr class="my_hr_in"/>
                                </div>
                                <div class="col-md-12" style="padding: 3px 0 5px 20px">
                                    {!! Form::model($passport, ['url'=>'passport/farmer_id_edit/'.$passport->id , 'method'=>'POST', 'id'=>'form']) !!}
                                        {!! Form::label('is_farmer', 'ID на ЗС', ['class'=>'my_labels']) !!}
                                        {!! Form::text('is_farmer', null, ['class'=>'form-control form-control-my', 'size'=>3, 'maxlength'=>10, 'style'=>'width: 100px; display: inline-block;' ]) !!}
                                        <button type="submit" class="btn-sm btn-success " id="edit_id">
                                            <i class="fa fa-edit"></i> ДОБАВИ ID НА ЗС!
                                        </button>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @endif
                        <hr class="my_hr_in"/>
                    @else
                        <p style="padding: 3px 5px" >
                            <span class="bold" style="color: red">ВНИМАНИЕ!</span> Ако е необходима Редакция на данните, първо отлючи и тогава редактирай!
                        </p>
                        <hr class="my_hr_in"/>
                    @endif
                </div>
                <div class="small_field_center" style="display: table-cell">
                    @if($passport->is_lock == 0)
                        @if ($passport->is_operator > 0  )
                            <div class="row">
                                <div class="col-md-12" style="padding: 3px 15px 5px 15px">
                                    <?php
                                        if($passport->is_operator >= 1 && $passport->is_operator <= 9){
                                            $nulls = '000';
                                        }
                                        elseif($passport->is_operator >= 10 && $passport->is_operator <= 90){
                                            $nulls = '00';
                                        }
                                        elseif($passport->is_operator >= 100 ){
                                            $nulls = '0';
                                        }
                                        else {
                                            $nulls = '';
                                        }
                                        $reg_number_all = $nulls.$passport->is_operator ;
                                    ?>
                                    <p style="padding: 3px 0 5px 15px" >
                                        <span class="bold" style="color: red">ВНИМАНИЕ!</span> Ако посоченият Регистрационен номер не отговаря на ПО,
                                        редактирай тук или го задай като нула (0)!
                                        @if($passport->is_operator != 0)
                                            <span class="bold">Номера е: {{$index[0]['operator_index_not']}} {{$reg_number_all}}</span>
                                        @endif
                                        <a href="{!! URL::to('/фито/оператор/'.$passport->is_operator)!!}" class="fa fa-binoculars btn btn-info my_btn my_float" style="margin-left: 5px; float: right"> ВИЖ!</a>
                                    </p>
                                    <hr class="my_hr_in"/>
                                </div>
                                <div class="col-md-12" style="padding: 3px 0 5px 20px">
                                    {!! Form::model($passport, ['url'=>'passport/operator_id_edit/'.$passport->id , 'method'=>'POST', 'id'=>'form']) !!}
                                        {!! Form::label('is_operator', 'ПО номер', ['class'=>'my_labels']) !!}
                                        {!! Form::text('is_operator', null, ['class'=>'form-control form-control-my', 'size'=>3, 'maxlength'=>10, 'style'=>'width: 100px; display: inline-block;' ]) !!}
                                        <button type="submit" class="btn-sm btn-default " id="edit_id">
                                            <i class="fa fa-edit"></i> РЕДАКТИРАЙ ПО ID!
                                        </button>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @elseif($passport->is_operator == 0)
                            <div class="row">
                                <div class="col-md-12" style="padding: 3px 15px 5px 15px">
                                    <p style="padding: 3px 5px " >
                                        <span class="bold" style="color: red">ВНИМАНИЕ!</span> Ако З Стопанин е вписан в регистъра на ПО и не е посочен можеш да го зададеш тук!
                                    </p>
                                    <hr class="my_hr_in"/>
                                </div>
                                <div class="col-md-12" style="padding: 3px 0 5px 20px">
                                    {!! Form::model($passport, ['url'=>'passport/operator_id_edit/'.$passport->id , 'method'=>'POST', 'id'=>'form']) !!}
                                        {!! Form::label('is_operator', 'ПО номер', ['class'=>'my_labels']) !!}
                                        {!! Form::text('is_operator', null, ['class'=>'form-control form-control-my', 'size'=>3, 'maxlength'=>10, 'style'=>'width: 100px; display: inline-block;' ]) !!}
                                        <button type="submit" class="btn-sm btn-info " id="edit_id">
                                            <i class="fa fa-edit"></i> ДОБАВИ ID НА ПО!
                                        </button>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @endif
                        <hr class="my_hr_in"/>
                    @endif
                </div>
            </div>
            <div class="row-height-my col-md-12" style="display: table;">
                <div  class="small_field_center" style="display: table-cell; width: 50%; text-align: center; margin-right: 2px">
                    <div class="col-md-12">
                        @if((Auth::user()->fsk == 1 && $passport->is_lock == 1) || (Auth::user()->admin == 2 && $passport->is_lock == 1) )
                            <div class="print-button" style="display: inline-block; text-align: center">
                                {!! Form::model($passport, ['url'=>'passport/unlock/'.$passport->id , 'method'=>'POST', 'id'=>'form']) !!}
                                <button type="submit" class="btn-sm btn-danger " id="unlockConfirm">
                                    <i class="fa fa-unlock"></i> Отключи!
                                </button>
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                                {!! Form::close() !!}
                            </div>
                        @endif
                        @if((Auth::user()->fsk == 1 && $passport->is_lock != 1) || (Auth::user()->admin == 2 && $passport->is_lock != 1) )
                            <div class="print-button" style="display: inline-block; text-align: center">
                                {!! Form::model($passport, ['url'=>'passport/lock/'.$passport->id , 'method'=>'POST', 'id'=>'form']) !!}
                                    <button type="submit" class="btn-sm btn-success " id="unlockConfirm">
                                        <i class="fa fa-lock"></i> Заключи!
                                    </button>
                                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                                {!! Form::close() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>


            <div class="row-height-my col-md-12" style="display: table;">
                <div  class="small_field_center" style="display: table-cell; width: 50%; text-align: center; margin-right: 2px">
                    <div class="col-md-12">
                        <table id="example" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Входящ №</th>
                                <th>Дата</th>
                                <th>РП №</th>
                                <th>ЗП №</th>
                                <th>Ботанически вид</th>
                                <th>Количество</th>
                                <th></th>
                                <th>Производител</th>
                                <th>Направление</th>
                                <th>З. зона</th>
                                <th>№ на фактура</th>
                                <th>Виж</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $n = 1; ?>
                                <?php
                                if ($passport->passport <= 9) {
                                    $number = '00' . $passport->passport;
                                }
                                elseif ($passport->passport <= 99) {
                                    $number = '0' . $passport->passport;
                                }
                                else {
                                    $number = $passport->passport;
                                }
                                ?>
                                <tr>
                                    <td class="right"><?= $n++ ?></td>
                                    <td class="right">{{$passport->number_petition}}</td>
                                    <td class="">{{date('d.m.Y', $passport->date_petition)}}</td>
                                    <td class="center">{!! $index[0]['operator_index_bg'].'-'.$number !!} / {{date('d.m.Y', $passport->date_permit)}}</td>
                                    <td class="center">
                                        @if($passport->is_farmer != 0)
                                            <p>да</p>
                                        @else
                                            <p>не</p>
                                        @endif
                                    </td>
                                    <td class="">{{$passport->botanical}}</td>
                                    <td class="">{{$passport->quantity}}</td>
                                    <td class="">
                                        @if($passport->quantity_type == 1)
                                            <p>кг.</p>
                                        @elseif($passport->quantity_type == 2)
                                            <p>т.</p>
                                        @elseif($passport->quantity_type == 3)
                                            <p>бр.</p>
                                        @else
                                            <p>-</p>
                                        @endif
                                    </td>
                                    <td class="">{{$passport->manufacturer}}</td>
                                    <td class="">{{$passport->direction}}</td>
                                    <td class="center">
                                        @if($passport->protected == 0)
                                            <p>не</p>
                                        @elseif($passport->protected == 1)
                                            <p>да</p>
                                        @else
                                            <p>-</p>
                                        @endif
                                    </td>
                                    <td class="center">
                                        @if($passport->date_invoice != 0)
                                            {!! $passport->invoice !!} / {{date('d.m.Y', $passport->date_invoice)}}
                                        @else
                                            {!! $passport->invoice !!}
                                        @endif
                                    </td>

                                    <td class="center last-column">
                                        <a href="{!!URL::to('/фито/паспорт/edit/'.$passport->id)!!}" class="fa fa-edit btn btn-primary my_btn">
                                            &nbsp;Редактирай!
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>



    <div id="wrap_in_note" class="col-md-12 ">
        <div class="page" >
            <div class="col-md-12_my" id="flip_all_note">
                <div class="col-md-12_my" id="flip_in_note">
                    <div class="col-md-12_my" style="margin-left: 1cm;">
                        <div style="margin: 0 auto;">
                            {{--<div class="col-md-6"></div>--}}
                            <div class="col-md-6" style="float: right">
                                <p class="p-info" style="font-size: 12px">
                                    Приложение № 1 към Заповед № РД 11-152/02.02.2022 г.<br>
                                    на изпълнителния директор на БАБХ
                                </p>
                            </div>
                            <div class="row" style="width: 90%;  margin: 0 auto;">
                                <div class="col-md-12" style="margin: 0 auto; margin-top: 100px">
                                    <div class="page_logo" style="">
                                        <div class="only_certificate" style="">
                                            <div class="" style="; display: inline-block;  height: 90px; float: left">
                                                <img src="{!! URL::to('/img/logo_3.png')!!}" alt="logo" style="height: 90px; margin-right: 15px"/>
                                            </div >
                                            <div  style="display: inline-block; height: 90px; margin: 0 auto; padding: 15px 0 0 0; ; font-size: 16px " >
                                                <p style="font-family: 'Times New Roman'; font-size: 1em; margin-left: 30px" id="" class="bold">РЕПУБЛИКА БЪЛГАРИЯ</p>
                                                <p style="font-family: 'Times New Roman'; font-size: 1em; margin-left: 30px" id="" class="bold">Министерство на земеделието и храните</p>
                                                <p style="font-family: 'Times New Roman'; font-size: 1em; margin-left: 30px" id="" class="bold">Българска агенция по безопасност на храните</p>
                                                <p style="font-family: 'Times New Roman'; font-size: 1em; margin-left: 30px; " id="" class="bold">Областна дирекция по безопасност на храните - {{ $index[0]['city'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div  class="row" style="width: 100%;  margin: 0 auto; margin-top: 40px">
                                <div style="text-align: left; font-size: 16px">
                                    <div class="only_certificate" style="border: 1px solid black; width: 12cm; margin: 0 auto">
                                        <div class="" style="">
                                            <img src="{!! URL::to('/img/eflag.png')!!}" alt="logo" style="height: 60px; margin: 20px 10px 0 20px"/>
                                            <p style="font-family: 'Times New Roman'; font-size: 1em; font-weight: inherit; display: inline-block" class="bold">Растителен Паспорт / Plant Passport</p>
                                        </div >
                                        <div  style="display: inline-block; margin: 0 auto; padding: 15px 0 0 0; ; font-size: 16px " >
                                            {{--<p style="font-family: 'Times New Roman'; font-size: 1em; margin-left: 30px" id="" class="bold">РЕПУБЛИКА БЪЛГАРИЯ</p>--}}


                                            <?php
                                                if ($passport->passport <= 9) {
                                                    $number = '00' . $passport->passport;
                                                }
                                                elseif ($passport->passport <= 99) {
                                                    $number = '0' . $passport->passport;
                                                }
                                                else {
                                                    $number = $passport->passport;
                                                }

                                                if ($passport->is_operator <= 9) {
                                                    $operator_number = '00' . $passport->is_operator;
                                                }
                                                elseif ($passport->passport <= 99) {
                                                    $operator_number = '0' . $passport->is_operator;
                                                }
                                                else {
                                                    $operator_number = $passport->is_operator;
                                                }
                                                if($passport->quantity_type == 1 ) {
                                                    $quantity_type = 'кг.';
                                                }
                                                elseif($passport->quantity_type == 2 ) {
                                                    $quantity_type = 'т.';
                                                }
                                                elseif($passport->quantity_type == 3 ) {
                                                    $quantity_type = 'бр.';
                                                }
                                                else {
                                                    $quantity_type = '';
                                                }

                                            ?>
                                            <p style="font-family: 'Times New Roman'; font-size: 1em; margin-left: 20px; margin-bottom: 10px;  font-weight: inherit" class="bold"><span class="bold">A</span>  {{$passport->botanical}} - <span class="bold">{{$passport->quantity }} {{$quantity_type}}</span></p>
                                            @if($passport->is_operator == 0)
                                                <p style="font-family: 'Times New Roman'; font-size: 1em; margin-left: 20px; margin-bottom: 10px;  font-weight: inherit" class="bold"><span class="bold">B</span> {{$index[0]['operator_index_bg']}}</p>
                                            @else
                                                <p style="font-family: 'Times New Roman'; font-size: 1em; margin-left: 20px; margin-bottom: 10px;  font-weight: inherit" class="bold"><span class="bold">B</span> {{$index[0]['operator_index_bg']}} - {{ $operator_number }}</p>
                                            @endif
                                            <p style="font-family: 'Times New Roman'; font-size: 1em; margin-left: 20px; margin-bottom: 10px;  font-weight: inherit" class="bold"><span class="bold">C</span> {{$index[0]['operator_index_bg']}} - {{ $number }} / {{ date('d.m.Y', $passport->date_permit) }}</p>
                                            <p style="font-family: 'Times New Roman'; font-size: 1em; margin-left: 20px; margin-bottom: 20px;  font-weight: inherit" class="bold"><span class="bold">D</span> BG  </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div  class="row" style="width: 100%;  margin: 0 auto; margin-top: 25px">
                                <div  class="row" style="width: 100%;  margin: 0 auto; margin-top: 25px; padding-left: 10px">
                                    <div class="col-md-12" style="font-size: 1.1em">
                                        <p style="margin: 0 0 10px 20px;">1. PП № {{$index[0]['operator_index_bg']}} - {{ $number }} / {{ date('d.m.Y', $passport->date_permit) }}</p>
                                        <p style="margin: 0 0 10px 20px;">2. Вид и количество: {{$passport->botanical}}, {{$passport->quantity }} {{$quantity_type}}</p>
                                        @if(strlen($passport->full_direction) == 0)
                                        <p style="margin: 0 0 10px 20px;">3. Предназначен за: <span class="bold">{{$passport->direction}}</span></p>
                                        @else
                                            <p style="margin: 0 0 10px 20px;">3. Предназначен за: <span class="bold" >{{$passport->full_direction}}</span></p>
                                        @endif

                                        <p style="margin: 0 0 0px 20px;">4. Име, подпис и печат на официален фитосанитарен инспектор:</p>
                                        @foreach($inspectors as $key => $inspector)
                                            @if($key == $passport->created_by)
                                                <p style="margin: 0 0 10px 50px;">{{$inspector}}</p>
                                            @endif
                                        @endforeach
                                    </div>
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