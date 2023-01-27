<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @section('title')@show</title>

    <!-- Fonts -->
    {!!Html::style("css/font-awesome.css" )!!}
    <!-- Styles -->
    {!!Html::style("css/bootstrap.min.css" )!!}
    {!!Html::style("css/sb-admin-2.css" )!!}
    {!!Html::style("css/layout/layout.css" )!!}
    {!!Html::style("css/layout/kppz.css" )!!}
    @section('css')

    @show
</head>
<body id="wrapper">
<nav class="navbar navbar-default navbar-static-top my_top_nav">
    <!-- Left Side Of Navbar -->
    <ul class="nav navbar-nav">
        <li><a href="{{ url('/начало') }}"><i class="fa fa-home fa-fw blue_color"></i> Начало</a></li>
        <li>
            <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-briefcase control_color" aria-hidden="true"></i>
                &nbsp;Контрол на Пазара &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
            </a>
            <ul class="dropdown-menu" >
                <li ><a href="{!! URL::to( '/фирми') !!}" class="my_a back_link"> <i class="fa fa-bank fa-fw blue_color "></i> Всички фирми</a></li>
                <li><a href="{!! URL::to('/аптеки')!!}" class="my_a back_link"> <i class="fa fa-plus-square fa-fw blue_color"></i> Всички аптеки</a></li>
                <li><a href="{!! URL::to('/складове')!!}" class="my_a back_link"> <i class="fa fa-shield fa-fw blue_color"></i> Всички складове </a></li>
                <li><a href="{!! URL::to('/цехове')!!}" class="my_a back_link"> <i class="fa fa-cubes fa-fw blue_color"></i> Всички цехове</a></li>
                <li><a href="{!!URL::to('/изтекъл-срок')!!}" class="my_a back_link"> <i class="fa fa-times fa-fw blue_color"></i> С изтекъл или прекратен срок</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{!! URL::to('/протоколи')!!}" class="my_a back_link"> <i class="fa fa-file-powerpoint-o fa-fw control_color"></i> Протоколи Контрол на Пазара</a></li>
                <li><a href="{!! URL::to('/протоколи-обекти')!!}" class="my_a back_link"> <i class="fa fa-object-ungroup fa-fw control_color"></i> Протоколи Нерегламентирани Обекти</a></li>
                <li><a href="{!! URL::to('/други-обекти')!!}" class="my_a back_link"> <i class="fa fa-external-link fa-fw control_color"></i> Протоколи в други Области</a></li>
                <li><a href="{!! URL::to('/производители')!!}" class="my_a back_link"> <i class="fa fa-industry fa-fw control_color"></i> Протоколи Производители на ПРЗ</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{!! URL::to('/регистър-фирми')!!}" class="my_a back_link"> <i class="fa fa-bank fa-fw red"></i> Таблица Регистър на фирми с Удостоверение</a></li>
                <li><a href="{!! URL::to('/регистър-протоколи')!!}" class="my_a back_link"> <i class="fa fa-file-powerpoint-o fa-fw red"></i>  Таблица Регистър на Констативни Протоколи</a></li>
                <li><a href="{!! URL::to('/месечни-справки')!!}" class="my_a back_link"> <i class="fa fa-calendar fa-fw red"></i> Таблица Регистър на Месечни справки</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{!! URL::to('/проби')!!}" class="my_a back_link"> <i class="fa fa-flask fa-fw brown"></i> Дневник проби от ПРЗ</a></li>
                <li><a href="{!! URL::to('/проби-тор')!!}" class="my_a back_link"> <i class="fa fa-leaf fa-fw brown"></i> Дневник проби от ТОРОВЕ</a></li>
            </ul>
        </li>

        <li>
            <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users green_color" aria-hidden="true"></i>
                &nbsp;Контрол на Употребата &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
            </a>
            <ul class="dropdown-menu" >
                <li><a href="{!! URL::to('/земеделци')!!}" > <i class="fa fa-users green_color"></i> Всички Земеделски Стопани</a><li>
                <li role="separator" class="divider"></li>
                <li><a href="{!! URL::to( '/дневници') !!}"><i class="fa fa-book green_color"></i> Заверни Дневници за ПХО</a><li>
                <li role="separator" class="divider"></li>
                <li><a href="{!! URL::to('/становища')!!}" > <i class="fa fa-address-card-o green_color"></i> Всички Становища</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{!! URL::to('/протоколи-всички')!!}" > <i class="fa fa-file-powerpoint-o control_color"></i> Всички Констативни Протоколи</a></li>
                <li><a href="{!! URL::to('/протоколи-становища')!!}" > <i class="fa fa-address-card-o control_color"></i> Констативни Протоколи - За Становища</a></li>
                <li><a href="{!! URL::to('/протоколи-стопани')!!}"> <i class="fa fa-user-times control_color"></i> Констативни Протоколи - Проверки на ЗС</a></li>
                <li><a href="{!! URL::to('/протоколи-дфз')!!}"> <i class="fa fa-money control_color"></i> Констативни Протоколи - Съвместно с ДФЗ</a></li>
                <li><a href="{!! URL::to('/протоколи-други')!!}"> <i class="fa fa-euro control_color"></i> Констативни Протоколи - Други плащания</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{!! URL::to('/месечни-справки-зс')!!}" class="my_a back_link"> <i class="fa fa-calendar fa-fw red"></i> Таблица Регистър - Инспекции на ЗС</a></li>
                <li><a href="{!! URL::to('/месечни-справки-становища')!!}" class="my_a back_link"> <i class="fa fa-address-card-o fa-fw red"></i> Таблица Регистър - Издадени Становища</a></li>
                <li><a href="{!! URL::to('/месечни-справки-контрол')!!}" class="my_a back_link"> <i class="fa fa-check-circle-o fa-fw red"></i> Таблица Регистър - Контрол на Употребата</a></li>
                <li><a href="{!! URL::to('/протоколи-регистър')!!}" class="my_a back_link"> <i class="fa fa-file-powerpoint-o fa-fw red"></i> Регистър - Констативни Протоколи</a></li>
            </ul>
        </li>

        <li>
            <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle-o dark_color" aria-hidden="true"></i>
                &nbsp;КППЗ &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
            </a>
            <ul class="dropdown-menu" >
                <li><a href="{!! URL::to( '/контрол/сертификати-внос') !!}" class="my_a back_link"> <i class="fa fa-arrow-down fa-fw "></i> Сертификати внос</a></li>
                <li><a href="{!! URL::to( '/контрол/сертификати-износ') !!}" class="my_a back_link"> <i class="fa fa-arrow-up fa-fw "></i> Сертификати износ</a></li>
                <li><a href="{!! URL::to( '/контрол/сертификати-вътрешен') !!}" class="my_a back_link"> <i class="fa fa-retweet fa-fw "></i> Сертификати вътрешен</a></li>
                <li role="separator" class="divider"></li>
                <li><a class="my_a back_link" href="{!! URL::to( 'контрол/протоколи') !!}"> <i class="fa fa-file-powerpoint-o fa-fw " style="color: #347bb7;"></i> Констативни Протоколи</a></li>
                <li><a class="my_a back_link" href="{!! URL::to( 'контрол/формуляри') !!}"><i class="fa fa-check-square fa-fw green_color"></i> Формуляри за съответствие</a></li>
                <li role="separator" class="divider"></li>
                <li ><a href="{!! URL::to( '/контрол/фактури') !!}" class="my_a back_link"> <i class="fa fa-files-o fa-fw  "></i> Издадени фактури</a></li>
                <li ><a href="{!! URL::to( '/контрол/вносители') !!}" class="my_a back_link"> <i class="fa fa-truck fa-fw dark_color "></i> Всички фирми търговци</a></li>
                <li><a href="{!! URL::to('/контрол/стоки/внос')!!}" class="my_a back_link"> <i class="fa fa-tags fa-fw "></i> Стоки</a></li>
                <li><a href="{!! URL::to('/контрол/култури')!!}" class="my_a back_link"> <i class="fa fa-leaf fa-fw green_color"></i> Култури</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{!! URL::to('/контрол/месечни-справки')!!}" class="my_a back_link"> <i class="fa fa-calendar fa-fw red"></i> Месечни-справки</a></li>
            </ul>
        </li>

        <li>
            <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sun-o yellow" aria-hidden="true"></i>
                &nbsp;Сертификати &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
            </a>
            <ul class="dropdown-menu" >
                <li><a href="{!! '/сертификати' !!}" class="my_a back_link"> <i class="fa fa-certificate yellow" aria-hidden="true"></i> Сертификати</a></li>
                <li><a href="{!! URL::to('/регистър-сертификати')!!}" class="my_a back_link"> <i class="fa fa-registered red" aria-hidden="true"></i> Таблица Регистър на издадените Сертификати</a></li>
            </ul>
        </li>

        <li>
            <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-buysellads" aria-hidden="true"></i>
                &nbsp;Услуги &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
            </a>
            <ul class="dropdown-menu" >
                <li><a href="{!! '/въздушни' !!}" class="my_a back_link"> <i class="fa fa fa-plane fa-fw blue_color"></i> Рзрешителни - Въздушно третиране</a></li>
                <li><a href="{!! '/' !!}" class="my_a back_link"> <i class="fa fa fa-bug fa-fw brown"></i> Фумигация</a></li>
                <li><a href="{!! '/' !!}" class="my_a back_link"> <i class="fa fa fa-leaf fa-fw green_color"></i> Третиране на семена</a></li>
                <li><a href="{!! '/' !!}" class="my_a back_link"> <i class="fa fa fa-male fa-fw brown"></i> Консултански услуги</a></li>
                <li role="separator" class="divider"></li>
                <li><a class="text" href="{!! URL::to( '/регистър-въздушни') !!}"><i class="fa fa-calendar fa-fw red"></i> Таблица Регистър - Издадени Разрешения</a></li>
                <li><a class="" href="{!! URL::to( '/') !!}"><i class="fa fa-calendar fa-fw red"></i> Таблица Регистър - Услуги</a></li>
            </ul>
        </li>

        <li>
            <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-info" aria-hidden="true"></i>
                &nbsp;Полезно &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
            </a>
            <ul class="dropdown-menu" >
                <li><a href="{!! '/полезно/регламенти' !!}" class="my_a back_link"> <i class="fa fa fa-euro fa-fw blue_colorA"></i> Регламенти</a></li>
                <li><a href="{!! '/полезно/закони' !!}" class="my_a back_link"> <i class="fa fa fa-balance-scale fa-fw brownА"></i> Закони</a></li>
                <li><a href="{!! '/полезно/наредби' !!}" class="my_a back_link"> <i class="fa fa fa-gavel fa-fw green_colorA"></i> Наредби</a></li>
                {{--<li><a href="{!! '/' !!}" class="my_a back_link"> <i class="fa fa fa-male fa-fw brown"></i> Консултански услуги</a></li>--}}
                <li role="separator" class="divider"></li>
                <li><a class="text" href="{!! URL::to( '/регистър-въздушни') !!}"><i class="fa fa-file fa-fw control_color"></i> Бланки</a></li>
                {{--<li><a class="" href="{!! URL::to( '/') !!}"><i class="fa fa-calendar fa-fw red"></i> Таблица Регистър - Услуги</a></li>--}}
            </ul>
        </li>

    </ul>
    <!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Влез</a></li>
        @else
            @if(Auth::user()->admin == 2 )
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->short_name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Излез</a></li>
                        <li><a href="{{ url('/админ') }}"><i class="fa fa-btn fa-sign-out"></i> Админ панел</a></li>
                    </ul>
                </li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->short_name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Излез</a></li>
                        <li><a href="{{ url('/парола/'.Auth::user()->id) }}"><i class="fa fa-key"></i> Смяна на парола</a></li>
                    </ul>
                </li>
            @endif
        @endif
    </ul>
</nav>

<div id="wrapper_section" style="width: 100%; margin: auto">
    @section('message')
    @show

    @yield('content')


</div>

<!-- JavaScripts -->
{!!Html::script("js/jquery.min.js" )!!}
{!!Html::script("js/bootstrap.min.js" )!!}
</body>
</html>
