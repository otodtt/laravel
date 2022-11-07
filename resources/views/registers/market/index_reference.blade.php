@extends('layouts.objects')
@section('title')
    {{ 'Месечни справки' }}
@endsection

@section('css')
    {!!Html::style("css/samples/index_samples.css" )!!}
    {!!Html::style("css/registers/reference.css " )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/регистър-фирми')!!}" class="fa fa-bank btn btn-info my_btn"> Таблица Регистър на фирми с Удостоверение</a>
        <a href="{!! URL::to('/регистър-протоколи')!!}" class="fa fa-file-powerpoint-o btn btn-info my_btn">  Таблица Регистър на Констативни Протоколи</a>
        <span class="fa fa-calendar btn btn-default my_btn">  Таблица Регистър на Месечни справки</span>
    </div>
    <hr/>
    <div class="div-layout-title">
        <h4 class="bold layout-title title">ТАБЛИЦА ЗА ПРОВЕДЕНИТЕ ИНСПЕКЦИИ ЗА КОНТРОЛ НА ПАЗАРА НА ПРЗ ЗА {{ $year_now }} Г.<br/>
            ОДБХ {!! mb_strtoupper($city->odbh_city, "utf-8") !!}
        </h4>
    </div>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all" class="col-md-12">
                {!! Form::open(array('url'=>'/месечни-справки', 'method'=>'POST')) !!}
                {!! Form::label('years', ' Направи справка за:', ['class'=>'labels']) !!}
                {!! Form::select('years', $years, $year_now, ['class'=>'form-control form-control-my-search inspector_sort ']) !!}
                <span class="bold" > година. </span>&nbsp;&nbsp;
                {!! Form::submit('Сортирай по година!', ['class'=>'fa btn btn-success my_btn']) !!}
                {!!Form::hidden('_token', csrf_token() )!!}
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    @include('registers.market.tables.reference')
@endsection

@section('scripts')
    {!!Html::script("js/registers/countTableColumns.js" )!!}
@endsection