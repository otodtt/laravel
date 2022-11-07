@extends('layouts.farmers')
@section('title')
    {{ 'Всички Стари Становища' }}
@endsection

@section('css')
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
    {!!Html::style("css/protocols/index_protocols.css" )!!}
    {!!Html::style("css/opinions/table_old_opinions.css " )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title">ВСИЧКИ СТАРИ СТАНОВИЩА</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/земеделци')!!}" class="fa fa-users btn btn-success my_btn"> Всички Земеделски Стопани</a>
        <a href="{!! URL::to('/становища')!!}" class="fa fa-address-card-o btn btn-success my_btn"> Всички Становища</a>
        <span class="fa fa-address-card-o btn btn-default my_btn"> Всички Стари Становища</span>
    </div>
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                <div id="search_wrap" class="col-md-6">
                    {!! Form::open(array('url'=>'/становища-стари', 'method'=>'POST')) !!}
                    @include('opinions.old.index.search')
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
                {!! Form::open(array('url'=>'/становища-стари/сортирай', 'method'=>'POST')) !!}
                @include('opinions.old.index.years_sort')
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
                {!! Form::open(array('url'=>'/становища-стари/сортирай', 'method'=>'POST')) !!}
                @include('opinions.old.index.sorting')
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    <hr/>
    @include('opinions.old.index.alphabet')
    <div class="refresh">
        <a href="{{ url('/становища-стари') }}" class="fa fa-eraser btn btn-primary my_btn">&nbsp; Изчисти сортирането!</a>
    </div>
    <hr/>
    @include('opinions.old.index.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/date-de.js" )!!}

    {!!Html::script("js/opinions/oldOpinionsTable.js" )!!}
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
@endsection