@extends('layouts.quality')
@section('title')
    {{ 'Добавяне на Продукти!' }}
@endsection

@section('css')
    {!!Html::style("css/qcertificates/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <h3 class="my_center" style="color: #d9534f;">Добавяне на Продукти към Формуляр за Съответствие!</h3>
        </div>
    </div>
    <div class="alert alert-danger my_alert" role="alert">
        <p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>
                <span class="bold">Ако култура я няма в падащото меню, иди на страница „ВСИЧКИ КУЛТУРИ“ и добави култура!
                </span><br>

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
                    <div class="col-md-6 col-md-6_my" >
                        <fieldset class="small_field_in">
                            <p class="description">1. Търговец /Trader</p><hr class="hr_in"/>
                            <div class="row">
                                <div class="col-md-12">
                                   <p>
                                       Фирма: <span style="font-weight: bold; text-transform: uppercase;">
                                           @if($compliance->farmer_id > 0 && $compliance->trader_id == 0 && $compliance->unregulated_id == 0)
                                               {{mb_strtoupper($compliance->farmer_name, 'utf-8')}}
                                           @elseif($compliance->farmer_id == 0 && $compliance->trader_id > 0 && $compliance->unregulated_id == 0)
                                               {{mb_strtoupper($compliance->trader_name, 'utf-8')}}
                                           @elseif($compliance->farmer_id == 0 && $compliance->trader_id == 0 && $compliance->unregulated_id > 0)
                                               {{mb_strtoupper($compliance->unregulated_name, 'utf-8')}}
                                           @endif
                                       </span>
                                   </p>
                                   <p>
                                       Адрес: <span style="font-weight: bold;">
                                           @if($compliance->farmer_id > 0 && $compliance->trader_id == 0 && $compliance->unregulated_id == 0)
                                               {{$compliance->farmer_address}}
                                           @elseif($compliance->farmer_id == 0 && $compliance->trader_id > 0 && $compliance->unregulated_id == 0)
                                               {{$compliance->trader_address}}
                                           @elseif($compliance->farmer_id == 0 && $compliance->trader_id == 0 && $compliance->unregulated_id > 0)
                                               {{$compliance->unregulated_address}}
                                           @endif
                                       </span>
                                   </p>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-md-4 col-md-6_my" >
                        <fieldset class="small_field_in">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="description">2. Дата на формуляра</p><hr class="hr_in"/>
                                    <br>
                                    <p>
                                        Дата: <span style="font-weight: bold; text-transform: uppercase;">
                                            {{date('d.m.Y', $compliance ->date_compliance)}}
                                        </span>
                                    </p>
                                    {{--<br>--}}
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    
                    <div class="col-md-2" style="padding: 0" >
                        <fieldset class="small_field_in">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="description">3. Обект на контрол</p><hr class="hr_in"/>
                                    <br>
                                    <p>
                                        <span style="font-weight: bold;">
                                            {{$compliance->object_control}}
                                        </span> 
                                        <span style="font-weight: bold"></span>
                                    </p>

                                </div>
                            </div>
                        </fieldset>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <hr class="hr_in"/>
    <div class="container-fluid"  id="show_stocks">
        <div class="row">
            <div class="col-md-12" >
                <fieldset class="small_field" style="margin-top: 9px">
                    @if(!empty($stocks))
                        @foreach ( $stocks as $stock)
                        <?php

                            // \\\\
                            if($stock['class'] == 1) {
                                $class = 'I клас/I class';
                            }
                            elseif ($stock['class'] == 2) {
                                $class = 'II клас/II class';
                            }
                            elseif ($stock['class'] == 3) {
                                $class = 'OПС/GPS';
                            }
                            elseif ($stock['class'] == 127) {
                                $class = '----';
                            }
                            else {
                                $class = '';
                            }
                        ?>
                        <ul>
                            <li>
                                @if ( $count > 1)
                                    <form action="{{ url('/контрол/артикули/'.$stock['id'].'/delete') }}" method="post" style="display: inline-block" onsubmit="return confirm('Наистина ли искате да изтриете тази стока?');">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                                    </form>
                                @endif

                                <p style="font-size: 16px; display: inline-block" class="bold">
                                    <span style="display: inline-block; width: 300px;">
                                        {{$stock['product'] }}</span>
                                    </span>
                                    <span style="display: inline-block; width: 200px;">
                                        {{$stock['country'] }}</span>
                                    </span>
                                    <span style="display: inline-block; width: 200px;">
                                        {{$class}} - {{$stock['quantity']}} kg
                                    </span>

                                </p>
                                <div class="btn_add" style=" display: inline-block; margin-top: 5px">
                                        <a href="{!!URL::to('/контрол/артикули/'.$compliance->id.'/'.$stock['id']).'/add'!!}" class="fa fa-edit btn btn-success"></a>
                                </div>
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
    {{-- ДОБАВЯНЕ НА СТОКИ --}}
    @if ($article == 0)
        <div class="add_stock" >
            {!! Form::open(['url'=>'контрол/артикули/store/'.$compliance->id, 'method'=>'POST', 'autocomplete'=>'on']) !!}
                <div class="alert alert-success my_alert" role="alert" style="margin-top: 20px">
                    <p class="my_p"><span class="fa fa-success" aria-hidden="true"></span> <span class="bold">Тук се добавят само нови стоки!</span>
                    </p>
                </div>
                @include('quality.compliance.articles.stock_form')

                <div class="col-md-12" id="add_stock" style="text-align: center; margin-top: 10px;">
                    {!! Form::submit('Добави Продукт!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
                </div>
                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">

            {!! Form::close() !!}
        </div>
    @else
        {{-- РЕДАКТИРАНЕ НА СТОКИ --}}
        <div class="add_stock">
            {!! Form::model($article, ['url'=>'контрол/артикули/edit/'.$article[0]['id'], 'method'=>'POST', 'autocomplete'=>'on']) !!}
                <div class="alert alert-success my_alert" role="alert" style="margin-top: 20px">
                    <p class="my_p"><span class="fa fa-success" aria-hidden="true"></span> <span class="bold">Редактиране на стока!</span>
                    </p>
                </div>
                @include('quality.compliance.articles.stock_edit_form')

                <div class="col-md-12" id="add_stock" style="text-align: center; margin-top: 10px;">
                    {!! Form::submit('Редактирай!', ['class'=>'btn btn-primary', 'id'=>'submit']) !!}
                </div>
                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">

            {!! Form::close() !!}
        </div>
    @endif
    @if(!empty($stocks))
        <hr />
        <hr class="hr_in"/>
        @if($compliance->is_all != 0)
            <div class="alert alert-success my_alert" role="alert" style="margin-top: 100px">
                <p class="my_p"><span class="fa fa-success" aria-hidden="true"></span> <span class="bold">След като са редактирани всички артикули, натисни бутона "КРАЙ! Назад към формулярите!" за да отидеш към Формуляра!</span>
                </p>
            </div>
            <div class="col-md-12" style="text-align: center;">
                <a href="{{ '/контрол/формуляр/'.$compliance->id }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success"> КРАЙ! Назад към формулярите!</a>
            </div>
        @else
            <div class="alert alert-success my_alert" role="alert" style="margin-top: 100px">
                <p class="my_p"><span class="fa fa-success" aria-hidden="true"></span> <span class="bold">След като са добавени всички артикули, натисни бутона "КРАЙ" за да отидеш към Формуляра!</span>
                </p>
                {!! Form::open(['url'=>'контрол/артикули/завърши', 'method'=>'POST', 'autocomplete'=>'on']) !!}

                    <div class="col-md-12" id="finish_stock" style="text-align: center; margin-top: 10px;">
                        {!! Form::submit('КРАЙ', ['class'=>'btn btn-success btn-lg', 'id'=>'submit-finish']) !!}
                    </div>
                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                    <input type="hidden" name="compliance_id" value="{{$id}}" id="finish">
                {!! Form::close() !!}
            </div>
        @endif

    @endif
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
{{--    {!!Html::script("js/confirm/prevent.js" )!!}--}}
    {!!Html::script("js/quality/date_issue.js" )!!}
    <script>
        var test = $( "#type option:selected" ).text();

        $('#crops').change(function () {
            var crops_name=$(this).find('option:selected').attr('crops_name');
            $('#crops_name').val(crops_name);
        });
    </script>
@endsection
