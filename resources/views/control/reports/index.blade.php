@extends('layouts.objects')
@section('title')
    {{ 'Всички Доклади' }}
@endsection

@section('css')
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_firms.css " )!!}
    {!!Html::style("css/protocols/index_protocols.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title">ДОКЛАДИ ОТ ПРОВЕРКИ НА АПТЕКИ СКЛАДОВЕ ЦЕХОВЕ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <span class="fa fa-file-text-o btn btn-default my_btn"> Доклади Контрол на Пазара</span>
        <a href="{!! URL::to('/протоколи-обекти')!!}" class="fa fa-object-ungroup btn btn-info my_btn"> Протоколи Нерегламентирани Обекти</a>
        <a href="{!! URL::to('/други-обекти')!!}" class="fa fa-external-link btn btn-info my_btn"> Протоколи в други Области</a>
        <a href="{!! URL::to('/производители')!!}" class="fa fa-industry btn btn-info my_btn"> Протоколи Производители на ПРЗ</a>
    </div>
    <hr/>
    <div class="btn-group">
        <span class="fa fa fa-plus-square btn btn-default my_btn"> Доклади Аптека</span>
        <a href="{!! URL::to('/доклад-склад')!!}" class="fa fa-shield btn btn-info my_btn"> Доклади Склад</a>
        <a href="{!! URL::to('/доклад-склад')!!}" class="fa fa-cubes btn btn-info my_btn"> Доклади Цех</a>
        <a href="{!! URL::to('/протоколи-към-доклади')!!}" class="fa fa-file-powerpoint-o btn btn-info my_btn"> Протоколи към доклади</a>
    </div>
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                <div id="search_wrap" class="col-md-6">
                    {!! Form::open(array('url'=>'/доклади-аптека', 'method'=>'POST')) !!}
                    @include('control.reports.includes.search')
                    {!! Form::close() !!}
                </div>
                <div class="col-md-6">
                    <span class="errors">
                        @if ($errors->has('search_protocols'))
                            {{ $errors->first('search_protocols') }}<br/>
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all" class="col-md-12">
                {!! Form::open(array('url'=>'/доклади-аптека/сортирай', 'method'=>'POST')) !!}
                @include('control.reports.includes.years_sort')
                {!! Form::close() !!}
                <span class="errors">
                    @if ($errors->has('start_year'))
                        {{ $errors->first('start_year') }}<br/>
                    @endif
                    @if ($errors->has('end_year'))
                        {{ $errors->first('end_year') }}
                    @endif
                </span>
            </div>
        </div>
    </fieldset>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                {!! Form::open(array('url'=>'/доклади-аптека/сортирай', 'method'=>'POST')) !!}
                @include('control.reports.includes.sorting')
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    <hr/>

    @include('protocols.market.index.alphabet')
    <div class="refresh">
        <a href="{{ url('/доклади-аптека') }}" class="fa fa-eraser btn btn-primary my_btn">&nbsp; Изчисти сортирането!</a>
    </div>
    <hr/>
    @include('control.reports.includes.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/date-de.js" )!!}
    {!!Html::script("js/control/reports/marketProtocolsTable.js" )!!}
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
@endsection