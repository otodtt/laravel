@extends('layouts.quality')
@section('title')
    {{ 'Проверки и идентификация' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_firms.css " )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
        <h4 class="bold layout-title">ПРОВЕРКИ И ИДЕНТИФИКАЦИЯ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/контрол/протоколи')!!}" class="fa  fa-file-powerpoint-o btn btn-info my_btn"> Констативни протоколи </a>
        <a href="{!! URL::to('/контрол/формуляри')!!}" class="fa fa-check-square btn btn-info my_btn"> Формуляри за съответствие </a>
        <span class="fa  btn btn-default my_btn"><i class="fa fa-id-card-o" aria-hidden="true"></i> Проверки и идентификация</span>
    </div>
    <div class="btn_add_firm">
        <a href="{!!URL::to('/контрол/идентификация/добави')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn">
            Добави проверка и идентификация</a>
    </div>
    <hr/>

    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error  }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                <div class="row">
                    <div class="col-md-5">
                        {!! Form::open(array('url'=>'/контрол/идентификация', 'method'=>'POST')) !!}
                        {!! Form::label('years', 'Справка за:', ['class'=>'labels']) !!}
                        {!! Form::select('years', $years, $year_now, ['class'=>'form-control form-control-my-search inspector_sort ', 'style'=> 'width: 80px;', 'id'=>'years']) !!}
                        <span class="bold"> година. </span>&nbsp;&nbsp;
                        {!! Form::submit('Сортирай!', ['class'=>'fa btn btn-success my_btn']) !!}
                        {!!Form::hidden('_token', csrf_token() )!!}
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-7">
                        <?php
                        if (isset($search_return)) {
                            $search_ret = $search_return;
                        } else {
                            $search_ret = null;
                        }
                        if (isset($search_value_return)) {
                            $search_value_ret = $search_value_return;
                        } else {
                            $search_value_ret = null;
                        }
                        ?>
                        {!! Form::open(array('url'=>'/контрол/идентификация', 'method'=>'POST')) !!}
                        {!! Form::label('search', ' Тъпси по:', ['class'=>'labels']) !!}
                        {!! Form::select('search', array(0 =>'', 1=>'Проверка №', 2=>'Фактура №'), $search_ret, ['class'=>'form-control class_search', 'id'=>'search', 'style'=>'display: inline-block; width: 150px']) !!}
                        {!! Form::text('search_value', $search_value_ret, ['class'=>'form-control search_value', 'size'=>30, 'style'=>'display: inline-block; width: 120px']) !!}
                        {!! Form::submit(' ТЪРСИ', array('class' => 'fa fa-search btn btn-primary my_btn')) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_alls">
                {!! Form::open(['url' => '/контрол/идентификация/сортирай', 'method' => 'POST']) !!}
                @include('quality.certificates.includes.sorting')
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    <hr/>
    <div class="btn_add_certificate" style="text-align: right">
        <a href="{!! URL::to('/контрол/идентификация') !!}" class="fa fa-eraser btn btn-primary my_btn right_btn">
            &nbsp; Изчисти сортирането!
        </a>
    </div>
    {{--<hr/>--}}

    {{--<hr/>--}}
    @include('quality.identification.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/quality/QcertificatesTable.js" )!!}

    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
    <script>
        var selectedVal = $("#years option:selected").val();
        var getYear = document.getElementById("get_year").value = selectedVal;
    </script>
@endsection