@extends('layouts.app')

@section('title')
    {{ 'Стари протоколи' }}
@endsection

@section('css')
    {!!Html::style("css/home.css" )!!}
@endsection

@section('message')
    @include('admin.alerts.success')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="bold" style="text-align: center">КОНТРОЛ НА ПАЗАРА</h2>
        </div>
        <div class="row">
            <p class="bold" style="text-align: center">
                <span class="red">ВНИМАНИЕ!!!</span> Тук са всички Констативни Протоколи издавани до 30.06.2023 г.
            </p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">КОНТРОЛ НА ПАЗАРА ДО 30.06.2023 г.</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <fieldset class=""><legend class="">Констативни Протоколи и Месечни справки</legend>
                                    <div class="row">
                                        <div class="col-lg-12  ">
                                            <a class="my_a back_link" href="{!! URL::to( '/протоколи') !!}"><i class="fa fa-file-powerpoint-o fa-fw control_color"></i> Протоколи Контрол на Пазара</a><br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/протоколи-обекти') !!}"><i class="fa fa-object-ungroup fa-fw control_color"></i> Протоколи Нерегламентирани Обекти</a><br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/други-обекти') !!}"><i class="fa fa-external-link fa-fw control_color"></i> Протоколи в други Области </a><br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/производители') !!}"><i class="fa fa-industry fa-fw control_color"></i> Протоколи Производители на ПРЗ</a><br/>
                                            <br/>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
