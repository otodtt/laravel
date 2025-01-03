<!DOCTYPE html >
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @section('title')@show</title>


    {!!Html::style("css/font-awesome.css" )!!}
    {!!Html::style("css/bootstrap.min.css" )!!}
    {!!Html::style("css/sb-admin-2.css" )!!}
    {!!Html::style("css/layout/layout.css" )!!}
    @section('css')

    @show

</head>
<body>
    <div id="wrapper">
        <div class="div-layout-title">
            <h3 class="bold layout-title">КОНТРОЛ НА ПАЗАРА</h3>
        </div>
        <nav class="navbar navbar-default navbar-static-top my_top_nav">
            <!-- Top Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/начало') }}"><i class="fa fa-home fa-fw blue_color"></i> Начало</a></li>
                <li>
                    <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-black-tie control_color" aria-hidden="true"></i>
                        &nbsp;Фирми и Обекти &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                    </a>
                    <ul class="dropdown-menu" >
                        <li><a href="{!! URL::to( '/фирми') !!}" class="my_a back_link"> <i class="fa fa-bank fa-fw blue_color"></i> Всички фирми</a></li>
                        <li><a href="{!! URL::to('/аптеки')!!}" class="my_a back_link"> <i class="fa fa-plus-square fa-fw blue_color"></i> Всички аптеки</a></li>
                        <li><a href="{!! URL::to('/складове')!!}" class="my_a back_link"> <i class="fa fa-shield fa-fw blue_color"></i> Всички складове </a></li>
                        <li><a href="{!! URL::to('/цехове')!!}" class="my_a back_link"> <i class="fa fa-cubes fa-fw blue_color"></i> Всички цехове</a></li>
                        <li><a href="{!!URL::to('/изтекъл-срок')!!}" class="my_a back_link"> <i class="fa fa-times fa-fw blue_color"></i> С изтекъл или прекратен срок</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-briefcase control_color" aria-hidden="true"></i>
                        &nbsp;Контрол на Пазара &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                    </a>
                    <ul class="dropdown-menu" >
                        <li><a href="{!! URL::to('/доклади-контрол')!!}" class="my_a back_link"> <i class="fa fa-file-text-o fa-fw control_color"></i> Доклади Контрол на Пазара</a></li>
                        <li><a href="{!! URL::to('/протоколи-обекти')!!}" class="my_a back_link"> <i class="fa fa-object-ungroup fa-fw control_color"></i> Протоколи Нерегламентирани Обекти</a></li>
                        <li><a href="{!! URL::to('/други-обекти')!!}" class="my_a back_link"> <i class="fa fa-external-link fa-fw control_color"></i> Протоколи в други Области</a></li>
                        <li><a href="{!! URL::to('/производители')!!}" class="my_a back_link"> <i class="fa fa-industry fa-fw control_color"></i> Протоколи Производители на ПРЗ</a></li>
                        <hr style="margin-bottom: 5px; margin-top: 5px"/>
                        <li><a class="my_a back_link" href="{!! URL::to( '/протоколи-стари') !!}"><i class="fa fa-file-powerpoint-o fa-fw old_color"></i> Стари Протоколи Контрол на Пазара до 30.06.2023</a><li/>
                    </ul>
                </li>

                <li>
                    <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-registered red" aria-hidden="true"></i>
                        &nbsp;Месечни справки &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                    </a>
                    <ul class="dropdown-menu" >
                        <li><a href="{!! URL::to('/месечни-справки')!!}" class="my_a back_link"> <i class="fa fa-calendar fa-fw red"></i> Таблица Регистър на Месечни справки</a></li>
                        <li><a href="{!! URL::to('/регистър-фирми')!!}" class="my_a back_link"> <i class="fa fa-bank fa-fw red"></i> Таблица Регистър на фирми с Удостоверение</a></li>
                        <li><a href="{!! URL::to('/регистър-протоколи')!!}" class="my_a back_link"> <i class="fa fa-file-powerpoint-o fa-fw red"></i>  Таблица Регистър на Констативни Протоколи</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-flask brown" aria-hidden="true"></i>
                        &nbsp;Взети проби &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                    </a>
                    <ul class="dropdown-menu" >
                        <li><a href="{!! URL::to('/проби')!!}" class="my_a back_link"> <i class="fa fa-flask fa-fw brown"></i> Дневник проби от ПРЗ</a></li>
                        <li><a href="{!! URL::to('/проби-тор')!!}" class="my_a back_link"> <i class="fa fa-leaf fa-fw brown"></i> Дневник проби от ТОРОВЕ</a></li>
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
                                <li><a href="{{ url('/') }}"><i class="fa fa-edit"></i> Лични данни</a></li>
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

    </div>

    {!!Html::script("js/jquery.min.js" )!!}
    {!!Html::script("js/bootstrap.min.js" )!!}
    @section('scripts')

    @show
</body>
</html>