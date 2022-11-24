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
</div>
<!-- JavaScripts -->
{!!Html::script("js/jquery.min.js" )!!}
{!!Html::script("js/bootstrap.min.js" )!!}
@section('scripts')
@show
</body>
</html>
