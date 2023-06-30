@extends('layouts.quality')

@section('title')
    {{ 'Стоки Проверки' }}
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
        <h4 class="bold layout-title">СТОКИ ЗА ПРОВЕРКИ И ИСЕНТИФИКАЦИЯ</h4>
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
        <a href="{!! URL::to('/контрол/стоки/внос') !!}" class="fa fa-arrow-down btn btn-info my_btn"> Стоки/Внос</a>
        <a href="{!! URL::to('/контрол/стоки/износ') !!}" class="fa fa-arrow-up btn btn-info my_btn"> Стоки/Износ</a>
        <a href="{!! URL::to('/контрол/стоки/вътрешни') !!}" class="fa fa-retweet btn btn-info my_btn"> Стоки/Вътрешни</a>
        <a href="{!! URL::to('/контрол/стоки/консумация-преработка') !!}" class="fa fa-cutlery btn btn-info my_btn"> Стоки за</a>
        <span class="fa fa-id-card-o btn btn-default my_btn"> Проверки и идентификация</span>
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
                <div id="search_wrap" class="col-md-4">
                    {!! Form::open(['url' => '/контрол/стоки/идентификация/1', 'method' => 'POST']) !!}
                        {!! Form::label('stock_number', 'Търси номер на проверка:', ['class'=>'labels']) !!}
                        {!! Form::text('stock_number', null, ['class' => 'form-control form-control-my search_value',
                                        'size' => 30, 'maxlength'=>5, 'style'=>'height: 28px; padding: 0 8px; width: 100px; display: inline-block;',
                                        'placeholder'=>'Номер']) !!}
                        {!! Form::submit(' ТЪРСИ', ['class' => 'fa fa-search btn btn-primary my_btn']) !!}
                    {!! Form::close() !!}
                </div>
                <div class="refresh col-md-6">
                    {!! Form::open(['url' => '/контрол/стоки/идентификация/2', 'method' => 'POST']) !!}
                        <?php
                            if (isset($search_firm_return)) {
                                $search_firm = $search_firm_return;
                            } else {
                                $search_firm = null;
                            }
                        ?>
                        <input type="hidden" value="{{old('search_firm')}}">
                        {!! Form::label('search_firm', 'Търси по фирма:', ['class'=>'labels']) !!}
                        <select name="search_firm" id="search_firm" class="form-control form-control-my search_value" style="height: 28px; padding: 0 8px; width: 250px; display: inline-block">
                            <option value="0"> Избери фирма</option>
                            @foreach($firms as $k=>$firm)
                                <option value="{{$k}}"
                                        {{( $search_firm == $k )? 'selected':''}}
                                        >{{ strtoupper($firm) }}
                                </option>
                            @endforeach
                        </select>
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
                {!! Form::open(['url' => '/стоки/идентификация/сортирай', 'method' => 'POST']) !!}
                @include('quality.stocks.sorting')
                {!! Form::close() !!}
            </div>
        </div>
    </fieldset>
    <hr class="my_hr" />

    <div class="btn_add_certificate" style="text-align: right">
        <a href="{!! URL::to('/контрол/стоки/идентификация') !!}" class="fa fa-eraser btn btn-primary my_btn right_btn">
            &nbsp; Изчисти сортирането!
        </a>
    </div>
    <br />
    {{--<hr class="my_hr" />--}}
    <h4 style="text-align: center">СТОКИ ПРОВЕРКИ И ИДЕНТИФИКАЦИЯ</h4>
     {{--<hr />--}}
    @include('quality.stocks.identification.table')
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!! Html::script('js/table/jquery.dataTables.js') !!}
    {!! Html::script('js/quality/stockTable.js') !!}

    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}

    <script>
        $(document).ready(function() {
            $('#example_identification').DataTable( {
                "columns": [
                    null,
                    { "orderable": false },
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    { "orderable": false },
                ],
                "pagingType": "full_numbers",
                searching: true,

                "lengthMenu": [[-1, 10, 20, 30], ["Всички", 10, 20, 30]],
                "language": {
                    "sProcessing":   "Обработка на резултатите...",
                    "sLengthMenu":   "Колко резултата да се покажат?  _MENU_ ",
                    "sZeroRecords":  "Няма намерени резултати",
                    "sInfo":         "Показване на резултати от _START_ до _END_ от общо _TOTAL_",
                    "sInfoEmpty":    "Показване на резултати от 0 до 0 от общо 0",
                    "sInfoFiltered": "(филтрирани от общо _MAX_ резултата)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Търсене във всички колони:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    " < ",
                        "sPrevious": " <<< ",
                        "sNext":     " >>> ",
                        "sLast":     " > "
                    }
                },
                "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'
            } );
            var table = $('#example_identification').DataTable();

            $('#example_stock tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );
        } );

    </script>
@endsection
