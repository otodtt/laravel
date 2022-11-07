@extends('layouts.farmers')
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
        <a href="{!! URL::to('/протоколи-всички')!!}" class="fa fa-file-powerpoint-o btn btn-info my_btn"> Всички Констативни Протоколи</a>
        <a href="{!! URL::to('/протоколи-становища')!!}" class="fa fa-address-card-o btn btn-info my_btn"> За Становища</a>
        <a href="{!! URL::to('/протоколи-стопани')!!}" class="fa fa-user-times btn btn-info my_btn"> Проверки на ЗС</a>
        <a href="{!! URL::to('/протоколи-дфз')!!}" class="fa fa-money btn btn-info my_btn"> Съвместно с ДФЗ</a>
        <a href="{!! URL::to('/протоколи-други')!!}" class="fa fa-euro btn btn-info my_btn"> Други плащания</a>
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
        <a href="{{ URL::to('/протокол-редактирай/'.$protocol->id) }}" class="fa fa-edit btn btn-danger my_btn">  Редактирай Протокола!</a>
    <hr class="">

    <div id="wrap_in" class="col-md-12" style="padding-bottom: 50px" >
        <div class="page">
            <div class="back"></div>
            <div class="col-md-12" id="flip_in">
                @include('protocols.logo.logo')

                @include('records.show.body')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection