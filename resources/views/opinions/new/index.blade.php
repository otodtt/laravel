@extends('layouts.farmers')
@section('title')
    {{ 'Всички Становища' }}
@endsection

@section('css')
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/protocols/index_protocols.css" )!!}
    {!!Html::style("css/opinions/table_opinions.css " )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title">ВСИЧКИ СТАНОВИЩА</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/земеделци')!!}" class="fa fa-users btn btn-success my_btn"> Всички Земеделски Стопани</a>
        <span class="fa fa-address-card-o btn btn-default my_btn"> Всички Становища</span>
        <a href="{!! URL::to('/становища-стари')!!}" class="fa fa-address-card-o btn btn-warning my_btn"> Всички Стари Становища</a>
    </div>
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                <div id="search_wrap" class="col-md-5">
                    {!! Form::open(array('url'=>'/становища', 'method'=>'POST')) !!}
                    @include('opinions.new.index.search')
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
                    <a href="{!! URL::to('/търси-становище')!!}" class="fa fa-plus btn btn-danger my_btn" style="float: right; margin-right: 10px;"> Добави НОВО Становище</a>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all" class="col-md-12">
                {!! Form::open(array('url'=>'/становища/сортирай', 'method'=>'POST')) !!}
                @include('opinions.new.index.years_sort')
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
                {!! Form::open(array('url'=>'/становища/сортирай', 'method'=>'POST')) !!}
                @include('opinions.new.index.sorting')
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    <hr/>
    @include('opinions.new.index.alphabet')
    <div class="refresh">
        <a href="{{ url('/становища') }}" class="fa fa-eraser btn btn-primary my_btn">&nbsp; Изчисти сортирането!</a>
    </div>
    <hr/>
    @include('opinions.new.index.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/date-de.js" )!!}

    {!!Html::script("js/opinions/oldOpinionsTable.js" )!!}
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
@endsection