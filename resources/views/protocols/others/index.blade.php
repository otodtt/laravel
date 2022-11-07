@extends('layouts.objects')
@section('title')
    {{ 'Констативни Протоколи Производители на ПРЗ' }}
@endsection

@section('css')
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_firms.css " )!!}
    {!!Html::style("css/protocols/index_protocols.css" )!!}
    {!!Html::style("css/protocols/show_none.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title">КОНСТАТИВНИ ПРОТОКОЛИ ПРИ ПРОВЕРКИ В ДРУГИ ОБЛАСТИ</h4>
    </div>
    <hr/>
    <div class="btn-group my_group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/протоколи')!!}" class="fa fa-file-powerpoint-o btn btn-info my_btn"> Протоколи Контрол на Пазара</a>
        <a href="{!! URL::to('/протоколи-обекти')!!}" class="fa fa-object-ungroup btn btn-info my_btn"> Протоколи Нерегламентирани Обекти</a>
        <span class="fa fa-external-link btn btn-default my_btn"> Протоколи в други Области</span>
        <a href="{!! URL::to('/производители')!!}" class="fa fa-industry btn btn-info my_btn"> Протоколи Производители на ПРЗ</a>
    </div>
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                <div id="search_wrap" class="col-md-12">
                    {!! Form::open(array('url'=>'/други-обекти', 'method'=>'POST', 'id'=>'search_form')) !!}
                    @include('protocols.market.index.search')
                    {!! Form::close() !!}
                    <span class="right_span">
                        <a  href="{!! URL::to('друг-обект/добави')!!}" class="fa fa-external-link btn btn-danger my_btn "> Добави Проверка в друга област!</a>
                    </span>
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
                {!! Form::open(array('url'=>'/други-обекти/сортирай', 'method'=>'POST')) !!}
                @include('protocols.others.index.years_sort')
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
                {!! Form::open(array('url'=>'/други-обекти/сортирай', 'method'=>'POST')) !!}
                @include('protocols.others.index.sorting')
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    <hr/>

    @include('protocols.others.index.alphabet')
    <div class="refresh">
        <a href="{{ url('/други-обекти') }}" class="fa fa-eraser btn btn-primary my_btn">&nbsp; Изчисти сортирането!</a>
    </div>
    <hr/>
    @include('protocols.others.index.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/date-de.js" )!!}
    {!!Html::script("js/protocols/noneProtocolsTable.js" )!!}
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
@endsection