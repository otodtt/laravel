@extends('layouts.phyto')
@section('title')
    {{ 'Добави Паспорт!' }}
@endsection

@section('css')
    {!!Html::style("css/records/add_edit.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('content')
    <hr class="my_hr"/>
    {{--<div class="alert alert-danger my_alert" role="alert">--}}
        {{--<p class="my_p"><span class="fa fa-warning red" aria-hidden="true"></span> <span class="bold red">Внимание! Прочети преди да продължиш!</span><br/>--}}
            {{--<span class="bold">Провери внимателно данните! Ако има грешки, редактирай данните на Земеделския Стопанин и тогава добави Разрешителното!--}}
            {{--</span>--}}
        {{--</p>--}}
    {{--</div>--}}
    <div class="alert alert-info my_alert" role="alert">
        <div class="row">
            <div class="col-md-12 ">
                <h4 class="my_center bold">ДОБАВЯ СЕ РАСТИТЕЛЕН ПАСПОРТ</h4>
{{--                @include('services.air.add.object_info')--}}
            </div>
        </div>
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
        {!! Form::open(['url'=>'фито/паспорт/store' , 'method'=>'POST', 'id'=>'form']) !!}
            <hr class="my_hr"/>
            @include('phytosanitary.passports.crud.permit')
            <hr class="my_hr"/>

            @include('phytosanitary.passports.crud.numbers')
            <hr class="my_hr"/>

            @include('phytosanitary.passports.crud.data_passport')
            <hr class="my_hr"/>

            <div class="col-md-6 ">
                <a href="{{ '/фито/паспорти' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
                    Откажи! Към Регистъра!
                </a>
            </div>

            <div class="col-md-6">
                {!! Form::submit('Добави НОВ Паспорт!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
        {!! Form::close() !!}
    </div>
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/permit_date.js" )!!}
{{--    {!!Html::script("js/confirm/prevent.js" )!!}--}}
@endsection