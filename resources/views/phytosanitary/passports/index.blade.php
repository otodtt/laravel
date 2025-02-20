@extends('layouts.phyto')
@section('title')
    {{ 'Всички Растителни Паспорти' }}
@endsection

@section('css')
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/services/table_permits.css" )!!}
    {!!Html::style("css/certificates/index_certificates.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <h4 class=" title_doc" >РАСТИТЕЛНИ ПАСПОРТИ</h4>
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
                <div id="wr_choiz_all" class="col-md-5">
                    {!! Form::open(array('url'=>'/фито/паспорти', 'method'=>'POST')) !!}
                        {!! Form::label('years', 'Справка за:', ['class'=>'labels']) !!}
                        {!! Form::select('years', $years, $year_now, ['class'=>'form-control form-control-my-search inspector_sort ']) !!}
                        <span class="bold" > година. </span>&nbsp;&nbsp;
                        {!! Form::submit('Сортирай по година!', ['class'=>'fa btn btn-success my_btn']) !!}
                        {!!Form::hidden('_token', csrf_token() )!!}
                    {!! Form::close() !!}
                </div>
                <div id="search_wrap" class="col-md-5">
                    {!! Form::open(array('url'=>'/фито/паспорт/search', 'method'=>'POST')) !!}
                        @include('phytosanitary.passports.index.search')
                        {!!Form::hidden('_token', csrf_token() )!!}
                    {!! Form::close() !!}
                </div>
                <div class="refresh col-md-2">
                    <a href="{{ url('/фито/паспорти') }}" class="fa fa-eraser btn btn-primary my_btn right_btn">&nbsp; Изчисти сортирането!</a>
                </div>
            </div>
        </div>
    </fieldset>
    <hr class="my_hr"/>
    <div class="btn_add_certificate" style="padding-right: 15px">
        <a href="{!!URL::to('/фито/паспорт/create')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn add_certificate"> Добави НОВ Паспорт</a>
    </div>
    <br/>
    <hr class="my_hr" style="margin-top: 8px"/>
    @include('phytosanitary.passports.index.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/date-de.js" )!!}
    {!!Html::script("js/phito/passportTable.js" )!!}
@endsection