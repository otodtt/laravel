@extends('layouts.app')

@section('title')
    {{ 'ОДБХ Начало' }}
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
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">КОНТРОЛ НА УПОТРЕБАТА</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{!! URL::to( '/земеделци') !!}"><i class="fa fa-users green_color"></i> Всички Земеделски Стопани</a>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{!! URL::to( '/дневници') !!}"><i class="fa fa-book green_color"></i> Заверни Дневници за ПХО</a>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="fa fa-plus btn btn-xs btn-success my_btn" href="{!! URL::to( '/търси-дневник') !!}" style="float: right; margin-right: 10px;"> Добави Заверка на дневник</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br/>

                        <div class="row">
                            <div class="col-lg-6">
                                <fieldset class=""><legend class="">Становища и Констативни Протоколи преди 2015 г.</legend>
                                <a class="text" href="{!! URL::to( '/становища-стари') !!}"><i class="fa fa-address-card-o fa-fw old_color"></i> Издадени становища до 2015 г.</a><br/>
                                    <a class="text" href="{!! URL::to( '/стари-протоколи-всички') !!}"><i class="fa fa-file-powerpoint-o fa-fw old_color"></i> Констативни протоколи до 2015 г.</a><br/>
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset class=""><legend class="">Становища и Констативни Протоколи от 2015 г.</legend>
                                    <div class="row">

                                        <div class="col-lg-6  ">
                                            <a class="" href="{!! URL::to( '/становища') !!}"><i class="fa fa-address-card-o green_color" aria-hidden="true"></i> Становища</a><br/>
                                            <a class="" href="{!! URL::to( '/протоколи-всички') !!}"><i class="fa fa-file-powerpoint-o fa-fw control_color"></i> Констативни протоколи</a>
                                            <br/>
                                            <a class="" href="{!! URL::to( '/месечни-справки-зс') !!}"><i class="fa fa-calendar fa-fw red"></i> Месечни справки</a>
                                        </div>
                                        <div class="col-lg-6 text-right ">
                                            <a class="fa fa-plus btn btn-xs btn-danger my_btn" href="{!! URL::to( '/търси-становище') !!}" style="float: right; margin-right: 10px;"> Добави НОВО Становище</a>
                                            <a class="fa fa-plus btn btn-danger btn-xs"  href="{!! URL::to( '/търси-протокол') !!}" style="float: right; margin-right: 10px; margin-top: 15px"> Добави НОВ Констативен Протокол</a>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">КОНТРОЛ НА ПАЗАРА</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <fieldset class=""><legend class="">Фирми, Аптеки, Складове и Цехове</legend>
                                    <a class="my_a back_link" href="{!! URL::to( '/фирми') !!}"><i class="fa fa-bank fa-fw blue_color"></i> Всички фирми</a><br/>
                                    <a class="my_a back_link" href="{!! URL::to( '/аптеки') !!}"> <i class="fa fa-plus-square fa-fw blue_color"></i> Всички аптеки</a><br/>
                                    <a class="my_a back_link" href="{!! URL::to( '/складове') !!}"><i class="fa fa-shield fa-fw blue_color"></i> Всички складове</a><br/>
                                    <a class="my_a back_link" href="{!! URL::to( '/цехове') !!}"><i class="fa fa-cubes fa-fw blue_color"></i> Всички цехове</a><br/>
                                    <a class="my_a back_link" href="{!! URL::to( '/изтекъл-срок') !!}"><i class="fa fa-times fa-fw blue_color"></i> С изтекъл или прекратен срок</a>
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset class=""><legend class="">Констативни Протоколи и Месечни справки</legend>
                                    <div class="row">

                                        <div class="col-lg-12  ">
                                            <a class="my_a back_link" href="{!! URL::to( '/протоколи') !!}"><i class="fa fa-file-powerpoint-o fa-fw control_color"></i> Протоколи Контрол на Пазара</a><br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/протоколи-обекти') !!}"><i class="fa fa-object-ungroup fa-fw control_color"></i> Протоколи Нерегламентирани Обекти</a><br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/други-обекти') !!}"><i class="fa fa-external-link fa-fw control_color"></i> Протоколи в други Области </a><br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/производители') !!}"><i class="fa fa-industry fa-fw control_color"></i> Протоколи Производители на ПРЗ</a><br/>
                                            <br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/месечни-справки') !!}"> <i class="fa fa-calendar fa-fw red"></i> Месечни справки</a>
                                            <a class="my_a back_link " href="{!! URL::to( '/проби') !!}" style="float: right; margin-right: 10px"> <i class="fa fa-flask fa-fw brown"></i> Дневник взети проби от ПРЗ </a>

                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">КОНТРОЛ НА ПРЕСНИ ПЛОДОВЕ И ЗЕЛЕНЧУЦИ</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <fieldset class=""><legend class="">Сертификати</legend>
                                    <a class="my_a back_link" href="{!! URL::to( 'контрол/сертификати-внос') !!}"> <i class="fa fa-arrow-down fa-fw"></i> Сертификати внос</a><br/>
                                    <a class="my_a back_link" href="{!! URL::to( 'контрол/сертификати-износ') !!}"> <i class="fa fa-arrow-up fa-fw "></i> Сертификати износ</a><br/>
                                    <a class="my_a back_link" href="{!! URL::to( 'контрол/сертификати-вътрешен') !!}"> <i class="fa fa-retweet fa-fw "></i> Сертификати вътрешен</a>
                                    <hr style="margin-bottom: 5px; margin-top: 5px"/>
                                    <a class="my_a back_link" href="{!! URL::to( 'контрол/протоколи') !!}"> <i class="fa fa-file-powerpoint-o fa-fw " style="color: #347bb7;"></i> Констативни Протоколи</a><br/>
                                    <a class="my_a back_link" href="{!! URL::to( '/') !!}"><i class="fa fa-check-square fa-fw green_color"></i> Формуляри за съответствие</a><br/>
                                    {{-- <a class="my_a back_link" href="{!! URL::to( '/контрол/вносители') !!}"><i class="fa fa-truck fa-fw dark_color "></i> Всички фирми търговци</a><br/>
                                    <a class="my_a back_link" href="{!! URL::to( '/контрол/култури/внос') !!}"><i class="fa fa-leaf fa-fw green_color"></i> Всички култури</a><br/> --}}
                                    <a class="my_a back_link" href="{!! URL::to( '/test') !!}"><i class="fa fa-cubes fa-fw green_color"></i> ТЕСТ</a>
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset class=""><legend class=""> Фирми, Култури и Месечни справки</legend>
                                    <div class="row">
                                        <div class="col-lg-12  ">
                                            <a class="my_a back_link" href="{!! URL::to( '/контрол/фактури') !!}"><i class="fa fa-files-o fa-fw  "></i> Фактури</a><br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/контрол/вносители') !!}"><i class="fa fa-truck fa-fw dark_color "></i> Всички фирми търговци</a><br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/контрол/стоки/внос') !!}"><i class="fa fa-tags fa-fw"></i> Стоки</a><br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/контрол/култури') !!}"><i class="fa fa-leaf fa-fw green_color"></i> Култури</a><br/>
                                            {{-- <a class="my_a back_link" href="{!! URL::to( '/') !!}"><i class="fa fa-file-powerpoint-o fa-fw control_color"></i> Протоколи Контрол на Пазара</a><br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/') !!}"><i class="fa fa-object-ungroup fa-fw control_color"></i> Протоколи Нерегламентирани Обекти</a><br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/и') !!}"><i class="fa fa-external-link fa-fw control_color"></i> Протоколи в други Области </a><br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/') !!}"><i class="fa fa-industry fa-fw control_color"></i> Протоколи Производители на ПРЗ</a><br/> --}}
                                            <br/>
                                            <a class="my_a back_link" href="{!! URL::to( '/') !!}"> <i class="fa fa-calendar fa-fw red"></i> Месечни справки</a>
                                            <a class="my_a back_link " href="{!! URL::to( '/') !!}" style="float: right; margin-right: 10px"> <i class="fa fa-flask fa-fw brown"></i> Дневник взети проби от ПРЗ </a>

                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">СЕРТИФИКАТИ</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <a class="my_a back_link" href="{!! URL::to( '/сертификати') !!}"><i class="fa fa-certificate yellow" aria-hidden="true"></i> Сертификати</a>
                            </div>
                            <div class="col-lg-6">
                                <a class="my_a back_link" href="{!! URL::to( '/регистър-сертификати') !!}"><i class="fa fa-registered red" aria-hidden="true"></i> Таблица Регистър - Издадени Сертификати</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">УСЛУГИ</h3>
                    </div>
                    <div class="panel-body">
                       <div class="row">
                            <div class="col-lg-4">
                                <fieldset class=""><legend class="">Разрешения за авиационно третиране</legend>
                                    <a class="my_a back_link" href="{!! URL::to( '/въздушни') !!}"><i class="fa fa fa-plane fa-fw blue_color"></i> Издадени Разрешения</a><br/>
                                    <br/>
                                    <a class="text" href="{!! URL::to( '/регистър-въздушни') !!}"><i class="fa fa-calendar fa-fw red"></i> Таблица Регистър - Издадени Разрешения</a>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class=""><legend class="">Фумигация и Третиране на семена</legend>
                                    <a class="my_a back_link" href="/"> <i class="fa fa-bug fa-fw brown"></i> Фумигация</a><br/>
                                    <a class="my_a back_link" href="/"><i class="fa fa-leaf fa-fw green_color"></i> Третиране на семена </a><br/>
                                    <a class="" href="{!! URL::to( '/') !!}"><i class="fa fa-calendar fa-fw red"></i> Таблица Регистър</a>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class=""><legend class="">Консултантски услуги</legend>
                                    <div class="row">
                                        <a class="my_a back_link" href="/"> <i class="fa fa fa-male fa-fw brown"></i>Консултански услуги</a><br/>
                                        <br/>
                                        <a class="" href="{!! URL::to( '/') !!}"><i class="fa fa-calendar fa-fw red"></i> Таблица Регистър</a>
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
