@extends('layouts.quality')
@section('title')
    {{ 'Месечни справки - Контрол ППЗ' }}
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
        <a href="{!! URL::to('/контрол/сертификати-внос')!!}" class="fa fa-certificate btn btn-info my_btn"> Сертификати</a>
        <a href="{!! URL::to('/контрол/фактури')!!}" class="fa fa-files-o btn btn-info my_btn"> Фактури</a>
        <a href="{!! URL::to('/контрол/вносители')!!}" class="fa fa-trademark btn btn-info my_btn"> Всички фирми</a>
        <a href="{!! URL::to('/контрол/стоки/внос')!!}" class="fa fa-tags btn btn-info my_btn"> Стоки</a>
        <a href="{!! URL::to('/контрол/култури')!!}" class="fa fa-leaf btn btn-info my_btn"> Култури</a>
    </div>
    <hr/>
    <div class="div-layout-title">
        <h4 class="bold layout-title title">Обобщени месечни отчети на контрола по качеството на пресни плодове и зеленчуци за {{ $year_now }} Г.<br/>
            ОДБХ {!! mb_strtoupper($city->odbh_city, "utf-8") !!}
        </h4>
    </div>
    <hr>
    <fieldset class="form-group" style="margin-bottom: 0">
        <div class="wrap_sort">
            <div id="wr_choiz_all" class="col-md-3">
                {!! Form::open(array('url'=>'контрол/месечни-справки', 'method'=>'POST')) !!}
                    {!! Form::label('years', ' Направи справка за:', ['class'=>'labels']) !!}
                    {!! Form::select('years', $years, $year_now, ['class'=>'form-control form-control-my-search inspector_sort ']) !!}
                    <span class="bold" > година. </span>&nbsp;&nbsp;
                    {!!Form::hidden('_token', csrf_token() )!!}
            </div>
            <div id="wr_choiz_all" class="col-md-5">
                    {!! Form::label('month_select', ' Направи справка за масец:', ['class'=>'labels']) !!}
                    {!! Form::select('month_select', $month_select, $selected_month , ['class'=>'form-control form-control-my-search inspector_sort', 'style'=>'width: 150px;']) !!}
                    {!! Form::submit('Сортирай!', ['class'=>'fa btn btn-success my_btn']) !!}
                {!! Form::close() !!}
            </div>
            <div class="btn_add_certificate col-md-4" style="text-align: left; padding-top: 7px">
                <a href="{!! URL::to('/контрол/месечни-справки') !!}" class="fa fa-eraser btn btn-primary my_btn right_btn">
                    &nbsp; Изчисти сортирането!
                </a>
                {{--<button class="btn btn-xs btn-danger" id="button" onclick="htmlTableToExcel('xlsx')">Export</button>--}}
            </div>
        </div>
    </fieldset>
    <hr>
    @if($selected_month != 0)
        @foreach($month_select as $k=>$month)
            @if($k !=0 && $k == $selected_month)
                <h4 style="text-align: center; margin: 20px 0" class="text-uppercase">Месечна справка за {{$month}} {{$year_now}} г.</h4>
            @endif
        @endforeach
    @else
        @if( strlen($selected_month) == 5 )
            <h4 style="text-align: center; margin: 20px 0; " class="text-uppercase">Обобщен отчет на КППЗ до дата {{date('d.m.Y')}} г.</h4>
        @endif
        @if(strlen($selected_month) != 5 )
            <h4 style="text-align: center; margin: 20px 0" class="text-uppercase">Обобщен отчет на КППЗ за {{$year_now}} г.</h4>
        @endif
    @endif
    @include('quality.reports.table')
    <br>
@endsection

@section('scripts')
    {{--<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>--}}
    {{--<script>--}}
        {{--function htmlTableToExcel(type){--}}
            {{--var data = document.getElementById('table');--}}
            {{--var excelFile = XLSX.utils.table_to_book(data, {sheet: "sheet1"});--}}
            {{--XLSX.write(excelFile, { bookType: type, bookSST: true, type: 'base64' });--}}
            {{--XLSX.writeFile(excelFile, 'ExportedFile:HTMLTableToExcel.' + type);--}}
        {{--}--}}
    {{--</script>--}}
@endsection