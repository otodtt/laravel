@extends('layouts.phyto')
@section('title')
    {{ 'Официален регистър' }}
@endsection

@section('css')
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/certificates/table_certificates.css" )!!}
    {!!Html::style("css/certificates/index_certificates.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <h4 class=" title_doc" >ОФИЦИАЛЕН РЕГИСТЪР НА ПРОФЕСИОНАЛНИТЕ ОПЕРАТОРИ</h4>
    <hr class="my_hr"/>
    <div class="btn-group my_group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <span class="fa fa-registered btn btn-default my_btn"> Официален регистър на оператори</span>
        {{--<a href="{!! URL::to('фито/регистър-сертификати')!!}" class="fa fa-registered btn btn-info my_btn"> Таблица Регистър на издадените Сертификати</a>--}}
    </div>
    <hr class="my_hr"/>
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
                <div id="search_wrap" class="col-md-9">
                    {!! Form::open(array('url'=>'/сертификати/eg', 'method'=>'POST')) !!}
                    {{--@include('certificates.index.search')--}}
                    {!! Form::close() !!}
                </div>
                <div class="refresh col-md-3">
                    <a href="{!!URL::to('/фито/търси-оператор')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn right_btn"> Добави НОВ ОПЕРАТОР</a>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                {!! Form::open(array('url'=>'/сертификати/сортирай', 'method'=>'POST')) !!}
                    @include('certificates.index.sorting')
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    <hr class="my_hr"/>
        @include('certificates.index.alphabet')
    <div class="btn_add_certificate">
        <a href="{!!URL::to('/сертификати')!!}" class="fa fa-eraser btn btn-primary my_btn right_btn">&nbsp; Изчисти сортирането!</a>

    </div>
    <br/>
    <hr class="my_hr"/>
    @include('certificates.index.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/date-de.js" )!!}

    {!!Html::script("js/table/certificateTable.js" )!!}
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
@endsection