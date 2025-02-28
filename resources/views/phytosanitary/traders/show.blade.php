@extends('layouts.phyto')
@section('title')
    {{ 'Фирма Търговец' }}
@endsection

@section('css')
    {!!Html::style("css/table/jquery.dataTables.css" )!!}
{{--    {!!Html::style("css/metisMenu.min.css" )!!}--}}
    {!!Html::style("css/qcertificates/show_opinion.css" )!!}
{{--    {!!Html::style("css/table/table_firms.css " )!!}--}}
    {!!Html::style("css/firms_objects/firms_all_css.css" )!!}
{{--    {!!Html::style("css/farmers/farmer_info.css" )!!}--}}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="info-wrap">
        {{-- <a href="{!! URL::to('контрол/вносители')!!}" class="fa fa-truck btn btn-success my_btn my_floats"> Назад!</a> --}}
        <div class="div-layout-title" style="margin-bottom: 20px; margin-top: 20px">
            <h4 class="bold layout-title" >ФИРМА ТЪРГОВЕЦ ВПИСАНА В ОФИЦИАЛНИЯ РЕГИСТЪР</h4>
        </div>
        <hr class="my_hr"/>
        <div class="btn-group" >
            {{--<span class="fa fa-truck btn btn-default my_btn"> Търговци</span>--}}
            <a href="{!! URL::to('/фито/регистър-оператори')!!}" class="fa fa-registered btn btn-info my_btn"> Към Регистъра</a>
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
                    <div class="small_field_center top_info" style="display: table-cell" >
                        <span class="span-firm-info"><i class="fa fa-edit "></i> РЕДАКТИРАНЕ, АКТУАЛИЗАЦИЯ НА ДАННИ ЗА ЗАЯВЛЕНИЕТО</span>
                    </div>
                </div>
                <div style="display: table-row">
                    <div class="small_field_center" style="display: table-cell">

                        <div class="btn_add" style="display: inline-block; height: 25px;">
                            <p>Търговец</p>
                        </div>
                        <br>
                        <hr class="my_hr_in"/>
                        <p >Фирма: <span class="bold" style="text-transform: uppercase">{{$trader->trader_name }}</span></p>
                        <p >Град/село: <span class="bold" style="">{{$trader->city }}</span></p>
                        <p >Адрес: <span class="bold">{{$trader->trader_address }}</span></p>
                        <p >ЕИК/Булстат: <span class="bold">{{$trader->trader_vin }}</span></p>
                        <p >Телефон: <span class="bold">{{$trader->phone }}</span></p>
                    </div>
                    <div class="small_field_center" style="display: table-cell">

                        <div class="btn_add" style="display: inline-block; height: 25px;">
                            <p>Търговец</p>
                        </div>
                        <div class="btn_add_firm">
                            <a href="{!!URL::to('/фито/търговец/'.$trader->id.'/edit')!!}" class="fa fa-edit btn btn-primary my_btn"> Редактирай фирмата</a>
                        </div>
                        <br>
                        <hr class="my_hr_in"/>
                        <p>Направи НОВА Регистрация в Официалния Регистър
                            <a href="{!!URL::to('/фито/търговец/from_trader/'.$trader->id)!!}" class="fa fa-plus btn btn-danger my_btn" style=""> ТУК</a>
                        </p>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <div style="text-align: center;margin-top: 20px">
        <h4>Фирмата има {{count($operators)}} регистрация/и в Официяалния регистър</h4>

        @foreach($operators as $operator)
            <?php
            if($operator->registration_number >= 1 && $operator->registration_number <= 9){
                $nulls = '000';
            }
            elseif($operator->registration_number >= 10 && $operator->registration_number <= 90){
                $nulls = '00';
            }
            elseif($operator->registration_number >= 100 ){
                $nulls = '0';
            }
            else {
                $nulls = '';
            }
            ?>

            <p style="font-size: 20px; font-weight: bold" >Регистрация с номер
                {{$operator_index[0]['operator_index_bg']}}-{{$nulls.$operator->registration_number }}
                /{{date('d.m.Y', $operator->registration_date)}}
                <a href="{!!URL::to('/фито/оператор/'.$operator->id)!!}" class="fa fa-edit btn btn-primary my_btn"> Виж</a>
            </p>
            <hr>
        @endforeach
    </div>


@endsection


@section('scripts')
    {!!Html::script("js/metisMenu.min.js" ) !!}
    {!!Html::script("js/sb-admin-2.js" ) !!}
    {!!Html::script("js/table/jquery.dataTables.js" )!!}
{{--    {!!Html::script("js/quality/firmsImportersTable.js" )!!}--}}

    <script>
    </script>
@endsection