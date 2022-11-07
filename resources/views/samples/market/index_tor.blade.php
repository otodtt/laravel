@extends('layouts.objects')
@section('title')
    {{ 'Дневник за взетите проби от торове' }}
@endsection

@section('css')
    {!!Html::style("css/table/table_firms.css " )!!}
    {!!Html::style("css/samples/index_samples.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/проби')!!}" class="fa fa-flask btn btn-info my_btn"> Дневник проби от ПРЗ</a>
        <span class="fa fa-leaf btn btn-default my_btn"> Дневник проби от ТОРОВЕ</span>
    </div>
    <hr/>
    <div class="div-layout-title">
        <h4 class="bold layout-title title">ДНЕВНИК ЗА ВЗЕТИТЕ И ИЗПРАТЕНИ ПРОБИ ОТ ТОРОВЕ</h4>
    </div>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all" class="col-md-12">
                {!! Form::open(array('url'=>'/проби-тор', 'method'=>'POST')) !!}
                {!! Form::label('years', ' Направи справка за:', ['class'=>'labels']) !!}
                {!! Form::select('years', $years, $year_now, ['class'=>'form-control form-control-my-search inspector_sort ']) !!}
                <span class="bold" > година </span>&nbsp;&nbsp;
                {!! Form::submit('Сортирай по година!', ['class'=>'fa btn btn-success my_btn']) !!}
                {!!Form::hidden('_token', csrf_token() )!!}
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    @include('samples.market.index.table_tor')
@endsection

@section('scripts')

@endsection