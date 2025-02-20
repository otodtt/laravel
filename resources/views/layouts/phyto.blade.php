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
        <h3 class="bold layout-title">ФИТОСАНИТЕРЕН КОНТРОЛ</h3>
    </div>
    <nav class="navbar navbar-default navbar-static-top my_top_nav">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
            <li><a href="{{ url('/начало') }}"><i class="fa fa-home fa-fw blue_color"></i> Начало</a></li>
            <li>
                <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-leaf green_color" aria-hidden="true"></i>
                    &nbsp;ФИТО &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                </a>
                <ul class="dropdown-menu" >
                    <li><a href="{!! URL::to( '/фито/сертификати-внос') !!}" class="my_a back_link"> <i class="fa fa-certificate fa-fw "></i> Фито Сертификати</a></li>
                    {{--<li><a href="{!! URL::to( '/фито/сертификати-износ') !!}" class="my_a back_link"> <i class="fa fa-arrow-up fa-fw "></i> Сертификати износ</a></li>--}}

                    <li role="separator" class="divider"></li>
                    <li><a class="my_a back_link" href="{!! URL::to( 'фито/регистър-оператори') !!}"> <i class="fa fa-registered fa-fw " style="color: #347bb7;"></i> Официален регистър на оператори</a></li>
                    <li><a class="my_a back_link" href="{!! URL::to( 'фито/паспорти') !!}"><i class="fa fa-id-badge fa-fw green_color"></i> Растителни Паспорти</a></li>
                    {{--<li><a class="my_a back_link" href="{!! URL::to( 'фито/идентификация') !!}"><i class="fa fa-id-card-o fa-fw blue_color"></i> Проверка и идентификация</a></li>--}}


                    <li role="separator" class="divider"></li>
{{--                    <li ><a href="{!! URL::to( '/фито/фактури') !!}" class="my_a back_link"> <i class="fa fa-files-o fa-fw  "></i> Издадени фактури</a></li>--}}
                    <li ><a href="{!! URL::to( '/фито/регистър-тъговци') !!}" class="my_a back_link"> <i class="fa fa-truck fa-fw dark_color "></i> Всички фирми търговци</a></li>
                    {{--<li><a href="{!! URL::to('/фито/стоки/внос')!!}" class="my_a back_link"> <i class="fa fa-tags fa-fw "></i> Стоки</a></li>--}}
                    {{--<li role="separator" class="фито"></li>--}}

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