@extends('layouts.quality')
@section('title')
    {{ 'Добави Фактура!' }}
@endsection

@section('css')
    {!!Html::style("css/qcertificates/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            {{--@if()--}}
            {{--@elseif()--}}
            <h3 class="my_center" style="color: #d9534f;">Добавяне на Фактура към Сертификат за Внос!</h3>
        </div>
    </div>
    <div class="info-wrap">
        <a href="{!! URL::to('/контрол/сертификат-внос/'.$certificate->id)!!}" class="fa fa-user btn btn-success my_btn my_float"> Назад към сертификата!</a>
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
                    <div class="col-md-2"  style="padding: 0">
                        <fieldset class="small_field_in">
                            <p class="description">Сертификат номер</p><hr class="hr_in"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <p>Номер: <span style="font-weight: bold; text-transform: uppercase;">{{$certificate['stamp_number']}}/{{$certificate['import']}}</span></p>
                                    <br>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <fieldset class="small_field_in">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="description">Инспектор издал сертификата</p><hr class="hr_in"/>
                                    <br>
                                    <p>Инспектор: <span style="font-weight: bold; text-transform: uppercase;">{{$certificate['inspector_bg']}}</span></p>
                                    <br>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        <fieldset class="small_field_in">
                            <p class="description">1. Търговец /Trader</p><hr class="hr_in"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Фирма: <span style="font-weight: bold; text-transform: uppercase;">{{$certificate['importer_name']}}</span></p><br>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <hr class="hr_in"/>

    {!! Form::open(['url'=>'контрол/фактури-внос/'.$certificate['id'].'/store', 'method'=>'POST', 'autocomplete'=>'on']) !!}

    {{--ФАКТУРА И ДАТА--}}
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-12">
                <fieldset class="small_field"><legend class="small_legend">Фактура</legend>
                    <fieldset class="small_field_in" style="width: 50%">
                        {{--<p class="description"><span class="fa fa-warning red" aria-hidden="true"> ВАЖНО!!!--}}
                            {{--В сумата когато се налага изпозвай ТОЧКА!</span>--}}
                        {{--</p>--}}
                        <hr class="hr_in"/>
                        <div class="col-md-3 col-md-6_my" >
                            {!! Form::label('invoice', 'Фактура №', ['class'=>'my_labels']) !!}<br>
                            {!! Form::text('invoice', null, ['class'=>'form-control form-control-my', 'size'=>10, 'maxlength'=>20 ]) !!}
                        </div>
                        <div class="col-md-4 col-md-6_my" >
                            {!! Form::label('date_invoice', 'Дата Фактура:', ['class'=>'my_labels']) !!}<br>
                            {!! Form::text('date_invoice', null, ['class'=>'form-control form-control-my',
                            'id'=>'date_invoice', 'size'=>13, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг',  'autocomplete'=>'off' ]) !!}
                        </div>
                        {{--<div class="col-md-4 col-md-6_my" >--}}
                            {{--{!! Form::label('sum', 'Сума', ['class'=>'my_labels']) !!}<br>--}}
                            {{--{!! Form::text('sum', null, ['class'=>'form-control form-control-my', 'size'=>10, 'maxlength'=>10 ]) !!}--}}
                        {{--</div>--}}
                    </fieldset>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="add_stock" style="text-align: center; margin-top: 10px;">
        {!! Form::submit('Добави Фактура!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
    </div>
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">

    {!! Form::close() !!}


@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/confirm/prevent.js" )!!}
    {!!Html::script("js/quality/date_issue.js" )!!}
    <script>
        function enforceNumberValidation(ele) {
            if ($(ele).data('decimal') != null) {
                // found valid rule for decimal
                var decimal = parseInt($(ele).data('decimal')) || 0;
                var val = $(ele).val();
                if (decimal > 0) {
                    var splitVal = val.split('.');
                    if (splitVal.length == 2 && splitVal[1].length > decimal) {
                        // user entered invalid input
                        $(ele).val(splitVal[0] + '.' + splitVal[1].substr(0, decimal));
                    }
                } else if (decimal == 0) {
                    // do not allow decimal place
                    var splitVal = val.split('.');
                    if (splitVal.length > 1) {
                        // user entered invalid input
                        $(ele).val(splitVal[0]); // always trim everything after '.'
                    }
                }
            }
        }
    </script>
@endsection
