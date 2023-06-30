@extends('layouts.quality')
@section('title')
    {{ 'Формуляри за съответствие' }}
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
        <h4 class="bold layout-title">ФОРМУЛЯРИ ЗА СЪОТВЕТСТВИЕ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/контрол/протоколи')!!}" class="fa  fa-file-powerpoint-o btn btn-info my_btn"> Констативни протоколи </a>
        <span class="fa  btn btn-default my_btn"><i class="fa fa-check-square " aria-hidden="true"></i> Формуляри за съответствие</span>
        <a href="{!! URL::to('/контрол/идентификация')!!}" class="fa fa-id-card-o btn btn-info my_btn"> Проверки и идентификация</a>
    </div>
    <div class="btn_add_firm">
        <a href="{!!URL::to('/контрол/формуляри/търси')!!}" class="fa fa-arrow-circle-right btn btn-default my_btn">
            Добави НОВ Формуляр</a>

        <a href="{!!URL::to('/контрол/нерегламентиран/формуляр')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn">
            Добави Формуляр на нерегламентиран</a>
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
                        {!! Form::open(array('url'=>'/контрол/формуляри', 'method'=>'POST')) !!}
                            {!! Form::label('years', 'Справка за:', ['class'=>'labels']) !!}
                            {!! Form::select('years', $years, $year_now, ['class'=>'form-control form-control-my-search inspector_sort ', 'style'=> 'width: 80px;', 'id'=>'years']) !!}
                            <span class="bold"> година. </span>&nbsp;&nbsp;
                            {!! Form::submit('Сортирай!', ['class'=>'fa btn btn-success my_btn']) !!}
                            {!!Form::hidden('_token', csrf_token() )!!}
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-7">

                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_alls">
                {!! Form::open(['url' => '/контрол/формуляри/сортирай', 'method' => 'POST']) !!}
                @include('quality.compliance.includes.sorting')
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    <hr/>
    <div class="btn_add_certificate" style="text-align: right">
        <a href="{!! URL::to('/контрол/формуляри') !!}" class="fa fa-eraser btn btn-primary my_btn right_btn">
            &nbsp; Изчисти сортирането!
        </a>
    </div>
    {{--<hr/>--}}
    @include('quality.compliance.includes.table')
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