@extends('layouts.quality')
@section('title')
    {{ 'Сертификати на фирми' }}
@endsection

@section('css')
    {!!Html::style("css/qcertificates/show_opinion.css" )!!}
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
    {!!Html::style("css/table/table_firms.css " )!!}
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="info-wrap">
        {{-- <a href="{!! URL::to('контрол/вносители')!!}" class="fa fa-truck btn btn-success my_btn my_floats"> Назад!</a> --}}
        <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
            @if($importer->trade == 0)
                <h4 class="bold layout-title" >ФИРМА ВНОСИТЕЛ</h4>
            @elseif($importer->trade == 1)
                <h4 class="bold layout-title" >ФИРМА ИЗНОСИТЕЛ</h4>
            @elseif($importer->trade == 2)
                <h4 class="bold layout-title" >ФИРМА ВНОС/ИЗНОС</h4>
            @endif
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
            <a href="{!! URL::to('/контрол/опаковчици')!!}" class="fa fa-shopping-cart btn btn-info my_btn"> Търговци</a>
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
                        @if($importer->trade == 0)
                            <span class="span-firm-info"><i class="fa fa-paper-plane "></i> ДАННИ НА ВНОСИТЕЛ</span>
                        @elseif($importer->trade == 1)
                            <span class="span-firm-info"><i class="fa fa-paper-plane "></i> ДАННИ НА ИЗНОСИТЕЛ</span>
                        @elseif($importer->trade == 2)
                            <span class="span-firm-info"><i class="fa fa-paper-plane "></i> ФИРМА ВНОС/ИЗНОС</span>
                        @endif

                    </div>
                </div>
                <div style="display: table-row">
                    <div class="small_field_center" style="display: table-cell">
                        <p>Вносител</p>
                        <hr class="my_hr_in"/>
                        <p >Фирма: <span class="bold" style="text-transform: uppercase">{{$importer->name_bg }}</span></p>
                        <p >Адрес: <span class="bold">{{$importer->address_bg }}</span></p>
                        <hr class="my_hr_in"/>
                        <p >Фирма: <span class="bold" style="text-transform: uppercase">{{$importer->name_en }}</span></p>
                        <p >Адрес: <span class="bold">{{$importer->address_en }}</span></p>
                        <hr class="my_hr_in"/>
                        <p >ЕИК/VIN: <span class="bold">{{$importer->vin }}</span></p>
                    </div>
                </div>
            </div>
            <hr class="my_hr_in"/>
        </fieldset>
    </div>
    @if($importer->trade == 0)
        <div style="text-align: center;margin-top: 20px">
            <h4>ВНЕСЕНИ СТОКИ</h4>
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
                @foreach($import_certificates as $certificate)
                    <tr>
                        <td class="center"><?= $n++ ?></td>
                        <td>
                            {{$certificate['import'] }} /{{ date('d.m.Y', $certificate['date_issue']) }}
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
                            @if($import_stocks != 0)
                                @foreach($import_stocks as $stock)
                                    @foreach($stock as $val)
                                        @if($val['certificate_id'] == $certificate->id)
                                            <p>{{$val['crops_name']}}</p>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($import_stocks != 0)
                                @foreach($import_stocks as $stock)
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

                            <a href="{!!URL::to('/контрол/сертификат-внос/'.$certificate['id'] )!!}" class="fa fa-binoculars btn btn-success my_btn"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right">Всичко лв.:</th>
                    <th></th>
                    <th class="bold">Всичко кг.</th>
                    <th>
                        @if($import_stocks != 0)
                            <?php $final = array(); ?>
                            @foreach($import_stocks as $k=>$stock)
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
    @elseif($importer->trade == 1 )
        <div style="text-align: center; margin-top: 20px">
            <h4>ИЗНЕСЕНИ СТОКИ</h4>
        </div>
        <div style="width: 95%; margin: 0 auto">
            <table id="example_export" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
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
                @foreach($export_certificates as $certificate)
                    <tr>
                        <td class="center"><?= $n++ ?></td>
                        <td>
                            {{$certificate['export'] }} /{{ date('d.m.Y', $certificate['date_issue']) }}
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
                            @if($export_stocks != 0)
                                @foreach($export_stocks as $stock)
                                    @foreach($stock as $val)
                                        @if($val['certificate_id'] == $certificate->id)
                                            <p>{{$val['crops_name']}}</p>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($export_stocks != 0)
                                @foreach($export_stocks as $stock)
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

                            <a href="{!!URL::to('/контрол/сертификат-износ/'.$certificate['id'] )!!}" class="fa fa-binoculars btn btn-success my_btn"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right">Всичко лв.:</th>
                    <th></th>
                    <th class="bold">Всичко кг.</th>
                    <th>
                        @if($export_stocks != 0)
                            <?php $final = array(); ?>
                            @foreach($export_stocks as $k=>$stock)
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
    @elseif($importer->trade == 2 )
        <div style="text-align: center;margin-top: 20px">
            <h4>ВНЕСЕНИ СТОКИ</h4>
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
                @foreach($import_certificates as $certificate)
                    <tr>
                        <td class="center"><?= $n++ ?></td>
                        <td>
                            {{$certificate['import'] }} /{{ date('d.m.Y', $certificate['date_issue']) }}
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
                            @if($import_stocks != 0)
                                @foreach($import_stocks as $stock)
                                    @foreach($stock as $val)
                                        @if($val['certificate_id'] == $certificate->id)
                                            <p>{{$val['crops_name']}}</p>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($import_stocks != 0)
                                @foreach($import_stocks as $stock)
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

                            <a href="{!!URL::to('/контрол/сертификат-внос/'.$certificate['id'] )!!}" class="fa fa-binoculars btn btn-success my_btn"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right">Всичко лв.:</th>
                    <th></th>
                    <th class="bold">Всичко кг.</th>
                    <th>
                        @if($import_stocks != 0)
                            <?php $final = array(); ?>
                            @foreach($import_stocks as $k=>$stock)
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
        <div style="text-align: center; margin-top: 20px">
            <h4>ИЗНЕСЕНИ СТОКИ</h4>
        </div>
        <div style="width: 95%; margin: 0 auto">
            <table id="example_export" class="display my_table table-striped " cellspacing="0" width="100%" border="1px">
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
                @foreach($export_certificates as $certificate)
                    <tr>
                        <td class="center"><?= $n++ ?></td>
                        <td>
                            {{$certificate['export'] }} /{{ date('d.m.Y', $certificate['date_issue']) }}
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
                            @if($export_stocks != 0)
                                @foreach($export_stocks as $stock)
                                    @foreach($stock as $val)
                                        @if($val['certificate_id'] == $certificate->id)
                                            <p>{{$val['crops_name']}}</p>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($export_stocks != 0)
                                @foreach($export_stocks as $stock)
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
                            <a href="{!!URL::to('/контрол/сертификат-износ/'.$certificate['id'] )!!}" class="fa fa-binoculars btn btn-success my_btn"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right">Всичко лв.:</th>
                    <th></th>
                    <th class="bold">Всичко кг.</th>
                    <th>
                        @if($export_stocks != 0)
                            <?php $final = array(); ?>
                            @foreach($export_stocks as $k=>$stock)
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
    @endif
@endsection


@section('scripts')
    {!!Html::script("js/table/jquery-1.11.3.min.js" )!!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
    {!!Html::script("js/quality/firmsImportersTable.js" )!!}
    <script>
    </script>
@endsection