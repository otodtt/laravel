@extends('layouts.objects')
@section('title')
    {{ 'Констативен Протокол' }}
@endsection

@section('css')
    {!!Html::style("css/documents/logo_document.css" )!!}
    {!!Html::style("css/protocols/show.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title">ДАННИ ЗА КОНСТАТИВЕН ПРОТОКОЛ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/протоколи')!!}" class="fa fa-file-powerpoint-o btn btn-info my_btn">  Протоколи Контрол на Пазара</a>
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
        <a href="{{ URL::to('/протоколи-фирма/'.$protocol->id_from_firm) }}" class="fa fa-bank btn btn-success my_btn">  Към всички Протоколи на Фирмата!</a>
    </span>
    <span class="right_span">
        <a href="{{ URL::to('/протокол/'.$protocol->id.'/редактирай') }}" class="fa fa-edit btn btn-danger my_btn">  Редактирай Протокола!</a>
    </span>
    <hr class="">

    <div id="wrap_in" class="col-md-12" style="padding-bottom: 50px" >
        <div class="page">
            <div class="back"></div>
            <div class="col-md-12" id="flip_in">
                @include('protocols.logo.logo')

                @include('protocols.market.form.body_show')

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script("js/protocols/selectAssayAdd.js" )!!}
    {!!Html::script("js/protocols/prevent.js" )!!}
@endsection