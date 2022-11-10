@extends('layouts.quality')
@section('title')
    {{ 'Всички Търговци' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_firms.css " )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
        <h4 class="bold layout-title">ВСИЧКИ ТЪРГОВЦИ</h4>
    </div>
    <hr/>
    <div class="btn-group" >
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/контрол/сертификати-внос')!!}" class="fa fa-certificate btn btn-info my_btn"> Сертификати</a>
        <a href="{!! URL::to('/контрол/фактури')!!}" class="fa fa-files-o btn btn-info my_btn"> Фактури</a>
        <span class="fa fa-trademark btn btn-default my_btn"> Всички фирми</span>
        <a href="{!! URL::to('/контрол/стоки/внос')!!}" class="fa fa-tags btn btn-info my_btn"> Стоки</a>
        <a href="{!! URL::to('/контрол/култури')!!}" class="fa fa-leaf btn btn-info my_btn"> Култури</a>
    </div>
    <div class="btn_add_firm">
        <a href="{!!URL::to('/контрол/търговци/добави')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn"> Добави ТЪРГОВЕЦ</a>
    </div>
    <hr/>
    <div class="btn-group" >
        <a href="{!! URL::to('/контрол/вносители')!!}" class="fa fa-truck btn btn-info my_btn"> Вносители</a>
        <a href="{!! URL::to('/контрол/опаковчици')!!}" class="fa fa-archive btn btn-info my_btn"> Опаковчици</a>
        <span class="fa fa-shopping-cart btn btn-default my_btn"> Търговци </span>
    </div>
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                <div  id="sort_firm"  style="justify-content: center">
                    <p>ФИРМИ ТЪРГОВЦИ</p>
                </div>
            </div>
        </div>
    </fieldset>
    <hr/>
    <div class="refresh">
        <a href="{{ url('/контрол/търговци') }}" class="fa fa-eraser btn btn-primary my_btn">&nbsp; Изчисти сортирането!</a>
    </div>
    {{--<hr/>--}}
    @include('quality.traders.table')
@endsection

@section('scripts')
{{--    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}--}}
{{--    {!!Html::script("js/table/jquery.dataTables.js" )!!}--}}
{{--    {!!Html::script("js/table/firmsImportersTable.js" )!!}--}}
@endsection