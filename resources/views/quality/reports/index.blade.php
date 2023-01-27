@extends('layouts.farmers')
@section('title')
    {{ 'Месечни справки - Земеделски Стопани' }}
@endsection

@section('css')
    {!!Html::style("css/samples/index_samples.css" )!!}
    {!!Html::style("css/registers/opinions.css " )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>

        <span class="fa fa-calendar btn btn-default my_btn"> Регистър - Инспекции на ЗС</span>
        <a href="{!! URL::to('/месечни-справки-становища')!!}" class="fa fa-address-card-o btn btn-primary my_btn"> Регистър - Издадени Становища</a>
        <a href="{!! URL::to('/месечни-справки-контрол')!!}" class="fa fa-check-circle-o btn btn-primary my_btn"> Регистър - Контрол на Употребата</a>
        <a href="{!! URL::to('/месечни-справки-дфз')!!}" class="fa fa-money btn btn-primary my_btn"> Регистър - Контрол на ДРЗП</a>
        <a href="{!! URL::to('/протоколи-регистър')!!}" class="fa fa-file-powerpoint-o btn btn-primary my_btn"> Регистър - Констативни Протоколи</a>
    </div>
    <hr/>
    <div class="div-layout-title">
        <h4 class="bold layout-title title">ТАБЛИЦА ЗА ПРОВЕДЕНИТЕ ИНСПЕКЦИИ НА ЗЕМЕДЕЛСКИ СТОПАНИ ЗА {{ $year_now }} Г.<br/>
            ОДБХ {!! mb_strtoupper($city->odbh_city, "utf-8") !!}
        </h4>
    </div>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all" class="col-md-12">
                {!! Form::open(array('url'=>'/месечни-справки-зс', 'method'=>'POST')) !!}
                {!! Form::label('years', ' Направи справка за:', ['class'=>'labels']) !!}
                {!! Form::select('years', $years, $year_now, ['class'=>'form-control form-control-my-search inspector_sort ']) !!}
                <span class="bold" > година. </span>&nbsp;&nbsp;
                {!! Form::submit('Сортирай по година!', ['class'=>'fa btn btn-success my_btn']) !!}
                {!!Form::hidden('_token', csrf_token() )!!}
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    @include('registers.farmers.tables.farmers')
@endsection

@section('scripts')
    {!!Html::script("js/registers/countTableColumns.js" )!!}
@endsection