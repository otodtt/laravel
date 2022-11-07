@extends('layouts.objects')
@section('title')
    {{ 'Регистър на фирми с Удостоверение' }}
@endsection

@section('css')
    {!!Html::style("css/registers/firms.css " )!!}
    {!!Html::style("css/samples/index_samples.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <span class="fa fa-bank btn btn-default my_btn"> Таблица Регистър на фирми с Удостоверение</span>
        <a href="{!! URL::to('/регистър-протоколи')!!}" class="fa fa-file-powerpoint-o btn btn-info my_btn">  Таблица Регистър на Констативни Протоколи</a>
        <a href="{!! URL::to('/месечни-справки')!!}" class="fa fa-calendar btn btn-info my_btn"> Таблица Регистър на Месечни справки</a>
    </div>
    <hr/>
    <div class="div-layout-title">
        <h4 class="bold layout-title title">РЕГИСТЪР НА ЛИЦАТА, КОИТО ПРИТЕЖАВАТ УДОСТОВЕРЕНИЕ ЗА ТЪРГОВИЯ С ПРОДУКТИ ЗА
            РАСТИТЕЛНА ЗАЩИТА И НА СЪОТВЕТНИТЕ ОБЕКТИ ЗА ТЪРГОВИЯ С ПРОДУКТИ ЗА РАСТИТЕЛНА ЗАЩИТА НА ТЕРИТОРИЯТА НА ОДБХ {!! mb_strtoupper($city->odbh_city, "utf-8") !!}
        </h4>
    </div>
    @include('registers.market.tables.firms')
@endsection

@section('scripts')
@endsection