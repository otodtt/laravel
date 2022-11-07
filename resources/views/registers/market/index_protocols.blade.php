@extends('layouts.objects')
@section('title')
    {{ 'Регистър на Констативни Протоколи' }}
@endsection

@section('css')
    {!!Html::style("css/samples/index_samples.css" )!!}
    {!!Html::style("css/registers/protocols.css " )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/регистър-фирми')!!}" class="fa fa-bank btn btn-info my_btn"> Таблица Регистър на фирми с Удостоверение</a>
        <span class="fa fa-file-powerpoint-o btn btn-default my_btn"> Таблица Регистър на Констативни Протоколи</span>
        <a href="{!! URL::to('/месечни-справки')!!}" class="fa fa-calendar btn btn-info my_btn"> Таблица Регистър на Месечни справки</a>
    </div>
    <hr/>
    <div class="div-layout-title">
        <h4 class="bold layout-title title">РЕГИСТЪР НА КОНСТАТИВНИТЕ ПРОТОКОЛИ ИЗДАДЕНИ ПРИ КОНТРОЛ НА ПАЗАРА НА
            ТЕРИТОРИЯТА НА ОДБХ {!! mb_strtoupper($city->odbh_city, "utf-8") !!}
        </h4>
    </div>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all" class="col-md-12">
                {!! Form::open(array('url'=>'/регистър-протоколи', 'method'=>'POST')) !!}
                    {!! Form::label('years', ' Направи справка за:', ['class'=>'labels']) !!}
                    {!! Form::select('years', $years, $year_now, ['class'=>'form-control form-control-my-search inspector_sort ']) !!}
                    <span class="bold" > година. </span>&nbsp;&nbsp;
                    {!! Form::submit('Сортирай по година!', ['class'=>'fa btn btn-success my_btn']) !!}
                    {!!Form::hidden('_token', csrf_token() )!!}
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    @include('registers.market.tables.protocols')
@endsection

@section('scripts')
@endsection