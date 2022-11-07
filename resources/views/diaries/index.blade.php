@extends('layouts.farmers')
@section('title')
    {{ 'Всички Заверени Дневници' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/certificates/index_certificates.css" )!!}
    {!!Html::style("css/farmers/table_farmers.css " )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title">ВСИЧКИ ЗАВЕРЕНИ ДНЕВНИЦИ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>

        <a href="{!! URL::to('/земеделци')!!}" class="fa fa-users btn btn-success my_btn">  Всички Земеделски Стопани</a>
        <a href="{!! URL::to('/становища')!!}" class="fa fa-address-card-o btn btn-success my_btn"> Всички Становища</a>
        <a href="{!! URL::to('/становища-стари')!!}" class="fa fa-address-card-o btn btn-warning my_btn"> Всички Стари Становища</a>
        <span class="fa fa-book btn btn-default my_btn"> Всички Заверени Дневници</span>
    </div>
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                <div id="wr_choiz_all" class="col-md-6">
                    {!! Form::open(array('url'=>'/дневници', 'method'=>'POST')) !!}
                        {!! Form::label('years', 'Справка за:', ['class'=>'labels']) !!}
                        {!! Form::select('years', $years, $year_now, ['class'=>'form-control form-control-my-search inspector_sort ']) !!}
                        <span class="bold" > година. </span>&nbsp;&nbsp;
                        {!! Form::submit('Сортирай по година!', ['class'=>'fa btn btn-success my_btn']) !!}
                        {!!Form::hidden('_token', csrf_token() )!!}
                    {!! Form::close() !!}
                </div>
                <div class="col-md-6 text-right">
                    <a href="{!! URL::to('/търси-дневник')!!}" class="fa fa-plus btn btn-danger my_btn" style="float: right; margin-right: 10px;"> Добави Заверка</a>
                </div>
            </div>
        </div>
    </fieldset>
    <hr/>

    @include('diaries.index.alphabet')
    <div class="refresh">
        <a href="{{ url('/дневници') }}" class="fa fa-eraser btn btn-primary my_btn">&nbsp; Изчисти сортирането!</a>
    </div>
    <hr/>
    @include('diaries.index.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/date-de.js" )!!}
    {!!Html::script("js/diaries/diariesTable.js" )!!}
@endsection