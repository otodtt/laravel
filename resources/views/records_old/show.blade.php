@extends('layouts.farmers')
@section('title')
    {{ 'Стар - Констативен Протокол' }}
@endsection

@section('css')
    {!!Html::style("css/documents/logo_document.css" )!!}
    {!!Html::style("css/protocols/old_show.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title title-bottom">ДАННИ ЗА КОНСТАТИВНИ ПРОТОКОЛИ ИЗДАДЕНИ ПРЕДИ 2015 г.</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/стари-протоколи-всички')!!}" class="fa fa-file-powerpoint-o btn btn-warning my_btn"> Всички Констативни Протоколи</a>
        <a href="{!! URL::to('/стари-протоколи-становища')!!}" class="fa fa-address-card-o btn btn-warning my_btn"> За Становища</a>
        <a href="{!! URL::to('/стари-протоколи-стопани')!!}" class="fa fa-user-times btn btn-warning my_btn"> Проверки на ЗС</a>
        <a href="{!! URL::to('/стари-протоколи-дфз')!!}" class="fa fa-money btn btn-warning my_btn"> Съвместно с ДФЗ</a>
        <a href="{!! URL::to('/стари-протоколи-други')!!}" class="fa fa-euro btn btn-warning my_btn"> Други плащания</a>
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
    {{--<hr class="">--}}

    <div id="wrap_in" class="col-md-12" style="padding-bottom: 50px" >
        <div class="page">
            {{--<div class="back"></div>--}}
            <div class="col-md-12" id="flip_in">
{{--                @include('protocols.logo.logo')--}}

                @include('records_old.show.body')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script("js/protocols/selectAssayAdd.js" )!!}
    {!!Html::script("js/protocols/prevent.js" )!!}
@endsection