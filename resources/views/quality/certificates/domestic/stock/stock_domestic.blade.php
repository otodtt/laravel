@extends('layouts.quality')
@section('title')
    {{ 'Добави Стока!' }}
@endsection

@section('css')
    {!!Html::style("css/qcertificates/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <h3 class="my_center" style="color: #d9534f;">Добавяне на Стоки към Сертификат - ВЪТРЕШЕН!</h3>
        </div>
    </div>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
            <span class="bold">Ако култура я няма в падащото меню, иди на страница „ВСИЧКИ КУЛТУРИ“ и добави култура!
            </span><br>
             <span class="bold">
                 Ако вида на опаковката я няма в падащото меню, избери „Друго“ и попълни появилото се поле.
            </span>
        </p>
    </div>
    
    <div class="form-group">
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error  }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="container-fluid"  id="note-wrapper" >
        <div class="row">
            <div class="col-md-12" >
                <fieldset class="small_field">
                    <legend class="small_legend" style="text-align: center">
                        <span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red" style="font-weight: bold; text-transform: uppercase;" >Внимание! Провери данните преди да продължиш!</span>
                    </legend>
                    <div class="col-md-4 col-md-6_my" >
                        <fieldset class="small_field_in">
                            <p class="description">1. Търговец /Trader</p><hr class="hr_in"/>
                            <div class="row">
                                <div class="col-md-12">
                                   <p>Фирма: <span style="font-weight: bold; text-transform: uppercase;">{{$certificate['trader_name']}}</span></p>
                                   <p>Адрес: <span style="font-weight: bold; text-transform: uppercase;">{{$certificate['trader_address']}}</span></p>
                                   <p>ЕИК :&nbsp; <span style="font-weight: bold; text-transform: uppercase;">{{$certificate['trader_vin']}}</span></p>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-2"  style="padding: 0">
                        <fieldset class="small_field_in">
                            <p class="description">Сертификат номер</p><hr class="hr_in"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <p>Номер: <span style="font-weight: bold; text-transform: uppercase;">{{$certificate['stamp_number']}}/{{$certificate['internal']}}</span></p>
                                    <br>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <fieldset class="small_field_in">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="description">2. Опаковчик</p><hr class="hr_in"/>
                                    @if(strlen($certificate['packer_name']) == 0 && strlen($certificate['packer_address']) == 0)
                                        <p class="bold">Сертификатът е издаден на Земеделски производител.</p><br>
                                    @else
                                        <p>Фирма: <span style="font-weight: bold; text-transform: uppercase;">{{$certificate['packer_name']}}</span></p>
                                        <p>Адрес: <span style="font-weight: bold; text-transform: uppercase;">{{$certificate['packer_address']}}</span></p>
                                        <p>ЕГН/ЕИК: <span style="font-weight: bold; text-transform: uppercase;">{{$certificate['packer_vin']}}</span></p>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    
                    <div class="col-md-2" style="padding: 0" >
                        <fieldset class="small_field_in">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="description">5. Регион местоназначение</p><hr class="hr_in"/>
                                    <p>За: 
                                        <span style="font-weight: bold;">
                                            {{$certificate['for_country_bg']}}/ 
                                        </span> 
                                        <span style="font-weight: bold">{{$certificate['for_country_en']}}</span> 
                                    </p>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <hr class="hr_in"/>
    <div class="container-fluid"  id="show_stckr">
        <div class="row">
            <div class="col-md-12" >
                <fieldset class="small_field" style="margin-top: 9px">
                    @if(!empty($stocks))
                        @foreach ( $stocks as $stock)
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
                        <ul>
                            <li>
                                <p style="font-size: 16px" class="bold">
                                    <span style="display: inline-block; width: 200px;">{{$pack}} - {{$stock['number_packages'] }}</span>
                                    <span style="display: inline-block; width: 300px;">
                                        {{$stock['crops_name'] }}/{{$stock['crop_en']}} <span style="font-weight: normal;">{{$variety}}</span> 
                                    </span>
                                    <span style="display: inline-block; width: 200px;">
                                        {{$class}} - {{$stock['weight']}} kg.
                                    </span>
                                </p>
                            </li>
                        </ul>
                        @endforeach
                        
                    @else 
                        <p class="bold">Все още няма добавни продукти</p>
                    @endif
                </fieldset>
            </div>
        </div>
    </div>
    <hr class="hr_in"/>

    {!! Form::open(['url'=>'internal/add-stock/store', 'method'=>'POST', 'autocomplete'=>'on']) !!}
        
        @include('quality.certificates.domestic.forms.stock_form')
        <input type="hidden" name="date_issue" value="{{$certificate['date_issue']}}">
    
        <div class="col-md-12" id="add_stock" style="text-align: center; margin-top: 10px;">
            {!! Form::submit('Добави Продукт!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
        </div>
        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
    
    {!! Form::close() !!}

    @if(!empty($stocks)) 
        <hr />
        <hr class="hr_in"/>

        <div class="alert alert-success my_alert" role="alert" style="margin-top: 150px">
            <p class="my_p"><span class="fa fa-success" aria-hidden="true"></span> <span class="bold">Прочети преди да продължиш!</span><br/>
                    <span class="bold">
                        След като са добавени всички стоки, натисни бутона "КРАЙ" за да отидеш на Сертификата за отпечатване!
                    </span>
            </p>
        </div>

        {!! Form::open(['url'=>'domestic-finish/store', 'method'=>'POST', 'autocomplete'=>'on']) !!}

            <div class="col-md-12" id="finish_stock" style="text-align: center; margin-top: 10px;">
                {!! Form::submit('КРАЙ', ['class'=>'btn btn-success btn-lg', 'id'=>'submit-finish']) !!}
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
            <input type="hidden" name="certificate_id" value="{{$id}}" id="finish">
        {!! Form::close() !!}
    @endif
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
{{--    {!!Html::script("js/confirm/prevent.js" )!!}--}}
    {!!Html::script("js/quality/date_issue.js" )!!}
    <script>
        var test = $( "#type option:selected" ).text();
        if (test == 'ДРУГО') {
            $( "#different_row" ).removeClass( "hidden" );
        } else {
            $( "#different_row" ).addClass( "hidden" );
        }

        function run() {
            var different = document.getElementById('type').value;
            if (different == 999) {
                $( "#different_row" ).removeClass( "hidden" );
            }
            else {
                $( "#different_row" ).addClass( "hidden" );
            }
        }

        $('#crops').change(function () {
            var crop_en=$(this).find('option:selected').attr('crop_en');
            var crops_name=$(this).find('option:selected').attr('crops_name');
            var group_id=$(this).find('option:selected').attr('group_id');
            $('#crop_en').val(crop_en);
            $('#crops_name').val(crops_name);
            $('#group_id').val(group_id);
        });
    </script>
@endsection
