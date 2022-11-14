@extends('layouts.quality')

@section('title')
    {{ 'Всички Култири/Износ' }}
@endsection

@section('css')
    {!! Html::style('css/firms_objects/firms_all_css.css') !!}
    {!! Html::style('css/table/jquery.dataTables.css') !!}
    {!! Html::style('css/table/table_firms.css') !!}
    {!! Html::style('css/table/crop.css') !!}

    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
        <h4 class="bold layout-title">КУЛТУРИ/ИЗНОС</h4>
    </div>
    <hr />
    <div class="btn-group">
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/контрол/сертификати-внос') !!}" class="fa fa-certificate btn btn-info my_btn"> Сертификати</a>
        <a href="{!! URL::to('/контрол/фактури') !!}" class="fa fa-files-o btn btn-info my_btn"> Фактури</a>
        <a href="{!! URL::to('/контрол/вносители') !!}" class="fa fa-trademark btn btn-info my_btn"> Всички фирми</a>
        <a href="{!! URL::to('/контрол/стоки/внос') !!}" class="fa fa-tags btn btn-info my_btn"> Стоки</a>
        <span class="fa fa-leaf btn btn-default my_btn"> Култури</span>
    </div>
    <div class="btn_add_firm">
        <a href="{!! URL::to('/контрол/култури/create') !!}" class="fa fa-arrow-circle-right btn btn-danger my_btn"> Добави култура</a>
    </div>
    <hr />
    <div class="btn-group">
        <a href="{!! URL::to('/контрол/култури') !!}" class="fa fa-leaf btn btn-info my_btn"> Всички Култури</a>
        <a href="{!! URL::to('/контрол/култури/внос') !!}" class="fa fa-arrow-up btn btn-info my_btn"> Култури/Внос</a>
        <span class="fa fa-arrow-up btn btn-default my_btn"> Култури/Износ</span>
        <a href="{!! URL::to('/контрол/култури/вътрешни')!!}" class="fa fa-retweet btn btn-info my_btn"> Култури/Вътреши</a>
    </div>
    <hr />
    <fieldset class="form-group">
        <div class="wrap_sort">
            <div id="wr_choiz_all">
                <div class="row">
                    <div class="col-md-4" style="padding-right: 0;">
                        {!! Form::open(['url' => '/контрол/култури/износ', 'method' => 'POST']) !!}
                            {!! Form::label('years', 'Справка за:', ['class' => 'labels']) !!}
                            {!! Form::select('years', $years, $year_now, [
                                'class' => 'form-control form-control-my-search inspector_sort ',
                                'style' => 'width: 70px;',
                                'id' => 'years',
                            ]) !!}
                            <span class="bold"> година. </span>&nbsp;&nbsp;
                            {!! Form::submit('Сортирай!', ['class' => 'fa btn btn-success my_btn']) !!}
                            {!! Form::hidden('_token', csrf_token()) !!}
                            <input type="hidden" name="initial_year" value="{{$years_start_sort}}">
                            <input type="hidden" name="final_year" value="{{$years_end_sort}}">
                            <input type="hidden" name="crop_sort" value="{{$sort_crop}}">
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-8"  style="padding: 0;">
                        {!! Form::open(['url' => '/контрол/култури/износ', 'method' => 'POST']) !!}
                            @include('crops.forms.sorting')
                            <input type="hidden" name="years" value="{{$year_now}}">
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <hr />
    <div class="btn_add_certificate" style="text-align: right">
        <a href="{!! URL::to('контрол/култури/износ') !!}" class="fa fa-eraser btn btn-primary my_btn right_btn">
            &nbsp; Изчисти сортирането!
        </a>
    </div>
    <div class="btn_add_certificate" style="text-align: center; margin-bottom: 20px; margin-top: 20px">
        <h3 style="text-transform: uppercase;">Изнесени стоки за {{ $year_now }} <span
                style="text-transform: none;">г.</span></h3>
    </div>

    <div class="container">
        <table class="my_table" style="width: 100%;" >
            <thead id="my_thead">
                <tr>
                    <th style="border-right: 1px solid black">N:</th>
                    <th style="border-right: 1px solid black">Култура</th>
                    <th style="border-right: 1px solid black">Общо Количество</th>
                    <th>Още данни</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 1;?>
                @foreach ($stocks as $key => $stock)
                    <tr style="border: 1px solid black">
                        <td class="number_column"><?php echo $n++;?></td>
                        <td class="first_column">
                            {{ $key }}
                            <a href="{!! URL::to('/crops/show/'. $stock[0]['crop_id']) !!}"
                                                    class="fa fa-binoculars btn btn-default my_btn"
                                                    style="float: right; margin-right: 5px">
                            </a>
                        </td>
                        <td class="second_column">
                            <?php $total = 0; ?>
                            @foreach ($stock as $val)
                                <?php
                                $total += array_sum((array) $val['weight']);
                                ?>
                            @endforeach
                            <p style="text-center: left; margin-left: 10px; font-weight: bold;">
                                <span style="font-weight: normal">Всичко: </span><span
                                    style="float: right">{{ number_format($total, 0, ',', ' ') }} кг.
                                    ({{ number_format($total / 1000, 3, ',', ' ') }} т.)</span>
                            </p>
                        </td>
                        <td>
                            <div class="panel-group" id="accordion{{ $stock[0]['id'] }}" role="tablist"
                                aria-multiselectable="false">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne{{ $stock[0]['id'] }}">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse"
                                                data-parent="#accordion{{ $stock[0]['id'] }}"
                                                href="#collapseOne{{ $stock[0]['id'] }}" aria-expanded="false"
                                                aria-controls="collapseOne{{ $stock[0]['id'] }}">
                                                Виж повече!
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne{{ $stock[0]['id'] }}" class="panel-collapse collapse"
                                        role="tabpanel" aria-labelledby="headingOne{{ $stock[0]['id'] }}">
                                        <div class="panel-body">
                                            <table id="table_in" style="width: 100%; border: 1px solid black">
                                                <tbody>
                                                    @foreach ($stock as $val)
                                                        <tr style="border-bottom: 1px solid black">
                                                            <td style="width: 30%">
                                                                <p style="display: inline-block">
                                                                    {{ $val['certificate_number'] }}/{{ date('d.m.Y', $val['date_issue']) }}
                                                                </p>
                                                                <a href="{!! URL::to('/контрол/сертификат-износ/' . $val['certificate_id']) !!}"
                                                                    class="fa fa-search-plus btn btn-default my_btn"
                                                                    style="float: right"></a>
                                                            </td>
                                                            <td style="width: 20%">
                                                                <?php
                                                                if ($val['type_pack'] == 1) {
                                                                    $type = 'Каси';
                                                                } elseif ($val['type_pack'] == 2) {
                                                                    $type = 'Палети';
                                                                } elseif ($val['type_pack'] == 3) {
                                                                    $type = 'Кашони';
                                                                } elseif ($val['type_pack'] == 4) {
                                                                    $type = 'Торби';
                                                                } elseif ($val['type_pack'] == 999) {
                                                                    $type = $val['different'];
                                                                } else {
                                                                    $type = '';
                                                                }
                                                                
                                                                if ($val['quality_class'] == 1) {
                                                                    $quality = ' I клас/I class';
                                                                } elseif ($val['quality_class'] == 2) {
                                                                    $quality = 'II клас/II class';
                                                                } elseif ($val['quality_class'] == 3) {
                                                                    $quality = 'OПС/GPS';
                                                                } else {
                                                                    $quality = '';
                                                                }
                                                                ?>
                                                                {{ $type }} <span
                                                                    style="float: right; margin-right: 5px">
                                                                    {{ $val['number_packages'] }}</span>
                                                            </td>
                                                            <td style="width: 25%">
                                                                {{ $quality }}
                                                            </td>
                                                            <td style="width: 25%; ">
                                                                <p style="float: right; margin-right: 5px">
                                                                    {{ number_format($val['weight'], 0, ',', ' ') }}</p>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <br />
@endsection

@section('scripts')
{!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!! Html::script('js/table/jquery.dataTables.js') !!}
    {!! Html::script('js/quality/stockTable.js') !!}

    {!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}
    {!!Html::script("js/date/in_date.js" )!!}
@endsection
