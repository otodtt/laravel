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
        <a href="{!! URL::to('/')!!}" class="fa fa-certificate btn btn-info my_btn"> Фито Сертификати</a>
        <span class="fa fa-registered btn btn-default my_btn"> Официален регистър на оператори</span>
        {{--<a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>--}}
        <a href="{!! URL::to('/фито/регистър-тъговци')!!}" class="fa fa-files-o btn btn-info my_btn"> Всички фирми</a>
        {{--<span class="fa fa-trademark btn btn-default my_btn"> Всички фирми</span>--}}
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
                    {!! Form::open(array('url'=>'/фито/регистър-оператори', 'method'=>'POST')) !!}
                    @include('phytosanitary.index.search')
                    {!! Form::close() !!}
                </div>
                <div class="refresh col-md-3">
                    <p>
                    {{--<a href="{!!URL::to('/фито/таблица/table_add')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn "> Добави ОТ ТАБЛИЦАТА</a>--}}

                    <a href="{!!URL::to('/фито/търси-оператор')!!}" class="fa fa-arrow-circle-right btn btn-success my_btn right_btn"> Добави НОВ ОПЕРАТОР</a>
                    </p>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                {!! Form::open(array('url'=>'/фито/регистър-оператори/сортирай', 'method'=>'POST')) !!}
                    @include('phytosanitary.index.sorting')
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    <hr class="my_hr"/>
    <div class="btn_add_certificate">
        <a href="{!!URL::to('/фито/регистър-оператори')!!}" class="fa fa-eraser btn btn-primary my_btn right_btn">&nbsp; Изчисти сортирането!</a>
        <br/>
    </div>
    <br/>
    <hr class="my_hr" style="margin: 5px"/>
    <br/>
    @include('phytosanitary.index.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/sanitary/operatorsTable.js" )!!}

    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
@endsection