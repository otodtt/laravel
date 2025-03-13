@extends('layouts.objects')
@section('title')
    {{ 'Доклад от  Проверка' }}
@endsection

@section('css')
{{--    {!!Html::style("css/documents/logo_document.css" )!!}--}}
    {!!Html::style("css/protocols/report_show.css" )!!}
    <style>

    </style>
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title">ДАННИ ЗА ДОКЛАД ОТ ПРОВЕРКА</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/доклади-контрол')!!}" class="fa fa-file-text-o btn btn-info my_btn">  Доклади Контрол на Пазара</a>
        <a href="{!! URL::to('/протоколи-обекти')!!}" class="fa fa-object-ungroup btn btn-info my_btn"> Протоколи Нерегламентирани Обекти</a>
        <a href="{!! URL::to('/други-обекти')!!}" class="fa fa-external-link btn btn-info my_btn"> Протоколи в други Области</a>
        <a href="{!! URL::to('/производители')!!}" class="fa fa-industry btn btn-info my_btn"> Протоколи Производители на ПРЗ</a>
    </div>
    <hr/>
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error  }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <span class="">
        <a href="{{ URL::to('/протоколи-фирма/'.$report->id_from_firm) }}" class="fa fa-bank btn btn-success my_btn">  Към всички Протоколи на Фирмата!</a>
    </span>
    <span class="right_span">
        <a href="{{ URL::to('/доклад/'.$report->id.'/редактирай') }}" class="fa fa-edit btn btn-danger my_btn">  Редактирай Доклада!</a>
    </span>
    <hr class="">
    <div style="text-align: center">
        @if($report->protocol > 0 && $report->is_protocol == 0)
            <span class="">
                <span class="red">ВНИМАНИЕ! </span> Посочено е, че има Констативен Протокол но не е въведен в базата. Добави Протокола!
                <a href="{{ URL::to('/протоколи-фирма/'.$report->id_from_firm) }}" class="fa fa-plus btn btn-danger my_btn">  Добави Протокол към Доклада!!</a>
            </span>
            <hr class="" >
        @elseif($report->protocol > 0 && $report->is_protocol == 1)
            <span class="">
                <span class="red">ВНИМАНИЕ! </span> Има издаден Констативен Протокол с номер и дата
                <span class="bold">{{$report->number}}/{{date('d.m.Y', $report->date_report)}}</span>
                !  За повече подробноси виж по-долу!
            </span>
            <hr class="" >
        @else
            <span class="">
                </span> Няма издаден Констативен Протокол към доклада.</span>
            <hr class="" >
        @endif
    </div>
    <div id="wrap_in" class="col-md-12" style="padding-bottom: 50px" >
        <div class="page">
            <div class="back"></div>
            <div class="col-md-12" id="flip_in">

                @include('control.reports.form.body_show')

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script("js/protocols/selectAssayAdd.js" )!!}
{{--    {!!Html::script("js/protocols/prevent.js" )!!}--}}
@endsection