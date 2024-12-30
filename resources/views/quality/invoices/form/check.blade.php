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
    <?php
    //print_r($is_invoice[0].'-------'.$alert);
    if (isset($alert) ) {
        $invoice = $is_invoice[0]['number_invoice'];
        $date_invoice = date('d.m.Y', $is_invoice[0]['date_invoice']);
    }
    else {
        $invoice = null;
        $date_invoice = null;
    }
    ?>
    @if(isset($alert) && $alert == 1 || Auth::user()->id == 2 || Auth::user()->id == 10)
        <div class="alert-danger" style=" text-align: center; margin: 10px 0; border: 1px solid black; ">
            <p style="font-weight: bold; font-size: 20px">ВНИМАНИЕ! Има вече издадена фактура с този номер и дата <span style="font-weight: bold; color: black">{{$invoice}}/{{$date_invoice}}</span></p>
            <p style="font-weight: bold; font-size: 20px">ВНИМАНИЕ! Не може да има фактури с един номер но сразлияни дати!! <span style="font-weight: bold; color: black">{{$date_invoice}}</span></p>
            <div class="row" style="margin: 15px 0 0 0">
                <div class="col-md-4" style="text-align: center">
                    <p class="" style="color: black; font-size: 15px">Откажи и въведи друг номер.</p>
                </div>
                <div class="col-md-8" style="text-align: center">
                    <p class="" style="color: black; font-size: 15px">Продължи и въведи номера.</p>
                </div>
            </div>
            <div class="row" style="margin: 10px 0 10px 0">
                <div class="col-md-4" style="text-align: center">
                    <a href="{{ url('/контрол/фактури-внос/'.$certificate['id']) }}" class="fa fa-eraser btn btn-primary my_btn"> ОТКАЖИ</a>
                </div>
                <div class="col-md-8" style="text-align: center">
                    {!! Form::open(['url'=>url('контрол/фактури-внос/запази/'.$certificate['id']) , 'method'=>'POST']) !!}
                    <div class="col-md-3 col-md-6_my" >
                        {!! Form::text('invoice', $invoice, ['class'=>'form-control form-control-my', 'size'=>10, 'maxlength'=>20, 'readonly' ]) !!}
                    </div>
                    <div class="col-md-4 col-md-6_my" >
                        {!! Form::text('date_invoice', $date_invoice, ['class'=>'form-control form-control-my',
                        'id'=>'date_invoices', 'size'=>13, 'maxlength'=>10, 'placeholder'=>'дд.мм.гггг',  'autocomplete'=>'off', 'readonly'   ]) !!}
                    </div>
                        {!! Form::submit('ПРОДЪЛЖИ', ['class'=>'btn btn-danger', 'id'=>'submit_yes']) !!}
                        {{--<button  class="btn btn-success">ПРОДЪЛЖИ</button>--}}
                        <input type="hidden" name="hidden_number" value="{{$is_invoice[0]['number_invoice']}}">
                        <input type="hidden" name="hidden_date" value="{{$is_invoice[0]['date_invoice']}}">
                        <input type="hidden" name="user" value="{{Auth::user()->id}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" id="token">
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @elseif(isset($alert) && $alert == 2)
        <div class="alert-danger" style=" text-align: center; margin: 10px 0; border: 1px solid black; ">
            <p style="font-weight: bold; font-size: 20px">ВНИМАНИЕ! Има издаена фактура с този номер но не е издадена от Вас и нямате право да добавяте сетификати към нея. </p>
            <div class="row" style="margin: 15px 0 0 0">
                <div class="col-md-12" style="text-align: center">
                    <p class="" style="color: black; font-size: 15px">Откажи и въведи друг номер.</p>
                </div>
                <div class="col-md-12" style="text-align: center; margin-bottom: 20px">
                    <a href="{{ url('/контрол/фактури-внос/'.$certificate['id']) }}" class="fa fa-eraser btn btn-primary my_btn"> ОТКАЖИ</a>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
{{--    {!!Html::script("js/confirm/prevent.js" )!!}--}}
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

        function refreshPage(){
            window.location.reload();
        }

        {{--var msg = '{{Session::get('alert')}}';--}}
        {{--var exist = '{{Session::has('alert')}}';--}}
        {{--var date = '{{Session()}}';--}}
//        console.log(date);
//        if(exist){
//            alert(date);
//        }
    </script>
@endsection
