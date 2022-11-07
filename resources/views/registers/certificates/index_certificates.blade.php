@extends('layouts.certificates')
@section('title')
    {{ 'Регистър на Издадените Сертификати' }}
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
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/сертификати')!!}" class="fa fa-certificate btn btn-info my_btn"> Всички издадени Сертификати</a>
        <span class="fa fa-registered btn btn-default my_btn"> Таблица Регистър на издадените Сертификати</span>
    </div>
    <hr/>
    <div class="div-layout-title">
        <h4 class="bold layout-title title">РЕГИСТЪР НА ЛИЦАТА, КОИТО ПРИТЕЖАВАТ СЕРТИФИКАТ ЗА ИЗПОЛЗВАНЕ НА ПРЗ ОТ
            ПРОФЕСИОНАЛНА КАТЕГОРИЯ НА УПОТРЕБА ПО ЧЛ. 83 ОТ ЗАКОНА ЗА ЗАЩИТА НА РАСТЕНИЯТА, ИЗДАДЕН ОТ
            ОДБХ {!! mb_strtoupper($city->odbh_city, "utf-8") !!}
        </h4>
    </div>
    @include('registers.certificates.table')
    <br/>
    <hr/>
@endsection

@section('scripts')
    {!!Html::script("js/registers/countTableColumns.js" )!!}
@endsection