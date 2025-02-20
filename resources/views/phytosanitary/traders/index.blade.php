@extends('layouts.quality')
@section('title')
    {{ 'Всички Вносители' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_firms.css " )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
        <h4 class="bold layout-title">ВСИЧКИ ФИРМИ ВНОСИТЕЛИ</h4>
    </div>
    <hr/>
    <div class="btn-group" >
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/контрол/сертификати-внос')!!}" class="fa fa-certificate btn btn-info my_btn"> Сертификати</a>
        <a href="{!! URL::to('/контрол/фактури')!!}" class="fa fa-files-o btn btn-info my_btn"> Фактури</a>
        <span class="fa fa-trademark btn btn-default my_btn"> Всички фирми</span>
        <a href="{!! URL::to('/контрол/стоки/внос')!!}" class="fa fa-tags btn btn-info my_btn"> Стоки</a>
        <a href="{!! URL::to('/контрол/култури')!!}" class="fa fa-leaf btn btn-info my_btn"> Култури</a>
    </div>
    <div class="btn_add_firm">
        <a href="{!!URL::to('/контрол/вносители/добави')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn"> Добави ФИРМА</a>
    </div>
    <hr/>
    <div class="btn-group" >
        <span class="fa fa-truck btn btn-default my_btn "> Вносители</span>
        <a href="{!! URL::to('/контрол/опаковчици')!!}" class="fa fa-archive btn btn-info my_btn"> Опаковчици</a>
        <a href="{!! URL::to('/контрол/търговци')!!}" class="fa fa-shopping-cart btn btn-info my_btn"> Търговци</a>
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
                <div  id="sort_firm"  style="justify-content: center">
                    {!! Form::open(['url'=>'/контрол/вносители/сортирай', 'method'=>'POST']) !!}

                    <div class="row">
                        <div class="col-md-3">
                            <?php
                                if (isset($input_sort) ) {
                                    if ($input_sort == 0) {
                                        $cs0 =true;
                                        $cs1 =false;
                                        $cs999 =false;
                                    }
                                    elseif($input_sort == 1) {
                                        $cs0 =false;
                                        $cs1 =true;
                                        $cs999 =false;
                                    }
                                    else {
                                        $cs0 =false;
                                        $cs1 =false;
                                        $cs999 =false;
                                    }
                                }
                                else {
                                    $cs0 =false;
                                    $cs1 =false;
                                    $cs999 =false;
                                }
                            ?>
                            <label><span>&nbsp;&nbsp;Български: </span>
                                {!! Form::radio('sort', 0, $cs0 ) !!}&nbsp;&nbsp;|
                            </label>
                            <label><span>&nbsp;&nbsp;Чужди: </span>
                                {!! Form::radio('sort', 1, $cs1 ) !!}
                            </label>
                        </div>
                        <div class="col-md-3">
                            <?php
                            if (isset($input_type) ) {
                                if ($input_type == 0) {
                                    $type0 = true;
                                    $type1 =false;
                                }
                                elseif($input_type == 1) {
                                    $type0 =false;
                                    $type1 =true;
                                    //$cs999 =false;
                                }
                                else {
                                    $type0 =false;
                                    $type1 =false;
                                }
                            }
                            else {
                                $type0 =false;
                                $type1 =false;
                            }
                            ?>
                            <label><span>&nbsp;&nbsp;Вносители: </span>
                                {!! Form::radio('type', 0, $type0 ) !!}&nbsp;&nbsp;|
                            </label>
                            <label><span>&nbsp;&nbsp;Износители: </span>
                                {!! Form::radio('type', 1, $type1 ) !!}
                            </label>
                        </div>
                        <div class="col-md-3">
                            {!! Form::hidden('_token', csrf_token() ) !!}
                            {!! Form::submit('Сортирай!',['class'=>'fa btn btn-success my_btn']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </fieldset>
    <hr/>
    <div class="refresh">
        <a href="{{ url('/контрол/вносители') }}" class="fa fa-eraser btn btn-primary my_btn">&nbsp; Изчисти сортирането!</a>
    </div>

    @include('quality.importers.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/quality/firmsImportersTable.js" )!!}
@endsection