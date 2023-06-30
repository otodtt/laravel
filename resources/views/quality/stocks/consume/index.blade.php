@extends('layouts.quality')

@section('title')
    {{ 'Стоки Консумация/Преработка' }}
@endsection

@section('css')
    {!! Html::style('css/firms_objects/firms_all_css.css') !!}
    {!! Html::style('css/table/jquery.dataTables.css') !!}
    {!! Html::style('css/table/table_firms.css') !!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
        <h4 class="bold layout-title">СТОКИ ЗА КОНСУМАЦЯ ИЛИ ПРЕРАБОТКА</h4>
    </div>
    <hr />
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/контрол/сертификати-внос') !!}" class="fa fa-certificate btn btn-info my_btn"> Сертификати</a>
        <a href="{!! URL::to('/контрол/фактури') !!}" class="fa fa-files-o btn btn-info my_btn"> Фактури</a>
        <a href="{!! URL::to('/контрол/вносители') !!}" class="fa fa-trademark btn btn-info my_btn"> Всички фирми</a>
        <span class="fa fa-tags btn btn-default my_btn"> Стоки</span>
        <a href="{!! URL::to('/контрол/култури')!!}" class="fa fa-leaf btn btn-info my_btn"> Култури</a>
    </div>
    <div class="btn_add_firm">
        {{-- <a href="{!! URL::to('/контрол/култури/create') !!}" class="fa fa-arrow-circle-right btn btn-danger my_btn"> Добави култура</a> --}}
    </div>
    <hr />
    <div class="btn-group">
        <a href="{!! URL::to('/контрол/стоки/внос') !!}" class="fa fa-arrow-down btn btn-info my_btn"> Стоки внос</a>
        <a href="{!! URL::to('/контрол/стоки/износ') !!}" class="fa fa-arrow-up btn btn-info my_btn"> Стоки/Износ</a>
        <a href="{!! URL::to('/контрол/стоки/вътрешни') !!}" class="fa fa-retweet btn btn-info my_btn"> Стоки/Вътрешни</a>
        <span class="fa fa-cutlery btn btn-default my_btn"> Стоки за</span>
        <a href="{!! URL::to('/контрол/стоки/идентификация') !!}" class="fa fa-id-card-o btn btn-info my_btn"> Проверки и идентификация</a>
    </div>
    <hr />
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
                <div id="search_wrap" class="col-md-6">
                    {!! Form::open(['url' => '/контрол/стоки/консумация-преработка', 'method' => 'POST']) !!}
                        <?php
                        if($type_crops == 1){
                            $cons = 'checked';
                            $pro = '';
                        }
                        elseif($type_crops == 2) {
                            $cons = '';
                            $pro = 'checked';
                        }
                        else {
                            $cons = 'checked';
                            $pro = '';
                        }
                        ?>
                        <label for="cons">Консумация</label>
                        <input type="radio" id="cons" name="type_crops" value="1" {{$cons}}>
                        &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                        <label for="pro">Преработка</label>
                        <input type="radio" id="pro" name="type_crops" value="2" {{$pro}}>
                        &nbsp;&nbsp;&nbsp;
                        {!! Form::submit(' ИЗБЕРИ!', ['class' => 'fa fa-search btn btn-success my_btn']) !!}
                    {!! Form::close() !!}
                </div>
                <div id="search_wrap" class="col-md-5">
                    {!! Form::open(['url' => '/контрол/стоки/консумация-преработка', 'method' => 'POST']) !!}
                    {!! Form::label('stock_number', 'Търси номер на сертификат:', ['class'=>'labels']) !!}
                    {!! Form::text('stock_number', null, ['class' => 'form-control form-control-my search_value',
                                    'size' => 30, 'maxlength'=>5, 'style'=>'height: 28px; padding: 0 8px; width: 100px; display: inline-block;',
                                    'placeholder'=>'Номер']) !!}
                    {!! Form::submit(' ТЪРСИ', ['class' => 'fa fa-search btn btn-primary my_btn']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </fieldset>
    <hr class="my_hr" />
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                {!! Form::open(['url' => '/контрол/стоки/консумация-преработка/сортирай', 'method' => 'POST']) !!}
                @include('quality.stocks.sorting')
                <input type="hidden" name="type_hidden" value="{{$type_crops}}">
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    <hr class="my_hr" />

    <div class="btn_add_certificate" style="text-align: right">
        <a href="{!! URL::to('/контрол/стоки/консумация-преработка') !!}" class="fa fa-eraser btn btn-primary my_btn right_btn">
            &nbsp; Изчисти сортирането!
        </a>
    </div>
    <br />
    @if($type_crops == 1)
        <h3 style="text-align: center">СТОКИ ЗА КОНСУМАЦИЯ</h3>
    @elseif($type_crops == 2)
        <h3 style="text-align: center">СТОКИ ЗА ПРЕРАБОТКА</h3>
    @else
        <h3 style="text-align: center">СТОКИ ЗА КОНСУМАЦИЯ</h3>
    @endif

    @include('quality.stocks.consume.stock_table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!! Html::script('js/table/jquery.dataTables.js') !!}
    {!! Html::script('js/quality/stockTable.js') !!}

    {{-- {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!} --}}
    {{-- {!!Html::script("js/table/date-de.js" )!!} --}}

    {{-- {!!Html::script("js/table/certificateTable.js" )!!} --}}
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
@endsection
