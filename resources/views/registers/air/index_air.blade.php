@extends('layouts.services')
@section('title')
    {{ 'Регистър на Издадените Разрешителни' }}
@endsection

@section('css')
    {!!Html::style("css/samples/index_samples.css" )!!}
    {!!Html::style("css/registers/reference.css " )!!}
    {!!Html::style("css/registers/certificates.css " )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <hr/>
    <div class="div-layout-title">
        <h4 class="bold layout-title title">РЕГИСТЪР НА ИЗДАДЕНИТЕ РАЗРЕШЕНИЯ ЗА ПРИЛАГАНЕ НА ПРОДУКТИ ЗА РАСТИТЕЛНА ЗАЩИТА ЗА
            ВЪЗДУШНО ПРЪСКАНЕПО ЧЛ. 110 ОТ ЗАКОНА ЗА ЗАЩИТА НА РАСТЕНИЯТА, ИЗДАДЕН ОТ
            ОДБХ {!! mb_strtoupper($city->odbh_city, "utf-8") !!}
        </h4>
    </div>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all" class="col-md-12">
                {!! Form::open(array('url'=>'/регистър-въздушни', 'method'=>'POST')) !!}
                    {!! Form::label('years', ' Направи справка за:', ['class'=>'labels']) !!}
                    {!! Form::select('years', $years, $year_now, ['class'=>'form-control form-control-my-search inspector_sort ']) !!}
                    <span class="bold" > година. </span>&nbsp;&nbsp;
                    {!! Form::submit('Сортирай по година!', ['class'=>'fa btn btn-success my_btn']) !!}
                    {!!Form::hidden('_token', csrf_token() )!!}
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    @include('registers.air.table')
    <br/>
    <hr/>
@endsection

@section('scripts')
{{--    {!!Html::script("js/registers/countTableColumns.js" )!!}--}}
@endsection