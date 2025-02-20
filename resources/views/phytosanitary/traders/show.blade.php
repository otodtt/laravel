@extends('layouts.quality')
@section('title')
    {{ 'Фирма Търговец' }}
@endsection

@section('css')
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/metisMenu.min.css" )!!}
    {!!Html::style("css/qcertificates/show_opinion.css" )!!}
    {!!Html::style("css/table/table_firms.css " )!!}
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
    {!!Html::style("css/farmers/farmer_info.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="info-wrap">
        {{-- <a href="{!! URL::to('контрол/вносители')!!}" class="fa fa-truck btn btn-success my_btn my_floats"> Назад!</a> --}}
        <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
            <h4 class="bold layout-title" >ФИРМА ТЪРГОВЕЦ</h4>
        </div>
        <hr class="my_hr"/>
        <div class="btn-group" >
            <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
            <a href="{!! URL::to('/контрол/сертификати-внос')!!}" class="fa fa-certificate btn btn-info my_btn"> Сертификати</a>
            <a href="{!! URL::to('/контрол/фактури')!!}" class="fa fa-files-o btn btn-info my_btn"> Фактури</a>
            <span class="fa fa-trademark btn btn-default my_btn"> Всички фирми</span>
            <a href="{!! URL::to('/контрол/стоки/внос')!!}" class="fa fa-tags btn btn-info my_btn"> Стоки</a>
        <a href="{!! URL::to('/контрол/култури/внос')!!}" class="fa fa-leaf btn btn-info my_btn"> Култури</a>
        </div>
        <div class="btn_add_firm">
            <a href="{!!URL::to('/контрол/вносители/добави')!!}" class="fa fa-arrow-circle-right btn btn-danger my_btn"> Добави ФИРМА</a>
        </div>
        {{-- <hr/> --}}
        <hr class="my_hr"/>
        <div class="btn-group" >
            {{--<span class="fa fa-truck btn btn-default my_btn"> Търговци</span>--}}
            <a href="{!! URL::to('/контрол/вносители')!!}" class="fa fa-truck btn btn-info my_btn"> Вносител</a>
            <a href="{!! URL::to('/контрол/опаковчици')!!}" class="fa fa-archive btn btn-info my_btn"> Опаковчици</a>
            <a href="{!! URL::to('/контрол/търговци')!!}" class="fa fa-shopping-cart btn btn-info my_btn"> Търговци</a>
        </div>
        {{-- <hr/> --}}

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
        <fieldset class="big_field ">
            <div class="row-height-my col-md-12" style="display: table">
                <div style="display: table-row">
                    <div class="small_field_center top_info" style="display: table-cell" >
                            <span class="span-firm-info"><i class="fa fa-shopping-cart "></i> ДАННИ НА ТЪРГОВЕЦ</span>
                    </div>
                </div>
                <div style="display: table-row">
                    <div class="small_field_center" style="display: table-cell">

                        <div class="btn_add" style="display: inline-block; height: 25px;">
                            <p>Търговец</p>
                        </div>
                        <div class="btn_add_firm">
                            <a href="{!!URL::to('/контрол/сертификати-вътрешен/търговец/добави/'.$trader->id)!!}" class="fa fa-plus-circle btn btn-success my_btn"> Добави Сертификат за тази фирма</a>
                            <a href="{!!URL::to('/контрол/протоколи/търговец/'.$trader->id)!!}" class="fa fa-plus-circle btn btn-danger my_btn"> Добави К. Протокол за тази фирма</a>
                        </div>
                        <br>
                        <hr class="my_hr_in"/>
                        <p >Фирма: <span class="bold" style="text-transform: uppercase">{{$trader->trader_name }}</span></p>
                        <p >Адрес: <span class="bold">{{$trader->trader_address }}</span></p>
                        <p >ЕИК/Булстат: <span class="bold">{{$trader->trader_vin }}</span></p>
                    </div>
                </div>
            </div>
            <hr class="my_hr_in"/>
            <div class="row-height-my col-md-12" style="display: table">
                <div style="display: table-row">
                    <div class="small_field_center " style="display: table-cell" >
                        <a href="{!!URL::to('/контрол/търговци/'.$trader->id.'/edit')!!}" class="fa fa-edit btn btn-primary my_btn"> Редактирай фирмата</a>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <div style="text-align: center;margin-top: 20px">
        <h4>СЕРТИФИКАТИ ЗА КАЧЕСТВО - ВЪТРЕШНИ</h4>
    </div>
    <div style="width: 95%; margin: 0 auto">
        <table id="example_firm" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
            <thead>
            <tr>
                <th>N</th>
                <th>Номер/дата на Сертификата</th>
                <th>Номер/дата на Фактурата</th>
                <th>Стойност</th>
                <th>Стоки</th>
                <th>Kg</th>
                <th>Издаден от</th>
                <th>Виж</th>
            </tr>
            </thead>
            <tbody>
            <?php $n = 1; ?>
            @foreach($certificates as $certificate)
                <tr>
                    <td class="center"><?= $n++ ?></td>
                    <td>
                        {{$certificate['internal'] }} /{{ date('d.m.Y', $certificate['date_issue']) }}
                    </td>
                    <td>
                        @if($certificate['invoice_number'] != 0)
                            {{$certificate['invoice_number']}} /{{date('d.m.Y', $certificate['invoice_date']) }}
                        @else
                            <p class="red">Не е въведана фактурата</p>
                        @endif
                    </td>
                    <td class="center">
                        @if($certificate['sum'] != 0)
                            {{$certificate['sum']}}
                        @endif
                    </td>
                    <td>
                        @if($internal_stocks != 0)
                            @foreach($internal_stocks as $stock)
                                @foreach($stock as $val)
                                    @if($val['certificate_id'] == $certificate->id)
                                        <p>{{$val['crops_name']}}</p>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if($internal_stocks != 0)
                            @foreach($internal_stocks as $stock)
                                @foreach($stock as $val)
                                    @if($val['certificate_id'] == $certificate->id)
                                        <p style="text-align: right; margin-right: 10px">{{ number_format($val['weight'], 0, ',', ' ') }}</p>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </td>
                    <td>
                        {{$certificate['inspector_bg']}}
                    </td>
                    <td class="center">

                        <a href="{!!URL::to('/контрол/сертификати-вътрешен/'.$certificate['id'] )!!}" class="fa fa-binoculars btn btn-success my_btn"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="3" style="text-align:right">Всичко лв.</th>
                <th>
                    <?php  $total = 0; ?>
                    @foreach($certificates as $k=>$certificate)
                        <?php
                        $total += array_sum((array)$certificate->sum);
                        ?>
                    @endforeach
                    <p style="text-center: left; margin-left: 10px"> {{ number_format($total, 2, ',', ' ') }} лв.</p>
                </th>
                <th class="bold">Всичко кг.</th>
                <th>
                    @if($internal_stocks != 0)
                        <?php $final = array(); ?>
                        @foreach($internal_stocks as $k=>$stock)
                            <?php
                                $final = array_merge($final, $stock);
                                $total = array_sum(array_column($final, 'weight'));
                            ?>
                        @endforeach
                        <?php
                        $total = array_sum(array_column($final, 'weight'));
                        ?>
                        <p style="text-align: left; margin-left: 10px">{{ number_format($total, 0, ',', ' ') }}</p>
                    @endif
                </th>
                <th></th>
                <th></th>
            </tr>
            </tfoot>
        </table>
    </div>
    <br/><br/>
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            @if(!empty($qprotocols->toArray()))
                <li class="li_repository">
                    <a href="{!!URL::to('/контрол/търговци/'.$trader->id.'/show')!!}"><i class="fa fa-certificate fa-fw"></i>
                        <span class="bold">КОНСТАТИВНИ ПРОТОКОЛИ ПО КАЧЕСТВО</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            @include('farmers.body.qprotocols')
                        </li>
                    </ul>
                </li>
            @endif
            @if(!empty($compliance->toArray()))
                <li class="li_repository">
                    <a href="{!!URL::to('/контрол/търговци/'.$trader->id.'/show')!!}"><i class="fa fa-check-square fa-fw"></i>
                        <span class="bold">ФОРМУЛЯРИ ЗА СЪОТВЕТСТВИЕ</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            @include('farmers.body.compliance')
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
    <br/>
@endsection


@section('scripts')
    {!!Html::script("js/metisMenu.min.js" ) !!}
    {!!Html::script("js/sb-admin-2.js" ) !!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/quality/firmsImportersTable.js" )!!}

    <script>
    </script>
@endsection