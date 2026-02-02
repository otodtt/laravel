@extends('layouts.objects')
@section('title')
    {{ 'Всички Констативни Протоколи към доклади' }}
@endsection

@section('css')
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_firms.css " )!!}
    {!!Html::style("css/protocols/index_protocols.css" )!!}
    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title">
        <h4 class="bold layout-title">КОНСТАТИВНИ ПРОТОКОЛИ КЪМ ДОКЛАДИ ОТ ПРОВЕРКИ</h4>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <span class="fa fa-file-text-o btn btn-default my_btn"> Доклади Контрол на Пазара</span>
        <a href="{!! URL::to('/протоколи-обекти')!!}" class="fa fa-object-ungroup btn btn-info my_btn"> Протоколи Нерегламентирани Обекти</a>
        <a href="{!! URL::to('/други-обекти')!!}" class="fa fa-external-link btn btn-info my_btn"> Протоколи в други Области</a>
        <a href="{!! URL::to('/производители')!!}" class="fa fa-industry btn btn-info my_btn"> Протоколи Производители на ПРЗ</a>
    </div>
    <hr/>
    <div class="btn-group">
        <a href="{!! URL::to('/доклади-аптека')!!}" class="fa fa-plus-square btn btn-info my_btn"> Доклади аптека</a>
        <a href="{!! URL::to('/доклади-склад')!!}" class="fa fa-shield btn btn-info my_btn"> Доклади Склад</a>
        <a href="{!! URL::to('/доклади-цех')!!}" class="fa fa-cubes btn btn-info my_btn"> Доклади Цех</a>
        <span class="fa fa-file-powerpoint-o btn btn-default my_btn"> Протоколи към доклади</span>
    </div>
    <hr/>
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                <div id="info_report_wrap" class="col-md-12" style="text-align: center">
                    <?php // print_r($pharmacy_report) ?>
                    <h4><span class="bold red">ВНИМАНИЕ!</span> Тук се добавят протоколи към доклад от проверка. Напиши номера на доклада и натисни бутона "ТЪРСИ"</h4>
                    <hr>
                </div>
                <div id="search_wrap" class="col-md-6">
                    {!! Form::open(array('url'=>'/протокол-избери/'.$protocol->id, 'method'=>'POST')) !!}
                        {!! Form::label('search_report', ' Тъпси по № на ДОКЛАД:', ['class'=>'labels']) !!}
                        {!! Form::text('search_report', null, ['class'=>'form-control form-control-my-search search_top','size'=>4, 'maxlength'=>6]) !!}
                        {!! Form::hidden('search', 1) !!}
                        {!! Form::submit(' ТЪРСИ', array('class' => 'fa fa-search btn btn-primary my_btn')) !!}
                    {!! Form::close() !!}
                </div>
                <div class="col-md-6">
                    <span class="errors">
                        @if ($errors->has('search_report'))
                            {{ $errors->first('search_report') }}<br/>
                        @endif
                    </span>
                </div>
            </div>
            <?php //print_r($find) ?>
            @if($find != 0)
                <div id="info_report_wrap" class="col-md-12" style="text-align: center">
                    <hr>
                    @if($find == 1)
                        <h4><span class="bold red">ВНИМАНИЕ!</span> Няма намерен такъв номер от ДОКЛАД. Провери с друг номер!</h4>
                    @else
                        <h4> Намерени са {{count($pharmacy_report)}} брой/я доклади от проверки с номер <span class="bold red">{{$number}}</span></h4>
                        <hr>
                        <div style="text-align: left">
                            <ol>
                                @foreach($pharmacy_report as $report)
                                    <?PHP
                                        //print_r($protocol->id);
                                        if($report->ot == 1){
                                            $object = 'Аптека';
                                        }
                                        elseif($report->ot == 2){
                                            $object = 'Склад';
                                        }
                                        elseif($report->ot == 3){
                                            $object = 'Цех';
                                        }
                                        else{
                                            $object = 'Няма Дании';
                                        }

                                        ////////////////////////
                                        if ($report->firm == 1) {
                                            $et = 'ET ';
                                            $ood = '';
                                        } elseif ($report->firm == 2) {
                                            $et = '';
                                            $ood = 'ООД';
                                        } elseif ($report->firm == 3) {
                                            $et = '';
                                            $ood = 'ЕООД';
                                        } elseif ($report->firm == 4) {
                                            $et = '';
                                            $ood = 'АД';
                                        } else {
                                            $et = '';
                                            $ood = '';
                                        }
                                    ?>
                                    <li>
                                        Доклад с Номер {{$report->number}} от дата {{date('d.m.Y', $report->date_report)}} г. Издаен на
                                        <span class="bold" style="font-weight: bold">{{$object}}</span>
                                        на фирма <span class="bold" style="font-weight: bold">{{$et}} {{$report->name}} {{$ood}}</span>
                                        @if($report->protocol == 1 && $report->protocol_number > 0)
                                            <span class="red">Внимание!</span> Има издаден протокол с
                                            <span style="font-weight: bold"> № {{$report->protocol_number}} от Дата {{date('d.m.Y', $report->protocol_date)}} г.</span>
                                            <span style="font-weight: bold">Провери данните отново и търси друг протокол!</span>
                                        @else
                                            - Доклада от проверка няма издаден Констативен Протокол. Ако са верни данните добави протокола тук!
                                            <a href="{!!URL::to('/присъедини-към-доклад/'.$report->id.'/'.$report->ot.'/'.$protocol->id )!!}" class="fa fa-plus-square btn btn-danger my_btn">
                                                &nbsp; Добави!
                                            </a>
                                        @endif
                                    </li>
                                    <hr>
                                @endforeach
                            </ol>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </fieldset>
    {{--<fieldset class="form-group">--}}
        {{--<div class="wrap_sort">--}}
            {{--<div id="wr_choiz_all" class="col-md-12">--}}
                {{--{!! Form::open(array('url'=>'/протоколи/сортирай', 'method'=>'POST')) !!}--}}
                {{--@include('control.protocols.market.index.years_sort')--}}
                {{--{!! Form::close() !!}--}}
                {{--<span class="errors">--}}
                    {{--@if ($errors->has('start_year'))--}}
                        {{--{{ $errors->first('start_year') }}<br/>--}}
                    {{--@endif--}}
                    {{--@if ($errors->has('end_year'))--}}
                        {{--{{ $errors->first('end_year') }}--}}
                    {{--@endif--}}
                {{--</span>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</fieldset>--}}
    {{--<fieldset class="form-group">--}}
        {{--<div class="wrap_sort">--}}
            {{--<div id="wr_choiz_all">--}}
                {{--{!! Form::open(array('url'=>'/протоколи/сортирай', 'method'=>'POST')) !!}--}}
                {{--@include('control.protocols.market.index.sorting')--}}
                {{--{!! Form::close() !!}--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</fieldset>--}}
    {{--<hr/>--}}

    {{--@include('control.protocols.market.index.alphabet')--}}
    {{--<div class="refresh">--}}
        {{--<a href="{{ url('/протоколи') }}" class="fa fa-eraser btn btn-primary my_btn">&nbsp; Изчисти сортирането!</a>--}}
    {{--</div>--}}
    {{--<hr/>--}}
    {{--@include('control.protocols.market.index.table')--}}
@endsection

@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/table/date-de.js" )!!}
    {!!Html::script("js/table/marketProtocolsTable.js" )!!}
    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
@endsection