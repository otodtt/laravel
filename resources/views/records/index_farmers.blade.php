@extends('layouts.farmers')
@section('title')
    {{ 'Констативни Протоколи на ЗС' }}
@endsection

@section('css')
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/records/index_protocols.css" )!!}
    {!!Html::style("css/opinions/table_opinions.css " )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title">КОНСТАТИВНИ ПРОТОКОЛИ ИЗДАДЕНИ ПРИ ПРОВЕРКИ НА ЗЕМЕДЕЛСКИ СТОПАНИ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/протоколи-всички')!!}" class="fa fa-file-powerpoint-o btn btn-info my_btn"> Всички Констативни Протоколи</a>
        <a href="{!! URL::to('/протоколи-становища')!!}" class="fa fa-address-card-o btn btn-info my_btn"> За Становища</a>
        <span class="fa fa-user btn btn-default my_btn">  Проверки на ЗС</span>
        <a href="{!! URL::to('/протоколи-дфз')!!}" class="fa fa-money btn btn-info my_btn"> Съвместно с ДФЗ</a>
        <a href="{!! URL::to('/протоколи-други')!!}" class="fa fa-euro btn btn-info my_btn"> Други плащания</a>
        <a href="{!! URL::to('/протоколи-нарушения')!!}" class="fa fa-user-times btn btn-info my_btn"> С нарушение</a>
        <a href="{!! URL::to('/протоколи-проби')!!}" class="fa fa-flask btn btn-info my_btn"> С взети проби</a>
    </div>
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                <div id="search_wrap" class="col-md-5">
                    {!! Form::open(array('url'=>'/протоколи-стопани', 'method'=>'POST')) !!}
                    @include('protocols.market.index.search')
                    {!! Form::close() !!}
                </div>
                <div class="col-md-4">
                    <span class="errors">
                        @if ($errors->has('search_protocols'))
                            {{ $errors->first('search_protocols') }}<br/>
                        @endif
                    </span>
                </div>
                <div class="col-md-3">
                    <a href="{!! URL::to('/търси-протокол')!!}" class="fa fa-plus btn btn-danger my_btn" style="float: right; margin-right: 10px;"> Добави НОВ Протокол</a>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all" class="col-md-12">
                {!! Form::open(array('url'=>'/протоколи-стопани/сортирай', 'method'=>'POST')) !!}
                @include('records.index_farmers.years_sort')
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
                {!! Form::open(array('url'=>'/протоколи-стопани/сортирай', 'method'=>'POST')) !!}
                @include('records.index_farmers.sorting')
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    <hr/>
    @include('records.index_farmers.alphabet')
    <div class="refresh">
        <a href="{{ url('/протоколи-стопани') }}" class="fa fa-eraser btn btn-primary my_btn">&nbsp; Изчисти сортирането!</a>
    </div>
    <hr/>
    @include('records.index.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/date-de.js" )!!}
    {!!Html::script("js/records/protocolsTable.js" )!!}
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
@endsection