@extends('layouts.phyto')
@section('title')
    {{ 'Редактирай Паспорт!' }}
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
                <h4 class="my_center bold">РЕДАКТИРА СЕ СЕ РАСТИТЕЛЕН ПАСПОРТ</h4>
                <p ><span class="bold" style="text-transform: uppercase">{{$passport->manufacturer }}</span></p>
                <p >Град: <span class="bold">{{$passport->city }}</span></p>
                <p >Адрес: <span class="bold">{{$passport->address }}</span></p>
                <p >ЕИК/Булстат: <span class="bold">{{$passport->pin }}</span> </p>
                {{--<hr class="my_hr_in"/>--}}
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
        {!! Form::model($passport, ['url'=>'фито/паспорт/update/'.$passport->id , 'method'=>'POST', 'id'=>'form']) !!}
            <hr class="my_hr"/>
            @include('phytosanitary.passports.crud.permit_edit')
            <hr class="my_hr"/>

            @include('phytosanitary.passports.crud.edit_numbers')
            <hr class="my_hr"/>

            @include('phytosanitary.passports.crud.data_passport')
            <hr class="my_hr"/>

            <div class="col-md-6 ">
                <a href="{{ '/фито/паспорти' }}" class="fa fa-arrow-circle-left btn btn-success my_btn-success">
                    Откажи! Към Регистъра!
                </a>
            </div>

            <div class="col-md-6">
                {!! Form::submit('Редактирай Паспорт!', ['class'=>'btn btn-danger', 'id'=>'submit']) !!}
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