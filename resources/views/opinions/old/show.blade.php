@extends('layouts.farmers')
@section('title')
    {{ 'Преглед на Становище-старо' }}
@endsection

@section('css')
    {!!Html::style("css/opinions/show.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title">ДАННИ ЗА СТАРО СТАНОВИЩЕ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/земеделци')!!}" class="fa fa-users btn btn-success my_btn"> Всички Земеделски Стопани</a>
        <a href="{!! URL::to('/становища')!!}" class="fa fa-address-card-o btn btn-success my_btn"> Всички Становища</a>
        <a href="{!! URL::to('/становища-стари')!!}" class="fa fa-address-card-o btn btn-warning my_btn"> Всички Стари Становища</a>
    </div>
    <hr/>

    <div id="wrap_in" class="col-md-12" style="padding-bottom: 50px" >
        <div class="page">
            <div class="back"></div>
            <div class="col-md-12" id="flip_in">
                @include('opinions.old.forms.body_show')

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection