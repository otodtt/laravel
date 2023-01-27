@extends('layouts.quality')
@section('title')
    {{ 'Фактура' }}
@endsection

@section('css')
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
{{--    {!!Html::style("css/date/jquery.datetimepicker.css" )!!}--}}
{{--    {!!Html::style("css/table/jquery.dataTables.css" )!!}--}}
{{--    {!!Html::style("css/table/table_firms.css " )!!}--}}
    {!!Html::style("css/qcertificates/show_opinion.css" )!!}
{{--    {!!Html::style("css/table/jquery.dataTables.css" )!!}--}}
{{--    {!!Html::style("css/table/table_firms.css " )!!}--}}
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
@endsection

@section('message')
    @include('layouts.alerts.success')
@endsection

@section('content')
    <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
        <h4 class="bold layout-title">ДАННИ ЗА ФАКТУРА</h4>
    </div>
    <hr/>
    <div class="btn-group" >
        <a href="/" class="fa fa-home btn btn-info my_btn"> Началo</a>
        <a href="{!! URL::to('/контрол/сертификати-внос')!!}" class="fa fa-certificate btn btn-info my_btn"> Сертификати</a>
        <a href="{!! URL::to('/контрол/фактури')!!}" class="fa fa-files-o btn btn-info my_btn"> Фактури</a>
        <a href="{!! URL::to('/контрол/вносители')!!}" class="fa fa-trademark btn btn-info my_btn"> Всички фирми</a>
        <a href="{!! URL::to('/контрол/стоки/внос')!!}" class="fa fa-tags btn btn-info my_btn"> Стоки</a>
        <a href="{!! URL::to('/контрол/култури')!!}" class="fa fa-leaf btn btn-info my_btn"> Култури</a>
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
    <fieldset class="big_field ">
        <div class="row-height-my col-md-12" style="display: table">
            <div style="display: table-row">
                <div class="small_field_center top_info" style="display: table-cell" >
                    <span class="span-firm-info"><i class="fa fa-file-text-o "></i> ДАННИ ЗА ФАКТУРА</span>


                </div>
            </div>
            <div style="display: table-row">
                <div class="small_field_center" style="display: table-cell">
                    {{--<p>Вносител</p>--}}
                    <hr class="my_hr_in"/>
                    <p >Фактура Номер: <span class="bold" style="text-transform: uppercase">{{$id}}</span></p>
                    <hr class="my_hr_in"/>
                    <p >От дата: <span class="bold" style="text-transform: none">{{date('d.m.Y', $date)}} г.</span></p>
                    <hr class="my_hr_in"/>
                    <?php $total = 0; ?>
                    @foreach($invoices as $key=>$value)
                        <?php
                            $total  += $value['sum'];
                        ?>
                    @endforeach
                    <p >На обща стойност: <span class="bold" style="text-transform: none">{{number_format($total, 2, ',', ' ')}} лв.</span></p>
                    <hr class="my_hr_in"/>
                    {{--<p >Адрес: <span class="bold">{{$importer->address_bg }}</span></p>--}}
                    {{--<hr class="my_hr_in"/>--}}
                    {{--<p >Фирма: <span class="bold" style="text-transform: uppercase">{{$importer->name_en }}</span></p>--}}
                    {{--<p >Адрес: <span class="bold">{{$importer->address_en }}</span></p>--}}
                    {{--<hr class="my_hr_in"/>--}}
                    {{--<p >ЕИК/VIN: <span class="bold">{{$importer->vin }}</span></p>--}}
                </div>
            </div>
        </div>

    </fieldset>
    {{--<hr class="my_hr_in"/>--}}
    <h4 style="text-align: center; margin: 20px 0">ФАКТУРАТА Е ИЗДАДЕНА ЗА СЕРТИФИКАТИ С НОМЕРА</h4>
    <ol>
        @foreach($invoice as $value)
            <?php
                if($value->invoice_for == 1) {
                    $for = 'износ';
                }
                elseif($value->invoice_for == 2) {
                    $for = 'внос';
                }
                elseif($value->invoice_for == 3) {
                    $for = 'вътрешен';
                }
                else{
                    $for = '';
                }
            ?>
            <li>
                <span class="bold">{{$value->identifier}}</span>
                на фирма
                <span class="bold">{{$value->importer_name}}</span>
                - сертификат за <span class="bold">{{$for}}</span>,
                със сума - <span class="bold">{{number_format($value->sum, 2, ',', ' ') }} лв.</span>

                @if($value->invoice_for == 1)
                    <a href="{!!URL::to('/контрол/сертификат-внос/'.$value->certificate_id )!!}" class="fa fa-search-plus btn btn-default my_btn" ></a>
                @elseif($value->invoice_for == 2)
                    <a href="{!!URL::to('/контрол/сертификат-износ/'.$value->certificate_id )!!}" class="fa fa-search-plus btn btn-default my_btn"></a>
                @elseif($value->invoice_for == 3)
                    <a href="{!!URL::to('/контрол/сертификати-вътрешен/'.$value->certificate_id )!!}" class="fa fa-search-plus btn btn-default my_btn"></a>
                @endif

            </li>
        @endforeach
    </ol>
@endsection

@section('scripts')
    {{--{!!Html::script("js/table/jquery-1.11.3.min.js" )!!}--}}
    {{--{!!Html::script("js/table/jquery.dataTables.js" )!!}--}}
    {{--{!!Html::script("js/quality/InvoiceTable.js" )!!}--}}
    {{--{!!Html::script("js/build/jquery.datetimepicker.full.min.js" )!!}--}}
    {{--{!!Html::script("js/date/in_date.js" )!!}--}}
@endsection
