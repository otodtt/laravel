<!DOCTYPE html >
<html lang="bg">
<head >
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
            <h3 class="bold layout-title">УСЛУГИ</h3>
        </div>
        <nav class="navbar navbar-default navbar-static-top my_top_nav">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/начало') }}"><i class="fa fa-home fa-fw blue_color"></i> Начало</a></li>
                <li><a href="{!! '/въздушни' !!}" class="my_a back_link"> <i class="fa fa-plane fa-fw control_color"></i> Рзрешителни - Въздушно третиране</a></li>
                <li><a href="{!! '/' !!}" class="my_a back_link"> <i class="fa fa-bug fa-fw brown"></i> Фумигация</a></li>
                <li><a href="{!! '/' !!}" class="my_a back_link"> <i class="fa fa-leaf fa-fw green_color"></i> Третиране на семена </a></li>
                <li><a href="{!! '/' !!}" class="my_a back_link"> <i class="fa fa-male fa-fw brown"></i> Консултански услуги</a></li>
                <li>
                    <a href="{!! '/' !!}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-registered red" aria-hidden="true"></i>
                        &nbsp;Месечни справки &nbsp;<span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                    </a>
                    <ul class="dropdown-menu" >
                        <li><a href="{!! URL::to( '/регистър-въздушни') !!}" class="my_a back_link"> <i class="fa fa-plane fa-fw red"></i> Таблица регистър - Разрешителни</a></li>
                        <li><a href="{!! URL::to('/')!!}" class="my_a back_link"> <i class="fa fa-male fa-fw red"></i> Таблица регистър - Заповеди</a></li>
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
