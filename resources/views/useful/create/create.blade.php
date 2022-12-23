@extends('layouts.useful')
@section('title')
    {{ 'Добавяне на документ' }}
@endsection

@section('css')
{{--    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}--}}
    {{--{!!Html::style("css/table/jquery.dataTables.css" )!!}--}}
    {!!Html::style("css/table/table_firms.css " )!!}
{{--    {!!Html::style("css/sb-admin-2.css" )!!}--}}
    {!!Html::style("css/admin/admin.css" )!!}
    {!!Html::style("css/admin/verifications.css" )!!}
    {{--{!!Html::style("css/date/jquery.datetimepicker.css" )!!}--}}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
        <h4 class="bold layout-title">ДОБАВЯНЕ НА ДОКУМЕНТ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        {{--<span class="fa  btn btn-default my_btn"><i class="fa fa-euro " aria-hidden="true"></i>  Регламенти</span>--}}
        <a href="{!! URL::to('/полезно/регламенти')!!}" class="fa fa-euro btn btn-info my_btn"> Регламенти</a>
        <a href="{!! URL::to('/полезно/закони')!!}" class="fa fa-balance-scale btn btn-info my_btn"> Закони</a>
        <a href="{!! URL::to('/полезно/наредби')!!}" class="fa fa-gavel btn btn-info my_btn"> Наредби</a>
        <a href="{!! URL::to('/полезно/Бланки')!!}" class="fa fa-tags btn btn-info my_btn"> Бланки</a>
    </div>
    {{--<div class="btn_add_firm">--}}
        {{--<a href="{!!URL::to('/полезно/добави-документ')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn">--}}
            {{--Добави Документ--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<hr/>--}}
    {{--<div class="btn-group" >--}}
        {{--<span class="fa fa-arrow-down btn btn-default my_btn"> Сетификати/Внос</span>--}}
        {{--<a href="{!! URL::to('/контрол/сертификати-износ')!!}" class="fa fa-arrow-up btn btn-info my_btn"> Сетификати/Износ</a>--}}
        {{--<a href="{!! URL::to('/контрол/сертификати-вътрешен')!!}" class="fa fa-retweet btn btn-info my_btn"> Вътрешни</a>--}}
    {{--</div>--}}
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">

        </div>
    </fieldset>
    <hr/>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="alert alert-success alert-dismissible">
                        <p class="description_alert"><span class="red">ВНИМАНИЕ!</span> Тук се описват всички необходими Документи и бланки!</p>
                    </div>
                    <div class="panel-body">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error  }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::open(['url'=>'useful/document/store', 'method'=>'POST', 'id'=>'form', 'files'=>true]) !!}

                            @include('useful.create.form')
                            <br/>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Избери файл</label>&nbsp;&nbsp;
                                <div class="col-md-6">
                                    {!! Form::file('blade',['id'=>'filename']) !!}
                                </div>
                                <br/>
                            </div>
                            <br/>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Добави!</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="btn_add_certificate" style="text-align: right">--}}
        {{--<a href="{!! URL::to('/контрол/сертификати-внос') !!}" class="fa fa-eraser btn btn-primary my_btn right_btn">--}}
            {{--&nbsp; Изчисти сортирането!--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<hr/>--}}
{{--    @include('quality.certificates.includes.table')--}}
@endsection

@section('scripts')
    {{--{!!Html::script("js/table/jquery-1.11.3.min.js" )!!}--}}
    {{--{!!Html::script("js/table/jquery.dataTables.js" )!!}--}}
    {{--{!!Html::script("js/quality/QcertificatesTable.js" )!!}--}}

    {{--{!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}--}}
    {{--{!!Html::script("js/date/in_date.js" )!!}--}}
    {{--<script>--}}
        {{--var selectedVal = $("#years option:selected").val();--}}
        {{--var getYear = document.getElementById("get_year").value = selectedVal;--}}
    {{--</script>--}}
@endsection