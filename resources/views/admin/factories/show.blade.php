@extends('layouts.admin')
@section('title')
    {{ 'Фирми производител' }}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="alert alert-info alert-dismissible" role="alert" style="text-align: center">
        <h4 class="bold">ФИРМА ПРОИЗВОДИТЕЛ НА ПРОДУКТИ ЗА РАСТИТЕЛНА ЗАЩИТА</h4>
    </div>

    <?php
    $area_name = null;
    $district_name = null;
    ////////////////////////
    if ($firm->type_firm == 1) {
        $et = 'ET';
        $ood = '';
    } elseif ($firm->type_firm == 2) {
        $et = '';
        $ood = 'ООД';
    } elseif ($firm->type_firm == 3) {
        $et = '';
        $ood = 'ЕООД';
    } elseif ($firm->type_firm == 4) {
        $et = '';
        $ood = 'АД';
    } else {
        $et = '';
        $ood = '';
    }
    //////////////////////////
    if($firm->type_location == 1){
        $tvm = 'гр. ';
    }
    if($firm->type_location == 2){
        $tvm = 'с. ';
    }
    ///////
    foreach ($areas as $area) {
        if ($area->id == $firm->areas_id) {
            $area_name = $area->areas_name;
        }
    }
    foreach ($areas_show as $show) {
        if ($show->district_id == $firm->district_id) {
            $district_name = $show->name;
        }
    }
    ?>
    <div class="container-fluid" >
        <div class="form-group">
            <p>Име на Фирмата: <span class="bold">{!! $et !!} "{!! mb_strtoupper($firm->name, "utf-8") !!}" {!! $ood !!}</span></p>
            <p>
                Регистрирана в: <span class="bold">{!! $tvm.$firm->location !!}, п.к. {{$firm->postal_code}}, общ. {{$district_name}},  обл. {{$area_name}}</span>
            </p>
            <p>
                С адрес: <span class="bold">{!! $firm->address !!}</span>
            </p>
            <p>ЕИК/Булстат: <span class="bold">{!! $firm->bulstat !!}</span></p>
            <p>Управител/Представител: <span class="bold">{!! $firm->owner !!}</span> с ЕГН: <span class="bold">{!! $firm->egn !!}</span> </p>
            <p>Телефон: <span class="bold">{!! $firm->phone !!}</span></p>
            <p>Мобилен: <span class="bold">{!! $firm->mobil !!}</span></p>
            <p>E-amil: <span class="bold">{!! $firm->email !!}</span></p>
        </div>
    </div>
@endsection

