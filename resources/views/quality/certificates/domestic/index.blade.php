@extends('layouts.quality')
@section('title')
    {{ 'Сертификат износ' }}
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
        <h4 class="bold layout-title">ВЪТРЕШНИ СЕРТИФИКАТИ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <span class="fa  btn btn-default my_btn"><i class="fa fa-certificate " aria-hidden="true"></i>  Сертификати</span>
        <a href="{!! URL::to('/контрол/фактури')!!}" class="fa fa-files-o btn btn-info my_btn"> Фактури</a>
        <a href="{!! URL::to('/контрол/търговци')!!}" class="fa fa-trademark btn btn-info my_btn"> Всички фирми</a>
        <a href="{!! URL::to('/контрол/стоки/внос')!!}" class="fa fa-tags btn btn-info my_btn"> Стоки</a>
        <a href="{!! URL::to('/контрол/култури')!!}" class="fa fa-leaf btn btn-info my_btn"> Култури</a>
    </div>
    <div class="btn_add_firm">
        <a href="{!!URL::to('/контрол/сертификат-избери')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn">
            Добави Сертификат</a>
    </div>
    <hr/>
    <div class="btn-group" >
        <a href="{!! URL::to('/контрол/сертификати-внос')!!}" class="fa fa-arrow-down btn btn-info my_btn"> Сетификати/Внос</a>
        <a href="{!! URL::to('/контрол/сертификати-износ')!!}" class="fa fa-arrow-up btn btn-info my_btn"> Сетификати/Износ </a>
        <span class="fa fa-retweet btn btn-default my_btn"> Вътрешни</span>
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
                        {!! Form::open(array('url'=>'/контрол/сертификати-износ', 'method'=>'POST')) !!}
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
                        {!! Form::open(array('url'=>'/контрол/сертификати-износ', 'method'=>'POST')) !!}
                            {!! Form::label('search', ' Тъпси по:', ['class'=>'labels']) !!}
                            {!! Form::select('search', array(0 =>'', 1=>'Сертификат №', 2=>'Фактура №'), $search_ret, ['class'=>'form-control class_search', 'style'=>'display: inline-block; width: 150px']) !!}
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
                {!! Form::open(['url' => '/контрол/сертификати-износ/сортирай', 'method' => 'POST']) !!}
                @include('quality.certificates.includes.sorting')
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    <hr/>
    <div class="btn_add_certificate" style="text-align: right">
        <a href="{!! URL::to('/контрол/сертификати-износ') !!}" class="fa fa-eraser btn btn-primary my_btn right_btn">
            &nbsp; Изчисти сортирането!
        </a>
    </div>
    {{--<hr/>--}}
    @include('quality.certificates.includes.export_table')
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
        console.log(getYear);
    </script>
@endsection